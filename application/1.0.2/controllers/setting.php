<?php

class Setting extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('css_js', 'menu'));
        $this->load->config('css_js');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_setting', 'setting');
        if($this->session->userdata('login') == FALSE)redirect('authentication');
	}
	
	function index(){
		$data = array();
		$message = array();
		add_css(array(0, 1, 2, 3, 4));
		add_js(array(22, 23, 0, 31, 13, 1, 3));
		$data['title'] = 'Setting profil';
		
		$this->breadcrumbs->push('Setting', '/setting');
		
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		$this->load->view('left', $data);
		$this->load->view('content_setting', $data);
		$this->load->view('footer', $data);
		$data['js'] = "";
		$this->load->view('foot', $data);
	}
	
	function menu(){
		if($this->session->userdata('status_karyawan') != 'admin')show_404();
		
		$data = array();
		$message = array();
		add_css(array(0, 1, 2, 3, 4, 22, 23));
		add_js(array(22, 23, 0, 31, 13, 1, 3, 31, 34));
		$data['title'] = 'Setting Menu';
		
		$this->breadcrumbs->push('Setting', '/setting');
		$this->breadcrumbs->push('Menu', '/setting/menu');
		
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		$this->load->view('left', $data);
		$this->load->view('content_setting_menu', $data);
		$this->load->view('footer', $data);
		//Java Script per-Page
		//$('#form-tambah-menu').serialize()
		
		$data['js'] = "
		<script type='text/javascript'>
		$(function(){
			'use strict';
			$('[name=".'"btn_simpan_menu"'."]').click(function(){
				var titlex = $('[name=".'"title"'."]').val();
				var urlx = $('[name=".'"url"'."]').val();
				var levelx = $('select[name=".'"level_menu"'."]').val();
				var iconx = $('[name=".'"icon"'."]').val();
				$.post('".site_url('setting/tambahmenu')."', 
					{title: titlex, url:urlx, level_menu:levelx, icon:iconx} )
					.done(function(data){
						console.log($('select[name=".'"level_menu"'."]').val());
						show_stack_bottomright(data[0].type, data[0].title, data[0].text);
						if(data[0].type == 'success'){
							$('#tambah-menu').modal('hide');
							location.reload();
						}
					})
					.fail(function(){alert('error')});
			});
			$('[name=".'"btn_simpan_submenu"'."]').click(function(){
				var idmenux = $('[name=".'"id_menu"'."]').val();
				var titlex = $('[name=".'"title_submenu"'."]').val();
				var urlx = $('[name=".'"url_submenu"'."]').val();
				var levelx = $('select[name=".'"level_submenu"'."]').val();
				var iconx = $('[name=".'"icon_submenu"'."]').val();
				$.post('".site_url('setting/tambahsubmenu')."', 
					{id_menu:idmenux, title_submenu:titlex, url_submenu:urlx, level_submenu:levelx, icon_submenu:iconx} )
					.done(function(data){
						show_stack_bottomright(data[0].type, data[0].title, data[0].text);
						if(data[0].type == 'success'){
							$('#tambah-submenu').modal('hide');
							location.reload();
						}
					})
					.fail(function(){
						alert('error');
					});
			});
			$('button#btn-edit-menu').on('click', function(e){
				var id = $(this).data('id');
				$.ajax({
					type: 'POST',
					url: '".site_url('setting/getmenu')."',
					data: {id_menu:id},
					dataType: 'json',
					cache: false,
					beforeSend: function(){
						console.log('Loading . . . ');
					},
					success: function(data){
						$('#update-menu input[name=".'"id_menu"'."]').val(data[0].id_menu);
						$('#update-menu input[name=".'"title"'."]').val(data[0].title);
						$('#update-menu input[name=".'"url"'."]').val(data[0].url);
						var level = '';
						var res = '';
						if(data[0].level){
							level = data[0].level;
							res = level.split(',');
						}else{
							res = '';
						}				
						$('#update-menu select[name=".'"level_menu"'."]').val(res);
						$('#update-menu select[name=".'"icon"'."]').val(data[0].icon);
						$('.selectpicker').selectpicker('refresh');
					}
				});
			});
			$('[name=".'"btn_simpan_update_menu"'."]').on('click', function(e){
				var idmenux = $('#update-menu [name=".'"id_menu"'."]').val();
				var titlex = $('#update-menu [name=".'"title"'."]').val();
				var urlx = $('#update-menu [name=".'"url"'."]').val();
				var levelx = $('#update-menu select[name=".'"level_menu"'."]').val();
				var iconx = $('#update-menu [name=".'"icon"'."]').val();
				$.ajax({
					type: 'POST',
					url: '".site_url('setting/updatemenu')."',
					data: {
						id_menu: idmenux, title: titlex, url: urlx, level: levelx, icon: iconx
					},
					dataType: 'json',
					cache: false,
					success: function(data){
						show_stack_bottomright(data[0].type, data[0].title, data[0].text);
						if(data[0].type == 'success'){
							$('#update-menu').modal('hide');
							location.reload();
						}
					}
				});
			});
			$('button#btn-edit-submenu').on('click', function(e){
				var id = $(this).data('id');
				$.ajax({
					type: 'POST',
					url: '".site_url('setting/getsubmenu')."',
					data: {id_submenu:id},
					dataType: 'json',
					cache: false,
					success: function(data){
						$('#update-submenu input[name=".'"id_submenu"'."]').val(data[0].id_submenu);
						$('#update-submenu input[name=".'"title_submenu"'."]').val(data[0].title);
						$('#update-submenu input[name=".'"url_submenu"'."]').val(data[0].url);
						
						var level = '';
						var res = '';
						if(data[0].level){
							level = data[0].level;
							res = level.split(',');
						}else{
							res = '';
						}
						$('#update-submenu select[name=".'"id_menu"'."]').val(data[0].id_menu);
						$('#update-submenu select[name=".'"level_submenu"'."]').val(res);
						$('#update-submenu select[name=".'"icon_submenu"'."]').val(data[0].icon);
						$('.selectpicker').selectpicker('refresh');
					}
				});
			});
			$('[name=".'"btn_simpan_update_submenu"'."]').on('click', function(e){
				var idsubmenux = $('#update-submenu [name=".'"id_submenu"'."]').val();
				var idmenux = $('#update-submenu [name=".'"id_menu"'."]').val();
				var titlex = $('#update-submenu [name=".'"title_submenu"'."]').val();
				var urlx = $('#update-submenu [name=".'"url_submenu"'."]').val();
				var levelx = $('#update-submenu select[name=".'"level_submenu"'."]').val();
				var iconx = $('#update-submenu [name=".'"icon_submenu"'."]').val();
				console.log(idsubmenux+idmenux+titlex+urlx+levelx+iconx);
				$.ajax({
					type: 'POST',
					url: '".site_url('setting/updatesubmenu')."',
					data: {
						id_submenu: idsubmenux, id_menu: idmenux, title: titlex, url: urlx, level: levelx, icon: iconx
					},
					dataType: 'json',
					cache: false,
					success: function(data){
						show_stack_bottomright(data[0].type, data[0].title, data[0].text);
						if(data[0].type == 'success'){
							$('#update-submenu').modal('hide');
							location.reload();
						}
					}
				});
			});
			$('button#btn-delete-menu').on('click', function(e){
				var id = $(this).data('id');
				var title = $(this).data('title');
				$('#delete-menu .text-menu-delete').text(title);
				$('#delete-menu input[name=".'"id"'."]').val(id);
			});
			$('#btn-save-delete-menu').click(function(){
				var id = $('#delete-menu input[name=".'"id"'."]').val();
				$.ajax({
					type: 'POST',
					url: '".site_url('setting/deletemenu')."',
					data: {
						id_menu: id
					},
					dataType: 'json',
					cache: false,
					success: function(data){
						show_stack_bottomright(data[0].type, data[0].title, data[0].text);
						if(data[0].type == 'success'){
							$('#delete-menu').modal('hide');
							location.reload();
						}
					}
				});
			});
			$('button#btn-delete-submenu').on('click', function(e){
				var id = $(this).data('id');
				var title = $(this).data('title');
				$('#delete-submenu .text-menu-delete').text(title);
				$('#delete-submenu input[name=".'"id"'."]').val(id);
			});
			$('#btn-save-delete-submenu').click(function(){
				var id = $('#delete-submenu input[name=".'"id"'."]').val();
				$.ajax({
					type: 'POST',
					url: '".site_url('setting/deletesubmenu')."',
					data: {
						id_submenu: id
					},
					dataType: 'json',
					cache: false,
					success: function(data){
						show_stack_bottomright(data[0].type, data[0].title, data[0].text);
						if(data[0].type == 'success'){
							$('#delete-submenu').modal('hide');
							location.reload();
						}
					}
				});
			});
		});
		</script>
		";
		$this->load->view('foot', $data);
	}
	
	function profil(){		
		$data = array();
		$message = array();
		add_css(array(0, 1, 2, 3, 4));
		add_js(array(22, 23, 0, 31, 13, 1, 3));
		$data['title'] = 'Setting profil';
		
		$this->breadcrumbs->push('Setting', '/setting');
		$this->breadcrumbs->push('profil', '/setting/profil');
		
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		$this->load->view('left', $data);
		$this->load->view('content_setting_profil', $data);
		$this->load->view('footer', $data);
		$data['js'] = "";
		$this->load->view('foot', $data);
	}
	
	function users(){
		$data = array();
		$message = array();
		add_css(array(0, 1, 2, 3, 4, 9));
		add_js(array(22, 23, 0, 31, 13, 1, 3, 8, 9));
		$data['title'] = 'Setting Users';
		
		$this->breadcrumbs->push('Setting', '/setting');
		$this->breadcrumbs->push('users', '/setting/users');
		
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		$this->load->view('left', $data);
		$this->load->view('content_setting_users', $data);
		$this->load->view('footer', $data);
		$data['js'] = "
		<script>
			$(function(){
				$('#table-karyawan').DataTable({
					'processing': true,
					'ajax': '".site_url('setting/getuserskaryawan')."',
					'columns': [
			            { 'data': 'nama' },
			            { 'data': 'status' },
			            { 'data': 'login_terakhir' },
			            { 'data': 'actions' }
			        ]
				});
				$('button#edit-karyawan').on('click', function(e){
					var id = $(this).data('id');
					$('#edit-users-karyawan .modal-title').text(id);
				});
				$('button#hapus-karyawan').on('click', function(e){
					var id = $(this).data('id');
					console.log(id);
				});
				$('button#btn-save-update-karyawan').on('click', function(){
					console.log();
				});
				$('button#btn-save-delete-karyawan').on('click', function(){
					console.log();
				});
				
			});
		</script>
		";
		$this->load->view('foot', $data);
	}
	
	/*Ajax */
	//Ajax Menu
	function tambahmenu(){
		$notif = array();
		
		$title = $this->input->post('title');
		$url = $this->input->post('url');
		$level = $this->input->post('level_menu');
		$icon = $this->input->post('icon');
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('level_menu', 'Hak Akses');
		$this->form_validation->set_rules('icon', 'Icon', 'required');
		
		if($this->form_validation->run() == TRUE){
			if(!empty($level)){
				$level = implode(',', $level);
				$data = array('title'=>$title, 'url'=>$url, 'level'=>$level, 'icon'=>$icon);
				$res = $this->setting->tambahmenu($data);
				if($res){
					$notif[] = array(
						'type'=>'success',
						'title'=>'Berhasil memasukan Data',
						'text'=> implode(', ', $data)
					);
				}else{
					$notif[] = array(
						'type'=>'error',
						'title'=>'Gagal memasukan Data',
						'text'=> $this->db->error()
					);
				}	
			}else{
				$notif[] = array(
					'type'=>'error',
					'title'=>'Gagal memasukan Data',
					'text'=> '<p>Hak Akses Tidak Boleh Kosong</p>'
				);
			}
		}else{
			$notif[] = array(
				'type'=>'error',
				'title'=>'Gagal Memasukan Data',
				'text'=> validation_errors()
			);
		}
		header('Content-Type: application/json');
		echo json_encode($notif);
	}
	
	function tambahsubmenu(){
		$notif = array();
		
		$id_menu = $this->input->post('id_menu');
		$title = $this->input->post('title_submenu');
		$url = $this->input->post('url_submenu');
		$level = $this->input->post('level_submenu');
		$icon = $this->input->post('icon_submenu');
		
		$this->form_validation->set_rules('id_menu', 'Menu', 'required');
		$this->form_validation->set_rules('title_submenu', 'Title', 'required');
		$this->form_validation->set_rules('url_submenu', 'URL', 'required');
		$this->form_validation->set_rules('level_submenu', 'Hak Akses', '');
		$this->form_validation->set_rules('icon_submenu', 'Icon', 'required');
		
		if($this->form_validation->run() == TRUE){
			if(!empty($level)){
				$level = implode(',', $level);
				
				$data = array('id_menu'=>$id_menu, 'title'=>$title, 'url'=>$url, 'level'=>$level, 'icon'=>$icon);
				$res = $this->setting->tambahsubmenu($data);
				if($res){
					$notif[] = array(
						'type'=>'success',
						'title'=>'Berhasil memasukan Data',
						'text'=> implode(', ', $data)
					);
				}else{
					$notif[] = array(
						'type'=>'error',
						'title'=>'Gagal memasukan Data',
						'text'=> $this->db->error()
					);
				}	
			}else{
				$notif[] = array(
					'type'=>'error',
					'title'=>'Gagal Memasukan Data',
					'text'=> '<p>Hak Akses Tidak Boleh Kosong</p>'
				);
			}
		}else{
			$notif[] = array(
				'type'=>'error',
				'title'=>'Gagal Memasukan Data',
				'text'=> validation_errors()
			);
		}
		header('Content-Type: application/json');
		echo json_encode($notif);
	}
	
	function getmenu(){
		$id_menu = $this->input->post('id_menu');
		$data = $this->db->get_where('menu_payment', array('id_menu'=>$id_menu))->result();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function getsubmenu(){
		$id_submenu = $this->input->post('id_submenu');
		$data = $this->db->get_where('submenu_payment', array('id_submenu'=>$id_submenu))->result();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function updatemenu(){
		$id_menu = $this->input->post('id_menu');
		$title = $this->input->post('title');
		$url = $this->input->post('url');
		$level = $this->input->post('level');
		$icon = $this->input->post('icon');
		
		$this->form_validation->set_rules('id_menu', 'Menu', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('level', 'Hak Akses', '');
		$this->form_validation->set_rules('icon', 'Icon', 'required');
		if($this->form_validation->run() == TRUE){
			if(!empty($level)){
				$level = implode(',', $level);
				
				$data = array('title'=>$title, 'url'=>$url, 'level'=>$level, 'icon'=>$icon);
				$where = $id_menu;
				$res = $this->setting->updatemenu($data, $where);
				
				if($res){
					$notif[] = array(
						'type'=>'success',
						'title'=>'Berhasil memasukan Data',
						'text'=> implode(', ', $data)
					);
				}else{
					$notif[] = array(
						'type'=>'error',
						'title'=>'Gagal memasukan Data DB Erorr',
						'text'=> $this->db->error()
					);
				}
			}else{
				$notif[] = array(
					'type'=>'error',
					'title'=>'Gagal Memasukan Data',
					'text'=> '<p>Hak Akses Tidak Boleh Kosong</p>'
				);
			}
		}else{
			$notif[] = array(
				'type'=>'error',
				'title'=>'Gagal Memasukan Data Validasi',
				'text'=> validation_errors()
			);
		}
		header('Content-Type: application/json');
		echo json_encode($notif);
	}

	function updatesubmenu(){
		$id_submenu = $this->input->post('id_submenu');
		$id_menu = $this->input->post('id_menu');
		$title = $this->input->post('title');
		$url = $this->input->post('url');
		$level = $this->input->post('level');
		$icon = $this->input->post('icon');
		
		$this->form_validation->set_rules('id_submenu', '', '');
		$this->form_validation->set_rules('id_menu', 'Menu', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('level', 'Hak Akses', '');
		$this->form_validation->set_rules('icon', 'Icon', 'required');
		if($this->form_validation->run() == TRUE){
			if(!empty($level)){
				$level = implode(',', $level);
				
				$data = array('id_submenu'=>$id_submenu, 'title'=>$title, 'url'=>$url, 'level'=>$level, 'icon'=>$icon);
				$where = $id_menu;
				$res = $this->setting->updatesubmenu($data, $where);
				
				if($res){
					$notif[] = array(
						'type'=>'success',
						'title'=>'Berhasil memasukan Data',
						'text'=> implode(', ', $data)
					);
				}else{
					$notif[] = array(
						'type'=>'error',
						'title'=>'Gagal memasukan Data DB',
						'text'=> $this->db->error()
					);
				}
			}else{
				$notif[] = array(
					'type'=>'error',
					'title'=>'Gagal Memasukan Data',
					'text'=> '<p>Hak Akses Tidak Boleh Kosong</p>'
				);
			}
		}else{
			$notif[] = array(
				'type'=>'error',
				'title'=>'Gagal Memasukan Data Validasi',
				'text'=> validation_errors()
			);
		}
		header('Content-Type: application/json');
		echo json_encode($notif);
	}

	function deletemenu(){
		$id_menu = $this->input->post('id_menu');
		$res = $this->setting->deletemenu($id_menu);
		if($res){
			$notif[] = array(
				'type'=>'success',
				'title'=>'Berhasil Menghapus Data',
				'text'=> 'Hore'
			);
		}else{
			$notif[] = array(
				'type'=>'error',
				'title'=>'Gagal Menghapus Data',
				'text'=> $this->db->error()
			);
		}
		header('Content-Type: application/json');
		echo json_encode($notif);
	}
	
	function deletesubmenu(){
		$id_submenu = $this->input->post('id_submenu');
		$res = $this->setting->deletesubmenu($id_submenu);
		if($res){
			$notif[] = array(
				'type'=>'success',
				'title'=>'Berhasil Menghapus Data',
				'text'=> 'Hore'
			);
		}else{
			$notif[] = array(
				'type'=>'error',
				'title'=>'Gagal Menghapus Data',
				'text'=> $this->db->error()
			);
		}
		header('Content-Type: application/json');
		echo json_encode($notif);
	}
	//End Ajax Menu
	
	//Ajax Users
	function getuserskaryawan(){
		$karyawan = $this->setting->getuserskaryawan();
		$karyawan = $karyawan->result();
		$data = array();
		foreach($karyawan as $k){
			$row = array();
			$row['nama'] = $k->nama_karyawan;
			$row['status'] = $k->status;
			$row['login_terakhir'] = $k->login_terakhir;
			$row['actions'] = '
			<div class="btn-group pull-right">
				<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#edit-users-karyawan" data-id="'.$k->id_karyawan.'" id="edit-karyawan"><i class="fa fa-edit"></i></button>	
				<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#delete-users-karyawan" data-id="'.$k->id_karyawan.'" id="hapus-karyawan"><i class="fa fa-trash"></i></button>	
			</div>';
			
			$data[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode(array('data'=>$data));
		//echo json_encode(array('data'=>$karyawan));
	}
	
}