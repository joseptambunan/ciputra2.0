<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image">
          <br>
        </div>

      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Data</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/')}}/tender/"><i class="fa fa-circle-o"></i>Tender</a></li>
            <li><a href="{{ url('/')}}/spks/"><i class="fa fa-circle-o"></i> SPK</a></li>
            <li><a href="{{ url('/')}}/datadiri/"><i class="fa fa-circle-o"></i> Data Diri</a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->