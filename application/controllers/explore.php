<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Explore extends MY_Controller {
	
	var $business;
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$member = $this->session->userdata('2becomeus_login');
		if (empty($member)) redirect(base_url());
		
		$this->load->model('account_model');
		$this->business = $this->account_model->checkMember($member->member_username);
	}
	
	function index(){
		$this->welcome();
	}
	
	function welcome(){
		$this->load->model('personality_test_model');
		$this->load->model('checkout_model');
		$this->load->library('utils');
		
		$check_order = $this->checkout_model->check_order($this->business->member_id);
		$this->data['check_order'] = $check_order;

		$tipsHubungan = "";
		//$this->load->library('crawl/crawl_hatikupercaya');
		//$tipsHubungan = $this->crawl_hatikupercaya->tagHubungan();
		//$this->data['tipsHubungan'] = $tipsHubungan;
		
		$this->default_param('', array('js/custom/explore.js'));
		$this->load->view('t/explore/welcome_view', $this->data);
	}
	
	function matches(){
		$this->load->model('personality_test_model');
		$this->load->model('checkout_model');
		$this->load->library('utils');
		
		$check_order = $this->checkout_model->check_order($this->business->member_id);
		$this->data['check_order'] = $check_order;
		
		if (!empty($check_order) && $check_order->payment_status == "confirmed"){
		
			$find = $this->input->get_post('find');
		
			$this->data['aliasname'] = "";
			$this->data['iwant'] = "Straight";
			$this->data['age_start'] = "18";
			$this->data['age_end'] = "24";
			$this->data['location'] = "Near me";
			$this->data['must_be_single'] = "1";
			$this->data['religion'] = "";
			$this->data['education'] = "";
			$this->data['job'] = "";
		
			if (empty($find)){
				// =========================================
				// PROSES 1
				$lookingfor = $this->personality_test_model->getLookingFor($this->business->member_id);
				$this->data['lookingfor'] = $lookingfor;
				// =========================================
				
			}else{
				
				// result find ideal patner
				$aliasname = $this->input->get_post('aliasname');
				$iwant = $this->input->get_post('iwant');
				$age_start = $this->input->get_post('age_start');
				$age_end = $this->input->get_post('age_end');
				$location = $this->input->get_post('location');
				$must_be_single = $this->input->get_post('must_be_single');
				$religion = $this->input->get_post('religion');
				$education = $this->input->get_post('education');
				$job = $this->input->get_post('job');
				
				$this->data['aliasname'] = $aliasname;
				$this->data['iwant'] = $iwant;
				$this->data['age_start'] = $age_start;
				$this->data['age_end'] = $age_end;
				$this->data['location'] = $location;
				$this->data['must_be_single'] = $must_be_single;
				$this->data['religion'] = $religion;
				$this->data['education'] = $education;
				$this->data['job'] = $job;

				$lookingfor_currentuser = (array) $this->personality_test_model->getLookingFor($this->business->member_id);
								
				if (!empty($education)) {
					if (in_array("Any", $education)) $education = array_diff($education, array('Any'));
					if (count($education) > 0) $education = implode("/:/", $education);
				}
				if (!empty($job)) {
					if (in_array("Any", $job)) $job = array_diff($job, array('Any'));
					if (count($job) > 0) $job = implode("/:/", $job);
				}				
				if (!empty($religion)) {
					if (in_array("Any", $religion)) $religion = array_diff($religion, array('Any'));
					if (count($religion) > 0) $religion = implode("/:/", $religion);
				}
				
				$lookingfor_data = array(
					'education' => $education,
					'job' => $job,
					'religion' => $religion,
					'location' => $location,
					'must_be_single' => $must_be_single,
					'i_want' => $iwant,
					'ages_start' => $age_start,
					'ages_end' => $age_end,
					'aliasname' => $aliasname
				);
								
				$lookingfor = (Object) array_merge ($lookingfor_currentuser,$lookingfor_data);
								
			}
			
			// =========================================
			// PROSES 2
			$matching = $this->proses2_matching($lookingfor);
			$this->data['matching'] = $matching;
			// =========================================
			
			// =========================================
			// PROSES 3
			$user_personality = $this->proses3_matching($lookingfor, $matching);
			$this->data['user_personality'] = $user_personality;
			// =========================================
		
		}
		
		$this->default_param(
			array(
			'css/datepicker.css',
			'css/jquery.timepicker.css'
			)
			, array(
			'js/datepicker.js',
			'js/jquery.timepicker.js',
			'js/custom/explore.js', 
			'js/custom/step_lookingfor.js'
		));
		$this->load->view('t/explore/matches_view', $this->data);
	}
	
	function proses2_matching($lookingfor){
		$this->load->model('personality_test_model');
		
		// gender
		$gender = ($this->business->member_gender == "male") ? "female" : "male";
		
		// education
		$education_string = "";
		if (!empty($lookingfor->education) && property_exists($lookingfor, "education")){
			$education = explode("/:/", $lookingfor->education);
			if (count($education) == 0){
				$education_string = $education;
			}else{
				$education_string = "'" . implode("','", explode("/:/", $lookingfor->education)) . "'";
			}
		}
		
		// job
		$job_string = "";
		if (!empty($lookingfor->job) && property_exists($lookingfor, "job")){
			$job = explode("/:/", $lookingfor->job);
			if (count($job) == 0){
				$job_string = $job;
			}else{
				$job_string = "'" . implode("','", explode("/:/", $lookingfor->job)) . "'";
			}
		}
		
		// religion
		$religion_string = "";
		if (!empty($lookingfor->religion) && property_exists($lookingfor, "religion")){
			$religion = explode("/:/", $lookingfor->religion);
			if (count($religion) == 0){
				$religion_string = $religion;
			}else{
				$religion_string = "'" . implode("','", explode("/:/", $lookingfor->religion)) . "'";
			}
		}
		
		$location = "";
		if (property_exists($lookingfor, "location") && $lookingfor->location == 'Near me'){
			$location = $this->business->city_name;
		}
		
		$must_be_single = "";
		if (property_exists($lookingfor, "must_be_single") && $lookingfor->must_be_single == 1){
			$must_be_single = "single";
		}
		
		$i_want = "";
		if (property_exists($lookingfor, "i_want") && $lookingfor->i_want == "Straight"){
			$i_want = "straight";
		}
		
		$aliasname = "";
		if (!empty($lookingfor->aliasname) && property_exists($lookingfor, "aliasname")){
			$aliasname = $lookingfor->aliasname;
		}
		
		$matching = $this->personality_test_model->getMatching(array(
			'gender' => $gender,
			'member_id' => $this->business->member_id,
			'education' => $education_string,
			'job' => $job_string,
			'religion' => $religion_string,
			'i_want' => $i_want,
			'ages_start' => $lookingfor->ages_start,
			'ages_end' => $lookingfor->ages_end,
			'location' => $location,
			'must_be_single' => $must_be_single,
			'aliasname' => $aliasname
		));
		//echo $this->db->last_query();
		
		return $matching;
	}
	
	function proses3_matching($lookingfor, $matching){
		$this->load->model('personality_test_model');
		
		$total_score = 50;
		
		$max_score = $this->personality_test_model->searchMaxScore(); // cari dulu max score dari tipe pertanyaan 
		// ambil max score
		$maxscore = array();
		$count_type = count($max_score);
		foreach($max_score as $ms){
			$maxscore[$ms->type_id] = $ms->max_score;
		}
		
		$add_score = $count_type * 10;
		$result_score = $total_score + $add_score;
		
		// current user personality
		$current_user_personality = explode("/:/", $lookingfor->personality);
		$p = array();
		foreach($current_user_personality as $s){
			list($type, $range) = explode("|", $s);
			$p[$type] = $range;
		}
		
		$user_personality = array();
		
		foreach($matching as $m){
			$user_total_score = $this->personality_test_model->userTotalScore($m->member_id);
			$user_personality[$m->member_name] = array();
			
			$total_score = 50;
			
			foreach($user_total_score as $s){
				
				$score = floor( ($s->score / ($s->jml_question * $maxscore[$s->type_id])) * 100 );
				$star = 0;
				if ($score > 0 && $score <= 65){
					$star = "Kurang";
				}else if ($score > 65 && $score <= 80){
					$star = "Rata";
				}else if ($score > 80 && $score <= 100){
					$star = "Sangat";
				}
				
				if ($star == $p[$s->type_name]) $total_score += 10;
				
				
				$user_personality[$m->member_name]['personality_test'][] = array(
					'type' => $s->type_name,
					'range' => $star,
					'score' => $score,
					'total_score_sementara' => $total_score,
					'range_yang_diharapkan' => $p[$s->type_name]
				);
				
				
			}
			
			$point1 = $point2 = 0;
			// point tambahan about
			for($i=1; $i<=10; $i++){
				$about = "about" . $i;
				$point1 += $this->getScoreSimiliarText($this->business->$about, $m->$about);
			}
			
			// point tambahan untuk place / lokasi
			$typeLocations = array("city", "kecamatan", "kelurahan", "province");
			foreach($typeLocations as $loc){
				$location = $loc . "_name";
				$point2 += $this->getScoreSimiliarText($this->business->$location, $m->$location);
			}
			
			$extra_point = round(($point1 + $point2) / 2);
			$total_score += $extra_point;
			
			$ts = round( ($total_score / $result_score) * 100);
			
			$user_personality[$m->member_name]['point1'] = $point1;
			$user_personality[$m->member_name]['point2'] = $point2;
			$user_personality[$m->member_name]['extra_point'] = $extra_point;
			
			$user_personality[$m->member_name]['total_score'] = $ts;
			$user_personality[$m->member_name]['rumus'] = "($total_score / $result_score) * 100";
			$user_personality[$m->member_name]['member'] = array(
				'member_name' => $m->member_name,
				'member_id' => $m->member_id,
				'member_username' => $m->member_username,
				'member_about' => $m->about1,
				'member_photo' => $m->album1,
				'looking_for' => $m->about8,
				'flagged' => $m->flagged,
				'dating_rel' => $m->dating_rel,
				'member_type' => $m->member_type
			);
			
		}
		$user_personality = $this->sorting($user_personality, 'total_score');
		return $user_personality;
	}
	
	function sorting(&$array, $key) {
		$sorter = array();
		$ret = array();
		reset($array);
		foreach ($array as $ii => $va) {
			$sorter[$ii] = $va[$key];
		}
		arsort($sorter);
		foreach ($sorter as $ii => $va) {
			$ret[$ii] = $array[$ii];
		}
		$array = $ret;
		return $array;
	}
	
	function getScoreSimiliarText($str1, $str2){
		$this->load->helper('comparetext');
		$similiar = compare_text($str1, $str2);
		$ts = 0;
		if ($similiar >= 70 && $similiar <= 84){
			$ts = 5;
		}else if ($similiar >= 85 && $similiar <= 100){
			$ts = 10;
		}
		return $ts;
	}

	function setDate(){
		$setdate = $this->input->get_post('setdate');
		if (!empty($setdate) && $setdate == 1){
			$member1 = $this->business->member_id;
			$member2 = $this->input->get_post('member_id');
			$date = $this->input->get_post('dating-date-hdn');
			$time = $this->input->get_post('dating-time');

			$this->load->model('dating_model');
			$datingId = $this->dating_model->setMemberDating($date, $time);
			$this->dating_model->setMemberDateRel($datingId, $member1, $member2);

			// send to email juga

			$this->session->set_userdata('dating_message', "We will send your date request !");
		}
		redirect(base_url() . 'explore/matches');
	}
	
}

?>