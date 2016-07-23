<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('akses_login')){
	function akses_login(){
		if(is_admin())
			redirect('admin/admin');
		elseif(is_staff())
			redirect('staff/staff');
		elseif(is_kepsek_sma() OR is_kepsek_smp() OR is_kepsek_smp_putri())
			redirect('kepsek/kepsek');
		elseif(is_wakasek_kurikulum() OR is_wakasek_sarana() OR is_wakasek_siswa())
			redirect('wakasek/wakasek');
		elseif(is_guru())
			redirect('guru/guru');
	}
}

if(!function_exists('is_login')){
	function is_login(){
		$_CI =& get_instance();
		if($_CI->session->userdata('login')){
			$_CI->load->model('M_auth');
			$nupk = $_CI->session->userdata('nupk');
			$cek = $_CI->M_auth->cek_nupk($nupk);
			if($cek->num_rows() == 1)
				return TRUE;
			else
				return FALSE;
		}
	}
}

if(!function_exists('is_admin')){
	function is_admin(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('ADMIN', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_staff')){
	function is_staff(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('STAFF', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_kepsek_sma')){
	function is_kepsek_sma(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('KEPALA SMA', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_kepsek_smp')){
	function is_kepsek_smp(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('KEPALA SMP', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_kepsek_smp_putri')){
	function is_kepsek_smp_putri(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('KEPALA SMP PUTRI', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_wakasek_siswa')){
	function is_wakasek_siswa(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('WAKASEK KESISWAAN', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_wakasek_kurikulum')){
	function is_wakasek_kurikulum(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('WAKASEK KURIKULUM', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_wakasek_sarana')){
	function is_wakasek_sarana(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if(in_array('WAKASEK SARANA', $akses, TRUE))
			return TRUE;
		else
			return FALSE;
	}
}

if(!function_exists('is_guru')){
	function is_guru(){
		$_CI =& get_instance();
		$akses = $_CI->session->userdata('akses');
		$akses = explode(',', $akses);
		if((in_array('GURU SMP', $akses, TRUE)) OR (in_array('GURU SMA', $akses, TRUE)))
			return TRUE;
		else
			return FALSE;
	}
}