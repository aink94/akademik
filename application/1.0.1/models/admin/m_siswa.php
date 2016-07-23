<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model{
	
	
	/* Data Siswa */
	var $column = array('k.id_kelas', 's.nis', 's.nisn', 's.nama_siswa', 'k.nama_kelas');//kolom search
	
	function informasi_sekolah(){
    	$this->db->where('id_sekolah', intval($this->uri->segment(4)));
    	return $this->db->get('sekolah')->row();
	}
	
	function select_kelas(){
  		$this->db->where('id_th_ajaran', $this->session->userdata('th_ajaran_aktif'));
  		$this->db->where('id_sekolah', $this->uri->segment(4));
  		return $this->db->get('kelas');
	}
	function select_th_ajaran(){
		return $this->db->get('th_ajaran')->result();
	}
	
	private function _get_datatables_query($id_sekolah, $id_kelas)
	{
		$sql = '';
		$sql .= "SELECT s.nis nis_siswa, s.nisn, s.nama_siswa, 
		(CASE s.jk_siswa WHEN 'L' THEN 'Laki-laki' WHEN 'P' THEN 'Perempuan' END) jk_siswa, 
		k.nama_kelas, k.id_kelas ";
		$sql .= "FROM siswa s ";
		$sql .= "JOIN kelas_siswa ks ON (s.nis=ks.nis) ";
		$sql .= "LEFT JOIN kelas k ON (ks.id_kelas=k.id_kelas) ";
		$sql .= "LEFT JOIN th_ajaran ta ON (k.id_th_ajaran=ta.id_th_ajaran) ";//tam
		$sql .= "WHERE s.id_sekolah = $id_sekolah ";//id_sekolah siswa GANTI
		$sql .= "AND s.status_belajar = 'aktif' ";
		$sql .= "AND ((ks.id_kelas IS NULL AND ks.id_th_ajaran = ".$this->session->userdata('th_ajaran_aktif').")  OR 
				(k.id_kelas IS NOT NULL AND k.id_th_ajaran = ".$this->session->userdata('th_ajaran_aktif').")) ";
		
		$sql .= 'AND ( ';
		$i = 0;
		foreach ($this->column as $item) 
		{
			if(isset($_POST['search']['value'])){
				if($i === 0){
					$sql .= $item." LIKE '%".$_POST['search']['value']."%' ";
				}else{
					$sql .= "OR ".$item." LIKE '%".$_POST['search']['value']."%' ";
				}
			}
			$column[$i] = $item;
			$i++;
		}
		$sql .= ') ';
		
		if(isset($id_kelas))
			$sql .= 'AND k.id_kelas='.$id_kelas.' ';
		
		if(isset($_POST['order'])){
			$sql .= "ORDER BY ".$column[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir']." ";
		}
		return $sql;
	}
	function get_datatables($id_sekolah, $id_kelas)
	{
		$sql = $this->_get_datatables_query($id_sekolah, $id_kelas);
		if($_POST['length'] != -1){
			$sql .= "LIMIT ".$_POST['start'].", ".$_POST['length']."";
		}
		$sql = $this->db->query($sql);
		return $sql->result();
		
	}
	function count_filtered($id_sekolah, $id_kelas)
	{
		$sql = $this->_get_datatables_query($id_sekolah, $id_kelas);
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function count_all($id_sekolah)
	{
		$sql = '';
		$sql .= "SELECT s.nis ";
		$sql .= "FROM siswa s ";
		$sql .= "JOIN kelas_siswa ks ON (s.nis=ks.nis) ";
		$sql .= "LEFT JOIN kelas k ON (ks.id_kelas=k.id_kelas) ";
		$sql .= "LEFT JOIN th_ajaran ta ON (k.id_th_ajaran=ta.id_th_ajaran) ";//tam
		$sql .= "WHERE s.id_sekolah = $id_sekolah ";//id_sekolah siswa GANTI
		$sql .= "AND s.status_belajar = 'aktif' ";
		$sql .= "AND ((ks.id_kelas IS NULL AND ks.id_th_ajaran = ".$this->session->userdata('th_ajaran_aktif').")  OR 
				(k.id_kelas IS NOT NULL AND k.id_th_ajaran = ".$this->session->userdata('th_ajaran_aktif').")) ";
		return $this->db->query($sql)->num_rows();
	}
	function get_by_id($id)
	{
		$this->db->query('set lc_time_names = "id_ID";');
		$this->db->select("
			s.*, o.*,
			(CASE s.jk_siswa WHEN 'L' THEN 'Laki-laki' WHEN 'P' THEN 'Perempuan' END) jk,
			DATE_FORMAT(s.tgl_lhr_siswa, '%d-%m-%Y') tgl_lhr_siswa,
			DATE_FORMAT(s.diterima_tgl_siswa, '%d-%m-%Y') diterima_tgl_siswa,
			DATE_FORMAT(s.tgl_lhr_siswa, '%d %M %Y') tgl_lahir,
			DATE_FORMAT(s.diterima_tgl_siswa, '%d %M %Y') tgl_terima,
			pa.nama_pek ayah_pek, pi.nama_pek ibu_pek, pw.nama_pek
			wali_pek, k.nama_kelas
		");
		$this->db->from('siswa s');
		$this->db->join('ortu o', 's.nis=o.nis', 'left');
		$this->db->join('pek pa', 'o.pek_ayah=pa.pek_id', 'left');
		$this->db->join('pek pi', 'o.pek_ibu=pi.pek_id', 'left');
		$this->db->join('pek pw', 'o.pek_wali=pw.pek_id', 'left');
		$this->db->join('kelas_siswa ks', 'ks.nis=s.nis');
		$this->db->join('kelas k', 'ks.id_kelas=k.id_kelas', 'left');
		$this->db->where('ks.id_th_ajaran',$this->session->userdata('th_ajaran_aktif'));
		$this->db->where('s.nis',$id);
		$query = $this->db->get();
		
		return $query->row();
	}
	function add_siswa($siswa, $ortu, $kelas_siswa)
	{
		$this->db->trans_start();
		$this->db->insert('siswa', $siswa);
		$this->db->insert('ortu', $ortu);
		$this->db->insert('kelas_siswa', $kelas_siswa);
		if($this->db->trans_status() == FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_complete();
		return $this->db->affected_rows();
	}
	function update_siswa($where_siswa, $where_ortu, $siswa, $ortu)
	{
		$this->db->update('ortu', $ortu, $where_ortu);
		$this->db->update('siswa', $siswa, $where_siswa);
		return $this->db->affected_rows();
	}
	function delete_siswa($siswa, $where_siswa)
	{
		$this->db->update('siswa', $siswa, $where_siswa);
		return $this->db->affected_rows();
	}
	
	function jlm_siswa_pergrade($id_sekolah, $th_ajaran){
		$sql = "SELECT grade, COUNT(*) jlm_siswa
				FROM siswa s
				JOIN kelas_siswa USING (nis)
				JOIN kelas USING (id_kelas)
				JOIN th_ajaran ON (th_ajaran.id_th_ajaran=kelas.`id_th_ajaran`) 
				WHERE s.id_sekolah=$id_sekolah
				AND kelas_siswa.id_th_ajaran = $th_ajaran 
				GROUP BY grade
				ORDER BY id_kelas";
		return $this->db->query($sql)->result();
	}
	function jlm_siswa($id_sekolah, $th_ajaran){
		$sql = "SELECT 'Total Siswa' total, COUNT(*) jlm_siswa
				FROM siswa s
				JOIN kelas_siswa USING (nis)
				JOIN kelas USING (id_kelas)
				JOIN th_ajaran ON (th_ajaran.id_th_ajaran=kelas.`id_th_ajaran`) 
				WHERE s.id_sekolah=$id_sekolah
				AND kelas_siswa.id_th_ajaran = $th_ajaran";
		return $this->db->query($sql)->row_array();
	}
	
	/* End Data Siswa */
	
	
	/* Data Nilai Siswa */
	
	/* End Data Nilai Siswa */
	
	
	/* Data Absensi Siswa */
	
	/* End Data Absensi Siswa */
}