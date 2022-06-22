<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href=<?= base_url('') ?>>
                <div class="sidebar-brand-text mx-3">STARDA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('member') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('') ?>">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            <!-- Nav Item - Akun -->

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('member/biodata') ?>">
                    <i class="fas fa-user-cog"></i>
                    <span>Biodata</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                File
            </div>

            <!-- Nav Item - Stakeholder -->

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('member/produk') ?>">
                    <i class="fas fa-photo-video"></i>
                    <span>Galeri Karya</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('member/produk/produk_pending') ?>">
                    <i class="fas fa-photo-video"></i>
                    <span>Karya Ditinjau</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('member/produk/produk_tolak') ?>">
                    <i class="fas fa-photo-video"></i>
                    <span>Karya Ditolak</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->