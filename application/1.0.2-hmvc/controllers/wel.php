<?php

class Wel extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->module('about');
	}
	
	public function index(){
		echo 'Wel Controller CI';
		
		$this->about->call_about();
	}
}