<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('menu')){
	function menu(){
		$ci = &get_instance();
		//$ci->load->model('m_setting');
		$res = '';
		$menu = $ci->m_setting->getmenu()->result_array();
		foreach($menu as $m){
			$class = '';
			($m['url'] == '#')? $class = 'class="treeview"': $class = '';
			$res .= '<li '.$class.'>';
				$res .= '<a href="'.site_url($m['url']).'">';
				$res .= '<i class="fa '.$m['icon'].'"></i>';
				$res .= '<span>'.$m['title'].'</span>';
				($m['url'] == '#')? $res .= '<i class="fa fa-angle-left pull-right"></i>': $res .= '';
				$res .= '</a>';
				if($m['url'] == '#'){
					$res .= '<ul class="treeview-menu">';
					$submenu = $ci->m_setting->getsubmenu($m['id_menu'])->result_array();
					foreach($submenu as $sm){
						$res .= '<li><a href="'.site_url($sm['url']).'"><i class="fa '.$sm['icon'].'"></i>'.$sm['title'].'</a></li>';	
					}
					$res .= '</ul>';
				}
			$res .= '</li>';
		}
		return $res;
	}
}