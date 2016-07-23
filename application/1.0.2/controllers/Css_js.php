<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class css_js extends CI_Controller {
	public function index()
	{
		$this->load->config('css_js');
		$css = $this->config->item('css');
		$js = $this->config->item('js');
		
		for($i=0; $i<sizeof($css); $i++){
			$config['css']['css_'.$i] = $css[$i];
		}
		for($i=0; $i<sizeof($js); $i++){
			$config['js']['js_'.$i] = $js[$i];
		}
		header('COntent-Type: application/json');
		echo json_encode($config);
	}
	
	public function icon(){
		$this->load->config('icon');
		$icon = $this->config->item('icon');
		for($i=0; $i<count($icon); $i++){
			echo $icon[$i];
			echo '<br></br>';
		}
		//echo json_encode($icon);
	}
}
