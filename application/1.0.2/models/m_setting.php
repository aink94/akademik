<?php
class M_setting extends CI_Model {
	function getmenu(){
		$status = $this->session->userdata('status_karyawan');
		$this->db->like('level', $status);
		return $this->db->get('menu_payment');
	}
	function getsubmenu($id_menu){
		$status = $this->session->userdata('status_karyawan');
		$this->db->like('level', $status);
		$this->db->where('id_menu', $id_menu);
		return $this->db->get('submenu_payment');
	}
	function tambahmenu($menu){
		$this->db->insert('menu_payment', $menu); 
		return $this->db->affected_rows();
	}
	function tambahsubmenu($menu){
		$this->db->insert('submenu_payment', $menu); 
		return $this->db->affected_rows();
	}
	function updatemenu($menu, $where){
		$this->db->where('id_menu', $where);
		$this->db->update('menu_payment', $menu);
		return $this->db->affected_rows();
	}
	function updatesubmenu($submenu, $where){
		$this->db->where('id_submenu', $where);
		$this->db->update('submenu_payment', $submenu);
		return $this->db->affected_rows();
	}
	function deletemenu($id_menu){
		$table = array('submenu_payment', 'menu_payment');
		$this->db->where('id_menu', $id_menu);
		$this->db->delete($table);
		return $this->db->affected_rows();
	}
	function deletesubmenu($id_submenu){
		$this->db->where('id_submenu', $id_submenu);
		$this->db->delete('submenu_payment');
		return $this->db->affected_rows();
	}
	
	function getuserskaryawan(){
		$this->db->select('id_karyawan, nama_karyawan, status, login_terakhir');
		$this->db->from('karyawan');
		return $this->db->get();
	}
}