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
		$this->load->model('personality_test_model');
		$this->load->model('checkout_model');
		$this->load->library('utils');
		
		$check_order = $this->checkout_model->check_order($this->business->member_id);
		$this->data['check_order'] = $check_order;
		
		if (!empty($check_order) && $check_order->payment_status == "confirmed"){
		
			// =========================================
			// PROSES 1
			$lookingfor = $this->personality_test_model->getLookingFor($this->business->member_id);
			$this->data['lookingfor'] = $lookingfor;
			// =========================================
			
			
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
		
		$this->default_param('', array('js/custom/explore.js'));
		$this->load->view('t/explore/tmp_explore_view', $this->data);
	}
	
	function proses2_matching($lookingfor){
		$this->load->model('personality_test_model');
		
		// education
		$education = explode("/:/", $lookingfor->education);
		if (count($education) == 0){
			$education_string = $education;
		}else{
			$education_string = "'" . implode("','", explode("/:/", $lookingfor->education)) . "'";
		}
		
		// job
		$job = explode("/:/", $lookingfor->job);
		if (count($job) == 0){
			$job_string = $job;
		}else{
			$job_string = "'" . implode("','", explode("/:/", $lookingfor->job)) . "'";
		}
		
		// religion
		$religion = explode("/:/", $lookingfor->religion);
		if (count($religion) == 0){
			$religion_string = $religion;
		}else{
			$religion_string = "'" . implode("','", explode("/:/", $lookingfor->religion)) . "'";
		}
		
		$location = "";
		if ($lookingfor->location == 'Near me'){
			$location = $this->business->city_name;
		}
		
		$must_be_single = "";
		if ($lookingfor->must_be_single == 1){
			$must_be_single = "single";
		}
		
		$i_want = "";
		if ($lookingfor->i_want == "Straight"){
			$i_want = "straight";
		}
		
		$matching = $this->personality_test_model->getMatching(array(
			'member_id' => $this->business->member_id,
			'education' => $education_string,
			'job' => $job_string,
			'religion' => $religion_string,
			'i_want' => $i_want,
			'ages_start' => $lookingfor->ages_start,
			'ages_end' => $lookingfor->ages_end,
			'location' => $location,
			'must_be_single' => $must_be_single
		));
		echo $this->db->last_query();
		
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
				'member_photo' => $m->album1
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
	
}

?>