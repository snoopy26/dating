<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	var $business;
	var $session_business;
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$member = $this->session->userdata('2becomeus_login');
		$this->session_business = $member;
		$this->data['session_business'] = $this->session_business;
		if (empty($member)) redirect(base_url());
	}
	
	function index($channel = ""){
		$this->load->model('account_model');
		$this->load->model('personality_test_model');
		if (!empty($channel)){
			$this->business = $this->account_model->checkMember($channel);
			if (!empty($this->business)){

				$this->load->model('checkout_model');				
				$check_order = $this->checkout_model->check_order($this->session_business->member_id);
				
				if ($channel == $this->session_business->member_username) {
					$this->member_profile();
				}else{

					if (!empty($check_order) && $check_order->payment_status == "confirmed"){
						$this->member_profile();
					}else{
						show_404();
					}

				}

			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}
	
	function member_profile(){
		$this->load->model('message_model');
		
		$this->data['member'] = $this->business;
		$this->data['info_name'] = $this->business->member_name;
		
		// personality test
		$this->data['max_score'] = $this->personality_test_model->searchMaxScore(); // cari dulu max score dari tipe pertanyaan 
		$this->data['user_total_score'] = $this->personality_test_model->userTotalScore($this->business->member_id); 
		$this->data['lookingfor'] = $this->personality_test_model->getLookingFor($this->business->member_id);
		if ($this->session_business->member_id != $this->business->member_id){
			$this->data['currentuser_total_score'] = $this->personality_test_model->userTotalScore($this->session_business->member_id); 
			$this->data['getSayHelloSelectedUser'] = $this->message_model->getSayHelloSelectedUser($this->session_business->member_id, $this->business->member_id);
			$this->data['sessionMemberBusiness'] = $this->account_model->checkMember($this->session_business->member_id);
			$sessionLookingfor = $this->personality_test_model->getLookingFor($this->session_business->member_id);
			$this->data['sessionLookingfor'] = $sessionLookingfor;
			$x = explode("/:/", $sessionLookingfor->personality);
			$personality_diff = array();
			foreach ($x as $key => $value) {
				list($k, $v) = explode("|", $value);
				$personality_diff[$k] = $v; 
			}
			$this->data['personality_diff'] = $personality_diff;
		}
		
		// kiss message
		$this->data['options_kiss'] = $this->message_model->getOptionKiss();
		
		$this->default_param('', array('js/custom/profile.js'));
		$this->load->view('t/profile/profile_view', $this->data);
	}
	
	function sendsayhello(){
		if ($this->input->get_post('say') == 1){
			$kiss = $this->input->get_post('kiss');
			$member_id = $this->session_business->member_id;
			$mid = $this->input->get_post('mid');
			$this->load->model('message_model');
			$this->load->model('account_model');
			$this->message_model->sendSayHello($kiss, $member_id, $mid);
			$this->session->set_userdata('sayhello', 'Say Hello Submitted!');
			$business = $this->account_model->checkMember($mid);
			redirect(base_url() . 'profile/index/' . $business->member_username);
		}
	}
	
}

?>