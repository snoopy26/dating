<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	var $business;
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
	}
	
	function index(){
		$this->default_param();
		$this->load->view('admincs/home/home_view', $this->data);
	}
	
	function search($type = "order", $q = ""){
		
		if (empty($q)){
			$q = $this->input->get_post('q');
		}else{
			if ($type == 'order'){
				$q = "#" . $q;
			}
		}
		
		if ($type == "user"){
			$type = "2";
		}else{
			$type = 0;
			if ($q[0] == "#"){
				$type = "1";
			}
		}
		
		$this->data['type'] = $type;
		
		$this->load->model('cs_search');
		$results = $this->cs_search->getSearch($q, $type);
		$this->data['results'] = $results;
		$this->data['q'] = $q;
		
		$this->default_param('', array('js/custom/cs_search.js'));
		$this->load->view('admincs/search/search_view', $this->data);
		
	}

}

?>