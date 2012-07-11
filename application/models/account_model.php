<?php

class Account_model extends CI_Model{
	
	function addNewAccount(
			$member_name,
			$member_username,
			$member_email,
			$member_password,
			$phone_number,
			$address_country,
			$address_province,
			$address_kecamatan,
			$address_kelurahan,
			$address_kabupaten,
			$birthday,
			$member_status,
			$member_interest,
			$member_gender,
			$email_verify,
			$email_code,
			$step
	){
		$sql = "
		INSERT INTO member__profile SET
		member_name = ?,
		member_username = ?,
		member_email = ?,
		member_password = ?,
		phone_number = ?,
		address_country = ?,
		address_province = ?,
		address_kecamatan = ?,
		address_kelurahan = ?,
		address_kabupaten = ?,
		birthday = ?,
		member_status = ?,
		member_interest = ?,
		member_gender = ?,
		email_verify = ?,
		email_code = ?,
		step = ?
		";
		$this->db->query($sql, array(
			$member_name,
			$member_username,
			$member_email,
			$member_password,
			$phone_number,
			$address_country,
			$address_province,
			$address_kecamatan,
			$address_kelurahan,
			$address_kabupaten,
			$birthday,
			$member_status,
			$member_interest,
			$member_gender,
			$email_verify,
			$email_code,
			$step
		));
	}
	
	function insertUserAbout(
		$member_id,
		
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
	){
		$sql = "
		INSERT INTO member__about SET
		member_id = ?,
		about1 = ?,
		about2 = ?,
		about3 = ?,
		
		about4 = ?,
		about5 = ?,
		about6 = ?,
		
		about7 = ?,
		about9 = ?,
		
		about10 = ?
		";
		$this->db->query($sql, array(
			$member_id,
			
			$about1,
			$about2,
			$about3,
			
			$about4,
			$about5,
			$about6,
			
			$about7,
			$about9,
			
			$about10
		));
	}
	
	function insertUserDetail(
		$member_id,
		
		$height,
		$body_type,
		$smokes,
		
		$drinks,
		$drugs,
		$religion,
		
		$education,
		$job,
		$income
	){
		$sql = "
		INSERT INTO member__details SET
		member_id = ?,
		height = ?,
		body_type = ?,
		smokes = ?,
		
		drinks = ?,
		drugs = ?,
		religion = ?,
		
		education = ?,
		job = ?,
		income = ?
		";
		$this->db->query($sql, array(
			$member_id,
			
			$height,
			$body_type,
			$smokes,
			
			$drinks,
			$drugs,
			$religion,
			
			$education,
			$job,
			$income
		));
	}
	
	function updateUserStep($member_id, $step){
		$sql = "UPDATE member__profile SET step = ? WHERE member_id = ?";
		$this->db->query($sql, array($step, $member_id));
	}
	
	function isEmailTaken($email = ""){
		//AND a.active = 1
		$sql = "
		SELECT
		a.member_id
		FROM
		member__profile a
		WHERE 1
		AND a.member_email = ?
		LIMIT 1
		";
		$results = $this->db->query($sql, array($email))->row_array();
		return $results;
	}
	
	function isUsernameTaken($username = ""){
		//AND a.active = 1
		$sql = "
		SELECT
		a.member_id
		FROM
		member__profile a
		WHERE 1
		AND a.member_username = ?
		LIMIT 1
		";
		$results = $this->db->query($sql, array($username))->row_array();
		return $results;
	}
	
	function checkKey($key){
		$sql = "
		SELECT
		a.member_id,
		a.member_name,
		a.member_username,
		a.member_email,
		a.step,
		a.active,
		a.email_verify
		FROM 
		member__profile a
		WHERE 1
		AND a.email_code = ?
		LIMIT 1
		";
		$results = $this->db->query($sql, array($key))->row();
		return $results;
	}
	
	function addNewPhoto($member_id, $type, $filename){
		$member_photo = $this->checkMemberPhoto($member_id);
		if (empty($member_photo)){
			// add new
			$sql = "
			INSERT INTO member__photo SET
			member_id = $member_id,
			$type = '$filename'
			";
			$this->db->query($sql);
		}else{
			// update
			$sql = "
			UPDATE member__photo SET
			$type = '$filename'
			WHERE 1
			AND member_id = $member_id
			";
			$this->db->query($sql);
		}
	}
	
	function checkMemberPhoto($member_id){
		$sql = "
		SELECT 
		member_id
		FROM
		member__photo a
		WHERE 1
		AND a.member_id = ?
		LIMIT 1
		";
		return $result = $this->db->query($sql, array($member_id))->row_array();
	}
	
	function getUserPhoto($member_id){
		$sql = "
		SELECT 
		a.*
		FROM
		member__photo a
		WHERE 1
		AND a.member_id = ?
		LIMIT 1
		";
		return $result = $this->db->query($sql, array($member_id))->row();
	}
	
	function updateUserActive($member_id, $active){
		$sql = "UPDATE member__profile SET 
		active = ?,
		email_verify = ?
		WHERE member_id = ?";
		$this->db->query($sql, array($active, $active, $member_id));
	}
	
	function checkMember($member_username){
		$sql = "
		SELECT
		
		a.member_id,
		a.member_name,
		a.member_username,
		a.member_email,
		a.step,
		a.active,
		a.email_verify,
		a.phone_number,
		a.birthday,
		a.member_status,
		a.member_interest,
		a.member_gender,
		a.email_code,
		
		b.height,
		b.body_type,
		b.smokes,
		b.drinks,
		b.drugs,
		b.religion,
		b.education,
		b.job,
		b.income,
		
		c.about1,
		c.about2,
		c.about3,
		c.about4,
		c.about5,
		c.about6,
		c.about7,
		c.about8,
		c.about9,
		c.about10,
		
		d.album1,
		d.album2,
		d.album3,
		d.album4,
		
		COUNT(e.member_id) jml_answer,
		
		
		f.city_name,
		g.kecamatan_name,
		h.kelurahan_name,
		i.province_name
		
		FROM 
		member__profile a
		INNER JOIN member__details b ON
			a.member_id = b.member_id
		INNER JOIN member__about c ON
			a.member_id = c.member_id
		INNER JOIN member__photo d ON
			a.member_id = d.member_id
		LEFT JOIN personality__user_answers e ON
			a.member_id = e.member_id	
			
		INNER JOIN address__kabupaten f ON
			a.address_kabupaten = f.city_id
		INNER JOIN address__kecamatan g ON
			a.address_kecamatan = g.kecamatan_id
		INNER JOIN address__kelurahan h ON
			a.address_kelurahan = h.kelurahan_id
		INNER JOIN address__province i ON
			a.address_province = i.province_id	
			
		WHERE 1
		AND a.member_username = ?
		LIMIT 1
		";
		$results = $this->db->query($sql, array($member_username))->row();
		return $results;
	}
	
	function checkAccount($email, $password){
		$sql = "
		SELECT
		a.member_id,
		a.member_name,
		a.member_username,
		a.member_email,
		a.step,
		a.active,
		a.email_verify,
		a.email_code
		FROM 
		member__profile a
		WHERE 1
		AND a.member_email = ?
		AND a.member_password = ?
		LIMIT 1
		";
		$results = $this->db->query($sql, array($email, $password))->row();
		return $results;
	}
	
}

?>