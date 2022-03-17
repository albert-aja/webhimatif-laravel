<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin-dashboard') }}">{{ $tahun_kepengurusan['year'] }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin-dashboard') }}"><img src="{{ asset('img/logo/black/black_100.png') }}"></a>
        </div>
        
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
                <li class="nav-item {{ (request()->routeIs('admin-dashboard')) ? 'current' : '' }}">
                    <a href="{{ route('admin-dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>

            <li class="menu-header">Berita</li>
                <li class="nav-item dropdown {{ (request()->routeIs('post-*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i> <span>Berita</span></a>
                    <ul class="dropdown-menu">
                        <li {{ (request()->routeIs('post-*') && !request()->routeIs('post-create')) ? 'class="active"' : '' }}>
                            <a class="nav-link" href="{{ route('post-data') }}">Data</a>
                        </li>
                        <li {{ (request()->routeIs('post-create')) ? 'class="active"' : '' }}>
                            <a class="nav-link" href="{{ route('post-create') }}">Tulis</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Divisi</li>
                <li class="nav-item dropdown {{ (request()->routeIs('division-*') || request()->routeIs('commitee-*') || request()->routeIs('position-*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Divisi</span></a>
                    <ul class="dropdown-menu">
                        <li {{ (request()->routeIs('division-*') || request()->routeIs('commitee-*')) ? 'class="active"' : '' }}>
                            <a class="nav-link " href="{{ route('division-data') }}">Divisi</a>
                        </li>
                        <li {{ (request()->routeIs('position-*')) ? 'class="active"' : '' }}>
                            <a class="nav-link" href="{{ route('position-data') }}">Jabatan</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Himatif Shop</li>
                <li class="nav-item dropdown {{ (request()->routeIs('shop-*') || request()->routeIs('category-*') || request()->routeIs('color-*') || request()->routeIs('umcontact-*')) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-bag"></i> <span>Himatif Shop</span></a>
                        <ul class="dropdown-menu">
                            <li {{ (request()->routeIs('shop-*')) ? 'class="active"' : '' }}">
                                <a href="{{ route('shop-data') }}" class="nav-link"><span> Produk</span></a>
                            </li>
                            <li {{ (request()->routeIs('category-*')) ? 'class="active"' : '' }}">
                                <a href="{{ route('category-data') }}" class="nav-link"><span>Kategori</span></a>
                            </li>
                            <li {{ (request()->routeIs('color-*')) ? 'class="active"' : '' }}">
                                <a href="{{ route('color-data') }}" class="nav-link"><span>Warna</span></a>
                            </li>
                            <li {{ (request()->routeIs('umcontanct-*')) ? 'class="active"' : '' }}">
                                <a href="{{ route('umcontact-data') }}" class="nav-link"><span>Kontak</span></a>
                            </li>
                        </ul>
                    </li>

            {{-- <li class="menu-header">Web Config</li>
                <li class="nav-item dropdown {{ (strtolower($request->uri->getSegment(2)) == 'config') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Konfigurasi</span></span></a>
                    <ul class="dropdown-menu">
                        <li {{ (strtolower($request->uri->getSegment(3)) == 'periode') ? 'class="active"' : '' }}>
                            <a class="nav-link " href="/Admin/Config/Periode">Periode</a>
                        </li>
                        <li {{ (strtolower($request->uri->getSegment(3)) == 'sejarah') ? 'class="active"' : '' }}>
                            <a class="nav-link " href="/Admin/Config/Sejarah">Sejarah</a>
                        </li>
                        <li {{ (strtolower($request->uri->getSegment(3)) == 'visi') ? 'class="active"' : '' }}>
                            <a class="nav-link" href="/Admin/Config/Visi">Visi</a>
                        </li>
                        <li {{ (strtolower($request->uri->getSegment(3)) == 'misi') ? 'class="active"' : '' }}>
                            <a class="nav-link" href="/Admin/Config/Misi">Misi</a>
                        </li>
                        <li {{ (strtolower($request->uri->getSegment(3)) == 'service') ? 'class="active"' : '' }}>
                            <a class="nav-link" href="/Admin/Config/Service">Service</a>
                        </li>
                        <li {{ (strtolower($request->uri->getSegment(3)) == 'sosial') ? 'class="active"' : '' }}>
                            <a class="nav-link" href="/Admin/Config/Sosial">Media Sosial</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Database Config</li>
                <li class="nav-item dropdown {{ (strtolower($request->uri->getSegment(2)) == 'truncate') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-skull-crossbones"></i> <span>Truncate</span></span></a>
                    <ul class="dropdown-menu">
                        <li {{ (strtolower($request->uri->getSegment(2)) == 'truncate') ? 'class="active"' : '' }}>
                            <a class="nav-link" href="/Admin/truncate">Danger Zone</a>
                        </li> --}}
        </ul>

        <div class="my-4 px-5 py-3 hide-sidebar-mini">
            <a href="{{ route('home') }}" class="form-control btn btn-icon icon-left btn-primary to-web">
                <i class="fas fa-rocket"></i> To Website
            </a>
        </div>
    </aside>
</div>