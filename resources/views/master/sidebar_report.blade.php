
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>User</b></span>
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
            <li><a href="{{ url('/')}}/report/"><i class="fa fa-circle-o"></i> Master Data</a></li>
            <li><a href="{{ url('/')}}/report/project/detail/?id={{$project->id}}"><i class="fa fa-circle-o"></i> Dashboard Proyek</a></li>
            <li><a href="{{ url('/')}}/report/project/document/?id={{ $project->id}}"><i class="fa fa-circle-o"></i> Dokumen</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Aktivitas</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Report</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/')}}/report/project/budget/?id={{ $project->id}}"><i class="fa fa-circle-o"></i>Report HPP Summary</a></li>
                <li><a href="{{ url('/')}}/report/project/budgetdetail/?id={{ $project->id}}"><i class="fa fa-circle-o"></i>Report HPP Detail</a></li>
                <li><a href="{{ url('/')}}/report/project/costreport/?id={{ $project->id}}"><i class="fa fa-circle-o"></i>Cost Report</a></li>
                <!-- <li><a href="#"><i class="fa fa-circle-o"></i>Kontraktor</a></li> -->
                <li><a href="{{ url('/')}}/report/project/reportkawasan/?id={{ $project->id}}"><i class="fa fa-circle-o"></i>Kawasan</a></li>
                <li><a href="{{ url('/')}}/report/project/reportpekerjaan/?id={{ $project->id}}"><i class="fa fa-circle-o"></i>Pekerjaan</a></li>
                <li><a href="{{ url('/')}}/report/project/rakor/?id={{ $project->id}}"><i class="fa fa-circle-o"></i>RAKOR</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>RAKER</a></li>
              </ul>
            </li>                        
          </ul>
        </li>       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>s