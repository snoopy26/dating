<?php

require_once 'phpthumb2/ThumbLib.inc.php';

class Generatephpthumb{
	
	function generate($type = "resize", $path, $w, $h, $x, $y, $derajat, $save_path, $format){
		try{
			$thumb = PhpThumbFactory::create($path);
		}catch(Exception $e){
			echo 'Error';
		}
		
		switch($type){
			case 'resize': $thumb->resize($w, $h);break;
			case 'resizePercent': $thumb->resizePercent($w);break;
			case 'adaptiveResize': $thumb->adaptiveResize($w, $h);break;
			case 'cropFromCenter': $thumb->cropFromCenter($w, $h);break;
			case 'cropFromCenterSquare': $thumb->cropFromCenter($w);break;
			case 'cropFromCenterVanilla': $thumb->crop($w, $h, $x, $y);break;
			case 'rotateImageCW': $thumb->rotateImage("CW");break;
			case 'rotateImageCCW': $thumb->rotateImage("CCW");break;
			case 'rotateImageNDegrees': $thumb->rotateImageNDegrees($derajat);break;
		}
		
		//$thumb->show();
		$thumb->save($save_path, $format);
		
	}
	
}

?>