<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {
	var $title = 'Nilai Leger';
	var $root_path = 'admin';
	var $path = 'nilai';
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/nilai',
			'templateHeader' => $this->root_path.'/'.$this->path.'/nilai_header',
			'templateFooter' =>$this->root_path.'/'. $this->path.'/nilai_footer'
		);
		$this->load->view('template', $data);
	}
	
	function contoh($id_kelas, $id_th_ajaran, $kd_mapel){
		$this->db->select("
		s.nis nis, s.nama_siswa,
		p.t1 p_t1, p.t2 p_t2, p.t3 p_t3, p.t4 p_t4, p.t5 p_t5, p.t6 p_t6, p.t7 p_t7, p.t8 p_t8, p.t9 p_t9, p.uts p_uts, p.uas p_uas,
		k.t1 k_t1, k.t2 k_t2, k.t3 k_t3, k.t4 k_t4, k.t5 k_t5, k.t6 k_t6, k.t7 k_t7, k.t8 k_t8, k.t9 k_t9, k.uts k_uts, k.uas k_uas,
		s.t1 s_t1, s.t2 s_t2, s.t3 s_t3, s.t4 s_t4, s.t5 s_t5, s.t6 s_t6, s.t7 s_t7, s.t8 s_t8, s.t9 s_t9, s.uts s_uts, s.uas s_uas
		");
		$this->db->from('siswa s');
		$this->db->join('kelas_siswa ks', 'ks.nis=s.nis');
		$this->db->join('kelas k', 'k.id_kelas=ks.id_kelas');
		$this->db->join('kelas_mapel km', 'km.id_kelas=k.id_kelas');
		$this->db->join('mapel m', 'm.kd_mapel=km.kd_mapel');
		$this->db->join('akademik_nilai.nilai_siswa ns', 'ns.nis_siswa=s.nis AND ns.kd_mapel=m.kd_mapel', 'left');
		$this->db->join('akademik_nilai.detail_nilai p', 'p.id_detail=ns.id_nilai_pengetahuan', 'left');
		$this->db->join('akademik_nilai.detail_nilai k', 'k.id_detail=ns.id_nilai_keterampilan', 'left');
		$this->db->join('akademik_nilai.detail_nilai s', 's.id_detail=ns.id_nilai_sikap', 'left');
		$this->db->where('k.id_kelas', $id_kelas);
		$this->db->where('k.id_th_ajaran', $id_th_ajaran);
		$this->db->where('m.kd_mapel', $kd_mapel);
		$nilai = $this->db->get();
		$data = array();
		foreach($nilai->result_array() as $n){
			$row = array();
			$row['nis'] = $n['nis'];
			$row['nama'] = $n['nama_siswa'];
			$row['pengetahuan'] = array($n['p_t1'], $n['p_t2'], $n['p_t3'],$n['p_t4'],$n['p_t5'],$n['p_t6'],$n['p_t7'],$n['p_t8'],$n['p_t9'],$n['p_uts'],$n['p_uas']);
			$row['keterampilan'] = array($n['k_t1'], $n['k_t2'], $n['k_t3'],$n['k_t4'],$n['k_t5'],$n['k_t6'],$n['k_t7'],$n['k_t8'],$n['k_t9'],$n['k_uts'],$n['k_uas']);
			$row['sikap'] = array($n['s_t1'], $n['s_t2'], $n['s_t3'],$n['s_t4'],$n['s_t5'],$n['s_t6'],$n['s_t7'],$n['s_t8'],$n['s_t9'],$n['s_uts'],$n['s_uas']);
			$data[] = $row;
		}
		$header = $this->db->count_all();
		echo json_encode(array("data"=>$data));
	}
	
}