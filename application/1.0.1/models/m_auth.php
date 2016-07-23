<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function login_m($nupk, $pass){
		$q = "SELECT nupk_guru, nama_guru, jabatan_guru, pangkat_guru, foto_guru FROM guru WHERE nupk_guru='$nupk' AND pass_guru=md5('$pass');";
		return $this->db->query($q);
	}
	
	function cek_nupk($nupk){
		$q = "SELECT nupk_guru FROM guru WHERE nupk_guru='$nupk'";
		return $this->db->query($q);
	}
}