<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	
	var $title = 'Page Admin';
	var $path = 'siswa';
	var $root_path = 'admin';
	
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('admin/M_siswa');
		if(!is_admin())show_404();
	}
	
	function index(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/siswa',
			'templateHeader' => $this->root_path.'/'.$this->path.'/siswa_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/siswa_footer'
		);
		
		$this->load->view('template', $data);
	}
	
	function datasiswa($id_sekolah){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/siswa_data',
			'templateHeader' => $this->root_path.'/'.$this->path.'/siswa_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/siswa_footer',
			'sekolah' => $this->M_siswa->informasi_sekolah(),
			'kelas' => $this->M_siswa->select_kelas(),
			'th_ajaran' => $this->M_siswa->select_th_ajaran()
		);
		$this->load->view('template', $data);
	}
	
	public function getDataSiswa($id_sekolah, $idkelas = NULL){
		$list = $this->M_siswa->get_datatables($id_sekolah, $idkelas);
		$data = array();
		$no = $_POST['start'];
		
		foreach($list as $siswa){
			$no++;
			$row = array();
			$row[] = $siswa->id_kelas;
			$row[] = $siswa->nis_siswa;
			$row[] = $siswa->nisn;
			$row[] = $siswa->nama_siswa;
			$row[] = $siswa->nama_kelas;
			$row[] = $siswa->jk_siswa;
			
			$row[] = '<div class="btn-group pull-right">
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="lihat_siswa('."'".$siswa->nis_siswa."'".')" data-toggle="tooltip" data-original-title="lihat" data-placement="top"><i class="fa fa-eye"></i></a>
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="edit_siswa('."'".$siswa->nis_siswa."'".')" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><i class="fa fa-edit"></i></a>
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="hapus_siswa('."'".$siswa->nis_siswa."'".')" data-toggle="tooltip" data-original-title="hapus" data-placement="top"><i class="fa fa-trash"></i></a>
                      </div>';
			
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->M_siswa->count_all($id_sekolah),
				"recordsFiltered" => $this->M_siswa->count_filtered($id_sekolah, $idkelas),
				"data" => $data,
			);
		echo json_encode($output);
	}
	
	function getById($id){
		$data = $this->M_siswa->get_by_id($id);
		echo json_encode($data);
	}
	
	function add_siswa(){
		$siswa = array(
			'nis' => $this->input->post('nis_siswa_disabled'),
			'nisn' => $this->input->post('nisn'),
			'nama_siswa' => $this->input->post('nama_siswa'),
			'jk_siswa' => $this->input->post('jenis_kelamin_siswa'),
			'tmpt_lhr_siswa' => $this->input->post('tempat_lahir_siswa'),
			'tgl_lhr_siswa' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir_siswa'))),
			'anak_ke_siswa' => $this->input->post('anak_ke_siswa'),
			'status_keluarga_siswa' => $this->input->post('status_keluarga_siswa'),
			'alamat_siswa' => $this->input->post('alamat_siswa'),
			'telp_siswa' => $this->input->post('telp_siswa'),
			'diterima_grade_siswa' => $this->input->post('diterima_tingkat_siswa'),
			'diterima_tgl_siswa' => date('Y-m-d', strtotime($this->input->post('pada_tanggal_siswa'))),
			'asal_sekolah_siswa' => $this->input->post('asal_sekolah_siswa'),
			'tahun_ijazah_siswa' => $this->input->post('tahun_ijazah_siswa'),
			'nomor_ijazah_siswa' => '',//(!empty($this->input->post('nomor_ijazah_siswa'))) ? $this->input->post('nomor_ijazah_siswa') : NULL,
			'id_sekolah'=>$this->input->post('id_sekolah'),
			'status_belajar' => 'aktif',
			'created_at' => date('Y-m-d H:i:s')
		);
		$ortu = array(
			'nis' => $this->input->post('nis_siswa_disabled'),
			'nama_ayah' => $this->input->post('nama_ayah'),
			'tlp_ayah' => $this->input->post('tlp_ayah'),
			'pek_ayah' => '',//(!empty($this->input->post('pek_ayah'))) ? $this->input->post('pek_ayah') : NULL,
			'nama_ibu' => $this->input->post('nama_ibu'),
			'tlp_ibu' => $this->input->post('tlp_ibu'),
			'pek_ibu' => '',//(!empty($this->input->post('pek_ibu'))) ? $this->input->post('pek_ibu') : NULL,
			'nama_wali' => $this->input->post('nama_wali'),
			'tlp_wali' => $this->input->post('tlp_wali'),
			'pek_wali' => '',//(!empty($this->input->post('pek_wali'))) ? $this->input->post('pek_wali') : NULL,
			'alamat_wali' => $this->input->post('alamat_wali'),
			'tlp_rmh_ortu' => $this->input->post('tlp_ortu'),
			'alamat_ortu' => $this->input->post('alamat_ortu')
		);
		$kelas_siswa = array(
			'nis' => $this->input->post('nis_siswa_disabled')
		);
		$insert = $this->M_siswa->add_siswa($siswa, $ortu, $kelas_siswa);
		echo json_encode(array('status'=>TRUE));
	}
	
	function update_siswa(){
		$siswa = array(
			'nisn' => $this->input->post('nisn_siswa'),
			'nama_siswa' => $this->input->post('nama_siswa'),
			'jk_siswa' => $this->input->post('jenis_kelamin_siswa'),
			'tmpt_lhr_siswa' => $this->input->post('tempat_lahir_siswa'),
			'tgl_lhr_siswa' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir_siswa'))),
			'anak_ke_siswa' => $this->input->post('anak_ke_siswa'),
			'status_keluarga_siswa' => $this->input->post('status_keluarga_siswa'),
			'alamat_siswa' => $this->input->post('alamat_siswa'),
			'telp_siswa' => $this->input->post('telp_siswa'),
			'diterima_grade_siswa' => $this->input->post('diterima_grade_siswa'),
			'diterima_tgl_siswa' => date('Y-m-d', strtotime($this->input->post('pada_tanggal_siswa'))),
			'asal_sekolah_siswa' => $this->input->post('asal_sekolah_siswa'),
			'tahun_ijazah_siswa' => $this->input->post('tahun_ijazah_siswa'),
			'nomor_ijazah_siswa' => '',//(!empty($this->input->post('nomor_ijazah_siswa'))) ? $this->input->post('nomor_ijazah_siswa') : NULL,
			'update_at' => date('Y-m-d H:i:s')
		);
		$ortu = array(
			'nama_ayah' => $this->input->post('nama_ayah'),
			'tlp_ayah' => $this->input->post('tlp_ayah'),
			'pek_ayah' => '',//(!empty($this->input->post('pek_ayah'))) ? $this->input->post('pek_ayah') : NULL,
			'nama_ibu' => $this->input->post('nama_ibu'),
			'tlp_ibu' => $this->input->post('tlp_ibu'),
			'pek_ibu' => '',//(!empty($this->input->post('pek_ibu'))) ? $this->input->post('pek_ibu') : NULL,
			'tlp_rmh_ortu' => $this->input->post('tlp_ortu'),
			'alamat_ortu' => $this->input->post('alamat_ortu'),
			'nama_wali' => $this->input->post('nama_wali'),
			'tlp_wali' => $this->input->post('tlp_wali'),
			'pek_wali' => '',//(!empty($this->input->post('pek_wali'))) ? $this->input->post('pek_wali') : NULL,
			'alamat_wali' => $this->input->post('alamat_wali')
		);
		$this->M_siswa->update_siswa(
			array('nis'=> $this->input->post('nis_siswa_hidden')),//for siswa
			array('nis'=> $this->input->post('nis_siswa_hidden')),//for ortu
			$siswa, $ortu);
		echo json_encode(array('status'=>TRUE));
	}
	
	function delete_siswa(){
		$where_siswa = array(
			'nis' => $this->input->post('nis_siswa_delete')
		);
		$siswa = array(
			'status_belajar' => 'tidak aktif'
		);
		$this->M_siswa->delete_siswa($siswa, $where_siswa);
		echo json_encode(array('status'=>TRUE));
	}

	function jlmSiswaPerGrade($id_sekolah, $th_ajaran){
		$list = $this->M_siswa->jlm_siswa_pergrade($id_sekolah, $th_ajaran);
		$data = array();
		
		foreach($list as $siswa){
			$row = array();
			$row[] = $siswa->grade;
			$row[] = $siswa->jlm_siswa;
			$data[] = $row;
		}
		$r = array();
		$r[] = $this->M_siswa->jlm_siswa($id_sekolah, $th_ajaran)['total'];
		$r[] = $this->M_siswa->jlm_siswa($id_sekolah, $th_ajaran)['jlm_siswa'];
		$data[] = $r;
		$output = array(
				"draw" => $_POST['draw'],
				"data" => $data,
			);
		//$output["jlm_perdata"][] = $this->M_siswa->jlm_siswa($id_sekolah, $th_ajaran);
		echo json_encode($output);
	}
	
	/**
	* CEK VALIDASI DATABASE
	*/
	function cek_ijasah($no_ijazah){
		$this->db->where('nomor_ijazah_siswa', $no_ijazah);
		$q=$this->db->get('siswa');
		if($q->num_rows() == 1)
			return TRUE;
		else
			return FALSE;
	}
}