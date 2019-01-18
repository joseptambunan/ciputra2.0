  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
   

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ url('/') }}/assets/users/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CIPUTRA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/images/logo-ciputra_original.png" alt="logo" class="logo-default" style='height:57%' />
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $user->user_name or '' }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">  
                 
          <li class="nav-item">
            <a href="{{ url('/')}}/report/project/detail/?id={{ $budget->project->id }}" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/')}}/report/project/document/?id={{ $budget->project->id}}" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>Dokumen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/')}}/report/project/aktivitas/" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>Aktivitas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/')}}/report/project/budget/" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>Budget</p>
            </a>
          </li>
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>