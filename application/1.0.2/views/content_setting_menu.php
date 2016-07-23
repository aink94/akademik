  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Menu</small>
      </h1>
      
      <?=$this->breadcrumbs->show();?>
       
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List Menu</h3>
        </div>
        <div class="box-body">
        	<ul class="menu-item">
        	<?php
        	$menu = $this->db->get('menu_payment');
        	foreach($menu->result_array() as $m){
				echo '<li>';
				echo '<span>';
				echo '
						<div class="row">
        				<div class="col-sm-1">
        					<i class="fa '.$m['icon'].'"></i>
        				</div>
        				<div class="col-sm-2">'.$m['title'].'</div>
        				<div class="col-sm-3">'.$m['level'].'</div>
        				<div class="col-sm-4">'.$m['url'].'</div>
        				<div class="col-sm-2">
        					<div class="btn-group pull-right">
        						<button data-toggle="modal" id="btn-edit-menu" data-target="#update-menu" data-id="'.$m['id_menu'].'"><i class="fa fa-edit"></i></button>
        						<button data-toggle="modal" id="btn-delete-menu" data-target="#delete-menu" data-id="'.$m['id_menu'].'" data-title="'.$m['title'].'"><i class="fa fa-trash"></i></button>
        					</div>
        				</div>
        				</div>
				';
				echo '</span>';
				$submenu = $this->db->get_where('submenu_payment', array('id_menu'=>$m['id_menu']));
				if($submenu->num_rows() > 0){
					echo '<ol class="submenu-item">';
					foreach($submenu->result_array() as $sm){
						echo '
						<li>
        					<span>
		        				<div class="row">
			        				<div class="col-sm-1">
			        					<i class="fa '.$sm['icon'].'"></i>
			        				</div>
			        				<div class="col-sm-2">'.$sm['title'].'</div>
			        				<div class="col-sm-3">'.$sm['level'].'</div>
			        				<div class="col-sm-4">'.$sm['url'].'</div>
			        				<div class="col-sm-2">
			        					<div class="btn-group pull-right">
			        						<button data-toggle="modal" id="btn-edit-submenu" data-target="#update-submenu" data-id="'.$sm['id_submenu'].'"><i class="fa fa-edit"></i></button>
			        						<button data-toggle="modal" id="btn-delete-submenu" data-target="#delete-submenu" data-id="'.$sm['id_submenu'].'" data-title="'.$sm['title'].'"><i class="fa fa-trash"></i></button>
			        					</div>
			        				</div>
			        			</div>
		        			</span>
        				</li>
						';
					}
					echo '</ol>';
				}
				echo '</li>';
			}
        	?>
        	</ul>
        	<?php
        	$this->load->config('icon');
			$icon = $this->config->item('icon');
        	?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#tambah-menu"><i class="fa fa-plus"></i> Tambah Menu</button>
          <button class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#tambah-submenu"><i class="fa fa-plus"></i> Tambah Submenu</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<div id="tambah-menu" class="modal" data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<?=form_open('', array("id"=>"form-tambah-menu"))?>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span></button>
					<h4 class="modal-title">Tambah Menu</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Title</label>
						<input class="form-control" name="title" placeholder="Title" type="text">
					</div>
					<div class="form-group">
						<label>Url</label>
						<input class="form-control" name="url" placeholder="class/method" type="text">
					</div>
					<div class="form-group">
						<label>Hak Akses</label>
						<select name="level_menu" multiple  class="selectpicker form-control">
			        		<option value="admin">admin</option>
			        		<option value="kasir">kasir</option>
			        		<option value="manager">manager</option>
			        	</select>
			        </div>
			        <div>
			        	<label>Icon</label>
			        	<select name="icon" class="selectpicker form-control" data-size="5" data-live-search="true">
			        		<?php
			        		for($i=0; $i<count($icon); $i++){
								echo '<option data-tokens="'.$icon[$i].'" value="'.$icon[$i].'"  data-icon="fa '.$icon[$i].'"> '.$icon[$i].'</option>';
							}
			        		?>
			        	</select>
		        	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" name="btn_simpan_menu" class="btn btn-default">Simpan</button>
				</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	
	<div id="tambah-submenu" class="modal" data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<form method="POST" action="">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span></button>
					<h4 class="modal-title">Tambah Submenu</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Menu</label>
						<select name="id_menu" class="selectpicker form-control" data-size="5" data-live-search="true">
						<?php
						$res = $this->db->get('menu_payment');
						foreach($res->result() as $r){
							echo '<option value="'.$r->id_menu.'">'.$r->title.'</option>';
						}
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Title</label>
						<input class="form-control" name="title_submenu" placeholder="Title" type="text">
					</div>
					<div class="form-group">
						<label>Url</label>
						<input class="form-control" name="url_submenu" placeholder="class/method" type="text">
					</div>
					<div class="form-group">
						<label>Hak Akses</label>
						<select name="level_submenu" multiple  class="selectpicker form-control">
			        		<option value="admin">admin</option>
			        		<option value="kasir">kasir</option>
			        		<option value="manager">manager</option>
			        	</select>
			        </div>
			        <div>
			        	<label>Icon</label>
			        	<select name="icon_submenu" class="selectpicker form-control" data-size="5" data-live-search="true">
			        		<?php
			        		for($i=0; $i<count($icon); $i++){
								echo '<option data-tokens="'.$icon[$i].'" value="'.$icon[$i].'"  data-icon="fa '.$icon[$i].'"> '.$icon[$i].'</option>';
							}
			        		?>
			        	</select>
		        	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button name="btn_simpan_submenu" type="button" class="btn btn-default">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="update-menu" class="modal" data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<?=form_open('', array("id"=>"form-update-menu"))?>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span></button>
					<h4 class="modal-title">Update Menu</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_menu"/>
					<div class="form-group">
						<label>Title</label>
						<input class="form-control" name="title" placeholder="Title" type="text">
					</div>
					<div class="form-group">
						<label>Url</label>
						<input class="form-control" name="url" placeholder="class/method" type="text">
					</div>
					<div class="form-group">
						<label>Hak Akses</label>
						<select name="level_menu" multiple  class="selectpicker form-control">
			        		<option value="admin">admin</option>
			        		<option value="kasir">kasir</option>
			        		<option value="manager">manager</option>
			        	</select>
			        </div>
			        <div>
			        	<label>Icon</label>
			        	<select name="icon" class="selectpicker form-control" data-size="5" data-live-search="true">
			        		<?php
			        		for($i=0; $i<count($icon); $i++){
								echo '<option data-tokens="'.$icon[$i].'" value="'.$icon[$i].'"  data-icon="fa '.$icon[$i].'"> '.$icon[$i].'</option>';
							}
			        		?>
			        	</select>
		        	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" name="btn_simpan_update_menu" class="btn btn-default">Simpan</button>
				</div>
				<?=form_close()?>
			</div>
		</div>
	</div>

	<div id="update-submenu" class="modal" data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<form method="POST" action="">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span></button>
					<h4 class="modal-title">Update Submenu</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_submenu"/>
					<div class="form-group">
						<label>Menu</label>
						<select name="id_menu" class="selectpicker form-control" data-size="5" data-live-search="true">
						<?php
						$res = $this->db->get('menu_payment');
						foreach($res->result() as $r){
							echo '<option value="'.$r->id_menu.'">'.$r->title.'</option>';
						}
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Title</label>
						<input class="form-control" name="title_submenu" placeholder="Title" type="text">
					</div>
					<div class="form-group">
						<label>Url</label>
						<input class="form-control" name="url_submenu" placeholder="class/method" type="text">
					</div>
					<div class="form-group">
						<label>Hak Akses</label>
						<select name="level_submenu" multiple  class="selectpicker form-control">
			        		<option value="admin">admin</option>
			        		<option value="kasir">kasir</option>
			        		<option value="manager">manager</option>
			        	</select>
			        </div>
			        <div>
			        	<label>Icon</label>
			        	<select name="icon_submenu" class="selectpicker form-control" data-size="5" data-live-search="true">
			        		<?php
			        		for($i=0; $i<count($icon); $i++){
								echo '<option data-tokens="'.$icon[$i].'" value="'.$icon[$i].'"  data-icon="fa '.$icon[$i].'"> '.$icon[$i].'</option>';
							}
			        		?>
			        	</select>
		        	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button name="btn_simpan_update_submenu" type="button" class="btn btn-default">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal modal-danger" id="delete-menu"  data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Apakah yakin <b>MENU</b> akan di hapus?</h4>
				</div>
				<div class="modal-body">
					<h5 class="text-menu-delete">Dashboard</h5>
					<input type="hidden" name="id"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-outline" id="btn-save-delete-menu">Delete</button>
				</div>
			</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	
	<div class="modal modal-danger" id="delete-submenu" data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Apakah yakin <b>SUBMENU</b> akan di hapus ?</h4>
				</div>
				<div class="modal-body">
					<h5 class="text-menu-delete">Dashboard</h5>
					<input type="hidden" name="id"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-outline" id="btn-save-delete-submenu">Delete</button>
				</div>
			</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>