  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Halaman setting admin</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="col-md-5">
	    	<div class="box box-danger box-solid" id="setting-th-ajaran">
	    		<div class="box-header">
	    			<h3 class="box-title"><li class="fa fa-gears"></li> Setting Tahun Ajaran</h3>
	    		</div>
	    		<div class="box-body">
	    			<div class="form-group">
	    				<select class="form-control" id="th-ajaran-aktif" name="th-ajaran">
	    					<?php
	    					foreach($th_ajaran as $th){
								echo '<option value="'.$th->id_th_ajaran.'" ';
								if($this->session->userdata('th_ajaran_aktif') == $th->id_th_ajaran)
								echo 'selected';
								echo ' >'.$th->nama_th_ajaran.'</option>';
							}
	    					?>
	    				</select>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="box box-success box-solid">
	    		<div class="box-header">
	    			<h3 class="box-title"><li class="fa fa-university"></li> Setting Sekolah</h3>
	    		</div>
	    		<div class="box-body">
	    			<table class="table table-bordered table-hover">
	    				<thead>
	    					<tr>
	    						<td>NPSN</td>
	    						<td>Nama Sekolah</td>
	    						<td>Kurikulum</td>
	    						<td></td>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<?php
	    					foreach($sekolah as $s):
	    					?>
	    					<tr>
	    						<td><?=$s->npsn?></td>
	    						<td><?=$s->nama_sekolah?></td>
	    						<td><?=$s->kurikulum?></td>
	    						<td>
	    							<button class="btn btn-danger btn-xs" onclick="edit_sekolah(<?=$s->id_sekolah?>)"><li class="fa fa-edit"></li></button>
	    						</td>
	    					</tr>
	    					<?php
	    					endforeach;
	    					?>
	    				</tbody>
	    			</table>
	    		</div>
	    	</div>
    	</div>
    	
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->