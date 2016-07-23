<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	
	var $title = 'Page Admin';
	var $root_path = 'admin';
	var $path = 'pegawai';
	
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('admin/M_pegawai');
		if(!is_admin())show_404();
	}
	
	function index(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/pegawai',
			'templateHeader' => $this->root_path.'/'.$this->path.'/pegawai_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/pegawai_footer'
		);
		
		$this->load->view('template', $data);
	}
	
	function smp(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/pegawai',
			'templateHeader' => $this->root_path.'/'.$this->path.'/pegawai_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/pegawai_footer',
			'peg' => 'SMP'
		);
		$this->load->view('template', $data);
	}
	
	function sma(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/pegawai',
			'templateHeader' => $this->root_path.'/'.$this->path.'/pegawai_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/pegawai_footer',
			'peg' => 'SMA'
		);
		$this->load->view('template', $data);
	}
	
	function staff(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/pegawai',
			'templateHeader' => $this->root_path.'/'.$this->path.'/pegawai_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/pegawai_footer',
			'peg' => 'STAFF'
		);
		$this->load->view('template', $data);
	}
	
	function getData($jab){
		$list = $this->M_pegawai->get_datatables($jab);
		$data = array();
		$no = $_POST['start'];
		
		foreach($list as $guru){
			$no++;
			$row = array();
			$row[] = $guru->nupk_guru;
			$row[] = $guru->nupk_2_guru;
			$row[] = $guru->nama_guru;
			$row[] = $guru->hp_guru;
			$row[] = $guru->jabatan_guru;
			
			$row[] = '<div class="btn-group pull-right">
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="lihat_guru('."'".$guru->nupk_guru."'".')" data-toggle="tooltip" data-original-title="lihat" data-placement="top"><i class="fa fa-eye"></i></a>
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="edit_guru('."'".$guru->nupk_guru."'".')" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><i class="fa fa-edit"></i></a>
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="hapus_guru('."'".$guru->nupk_guru."'".')" data-toggle="tooltip" data-original-title="hapus" data-placement="top"><i class="fa fa-trash"></i></a>
                      </div>';
			
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->M_pegawai->count_all($jab),
				"recordsFiltered" => $this->M_pegawai->count_filtered($jab),
				"data" => $data,
			);
		echo json_encode($output);
	}
	
	function getById($id){
		$data = $this->M_pegawai->get_by_id($id);
		echo json_encode($data);
	}
}