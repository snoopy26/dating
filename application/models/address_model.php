<?php

class Address_model extends CI_Model{
	
	function address_province($country = "id"){
		$sql = "
		SELECT 
		province_id,
		province_name
		FROM
		address__province a
		WHERE 1
		AND a.province_country_id = '$country'
		ORDER BY a.province_name ASC
		";
		$results = $this->db->query($sql);
		return $results->result();
	}
	
	function address_kabupaten($province = ""){
		$sql = "
		SELECT 
		city_id,
		city_name
		FROM
		address__kabupaten a
		WHERE 1
		AND a.city_province_id = '$province'
		ORDER BY a.city_name ASC
		";
		$results = $this->db->query($sql);
		return $results->result();
	}
	
	function address_kecamatan($kabupaten = ""){
		$sql = "
		SELECT 
		kecamatan_id,
		kecamatan_name
		FROM
		address__kecamatan a
		WHERE 1
		AND a.kecamatan_kabupaten_id = '$kabupaten'
		ORDER BY a.kecamatan_name ASC
		";
		$results = $this->db->query($sql);
		return $results->result();
	}
	
	function address_kelurahan($kecamatan = ""){
		$sql = "
		SELECT 
		kelurahan_id,
		kelurahan_name
		FROM
		address__kelurahan a
		WHERE 1
		AND a.kelurahan_kecamatan_id = '$kecamatan'
		ORDER BY a.kelurahan_name ASC
		";
		$results = $this->db->query($sql);
		return $results->result();
	}
	
}

?>