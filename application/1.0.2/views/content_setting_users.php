  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Users</small>
      </h1>
      
      <?=$this->breadcrumbs->show();?>
       
    </section>

    <!-- Main content -->
    <section class="content">


	<div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a aria-expanded="false" href="#client" data-toggle="tab">Client</a></li>
              <li class="active"><a aria-expanded="true" href="#karyawan" data-toggle="tab">Karyawan</a></li>
            </ul>
            <div class="tab-content">
              <!-- Font Awesome Icons -->
              <div class="tab-pane" id="client">
              	<h1>Client</h1>
              </div>
              <!-- /#fa-icons -->

              <!-- glyphicons-->
              <div class="tab-pane active" id="karyawan">
				<table id="table-karyawan" class="table table-border table-hover">
					<thead>
						<tr>
							<th>Nama Karyawan</th>
							<th>status</th>
							<th>Login Terakhir</th>
							<th>Actions</th>
						</tr>
					</thead>
				</table>
              </div>
              <!-- /#ion-icons -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  	<div class="modal" id="edit-users-karyawan" data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn" id="btn-save-update-karyawan">Ganti</button>
				</div>
			</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	
  	<div class="modal modal-danger" id="delete-users-karyawan" data-backdrop="static" tabindex="-1" data-keyboard="false">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<h5 class="text-karyawan-delete">Dashboard</h5>
					<input type="hidden" name="id"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-outline" id="btn-save-delete-karyawan">Delete</button>
				</div>
			</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>