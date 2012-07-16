<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {
	
	var $business;
	
	function __construct(){
		parent::__construct();
		$this->load->library('filemanager');
		$member = $this->session->userdata('2becomeus_login');
		if (empty($member)) redirect(base_url());
		
		$this->load->model('account_model');
		$this->business = $this->account_model->checkMember($member->member_username);
	}
	
	function confirm_payment(){
		$this->load->model('checkout_model');
		$this->load->library('birthday');
		$orderHash = $this->input->get_post('orderhash');
		$this->session->set_userdata('orderhash', $orderHash);
		$orderHashCheck = $this->checkout_model->checkOrderHashConfirmPayment($orderHash);
		$this->data['orderHash'] = $orderHash;
		if (empty($orderHashCheck->order_id)) redirect(base_url() . '404');
		$this->default_param();
		$this->load->view('t/checkout/confirm_payment_view', $this->data);
	}
	
	function finish_confirmpayment(){
		$orderHash = $this->session->userdata('orderhash');
		if (empty($orderHash)) redirect(base_url() . "explore");
		$this->session->unset_userdata('orderhash');
		$this->default_param();
		$this->load->view('t/checkout/confirm_payment_finish_view', $this->data);
	}
	
	function process_checkout(){
		$this->load->model('checkout_model');
		if ($this->input->get_post('btn_submit') == 1){
			$uniqcode = $this->input->get_post('uniqcode');
			$payment = $this->input->get_post('payment');
			$total_payment = $this->input->get_post('total_payment');
			$order_hash = $this->input->get_post('order_hash');
			$this->checkout_model->continue_checkout(
				$this->business->member_id,
				$order_hash,
				$total_payment,
				$uniqcode
			);
			$this->session->set_userdata('errors_checkout', true);
			
			// kirim email
			$this->load->library('send_email');
			$name = $this->business->member_name;
			$email = $this->business->member_email;
			$this->send_email->sendProcessCheckout($name, $email, "Checkout Confirmation", $uniqcode, $order_hash, $total_payment);
			$this->send_email->sendRememberProcessCheckout($name, $email, "Remember Payment Confirmation", $uniqcode, $order_hash, $total_payment);
		}
		redirect(base_url() . "explore");
	}
	
	function process_confirm_payment(){
		$this->load->model('checkout_model');
		$this->load->library('utils');
		
		if ($this->input->get_post('btn_submit') == 1){
			
			$orderHash = $this->input->get_post('orderhash');
			$orderHashCheck = $this->checkout_model->checkOrderHashConfirmPayment($orderHash);
			if (empty($orderHashCheck->order_id)) redirect(base_url() . '404');
			
			$day = $this->input->get_post('day');
			$month = $this->input->get_post('month');
			$year = $this->input->get_post('year');
			
			$datetime = date('Y-m-d', mktime(0, 0, 0, (int)$month, (int)$day, (int)$year));
			$date_user = strtotime($datetime);
			$now = strtotime(date('Y-m-d'));
			
			$errors = array();
			if ($now > $date_user){
				$errors['year'] = "Ada kesalahan dalam pemilihan tanggal pembayaran.";
			}
			
			$amount = $this->input->get_post('amount');
			if ($amount < (int)$orderHashCheck->total_customer_price){
				$errors['amount'] = "Transaksi yang anda bayar tidak sesuai.";
			}
			
			$frombank = $this->input->get_post('frombank');
			if (empty($frombank)){
				$errors['frombank'] = "Field ini harus diisi.";
			}
			
			$bankaccount = $this->input->get_post('bankaccount');
			if (empty($bankaccount)){
				$errors['bankaccount'] = "Field ini harus diisi.";
			}
			
			$destbank = $this->input->get_post('destbank');
			$note = $this->input->get_post('note');
			
			
			$chars = $this->utils->create_code(6);
			if (!is_dir('./images/ktp/' . $chars[0])){
				mkdir('./images/ktp/' . $chars[0], 0777);
			}
			if (!is_dir('./images/ktp/' . $chars[0] . '/' . $chars[1])){
				mkdir('./images/ktp/' . $chars[0] . '/' . $chars[1], 0777);
			}
			$config['upload_path'] = './images/ktp/' . $chars[0] . '/' . $chars[1] . '/';
			$config['allowed_types'] = 'jpg|jpeg';
			$config['max_size']	= '2048';
			
			$config['file_name']  = 'ktp-' . $chars . '.jpg';
			
			$this->load->library('upload', $config);
			
			$ktp = "";
			if ( ! $this->upload->do_upload('ktp')){
				$data = array('error' => $this->upload->display_errors());
				$text = "Terjadi permasalahan/error dalam penguploadan photo.";
				$errors['ktp'] = $text;
			}else{
				$image_data = $this->upload->data();
				$data = array('upload_data' => $image_data);
				
				$ktp = $image_data['file_name'];
			}
			
			
			if (!empty($errors)){
				$this->session->set_userdata('errors_confirmpayment', $errors);
				
				$this->session->set_userdata('day', $day);
				$this->session->set_userdata('month', $month);
				$this->session->set_userdata('year', $year);
				$this->session->set_userdata('amount', $amount);
				$this->session->set_userdata('frombank', $frombank);
				$this->session->set_userdata('bankaccount', $bankaccount);
				$this->session->set_userdata('destbank', $destbank);
				$this->session->set_userdata('note', $note);
				
				redirect(base_url() . "checkout/confirm_payment?orderhash=" . $orderHash);
			}else{
				$this->checkout_model->confirmCheckoutPayment(
					$orderHash,
					$orderHashCheck->order_id,
					$orderHashCheck->order_detail_id,
					$datetime,
					$amount,
					$frombank,
					$bankaccount,
					$destbank,
					$note,
					$ktp
				);
				
				// kirim email
				$this->load->library('send_email');
				$name = $this->business->member_name;
				$email = $this->business->member_email;
				//$fullname, $email, $title, $order_hash, $payment_date, $bank_asal, $bank_tujuan, $account_name, $amount, $note
				$this->send_email->sendProcessConfirmPayment($name, $email, "Confirm Payment Confirmation", $orderHash, date('d M Y, H:i', strtotime($datetime)), $frombank, $destbank, $bankaccount, $amount, $note);
				
			}
			
		}
		
		redirect(base_url() . "checkout/finish_confirmpayment");
		
	}
	
	
	
}

?>