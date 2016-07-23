<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {
	
	var $title = 'Page Admin';
	var $root_path = 'admin';
	var $path = 'mapel';
	
	function __construct() {
		parent::__construct();
		$this->load->model('admin/M_mapel');
	}
	
	function index(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/mapel',
			'templateHeader' => $this->root_path.'/'.$this->path.'/mapel_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/mapel_footer',
			'sekolah' => $this->M_mapel->sekolah()
		);
		$this->load->view('template', $data);
	}
	
	function getDataMapelSMA(){
		$list = $this->M_mapel->get_datatables_sma();
		$data = array();
		$no = $_POST['start'];
		
		foreach($list as $mapel){
			$no++;
			$row = array();
			$row[] = $mapel->kd_mapel;
			$row[] = $mapel->nama_mapel;
			$row[] = $mapel->nama_kel_mapel;
			$row[] = $mapel->nama_tingkat;
			
			$row[] = '<div class="btn-group btn-group-xs pull-right"  role="group" aria-label="btn-actions">
	                      <a class="btn btn-info" href="javascript:void(0);" onclick="edit_mapel_sma('."'".$mapel->kd_mapel."'".')" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><i class="fa fa-edit"></i></a>
	                      <a class="btn btn-info" href="javascript:void(0);" onclick="hapus_mapel_sma('."'".$mapel->kd_mapel."'".')" data-toggle="tooltip" data-original-title="hapus" data-placement="top"><i class="fa fa-trash"></i></a>
                      </div>';
			
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->M_mapel->count_all_sma(),
				"recordsFiltered" => $this->M_mapel->count_filtered_sma(),
				"data" => $data,
			);
		echo json_encode($output);
	}
	function getDataMapelSMP(){
		$list = $this->M_mapel->get_datatables_smp();
		$data = array();
		$no = $_POST['start'];
		
		foreach($list as $mapel){
			$no++;
			$row = array();
			$row[] = $mapel->kd_mapel;
			$row[] = $mapel->nama_mapel;
			$row[] = $mapel->nama_kel_mapel;
			
			$row[] = '<div class="btn-group btn-group-xs pull-right">
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="edit_mapel_smp('."'".$mapel->kd_mapel."'".')" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><i class="fa fa-edit"></i></a>
	                      <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="hapus_mapel_smp('."'".$mapel->kd_mapel."'".')" data-toggle="tooltip" data-original-title="hapus" data-placement="top"><i class="fa fa-trash"></i></a>
                      </div>';
			
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->M_mapel->count_all_smp(),
				"recordsFiltered" => $this->M_mapel->count_filtered_smp(),
				"data" => $data,
			);
		echo json_encode($output);
	}
	function add_mapel_smp(){
		$kd_mapel = $this->input->post('kd_mapel_disabled');
		$nama_mapel =$this->input->post('nama_mapel');
		$id_kel_mapel = (!empty($this->input->post('kelompok_mapel'))) ? $this->input->post('kelompok_mapel') : NULL;
		$mapel = array(
			'kd_mapel' => 'SMP-'.$kd_mapel,
			'nama_mapel' => $nama_mapel,
			'id_kel_mapel' => $id_kel_mapel
		);
		$insert = $this->M_mapel->add_mapel($mapel);
		echo json_encode(array('status'=>TRUE));
	}
	function getByIdSmp($kd_mapel){
		$mapel = $this->M_mapel->get_by_id_smp($kd_mapel);
		echo json_encode($mapel);
	}
	function update_mapel_smp(){
		$nama_mapel =$this->input->post('nama_mapel');
		$id_kel_mapel = (!empty($this->input->post('kelompok_mapel'))) ? $this->input->post('kelompok_mapel') : NULL;
		$mapel = array(
			'nama_mapel' => $nama_mapel,
			'id_kel_mapel' => $id_kel_mapel
		);
		$update = $this->M_mapel->update_mapel(array('kd_mapel'=>$this->input->post('kd_mapel_hidden')),$mapel);
		echo json_encode(array('status'=>TRUE));
	}
	function delete_mapel(){
		$kd_mapel = $this->input->post('kd_mapel_delete');
		$delete = $this->M_mapel->delete_mapel($kd_mapel);
		echo json_encode(array('status'=>TRUE));
	}
	
	function add_mapel_sma(){
		$kd_mapel = $this->input->post('kd_mapel_disabled');
		$nama_mapel =$this->input->post('nama_mapel');
		$id_tingkat = (!empty($this->input->post('tingkat_mapel'))) ? $this->input->post('tingkat_mapel') : NULL;
		$id_kel_mapel = (!empty($this->input->post('kelompok_mapel'))) ? $this->input->post('kelompok_mapel') : NULL;
		$mapel = array(
			'kd_mapel' => 'SMA-'.$kd_mapel,
			'nama_mapel' => $nama_mapel,
			'id_kel_mapel' => $id_kel_mapel,
			'id_tingkat' => $id_tingkat
		);
		$insert = $this->M_mapel->add_mapel($mapel);
		echo json_encode(array('status'=>TRUE));
	}
	function getByIdSma($kd_mapel){
		$mapel = $this->M_mapel->get_by_id_sma($kd_mapel);
		echo json_encode($mapel);
	}
	function update_mapel_sma(){
		$nama_mapel =$this->input->post('nama_mapel');
		$id_kel_mapel = (!empty($this->input->post('kelompok_mapel'))) ? $this->input->post('kelompok_mapel') : NULL;
		$id_tingkat = (!empty($this->input->post('tingkat_mapel'))) ? $this->input->post('tingkat_mapel') : NULL;
		$mapel = array(
			'nama_mapel' => $nama_mapel,
			'id_kel_mapel' => $id_kel_mapel,
			'id_tingkat' => $id_tingkat
		);
		$update = $this->M_mapel->update_mapel(array('kd_mapel'=>$this->input->post('kd_mapel_hidden')),$mapel);
		echo json_encode(array('status'=>TRUE));
	}
	
	function jadwal_table(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->root_path.'/leftadmin',
			'content' => $this->root_path.'/'.$this->path.'/jadwal',
			'templateHeader' => $this->root_path.'/'.$this->path.'/mapel_header',
			'templateFooter' => $this->root_path.'/'.$this->path.'/mapel_footer',
			'sekolah' => $this->M_mapel->sekolah()
		);
		$this->load->view('template', $data);
	}
	function jam(){
		$this->db->select('id_jam_hari, nama_jam_hari');
		$this->db->from('jam_hari');
		return $this->db->get()->result_array();
	}
	function kelas($th_ajaran, $sekolah = NULL){
		$this->db->select('id_kelas, nama_kelas');
		$this->db->from('kelas');
		if(isset($sekolah)) $this->db->where('id_sekolah', $sekolah);
		$this->db->where('id_th_ajaran', $th_ajaran);
		return $this->db->get()->result_array();
	}
	
	function jadwal($th_ajaran, $id_jam, $sekolah = NULL){
		$Sql = "
			SELECT jk.*, j.id_mengajar
			FROM (
			  SELECT id_jam_hari, id_kelas, nama_jam_hari, nama_kelas 
			  FROM jam_hari, kelas 
			  WHERE ";
		if(isset($sekolah))$Sql .= "id_sekolah=$sekolah AND ";
		$Sql .= "id_th_ajaran=$th_ajaran
			  ) jk
			LEFT JOIN (
			  SELECT id_jam_hari, jadwal.id_kelas, kelas.id_th_ajaran, jadwal.id_mengajar 
			  FROM jadwal 
			  JOIN kelas ON (jadwal.id_kelas=kelas.id_kelas)
			  WHERE id_th_ajaran=$th_ajaran
			  ) j 
			ON (j.id_jam_hari=jk.id_jam_hari AND j.id_kelas=jk.id_kelas ) ";
			$Sql .= "WHERE jk.id_jam_hari= ".$id_jam;
			$Sql .= " ORDER BY jk.id_jam_hari, id_kelas ";
		return $this->db->query($Sql)->result_array();
	}
	
	function mengajar($id_mengajar){
		$this->db->select('nupk_guru, nama_guru, nama_mapel');
		$this->db->from('mengajar');
		$this->db->join('guru', 'guru.nupk_guru=mengajar.nupk_mengajar');
		$this->db->join('kelas_mapel', 'mengajar.id_kelas_mapel=kelas_mapel.id_kelas_mapel');
		$this->db->join('mapel', 'mapel.kd_mapel=kelas_mapel.kd_mapel');
		$this->db->where('id_mengajar', $id_mengajar);
		return $this->db->get()->row_array();
	}
	
	
	function jadwal_mapel($th_ajaran, $sekolah = NULL){
		//$th_ajaran = $this->input->post('t');
		//$sekolah = $this->input->post('s');
		$jam = $this->jam();
		$data = array();
		foreach($jam as $j){
			$row = array();
			$row[] = '<h4><b>'.$j['nama_jam_hari'].'</b></h4>';
			//$row[] = ''.$j['nama_jam_hari'].'';
			$jadwal = $this->jadwal($th_ajaran, $j['id_jam_hari'], $sekolah);
			foreach($jadwal as $jd){
				$dt = $jd['id_mengajar'].'';
				
				if($jd['id_mengajar'] != NULL){
					//($i === 0) ? $dt = 'YA' : 'TIDAK';
					$m = $this->mengajar($jd['id_mengajar']);
					
					$dt = 	'<dl>
								<dt>'.$m['nama_mapel'].'</dt>
								<dd>'.$m['nupk_guru'].'</dd>
								<dd>'.$m['nama_guru'].'</dd>
							</dl';
					$row[] = $dt;
					
					//<dd class="pull-right"><a class="btn btn-xs btn-info"><li class="fa fa-eye"></li></a></dd>
					//$dt .= $j['id_jam_hari'].'|'.$jd['id_kelas'].'|'.$jd['id_mengajar'].'';
				}else if($jd['id_mengajar'] == NULL){
					$dt = "<button type='button' class='btn btn-danger btn-sm text-center' onclick='tambah_jadwal(".$j['id_jam_hari'].",".$jd['id_kelas'].")'><li class='fa fa-plus'></li></button>";
					//$dt = $j['id_jam_hari'].'?'.$jd['id_kelas'].'?'.$jd['id_mengajar'].'';
					$row["kosong"] = "k";
					$row[] = $dt;
				}
				
				//$row[] = $dt;//$k['id_kelas'].'|'.$k['id_jam_hari'].'?'.$k['id_mengajar'];
			}
			$data[] = $row;
		}
		$kelas = $this->kelas($th_ajaran, $sekolah);
		$col = array();
		$col[] = array("width"=>"50","sTitle"=>'#');
		foreach($kelas as $k){
			$rowkelas = array();
			$rowkelas["sTitle"] = $k['nama_kelas'];
			$rowkelas["width"] = '100';
			$col[] = $rowkelas;
		}
		$output = array(
			"aoColumns" => $col, 
			"data"=>$data
		);
		echo json_encode($output);
	}

	function getMapelKelas($id_kelas){
		$this->db->select("mapel.`kd_mapel`, nama_mapel, id_kelas_mapel");
		$this->db->from('kelas_mapel');
		$this->db->join('mapel', 'mapel.kd_mapel=kelas_mapel.kd_mapel');
		$this->db->where('id_kelas', $id_kelas);
		$mapel = $this->db->get()->result();
		$data = array();
		foreach($mapel as $m){
			$row = array();
			$row[] = $m->kd_mapel;
			$row[] = $m->nama_mapel;
			$row[] = $m->id_kelas_mapel;
			$data[] = $row;
		}
		echo json_encode(array("mapel" => $data));
	}
	function getGuruPengajar(){
		$this->db->select('nupk_guru, nama_guru');
		$this->db->from('guru');
		$guru = $this->db->get()->result();
		$data = array();
		foreach($guru as $g){
			$row = array();
			$row[] = $g->nupk_guru;
			$row[] = $g->nama_guru;
			$data[] = $row;
		}
		echo(json_encode($data));
	}
	function saveJadwal(){
		$jam = $this->input->post('id_jam_hari');
		$kelas = $this->input->post('id_kelas');
		$id = explode(',', $this->input->post('id_mapel'));
		$mapel = $id[0];
		$kelasmapel = $id[1];
		$guru = $this->input->post('id_guru');
		$mengajar = array(
			'id_kelas_mapel' => $kelasmapel,
			'nupk_mengajar' => $guru
		);
		$this->db->insert('mengajar', $mengajar);
		$id_mengajar = $this->db->insert_id();
		$jadwal = array(
			"id_jam_hari" => $jam,
			"id_kelas" => $kelas,
			"id_mengajar" => $id_mengajar
		);
		$this->db->insert('jadwal', $jadwal);
		echo json_encode(array("Status"=>TRUE));
	}
}