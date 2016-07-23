<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function count_siswa(){
		$this->db->where('status_belajar', 'aktif');
		$this->db->from('siswa');
		return $this->db->count_all_results();
	}
	function count_guru(){
		$this->db->like('jabatan_guru', 'GURU', 'after');
		$this->db->from('guru');
		return $this->db->count_all_results();
	}
	function count_staff(){
		$this->db->like('jabatan_guru', 'STAFF');
		$this->db->from('guru');
		return $this->db->count_all_results();
	}
	function count_mapel(){
		$this->db->from('mapel');
		return $this->db->count_all_results();
	}
	function count_kelas(){
		$this->db->from('kelas');
		return $this->db->count_all_results();
	}
	
	function th_ajaran(){
		return $this->db->get('th_ajaran')->result();
	}
	
	function update_aktif_th_ajaran($id){
		$this->db->update('th_ajaran', array('status'=>'tidak aktif'));
		$this->db->update('th_ajaran', array('status'=>'aktif'), array('id_th_ajaran'=>intval($id)));
		return $this->db->affected_rows();
	}
	
	function sekolah(){
		return $this->db->get('sekolah')->result();
	}
}