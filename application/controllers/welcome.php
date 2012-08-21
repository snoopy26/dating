<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	function crawlHatikupercaya(){
		$this->load->library('crawl/crawl_hatikupercaya');
		$r = $this->crawl_hatikupercaya->tagHubungan();
		echo '<pre>';
		print_r($r);
		echo '</pre>';
	}

	function cekSimiliar(){
		$this->load->helper('comparetext');
		$str1 = "Helo Anton";
		$str2 = "Helo Antoni";
		$similiar = compare_text($str1, $str2);
		echo $similiar;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */