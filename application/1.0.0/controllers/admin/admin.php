<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	var $title = 'Page Admin';
	var $path = 'admin';
	
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data = array(
			'title' => $this->title,
			'leftSide' => $this->path.'/leftadmin',
			'content' => $this->path.'/content'
		);
		
		$this->load->view('template', $data);
	}
}