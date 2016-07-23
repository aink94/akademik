  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url('assets')?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('username');?></p>
          <p><?=$this->session->userdata('akses');?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Admin</li>
        
        <?php
        echo '
        <li>'.anchor(site_url('admin/admin'), '<i class="fa fa-laptop"></i> <span>Dasboard</span>').'</li>
        <li class="treeview">
        	'.anchor('#', '<i class="fa fa-mortar-board"></i> <span>Siswa</span> <i class="fa fa-angle-left pull-right"></i>').'
        	<ul class="treeview-menu">
        		<li>'.anchor(site_url('admin/siswa'), '<i class="fa fa-mortar-board"></i> Data Siswa').'</li>
        		<li>'.anchor(site_url('admin/siswa'), '<i class="fa fa-circle-o"></i> Data Nilai').'</li>
        	</ul>
        </li>
        <li class="treeview">
        	'.anchor('#', '<i class="fa fa-group"></i> <span>Guru</span> <i class="fa fa-angle-left pull-right"></i>').'
        	<ul class="treeview-menu">
        		<li>'.anchor(site_url('admin/guru'), '<i class="fa fa-mortar-board"></i> Data Guru').'</li>
        	</ul>
        </li>
        ';
        ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->