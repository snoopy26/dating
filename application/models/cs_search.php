<?php

class Cs_search extends CI_Model {
	
	function getSearch($q, $type){
		
		$sql_group = "";
		if ($type != 2){
			if ($q[0] == "#"){
				$q = str_replace("#", "", $q);
				$sql_where = " AND a.order_hash = '$q' ";
			}else{
				$sql_where = "
				AND (d.member_name LIKE '%$q%' OR d.member_email LIKE '%$q%' OR d.member_username LIKE '%$q%')
				";
			}
			$sql_group = "GROUP BY d.member_id";
		}else if ($type == 2){
			$sql_where = "AND d.member_id = '$q'";
		}
		
		$sql = "
		SELECT
		a.order_id,
		a.order_hash,
		b.created_timestamp,
		a.payment_status,
		a.total_customer_price ,
		d.member_id,
		d.member_name,
		d.member_username, 
		d.member_email,
		d.phone_number,
		b.customer_price,
		c.from_bank,
		c.bank_account_name,
		c.destination_bank,
		c.note,
		c.ktp,
		c.datepayment,
		e.album1,
		a.uniqcode
		FROM
		order__cart a
		LEFT JOIN order__cart_detail b ON
		a.order_id = b.order_id
		LEFT JOIN order__confirmation c ON
		a.order_id = c.order_id
		LEFT JOIN member__profile d ON
		d.member_id = a.account_id
		LEFT JOIN member__photo e ON
		e.member_id = a.account_id
		WHERE 1
		$sql_where
		$sql_group
		";
		
		return $results = $this->db->query($sql)->result();
		
	}
	
}

?>