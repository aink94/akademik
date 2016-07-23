<?php

require_once 'another_controller.php';
class My_controller extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index(){
		echo 'My_controller';
		$data = new Another_Controller();
		echo '<br>';
		$data->auth();
	}
}

