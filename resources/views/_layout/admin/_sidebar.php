<?php
  $request = service('request');
?>

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url() ;?>/Admin/Dashboard"><?= $tahun_kepengurusan['tahun'] ;?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ;?>/Admin/Dashboard"><img src="<?= base_url() ;?>/assets/img/logo/black/black_100.png"></a>
        </div>
        
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
                <li class="nav-item <?= (strtolower($request->uri->getSegment(2)) == 'dashboard') ? 'current' : '' ;?>">
                    <a href="<?= base_url() ;?>/Admin/Dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>

            <li class="menu-header">Berita</li>
                <li class="nav-item dropdown <?= (strtolower($request->uri->getSegment(2)) == 'berita' || strtolower($request->uri->getSegment(2)) == 'tag') ? 'active' : '' ;?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i> <span>Berita</span></a>
                    <ul class="dropdown-menu">
                        <li <?= (strtolower($request->uri->getSegment(2)) == 'berita') ? 'class="active"' : '' ;?> >
                            <a class="nav-link " href="/Admin/Berita">Data</a>
                        </li>
                        <li <?= (strtolower($request->uri->getSegment(3)) == 'write') ? 'class="active"' : '' ;?>>
                            <a class="nav-link" href="/Admin/Berita/Write">Tulis</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Divisi</li>
                <li class="nav-item dropdown <?= (strtolower($request->uri->getSegment(2)) == 'divisi' || strtolower($request->uri->getSegment(2)) == 'pengurus' || strtolower($request->uri->getSegment(2)) == 'jabatan') ? 'active' : '' ;?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Divisi</span></a>
                    <ul class="dropdown-menu">
                        <li <?= (strtolower($request->uri->getSegment(2)) == 'divisi' || strtolower($request->uri->getSegment(2)) == 'pengurus') ? 'class="active"' : '' ;?> >
                            <a class="nav-link " href="/Admin/Divisi">Divisi</a>
                        </li>
                        <li <?= (strtolower($request->uri->getSegment(2)) == 'jabatan') ? 'class="active"' : '' ;?>>
                            <a class="nav-link" href="/Admin/Jabatan">Jabatan</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Himatif Shop</li>
                <li class="nav-item dropdown <?= (
                    strtolower($request->uri->getSegment(2)) == 'shop' ||
                    strtolower($request->uri->getSegment(2)) == 'kategori' ||
                    strtolower($request->uri->getSegment(2)) == 'warna' ||
                    strtolower($request->uri->getSegment(2)) == 'kontakum'
                    ) ? 'active' : '' ;?>">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-bag"></i> <span>Himatif Shop</span></a>
                        <ul class="dropdown-menu">
                            <li <?= (strtolower($request->uri->getSegment(2)) == 'shop') ? 'class="active"' : '' ;?>">
                                <a href="/Admin/Shop" class="nav-link"><span> Produk</span></a>
                            </li>
                            <li <?= (strtolower($request->uri->getSegment(3)) == 'kategori') ? 'class="active"' : '' ;?>">
                                <a href="/Admin/Shop/Kategori" class="nav-link"><span>Kategori</span></a>
                            </li>
                            <li <?= (strtolower($request->uri->getSegment(3)) == 'warna') ? 'class="active"' : '' ;?>">
                                <a href="/Admin/Shop/Warna" class="nav-link"><span>Warna</span></a>
                            </li>
                            <li <?= (strtolower($request->uri->getSegment(2)) == 'kontakum') ? 'class="active"' : '' ;?>">
                                <a href="/Admin/KontakUM" class="nav-link"><span>Kontak</span></a>
                            </li>
                        </ul>
                    </li>

            <li class="menu-header">Web Config</li>
                <li class="nav-item dropdown <?= (strtolower($request->uri->getSegment(2)) == 'config') ? 'active' : '' ;?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Konfigurasi</span></span></a>
                    <ul class="dropdown-menu">
                        <li <?= (strtolower($request->uri->getSegment(3)) == 'periode') ? 'class="active"' : '' ;?> >
                            <a class="nav-link " href="/Admin/Config/Periode">Periode</a>
                        </li>
                        <li <?= (strtolower($request->uri->getSegment(3)) == 'sejarah') ? 'class="active"' : '' ;?> >
                            <a class="nav-link " href="/Admin/Config/Sejarah">Sejarah</a>
                        </li>
                        <li <?= (strtolower($request->uri->getSegment(3)) == 'visi') ? 'class="active"' : '' ;?>>
                            <a class="nav-link" href="/Admin/Config/Visi">Visi</a>
                        </li>
                        <li <?= (strtolower($request->uri->getSegment(3)) == 'misi') ? 'class="active"' : '' ;?>>
                            <a class="nav-link" href="/Admin/Config/Misi">Misi</a>
                        </li>
                        <li <?= (strtolower($request->uri->getSegment(3)) == 'service') ? 'class="active"' : '' ;?>>
                            <a class="nav-link" href="/Admin/Config/Service">Service</a>
                        </li>
                        <li <?= (strtolower($request->uri->getSegment(3)) == 'sosial') ? 'class="active"' : '' ;?>>
                            <a class="nav-link" href="/Admin/Config/Sosial">Media Sosial</a>
                        </li>
                    </ul>
                </li>

            <li class="menu-header">Database Config</li>
                <li class="nav-item dropdown <?= (strtolower($request->uri->getSegment(2)) == 'truncate') ? 'active' : '' ;?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-skull-crossbones"></i> <span>Truncate</span></span></a>
                    <ul class="dropdown-menu">
                        <li <?= (strtolower($request->uri->getSegment(2)) == 'truncate') ? 'class="active"' : '' ;?> >
                            <a class="nav-link " href="/Admin/truncate">Danger Zone</a>
                        </li>
        </ul>

        <div class="my-4 px-5 py-3 hide-sidebar-mini">
            <a href="<?= base_url() ;?>" class="form-control btn btn-icon icon-left btn-primary to-web">
                <i class="fas fa-rocket"></i> To Website
            </a>
        </div>
    </aside>
</div>