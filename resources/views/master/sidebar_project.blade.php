  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image">
          <br>
        </div>
        <div class="pull-left info">
          <p>{{ $user->user_name }}</p>
          <i class="fa fa-circle text-success"></i> Online
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if ( Session::has('level'))
          @if ( Session::get('level') == "superadmin")
          <li><a href="{{ url('/')}}/home">Master Data</a></li>
          @endif
        @endif
        <li><a href="{{ url('/')}}/project/detail/?id={{ $project->id }}">Home</a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Master Data Proyek</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/')}}/project/data-umum/"><i class="fa fa-circle-o"></i> Data Umum Proyek</a></li>
            <!--li><a href="{{ url('/')}}/kontraktor/"><i class="fa fa-circle-o"></i> Master Rekanan</a></li>
            <!--li><a href="{{ url('/')}}/project/unit-hadap/"><i class="fa fa-circle-o"></i> Unit Hadap</a></li-->
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Planning</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">            
            <li><a href="{{ url('/')}}/project/kawasan"><i class="fa fa-circle-o"></i> Kawasan</a></li>
            <!--li><a href="{{ url('/')}}/project/unit-type/"><i class="fa fa-circle-o"></i> Unit Type</a></li-->
          </ul>
        </li>        
        <!--li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Budget</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/')}}/budget/proyek/"><i class="fa fa-circle-o"></i>Budget</a></li>
          </ul>
        </li>
        <!--li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Pengajuan Biaya</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/')}}/pengajuanbiaya/"><i class="fa fa-circle-o"></i> Pengajuan Biaya</a></li>
          </ul>
        </li-->        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Kontrak</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/')}}/workorder/"><i class="fa fa-circle-o"></i> Workorder</a></li>
            <li><a href="{{ url('/')}}/tender/"><i class="fa fa-circle-o"></i> Tender</a></li>
            <li><a href="{{ url('/')}}/spk/"><i class="fa fa-circle-o"></i> SPK - BAP</a></li>
            <!--li><a href="{{ url('/')}}/voucher/"><i class="fa fa-circle-o"></i> Voucher</a></li-->
          </ul>
        </li>
        <li><a href="{{ url('/')}}/logout">Logout</a></li>
      </ul>      
    </section>
    <!-- /.sidebar -->
  </aside>