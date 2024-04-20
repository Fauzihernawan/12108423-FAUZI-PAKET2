<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">KasirBro</span>
</a>
<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (Auth::check() && Auth::user()->role == 'admin')
                <li class="nav-item {{ request()->routeIs('dashboard_admin') ? 'menu-open active' : '' }}">
                    <a href="{{ route('dashboard_admin') }}"
                        class="nav-link {{ request()->routeIs('dashboard_admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('user') || request()->routeIs('formUser') || request()->routeIs('formEdit') ? 'menu-open active' : '' }}">
                    <a href="{{ route('user') }}"
                        class="nav-link {{ request()->routeIs('formUser') || request()->routeIs('user') || request()->routeIs('formEdit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('produk') || request()->routeIs('formProduk') || request()->routeIs('formEdit') ? 'menu-open active' : '' }}">
                    <a href="{{ route('produk') }}"
                        class="nav-link {{ request()->routeIs('formProduk') || request()->routeIs('produk') || request()->routeIs('formEdit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-square"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('produk') ? 'menu-open active' : '' }}">
                    <a href="{{ route('produk') }}"
                        class="nav-link {{ request()->routeIs('produk') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-square"></i>
                        <p>
                            Pembelian
                        </p>
                    </a>
                </li>
            @endif
            @if (Auth::check())
                @if (Auth::user()->role == 'petugas')
                    <li class="nav-item {{ request()->routeIs('dashboard_petugas') ? 'menu-open active' : '' }}">
                        <a href="{{ route('dashboard_petugas') }}"
                            class="nav-link {{ request()->routeIs('dashboard_petugas') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif
            @endif

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
