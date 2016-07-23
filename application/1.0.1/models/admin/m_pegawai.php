<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_pegawai extends CI_Model{
	var $column = array('nupk_guru', 'nupk_2_guru', 'nama_guru');//kolom search
	var $order = array('nupk_guru'=>'desc');
	
	private function _get_datatables_query()
	{
		$this->db->select('nupk_guru, nupk_2_guru, nama_guru, hp_guru, jabatan_guru');
		$this->db->from('guru');
		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables($jab)
	{
		$this->_get_datatables_query();
		$this->db->like('jabatan_guru', $jab);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered($jab)
	{
		$this->_get_datatables_query();
		$this->db->like('jabatan_guru', $jab);
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_all($jab)
	{
		$this->db->from('guru g');
		$this->db->join('pend p', 'g.pend_guru=p.id_pend', 'left');
		$this->db->like('jabatan_guru', $jab);
		return $this->db->count_all_results();
	}
	function get_by_id($id){
		$this->db->query('set lc_time_names = "id_ID";');
		$this->db->select(
			'g.*, DATE_FORMAT(tgl_lhr_guru, "%d %M %Y") guru_tanggal_lahir,
			DATE_FORMAT(trm_tgl_guru, "%d %M %Y") guru_tanggal_terima,
			p.nama_pend guru_pendidikan_terakhir
			');
		$this->db->from('guru g');
		$this->db->join('pend p', 'g.pend_guru=p.id_pend', 'left');
		$this->db->where('nupk_guru',$id);
		$query = $this->db->get();
		
		return $query->row();
	}
	
	function add_guru($guru){
		$this->db->insert('guru', $guru);
		return $this->db->affected_rows();
	}
	
	function update_guru($where, $guru){
		$this->db->update('guru', $guru, $where);
		return $this->db->affected_rows();
	}
	
	function delete_guru($nupk){
		$this->db->where('nupk_guru', $nupk);
		$this->db->delete('guru');
	}
}