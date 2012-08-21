<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dating extends MY_Controller {

	var $business;
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$member = $this->session->userdata('2becomeus_login');
		if (empty($member)) redirect(base_url());
		
		$this->load->model('account_model');
		$this->business = $this->account_model->checkMember($member->member_username);
	}
	
	function lists(){
		$this->load->model('checkout_model');
		$check_order = $this->checkout_model->check_order($this->business->member_id);
		$this->data['check_order'] = $check_order;

		$this->load->model('dating_model');
		$lists = $this->dating_model->listDate($this->business->member_id);
		$this->data['lists'] = $lists;

		$this->default_param(
			array(
			'css/datepicker.css',
			'css/jquery.timepicker.css'
			)
			, array(
			'js/datepicker.js',
			'js/jquery.timepicker.js',
			'js/custom/explore.js', 
			'js/custom/dating.js', 
			'js/custom/step_lookingfor.js'
		));
		$this->load->view('t/dating/lists_view', $this->data);

	}

	function changeDate(){
		$this->load->model('dating_model');
		$submit = $this->input->get_post('setdate');
		if ($submit == 1){	
			$dating_id = $this->input->get_post('dating_id');
			$member_id = $this->business->member_id;
			$date = $this->input->get_post('dating-date-hdn');
			$time = $this->input->get_post('dating-time');
			$datetime = strftime("%a, %d %b %Y, %H : %M", strtotime($date . " " . $time));
			$detail = $this->business->member_username . " ingin merubah tanggal dating menjadi " . $datetime . ". Bagaimana kamu menresponse ini ?";
			$this->dating_model->changeDate($dating_id, $member_id, $date, $time, $detail);
		}

		redirect(base_url() . "dating/lists");

	}

}

?>