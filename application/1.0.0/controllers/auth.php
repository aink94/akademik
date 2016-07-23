<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('M_auth');
	}
	
	function index(){
		if(is_login())akses_login();
		$data['title'] = 'Log In';
		$data['url'] = current_url();
		$this->__rule();
		if($this->form_validation->run()){
			$nupk = $this->anti_injection($this->input->post('nupk', TRUE));
			$pass = $this->anti_injection($this->input->post('pass', TRUE));
			$log = $this->M_auth->login_m($nupk, $pass);
			if($log->num_rows()==1){
				$log = $log->row_array();
				$login = array(
							'nupk'=>$log['nupk'], 
							'username'=>$log['nama'], 
							'akses'=>$log['jabatan'],
							'foto'=>$log['foto'],
							'login'=>TRUE
				);
				$this->session->set_userdata($login);
				akses_login();
			}else{
				$this->session->set_flashdata('msg', '<p class="login-box-msg">NUPK atau password yang anda masukkan salah</p>');
			}
		}
		$this->load->view('login/login', $data);
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}
	
	function anti_injection($data){
		$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
		return $filter;
	}
	
	function __rule(){
		$this->form_validation->set_rules('nupk', 'NUPK', 'trim|required');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}
}