<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xl mb-4">
            <a href="<?= base_url('member/produk') ?>">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Produk Publish</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $media ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-photo-video fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl  mb-4">
            <a href="<?= base_url('member/produk/produk_pending') ?>">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Produk Pending</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mediapending ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>

    <!-- Content Row -->
    <?php
    if ($user->address_user == '') {
        echo '<div class="alert alert-danger" role="alert">Alamat anda masih kosong
                <a class="float-right" href=' . base_url('member/biodata') . '><i class="fas fa-arrow-right text-gray-700"></i></a>
            </div>';
    }
    if ($user->id_category_user == '') {
        echo '<div class="alert alert-danger" role="alert">Kategori anda masih kosong<a class="float-right" href=' . base_url('member/biodata') . '><i class="fas fa-arrow-right text-gray-700"></i></a></div>';
    }
    if ($user->gender == '') {
        echo '<div class="alert alert-danger" role="alert">Gender anda masih kosong<a class="float-right" href=' . base_url('member/biodata') . '><i class="fas fa-arrow-right text-gray-700"></i></a></div>';
    }
    if ($user->instansi == '') {
        echo '<div class="alert alert-danger" role="alert">Instansi anda masih kosong<a class="float-right" href=' . base_url('member/biodata') . '><i class="fas fa-arrow-right text-gray-700"></i></a></div>';
    }
    ?>
    <div class="card text-dark mb-3 shadow" style="max-width: 100%;">
        <div class="card-header font-weight-bold">Tutorial Pengisian Data</div>
        <div class="card-body row">
            <div class="col col-8">
                <p class="card-text">1. Isikan Biodata lengkap anda pada menu Biodata yang dapat anda lihat pada sidebar menu</p>
                <p class="card-text">2. Setelah anda mengisikan Biodata anda, anda dapat mengunggah media pada menu gallery</p>
                <p class="card-text">3. Pada menu unggah media anda diwajibkan menyertakan dokumen pelengkap minimal 1 dokumen dan maksimal 3 dokumen pelengkap yg berkaitan dengan media yang anda unggah</p>
                <p class="card-text">4. Anda juga bisa melihat unggahan dari stakeholder lain pada menu Beranda</p>
            </div>
            <div class="col col-2 text-center">
                <img src="<?= base_url('assets/image/user_guide.jpg')?>" alt="" style="height: 15rem;weight:auto;" class="mx-auto">
            </div>
        </div>
    </div>



</div>