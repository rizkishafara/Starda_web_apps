<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href=<?= base_url('')?>>
                <div class="sidebar-brand-text mx-3">STARDA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('admin/dashboard')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Akun
            </div>

            <!-- Nav Item - Akun -->
            
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/Useradmin')?>">
                    <i class="fas fa-user-cog"></i>
                    <span>Admin</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/Usermember')?>">
                    <i class="fas fa-user"></i>
                    <span>Member</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/Usernonactive')?>">
                    <i class="fas fa-user-plus"></i>
                    <span>Pengajuan Akun</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Stakeholder
            </div>

            <!-- Nav Item - Stakeholder -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/Userdata')?>">
                    <i class="fas fa-users"></i>
                    <span>User Data</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Files</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('admin/media')?>">Produk</a>
                        <a class="collapse-item" href="<?= base_url('admin/media/mediapending')?>">Pertinjauan Produk</a>
                        <a class="collapse-item" href="<?= base_url('admin/media/mediatolak')?>">Produk Ditolak</a>
                    </div>
                </div>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
                Lain -lain
            </div>

            <!-- Nav Item - Stakeholder -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kategori')?>">
                    <i class="fas fa-list-alt"></i>
                    <span>Kategori User</span></a>
            </li>
            <!-- Nav Item - Stakeholder -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/keahlian')?>">
                    <i class="fas fa-list-alt"></i>
                    <span>Keahlian User</span></a>
            </li>
            <!-- Nav Item - Stakeholder -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kegiatan')?>">
                    <i class="fas fa-list-alt"></i>
                    <span>Kegiatan User</span></a>
            </li> -->
            <!-- Nav Item - Stakeholder -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kategorifile')?>">
                    <i class="fas fa-list-alt"></i>
                    <span>Kategori File</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kategorifile')?>">
                    <i class="fas fa-file-alt"></i>
                    <span>Kategori File</span></a>
            </li> -->

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->