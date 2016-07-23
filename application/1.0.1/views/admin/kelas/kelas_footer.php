<!-- DataTables -->
<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<!-- InputMask -->
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?=base_url('assets')?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- DatePicker -->
<script src="<?=base_url('assets')?>/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- iCheck 1.0.1 -->
<script src="<?=base_url('assets')?>/plugins/iCheck/icheck.min.js"></script>
<script>
	var tablekelas, tabledatasiswa, tabledatamapel, tablemapelno, tablesiswano;
	var save_method;
	$(function(){
		"use strict";
		
		tampildata('');
		$("#id-sekolah-kelas").on('change', function(e){
			var optionSelected = $("option:selected", this);
    		var valueSelected = this.value;
    		tampildata(valueSelected);
		});
	});
	function tampildata(id){
		tablekelas = $("#tablekelas").DataTable({ 
			dom: 'Bfrtip',
		    buttons: [
		        'print'
		    ],
			"processing" : true,
			"serverSide" : true,
			"paging"    : false,
			"searching" : false,
			"ordering": false,
			"destroy": true,
			"autoFill": true,
			"scrollY" : "600px",
			"fixedColumns":   true,
			"scrollCollapse": true,
			"ajax":{
				"url": "<?=site_url('admin/kelas/getDataKelas')?>/"+id,
				"type": "POST"	
			}
		});
	}
	function reload_table(){
		tablekelas.ajax.reload(null, false);
	}
	function lihat_siswa(id_kelas, nama, id_sekolah){
		$('.modal-title').text('Daftar Siswa Kelas '+nama);
		$('#btn-tambah-siswa-kelas').get(0).setAttribute("onclick", "tambah_siswa_kelas("+id_kelas+", "+id_sekolah+")");
		$("#data-siswa-kelas").modal({"backdrop": "static", keyboard: false});
		tabledatasiswa = $("#table_data_siswa").DataTable({
			"processing" : true,
			"serverSide" : true,
			"paging"    : false,
			"searching" : false,
			"ordering": false,
			"info" : false,
			"destroy" : true,
			"scrollY" : "450px",
			autoFill: true,
			"fixedColumns":   true,
			"scrollCollapse": true,
			"ajax":{
				"url": "<?=site_url('admin/kelas/getDataSiswaKelas')?>/"+id_kelas,
				"type": "POST"	
			},
			dom: 'T<"clear">lfrtip', 
			tableTools: { 
				"aButtons": [ "copy", "csv", "xls", { 
					"sExtends": "pdf", 
					"sPdfOrientation": "landscape", 
					"sPdfMessage": "Your custom message would go here." }, 
					"print" ]
			},
			autoFill: true
		});
	}
	function lihat_mapel(id_kelas, nama, id_sekolah){
		$('.modal-title').text('Daftar Mapel Kelas '+nama);
		$('#tambah-k-mapel').get(0).setAttribute("onclick", "tambah_mapel_kelas("+id_sekolah+", "+id_kelas+")");
		$("#data-mapel-kelas").modal({"backdrop": "static", keyboard: false});
		tabledatamapel = $("#table_data_mapel").DataTable({
			"processing" : true,
			"serverSide" : true,
			"paging"    : false,
			"searching" : false,
			"ordering": false,
			"info" : false,
			"destroy" : true,
			"scrollY" : "450px",
			autoFill: true,
			"fixedColumns":   true,
			"scrollCollapse": true,
			"ajax":{
				"url": "<?=site_url('admin/kelas/getDataMapelKelas')?>/"+id_kelas,
				"type": "POST"	
			},
			autoFill: true
		}); 
	}
	function edit_wali(id, nama, nupk_wali){
		$('.modal-title').text('Edit Wali Kelas '+nama);
		$("#edit-wali").modal({"backdrop": "static", keyboard: false})
		//$("#form-edit-guru")[0].reset();
		$("[name='nupk_guru']").val(nupk_wali);
		$("[name='id_kelas']").val(id);
	}
	function save_edit_wali(){
		$.ajax({
			url: '<?=site_url("admin/kelas/updatewali")?>',
			type: "POST",
			data: $('#form-edit-wali').serialize(),
			dataType: "JSON",
			success: function(data){
				$("#edit-wali").modal("hide")
				reload_table();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	function tambah_kelas(){
		$('.modal-title').text('Tambah Kelas Siswa');
		$("#tambah-kelas").modal({"backdrop": "static", keyboard: false});
		$("#form-tambah-kelas")[0].reset();
		
		$("[name='id_sekolah']").on('change', function(e){
			var valueSelected = this.value;
			if(valueSelected == 1){
				$("[name='grade']").empty().append('<option value="X">X</option><option value="XI">XI</option><option value="XII">XII</option>').selectmenu('refresh');
			}else{
				$("[name='grade']").empty().append('<option value="VII">VII</option><option value="VIII">VIII</option><option value="IX">IX</option>').selectmenu('refresh');
			}
		});
	}
	function save_tambah_kelas(){
		$.ajax({
			url: "<?=site_url('admin/kelas/tambahKelas')?>",
			type: "POST",
			data: $('#form-tambah-kelas').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#tambah-kelas').modal("hide");
				tablekelas.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			}
		});
	}
	
	function tambah_mapel_kelas(id_sekolah, id_kelas){
		$("#tambah-mapel-kelas > div > div > div > .modal-title").text("Tambah Mata Pelajaran");
		$("#tambah-mapel-kelas").modal({"backdrop": "static", keyboard: false});
		$("#form-tambah-mapel-kelas")[0].reset();
		$("[name='id_kelas_mapel']").val(id_kelas);
		$("#checkall").change(function(){
      		$(".check-mapel").prop('checked', $(this).prop("checked"));
      	});
		tampil_mapel_no(id_sekolah, id_kelas);
	}
	function add_mapel_kelas(){
		$.ajax({
			url: "<?=site_url('admin/kelas/tambah_mapel_kelas')?>",
			type: "POST",
			data: $('#form-tambah-mapel-kelas').serialize(),
			dataType: "JSON",
			success: function(data){
				$("#tambah-mapel-kelas").modal("hide");
				tabledatamapel.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			},
			beforeSend: function(){
				$("#tambah-mapel-kelas > div:nth-child(1) > div:nth-child(1) > div:nth-child(3) > button:nth-child(1)").attr('disabled');
			}
		});
	}
	function tampil_mapel_no(id_sekolah, id_kelas){
		tablemapelno = $("#table-mapel-no").DataTable({
			"processing" : true,
			"serverSide" : true,
			"paging"    : false,
			"searching" : false,
			"ordering": false,
			"info" : false,
			"destroy" : true,
			"scrollY" : "450px",
			autoFill: true,
			"fixedColumns":   true,
			"scrollCollapse": true,
			"ajax":{
				"url": "<?=site_url('admin/kelas/selectMapelNo')?>/"+id_sekolah+"/"+id_kelas,
				"type": "POST"	
			},
			autoFill: true
		});
	}
	function hapus_mapel_kelas(kd_mapel, id_kelas){
		if(confirm('Are you sure delete this data?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?=site_url('admin/kelas/hapusKelasMapel')?>/"+kd_mapel+"/"+id_kelas,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                tabledatamapel.ajax.reload(null, false);
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });
	 
	    }
	}
	
	function tambah_siswa_kelas(id_kelas, id_sekolah){
		$("#modal-tambah-siswa-kelas > div > div > div > .modal-title").text("Tambah Siswa");
		$("#modal-tambah-siswa-kelas").modal({"backdrop": "static", keyboard: false});
		$("#form-tambah-siswa-kelas")[0].reset();
		$("[name='idkelas-siswa-kelas']").val(id_kelas);
		//ngambil kelas
		
		$.getJSON("<?=site_url('admin/kelas/kelas')?>/"+id_sekolah, function(data){
			var opt = [];
			opt.push("<option value=''>Pilih Kelas</option>");
			$.each(data, function(key, value){
				opt.push("<option value='"+value[0]+"'>"+value[1]+"</option>");
			})
			$("#id-kelas-lama").empty().append(opt);
		})
		
		tampil_siswa_kelas_no(id_sekolah, '');
		
		$("#id-kelas-lama").on('change', function(e){
			var valSelected = this.value;
			tampil_siswa_kelas_no(id_sekolah, valSelected);
		});
		
		$("[name='check-all-siswa']").change(function(){
      		$(".check-siswa").prop('checked', $(this).prop("checked"));
      	});
		
	}
	function tampil_siswa_kelas_no(id_sekolah, id_kelas_lama){
		tablesiswano = $("#table-siswa-kelas-no").DataTable({
			"processing" : true,
			"serverSide" : true,
			"paging"    : false,
			"searching" : false,
			"ordering": false,
			"info" : false,
			"destroy" : true,
			"scrollY" : "450px",
			autoFill: true,
			"fixedColumns":   true,
			"scrollCollapse": true,
			"ajax":{
				"url": "<?=site_url('admin/kelas/selectSiswaNo')?>/"+id_sekolah+"/"+id_kelas_lama,
				"type": "POST"	
			}
		});
	}
	function add_siswa_kelas(){
		$.ajax({
			url: "<?=site_url('admin/kelas/tambahSiswaKelas')?>",
			type: "POST",
			data: $('#form-tambah-siswa-kelas').serialize(),
			dataType: "JSON",
			success: function(data){
				$("#modal-tambah-siswa-kelas").modal("hide");
				tabledatasiswa.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Ajax Data');
			},
			beforeSend: function(){
				$("#modal-tambah-siswa-kelas > div:nth-child(1) > div:nth-child(1) > div:nth-child(3) > button:nth-child(1)").attr('disabled');
			}
		});
	}
	function hapus_siswa_kelas(nis, id_kelas){
		if(confirm('Are you sure delete this data?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?=site_url('admin/kelas/hapusKelasSiswa')?>/"+nis+"/"+id_kelas,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                tabledatasiswa.ajax.reload(null, false);
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });
	    }
	}
</script>

<div class="modal fade" id="data-siswa-kelas">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-info btn-sm pull-right" id="btn-tambah-siswa-kelas"><li class="fa fa-plus"></li></button> 
				<table class="table table-striped table-bordered" id="table_data_siswa">
					<thead>
						<tr>
    						<th>#</th>
							<th>NIS</th>
							<th>NISN</th>
							<th>Nama Lengkap Siswa</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="data-mapel-kelas">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-info pull-right" id="tambah-k-mapel"><li class="fa fa-plus"></li></button>
				<table class="table table-striped table-bordered" id="table_data_mapel">
					<thead>
						<tr>
    						<th>#</th>
    						<th>Kode Mapel</th>
    						<th>Nama Mapel</th>
    						<th>Kelompok</th>
    						<th>Tingkat</th>
    						<th>Guru Pengajar</th>
    						<th></th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-wali">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
			<form id="form-edit-wali">
				<input type="hidden" name="id_kelas"/>
				<div class="form-group">
					<label></label>
					<select class="form-control" name="nupk_guru">
					<?php
					$this->db->select('nama_guru, nupk_guru');
					$this->db->from('guru');
					$this->db->where('status_kerja_guru', 'aktif');
					$this->db->like('jabatan_guru', 'GURU');
					$this->db->order_by('nama_guru');
					$query = $this->db->get();
					foreach($query->result() as $g):
						echo '<option value="'.$g->nupk_guru.'">'.$g->nama_guru.'</option>';
					endforeach;
					?>
					</select>
				</div>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" onclick="save_edit_wali()"><li class="fa fa-save"></li></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="tambah-kelas">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<form id="form-tambah-kelas">
					<input type="hidden" name="id_th_ajaran" value="<?=$this->session->userdata('th_ajaran_aktif')?>"/>
					<div class="form-group">
						<label></label>
						<select class="form-control" name="id_sekolah">
							<option value="">Pilih Sekolah</option>
							<?php
							foreach($this->db->get('sekolah')->result() as $s){
								echo '<option value="'.$s->id_sekolah.'">'.$s->nama_sekolah.'</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label></label>
						<select class="form-control" name="grade">
							<option value="">Pilih Grade</option>
						</select>
					</div>
					<div class="form-group">
						<label></label>
						<input type="text" name="nama_kelas" class="form-control"/>
						<p class="help-block">Contoh: IPS-1.</p>
					</div>
					<div class="form-group">
						<label></label>
						<select class="form-control" name="nupk_wali">
							<option value="">Pilih Wali kelas</option>
							<?php
							$this->db->select('nama_guru, nupk_guru');
							$this->db->from('guru');
							$this->db->where('status_kerja_guru', 'aktif');
							$this->db->like('jabatan_guru', 'GURU');
							$this->db->order_by('nama_guru');
							$query = $this->db->get();
							foreach($query->result() as $g):
								echo '<option value="'.$g->nupk_guru.'">'.$g->nama_guru.'</option>';
							endforeach;
							?>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" onclick="save_tambah_kelas()"><li class="fa fa-save"></li></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="tambah-mapel-kelas">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<form id="form-tambah-mapel-kelas">
				<input type="hidden" name="id_kelas_mapel"/>
				<table class="table table-bordered" id="table-mapel-no">
					<thead>
						<tr>
							<td width="20"><input type="checkbox" id="checkall"></td></td>
							<td>Nama Mapel</td>
							<td>Kelompok Mapel</td>
							<td>Tingkat Mapel</td>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" onclick="add_mapel_kelas()"><li class="fa fa-save"></li></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>	
</div>

<div class="modal fade" id="modal-tambah-siswa-kelas">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
			<div class="form-group">
				<select class="form-control" id="id-kelas-lama">
					<option value="">Pilih Kelas Lama</option>
				</select>
			</div>
			<form id="form-tambah-siswa-kelas">
				<input type="hidden" name="idkelas-siswa-kelas"/>
				<table class="table table-bordered table-hover" id="table-siswa-kelas-no">
					<thead>
						<tr>
							<th><input type="checkbox" name="check-all-siswa"/></th>
							<th>NIS</th>
							<th>Nama</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" onclick="add_siswa_kelas()"><li class="fa fa-save"></li></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
		
	</div>
</div>