<!-- DataTables -->
<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.js"></script>

<!-- InputMask -->
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- DatePicker -->
<script src="<?=base_url('assets')?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
	var tablemapelsma, tablemapelsmp, tableJadwal, tablesma, tablesmpputri, tablesmp;
	var save_method;
	$(function(){
		"use strict";
		var id_th = <?=$this->session->userdata('th_ajaran_aktif')?>;
		tablemapelsma = $("#mapel-sma").DataTable({
			"processing": true,
			"serverSide": true,
			"pageLength": 10,
			"lengthMenu": [10],
			"ajax":{
				"url": "<?=site_url('admin/mapel/getDataMapelSMA')?>",
				"type": "POST"	
			},
			autoFill: true,
			"columnDefs": [
		        { 
		          "targets": [ -1 ], //last column
		          "orderable": false, //set not orderable
		        },
		    ],
			"columnDefs": [
		        { 
		          "targets": [ -2 ],
		          "orderable": false,
		        },
		    ],
			"columnDefs": [
		        { 
		          "targets": [ -3 ], 
		          "orderable": false,
		        },
		    ],
		});
		tablemapelsmp = $("#mapel-smp").DataTable({
			"processing": true,
			"serverSide": true,
			"pageLength": 10,
			"lengthMenu": [10],
			"ajax":{
				"url": "<?=site_url('admin/mapel/getDataMapelSMP')?>",
				"type": "POST"	
			},
			autoFill: true,
			"columnDefs": [
		        { 
		          "targets": [ -1 ], //last column
		          "orderable": false, //set not orderable
		        },
		    ],
			"columnDefs": [
		        { 
		          "targets": [ -2 ], //last column
		          "orderable": false, //set not orderable
		        },
		    ]
		});
		
		
		$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+<?=$this->session->userdata('th_ajaran_aktif')?>, 
		function(json){
			tableJadwal = $("#jadwal-mapel-full").DataTable({
				"fixedColumns": true,
				"destroy" : true,
				"fixedHeader": true,
				"scrollCollapse": true,
				"scrollX": true,
				"scrollY": 600,
				"bProcessing": true,
				"bFilter": false,
				"bLengthChange": false,
				"paging": true,
				"autoFill": true,
				"info": false,
				"ordering": false,
				"sPaginationType": "full_numbers",
				"columns": json.aoColumns,
				"data": json.data
			});
		});
		$('[href="#full"]').on('click', function(data){
		$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+<?=$this->session->userdata('th_ajaran_aktif')?>, 
		function(json){
			tableJadwal = $("#jadwal-mapel-full").DataTable({
				"fixedColumns": true,
				"destroy" : true,
				"fixedHeader": true,
				"scrollCollapse": true,
				"scrollX": true,
				"scrollY": 600,
				"bProcessing": true,
				"bFilter": false,
				"bLengthChange": false,
				"paging": true,
				"autoFill": true,
				"info": false,
				"ordering": false,
				"sPaginationType": "full_numbers",
				"columns": json.aoColumns,
				"data": json.data
			});
		});
		});
		$('[href="#SMA-Terpadu-Riyadlul-Ulum"]').on('click', function(data){
			$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+id_th+"/"+1, 
			function(json){
				tablesma = $("#jadwal-mapel-SMA-Terpadu-Riyadlul-Ulum").DataTable({
					"fixedColumns": true,
					"destroy" : true,
					"fixedHeader": true,
					"scrollCollapse": true,
					"scrollX": true,
					"scrollY": 600,
					"bProcessing": true,
					"bFilter": false,
					"bLengthChange": false,
					"paging": true,
					"autoFill": true,
					"info": false,
					"ordering": false,
					"sPaginationType": "full_numbers",
					"columns": json.aoColumns,
					"data": json.data
				});
			});	
		});
		$('[href="#SMP-Terpadu-Riyadlul-Ulum-Waddawah"]').on('click', function(data){
			$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+id_th+"/"+2, 
			function(json){
			tablesmp = $("#jadwal-mapel-SMP-Terpadu-Riyadlul-Ulum-Waddawah").DataTable({
				"fixedColumns": true,
				"destroy" : true,
				"fixedHeader": true,
				"scrollCollapse": true,
				"scrollX": true,
				"scrollY": 600,
				"bProcessing": true,
				"bFilter": false,
				"bLengthChange": false,
				"paging": true,
				"autoFill": true,
				"info": false,
				"ordering": false,
				"sPaginationType": "full_numbers",
				"columns": json.aoColumns,
				"data": json.data
			});
		}																						);
		});
		$('[href="#SMP-Terpadu-Riyadlul-Ulum-Waddawah-Putri"]').on('click', function(data){
			$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+id_th+"/"+3, 
			function(json){
			tablesmpputri = $("#jadwal-mapel-SMP-Terpadu-Riyadlul-Ulum-Waddawah-Putri").DataTable({
				"fixedColumns": true,
				"destroy" : true,
				"fixedHeader": true,
				"scrollCollapse": true,
				"scrollX": true,
				"scrollY": 600,
				"bProcessing": true,
				"bFilter": false,
				"bLengthChange": false,
				"paging": true,
				"autoFill": true,
				"info": false,
				"ordering": false,
				"sPaginationType": "full_numbers",
				"columns": json.aoColumns,
				"data": json.data
			});
		});
		});

	});
	
	function add_mapel_smp(){
		save_method = "add_smp";
		$('#form-mapel-smp')[0].reset();
		$('[name="kd_mapel_disabled"]').removeAttr('disabled');
		$('#modal-mapel-smp').modal({"backdrop": "static", keyboard: false});
		$('.modal-title').text('Tambah mapel SMP');
	}
	function edit_mapel_smp(kd_mapel){
		save_method = 'update_smp';
		$('#form-mapel-smp')[0].reset();
		$.ajax({
			url: "<?=site_url('admin/mapel/getByIdSmp')?>/"+kd_mapel,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name="kd_mapel_disabled"]').val(data.kd_mapel);
				$('[name="kd_mapel_hidden"]').val(data.kd_mapel);
				$('[name="nama_mapel"]').val(data.nama_mapel);
				$('[name="kelompok_mapel"]').val(data.id_kel_mapel);
				
				$('[name="kd_mapel_disabled"]').attr('disabled', true);
				
				$('#modal-mapel-smp').modal({"backdrop": "static", keyboard: false});
				$('.modal-title').text('Edit Mapel SMP');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}
	function save_mapel_smp(){
		var url;
		if(save_method == 'add_smp'){
			url= "<?=site_url('admin/mapel/add_mapel_smp')?>";
		}else if(save_method == 'update_smp'){
			url= "<?=site_url('admin/mapel/update_mapel_smp')?>";
		}
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form-mapel-smp').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-mapel-smp').modal("hide");
				tablemapelsmp.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	function hapus_mapel_smp(kd_mapel){
		$.ajax({
			url: "<?=site_url('admin/mapel/getByIdSmp')?>/"+kd_mapel,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[mapel-del="kd_mapel"]').text(data.kd_mapel);
				$('[mapel-del="nama_mapel"]').text(data.nama_mapel);
				$('[name="kd_mapel_delete"]').val(data.kd_mapel);
				
				$('.modal-title').text('Apakah Yakin Akan Dihapus ?');
				$('#modal-hapus-mapel-smp').modal({"backdrop": "static", keyboard: false});
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}
	function delete_mapel_smp(){
		$.ajax({
			url: "<?=site_url('admin/mapel/delete_mapel')?>",
			type: "POST",
			data: $('#form-delete-mapel-smp').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-hapus-mapel-smp').modal("hide");
				$('#form-delete-mapel-smp')[0].reset();
				tablemapelsmp.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	
	function add_mapel_sma(){
		save_method = "add_sma";
		$('#form-mapel-sma')[0].reset();
		$('[name="kd_mapel_disabled"]').removeAttr('disabled');
		$('#modal-mapel-sma').modal({"backdrop": "static", keyboard: false});
		$('.modal-title').text('Tambah mapel SMA');
	}
	function hapus_mapel_sma(kd_mapel){
		$.ajax({
			url: "<?=site_url('admin/mapel/getByIdSma')?>/"+kd_mapel,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[mapel-del="kd_mapel"]').text(data.kd_mapel);
				$('[mapel-del="nama_mapel"]').text(data.nama_mapel);
				$('[name="kd_mapel_delete"]').val(data.kd_mapel);
				
				$('.modal-title').text('Apakah Yakin Akan Dihapus ?');
				$('#modal-hapus-mapel-sma').modal({"backdrop": "static", keyboard: false});
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}
	function delete_mapel_sma(){
		$.ajax({
			url: "<?=site_url('admin/mapel/delete_mapel')?>",
			type: "POST",
			data: $('#form-delete-mapel-sma').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-hapus-mapel-sma').modal("hide");
				$('#form-delete-mapel-sma')[0].reset();
				tablemapelsma.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	function save_mapel_sma(){
		var url;
		if(save_method == 'add_sma'){
			url= "<?=site_url('admin/mapel/add_mapel_sma')?>";
		}else if(save_method == 'update_sma'){
			url= "<?=site_url('admin/mapel/update_mapel_sma')?>";
		}
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form-mapel-sma').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-mapel-sma').modal("hide");
				tablemapelsma.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	function edit_mapel_sma(kd_mapel){
		save_method = 'update_sma';
		$('#form-mapel-sma')[0].reset();
		$.ajax({
			url: "<?=site_url('admin/mapel/getByIdSma')?>/"+kd_mapel,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name="kd_mapel_disabled"]').val(data.kd_mapel);
				$('[name="kd_mapel_hidden"]').val(data.kd_mapel);
				$('[name="nama_mapel"]').val(data.nama_mapel);
				$('[name="kelompok_mapel"]').val(data.id_kel_mapel);
				$('[name="tingkat_mapel"]').val(data.id_tingkat);
				
				$('[name="kd_mapel_disabled"]').attr('disabled', true);
				
				$('#modal-mapel-sma').modal({"backdrop": "static", keyboard: false});
				$('.modal-title').text('Edit Mapel SMP');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}
	function tambah_jadwal(id_jam, id_kelas){
		$("#modal-tambah-jadwal").modal({"backdrop": "static", keyboard: false});
		$("#form-tambah-jadwal")[0].reset();
		$('.modal-title').text('Tambah Jadwal');
		$("[name='id_jam_hari']").val(id_jam);
		$("[name='id_kelas']").val(id_kelas);
		$("[name='id_mapel']").empty();
		$("[name='id_guru']").empty();
		$("[name='id_mapel']").append($('<option></option>').text("Pilih Mata Pelajaran"));
		$("[name='id_guru']").append($('<option></option>').text("Pilih Guru Pengajar"));
		$.getJSON("<?=site_url('admin/mapel/getMapelKelas')?>/"+id_kelas,
		function(json){
			$.each(json.mapel, function(k, v){
				$("[name='id_mapel']").append($('<option></option>').attr('value',v[0]+","+v[2]).text(v[1]));
			})
		});
		//$("[name='id_mapel']").change(,);//.on("change", );
		$.getJSON("<?=site_url('admin/mapel/getGuruPengajar')?>", 
		function(guru){
			$.each(guru, function(k, v){
				$("[name='id_guru']").append($('<option></option>').attr('value',v[0]).text(v[1]));
			})
		});
	}
	function save_jadwal(){
		$.ajax({
			url : "<?=site_url('admin/mapel/saveJadwal')?>",
			type: "POST",
			dataType : "json",
			data : $("#form-tambah-jadwal").serialize(),
			success: function(data){
				$('#modal-tambah-jadwal').modal("hide");
				$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+<?=$this->session->userdata('th_ajaran_aktif')?>, 
				function(json){
					tableJadwal = $("#jadwal-mapel-full").DataTable({
						"fixedColumns": true,
						"destroy" : true,
						"fixedHeader": true,
						"scrollCollapse": true,
						"scrollX": true,
						"scrollY": 600,
						"bProcessing": true,
						"bFilter": false,
						"bLengthChange": false,
						"paging": true,
						"autoFill": true,
						"info": false,
						"ordering": false,
						"sPaginationType": "full_numbers",
						"columns": json.aoColumns,
						"data": json.data
					});
				});
				$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+<?=$this->session->userdata('th_ajaran_aktif')?>+"/"+1, 
				function(json){
				tablesmpputri = $("#jadwal-mapel-SMA-Terpadu-Riyadlul-Ulum").DataTable({
					"fixedColumns": true,
					"destroy" : true,
					"fixedHeader": true,
					"scrollCollapse": true,
					"scrollX": true,
					"scrollY": 600,
					"bProcessing": true,
					"bFilter": false,
					"bLengthChange": false,
					"paging": true,
					"autoFill": true,
					"info": false,
					"ordering": false,
					"sPaginationType": "full_numbers",
					"columns": json.aoColumns,
					"data": json.data
					});
				});
				$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+<?=$this->session->userdata('th_ajaran_aktif')?>+"/"+2, 
				function(json){
				tablesmpputri = $("#jadwal-mapel-SMP-Terpadu-Riyadlul-Ulum-Waddawah").DataTable({
					"fixedColumns": true,
					"destroy" : true,
					"fixedHeader": true,
					"scrollCollapse": true,
					"scrollX": true,
					"scrollY": 600,
					"bProcessing": true,
					"bFilter": false,
					"bLengthChange": false,
					"paging": true,
					"autoFill": true,
					"info": false,
					"ordering": false,
					"sPaginationType": "full_numbers",
					"columns": json.aoColumns,
					"data": json.data
					});
				});
				$.getJSON("<?=site_url('admin/mapel/jadwal_mapel')?>/"+<?=$this->session->userdata('th_ajaran_aktif')?>+"/"+3, 
				function(json){
				tablesmpputri = $("#jadwal-mapel-SMP-Terpadu-Riyadlul-Ulum-Waddawah-Putri").DataTable({
					"fixedColumns": true,
					"destroy" : true,
					"fixedHeader": true,
					"scrollCollapse": true,
					"scrollX": true,
					"scrollY": 600,
					"bProcessing": true,
					"bFilter": false,
					"bLengthChange": false,
					"paging": true,
					"autoFill": true,
					"info": false,
					"ordering": false,
					"sPaginationType": "full_numbers",
					"columns": json.aoColumns,
					"data": json.data
					});
				});
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error POSt data from ajax');
			}
		});
	}
</script>

<!-- Modal Form mapel SMP -->
<div class="modal fade" id="modal-mapel-smp">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<form action="#" id="form-mapel-smp">
					<div class="form-group">
						<label>Kode Mapel</label>
						<input type="text" class="form-control" name="kd_mapel_disabled"/>
						<input type="hidden" name="kd_mapel_hidden"/>
					</div>
					<div class="form-group">
						<label>Nama Mapel</label>
						<input type="text" class="form-control" name="nama_mapel"/>
					</div>
					<div class="form-group">
						<label>Kelompok Mapel</label>
						<select class="form-control" name="kelompok_mapel">
							<option value="">Pilih Kelompok</option>
							<?php
							foreach($this->db->get('kel_mapel')->result() as $kel){
								echo '<option value="'.$kel->id_kel_mapel.'">'.$kel->nama_kel_mapel.'</option>';
							}
							?>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="save_mapel_smp()" ><span class="fa fa-save"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Form mapel SMP-->

<!-- Modal hapus mapel SMP -->
<div class="modal fade" id="modal-hapus-mapel-smp">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Kode Mapel</td>
							<td>Nama</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td mapel-del="kd_mapel"></td>
							<td mapel-del="nama_mapel"></td>
						</tr>
					</tbody>
				</table>
				<form action="#" id="form-delete-mapel-smp">
					<input type="hidden" name="kd_mapel_delete"/>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="hapus-mapel" onclick="delete_mapel_smp()"><span class="fa fa-trash"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End hapus mapel SMP -->

<!-- Modal hapus mapel SMA -->
<div class="modal fade" id="modal-hapus-mapel-sma">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Kode Mapel</td>
							<td>Nama</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td mapel-del="kd_mapel"></td>
							<td mapel-del="nama_mapel"></td>
						</tr>
					</tbody>
				</table>
				<form action="#" id="form-delete-mapel-sma">
					<input type="hidden" name="kd_mapel_delete"/>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="hapus-mapel" onclick="delete_mapel_sma()"><span class="fa fa-trash"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End hapus mapel SMA -->

<!-- Modal Form mapel SMA -->
<div class="modal fade" id="modal-mapel-sma">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<form action="#" id="form-mapel-sma">
					<div class="form-group">
						<label>Kode Mapel</label>
						<input type="text" class="form-control" name="kd_mapel_disabled"/>
						<input type="hidden" name="kd_mapel_hidden"/>
					</div>
					<div class="form-group">
						<label>Nama Mapel</label>
						<input type="text" class="form-control" name="nama_mapel"/>
					</div>
					<div class="form-group">
						<label>Kelompok Mapel</label>
						<select class="form-control" name="kelompok_mapel">
							<option value="">Pilih Kelompok</option>
							<?php
							foreach($this->db->get('kel_mapel')->result() as $kel){
								echo '<option value="'.$kel->id_kel_mapel.'">'.$kel->nama_kel_mapel.'</option>';
							}
							?>
						</select>
					</div>
					<div class
					<div class="form-group">
						<label>Tingkat Mapel</label>
						<select class="form-control" name="tingkat_mapel">
							<option value="">Pilih Tingkat</option>
							<?php
							foreach($this->db->get('tingkat_kel_mapel')->result() as $kel){
								echo '<option value="'.$kel->id_tingkat.'">'.$kel->nama_tingkat.'</option>';
							}
							?>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="save_mapel_sma()" ><span class="fa fa-save"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Form mapel SMA-->

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="modal-tambah-jadwal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
			<form id="form-tambah-jadwal">
				<input type="hidden" name="id_jam_hari"/>
				<input type="hidden" name="id_kelas"/>
				<input type="hidden" name="id_kelas_mapel"/>
				<div class="form-group">
					<label>Mata Pelajaran</label>
					<select class="form-control" name="id_mapel">
						<option value="">Pilih Mapel</option>
					</select>
				</div>
				<div class="form-group">
					<label>Guru Pengajar</label>
					<select class="form-control" name="id_guru">
						<option value="">Pilih Guru Pengajar</option>
					</select>
				</div>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="save_jadwal()" ><span class="fa fa-save"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
