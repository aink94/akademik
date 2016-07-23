  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Kelas
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <div class="col-md-4">
          	<div class="form-group">
          		<select class="form-control" id="id-sekolah-kelas">
          			<option value="">Pilih Sekolah</option>
          			<?php
          			foreach($sekolah as $s){
						echo "<option value='".$s->id_sekolah."'>".$s->nama_sekolah."</option>";
					}
          			?>
          		</select>
          	</div>
          </div>
          <button class="btn btn-info btn-sm pull-right" onclick="tambah_kelas()"><li class="fa fa-plus"></li></button>
        </div>
        <div class="box-body">
    		<table class="table table-bordered table-striped" id="tablekelas">
    			<thead>
    				<tr>
    					<th>Nama Kelas</th>
    					<th>Wali Kelas</th>
    					<th>Tahun Ajaran</th>
    					<th></th>
    				</tr>
    			</thead>
    			<tbody>
    				
    			</tbody>
    			<tfoot>
    				<tr>
    					<th>Nama Kelas</th>
    					<th>Wali Kelas</th>
    					<th>Tahun Ajaran</th>
    					<th></th>
    				</tr>
    			</tfoot>
    		</table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->