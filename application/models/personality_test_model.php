<?php

class Personality_test_model extends CI_Model{
	
	function totalQuestions($member_id){	
	
		// get question yang sudah di jawab oleh user
		$answered_in = "";
		$count_answered = 0;
		$answered = $this->getQuestionsUserAnswered($member_id);
		if (!empty($answered)){
			$answered_in = "AND a.question_id NOT IN ($answered)";
			$count_answered = count(explode(",", $answered));
		}
		
		$sql = "
		SELECT 
		COUNT(*) total 
		FROM 
		personality__questions a
		WHERE 1
		$answered_in
		AND a.active = 1
		";
		$results = $this->db->query($sql)->row();
		return $results->total;
	}
	
	function getQuestionsUserAnswered($member_id){
		$sql = "
		SELECT
		question_id
		FROM personality__user_answers a
		WHERE 1 
		AND a.member_id = ?
		";
		$results = $this->db->query($sql, array($member_id));
		$results = $results->result();
		$return = array();
		if (!empty($results)){
			foreach($results as $result){
				$return[] = $result->question_id;
			}
		}
		if (!empty($return)) $return = implode(",", $return);
		return $return;
	}
	
	function getQuestionsRandom($offset = 1, $max = 1, $member_id){
		
		// get question yang sudah di jawab oleh user
		$answered_in = "";
		$count_answered = 0;
		$answered = $this->getQuestionsUserAnswered($member_id);
		if (!empty($answered)){
			$answered_in = "AND a.question_id NOT IN ($answered)";
			$count_answered = count(explode(",", $answered));
		}
		
	
		$sql = "
		SELECT
		a.question_id,
		a.question,
		GROUP_CONCAT(b.answer_id SEPARATOR '/:/') AS answer_id,
		GROUP_CONCAT(CONCAT(b.answer_option, '|', b.answer_detail) SEPARATOR '/:/') AS answer,
		GROUP_CONCAT(b.score SEPARATOR '/:/') AS score,
		c.type_name
		FROM personality__questions a
		INNER JOIN personality__answers b ON
		a.question_id = b.question_id
		INNER JOIN personality__type c ON
		a.question_type = c.type_id
		WHERE 1
		AND a.active = 1
		AND c.active = 1
		$answered_in
		GROUP BY a.question_id
		LIMIT $offset, $max
		";
		
		$results = $this->db->query($sql)->row();
		
		return array(
			"question" => $results,
			"count_answered" => $count_answered
		);
	}
	
	function insertAnswered($member_id, $question_id, $answer_id, $ask_mate){
		$sql = "
		INSERT INTO personality__user_answers SET
		member_id = ?,
		question_id = ?,
		answer_id = ?,
		ask_mate = ?
		";
		$this->db->query($sql, array($member_id, $question_id, $answer_id, $ask_mate));
	}
	
	function searchMaxScore(){
		$sql = "
		SELECT 
		
		d.type_id, 
		d.type_name, 
		MAX(c.score) as max_score, 
		MIN(c.score) as min_score
		
		FROM
		personality__questions b 

		INNER JOIN personality__answers c ON
		b.question_id = c.question_id
		INNER JOIN personality__type d ON
		b.question_type = d.type_id

		WHERE 1
		GROUP BY d.type_id
		";
		return $results = $this->db->query($sql)->result();
	}
	
	function userTotalScore($member_id){
		$sql = "
		SELECT 
		
		d.type_id,
		d.type_name, 
		 SUM(c.score) as score
		, COUNT(a.question_id) as jml_question
		
		FROM
		personality__user_answers a 

		INNER JOIN personality__questions b ON
		a.question_id = b.question_id
		INNER JOIN personality__answers c ON
		a.answer_id = c.answer_id
		INNER JOIN personality__type d ON
		b.question_type = d.type_id

		WHERE 1
		AND a.member_id = ?
		GROUP BY d.type_id
		";
		return $results = $this->db->query($sql, array($member_id))->result();
	}
	
	function getPersonalityType(){
		$sql = "
		SELECT
		a.type_name,
		a.type_id
		FROM 
		personality__type a
		WHERE 1
		AND a.active = 1
		";
		return $results = $this->db->query($sql)->result();
	}
	
	function insertLookingForType($type, $value, $member_id){
		if (!empty($value)){
			foreach($value as $v){
				$sql = "
				INSERT INTO member__lookingfor_$type SET
				member_id = ?,
				$type = ?
				";
				$this->db->query($sql, array(
					$member_id,
					$v
				));
			}
		}
	}
	
	function insertLookingForPersonality($param, $member_id){
		$sql = "
		INSERT INTO member__lookingfor_personality SET
		member_id = ?,
		type_id = ?,
		type_range = ?
		";
		$this->db->query($sql, array(
			$member_id,
			$param['type_id'],
			$param['type_range']
		));
	}
	
	function insertLookingForOther($param, $member_id){	
		$sql = "
		INSERT INTO member__lookingfor SET
		member_id = ?,
		smokes = ?,
		drinks = ?,
		drugs = ?,
		income = ?
		";
		$this->db->query($sql, array(
			$member_id,
			$param['smokes'],
			$param['drinks'],
			$param['drugs'],
			$param['income']
		));
	}
	
	function getLookingFor($member_id){
		$sql = "
		SELECT 
		GROUP_CONCAT(DISTINCT b.body_type SEPARATOR '/:/') AS body_type,
		GROUP_CONCAT(DISTINCT c.education SEPARATOR '/:/') AS education,
		GROUP_CONCAT(DISTINCT d.height SEPARATOR '/:/') AS height,
		GROUP_CONCAT(DISTINCT e.job SEPARATOR '/:/') AS job,
		GROUP_CONCAT(DISTINCT h.religion SEPARATOR '/:/') AS religion,
		GROUP_CONCAT(DISTINCT CONCAT(g.type_name, '|', f.type_range) SEPARATOR '/:/') AS personality
		FROM member__profile a
		INNER JOIN member__lookingfor_body_type b ON
		a.member_id = b.member_id
		INNER JOIN member__lookingfor_education c ON
		a.member_id = c.member_id
		INNER JOIN member__lookingfor_height d ON
		a.member_id = d.member_id
		INNER JOIN member__lookingfor_job e ON
		a.member_id = e.member_id
		INNER JOIN member__lookingfor_personality f ON
		a.member_id = f.member_id
		INNER JOIN personality__type g ON
		g.type_id = f.type_id
		INNER JOIN member__lookingfor_religion h ON
		a.member_id = h.member_id
		WHERE 1
		AND a.member_id = ?
		GROUP BY a.member_id
		";
		return $results = $this->db->query($sql, array($member_id))->row();
	}
	
	function getMatching($param = array()){
		$member_id = $param['member_id'];
		$body_type = $param['body_type'];
		$education = $param['education'];
		$height = $param['height'];
		$job = $param['job'];
		$religion = $param['religion'];
		
		$where_member_id = 
		$where_body_type = 
		$where_education = 
		$where_height = 
		$where_job =
		$where_religion = "";
		
		if (!empty($member_id)) $where_member_id = "AND b.member_id <> $member_id";
		//if (!empty($body_type)) $where_body_type = "AND b.body_type IN ($body_type)";
		if (!empty($education)) $where_education = "AND b.education IN ($education)";
		//if (!empty($height)) $where_height = "AND b.height IN ($height)";
		if (!empty($job)) $where_job = "AND b.job IN ($job)";
		if (!empty($religion)) $where_religion = "AND b.religion IN ($religion)";
		
		$sql = "
		SELECT
		a.member_id, 
		a.member_name, 
		a.member_username, 
		d.album1, 
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
		
		INNER JOIN address__kabupaten f ON
			a.address_kabupaten = f.city_id
		INNER JOIN address__kecamatan g ON
			a.address_kecamatan = g.kecamatan_id
		INNER JOIN address__kelurahan h ON
			a.address_kelurahan = h.kelurahan_id
		INNER JOIN address__province i ON
			a.address_province = i.province_id	
		
		WHERE 1
		$where_member_id
		$where_body_type
		$where_education
		$where_height
		$where_job
		$where_religion
		";
		return $results = $this->db->query($sql)->result();
	}
	
}

?>