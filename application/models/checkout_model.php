<?php

class Checkout_model extends CI_Model {
	
	function continue_checkout($business_id, $order_hash, $total_payment, $uniqcode){
		$order_expire_datetime = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')));
		$order_id = $this->insertOrderCart($business_id, $order_hash, $total_payment, $uniqcode);
		$this->insertOrderCartDetail($order_id, 'active', $order_expire_datetime);
	}
	
	function insertOrderCart($business_id, $order_hash, $total_payment, $uniqcode){
		$sql = "
		INSERT INTO order__cart SET
		account_id = ?,
		order_hash = ?,
		order_timestamp = NOW(),
		payment_status = 'checkout',
		total_customer_price = ?,
		uniqcode = ?
		";
		$this->db->query($sql, array($business_id, $order_hash, $total_payment, $uniqcode));
		return $this->db->insert_id();
	}
	
	function insertOrderCartDetail($order_id, $order_detail_status, $order_expire_datetime){
		$sql = "
		INSERT INTO order__cart_detail SET
		order_id = ?,
		order_detail_status = ?,
		order_expire_datetime = ?
		";
		$this->db->query($sql, array($order_id, $order_detail_status, $order_expire_datetime));
	}
	
	function check_order($account_id){
		$sql = "
		SELECT 
		a.order_id,
		b.order_detail_id,
		a.order_hash,
		a.payment_status,
		a.total_customer_price,
		b.order_detail_status,
		a.uniqcode,
		b.order_expire_datetime
		FROM 
		order__cart a
		INNER JOIN order__cart_detail b ON 
		a.order_id = b.order_id
		WHERE 1
		AND a.payment_status IN ('checkout', 'paid', 'confirmed')
		AND b.order_detail_status = 'active'
		AND a.account_id = ?
		LIMIT 1
		";
		return $this->db->query($sql, array($account_id))->row();
	}
	
	function checkOrderHashConfirmPayment($order_hash){
		$sql = "
		SELECT
		a.order_id,
		a.order_hash,
		b.order_detail_id,
		a.account_id,
		a.total_customer_price
		FROM
		order__cart a
		INNER JOIN order__cart_detail b ON
		a.order_id = b.order_id
		WHERE 1
		AND a.order_hash = ?
		AND a.payment_status = 'checkout'
		AND b.order_detail_status = 'active'
		";
		return $this->db->query($sql, array($order_hash))->row();
	}
	
	function confirmCheckoutPayment(
	$orderhash,
	$order_id,
	$order_detail_id,
	$datepayment,
	$amount,
	$frombank,
	$bankaccount,
	$destbank,
	$note,
	$ktp
	){
		$this->updateOrderCart($order_id, 'paid');
		$this->updateOrderCartDetail(
			$order_detail_id,
			$amount
		);
		$this->insertOrderConfirmation(
			$order_id,
			$frombank,
			$bankaccount,
			$destbank,
			$note,
			$ktp,
			$datepayment
		);
	}
	
	function updateOrderCartDetail($order_detail_id, $amount){
		$sql = "
		UPDATE order__cart_detail SET
		customer_price = ?
		WHERE 1
		AND order_detail_id = ?
		";
		$this->db->query($sql, array($amount, $order_detail_id));
	}
	
	function insertOrderConfirmation(
	$order_id,
	$frombank,
	$bankaccount,
	$destbank,
	$note,
	$ktp,
	$datepayment
	){
		$sql = "
		INSERT INTO order__confirmation SET
		order_id = ?,
		from_bank = ?,
		bank_account_name = ?,
		destination_bank = ?,
		note = ?,
		ktp = ?,
		datepayment = ?
		";
		$this->db->query($sql, array($order_id, $frombank, $bankaccount, $destbank, $note, $ktp, $datepayment));
	}
	
	function updateOrderCart($order_id, $payment_status){
		$sql = "
		UPDATE order__cart SET
		payment_status = ?
		WHERE 1
		AND order_id = ?
		";
		$this->db->query($sql, array($payment_status, $order_id));
	}
	
}

?>