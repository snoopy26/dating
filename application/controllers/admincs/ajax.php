<?php

class Ajax extends CI_Controller {
	
	function confirm_cs(){
		$type = $this->input->get_post("type");
		$order_hash = $this->input->get_post("order_hash");
		
		$this->load->model('cs_search');
		$results = current($this->cs_search->getSearch("#" . $order_hash, 1));
		
		$status = 0;
				
		if ($type == "checkout"){
			
			if (!empty($results)){
			
				// kirim email
				$this->load->library('send_email');
				$name = $results->member_name;
				$email = $results->member_email;
				$uniqcode = $results->uniqcode;
				$order_hash = $results->order_hash;
				$total_payment = $results->total_customer_price;
				$this->send_email->sendProcessCheckout($name, $email, "Checkout Confirmation", $uniqcode, $order_hash, $total_payment);
				$this->send_email->sendRememberProcessCheckout($name, $email, "Remember Payment Confirmation", $uniqcode, $order_hash, $total_payment);
				$status = 1;
			}
			
		}else if ($type == "paid"){
			
			if (!empty($results)){
			
				$order_id = $results->order_id;
				$this->load->model('checkout_model');
				$this->checkout_model->updateOrderCart($order_id, "confirmed");
				$status = 1;
			}
			
		}
		
		echo json_encode(array(
			'status' => $status
		));
		
	}
	
}

?>