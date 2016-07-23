 <?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_mapel extends CI_Model {
	
	var $table = 'mapel';
	var $columns = array('kd_mapel', 'nama_mapel');
	
	function sekolah(){
		return $this->db->get('sekolah')->result();
	}
	
	private function _get_datatables_query()
	{
		$this->db->select($this->columns);
		$this->db->from($this->table);
		$i = 0;
	
		foreach ($this->columns as $item) 
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
	function get_datatables_smp()
	{
		$this->db->select('km.*');
		$this->db->join('kel_mapel km', 'mapel.id_kel_mapel=km.id_kel_mapel', 'left');
		$this->db->where("SUBSTRING_INDEX(kd_mapel, '-', 1)=", "SMP");
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered_smp()
	{
		$this->db->where("SUBSTRING_INDEX(kd_mapel, '-', 1)=", "SMP");
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_all_smp()
	{
		$this->db->from($this->table);
		$this->db->where("SUBSTRING_INDEX(kd_mapel, '-', 1)=", "SMP");
		return $this->db->count_all_results();
	}
	function get_datatables_sma()
	{
		$this->db->select('km.*, tm.*');
		$this->db->join('kel_mapel km', 'mapel.id_kel_mapel=km.id_kel_mapel', 'left');
		$this->db->join('tingkat_kel_mapel tm', 'mapel.id_tingkat=tm.id_tingkat', 'left');
		$this->db->where("SUBSTRING_INDEX(kd_mapel, '-', 1)=", "SMA");
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered_sma()
	{
		$this->db->where("SUBSTRING_INDEX(kd_mapel, '-', 1)=", "SMA");
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_all_sma()
	{
		$this->db->from($this->table);
		$this->db->where("SUBSTRING_INDEX(kd_mapel, '-', 1)=", "SMA");
		return $this->db->count_all_results();
	}
	function get_by_id_smp($kd_mapel){
		$this->db->from($this->table);
		$this->db->join('kel_mapel km', 'mapel.id_kel_mapel=km.id_kel_mapel', 'left');
		$this->db->where('kd_mapel',$kd_mapel);
		$query = $this->db->get();
		return $query->row();
	}
	function get_by_id_sma($kd_mapel){
		$this->db->from($this->table);
		$this->db->join('kel_mapel km', 'mapel.id_kel_mapel=km.id_kel_mapel', 'left');
		$this->db->join('tingkat_kel_mapel tm', 'mapel.id_tingkat=tm.id_tingkat', 'left');
		$this->db->where('kd_mapel',$kd_mapel);
		$query = $this->db->get();
		return $query->row();
	}
	function add_mapel($mapel){
		$this->db->insert($this->table, $mapel);
		return $this->db->affected_rows();
	}
	function update_mapel($where, $mapel){
		$this->db->update($this->table, $mapel, $where);
		return $this->db->affected_rows();
	}
	function delete_mapel($kd_mapel){
		$this->db->where('kd_mapel', $kd_mapel);
		$this->db->delete($this->table);
	}

	
}