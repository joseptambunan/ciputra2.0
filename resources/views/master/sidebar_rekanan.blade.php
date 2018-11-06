
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Rekanan CIPUTRA GROUP</b></span>
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
          <br>
        </div>
        <div class="pull-left info">
          <p>{{ $rekanan_group->name }}</p><br>
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

          <ul class="treeview-menu" style="display: block;">
            <li><a href="{{ url('/')}}/rekanan/user/"><i class="fa fa-circle-o"></i> Kantor Pusat ( Holding )</a></li>
            <li><a href="{{ url('/')}}/rekanan/user/cabang/"><i class="fa fa-circle-o"></i> Cabang</a></li>
            <li><a href="{{ url('/')}}/rekanan/user/tender/"><i class="fa fa-circle-o"></i> Tender</a></li>
            <li><a href="{{ url('/')}}/rekanan/user/spk/"><i class="fa fa-circle-o"></i> Spk</a></li>
            <li><a href="{{ url('/')}}/rekanan/user/price/"><i class="fa fa-circle-o"></i> Price List</a></li>
            <li><a href="{{ url('/')}}/logout/"><i class="fa fa-circle-o"></i>Logout</a></li>
          </ul>
        </li>      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>