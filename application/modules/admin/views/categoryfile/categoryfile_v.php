<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kategori File</h1>

    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Tabel Data Kategori File User</h6>
            <a class="btn btn-success ml-auto" href="" data-toggle="modal" data-target="#tambahCategoryfile">Tambah</a>
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
                        foreach ($categoryfile as $cat) {
                            $id = $cat->id_kategori_file;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $cat->kategori_file ?></td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editCategoryfile<?= $id ?>">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryfile/<?= $id ?>">Hapus</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal tambah category -->
<div class="modal fade" id="tambahCategoryfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="upload_image_form" action="<?= base_url('admin/kategorifile/add_categoryfile') ?>" enctype="multipart/form-data">
                    <label for="cat_file">Nama Kategori</label>
                    <div class="form-label-group mb-3">
                        <input  type="text" id="inputCategory" autocomplete="off" name="kategori_file" class="form-control" placeholder="input category" required autofocus>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="save" class="btn btn-primary mx-auto">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah category -->
<?php foreach ($categoryfile as $cat) {
    $id = $cat->id_kategori_file; ?>
    <div class="modal fade" id="editCategoryfile<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="<?= base_url('admin/kategorifile/edit_categoryfile/' . $id) ?>" enctype="multipart/form-data">
                        <label for="cat_file">Nama Kategori</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $cat->kategori_file ?>" type="text" id="inputCategory" autocomplete="off" name="kategori_file" class="form-control" placeholder="input cat_file" required autofocus>
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
<?php foreach ($categoryfile as $category) {
    $id = $category->id_kategori_file; ?>
    <div class="modal fade" id="deleteCategoryfile/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus kategori <?= $category->kategori_file ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/kategorifile/delete_categoryfile/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>