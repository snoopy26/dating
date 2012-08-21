<?php

class Dating_model extends CI_Model{

	function setMemberDating($date, $time){
		$sql = "
		INSERT INTO 
		member__dating
		SET
		dating_date = ?,
		dating_time = ?,
		dating_active = 1,
		dating_rel_active = 0
		";
		$this->db->query($sql, array($date, $time));
		return $this->db->insert_id();
	}

	function setMemberDateRel($datingId, $member1, $member2){
		$sql = "
		INSERT INTO 
		member__dating_rel
		SET
		dating_id = ?,
		member1 = ?,
		member2 = ?
		";
		$this->db->query($sql, array($datingId, $member1, $member2));
	}

	function countDating($memberId){
		$sql = "
		SELECT COUNT(a.`dating_id`) count_dating
		FROM member__dating_rel a
		INNER JOIN member__dating b ON
		a.`dating_id` = b.`dating_id` 
		WHERE 1 
		AND ( a.`member1` = $memberId OR a.`member2` = $memberId )
		AND b.`dating_active` = 1
		";
		return $results = $this->db->query($sql)->row();
	}

	function listDate($memberId){
		$sql = "
		SELECT
		mdr.`dating_id`,
		mdr.member1,
		mdr.member2,

		md.dating_date,
		md.dating_time,
		md.dating_note,
		md.dating_active,
		md.dating_location, 
		md.dating_confirm,

		mp1.member_id member1_memberid,
		mp1.member_name member1_name,
		mp1.member_username member1_username,
		ma1.about1 member1_myselfsummary,
		ma1.about8 member1_lookingfor,
		mph1.album1 member1_photo,

		mp2.member_id member2_memberid,
		mp2.member_name member2_name,
		mp2.member_username member2_username,
		ma2.about1 member2_myselfsummary,
		ma2.about8 member2_lookingfor,
		mph2.album1 member2_photo,


		CASE 
			WHEN mdr.member1 = '$memberId' THEN 'member1'
			WHEN mdr.member2 = '$memberId' THEN 'member2'
		END AS member_type

		FROM
		member__dating_rel mdr
		INNER JOIN member__dating md ON
		mdr.`dating_id` = md.`dating_id`

		INNER JOIN member__profile mp1 ON
		mp1.member_id = mdr.member1

		INNER JOIN member__profile mp2 ON
		mp2.member_id = mdr.member2

		INNER JOIN member__about ma1 ON
		ma1.member_id = mp1.member_id

		INNER JOIN member__about ma2 ON
		ma2.member_id = mp2.member_id

		INNER JOIN member__photo mph1 ON
		mph1.member_id = mp1.member_id

		INNER JOIN member__photo mph2 ON
		mph2.member_id = mp2.member_id

		WHERE 1
		AND 
		(mdr.`member1` = '$memberId' OR mdr.`member2` = '$memberId')
		AND md.dating_active = 1
		";
		$results = $this->db->query($sql)->result_array();
		return $results;
	}

	function changeDate($dating_id, $member_id, $date, $time, $detail){
		$sql = "
		INSERT INTO
		member__dating_detail SET
		dating_id = ?,
		member_id = ?,
		change_date = ?,
		change_time = ?,
		detail = ?
		";
		$this->db->query($sql, array($dating_id, $member_id, $date, $time, $detail));
	}

	function getDetailsChangeDate($dating_id){
		$sql = "
		SELECT 
		ids.`dating_id`, ids.`member_id`, ids.`detail`, ids.`last_update`, 
		ids.member_username
		FROM
		(
		SELECT a.`dating_id`, a.`member_id`, a.`detail`, a.`last_update`,
		b.`member_username`
		FROM member__dating_detail a
		JOIN member__profile b ON
		a.`member_id` = b.`member_id`
		WHERE 1 AND a.`dating_id` = ?
		ORDER BY a.`last_update` DESC
		) AS ids
		GROUP BY ids.member_id
		";	
		return $results = $this->db->query($sql, array($dating_id))->result_array();
	}

}

?>