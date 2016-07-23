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
	var tablesiswa, tableperth;
	var save_method;
	var id_sekolah = <?=$this->uri->segment(4)?>;
	$(function(){
		"use strict";
		tampildata(id_sekolah, '');
		ttabsiswa(id_sekolah, "<?=$this->session->userdata('th_ajaran_aktif')?>");
		
		$("#kelas-siswa").on('change', function(e){
			var optionSelected = $("option:selected", this);
    		var valueSelected = this.value;
    		tampildata(id_sekolah, valueSelected);
		});
		$("#th_ajaran").on('change', function(e){
			var optionSelected = $("option:selected", this);
    		var valueSelected = this.value;
    		ttabsiswa(id_sekolah, valueSelected);
		});
		
		_mask();
	});
	
	function ttabsiswa(id_sekolah, id_th){
		tableperth = $("#data-siswa-per-th").DataTable({
			"processing": true,
			"serverSide": true,
			"lengthChange": false,
			"paging": false,
			"searching": false,
			"ordering": false,
			"destroy": true,
			"info": false,
			"ajax":{
				"url": "<?=site_url('admin/siswa/jlmSiswaPerGrade')?>/"+id_sekolah+"/"+id_th,
				"type": "POST"	
			}
		});
	}
	
	function tampildata(id_sekolah, id_kelas){
		tablesiswa = $("#siswa").DataTable({
			"processing": true,
			"serverSide": true,
			"lengthChange": false,
			"destroy": true,
			"pageLength": 30,
			"ajax":{
				"url": "<?=site_url('admin/siswa/getDataSiswa')?>/"+id_sekolah+"/"+id_kelas,
				"type": "POST"	
			},
			autoFill: true,
			"columnDefs": [
		        { 
		          "targets": [ -1 ], //last column
		          "orderable": false, //set not orderable
		        },
		        { 
		          "targets": [ -2 ],
		          "orderable": false, 
		        },
		        {
					"targets": [0],
					"visible": false
				}
		    ],
		});
	}
	
	function lihat_siswa(id){
		$.ajax({
			url: "<?=site_url('admin/siswa/getById/')?>/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				//Informasi Siswa
				$('[siswa="nis_siswa"]').text(data.nis);
				$('[siswa="nisn_siswa"]').text(data.nisn);
				$('[siswa="nama_siswa"]').text(data.nama_siswa);
				$('[siswa="jenis_kelamin_siswa"]').text(data.jk);
				$('[siswa="tempat_tanggal_lahir_siswa"]').text(data.tmpt_lhr_siswa+', '+data.tgl_lahir);
				$('[siswa="agama_siswa"]').text(data.agama_siswa);
				$('[siswa="anak_ke_siswa"]').text(data.anak_ke_siswa);
				$('[siswa="status_keluarga_siswa"]').text(data.status_keluarga_siswa);
				$('[siswa="alamat_siswa"]').text(data.alamat_siswa);
				$('[siswa="telp_siswa"]').text(data.telp_siswa);
				$('[siswa="asal_sekolah_siswa"]').text(data.asal_sekolah_siswa);
				$('[siswa="diterima_tingkat_siswa"]').text(data.diterima_grade_siswa);
				$('[siswa="pada_tanggal_siswa"]').text(data.tgl_terima);
				$('[siswa="kelas_siswa"]').text(data.nama_kelas);
				
				//Informasi Orang Tua
				$('[ortu="nama_ayah"]').text(data.nama_ayah);
				$('[ortu="pek_ayah"]').text(data.ayah_pek);
				$('[ortu="telp_ayah"]').text(data.tlp_ayah);
				$('[ortu="nama_ibu"]').text(data.nama_ibu);
				$('[ortu="pek_ibu"]').text(data.ibu_pek);
				$('[ortu="telp_ibu"]').text(data.tlp_ibu);
				$('[ortu="telp_ortu"]').text(data.tlp_ortu);
				$('[ortu="alamat_ortu"]').text(data.alamat_ortu);
				$('[ortu="nama_wali"]').text(data.nama_wali);
				$('[ortu="pek_wali"]').text(data.wali_pek);
				$('[ortu="telp_wali"]').text(data.tlp_wali);
				$('[ortu="alamat_wali"]').text(data.alamat_wali);
				
				$('.modal-title').text('Informasi Tentang Siswa');
				$('#modal-view-siswa').modal({"backdrop": "static", keyboard: false});
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}
	
	function add_siswa(){
		save_method = "add";
		$('#form-siswa')[0].reset();
		$('[name="nis_siswa_disabled"]').removeAttr('disabled');
		$('#modal-siswa').modal({"backdrop": "static", keyboard: false});
		$('.modal-title').text('Tambah Siswa');
	}
	
	function edit_siswa(nis){
		save_method = 'update';
		$('#form-siswa')[0].reset();
		$.ajax({
			url: "<?=site_url('admin/siswa/getById')?>/"+nis,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name="nis_siswa_disabled"]').val(data.nis);
				$('[name="nis_siswa_hidden"]').val(data.nis);
				$('[name="nama_siswa"]').val(data.nama_siswa);
				$('[name="nisn_siswa"]').val(data.nisn);
				$('[name="tempat_lahir_siswa"]').val(data.tmpt_lhr_siswa);
				$('[name="tanggal_lahir_siswa"]').val(data.tgl_lhr_siswa);
				$('[name="jenis_kelamin_siswa"]').val(data.jk_siswa);
				$('[name="anak_ke_siswa"]').val(data.anak_ke_siswa);
				$('[name="status_keluarga_siswa"]').val(data.status_keluarga_siswa);
				$('[name="telp_siswa"]').val(data.telp_siswa);
				$('[name="alamat_siswa"]').val(data.alamat_siswa);
				$('[name="diterima_grade_siswa"]').val(data.diterima_grade_siswa);
				$('[name="pada_tanggal_siswa"]').val(data.diterima_tgl_siswa);
				$('[name="asal_sekolah_siswa"]').val(data.asal_sekolah_siswa);
				$('[name="tahun_ijazah_siswa"]').val(data.tahun_ijazah_siswa);
				$('[name="nomor_ijazah_siswa"]').val(data.nomor_ijazah_siswa);
				
				$('[name="nis_siswa_disabled"]').attr('disabled', true);
				
				$('[name="nama_ayah"]').val(data.nama_ayah);
				$('[name="pek_ayah"]').val(data.pek_ayah);
				$('[name="tlp_ayah"]').val(data.tlp_ayah);
				$('[name="nama_ibu"]').val(data.nama_ibu);
				$('[name="pek_ibu"]').val(data.pek_ibu);
				$('[name="tlp_ibu"]').val(data.tlp_ibu);
				$('[name="nama_wali"]').val(data.nama_wali);
				$('[name="pek_wali"]').val(data.pek_wali);
				$('[name="tlp_wali"]').val(data.tlp_wali);
				$('[name="tlp_ortu"]').val(data.tlp_rmh_ortu);
				$('[name="alamat_ortu"]').val(data.alamat_ortu);
				$('[name="alamat_wali"]').val(data.alamat_wali);
				
				$('#modal-siswa').modal({"backdrop": "static", keyboard: false});
				$('.modal-title').text('Edit Siswa');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}
		});
	}

	function hapus_siswa(nis){
		$.ajax({
			url: "<?=site_url('admin/siswa/getById')?>/"+nis,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[siswa-del="nis"]').text(data.nis);
				$('[siswa-del="nama"]').text(data.nama_siswa);
				$('[name="nis_siswa_delete"]').val(data.nis);
				
				$('.modal-title').text('Apakah Yakin Akan Dihapus ?');
				$('#modal-hapus-siswa').modal({"backdrop": "static", keyboard: false});
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}
	
	function reload_table(){
		tablesiswa.ajax.reload(null, false);
	}
	
	function save_siswa(){
		var url;
		if(save_method == 'add'){
			url= "<?=site_url('admin/siswa/add_siswa')?>";
		}else if(save_method == 'update'){
			url= "<?=site_url('admin/siswa/update_siswa')?>";
		}
		__mask();
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form-siswa').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-siswa').modal("hide");
				reload_table();
				_mask();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	
	function delete_siswa(){
		$.ajax({
			url: "<?=site_url('admin/siswa/delete_siswa')?>",
			type: "POST",
			data: $('#form-delete-siswa').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-hapus-siswa').modal("hide");
				reload_table();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}

	function _mask(){//add mask
		$('[name="tanggal_lahir_siswa"]').inputmask({alias: "dd-mm-yyyy"});
		$('[name="pada_tanggal_siswa"]').inputmask({alias: "dd-mm-yyyy"});
		$('[name="nis_siswa_disabled"]').inputmask({mask: "9999-99-999"});
		$('[name="anak_ke_siswa"]').inputmask({mask: "99"});
		$('[name="telp_siswa"]').inputmask({mask: "9999-9999-9999"});
		$('[name="tahun_ijazah_siswa"]').inputmask({mask: "9999"});
		$('[name="tlp_ayah"]').inputmask({mask: "9999-9999-9999"});
		$('[name="tlp_ibu"]').inputmask({mask: "9999-9999-9999"});
		$('[name="tlp_ortu"]').inputmask({mask: "(9999)-999-9999"});
		$('[name="tlp_wali"]').inputmask({mask: "9999-9999-9999"});
		//DatePicker
		$('[name="tanggal_lahir_siswa"]').datepicker({format: 'dd-mm-yyyy'});
		$('[name="pada_tanggal_siswa"]').datepicker({format: 'dd-mm-yyyy'});
	}
	function __mask(){//remove
		$('[name="nis_siswa_disabled"]').inputmask('remove');
		$('[name="anak_ke_siswa"]').inputmask('remove');
		$('[name="telp_siswa"]').inputmask('remove');
		$('[name="tahun_ijazah_siswa"]').inputmask('remove');
		$('[name="tlp_ayah"]').inputmask('remove');
		$('[name="tlp_ibu"]').inputmask('remove');
		$('[name="tlp_ortu"]').inputmask('remove');
		$('[name="tlp_wali"]').inputmask('remove');
	}
</script>

<!-- Modal View Siswa -->
<div class="modal fade" id="modal-view-siswa">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#data-diri-view" aria-controls="data-diri-view" role="tab" data-toggle="tab">Data Diri</a></li>
					<li role="presentation"><a href="#data-ortu-view" aria-controls="data-ortu-view" role="tab" data-toggle="tab">Data Orang Tua</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="data-diri-view" style="min-height: 400px">
						<table class="table table-striped table-bordered">
							<tr>
								<td width="30">1</td>
								<td width="200">NIS</td>
								<td width="30">:</td>
								<td siswa="nis_siswa"></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Nama Lengkap</td>
								<td>:</td>
								<td siswa="nama_siswa"></td>
							</tr>
							<tr>
								<td>3</td>
								<td>NISN</td>
								<td>:</td>
								<td siswa="nisn_siswa"></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td siswa="jenis_kelamin_siswa"></td>
							</tr>
							<tr>
								<td>5</td>
								<td>Tempat, Tanggal Lahir</td>
								<td>:</td>
								<td siswa="tempat_tanggal_lahir_siswa"></td>
							</tr>
							<tr>
								<td>6</td>
								<td>agama</td>
								<td>:</td>
								<td siswa="agama_siswa"></td>
							</tr>
							<tr>
								<td>7</td>
								<td>Anak ke</td>
								<td>:</td>
								<td siswa="anak_ke_siswa"></td>
							</tr>
							<tr>
								<td>8</td>
								<td>Status Keluarga</td>
								<td>:</td>
								<td siswa="status_keluarga_siswa"></td>
							</tr>
							<tr>
								<td>9</td>
								<td>Alamat</td>
								<td>:</td>
								<td siswa="alamat_siswa"></td>
							</tr>
							<tr>
								<td>10</td>
								<td>Telp</td>
								<td>:</td>
								<td siswa="telp_siswa"></td>
							</tr>
							<tr>
								<td>11</td>
								<td>Asal Sekolah</td>
								<td>:</td>
								<td siswa="asal_sekolah_siswa"></td>
							</tr>
							<tr>
								<td>12</td>
								<td>Diterima</td>
								<td>:</td>
								<td siswa="diterima_tingkat_siswa"></td>
							</tr>
							<tr>
								<td>13</td>
								<td>Pada Tanggal</td>
								<td>:</td>
								<td siswa="pada_tanggal_siswa"></td>
							</tr>
							<tr>
								<td>14</td>
								<td>Kelas</td>
								<td>:</td>
								<td siswa="kelas_siswa"></td>
							</tr>
						</table>
					</div>
					<div role="tabpanel" class="tab-pane" id="data-ortu-view" style="min-height: 400px">
						<table class="table table-striped table-bordered">
							<tr>
								<td width="30">1</td>
								<td width="200">Nama Ayah</td>
								<td width="30">:</td>
								<td ortu="nama_ayah"></td>
							</tr>
							<tr>
								<td></td>
								<td>Pekerjaan Ayah</td>
								<td>:</td>
								<td ortu="pek_ayah"></td>
							</tr>
							<tr>
								<td></td>
								<td>Telp Ayah</td>
								<td>:</td>
								<td ortu="telp_ayah"></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Nama Ibu</td>
								<td>:</td>
								<td ortu="nama_ibu"></td>
							</tr>
							<tr>
								<td></td>
								<td>Pekerjaan Ibu</td>
								<td>:</td>
								<td ortu="pek_ibu"></td>
							</tr>
							<tr>
								<td></td>
								<td>Telp Ibu</td>
								<td>:</td>
								<td ortu="telp_ibu"></td>
							</tr>
							<tr>
								<td></td>
								<td>Telp Orang Tua</td>
								<td>:</td>
								<td ortu="telp_ortu"></td>
							</tr>
							<tr>
								<td></td>
								<td>Alamat Orang Tua</td>
								<td>:</td>
								<td ortu="alamat_ortu"></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Nama Wali</td>
								<td>:</td>
								<td ortu="nama_wali"></td>
							</tr>
							<tr>
								<td></td>
								<td>Pekerjaan Wali</td>
								<td>:</td>
								<td ortu="pek_wali"></td>
							</tr>
							<tr>
								<td></td>
								<td>Telp Wali</td>
								<td>:</td>
								<td ortu="telp_wali"></td>
							</tr>
							<tr>
								<td></td>
								<td>Alamat Wali</td>
								<td>:</td>
								<td ortu="alamat_wali"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Siswa -->

<!-- Modal Form Siswa -->
<div class="modal fade" id="modal-siswa">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<form action="#" id="form-siswa">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#data-diri-form" aria-controls="data-diri-form" role="tab" data-toggle="tab">Data Diri</a></li>
						<li role="presentation"><a href="#data-ortu-form" aria-controls="data-ortu-form" role="tab" data-toggle="tab">Data Orang Tua</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="data-diri-form" style="min-height: 400px">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>NIS</label>
										<input type="text" name="nis_siswa_disabled" class="form-control"/>
										<input type="hidden" name="nis_siswa_hidden"/>
										<input type="hidden" name="id_sekolah" value="<?=$this->uri->segment(4)?>"/>
									</div>
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" name="nama_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Tempat Lahir</label>
										<input type="text" name="tempat_lahir_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="text" name="tanggal_lahir_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select name="jenis_kelamin_siswa" class="form-control">
											<option value="">Pilih Jenis Kelamin</option>
											<option value="L">Laki-laki</option>
											<option value="P">Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label>Anak ke</label>
										<input type="text" name="anak_ke_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Status Dalam Keluarga</label>
										<select class="form-control" name="status_keluarga_siswa">
											<option value="">Pilih Status Keluarga</option>
											<option value="Anak Kandung">Anak Kandung</option>
											<option value="Anak Angkat">Anak Angkat</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>NISN</label>
										<input type="text" name="nisn_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Telp</label>
										<input type="text" name="telp_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Asal Sekolah</label>
										<input type="text" name="asal_sekolah_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Diterima Tingkat</label>
										<select class="form-control" name="diterima_grade_siswa">
											<option value="">Pilih diterima Tingkat</option>
											<?php
											$id=$this->uri->segment(4);
											if(intval($id) == 1){
												echo '
											<option value="X">X</option>
											<option value="XI">XI</option>
											<option value="XII">XII</option>';	
											}else{
												echo '<option value="VII">VII</option>
											<option value="VIII">VIII</option>
											<option value="IX">IX</option>';	
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Pada Tanggal</label>
										<input type="text" name="pada_tanggal_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Tahun Ijazah</label>
										<input type="text" name="tahun_ijazah_siswa" class="form-control"/>
									</div>
									<div class="form-group">
										<label>No. Ijazah</label>
										<input type="text" name="nomor_ijazah_siswa" class="form-control"/>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Alamat</label>
										<textarea class="form-control" name="alamat_siswa" style="resize: none" rows="5"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="data-ortu-form" style="min-height: 400px">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Ayah</label>
										<input type="text" name="nama_ayah" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Pekerjaan Ayah</label>
										<select class="form-control" name="pek_ayah">
											<option value="">Pilih Pekerjaan Ayah</option>
											<?php
											$pek = $this->db->get('pek');
											foreach($pek->result_array() as $p){
												echo '<option value="'.$p['pek_id'].'">'.$p['nama_pek'].'</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Telp Ayah</label>
										<input type="text" name="tlp_ayah" class="form-control"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Ibu</label>
										<input type="text" name="nama_ibu" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Pekerjaan Ibu</label>
										<select class="form-control" name="pek_ibu">
											<option value="">Pilih Pekerjaan Ibu</option>
											<?php
											$pek = $this->db->get('pek');
											foreach($pek->result_array() as $p){
												echo '<option value="'.$p['pek_id'].'">'.$p['nama_pek'].'</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Telp Ibu</label>
										<input type="text" name="tlp_ibu" class="form-control"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Telp Rumah Orang tua</label>
										<input type="text" name="tlp_ortu" class="form-control"/>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Alamat Orang Tua</label>
										<textarea class="form-control" name="alamat_ortu" style="resize: none" rows="4"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Wali</label>
										<input type="text" name="nama_wali" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Pekerjaan Wali</label>
										<select class="form-control" name="pek_wali">
											<option value="">Pilih Pekerjaan Wali</option>
											<?php
											$pek = $this->db->get('pek');
											foreach($pek->result_array() as $p){
												echo '<option value="'.$p['pek_id'].'">'.$p['nama_pek'].'</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Telp Wali</label>
										<input type="text" name="tlp_wali" class="form-control"/>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Alamat Wali</label>
										<textarea class="form-control" name="alamat_wali" style="resize: none" rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="save_siswa()" ><span class="fa fa-save"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Form View Siswa -->

<!-- Modal hapus Siswa -->
<div class="modal fade" id="modal-hapus-siswa">
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
							<td>NIS</td>
							<td>Nama</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td siswa-del="nis"></td>
							<td siswa-del="nama"></td>
						</tr>
					</tbody>
				</table>
				<form action="#" id="form-delete-siswa" method="POST">
					<input type="hidden" name="nis_siswa_delete"/>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="hapus-siswa" onclick="delete_siswa()"><span class="fa fa-trash"></span></button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End hapus Siswa -->
