<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admin</h1>

    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Akun Admin</h6>
            <a class="btn btn-success ml-auto" href="" data-toggle="modal" data-target="#tambahAdmin">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($useradmin as $admin) {
                            $id = $admin->id_admin;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $admin->username_admin ?></td>
                                <td><?= $admin->password_admin ?></td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editAdmin/<?= $id ?>">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAdmin/<?= $id ?>">Hapus</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal tambah admin -->
<div class="modal fade" id="tambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="upload_image_form" action="<?= base_url('admin/useradmin/add_admin') ?>" enctype="multipart/form-data">
                    <label for="username">Username</label>
                    <div class="form-label-group mb-3">
                        <input value="<?php echo set_value('username'); ?>" type="text" id="inputUsername" autocomplete="off" name="username" class="form-control" placeholder="input username" required autofocus>
                    </div>
                    <label for="password">Password</label>
                    <div class="form-label-group mb-3">
                        <input value="<?php echo set_value('password'); ?>" placeholder="input password" type="password" id="inputPassword" autocomplete="off" name="password" class="form-control" required>
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="save" class="btn btn-primary mx-auto">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah admin -->
<?php foreach ($useradmin as $admin) {
    $id = $admin->id_admin; ?>
    <div class="modal fade" id="editAdmin/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="upload_image_form" action="<?= base_url('admin/useradmin/edit_admin/' . $id) ?>" enctype="multipart/form-data">
                        <label for="username">Username</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $admin->username_admin ?>" type="text" id="inputUsername" autocomplete="off" name="username" class="form-control" placeholder="input username" required autofocus>
                        </div>
                        <label for="password">Password</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $admin->password_admin ?>" placeholder="input password" type="password" id="inputPassword" autocomplete="off" name="oldpass" class="form-control" hidden>
                            <input value="<?= $admin->password_admin ?>" placeholder="input password" type="password" id="inputPassword" autocomplete="off" name="password" class="form-control" required>
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="save" class="btn btn-primary mx-auto">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal delete -->
<?php foreach ($useradmin as $admin) {
    $id = $admin->id_admin; ?>
    <div class="modal fade" id="deleteAdmin/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus data <?= $admin->username_admin ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/useradmin/delete_admin/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>