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
    		'.anchor('#', '<i class="fa fa-mortar-board"></i><span>Data Siswa </span><i class="fa fa-angle-left pull-right"></i>').'
    			<ul class="treeview-menu">';
    			$sekolah = $this->db->get('sekolah');
    			foreach($sekolah->result() as $s):
    				$nama_sekolah = explode(' ',$s->nama_sekolah);
    				echo '<li>'.anchor(site_url('admin/siswa/datasiswa/'.$s->id_sekolah), '<i class="fa fa-mortar-board"></i> '.$nama_sekolah[0].' '.$nama_sekolah[1]).'</li>';
    			endforeach;
    		echo'</ul>
        </li>
        <li class="treeview">
        	'.anchor('#', '<i class="fa fa-book"></i> <span>Mata Pelajaran</span> <i class="fa fa-angle-left pull-right"></i>').'
        	<ul class="treeview-menu">
        		<li>'.anchor(site_url('admin/mapel'), '<i class="fa fa-book"></i> Mata Pelajaran').'</li>
        		<li>'.anchor(site_url('admin/mapel/jadwal_table'), '<i class="fa fa-book"></i> Jadwal').'</li>
        	</ul>
        </li>
        <li class="treeview">
        	'.anchor('#', '<i class="fa fa-university"></i> <span>Kelas</span> <i class="fa fa-angle-left pull-right"></i>').'
        	<ul class="treeview-menu">
        		<li>'.anchor(site_url('admin/kelas'), '<i class="fa fa-university"></i> Daftar Kelas').'</li>
        	</ul>
        </li>
        <li class="treeview">
        	'.anchor('#', '<i class="fa fa-group"></i> <span>PEGAWAI</span> <i class="fa fa-angle-left pull-right"></i>').'
        	<ul class="treeview-menu">
        		<li>'.anchor(site_url('admin/pegawai/smp'), '<i class="fa fa-users"></i> Data Guru SMA').'</li>
        		<li>'.anchor(site_url('admin/pegawai/sma'), '<i class="fa fa-users"></i> Data Guru SMP').'</li>
        		<li>'.anchor(site_url('admin/pegawai/staff'), '<i class="fa fa-users"></i> Data STAFF').'</li>
        	</ul>
        </li>
        <li class="treeview">
        	'.anchor('#', '<i class="fa fa-book"></i> <span>Nilai</span> <i class="fa fa-angle-left pull-right"></i>').'
        	<ul class="treeview-menu">
        		<li>'.anchor(site_url('admin/nilai'), '<i class="fa fa-book"></i> Leger').'</li>
        	</ul>
        </li>
        <li>'.anchor(site_url('admin/admin/setting'), '<i class="fa fa-gears"></i> <span>Setting</span>').'</li>
        ';
        ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->