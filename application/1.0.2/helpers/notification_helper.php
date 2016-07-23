<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('notif'))
{
	function notif()
	{
		$ci = &get_instance();
		$notif = '';
		$msg = $ci->session->flashdata('message');
		if($msg){
			$icon = '';
			foreach($msg as $val=>$key){
				if($key['tingkatan'] == '')
					$icon = 'info';
				elseif($key['tingkatan'] == 'success')
					$icon = 'check';
				elseif($key['tingkatan'] == 'warning')
					$icon = 'warning';
				elseif($key['tingkatan'] == 'danger')
					$icon = 'ban';
				echo '
				<div class="alert alert-'.$key['tingkatan'].' alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<h4><i class="icon fa fa-'.$icon.'"></i>'.$key['header'].'</h4>
					'.$key['message'].'
				</div>
				';
			}
		}
	}
}

if(!function_exists('pnotif')){
	function pnotif(){
		$ci = &get_instance();
		$msg = $ci->session->flashdata('pnotif');
		$notif = '';
		if($msg){
			$notif .= '<script>';
			foreach($msg as $val=>$key){
				$notif .= 'show_stack_bottomright("'.$key['type'].'", "'.$key['title'].'", "'.$key['text'].'");';
			}
			$notif .= '</script>';	
		}
		return $notif;
	}
}

if (!function_exists('set_notif'))
{
	function set_notif($tingkatan, $message)
	{
		$ci = &get_instance();
		$message = array();
		$message[] = array(
			'tingkatan'=>$tingkatan,
			'message'=> $message
		);
		$ci->session->set_flashdata('message', $message);
	}
}
