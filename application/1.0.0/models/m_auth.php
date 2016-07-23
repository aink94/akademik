<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function login_m($nupk, $pass){
		$q = "SELECT nupk, nama, jabatan, foto FROM guru WHERE nupk='$nupk' AND pass=md5('$pass');";
		return $this->db->query($q);
	}
	
	function cek_nupk($nupk){
		$q = "SELECT nupk FROM guru WHERE nupk='$nupk'";
		return $this->db->query($q);
	}
}