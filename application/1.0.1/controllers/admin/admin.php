<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	var $title = 'Page Admin';
	var $root_path = 'admin';
	var $path = 'admin';
	
	function __construct() {
		parent::__construct();
		$this->load->model('admin/m_admin');
	}
	
	function index(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/admin',
			'templateFooter' => $this->root_path.'/'.$this->path.'/admin_footer',
			'jlmSiswa' => $this->m_admin->count_siswa(),
			'jlmGuru' => $this->m_admin->count_guru(),
			'jlmStaff' => $this->m_admin->count_staff(),
			'jlmMapel' => $this->m_admin->count_mapel(),
			'jlmKelas' => $this->m_admin->count_kelas()
		);
		
		$this->load->view('template', $data);
	}
	
	function setting(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/admin_setting',
			'templateFooter' => $this->root_path.'/'.$this->path.'/admin_footer',
			'th_ajaran' => $this->m_admin->th_ajaran(),
			'sekolah' => $this->m_admin->sekolah()
		);
		
		$this->load->view('template', $data);
	}
	
	function update_aktif_th_ajaran($id){
		$this->m_admin->update_aktif_th_ajaran($id);
		$this->session->set_userdata('th_ajaran_aktif', $id);
		echo json_encode(array('status'=>TRUE));
	}
	
	
}