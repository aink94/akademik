<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_authentication extends CI_Model {
	function __construct(){
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
	}
	function check_login($select = array(), $table, $where = array()){
		$select = implode(",", $select);
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->get();
	}
	function set_login($table, $where = array(), $id_session){
		$time = date("Y-m-d h:i:s");
		$data = array(
			'login_terakhir' => $time, 
			'id_session' => $id_session);
		$this->db->where($where);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
}