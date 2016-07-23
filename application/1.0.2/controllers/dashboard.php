<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('css_js', 'menu'));
        $this->load->config('css_js');
        $this->load->library('phpserial');
        if(!$this->session->userdata('login'))redirect('authentication');
	}
	
	function index(){
		$data = array();
		$message = array();
		add_css(array(0, 1, 2, 3, 4));
		add_js(array(22, 0, 31, 13, 1, 3));
		$data['title'] = 'Dasboard';
		
		$this->breadcrumbs->push('Dashboard', '/dashboard');
		$this->breadcrumbs->push('Page', '/dasboard/page');
		
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		$this->load->view('left', $data);
		$this->load->view('content_blank', $data);
		$this->load->view('footer', $data);
		//Java Script per-Page
		$data['js'] = "";
		$this->load->view('foot', $data);
	}
	
	function coba(){
		$this->phpserial->deviceSet("");
		$this->phpserial->confBaudRate();
		$this->phpserial->confParity("none");
		$this->phpserial->confCharacterLength(8);
		$this->phpserial->confStopBits(1);
		$this->phpserial->confFlowControl("none");
		$this->phpserial->deviceOpen();
		$this->phpserial->sendMessage("1");
		$this->phpserial->deviceClose();
	}
}