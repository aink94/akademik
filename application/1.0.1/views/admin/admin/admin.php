  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Halaman utama admin</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="row">
    		<div class="col-md-2">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?=$jlmSiswa?></h3>
						<p>Siswa</p>
					</div>
					<div class="icon"><i class="fa fa-mortar-board"></i></div>
					<a href="<?=site_url('admin/siswa')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
    		<div class="col-md-2">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?=$jlmGuru?></h3>
						<p>Guru</p>
					</div>
					<div class="icon"><i class="fa fa-users"></i></div>
					<a href="<?=site_url('admin/siswa')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
    		<div class="col-md-2">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?=$jlmStaff?></h3>
						<p>Staff</p>
					</div>
					<div class="icon"><i class="fa fa-users"></i></div>
					<a href="<?=site_url('admin/staff')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
    		<div class="col-md-2">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?=$jlmMapel?></h3>
						<p>Mata Pelajaran</p>
					</div>
					<div class="icon"><i class="fa fa-book"></i></div>
					<a href="<?=site_url('admin/siswa')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
    		<div class="col-md-2">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?=$jlmKelas?></h3>
						<p>Kelas</p>
					</div>
					<div class="icon"><i class="fa fa-university"></i></div>
					<a href="<?=site_url('admin/siswa')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
    	</div>
    	
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->