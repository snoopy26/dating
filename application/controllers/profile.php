<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	var $business;
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$member = $this->session->userdata('2becomeus_login');
		if (empty($member)) redirect(base_url());
	}
	
	function index($channel = ""){
		$this->load->model('account_model');
		$this->load->model('personality_test_model');
		if (!empty($channel)){
			$this->business = $this->account_model->checkMember($channel);
			if (!empty($this->business)){
				$this->member_profile();
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}
	
	function member_profile(){
		$this->data['member'] = $this->business;
		$this->data['info_name'] = $this->business->member_name;
		
		// personality test
		$this->data['max_score'] = $this->personality_test_model->searchMaxScore(); // cari dulu max score dari tipe pertanyaan 
		$this->data['user_total_score'] = $this->personality_test_model->userTotalScore($this->business->member_id); 
		$this->data['lookingfor'] = $this->personality_test_model->getLookingFor($this->business->member_id);
		
		$this->default_param('', array('js/custom/profile.js'));
		$this->load->view('t/profile/profile_view', $this->data);
	}
	
}

?>