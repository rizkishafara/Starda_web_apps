<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dokumen User</h1>
    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Tabel Data Dokumen User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama User</th>
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
                            <th>Nama User</th>
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
                                <td><?= $doc->fullname ?></td>
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
                                <td>
                                    <!-- <a class="btn btn-warning" href="<?= base_url('profile/download_document/' . $id) ?>">Preview</a> -->
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#detailDocument/<?= $id ?>">Preview</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteDocument/<?= $id ?>">Hapus</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Document -->
<?php
foreach ($document as $doc) {
    $id_doc = $doc->id_document;
?>
    <div class="modal fade" id="detailDocument/<?= $id_doc ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <input class="form-control bg-white" type="text" value="<?= $doc->title_document ?>" disabled>
                        </div>
                        <div class="col">
                            <label for="fname">Kategori:</label>
                            <input class="form-control bg-white" type="text" value="<?= $doc->kategori_file ?>" disabled>
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
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/document/delete_document/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>