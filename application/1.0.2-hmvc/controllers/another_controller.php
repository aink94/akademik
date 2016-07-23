<?php

class Another_Controller extends My_controller{
	public function __construct(){
		parent::__construct();
	}
	
	public function auth(){
		echo 'Another_Controller';
	}
}