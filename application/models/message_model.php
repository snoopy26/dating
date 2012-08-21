<?php

class Message_model extends CI_Model{
	
	function getOptionKiss(){
		$sql = "
		SELECT 
		kiss_id,
		kiss_message
		FROM 
		message__kissme a
		WHERE 1
		AND a.isactive = 1
		";
		return $results = $this->db->query($sql)->result();
	}
	
	function sendSayHello($kiss, $member_id, $mid){
		$sql = "
		INSERT INTO message__kissmember SET
		kiss_id = ?,
		member_id = ?,
		member_to_id = ?
		";
		$this->db->query($sql, array($kiss, $member_id, $mid));
	}
	
	var $foundRow = 0;
	function getSayHelloSelectedUser($member_sessid, $member_id, $start = 0){

		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		b.kiss_message,
		a.member_to_id,
		a.member_id,
		c.member_name,
		c.member_email,
		c.member_username,
		d.album1,
		a.lastupdate,
		a.kiss_message_id,

		COUNT(f.kiss_message_id) count_reply

		FROM message__kissmember a
		JOIN message__kissme b ON
		a.kiss_id = b.kiss_id
		JOIN member__profile c ON
		a.member_id = c.member_id
		JOIN member__photo d ON
		d.member_id = a.member_id

		LEFT JOIN message__kissme_reply f ON
		a.kiss_message_id = f.kiss_message_id

		WHERE 1
		AND (a.member_to_id = $member_sessid OR a.member_to_id = $member_id)
		AND (a.member_id = $member_sessid OR a.member_id = $member_id)

		GROUP BY a.kiss_message_id
		
		ORDER BY a.lastupdate DESC
		LIMIT $start, 3
		";
		$results = $this->db->query($sql)->result();
		$this->foundRow = $this->db->query('SELECT FOUND_ROWS() AS total_found')->row()->total_found;
		
		return $results;
	}

	function getSayHello($member_id, $start = 10, $limit = 10){
		$sql = "
		SELECT 

		SQL_CALC_FOUND_ROWS

		a.member_id,
		a.member_to_id,
		b.member_name,
		b.member_username,
		d.kiss_message,
		d.kiss_id,
		a.lastupdate,
		e.album1,
		a.kiss_message_id,
		f.message,
		
		c.member_name member_name_user2,
		c.member_username member_username_user2,
		
		g.album1 album1_user2,

		COUNT(f.kiss_message_id) count_reply
		
		FROM message__kissmember a
		
		INNER JOIN member__profile b ON
		a.member_id = b.member_id
		INNER JOIN member__profile c ON
		a.member_to_id = c.member_id
		
		INNER JOIN message__kissme d ON
		d.kiss_id = a.kiss_id
		
		INNER JOIN member__photo e ON
		a.member_id = e.member_id
		INNER JOIN member__photo g ON
		a.member_to_id = g.member_id	
		
		LEFT JOIN message__kissme_reply f ON
		a.kiss_message_id = f.kiss_message_id

		WHERE 1
		AND ( a.member_to_id = '$member_id'
		OR a.member_id = '$member_id' )
		GROUP BY a.kiss_message_id
		ORDER BY a.lastupdate DESC , a.member_id ASC
		LIMIT $start, $limit
		";
		$results = $this->db->query($sql)->result();
		$this->foundRow = $this->db->query('SELECT FOUND_ROWS() AS total_found')->row()->total_found;
		return $results;
	}

	function replyKissMessage($member_id, $message, $kissmessageid){
		$sql = "
		INSERT INTO message__kissme_reply SET
		kiss_message_id = ?,
		message = ?,
		member_id = ?
		";
		$this->db->query($sql, array(
			$kissmessageid, $message, $member_id
		));
		return $this->db->insert_id();
	}

	function getReplyKissMessage($kissmessageid){
		$sql = "
		SELECT

		SQL_CALC_FOUND_ROWS

		b.member_name,
		b.member_username,
		a.message,
		a.kiss_message_id,
		a.member_id,
		c.album1,
		a.last_update,
		a.reply_id

		FROM 
		message__kissme_reply a
		INNER JOIN member__profile b ON
		a.member_id = b.member_id
		INNER JOIN member__photo c ON
		a.member_id = c.member_id
		WHERE 1
		AND a.kiss_message_id = '$kissmessageid'
		ORDER BY a.last_update ASC 
		";
		$results = $this->db->query($sql)->result();
		$this->foundRow = $this->db->query('SELECT FOUND_ROWS() AS total_found')->row()->total_found;
		return $results;
	}

	function getKissMessageDetail($kissmessageid){
		$sql = "
		SELECT 
		a.kiss_id,
		a.kiss_message_id,
		a.member_id,
		a.member_to_id,
		a.lastupdate,

		b.kiss_message,

		c.message message_reply,
		c.reply_id,

		d.member_name member_name_user1,
		d.member_username member_username_user1,
		g.album1 photo_user1,

		e.member_name member_name_user2,
		e.member_username member_username_user2,
		h.album1 photo_user2,

		f.member_name member_name_reply,
		f.member_username member_username_reply,
		i.album1 photo_user_reply,

		c.last_update last_update_reply

		FROM
		message__kissmember a
		LEFT JOIN message__kissme b ON
		a.kiss_id = b.kiss_id
		LEFT JOIN message__kissme_reply c ON 
		c.kiss_message_id = a.kiss_message_id

		LEFT JOIN member__profile d ON
		d.member_id = a.member_id
		LEFT JOIN member__profile e ON
		e.member_id = a.member_to_id
		LEFT JOIN member__profile f ON
		f.member_id = c.member_id

		LEFT JOIN member__photo g ON
		g.member_id = a.member_id
		LEFT JOIN member__photo h ON
		h.member_id = a.member_to_id
		LEFT JOIN member__photo i ON
		i.member_id = c.member_id

		WHERE 1
		AND a.kiss_message_id = '$kissmessageid'

		ORDER BY c.last_update ASC 
		";

		$return = $this->db->query($sql)->result();
		return $return;
	}
	
}

?>