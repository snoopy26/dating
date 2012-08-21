<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends MY_Controller {

	var $business;
	var $session_business;
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$this->load->model('account_model');
		$member = $this->session->userdata('2becomeus_login');
		$this->session_business = $member;
		$this->data['session_business'] = $this->session_business;
		$this->business = $this->account_model->checkMember($this->session_business->member_id);
		if (empty($member)) redirect(base_url());
	}

	function sayhello(){
		$this->load->model('message_model');

		$msid = $this->input->get_post('msid');

		if (empty($msid)){
			$getSayHello = $this->message_model->getSayHello($this->business->member_id, 0, 10);
			$view = 't/activity/sayhello_view';
			$script = array('js/jquery.masonry.min.js', 'js/stickyMojo.js', 'js/custom/activity_sayhello.js');
		}else{
			$getSayHello = $this->message_model->getKissMessageDetail($msid);
			$view = 't/activity/sayhello_detail_view';
			$script = array('js/custom/activity_sayhello_detail.js');
		}

		$this->data['getSayHello'] = $getSayHello;
		
		$this->default_param('', $script);
		$this->load->view($view, $this->data);
	}

	function flag(){
		$this->load->model('flag_model');
		$flags = $this->flag_model->getFlags($this->business->member_id);
		$this->data['flags'] = $flags;

		$view = 't/activity/flag_view';
		$this->default_param('', array('js/custom/activity_flag.js'));
		$this->load->view($view, $this->data);
	}

}

?>