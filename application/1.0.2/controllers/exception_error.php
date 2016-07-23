<?php

class Exception_error extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('css_js', 'menu'));
        $this->load->config('css_js');
        if(!$this->session->userdata('login'))redirect('authentication');
	}
	
	function index(){
		$data = array();
		$message = array();
		add_css(array(0, 1, 2, 3, 4));
		add_js(array(22, 0, 31, 13, 1, 3));
		$data['title'] = '404 Page Not Found';
		$this->output->set_status_header('404'); 
		
		$this->breadcrumbs->push('<i class="fa fa-home"></i> Home', '/dashboard');
		$this->breadcrumbs->push('404 error', '/erorr_404/index');
		
		$this->output->set_status_header('404');
		
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		$this->load->view('left', $data);
		$this->load->view('error_404', $data);
		$this->load->view('footer', $data);
		//Java Script per-Page
		$data['js'] = "";
		$this->load->view('foot', $data);
	}
}