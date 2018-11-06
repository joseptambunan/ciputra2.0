
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

        <li class="treeview menu-open">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: block;">
            <li><a href="{{ url('/')}}/country/"><i class="fa fa-circle-o"></i> Negara</a></li>
            <li><a href="{{ url('/')}}/jabatan/"><i class="fa fa-circle-o"></i> Jabatan</a></li>
            <li><a href="{{ url('/')}}/department/"><i class="fa fa-circle-o"></i> Departemen</a></li>
            <li><a href="{{ url('/')}}/division/"><i class="fa fa-circle-o"></i> Divisi</a></li>
            <li><a href="{{ url('/')}}/pt/"><i class="fa fa-circle-o"></i> PT</a></li>          
            <li><a href="{{ url('/')}}/escrow/"><i class="fa fa-circle-o"></i>Escrows</a></li>
            <li><a href="{{ url('/')}}/pekerjaan/"><i class="fa fa-circle-o"></i> Item Pekerjaan</a></li>
            <li><a href="{{ url('/')}}/user/master"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="{{ url('/')}}/document/"><i class="fa fa-circle-o"></i> Dokumen</a></li>
            <li><a href="{{ url('/')}}/bank/"><i class="fa fa-circle-o"></i> Bank</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Global Setting</a></li>            
            <li><a href="{{ url('/')}}/category/"><i class="fa fa-circle-o"></i>Kategori Bangunan</a></li>
            <li><a href="{{ url('/')}}/rekanan/"><i class="fa fa-circle-o"></i>Rekanan</a></li>
            <li><a href="{{ url('/')}}/logout/"><i class="fa fa-circle-o"></i>Logout</a></li>
          </ul>
        </li>
        <li class="treeview menu-open">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Proyek</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: block;">
            
            <li><a href="{{ url('/')}}/project/"><i class="fa fa-circle-o"></i>Project</a></li>  
          </ul>
        </li>       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>