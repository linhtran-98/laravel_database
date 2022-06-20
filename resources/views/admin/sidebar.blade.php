  <!-- Main Sidebar Container -->
  {{-- @dd($pending.' '.$approve.' '.$reject); --}}
  <aside class="main-sidebar sidebar-dark-primary elevation-4"  style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(249, 249, 249), rgb(246, 198, 234), rgb(250, 244, 183));">
    <!-- Brand Logo -->
    <a href="{{ route('products.index') }}" class="brand-link">
      <img src="{{asset('/uploads/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light text-dark">Admin</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <form action="{{ route('products.index') }}" method="GET">
        <div class="form-inline mt-3 mb-3">
          <div class="input-group">
            <input id="search" name="search" required class="form-control border border-info" type="search" placeholder="Live search" aria-label="Search">
            <div class="input-group-append">
              <button type="submit" class="btn border border-info">
                <span class="fas fa-search fa-fw"></span>
              </button>
            </div>
          </div>
        </div>
      </form>
      <div id="livesearch" class="d-flex flex-column" style="gap:3px;">
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="#" class="nav-link text-dark">
              <i class="spanav-icon fas fa-bars"></i>
              <p class="ml-1">
                Danh Mục
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category.create') }}" class="nav-link text-dark">
                  <span class="fas fa-chevron-right nav-icon"></span>
                  <p>Thêm danh mục</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link text-dark">
                  <span class="fas fa-chevron-right nav-icon"></span>
                  <p>Danh sách danh mục</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link text-dark">
              <i class="spanav-icon fas fa-bars"></i>
              <p class="ml-1">
                Sản phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('products.create') }}" class="nav-link text-dark">
                  <span class="fas fa-chevron-right nav-icon"></span>
                  <p>Thêm sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link text-dark">
                  <span class="fas fa-chevron-right nav-icon"></span>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>

      
      <!-- /.sidebar-menu -->
      
    </div>
    <!-- /.sidebar -->
  </aside>