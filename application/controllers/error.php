<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller {
	
	function notfound(){
		$this->default_param();
		$this->load->view("t/error/notfound_view", $this->data);
	}
	
}

?>