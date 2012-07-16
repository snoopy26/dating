<?php

class Filemanager {
	
	var $CI;
	var $type;
	var $size_type = array(
		array('size' => '250x380', 'type' => 'adaptiveResize'),
		array('size' => '195x380', 'type' => 'adaptiveResize'),
		array('size' => '167x111', 'type' => 'cropFromCenter'),
		array('size' => '94x66', 'type' => 'adaptiveResize'),
		array('size' => '35x35', 'type' => 'adaptiveResize'),
		array('size' => '130x116', 'type' => 'adaptiveResize'),
		array('size' => '960x425', 'type' => 'resize'),
		array('size' => '370x380', 'type' => 'adaptiveResize'),
		array('size' => '102x158', 'type' => 'adaptiveResize'),
		array('size' => '1170x300', 'type' => 'adaptiveResize'),
		array('size' => '75x75', 'type' => 'adaptiveResize'),
		array('size' => '600x500', 'type' => 'adaptiveResize'),
		array('size' => '160x120', 'type' => 'adaptiveResize'),
		array('size' => '300x200', 'type' => 'adaptiveResize'),
		array('size' => '1000x500', 'type' => 'resize'),
		array('size' => '300x300', 'type' => 'resize')
	);

	
	function Filemanager(){
		$this->CI =& get_instance();
		$this->CI->load->library('generatephpthumb');
	}
	
	function getPath($filename = "", $size = "", $resize_again = FALSE){
		$source = 'images';
		if (!empty($filename)){
			list($getType, $getAdd) = explode("-", $filename);
			if (!empty($getType)){
				$folder = $getType;
				$folder1 = $getAdd[0];
				$folder2 = $getAdd[1];
				$gen_filename = substr($filename, 0, strlen($filename)-4);
				$type_filename = substr($filename, strlen($filename)-4, strlen($filename));
				$ori_source_file = $source .'/'. $folder .'/'. $folder1 .'/'. $folder2 .'/'. $filename; 
				$gen_source_file = $source .'/'. $folder .'/'. $folder1 .'/'. $folder2 .'/'. $gen_filename .'_'. $size . $type_filename; 				
			}
		}else{
			
			$folder = 'default';
			$folder1 = $folder[0];
			$folder2 = $folder[1];
			$filename = 'default-default.jpg';
			$gen_filename = substr($filename, 0, strlen($filename)-4);
			$type_filename = substr($filename, strlen($filename)-4, strlen($filename));
			$ori_source_file = $source .'/'. $folder .'/'. $folder1 .'/'. $folder2 .'/'. $filename; 
			$gen_source_file = $source .'/'. $folder .'/'. $folder1 .'/'. $folder2 .'/'. $gen_filename .'_'. $size . $type_filename; 
			
		}
	
		foreach($this->size_type as $t){
			if ($t['size'] == $size){
				list($width, $height) = explode('x', $t['size']);
				$type = $t['type'];
				$this->generate($gen_source_file, $ori_source_file, $width, $height, $type, $resize_again);
				break;
			}
		}
		
		/*
		if ($size == 'bq'){
			$this->generate($gen_source_file, $ori_source_file, 250, 380, "adaptiveResize", $resize_again);
		}else if ($size == 'bq195'){
			$this->generate($gen_source_file, $ori_source_file, 195, 380, "adaptiveResize", $resize_again);
		}else if ($size == 'mq'){
			$this->generate($gen_source_file, $ori_source_file, 167, 111, "cropFromCenter", $resize_again);
		}else if ($size == 'sq'){
			$this->generate($gen_source_file, $ori_source_file, 94, 66, "adaptiveResize", $resize_again);
		}else if ($size == 'sq35'){
			$this->generate($gen_source_file, $ori_source_file, 35, 35, "adaptiveResize", $resize_again);
		}else if ($size == 'mq130'){
			$this->generate($gen_source_file, $ori_source_file, 130, 116, "adaptiveResize", $resize_again);
		}else if ($size == 'bg960'){
			$this->generate($gen_source_file, $ori_source_file, 960, 425, "resize", $resize_again);
		}else if ($size == 'bg370'){
			$this->generate($gen_source_file, $ori_source_file, 370, 380, "adaptiveResize", $resize_again);
		}else if ($size == 'sq102x158'){
			$this->generate($gen_source_file, $ori_source_file, 102, 158, "adaptiveResize", $resize_again);
		}
		*/
		
		
		return cdn_url() . $gen_source_file;

	}
	
	function generate($source_file, $ori_source_file, $width, $height, $type, $generate_again = FALSE){
		//echo $source_file . "<br />";
		if (file_exists($source_file)){
			//echo "OK ada. <br />";
			
			if ($generate_again == TRUE){
				$gallery_path = "./" . $source_file;
				$this->CI->generatephpthumb->generate($type, $ori_source_file, $width, $height, 0, 0, 0, $gallery_path, 'jpg');
			}
			
			//echo "<img src='".BASE_URL."$source_file' />";
		}else{
			// buat file 
			//echo "OK Buat baru ya. <br />";
			$gallery_path = "./" . $source_file;
			$this->CI->generatephpthumb->generate($type, $ori_source_file, $width, $height, 0, 0, 0, $gallery_path, 'jpg');
			//echo "<img src='".BASE_URL."$source_file' />";
		}
	}
	
}

?>