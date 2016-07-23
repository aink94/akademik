<!-- ChartJS 1.0.1 -->
<script src="<?=base_url('assets')?>/plugins/chartjs/Chart.min.js"></script>

<script>
	$(function(){
		$("#th-ajaran-aktif").on('change', function(e){
			"use strict";
			var optionSelected = $("option:selected", this);
    		var valueSelected = this.value;
    		$.ajax({
				url: "<?=site_url('admin/admin/update_aktif_th_ajaran')?>/"+valueSelected,
				type: "POST",
				dataType: "JSON",
				success: function(data){
					setTimeout(function() {
				        $(".alert").alert('close');
				    }, 2000);
					$("#setting-th-ajaran > .box-body").prepend('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tahun Ajaran Berhasil Diubah</div>');
				},
				error: function(jqXHR, textStatus, errorThrown){
					setTimeout(function() {
				        $(".alert").alert('close');
				    }, 2000);
					$("#setting-th-ajaran > .box-body").prepend('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tahun Ajaran Gagal Diubah</div>');
				},
				beforeSend: function() {
			        $("#setting-th-ajaran").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
			    },
			    complete: function(){
					$(".overlay").remove();
				}
			});
		});
	});
</script>