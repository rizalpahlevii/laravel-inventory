<section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ set_active('dashboard') }}"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="{{ set_active(['ruang.index']) }}"><a href="{{ route('ruang.index') }}"><i class="fa fa-dashboard"></i> <span>Ruang</span></a></li>
        <li class="{{ set_active(['pegawai.index']) }}"><a href="{{ route('pegawai.index') }}"><i class="fa fa-users"></i> <span>Pegawai</span></a></li>
        <li class="{{ set_active(['jenis.index']) }}"><a href="{{ route('jenis.index') }}"><i class="fa fa-bookmark"></i> <span>Jenis</span></a></li>
        <li class="{{ set_active(['petugas.index']) }}"><a href="{{ route('petugas.index') }}"><i class="fa fa-users"></i> <span>Petugas</span></a></li>
        <li class="{{ set_active(['inventaris.index']) }}"><a href="{{ route('inventaris.index') }}"><i class="fa fa-laptop"></i> <span>Inventaris</span></a></li>
        <li class="{{ set_active(['peminjaman.index']) }}"><a href="{{ route('peminjaman.index') }}"><i class="fa fa-navicon"></i> <span>Peminjaman</span></a></li>
        <li class="{{ set_active(['pengembalian.index','pengembalian.detail']) }}"><a href="{{ route('pengembalian.index') }}"><i class="fa fa-reply"></i> <span>Pengembalian</span></a></li>
        
      </ul>
    </section>