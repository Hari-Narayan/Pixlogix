@inject('request', 'Illuminate\Http\Request')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-dark-success">
        <!-- Brand Logo -->
        <a href="{{ route('admin.home') }}" class="brand-link navbar-dark">
            <img src="{{ url('public/admin/dist/img/logo_sm.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">
                @lang('admin.admin_title')
            </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link {{ $request->segment(2) == 'home' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                @lang('admin.dashboard.title')
                            </p>
                        </a>
                    </li>
                    @canany(['product_access', 'category_access'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Product Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('product_access')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.products.index') }}" class="nav-link">
                                            <i class="fas fa-layer-group nav-icon"></i>
                                            <p>Products</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('category_access')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.category.index') }}" class="nav-link">
                                            <i class="fas fa-cubes nav-icon"></i>
                                            <p>Category</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
