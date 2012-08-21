<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	var $data = array();
	var $ismobile = FALSE;
	
	function __construct(){
		parent::__construct();
		$this->data['css_tags'] = array();
		$this->data['js_tags'] = array();
		
		// for smartphone
		//$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		//if(stripos($ua,'android') !== false ||
		//strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || 
		//strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) { // && stripos($ua,'mobile') !== false) {
		if ($this->detect_mobile() === TRUE){
			$this->ismobile = TRUE;
		}

		// count member dating
		$this->member_dating();
	}
	
	function detect_mobile(){
		if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
			return true;
		else
			return false;
	}
	
	function default_param($css = array(), $js = array(), $others = array()){
		$this->data['title_header'] = "TwoBecome.us - Premium Dating Online Site";
		if (!empty($others['title_header'])) $this->data['title_header'] = $others['title_header'] . ' | ' . $this->data['title_header'];
		
		$default_css = array(
			'css/bootstrap.css',
			'css/bootstrap-responsive.css',
			'css/twobecomeus.css'
		);
		
		if (!empty($css)) $css = array_merge($default_css, $css);
		else $css = $default_css;
		
		$default_js = array(
			'js/jquery.js',
			'js/bootstrap.min.js',
			'js/jquery.easing-1.3.pack.js'
		);
		
		if (!empty($js)) $js = array_merge($default_js, $js);
		else $js = $default_js;
		
		$this->data['css_tags'] = cdn_url() . 'min/?f=' . implode(',', $css);
		$this->data['js_tags'] = cdn_url() . 'min/?f=' . implode(',', $js);
	}

	function member_dating(){
		$this->load->model('dating_model');
		$member = $this->session->userdata('2becomeus_login');
		$countDating = 0;
		if (!empty($member)) $countDating = $this->dating_model->countDating($member->member_id)->count_dating;
		$this->data['countDating'] = $countDating;
	}

}

?>