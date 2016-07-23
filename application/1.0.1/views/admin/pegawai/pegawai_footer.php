<!-- DataTables -->
<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- InputMask -->
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- DatePicker -->
<script src="<?=base_url('assets')?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
	var tableguru;
	var save_method;
	$(function(){
		"use strict";
		tableguru = $("#guru").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax":{
				"url": "<?=site_url('admin/pegawai/getData').'/'.$peg?>",
				"type": "POST"	
			},
			autoFill: true,
			"columnDefs": [
		        { 
		          "targets": [ -1 ], //last column
		          "orderable": false, //set not orderable
		        },
		        { 
		          "targets": [ -2 ], //last column
		          "orderable": false, //set not orderable
		        },
		        { 
		          "targets": [ -3 ], //last column
		          "orderable": false, //set not orderable
		        },
		    ],
		});
		
		//Input Mask
		$("[data-mask]").inputmask();
		
		//DatePicker
		/*
		$('[name="tanggal_lahir_guru"]').datepicker({format: 'yyyy-mm-dd'});
		$('[name="pada_tanggal_guru"]').datepicker({format: 'yyyy-mm-dd'});
		*/
	});
	
	function lihat_guru(id){
		$.ajax({
			url: "<?=site_url('admin/pegawai/getById/')?>/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				//Informasi guru
				$('[guru="nupk_guru"]').text(data.nupk_guru);
				$('[guru="nupk_2_guru"]').text(data.nupk_2_guru);
				$('[guru="nama_guru"]').text(data.nama_guru);
				$('[guru="jenupk_kelamin_guru"]').text(data.jenupk_kelamin_guru);
				$('[guru="tempat_tanggal_lahir_guru"]').text(data.tempat_lahir_guru+', '+data.guru_tanggal_lahir);
				$('[guru="agama_guru"]').text(data.agama_guru);
				$('[guru="alamat_guru"]').text(data.alamat_guru);
				$('[guru="tlp_guru"]').text(data.tlp_guru);
				$('[guru="hp_guru"]').text(data.hp_guru);
				$('[guru="tanggal_terima_guru"]').text(data.guru_tanggal_terima);
				$('[guru="pendidikan_terakhir_guru"]').text(data.guru_pendidikan_terakhir);
				$('[guru="jabatan_guru"]').text(data.jabatan_guru);
				
				$('.modal-title').text('Informasi Tentang Guru');
				$('#modal-view-guru').modal({"backdrop": "static", keyboard: false});
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}
	
	function add_guru(){
		save_method = "add";
		$('#form-guru')[0].reset();
		$('[name="nupk_guru_disabled"]').removeAttr('disabled');
		$('#modal-guru').modal({"backdrop": "static", keyboard: false});
		$('.modal-title').text('Tambah guru');
	}
	
	function edit_guru(nupk){
		save_method = 'update';
		$('#form-guru')[0].reset();
		$.ajax({
			url: "<?=site_url('admin/pegawai/getById')?>/"+nupk,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name="nupk_guru_disabled"]').val(data.nupk);
				
				$('[name="nupk_guru_disabled"]').attr('disabled', true);
				
				$('#modal-guru').modal({"backdrop": "static", keyboard: false});
				$('.modal-title').text('Edit guru');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function hapus_guru(nupk){
		$.ajax({
			url: "<?=site_url('admin/pegawai/getById')?>/"+nupk,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[guru-del="nupk"]').text(data.nupk_guru);
				$('[guru-del="nama"]').text(data.nama_guru);
				$('[name="nupk_guru_delete"]').val(data.nupk);
				
				$('.modal-title').text('Apakah Yakin Akan Dihapus ?');
				$('#modal-hapus-guru').modal({"backdrop": "static", keyboard: false});
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}
	
	function reload_table(){
		tableguru.ajax.reload(null, false);
	}
	
	function save_guru(){
		var url;
		if(save_method == 'add'){
			url= "<?=site_url('admin/guru/add_guru')?>";
		}else if(save_method == 'update'){
			url= "<?=site_url('admin/guru/update_guru')?>";
		}
		
		$('[name="nupk_guru_disabled"]').inputmask('remove');
		$('[name="anak_ke_guru"]').inputmask('remove');
		$('[name="telp_guru"]').inputmask('remove');
		$('[name="tahun_ijazah_guru"]').inputmask('remove');
		$('[name="tahun_ijazah_guru"]').inputmask('remove');
		$('[name="tlp_ayah"]').inputmask('remove');
		$('[name="tlp_ibu"]').inputmask('remove');
		$('[name="tlp_ortu"]').inputmask('remove');
		$('[name="tlp_wali"]').inputmask('remove');
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form-guru').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-guru').modal("hide");
				reload_table();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	
	function delete_guru(){
		$.ajax({
			url: "<?=site_url('admin/guru/delete_guru')?>",
			type: "POST",
			data: $('#form-delete-guru').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-hapus-guru').modal("hide");
				reload_table();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
</script>

<!-- Modal View guru -->
<div class="modal fade" id="modal-view-guru">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<tr>
						<td width="30">1</td>
						<td width="200">NUPK</td>
						<td width="30">:</td>
						<td guru="nupk_guru"></td>
					</tr>
					<tr>
						<td>2</td>
						<td>NIP</td>
						<td>:</td>
						<td guru="nupk_2_guru"></td>
					</tr>
					<tr>
						<td>3</td>
						<td>Nama</td>
						<td>:</td>
						<td guru="nama_guru"></td>
					</tr>
					<tr>
						<td>4</td>
						<td>Jenupk Kelamin</td>
						<td>:</td>
						<td guru="jenupk_kelamin_guru"></td>
					</tr>
					<tr>
						<td>5</td>
						<td>Tempat, Tanggal Lahir</td>
						<td>:</td>
						<td guru="tempat_tanggal_lahir_guru"></td>
					</tr>
					<tr>
						<td>6</td>
						<td>Agama</td>
						<td>:</td>
						<td guru="agama_guru"></td>
					</tr>
					<tr>
						<td>7</td>
						<td>Alamat</td>
						<td>:</td>
						<td guru="alamat_guru"></td>
					</tr>
					<tr>
						<td>8</td>
						<td>Tlp Rumah</td>
						<td>:</td>
						<td guru="tlp_guru"></td>
					</tr>
					<tr>
						<td>9</td>
						<td>No. Hp</td>
						<td>:</td>
						<td guru="hp_guru"></td>
					</tr>
					<tr>
						<td>10</td>
						<td>Tanggal Terima</td>
						<td>:</td>
						<td guru="tanggal_terima_guru"></td>
					</tr>
					<tr>
						<td>11</td>
						<td>Pendidikan Terakhir</td>
						<td>:</td>
						<td guru="pendidikan_terakhir_guru"></td>
					</tr>
					
				</table>
			</div>
			<div class="modal-footer">
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal guru -->

<!-- Modal Form guru -->
<div class="modal fade" id="modal-guru">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<form action="#" id="form-guru">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>NUPK</label>
								<input class="form-control" type="text" name="nupk_guru_disable"/>
								<input class="form-control" type="hidden" name="nupk_guru_hidden"/>
							</div>
							<div class="form-group">
								<label>NIP</label>
								<input class="form-control" type="text" name="nupk_2_guru"/>
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input class="form-control" type="text" name="nama_guru"/>
							</div>
							<div class="form-group">
								<label>Nama</label>
								<select name="jenis_kelamin_guru" class="form-control">
									<option value="">Pilih Jenis Kelamin</option>
									<option value="L">Laki-laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Tempat Lahir</label>
								<input type="text" class="form-control" name="tempat_lahir_guru"/>
							</div>
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="date" class="form-control" name="tanggal_lahir_guru"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Foto</label>
								<textarea class="form-control" rows="4" style="resize: none"></textarea>
							</div>
							<div class="form-group">
								<label>Telp</label>
								<input class="form-control" type="text" name="tlp_guru"/>
							</div>
							<div class="form-group">
								<label>No. Hp</label>
								<input class="form-control" type="text" name="hp_guru"/>
							</div>
							<div class="form-group">
								<label>Tanggal Terima</label>
								<input class="form-control" type="date" name="tanggal_terima_guru"/>
							</div>
							<div class="form-group">
								<label>Pendidikan Terakhir</label>
								<select class="form-control" name="pendidikan_terakhir_guru">
									<option value=""></option>
									<option value=""></option>
								</select>
							</div>
							<div class="form-group">
								<label>Minimal</label>
				                <select class="form-control select2" style="width: 100%;">
				                  <option selected="selected">Alabama</option>
				                  <option>Alaska</option>
				                  <option>California</option>
				                  <option>Delaware</option>
				                  <option>Tennessee</option>
				                  <option>Texas</option>
				                  <option>Washington</option>
				                </select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" rows="3" style="resize: none" name="alamat_guru"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="save_guru()" ><span class="fa fa-save"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Form View guru -->

<!-- Modal hapus guru -->
<div class="modal fade" id="modal-hapus-guru">
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
							<td>NUPK</td>
							<td>Nama</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td guru-del="nupk"></td>
							<td guru-del="nama"></td>
						</tr>
					</tbody>
				</table>
				<form action="#" id="form-delete-guru" method="POST">
					<input type="hidden" name="nupk_guru_delete"/>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="hapus-guru" onclick="delete_guru()"><span class="fa fa-trash"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End hapus guru -->
