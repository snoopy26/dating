<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$member = $this->session->userdata('2becomeus_login');
		if (!empty($member)) redirect(base_url() . "profile/index/" . $member->member_username);
	}
	
	function index(){
		$this->default_param();
		$this->load->view('t/home/index_view', $this->data);
	}

}

?>