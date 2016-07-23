<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
	
	var $title = 'Page Admin';
	var $path = 'kelas';
	var $root_path = 'admin';
	
	function __construct() {
		parent::__construct();
		$this->load->model('admin/M_kelas');
	}
	
	function index(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/kelas',
			'templateHeader' => $this->root_path.'/'.$this->path.'/kelas_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/kelas_footer',
			'sekolah' => $this->M_kelas->sekolah()
		);
		
		$this->load->view('template', $data);
	}
	
	function getDataKelas($id_sekolah = NULL){
		$list = $this->M_kelas->get_datatables($id_sekolah);
		$data = array();
		$no = $_POST['start'];
		
		foreach($list as $kelas){
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kelas->nama_kelas;
			$row[] = $kelas->nama_guru;
			$row[] = $kelas->nama_th_ajaran;
			
			$row[] = '<div class="btn-group btn-group-sm pull-right"  role="group" aria-label="btn-actions">
	                      <a class="btn btn-info" href="javascript:void(0);" onclick="lihat_mapel('."'".$kelas->id_kelas."'".','."'".$kelas->nama_kelas."'".','."'".$kelas->id_sekolah."'".')" data-toggle="tooltip" data-original-title="Lihat Mata Pelajaran" data-placement="top"><i class="fa fa-book"></i></a>
	                      <a class="btn btn-info" href="javascript:void(0);" onclick="lihat_siswa('."'".$kelas->id_kelas."'".','."'".$kelas->nama_kelas."'".','."'".$kelas->id_sekolah."'".')" data-toggle="tooltip" data-original-title="Lihat Siswa" data-placement="top"><i class="fa fa-mortar-board"></i></a>
	                      <a class="btn btn-info" href="javascript:void(0);" onclick="edit_wali('."'".$kelas->id_kelas."'".','."'".$kelas->nama_kelas."'".','."'".$kelas->nupk_guru."'".')" data-toggle="tooltip" data-original-title="Edit Wali Kelas" data-placement="top"><i class="fa fa-pencil-square"></i></a>
	                      <a class="btn btn-info" href="javascript:void(0);" onclick="hapus_kelas('."'".$kelas->id_kelas."'".')" data-toggle="tooltip" data-original-title="hapus" data-placement="top"><i class="fa fa-trash"></i></a>
                      </div>';
			
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->M_kelas->count_all(),
				"recordsFiltered" => $this->M_kelas->count_filtered($id_sekolah),
				"data" => $data,
			);
		echo json_encode($output);
	}
	
	function getDataSiswaKelas($id_kelas){
		$list = $this->M_kelas->get_data_siswa_kelas($id_kelas);
		$data = array();
		$no = 0;
		foreach($list as $siskel){
			$no++;
			$row = array();
			$row[] = strval($no);
			$row[] = $siskel->nis;
			$row[] = $siskel->nisn;
			$row[] = $siskel->nama_siswa;
			$row[] = "<button class='btn btn-danger btn-sm pull-right' onclick='hapus_siswa_kelas(".'"'.$siskel->nis.'"'.", ".''.$id_kelas.''.")'><li class='fa fa-trash'></li></button>";
			$data[] = $row;
		}
		$output = array(
				"draw"=> $_POST['draw'],
				"data" => $data
		);
		echo json_encode($output);
	}
	
	function getDataMapelKelas($id_kelas){
		$list = $this->M_kelas->get_data_mapel_kelas($id_kelas);
		$data = array();
		$no = 0;
		foreach($list as $siskel){
			$no++;
			$row = array();
			$row[] = strval($no);
			$row[] = $siskel->kd_mapel;
			$row[] = $siskel->nama_mapel;
			$row[] = $siskel->nama_kel_mapel;
			$row[] = $siskel->nama_tingkat;
			//tambah guru pengajar
			if($siskel->nupk_mengajar){
				$pilih = '<dl style="margin: 0px"><dt>'.$siskel->nama_guru.'</dt><dd>nupk : '.$siskel->nupk_mengajar.'</dd></dl>';
			}else{
				$pilih = '<button type="button" class="btn btn-success btn-sm" onclick="tambah_pengajar('.$siskel->id_kelas_mapel.')"><li class="fa fa-plus"></li> Tambah Pengajar</button>';
			}
			$row[] = $pilih;
			$row[] = "<button class='btn btn-sm btn-danger pull-right' type='button' onclick='hapus_mapel_kelas(".'"'.$siskel->kd_mapel.'"'.", ".''.$id_kelas.''.")'><li class='fa fa-trash'></li></button>";
			$data[] = $row;
		}
		$output = array(
				"draw"=> $_POST['draw'],
				"data" => $data
		);
		echo json_encode($output);
	}
	
	function updatewali(){
		$wali = array(
			'nupk_wali' => $this->input->post('nupk_guru')
		);
		$update = $this->M_kelas->update_wali(array('id_kelas'=>$this->input->post('id_kelas')), $wali);
		echo json_encode(array('status'=>TRUE));
	}
	
	function tambahKelas(){
		$kelas = array(
			'id_sekolah' => $this->input->post("id_sekolah"),
			'id_th_ajaran' => $this->input->post("id_th_ajaran"),
			'grade' => $this->input->post("grade"),
			'nupk_wali' => $this->input->post("nupk_wali"),
			'nama_kelas' => $this->input->post("grade").'-'.$this->input->post("nama_kelas")
		);
		$insert = $this->M_kelas->tambah_kelas($kelas);
		echo json_encode(array('status'=>TRUE));
	}
	
	function selectMapelNo($id_sekolah, $id_kelas){
		$list = $this->M_kelas->select_mapel_kosong($id_sekolah, $id_kelas);
		$data = array();
		foreach($list as $d){
			$row = array();
			$row[] = "<input type='checkbox' value='".$d->kd_mapel."' name='kd_mapel[]' class='check-mapel' />";
			$row[] = $d->nama_mapel;
			$row[] = $d->nama_kel_mapel;
			$row[] = $d->nama_tingkat;
			$data[] = $row;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	function tambah_mapel_kelas(){//$this->input->post('id_kelas_mapel')
		$kd_mapel = $this->input->post('kd_mapel');
		$kelas_mapel = array();
		foreach($kd_mapel as $kd=>$val){
			$kelas_mapel[$kd] = array(
				'kd_mapel' => $val,
				'id_kelas' => $this->input->post('id_kelas_mapel')
			);
		}
		//print_r($kelas_mapel);
		$insert = $this->M_kelas->tambah_kelas_mapel($kelas_mapel);
		echo json_encode(array('status'=>TRUE));
	}
	function hapusKelasMapel($kd_mapel, $id_kelas){
		$delete = $this->M_kelas->hapus_kelas_mapel($kd_mapel, $id_kelas);
		echo json_encode(array('status'=>TRUE));
	}
	
	function kelas($id_sekolah){
		$list = $this->M_kelas->kelas($id_sekolah);
		$data = array();
		foreach($list as $kelas){
			$row = array();
			$row[] = $kelas->id_kelas;
			$row[] = $kelas->nama_kelas;
			
			$data[] = $row;
		}
		echo json_encode($data);
	}
	function selectSiswaNo($id_sekolah, $id_kelas_lama = NULL){
		$list = $this->M_kelas->select_siswa_no($id_sekolah, $id_kelas_lama);
		$data = array();
		foreach($list as $sis){
			$row = array();
			$row[] = '<input type="checkbox" value="'.$sis->nis.'" class="check-siswa" name="nis-siswa[]" />';
			$row[] = $sis->nis;
			$row[] = $sis->nama_siswa;
			$data[] = $row;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	function tambahSiswaKelas(){
		$nis = $this->input->post('nis-siswa');
		$kelas_siswa = array();
		foreach($nis as $kd=>$val){
			$kelas_siswa[$kd] = array(
				'nis' => $val,
				'id_kelas' => $this->input->post('idkelas-siswa-kelas'),
				'id_th_ajaran' => $this->session->userdata('th_ajaran_aktif')
			);
		}
		$insert = $this->M_kelas->tambah_siswa_kelas($kelas_siswa);
		echo json_encode(array('status'=>TRUE));
	}
	function hapusKelasSiswa($nis, $id_kelas){
		$delete = $this->M_kelas->hapus_kelas_siswa($nis, $id_kelas);
		echo json_encode(array('status'=>TRUE));
	}
}