  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mata Pelajaran
        <small></small>
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
    	<div class="row">
    		<div class="col-md-6">
				<!-- Default box -->
				<div class="box box-success box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Mata Pelajaran SMA</h3>
						<button class="btn btn-success pull-right" onclick="add_mapel_sma()"><span class="fa fa-plus"></span></button>
					</div>
					<div class="box-body">
						<table class="table table-striped" id="mapel-sma">
							<thead>
								<tr>
									<th>Kode mapel</th>
									<th>Mata pelajaran</th>
									<th>Kelompok Mapel</th>
									<th>Tingkat</th>
									<th width="25"></th>
								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr>
									<th>Kode mapel</th>
									<th>Mata pelajaran</th>
									<th>Kelompok Mapel</th>
									<th>Tingkat</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.box-body -->
					<!-- /.box -->
	    		</div>
	    	</div>
    		<div class="col-md-6">
				<!-- Default box -->
				<div class="box box-danger box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Mata Pelajaran SMP</h3>
						<button class="btn btn-danger pull-right" onclick="add_mapel_smp()"><span class="fa fa-plus"></span></button>
					</div>
					<div class="box-body">
						<table class="table table-striped" id="mapel-smp">
							<thead>
								<tr>
									<th>Kode mapel</th>
									<th>Mata pelajaran</th>
									<th>Kelompok Mapel</th>
									<th width="25"></th>
								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr>
									<th>Kode mapel</th>
									<th>Mata pelajaran</th>
									<th>Kelompok Mapel</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.box-body -->
					<!-- /.box -->
	    		</div>
	    	</div>
    	</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->