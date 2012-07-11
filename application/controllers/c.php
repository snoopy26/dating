<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$member = $this->session->userdata('2becomeus_login');
		if (!empty($member)) redirect(base_url() . "profile/index/" . $member->member_username);
	}
	
	function index(){
		
		$type = $this->input->get_post('ty');
		
		// verifikasi email => signup
		if ($type == "ve"){
			$this->ve();
		}else{
			show_404();
		}
		
	}
	
	function ve(){
		$this->load->model('account_model');
		
		$type = $this->input->get_post('ty');
		$code = $this->input->get_post('code');
		$key = $this->input->get_post('key');
		$step = $this->input->get_post('step');
		
		$member = $this->account_model->checkKey($key);
		$code_key = sha1(SALT . $key);
		
		// klw sudah aktif gag boleh masuk
		if ($member->active == 1 && $member->email_verify == 1) show_404();
		
		// jika salah semua dalam type, key, code gag boleh masuk
		if (empty($type) || empty($code) || empty($key) || empty($member) || $code_key != $code){
			show_404();
		}else{
			
			$this->data['code'] = $code;
			$this->data['key'] = $key;
			$this->data['member'] = $member;
			
			// save to session
			$this->session->set_userdata('member_twobecomeus', $member);
			
			if (empty($member->step)){
				$this->data['current_menu'] = 'about';
				$this->default_param();
				$this->load->view('t/auth/step1_view', $this->data);
			}else if ($member->step == 1){
				$this->data['current_menu'] = 'details';
				$this->default_param();
				$this->load->view('t/auth/step2_view', $this->data);
			}else if ($member->step == 2){
				$this->data['current_menu'] = 'design';
				
				// ambil gambar
				$this->member_photo();
				
				$this->default_param('',array('js/jquery.form.js', 'js/custom/step3.js'));
				$this->load->view('t/auth/step3_view', $this->data);
			}else if ($member->step == 3){
				$this->data['current_menu'] = 'looking for';
				
				// looking for
				$this->lookingfor();
				
				$this->default_param();
				$this->load->view('t/auth/step6_view', $this->data);
			}else if ($member->step == 4){
				$this->data['current_menu'] = 'questions';
				
				// ambil questions
				$this->member_questions();
				
				$this->default_param('', array('js/custom/carousel.js', 'js/custom/step4.js'));
				$this->load->view('t/auth/step4_view', $this->data);
			}else if ($member->step == 5){
				$this->data['current_menu'] = 'finish';
				
				$this->default_param();
				$this->load->view('t/auth/step5_view', $this->data);
			}
			
		}
	}
	
	function process_about(){
		$code = $this->input->get_post('code');
		$key = $this->input->get_post('key');
		if ($this->input->get_post('btn_submit') == 1){
			$this->load->model('account_model');
		
			$member = $this->account_model->checkKey($key);
			$code_key = sha1(SALT . $key);
			
			if (!empty($code) && !empty($key) && !empty($member) && $code_key == $code){
				
				$about1 = $this->input->get_post('about1');
				$about2 = $this->input->get_post('about2');
				$about3 = $this->input->get_post('about3');
				
				$about4 = $this->input->get_post('about4');
				$about5 = $this->input->get_post('about5');
				$about6 = $this->input->get_post('about6');
				
				$about7 = $this->input->get_post('about7');
				//$about8 = $this->input->get_post('about8');
				$about9 = $this->input->get_post('about9');
				
				$about10 = $this->input->get_post('about10');
				
				$errors = array();
				
				if (empty($about1)){
					$errors['about1_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($about2)){
					$errors['about2_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($about3)){
					$errors['about3_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (empty($about4)){
					$errors['about4_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($about5)){
					$errors['about5_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($about6)){
					$errors['about6_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (empty($about7)){
					$errors['about7_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				/*
				if (empty($about8)){
					$errors['about8_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				*/
				if (empty($about9)){
					$errors['about9_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (empty($about10)){
					$errors['about10_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (!empty($errors)){
					$this->session->set_userdata('errors_about', $errors);
					
					$this->session->set_userdata('about1', $about1);
					$this->session->set_userdata('about2', $about2);
					$this->session->set_userdata('about3', $about3);
					$this->session->set_userdata('about4', $about4);
					$this->session->set_userdata('about5', $about5);
					$this->session->set_userdata('about6', $about6);
					$this->session->set_userdata('about7', $about7);
					$this->session->set_userdata('about9', $about9);
					$this->session->set_userdata('about10', $about10);
				}else{
					
					// insert to db
					$this->account_model->insertUserAbout(
						$member->member_id,
						
						$about1,
						$about2,
						$about3,
						
						$about4,
						$about5,
						$about6,
						
						$about7,
						//$about8,
						$about9,
						
						$about10
					);
					// update step current user => step next
					$this->account_model->updateUserStep($member->member_id, 1);
					
				}
				
			}
		}
		redirect(base_url() . "c?ty=ve&code=" . $code . "&key=" . $key);
	}
	
	function process_detail(){
		$code = $this->input->get_post('code');
		$key = $this->input->get_post('key');
		if ($this->input->get_post('btn_submit') == 1){
			$this->load->model('account_model');
		
			$member = $this->account_model->checkKey($key);
			$code_key = sha1(SALT . $key);
			
			if (!empty($code) && !empty($key) && !empty($member) && $code_key == $code){
				
				$height = $this->input->get_post('height');
				$body_type = $this->input->get_post('body_type');
				$smokes = $this->input->get_post('smokes');
				
				$drinks = $this->input->get_post('drinks');
				$drugs = $this->input->get_post('drugs');
				$religion = $this->input->get_post('religion');
				
				$education = $this->input->get_post('education');
				$job = $this->input->get_post('job');
				$income = $this->input->get_post('income');
				
				$errors = array();
				
				if (empty($height)){
					$errors['height_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				/*
				else
				if ($height <= 100){
					$errors['height_error'] = "Tinggi badan anda seharusnya > 100cm.";
				}
				*/
				
				if (empty($body_type)){
					$errors['body_type_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (empty($smokes)){
					$errors['smokes_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($drinks)){
					$errors['drinks_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($religion)){
					$errors['religion_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (empty($education)){
					$errors['education_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($job)){
					$errors['job_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($income)){
					$errors['income_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (!empty($errors)){
					$this->session->set_userdata('errors_detail', $errors);
					
					$this->session->set_userdata('height', $height);
					$this->session->set_userdata('body_type', $body_type);
					$this->session->set_userdata('smokes', $smokes);
					$this->session->set_userdata('drinks', $drinks);
					$this->session->set_userdata('religion', $religion);
					$this->session->set_userdata('education', $education);
					$this->session->set_userdata('job', $job);
					$this->session->set_userdata('income', $income);
				}else{
					
					// insert to db
					$this->account_model->insertUserDetail(
						$member->member_id,
						
						$height,
						$body_type,
						$smokes,
						
						$drinks,
						$drugs,
						$religion,
						
						$education,
						$job,
						$income
					);
					// update step current user => step next
					$this->account_model->updateUserStep($member->member_id, 2);
					
				}
				
			}
		}
		redirect(base_url() . "c?ty=ve&code=" . $code . "&key=" . $key);
	}
	
	function process_design(){
		$code = $this->input->get_post('code');
		$key = $this->input->get_post('key');
		if ($this->input->get_post('btn_submit') == 1){
			$this->load->model('account_model');
			$member = $this->account_model->checkKey($key);
			$code_key = sha1(SALT . $key);
			
			if (!empty($code) && !empty($key) && !empty($member) && $code_key == $code){
				
				$member_photos = $this->account_model->getUserPhoto($member->member_id);
				
				// check cover
				$valid = 0;
				if (!empty($member_photos->album1)) $valid++;
				if (!empty($member_photos->album2)) $valid++;
				if (!empty($member_photos->album3)) $valid++;
				if (!empty($member_photos->album4)) $valid++;
				
				if ($valid >= 4){
					// update step current user => step next
					$this->account_model->updateUserStep($member->member_id, 3);
				}else{
					$errors = array();
					$errors['design_error'] = "Ada beberapa photo yang harus dilengkapi.";
					$this->session->set_userdata('errors_design', $errors);
				}
				
			}
		}
		redirect(base_url() . "c?ty=ve&code=" . $code . "&key=" . $key);
	}
	
	function process_upload_img(){
		$this->load->model('account_model');
		$this->load->library('utils');
		
		$type_hud = $this->input->get_post('type_hud');
		$type = $this->input->get_post('type');
		$recheck = sha1(SALT . $type);
		
		$data = array();
		$image_edit = $text = $status = "";
		
		if ($recheck == $type_hud){
		
			$chars = $this->utils->create_code(6);
			if (!is_dir('./images/business/' . $chars[0])){
				mkdir('./images/business/' . $chars[0], 0777);
			}
			if (!is_dir('./images/business/' . $chars[0] . '/' . $chars[1])){
				mkdir('./images/business/' . $chars[0] . '/' . $chars[1], 0777);
			}
			$config['upload_path'] = './images/business/' . $chars[0] . '/' . $chars[1] . '/';
			$config['allowed_types'] = 'jpg|jpeg';
			$config['max_size']	= '1024';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			if ($type == 'cover'){
				$config['max_width']  = '1280';
				$config['max_height']  = '1024';
			}else if ($type == 'profile_picture'){
				$config['max_width']  = '400';
				$config['max_height']  = '400';
			}else if (stripos($type, "album") !== FALSE){
				$config['max_width']  = '1024';
				$config['max_height']  = '1024';
			}
			$config['file_name']  = 'business-' . $chars . '.jpg';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('photoimg')){
				$data = array('error' => $this->upload->display_errors());
				$text = "Terjadi permasalahan/error dalam penguploadan photo.";
				$status = 0;
			}else{
				$image_data = $this->upload->data();
				$data = array('upload_data' => $image_data);
				$image_edit = $this->filemanager->getPath($image_data['file_name'], '75x75');
				$text = "Photo berhasil di upload.";
				$status = 1;
				
				// insert to database berdasarkan type
				$member = $this->session->userdata('member_twobecomeus');
				$this->account_model->addNewPhoto($member->member_id, $type, $image_data['file_name']);
				
			}
			
		}
		
		echo json_encode(array(
			'data' => $data,
			'image_edit' => $image_edit,
			'text' => $text,
			'status' => $status
		));
	}
	
	function member_photo(){
		$this->load->model('account_model');
		$member = $this->session->userdata('member_twobecomeus');
		$member_photos = $this->account_model->getUserPhoto($member->member_id);
		$this->data['member_photos'] = $member_photos;
	}
	
	function process_questions(){
		$code = $this->input->get_post('code');
		$key = $this->input->get_post('key');
		if ($this->input->get_post('btn_submit') == 1){
			$this->load->model('account_model');
			$member = $this->account_model->checkKey($key);
			$code_key = sha1(SALT . $key);
			
			if (!empty($code) && !empty($key) && !empty($member) && $code_key == $code){
				// update step current user => step next
				$this->account_model->updateUserStep($member->member_id, 5);
			}
		}
		redirect(base_url() . "c?ty=ve&code=" . $code . "&key=" . $key);
	}
	
	function process_finish(){
		$code = $this->input->get_post('code');
		$key = $this->input->get_post('key');
		if ($this->input->get_post('btn_submit') == 1){
			$this->load->model('account_model');
			$member = $this->account_model->checkKey($key);
			$code_key = sha1(SALT . $key);
			
			if (!empty($code) && !empty($key) && !empty($member) && $code_key == $code){
				
				// active = 1 dan email_verify = 1
				$this->account_model->updateUserActive($member->member_id, 1);
				
				// send email
				$this->load->library('send_email');
				$name = $member->member_name;
				$email = $member->member_email;
				$this->send_email->sendEmailFinishVerificationInformation($name, $email, "Welcome to Twobecome.us - Account Activated.");
				
			}
		}
		redirect(base_url());
	}
	
	function member_questions(){
		$this->load->model('personality_test_model');
		$member = $this->session->userdata('member_twobecomeus');
		$count_total = $this->personality_test_model->totalQuestions($member->member_id);
		$offset = rand(1, $count_total - 1);
		$question = $this->personality_test_model->getQuestionsRandom($offset, 1, $member->member_id);
		/*echo "<pre>";
		print_r($question);
		echo "</pre>";*/
		$this->data['question'] = $question;
	}
	
	function lookingfor(){
		$this->load->model('personality_test_model');
		$personality_type = $this->personality_test_model->getPersonalityType();
		$this->data['personality_type'] = $personality_type;
	}
	
	function process_lookingfor(){
		$code = $this->input->get_post('code');
		$key = $this->input->get_post('key');
		if ($this->input->get_post('btn_submit') == 1){
			$this->load->model('account_model');
		
			$member = $this->account_model->checkKey($key);
			$code_key = sha1(SALT . $key);
			
			if (!empty($code) && !empty($key) && !empty($member) && $code_key == $code){
				
				$errors = array();
				
				$height = $this->input->get_post('height');
				$body_type = $this->input->get_post('body_type');
				//$smokes = $this->input->get_post('smokes');
				//$drinks = $this->input->get_post('drinks');
				//$drugs = $this->input->get_post('drugs');
				$religion = $this->input->get_post('religion');
				$education = $this->input->get_post('education');
				$job = $this->input->get_post('job');
				//$income = $this->input->get_post('income');
				
				if (empty($height)){
					$errors['height_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($body_type)){
					$errors['body_type_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				/*
				if (empty($smokes)){
					$errors['smokes_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($drinks)){
					$errors['drinks_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (empty($drugs)){
					$errors['drugs_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				if (empty($income)){
					$errors['income_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				*/
				if (empty($religion)){
					$errors['religion_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($education)){
					$errors['education_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				if (empty($job)){
					$errors['job_error'] = "Anda seharusnya mengisi bagian ini.";
				}
				
				
				
				// personality
				$this->load->model('personality_test_model');
				
				if (!empty($errors)){
					$this->session->set_userdata('errors_lookingfor', $errors);
					
					$this->session->set_userdata('height', $height);
					$this->session->set_userdata('body_type', $body_type);
					//$this->session->set_userdata('smokes', $smokes);
					//$this->session->set_userdata('drinks', $drinks);
					//$this->session->set_userdata('drugs', $drugs);
					$this->session->set_userdata('religion', $religion);
					$this->session->set_userdata('education', $education);
					$this->session->set_userdata('job', $job);
					//$this->session->set_userdata('income', $income);
				}else{
					
					
					
					// insert to db
					// 1. insert yang height, bodytype, education, job, religion
					$types = array(
						'height' => $height, 
						'body_type' => $body_type, 
						'education' => $education, 
						'job' => $job,
						'religion' => $religion
					);
					foreach($types as $k => $v){
						$this->personality_test_model->insertLookingForType($k, $v, $member->member_id);
					}
					
					// 2. insert yang lain
					/*
					$this->personality_test_model->insertLookingForOther(array(
						'smokes' => $smokes,
						'drinks' => $drinks,
						'drugs' => $drugs,
						'income' => $income,
					), $member->member_id);
					*/
					
					
					// 3. insert personality
					$personality_type = $this->personality_test_model->getPersonalityType();
					foreach($personality_type as $type){
						$value = $this->input->get_post(str_replace(" ", "-", $type->type_name));
						//echo $type->type_name . "::" . $value;
						$this->personality_test_model->insertLookingForPersonality(array(
							'type_id' => $type->type_id,
							'type_range' => $value
						), $member->member_id);
					}
					
					// update step current user => step next
					$this->account_model->updateUserStep($member->member_id, 4);
					
				}
				
				
			}
		}
		redirect(base_url() . "c?ty=ve&code=" . $code . "&key=" . $key);
	}
	
	function generate_url(){
		$key = $this->input->get_post('key');
		if (!empty($key)){
			$code = sha1(SALT . $key);
			echo base_url() . "c?ty=ve&code=" . $code . "&key=" . $key;
		}else{
			echo "Gag ada key";
		}
	}
	
}

?>