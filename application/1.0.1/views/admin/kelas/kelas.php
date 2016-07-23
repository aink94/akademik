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
		<div class="nav-tabs-custom">
	    	<ul class="nav nav-tabs pull-right" role="tablist">
				<li role="presentation"><a href="#daftar-siswa-kelas" aria-controls="daftar-siswa-kelas" role="tab" data-toggle="tab">Daftar Siswa Kelas</a></li>
				<li role="presentation"><a href="#daftar-mapel-kelas" aria-controls="daftar-mapel-kelas" role="tab" data-toggle="tab">Daftar Mapel Kelas</a></li>
				<li role="presentation" class="active"><a class="" href="#daftar-kelas" aria-controls="daftar-kelas" role="tab" data-toggle="tab">Daftar Kelas</a></li>
			</ul>
			<!-- Tab-Content -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="daftar-kelas">
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
					<table class="table table-bordered table-striped" id="tablekelas">
		    			<thead>
		    				<tr>
		    					<th>#</th>
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
		    					<th>#</th>
		    					<th>Nama Kelas</th>
		    					<th>Wali Kelas</th>
		    					<th>Tahun Ajaran</th>
		    					<th></th>
		    				</tr>
		    			</tfoot>
		    		</table>
				</div>
				<div role="tabpanel" class="tab-pane" id="daftar-mapel-kelas">
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control">
								<option value="">A</option>
							</select>	
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control">
								<option value="">A</option>
							</select>	
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div role="tabpanel" class="tab-pane" id="daftar-siswa-kelas">
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control">
								<option value="">B</option>
							</select>	
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control">
								<option value="">C</option>
							</select>	
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- End-Tab-Content -->
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->