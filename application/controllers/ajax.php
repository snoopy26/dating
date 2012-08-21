<?php

class Ajax extends CI_Controller {
	
	var $session_business;
	var $business;

	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$this->load->model('account_model');
		$member = $this->session->userdata('2becomeus_login');
		$this->session_business = $member;
		if (!empty($member))
		$this->business = $this->account_model->checkMember($this->session_business->member_id);
	}

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

	function getSeeMoreSayHello(){
		$this->load->model('message_model');

		$user1 = $this->input->get_post('user1');
		$user2 = $this->input->get_post('user2');
		$limit = $this->input->get_post('limit');

		$getSayHelloSelectedUser = $this->message_model->getSayHelloSelectedUser($user1, $user2, $limit);
		$html = "";
		if (!empty($getSayHelloSelectedUser)){
			foreach($getSayHelloSelectedUser as $p){
				$photo = $this->filemanager->getPath($p->album1, '300x200');
				$member_username = $p->member_username;
				$sayhello = $p->kiss_message;
				
				if ($p->member_to_id != $user2){
					$html .= '
					<li>
						<div class="span6 user-avatar" style="background-image:url('.$photo.');">Foto Avatar</div>
						<div class="span6 user-detail">
							<h3><a href="'.base_url() . 'profile/index/' . $member_username.'">'.$member_username.'</a></h3>
							<div class="info-section" >
								<b>Say Hello to YOU: </b>
								<blockquote ><p class="blockquote big-p ">'.$sayhello.'<p><small>'.strftime("%A, %d %B %Y, %H:%M", strtotime($p->lastupdate)).' <a href="'.base_url().'activity/sayhello?msid='.$p->kiss_message_id.'">Details.</a></small> </blockquote>
							</div>
							
						</div>
					</li>';
				}else{
					$html .= '
					<li>
						<div class="span6 user-detail">
							<h3><a href="'.base_url() . 'profile/index/' . $member_username.'">'.$member_username.'</a></h3>
							<div class="info-section" >
								<b>Say Hello: </b>
								<blockquote ><p class="blockquote big-p ">'.$sayhello.'<p><small>'.strftime("%A, %d %B %Y, %H:%M", strtotime($p->lastupdate)).' <a href="'.base_url().'activity/sayhello?msid='.$p->kiss_message_id.'">Details.</a></small> </blockquote>
							</div>
							
						</div>
						<div class="span6 user-avatar" style="background-image:url('.$photo.');">Foto Avatar</div>
					</li>
					';		
				}
		
			}
		}

		echo json_encode(array(
			'html' => $html
		));

	}

	function replyKissMessage(){
		$message = $this->input->get_post('message');
		$kissmessageid = $this->input->get_post('kissmessageid');
		if (empty($this->business)){
			echo json_encode(array(
				'status' => 0,
				'error' => 'Something Error.'
			));
		}else{
			$member_id = $this->business->member_id;
			$this->load->model('message_model');
			$replyId = $this->message_model->replyKissMessage($member_id, $message, $kissmessageid);
			$photo = $this->filemanager->getPath($this->business->album1, "50x50");
			$html = '
			<li id="listReply_'.$replyId.'">
				<div class="list_img"><a href="'.base_url().'profile/index/'.$this->business->member_username.'"><img src="'.$photo.'" /></a></div>
				<div class="list_reply"><b><a href="'.base_url().'profile/index/'.$this->business->member_username.'">'.$this->business->member_username.'</a></b>, <span>'.$message.'</span></div>
			</li>
			';
			echo json_encode(array(
				'status' => 1,
				'html' => $html
			));
		}
	}

	function getReplyKissMessage(){
		$kissmessageid = $this->input->get_post('kissmessageid');
		$this->load->model('message_model');
		$results = $this->message_model->getReplyKissMessage($kissmessageid);
		$html = "";
		$replyId = array();
		foreach($results as $result){
			$photo = $this->filemanager->getPath($result->album1, "50x50");
			$message = $result->message;
			$html .= '
			<li id="listReply_'.$result->reply_id.'">
				<div class="list_img"><a href="'.base_url().'profile/index/'.$result->member_username.'"><img src="'.$photo.'" /></a></div>
				<div class="list_reply"><b><a href="'.base_url().'profile/index/'.$result->member_username.'">'.$result->member_username.'</a></b>, <span>'.$message.'</span></div>
			</li>
			';
			$replyId[] = $result->reply_id;
		}
		echo json_encode(array(
			'status' => 1,
			'html' => $html,
			'replyId' => $replyId
		));
	}

	function flagUser(){
		$this->load->model('flag_model');
		$member_id = $this->business->member_id;
		$member_to_id = $this->input->get_post('memberid');
		$isActive = $this->input->get_post('isActive');
		$this->flag_model->flagUser($member_id, $member_to_id, $isActive);
	}
	
}

?>