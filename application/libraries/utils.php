<?php

class Utils{

	function create_captcha(){
		$ran_str = md5(microtime());
		$ran_str = substr($ran_str, 0, 5);
		$this->session->set_userdata('cap_code', $ran_str);
		$new_image = imagecreatefromgif(cdn_url() . "img/emptycaptcha.gif");
		$text_color = imagecolorallocate($new_image, 0, 0, 0);
		$grey = imagecolorallocate($new_image, 128, 128, 128);
		//imageline($new_image, 0, 13, 70, 13, $grey);
		imagestring($new_image, 5,5,5, $ran_str, $text_color);
		header("Content-type:image/jpeg");
		imagejpeg($new_image);
	}
	
	function create_code( $length = 7, $type = 'text' ) {
		if( $type == 'number' ) $chars = "023456789";
		else $chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i < $length) {
			$num = rand() % strlen($chars);
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	
	function clean($input) {

		$search = array(
			'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
			'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
			'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
			'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
		);

		$output = preg_replace($search, '', $input);
		return $output;
	}
	
}

?>