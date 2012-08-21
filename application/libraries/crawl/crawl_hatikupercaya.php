<?php

// parse DOM
include_once "simple_html_dom.php";

// class crawl
class Crawl_hatikupercaya{
	
	var $urlTagHubungan = "http://www.hatikupercaya.com/hubungan/";
	
	var $cookie_file;
	var $ch;
	function __construct(){
		$this->cookie_file = tempnam('/tmp', 'cookie');
		$this->ch = curl_init();
	}
	
	function getHTML($url){
		$url = $url;
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_HEADER, 1);  
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($this->ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5');
		//  ===> Special Thanks to Ricky Winata
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie_file);
		$contents = curl_exec($this->ch);
		$info = curl_getinfo($this->ch);
		return $contents;
	}
	
	function getHTMLAjax($url){
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_HEADER, 1);  
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($this->ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5');
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
			'X-Requested-With: XMLHttpRequest'
		));
		$contents = curl_exec($this->ch);
		$info = curl_getinfo($this->ch);
		return $contents;
	}

	function tagHubungan(){
		$contents = $this->getHTML($this->urlTagHubungan);
		$html = get_dom($contents);
		$return = array();
		if (!empty($contents)){
			foreach($html->find('#listarticle ul li') as $parent){
				$image = current($parent->find('img'))->src;
				$t = current($parent->find('#title_8 a'));
				$urlTitle = "http://www.hatikupercaya.com" . $t->href;
				$title = $t->innertext;
				$t = current($parent->find('#listdeskripsi'));
				$detail = $t->innertext;
	
				$contentDetail = $this->getHTML("http://www.hatikupercaya.com/" . $urlTitle);
				$htmlDetail = get_dom($contentDetail);
				$detail_full = "";
				if (!empty($contents)) $detail_full = current($htmlDetail->find('#contentwriting'))->plaintext;

				$return[] = array(
					'image' => $image,
					'urlTitle' => $urlTitle,
					'title' => $title,
					'detail' => $detail,
					'detail_full' => $detail_full
				);
			}
		}
		return $return;
	}

}

?>