<?php

class Birthday {
	
	function generate_birthdate($from, $to, $callback = FALSE, $current = ""){
		$reverse = FALSE;
		if ($from > $to){
			$tmp = $from;
			$from = $to;
			$to = $tmp;
			$reverse = TRUE;
		}
		$return_string = array();
		for($i=$from; $i<=$to; $i++){
			$selected = "";
			if ($i == $current) $selected = "selected";
			$return_string[] = '<option value="'.$i.'" '.$selected.'>'.($callback ? $this->$callback($i) : $i).'</option>';
		}
		if ($reverse){
			$return_string = array_reverse($return_string);
		}
		return join('', $return_string);
	}
	
	function callback_month($month){
		return date('F', mktime(0,0,0, $month, 1));
	}
	
	
}

?>