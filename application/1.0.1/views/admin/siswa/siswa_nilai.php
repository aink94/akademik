  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Nilai Siswa
        <small>
        	<?php
        	$this->db->where('id_sekolah', intval($this->uri->segment(4)));
        	$sekolah = $this->db->get('sekolah')->result();
        	foreach($sekolah as $s){
				echo $s->nama_sekolah;
			}
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
    
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
        	<table class="table table-striped" id="siswa">
        		<thead>
        			<tr>
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
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->