<?php

class Ajax extends CI_Controller {
	
	function generate_day(){
		$this->load->library('birthday');
		
		$month = $this->input->get_post('month');
		$day = $this->input->get_post('day');
		$year = $this->input->get_post('year');
		
		$days = "";
		
		if ($month == 2){
			if ($month % 4 == 0 || $month % 400 == 0){
				$days = $this->birthday->generate_birthdate(1,28);
			}else if ($month % 100 == 0){
				$days = $this->birthday->generate_birthdate(1,29);
			}else{
				$days = $this->birthday->generate_birthdate(1,29);
			}
		}else if (($month - 1) % 7 % 2){
			$days = $this->birthday->generate_birthdate(1,30);
		}else{
			$days = $this->birthday->generate_birthdate(1,31);
		}
		
		echo json_encode(array(
			'days' => $days
		));
		
	}
	
	function generate_kabupaten(){
		$this->load->model('address_model');
		$province_id = $this->input->get_post('province');
		$kabupaten = $this->address_model->address_kabupaten($province_id);
		$opt = '<option value="0">Select</option>';
		foreach($kabupaten as $kb){
			$opt .= '<option value="'.$kb->city_id.'">'.$kb->city_name.'</option>';
		}
		echo json_encode(array(
			'kabupaten' => $opt
		));
	}
	
	function generate_kecamatan(){
		$this->load->model('address_model');
		$kabupaten_id = $this->input->get_post('kabupaten');
		$kecamatan = $this->address_model->address_kecamatan($kabupaten_id);
		$opt = '<option value="0">Select</option>';
		foreach($kecamatan as $kc){
			$opt .= '<option value="'.$kc->kecamatan_id.'">'.$kc->kecamatan_name.'</option>';
		}
		echo json_encode(array(
			'kecamatan' => $opt
		));
	}
	
	function generate_kelurahan(){
		$this->load->model('address_model');
		$kecamatan_id = $this->input->get_post('kecamatan');
		$kelurahan = $this->address_model->address_kelurahan($kecamatan_id);
		$opt = '<option value="0">Select</option>';
		foreach($kelurahan as $kl){
			$opt .= '<option value="'.$kl->kelurahan_id.'">'.$kl->kelurahan_name.'</option>';
		}
		echo json_encode(array(
			'kelurahan' => $opt
		));
	}
	
	function questions(){
		$ref = $this->input->get_post('ref'); // score
		$uid = $this->input->get_post('uid'); // sha1 salt.score
		$idx = $this->input->get_post('idx'); // idx answered
		$qid = $this->input->get_post('qid'); // question id
		$uqid = $this->input->get_post('uqid'); // sha1 salt.question id
		$ask = $this->input->get_post('ask'); // ask
		$aid = $this->input->get_post('aid'); // answered id
		$qaid = $this->input->get_post('qaid'); // sha1 salt.answered id
		
		$sha_uid = sha1(SALT . $ref);
		$sha_uqid = sha1(SALT . $qid);
		$sha_qaid = sha1(SALT . $aid);
		
		$status = 0;
		$html = "";
		if ($sha_uid == $uid && $sha_uqid == $uqid && $sha_qaid == $qaid){
			$status = 1;
			$this->load->model('personality_test_model');
			$member = $this->session->userdata('member_twobecomeus');
			
			// insert ke db
			$this->personality_test_model->insertAnswered($member->member_id, $qid, $aid, $ask);
			
			// get next questions
			$count_total = $this->personality_test_model->totalQuestions($member->member_id);
			$offset = rand(1, $count_total - 1);
			$question = $this->personality_test_model->getQuestionsRandom($offset, 1, $member->member_id);
			$html = $this->question_html($question);
		}
		echo json_encode(array(
			'status' => $status,
			'html' => $html
		));
	}
	
	function question_html($question){
		$question_id = $question['question']->question_id;
		$score = $question['question']->score;
		$score_edit = str_replace("/:/", "", $question['question']->score);
		$answer_id = explode("/:/", $question['question']->answer_id);
		$html = '
		<div class="tk-slide question" id="question" data-ref="'.$score_edit.'" data-uid-ref="'.sha1(SALT . $score_edit).'" data-qid="'.$question_id.'" data-uid-qid="'.sha1(SALT . $question_id).'">
			<p>'.ucfirst($question['question']->question).'</p>
			<div class="btn-group" id="btn-opt" data-toggle="buttons-radio">';
			
		foreach(explode("/:/", $question['question']->answer) as $i => $opt){ 
			list($title, $detail) = explode("|", $opt);
			$html .= '<button class="btn" data-title="'.ucfirst($detail).'" data-aid="'.$answer_id[$i].'" data-ref-aid="'.sha1(SALT . $answer_id[$i]).'">'.ucfirst($title).'</button>';
		}
		
		$html .= '
			</div>
			<label class="checkbox" >
				<input type="checkbox" id="ask-mate" value="1"> <span data-title="How your mate respond ?" data-content="We will compare your answers with your mate.">Ask to your mate.</span>
			</label>
		</div>
		';
		return $html;
	}
	
}

?>