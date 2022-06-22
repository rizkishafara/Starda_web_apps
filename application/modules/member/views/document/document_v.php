<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dokumen User</h1>
    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Tabel Data Dokumen User</h6>
            <button class="btn btn-success ml-auto" data-toggle="modal" data-target="#tambahDocument">Tambah</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Judul Document</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Judul Document</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($document as $doc) {
                            $id = $doc->id_document;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $doc->title_document ?></td>
                                <td> <?php
                                        if ($doc->id_cat_file == '3') {
                                            echo "<i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>";
                                        } else if ($doc->id_cat_file == '4') {
                                            echo "<i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>";
                                        } else if ($doc->id_cat_file == '5') {
                                            echo "<i class='fas fa-file-pdf' style='font-size: 130px;color:red;'></i>";
                                        }
                                        ?></td>

                                <td><?= $doc->status ?></td>
                                <td><?php
                                    $date = $doc->upload_date;
                                    $newdate = date("d-m-Y", strtotime($date));
                                    echo $newdate;
                                    ?>
                                </td>
                                <?php if ($doc->status == 'Ditolak') { ?>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#detailDocument/<?= $id ?>">Preview</button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#alasanDocument/<?= $id ?>">Alasan</button>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#editDocument/<?= $id ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteDocument/<?= $id ?>">Hapus</button>
                                    </td>
                                <?php }else {?>
                                    <td>
                                        <!-- <a class="btn btn-warning" href="<?= base_url('profile/download_document/' . $id) ?>">Preview</a> -->
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#detailDocument/<?= $id ?>">Preview</button>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#editDocument/<?= $id ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteDocument/<?= $id ?>">Hapus</button>
                                    </td>
                                <?php }?>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Modal tambah document-->
<?php $id_user = $this->session->userdata('id_user') ?>
<div class="modal fade" id="tambahDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action=<?= base_url('member/document/add_document/' . $id_user) ?> method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="title">Judul</label>
                    <div class="form-label-group mb-3">
                        <input type="text" id="inputTitle" accept="file_extension" autocomplete="off" name="title_document" class="form-control" placeholder="Judul Document" required autofocus>
                    </div>
                    <?= form_error('title_document', '<small class="text-danger pl-3">', '</small>'); ?>
                    <label for="desc">Deskripsi</label>
                    <div class="form-label-group mb-3">
                        <textarea class="form-control" id="inputDesc" name="desc_document" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="document" id="media" multiple="true" class="form-control form-control-lg mb-2" required>
                        <span style="color: red;">*Max size : 10 MB</span>
                    </div>
                    <label for="kategori">Kategori</label>
                    <div class="form-label-group mb-3">
                        <select name="kategori_file" class="custom-select" required>
                            <option value="" selected>
                                <--Pilih salah satu-->
                            </option>

                            <?php foreach ($kategori as $kat) { ?>
                                <option value="<?= $kat['id_kategori_file']; ?>"><?= $kat['kategori_file']; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit document-->
<?php foreach ($document as $doc) { ?>
    <div class="modal fade" id="editDocument/<?= $doc->id_document ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=<?= base_url('member/document/edit_document/' . $doc->id_document) ?> method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="title">Judul</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputTitle" accept="file_extension" autocomplete="off" value="<?= $doc->title_document ?>" name="title_document" class="form-control" placeholder="Judul Document" required autofocus>
                        </div>
                        <?= form_error('title_media', '<small class="text-danger pl-3">', '</small>'); ?>
                        <label for="desc">Deskripsi</label>
                        <div class="form-label-group mb-3">
                            <textarea class="form-control" id="inputDesc" name="desc_document" rows="3"><?= $doc->desc_document ?></textarea>
                        </div>
                        <span>current file : <?= $doc->name_document ?></span>
                        <div class="mb-3">
                            <input type="hidden" value="<?= $doc->name_document ?>" name="name_document1" id="document">
                            <input type="file" name="name_document" id="document" multiple="true" class="form-control form-control-lg mb-2">
                            <span style="color: red;">*Max size : 10 MB</span>
                        </div>
                        <?= form_error('name_document', '<small class="text-danger pl-3">', '</small>'); ?>
                        <label for="kategori">Kategori</label>
                        <div class="form-label-group mb-3">
                            <select name="kategori_file" class="custom-select" required>
                                <option value=" <?= $doc->id_kategori ?>" selected>
                                    <?= $doc->kategori_file ?>
                                </option>

                                <?php foreach ($kategori as $kat) { ?>
                                    <option value="<?= $kat['id_kategori_file']; ?>"><?= $kat['kategori_file']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Document -->
<?php
foreach ($document as $doc) {
    $id_doc = $doc->id_document;
?>
    <div class="modal fade" id="detailDocument/<?= $doc->id_document ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <?= $doc->title_document ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-auto">
                    <?php if ($doc->id_cat_file == '3') {
                        echo "<i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>";
                    } else if ($doc->id_cat_file == '4') {
                        echo "<i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>";
                    } else if ($doc->id_cat_file == '5') {
                        echo "<i class='fas fa-file-pdf' style='font-size: 130px;color:red;'></i>";
                    } ?>

                </div>
                <div class="mx-3">
                    <div class="row">
                        <div class="col">
                            <label for="fname">Judul:</label>
                            <input class="form-control bg-white"  type="text" value="<?= $doc->title_document ?>" disabled>
                        </div>
                        <div class="col">
                            <label for="fname">Kategori:</label>
                            <input class="form-control bg-white"  type="text" value="<?= $doc->kategori_file ?>" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="deskripsi">Deskripsi :</label>
                            <textarea class="form-control font-italic bg-white" id="inputAbout" name="about" rows="3" disabled>"<?= $doc->desc_document; ?>"</textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <a class="col btn btn-success m-3" href="<?= base_url('profile/download_document/' . $id_doc) ?>">Download</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Media -->


<!-- Modal delete -->
<?php foreach ($document as $doc) {
    $id = $doc->id_document; ?>
    <div class="modal fade" id="deleteDocument/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus document <?= $doc->title_document ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('member/document/delete_document/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Alasan -->
<?php foreach ($document as $doc) {
    $id = $doc->id_document; ?>
    <div class="modal fade" id="alasanDocument/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ditolak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="tolak">Alasan</label>
                    <textarea class="form-control bg-white" id="inputAlasan" name="alasan" rows="3" disabled><?= $doc->alasan?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>