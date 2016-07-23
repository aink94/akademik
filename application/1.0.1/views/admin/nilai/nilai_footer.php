<!-- DataTables -->
<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.1/js/dataTables.fixedColumns.min.js"></script>

<script>
	var table;
	$(function(){
		//new $.fn.dataTable.FixedColumns(table, {leftColumns: 2});
		table = $("#table-nilai").DataTable({
			"destroy" : true,
			"fixedHeader": true,
			"scrollCollapse": false,
			"scrollX": true,
			"scrollY": 600,
			"bProcessing": true,
			"bFilter": false,
			"bLengthChange": false,
			"paging": false,
			"info": false,
			"ordering": false,
			autoFill: true,
			fixedColumns: {leftColumns: 2},
			"ajax": {
				url: "<?=site_url('admin/nilai/contoh/40/1/SMP-IPA')?>"
			},
			
			"columns":[
				{"data": "nis"},
				{"data": "nama"},
				{"data": "pengetahuan.0"},
				{"data": "pengetahuan.1"},
				{"data": "pengetahuan.2"},
				{"data": "pengetahuan.3"},
				{"data": "pengetahuan.4"},
				{"data": "pengetahuan.5"},
				{"data": "pengetahuan.6"},
				{"data": "pengetahuan.7"},
				{"data": "pengetahuan.8"},
				
				{"data": "pengetahuan.9"},
				{"data": "pengetahuan.10"},
				{"data": "nis"},
				{"data": "nis"},
				
				{"data": "keterampilan.0"},
				{"data": "keterampilan.1"},
				{"data": "keterampilan.2"},
				{"data": "keterampilan.3"},
				{"data": "keterampilan.4"},
				{"data": "keterampilan.5"},
				{"data": "keterampilan.6"},
				{"data": "keterampilan.7"},
				{"data": "keterampilan.8"},
				{"data": "keterampilan.9"},
				{"data": "keterampilan.10"},
				{"data": "nama"},
				{"data": "nama"},
				
				{"data": "sikap.0"},
				{"data": "sikap.1"},
				{"data": "sikap.2"},
				{"data": "sikap.3"},
				{"data": "sikap.4"},
				{"data": "sikap.5"},
				{"data": "sikap.6"},
				{"data": "sikap.7"},
				{"data": "sikap.8"},
				{"data": "sikap.9"},
				{"data": "sikap.10"},
				{"data": "nama"},
				{"data": "nama"},
			],
			columnDefs: [
	            {
	                targets: [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
	                className: 'bg-info'
	            },
	            {
	                targets: [ 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40],
	                className: 'bg-info'
	            }
	        ]
		});
		$('#table-nilai tbody td').on('click', function() {
			if ( $(this).hasClass('cell_selected') )
			$(this).removeClass('cell_selected');
			else
			$(this).addClass('cell_selected');
		} );
		$('#table-nilai').on('click', 'td', function (e) {
		    e.preventDefault();
		    var rowIndex =  $(this).find('td').text();
		    alert(rowIndex);
		});
		//$('.modal-lg').css('width', '1400px');
		$("table > thead > tr > th").addClass("text-center");
		//
	});
</script>

<div class="modal fade" id="modal-mapel-kelas" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-nilai-mapel" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#nilai-angka" aria-controls="nilai-angka" role="tab" data-toggle="tab">Nilai Angka</a></li>
					<li role="presentation"><a href="#nilai-deskripsi" aria-controls="nilai-deskripsi" role="tab" data-toggle="tab">Nilai Deskripsi</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="nilai-angka" style="min-height: 400px">
					</div>
					<div role="tabpanel" class="tab-pane active" id="nilai-deskripsi" style="min-height: 400px">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>