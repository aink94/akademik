  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Siswa
        <small>
        	<?php
			echo $sekolah->nama_sekolah;
        	?>
        </small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Boxed</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="nav-tabs-custom">
    	<ul class="nav nav-tabs pull-right" role="tablist">
			<li role="presentation"><a href="#data-statistik-sekolah" aria-controls="data-statistik-sekolah" role="tab" data-toggle="tab">Statistik</a></li>
			<li role="presentation" class="active"><a href="#data-siswa-sekolah" aria-controls="data-siswa-sekolah" role="tab" data-toggle="tab">Data Siswa</a></li>
			<li class="pull-left header"><i class="fa fa-file-archive-o"></i>Arsip Data</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="data-siswa-sekolah">
				<div class="col-md-4">
			          <div class="form-group">
			          	<select class="form-control" id="kelas-siswa">
			          		<option value="">Kelas Semua</option>
			          		<?php
			          		foreach($kelas->result() as $kls){
								echo '<option value="'.$kls->id_kelas.'">'.$kls->nama_kelas.'</option>';
							}
			          		?>
			          	</select>
			          </div>
		        </div>
		        <button class="btn btn-info pull-right" onclick="add_siswa(<?=$sekolah->id_sekolah?>)" data-toggle="tooltip" data-original-title="Tambah siswa <?=$sekolah->nama_sekolah?>"><span class="fa fa-plus"></span></button>
		        <div class="clearfix"></div>
		        
	        	<table class="table table-bordered table-hover" id="siswa">
	        		<thead>
	        			<tr>
	        				<th>Id Kelas</th>
	        				<th>NIS</th>
	        				<th>NISN</th>
	        				<th>Nama Lengkap</th>
	        				<th>Kelas</th>
	        				<th>L/P</th>
	        				<th></th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			
	        		</tbody>
	        		<tfoot>
	        			<tr>
	        				<th>Id Kelas</th>
	        				<th>NIS</th>
	        				<th>NISN</th>
	        				<th>Nama Lengkap</th>
	        				<th>Kelas</th>
	        				<th>L/P</th>
	        				<th></th>
	        			</tr>
	        		</tfoot>
	        	</table>
			</div>
			<div role="tabpanel" class="tab-pane" id="data-statistik-sekolah" style="min-height: 400px">
				<div class="col-md-4">
					<div class="box box-solid box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Jumlah Siswa Per-Grade</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<select class="form-control" id="th_ajaran">
									<option value="<?=$this->session->userdata('th_ajaran_aktif')?>">Pilih Tahun Ajaran</option>
									<?php
									foreach($th_ajaran as $th){
										echo '<option value="'.$th->id_th_ajaran.'">'.$th->nama_th_ajaran.'</option>';
									}
									?>
								</select>
							</div>
							<table class="table table-bordered" id="data-siswa-per-th">
								<thead>
									<tr>
										<td>Tingkat</td>
										<td>Jumlah</td>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="box box-solid box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">Grafik Jumlah Siswa Per-Tahun</h3>
						</div>
						<div class="box-body">
							HAHAHAH
						</div>
					</div>
				</div>
				
			</div>
		</div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->