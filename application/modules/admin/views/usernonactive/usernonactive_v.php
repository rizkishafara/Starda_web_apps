<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Akun Non Aktif</h1>

    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">List Pengajuan Akun Member</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Instansi</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Instansi</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($usernonactive as $usernon) {
                            $id = $usernon->id_user;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $usernon->fullname ?></td>
                                <td><?= $usernon->email ?></td>
                                <td><?= $usernon->phone_user ?></td>
                                <td><?= $usernon->instansi ?></td>
                                <td><?= $usernon->category_user ?></td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#acceptAccount/<?= $id ?>">Verifikasi</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAccount/<?= $id ?>">Hapus</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal delete -->
<?php foreach ($usernonactive as $usernon) {
    $id = $usernon->id_user; ?>
    <div class="modal fade " id="deleteAccount/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus pengajuan akun <?= $usernon->fullname ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/usernonactive/delete_akun/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal verfikasi -->
<?php foreach ($usernonactive as $usernon) {
    $id = $usernon->id_user; ?>
    <div class="modal fade " id="acceptAccount/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk mengaktifkan pengajuan akun <?= $usernon->fullname ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-primary" href="<?= base_url('admin/Usernonactive/activation/' . $id) ?>">Verifikasi</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>