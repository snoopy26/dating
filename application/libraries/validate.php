<?php

	class Validate{

		public $CI;
		
		function Validate(){
			$this->CI =& get_instance();
		}
		
		function validateUsername($Username){
			if (!preg_match('/^[A-Za-z0-9_]{5,15}$/', $Username)) return 1;
			else return 0;
		}
		
		function validatePassword($Password){
			if (!preg_match('/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/', $Password)) return 1;
			else return 0;
		}
			
		function validateName($Name){
			if (!preg_match('/^[A-Za-z0-9 ]{5,20}$/', $Name)) return 1;
			else return 0;
		}
		
		function validateEmail($Email){
			if (!preg_match('/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i', $Email)) return 1;
			else return 0;
		}
		
	}

?>