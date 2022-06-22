<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kegiatan Stakeholder</h1>

    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Tabel Data Kegiatan</h6>
            <a class="btn btn-success ml-auto" href="" data-toggle="modal" data-target="#tambahCategory">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kegiatan as $k) {
                            $id = $k->id_kegiatan;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $k->kegiatan ?></td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editCategory<?= $id ?>">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategory/<?= $id ?>">Hapus</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal tambah kegiatan -->
<div class="modal fade" id="tambahCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="upload_image_form" action="<?= base_url('admin/kegiatan/add_kegiatan') ?>" enctype="multipart/form-data">
                    <label for="kegiatan">Nama Kegiatan</label>
                    <div class="form-label-group mb-3">
                        <input value="<?php echo set_value('kegiatan'); ?>" type="text" id="inputCategory" autocomplete="off" name="kegiatan" class="form-control" placeholder="input kegiatan" required autofocus>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="save" class="btn btn-primary mx-auto">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah kegiatan -->
<?php foreach ($kegiatan as $k) {
    $id = $k->id_kegiatan; ?>
    <div class="modal fade" id="editCategory<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="<?= base_url('admin/kegiatan/edit_kegiatan/' . $id) ?>" enctype="multipart/form-data">
                        <label for="kegiatan">Nama Kegiatan</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $k->kegiatan ?>" type="text" id="inputCategory" autocomplete="off" name="kegiatan" class="form-control" placeholder="input kegiatan" required autofocus>
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

<!-- Modal delete kegiatan-->
<?php foreach ($kegiatan as $k) {
    $id = $k->id_kegiatan; ?>
    <div class="modal fade" id="deleteCategory/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus kegiatan <?= $k->kegiatan ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/kegiatan/delete_kegiatan/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>