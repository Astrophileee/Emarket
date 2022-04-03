<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          
          <!-- /menu profile quick info -->

          <br />
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>General</h3>
      <ul class="nav side-menu">
        <li><a href="/admin"><i class="fa fa-home"></i> Home </a>
        </li>
        <li><a href="/admin/produk"><i class="fas fa-box-open"></i> produk </a>
        </li>
        <li><a href="/admin/barang"><i class="fas fa-boxes"></i> Barang </span></a>
        </li>
        <li><a href="/admin/pemasok"><i class="fas fa-truck-moving"></i> suppliers </a>
        <li><a href="/admin/pelanggan"><i class="far fa-id-card"></i> Member </a></li>
        </li>
      </ul>
    </div>
    <div class="menu_section">
      <h3>Transaksi</h3>
      <ul class="nav side-menu">
        <li><a href="/admin/pembelian"><i class="fas fa-cash-register"></i> Pembelian </a>
        </li>
        <li><a href="/admin/penjualan"><i class="fas fa-cash-register"></i> Penjualan </a>
        </li>
        <li><a href="/admin/laporan/pendapatan"><i class="fas fa-cash-register"></i> Laporan</a>
        </li>
        </ul>
    </div>
    <div class="menu_section">
      <h3>User</h3>
      <ul class="nav side-menu">
        <li><a href="/admin/user"><i class="fas fa-cash-register"></i> User </a>
        </li>
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->
  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
  </div>
  <!-- /menu footer buttons -->
</div>
</div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      @auth
                    <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }} - {{ Auth::user()->get_role() }}</div>
                @endauth
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a href="/logout" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      <!-- /top navigation -->