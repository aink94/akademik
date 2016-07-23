<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('css_js'));
        $this->load->config('css_js');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_authentication', 'auth');
	}
	
	function index(){
		if($this->session->userdata('login'))redirect('dashboard');
		$data = array();
		$notif = array();
		add_css(array(0, 1, 2, 3, 15));
		add_js(array(22, 0, 17));
		$data['title'] = 'Login';
		
		
		$this->form_validation->set_rules('user_name', 'Username', 'required');
		$this->form_validation->set_rules('user_pass', 'Password', 'required');
		if($this->form_validation->run() === TRUE){
			$user = $this->input->post('user_name', TRUE);
			$pass = $this->input->post('user_pass', TRUE);
			
			$select = array('id, nama, status, foto');
			$where = array('user_name'=>$user, 'user_pass'=>$pass);
			
			$result = $this->auth->check_login($select,'', $where);
			if($result->num_rows() == 1){
				$result = $result->row_array();
				$login = array(
					'login'=>TRUE,
					'nama_karyawan'=>$result['nama_karyawan'],
					'id_karyawan'=>$result['id_karyawan'],
					'foto_karyawan'=>$result['foto'],
					'status_karyawan'=>$result['status']
				);
				$time = date("Y-m-d h:i:s");
				$id_session = $this->session->session_id;
				$this->auth->set_login($result['id_karyawan'], $time, $id_session);
				$this->session->set_userdata($login);
				$notif[] = array(
					'type'=>'success',
					'title'=>'Berhasil Login',
					'text'=> 'Hore anda Berhasil Login'
				);
				$this->session->set_flashdata('pnotif', $notif);
				redirect('dashboard', 'refresh');
			}else{
				$notif[] = array(
					'type'=>'error',
					'title'=>'Gagal Login',
					'text'=> 'Username atau Password yang anda masukan Salah'
				);
				$this->session->set_flashdata('pnotif', $notif);
			}
			
		}
		
		
		if((validation_errors())){
			if(form_error('user_name')):
				$notif[] = array(
					'type'=>'error',
					'title'=>'Gagal Login',
					'text'=> form_error('user_name')
				);
			endif;
			if(form_error('user_pass')):
				$notif[] = array(
					'type'=>'error',
					'title'=>'Gagal Login',
					'text'=> form_error('user_pass')
				);
			endif;
			$this->session->set_flashdata('pnotif', $notif);
		}
		
		$this->load->view('head', $data);
		$this->load->view('login', $data);
		
		$data['js'] = "
		<script>
			$(function () {
				$('input[type=".'"checkbox"'."]').iCheck({
					checkboxClass: 'icheckbox_square-blue',
      				radioClass: 'iradio_square-blue'
				});
			});
		</script>
		";
		
		$this->load->view('foot', $data);
		
	}
	
	function logout(){
		$user_data = $this->session->all_userdata();
		//header('Content-Type: application/json');
		//echo json_encode($user_data);
        foreach ($user_data as $key => $value) {
        	$this->session->unset_userdata($key);
            /*
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
            */
        }
		$notif = array();
		$notif[] = array(
			'type'=>'info',
			'title'=>'Information',
			'text'=> 'Anda berhasil Logout'
		);
		$this->session->set_flashdata('pnotif', $notif);
		redirect('authentication/index', 'refresh');
	}
	
}