<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function signup(){
		// kalau uda login, langsung ke profile
		$member = $this->session->userdata('2becomeus_login');
		if (!empty($member)) redirect(base_url() . "profile/index/" . $member->member_username);
		
		$this->load->model('address_model');
		$this->load->library('birthday');
		
		// generate province
		$this->data['province'] = $this->address_model->address_province("id");
		
		$this->default_param(
			'',
			array(
				'js/custom/auth.js'
			)
		);
		$this->load->view('t/auth/signup_view', $this->data);
	}
	
	function process_signup(){
		if ($this->input->get_post('btn_submit') == 1){
			
			$this->load->library('validate');
			$this->load->library('utils');
			$this->load->library('send_email');
			$this->load->model('account_model');
			
			$gender = $this->input->get_post('gender');
			$this->session->set_userdata('signup_gender', $gender);
			
			$interest = $this->input->get_post('interest');
			$this->session->set_userdata('signup_interest', $interest);
			
			$status = $this->input->get_post('status');
			$this->session->set_userdata('signup_status', $status);
			
			// birthday
			$birthdate_month = $this->input->get_post('month');
			$this->session->set_userdata('signup_month', $birthdate_month);
			$birthdate_day = $this->input->get_post('day');
			$this->session->set_userdata('signup_day', $birthdate_day);
			$birthdate_year = $this->input->get_post('year');
			$this->session->set_userdata('signup_year', $birthdate_year);
			$birthday = $birthdate_year.'-'.$birthdate_month.'-'.$birthdate_day;
			
			$country = "id";
			
			$province = $this->input->get_post('province');
			$this->session->set_userdata('signup_province', $province);
			
			$kabupaten = $this->input->get_post('kabupaten');
			$kecamatan = $this->input->get_post('kecamatan');
			$kelurahan = $this->input->get_post('kelurahan');
			
			$phone_number = $this->input->get_post('phone_number');
			$this->session->set_userdata('signup_phone_number', $phone_number);
			
			$name = $this->input->get_post('name');
			$this->session->set_userdata('signup_name', $name);
			
			$email = $this->input->get_post('email');
			$confirm_email = $this->input->get_post('confirm_email');
			$this->session->set_userdata('signup_email', $email);
			$isEmailTaken = $this->account_model->isEmailTaken($email);
			
			$username = $this->input->get_post('username');
			$this->session->set_userdata('signup_username', $username);
			$isUsernameTaken = $this->account_model->isUsernameTaken($username);
			
			$password = $this->input->get_post('password');
			
			$captcha = $this->input->get_post('captcha');
			
			$errors = array();
			if ($province == 0){
				$errors['province_error'] = "Pilih nama province anda.";
			}
			if ($kabupaten == 0){
				$errors['kabupaten_error'] = "Pilih nama kabupaten anda.";
			}
			if ($kecamatan == 0){
				$errors['kecamatan_error'] = "Pilih nama kecamatan anda.";
			}
			if ($kelurahan == 0){
				$errors['kelurahan_error'] = "Pilih nama kelurahan anda.";
			}
			if (is_numeric($phone_number) == FALSE){
				$errors['phone_number_error'] = "Ada kesalahan format dalam penulisan phone number.";
			}
			if ($this->validate->validateName($name) == 1){
				$errors['name_error'] = "Ada kesalahan format dalam penulisan name.";
			}
			if ($this->validate->validateEmail($email) == 1){
				$errors['email_error'] = "Ada kesalahan format dalam penulisan email.";
			}else
			// cek email taken
			if (!empty($isEmailTaken)){
				$errors['email_error'] = "Email ini telah di pakai oleh seseorang.";
			}	
			
			
			if ($email != $confirm_email){
				$errors['confirm_email_error'] = "Ada perbedaan penulisan confirm email dan email yang anda tulis.";
			}
			
			if ($this->validate->validateUsername($username) == 1){
				$errors['username_error'] = "Ada kesalahan format dalam penulisan username.";
			}else
			// cek username taken
			if (!empty($isUsernameTaken)){
				$errors['username_error'] = "Username ini telah di pakai oleh seseorang.";
			}	
			
			
			if ($this->validate->validatePassword($password) == 1){
				$errors['password_error'] = "Ada kesalahan format dalam penulisan password.";
			}
			
			if ($captcha != $this->session->userdata('cap_code')){
				$errors['captcha_error'] = "Kode Captcha yang anda tulis tidak sama.";
			}
			
			if (!empty($errors)){
				$this->session->set_userdata('errors_signup', $errors);
			}else{
				// do something
				// insert database
				//exit;
				
				$email_code = $this->utils->create_code(6, 'number');
				
				$this->account_model->addNewAccount(
					$name,
					$username,
					$email,
					sha1(SALT . $password),
					$phone_number,
					$country,
					$province,
					$kecamatan,
					$kelurahan,
					$kabupaten,
					$birthday,
					$status,
					$interest,
					$gender,
					0,
					$email_code,
					0
				);
				
				// send email
				$code = sha1(SALT . $email_code);
				$this->send_email->sendEmailFinishRegister($name, $email, "Verifikasi email", base_url() . "c?ty=ve&code=" . $code . "&key=" . $email_code);
				
				// delete session
				$this->session->unset_userdata('errors_signup');
				$this->session->unset_userdata('signup_gender');
				$this->session->unset_userdata('signup_interest');
				$this->session->unset_userdata('signup_status');
				$this->session->unset_userdata('signup_month');
				$this->session->unset_userdata('signup_day');
				$this->session->unset_userdata('signup_year');
				$this->session->unset_userdata('signup_province');
				$this->session->unset_userdata('signup_phone_number');
				$this->session->unset_userdata('signup_name');
				$this->session->unset_userdata('signup_username');
				$this->session->unset_userdata('signup_email');
				
				
				// redirect
				redirect(base_url() . 'auth/signup_confirmation');
				
			}
			
		}
		redirect(base_url() . "auth/signup");
	}
	
	function signup_confirmation(){
		$this->default_param();
		$this->load->view('t/auth/signup_confirmation_view', $this->data);
	}
	
	function captcha(){
		$ran_str = md5(microtime());
		$ran_str = substr($ran_str, 0, 5);
		$this->session->set_userdata('cap_code', $ran_str);
		$new_image = imagecreatefromgif("img/emptycaptcha.gif");
		$text_color = imagecolorallocate($new_image, 0, 0, 0);
		$grey = imagecolorallocate($new_image, 128, 128, 128);
		//imageline($new_image, 0, 13, 70, 13, $grey);
		imagestring($new_image, 5,5,5, $ran_str, $text_color);
		header("Content-type:image/jpeg");
		imagejpeg($new_image);
	}
	
	function signin(){
		// kalau uda login, langsung ke profile
		$member = $this->session->userdata('2becomeus_login');
		if (!empty($member)) redirect(base_url() . "profile/index/" . $member->member_username);
		
		$this->default_param();
		$this->load->view('t/auth/signin_view', $this->data);
	}
	
	function process_signin(){
		if ($this->input->get_post('btn-sign-in') == 1){
			$this->load->model('account_model');
			$email = $this->input->get_post('email');
			$password = sha1(SALT . $this->input->get_post('password'));
			$member = $this->account_model->checkAccount($email, $password);
			if (!empty($member)){
				if ($member->step == 5){
					// ok
					$this->session->set_userdata('2becomeus_login', $member);
					redirect(base_url() . "profile/index/" . $member->member_username);
				}else{
					//http://ww.dating.com:8080/c?ty=ve&code=1aa11e8650226bc709843240e944cb201e6d71f4&key=787499
					$key = $member->email_code;
					$code = sha1(SALT . $key);
					redirect(base_url() . "c?ty=ve&code=" . $code . "&key=" . $key);
				}
			}else{
				// error
				$this->session->set_userdata('errors_signin', "1");
			}
		}
		redirect(base_url() . 'auth/signin');
	}
	
	function signout(){
		$this->session->unset_userdata('2becomeus_login');
		redirect(base_url());
	}
	
}

?>