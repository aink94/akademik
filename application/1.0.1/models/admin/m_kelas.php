<?php

class M_kelas extends CI_Model {
	var $table = 'kelas';
	var $columns = array('nama_kelas', 'nama_th_ajaran', 'nama_guru');
	//var $order = array('kelas.id_sekolah'=>'DESC', 'kelasf.id_kelas'=>'ASC');
	
	function sekolah(){
		return $this->db->get('sekolah')->result();
	}
	function kelas($id_sekolah){
		$this->db->where('id_sekolah', $id_sekolah);
		$this->db->where('id_th_ajaran', intval($this->session->userdata('th_ajaran_aktif'))-1);
		return $this->db->get('kelas')->result();
	}
	
	private function _get_datatables_query($id_sekolah)
	{
		$this->db->select('id_kelas, nama_kelas, nama_th_ajaran, nama_guru, nupk_guru, id_sekolah');
		$this->db->from('kelas');
		$this->db->join('guru', 'kelas.nupk_wali=guru.nupk_guru', 'left');
		$this->db->join('th_ajaran', 'kelas.id_th_ajaran=th_ajaran.id_th_ajaran');
		$this->db->where('kelas.id_th_ajaran', $this->session->userdata('th_ajaran_aktif'));
		
		$i = 0;
		foreach ($this->columns as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		if(isset($id_sekolah)){
			$this->db->where('kelas.id_sekolah', $id_sekolah);
		}
		$this->db->order_by('kelas.id_sekolah', 'DESC');
		$this->db->order_by('kelas.id_kelas', 'ASC');
	}
	function get_datatables($id_sekolah)
	{
		$this->_get_datatables_query($id_sekolah);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered($id_sekolah)
	{
		$this->_get_datatables_query($id_sekolah);
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_all()
	{
		$this->db->from('kelas');
		$this->db->join('guru', 'kelas.nupk_wali=guru.nupk_guru', 'left');
		$this->db->join('th_ajaran', 'kelas.id_th_ajaran=th_ajaran.id_th_ajaran', 'left');
		$this->db->where('kelas.id_th_ajaran', $this->session->userdata('th_ajaran_aktif'));
		return $this->db->count_all_results();
	}
	
	function get_data_siswa_kelas($id_kelas){
		$this->db->select('siswa.nis, siswa.nisn, siswa.nama_siswa');
		$this->db->from('kelas');
		$this->db->join('kelas_siswa', 'kelas.id_kelas=kelas_siswa.id_kelas');
		$this->db->join('siswa', 'siswa.nis=kelas_siswa.nis');
		$this->db->where('kelas_siswa.id_kelas', $id_kelas);
		$this->db->order_by('siswa.nama_siswa', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_data_mapel_kelas($id_kelas){
		$this->db->select('kelas.id_kelas, kelas_mapel.kd_mapel, kelas_mapel.id_kelas_mapel, nupk_mengajar, nama_kelas, nama_mapel, nama_kel_mapel, nama_tingkat, nama_guru');
		$this->db->from('kelas');
		$this->db->join('kelas_mapel', 'kelas_mapel.id_kelas=kelas.id_kelas', 'left');
		$this->db->join('mapel', 'mapel.kd_mapel=kelas_mapel.kd_mapel', 'left');
		$this->db->join('kel_mapel', 'kel_mapel.id_kel_mapel=mapel.id_kel_mapel', 'left');
		$this->db->join('tingkat_kel_mapel', 'tingkat_kel_mapel.id_tingkat=mapel.id_tingkat', 'left');
		$this->db->join('mengajar', 'mengajar.id_kelas_mapel=kelas_mapel.id_kelas_mapel', 'left');
		$this->db->join('guru', 'guru.nupk_guru=mengajar.nupk_mengajar', 'left');
		$this->db->where('kelas_mapel.id_kelas', $id_kelas);
		$query = $this->db->get();
		return $query->result();
	}
	
	function update_wali($where, $wali){
		$this->db->update('kelas', $wali, $where);
		return $this->db->affected_rows();
	}
	
	function tambah_kelas($kelas){
		$this->db->insert('kelas', $kelas);
		return $this->db->affected_rows();
	}
	
	function select_mapel_kosong($id_sekolah, $id_kelas){
		$sql = "
		SELECT mapel.kd_mapel, mapel.nama_mapel, nama_tingkat, nama_kel_mapel FROM mapel 
		LEFT JOIN tingkat_kel_mapel USING (id_tingkat) 
		LEFT JOIN kel_mapel USING (id_kel_mapel) 
		WHERE SUBSTRING(kd_mapel, 1, 3) = CASE $id_sekolah WHEN 1 THEN 'SMA' ELSE 'SMP' END 
		AND mapel.kd_mapel NOT IN (SELECT kd_mapel FROM mapel 
		JOIN kelas_mapel USING (kd_mapel) 
		WHERE id_kelas = $id_kelas )
		ORDER BY   id_kel_mapel ASC, id_tingkat ASC 
		";
		return $this->db->query($sql)->result();
	}
	
	function tambah_kelas_mapel($kelas_mapel){
		$this->db->insert_batch('kelas_mapel', $kelas_mapel);
		return $this->db->affected_rows();
	}
	function hapus_kelas_mapel($kd_mapel, $id_kelas){
		$this->db->where('kd_mapel', $kd_mapel);
		$this->db->where('id_kelas', $id_kelas);
		$this->db->delete('kelas_mapel');
		return $this->db->affected_rows();
	}
	
	function select_siswa_no($id_sekolah, $id_kelas_lama){
		$sql = "";
		$sql .= "
		SELECT nis, nama_siswa, id_kelas FROM siswa 
		JOIN kelas_siswa USING (nis) 
		WHERE status_belajar='aktif' 
		AND id_sekolah=$id_sekolah
		AND  
		( 
			(id_kelas IS NULL AND id_th_ajaran = ".$this->session->userdata('th_ajaran_aktif').") 
			OR 
			( 
			id_th_ajaran = ".$this->session->userdata('th_ajaran_aktif')." - 1 AND nis NOT IN  
			    ( 
			    SELECT nis FROM siswa 
			    JOIN kelas_siswa USING (nis) 
			    WHERE id_th_ajaran = ".$this->session->userdata('th_ajaran_aktif')." AND id_kelas IS NOT NULL 
			    ) ";
		if(isset($id_kelas_lama))
			$sql .= "and id_kelas = ".$id_kelas_lama;
			$sql .=" 
			) 
		)
		";
		return $this->db->query($sql)->result();
	}
	function tambah_siswa_kelas($kelas_siswa){
		$this->db->insert_batch('kelas_siswa', $kelas_siswa);
		return $this->db->affected_rows();
	}
	function hapus_kelas_siswa($nis, $id_kelas){
		$this->db->where('nis', $nis);
		$this->db->where('id_kelas', $id_kelas);
		$this->db->delete('kelas_siswa');
		return $this->db->affected_rows();
	}
}
?>