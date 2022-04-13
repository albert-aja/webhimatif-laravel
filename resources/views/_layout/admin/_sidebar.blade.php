<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin-dashboard') }}">{{ $tahun_kepengurusan->year }}</a>
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
                <li class="nav-item dropdown {{ (request()->routeIs('post-*') || request()->routeIs('article-*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i> <span>Berita</span></a>
                    <ul class="dropdown-menu">
                        <li {{ (request()->routeIs('post-*')) ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('post-data') }}">Berita</a>
                        </li>
                        <li {{ (request()->routeIs('article-photos')) ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('article-photos') }}">Foto Artikel</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Divisi</li>
                <li class="nav-item dropdown {{ (request()->routeIs('division-*') || request()->routeIs('commitee-*') || request()->routeIs('position-*') || request()->routeIs('program-*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Divisi</span></a>
                    <ul class="dropdown-menu">
                        <li {{ (request()->routeIs('division-*') || request()->routeIs('commitee-*') || request()->routeIs('program-*')) ? 'class=active' : '' }}>
                            <a class="nav-link " href="{{ route('division-data') }}">Divisi</a>
                        </li>
                        <li {{ (request()->routeIs('position-*')) ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('position-data') }}">Jabatan</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Himatif Shop</li>
                <li class="nav-item dropdown {{ (request()->routeIs('shop-*') || request()->routeIs('category-*') || request()->routeIs('color-*') || request()->routeIs('contact-*')) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-bag"></i> <span>Himatif Shop</span></a>
                        <ul class="dropdown-menu">
                            <li {{ (request()->routeIs('shop-*')) ? 'class=active' : '' }}>
                                <a href="{{ route('shop-data') }}" class="nav-link"><span> Produk</span></a>
                            </li>
                            <li {{ (request()->routeIs('category-*')) ? 'class=active' : '' }}>
                                <a href="{{ route('category-data') }}" class="nav-link"><span>Kategori</span></a>
                            </li>
                            <li {{ (request()->routeIs('color-*')) ? 'class=active' : '' }}>
                                <a href="{{ route('color-data') }}" class="nav-link"><span>Warna</span></a>
                            </li>
                            <li {{ (request()->routeIs('contact-*')) ? 'class=active' : '' }}>
                                <a href="{{ route('contact-data') }}" class="nav-link"><span>Kontak</span></a>
                            </li>
                        </ul>
                    </li>

            <li class="menu-header">Web Config</li>
                <li class="nav-item dropdown {{ request()->routeIs('config-*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Konfigurasi</span></span></a>
                    <ul class="dropdown-menu">
                        <li {{ request()->routeIs('config-year') ? 'class=active' : '' }}>
                            <a class="nav-link " href="{{ route('config-year') }}">Periode</a>
                        </li>
                        <li {{ request()->routeIs('config-history') ? 'class=active' : '' }}>
                            <a class="nav-link " href="{{ route('config-history') }}">Sejarah</a>
                        </li>
                        <li {{ request()->routeIs('config-vision') ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('config-vision') }}">Visi</a>
                        </li>
                        <li {{ request()->routeIs('config-mission') ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('config-mission') }}">Misi</a>
                        </li>
                        <li {{ request()->routeIs('config-service') ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('config-service') }}">Service</a>
                        </li>
                        <li {{ request()->routeIs('config-socialmedia') == 'sosial' ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('config-socialmedia') }}">Media Sosial</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Database Config</li>
                <li class="nav-item dropdown {{ request()->routeIs('database-*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-skull-crossbones"></i> <span>Truncate</span></span></a>
                    <ul class="dropdown-menu">
                        <li {{ request()->routeIs('database-data') ? 'class=active' : '' }}>
                            <a class="nav-link" href="{{ route('database-data') }}">Danger Zone</a>
                        </li>
        </ul>

        <div class="my-4 px-5 py-3 hide-sidebar-mini">
            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="form-control btn btn-icon icon-left btn-primary to-web">
                <i class="fas fa-rocket"></i> To Website
            </a>
        </div>
    </aside>
</div>