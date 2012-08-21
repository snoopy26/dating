<?php

class Flag_model extends CI_Model{

	function flagUser($member_id, $member_to_id, $is_active){
		$sql = "
		REPLACE INTO member__flag SET
		member_id = ?,
		member_to_id = ?,
		is_active = ?
		";
		$this->db->query($sql, array($member_id, $member_to_id, $is_active));
	}

	function getFlags($member_id){
		$sql = "
		SELECT 
		a.`member_id`, 
		a.`member_to_id`,
		a.`is_active`,
		b.`member_email`,
		b.`member_name`,
		b.`member_username`,
		c.`album1`

		FROM 
		member__flag a 

		JOIN member__profile b ON
		a.`member_to_id` = b.`member_id`
		JOIN member__photo c ON
		a.`member_to_id` = c.`member_id`

		WHERE 1
		AND a.`member_id` = ?
		AND a.`is_active` = 1
		";
		return $results = $this->db->query($sql, array($member_id))->result();
	}

}

?>