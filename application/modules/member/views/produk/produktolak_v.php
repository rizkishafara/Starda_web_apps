<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Produk Ditolak</h1>
    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Tabel Data Produk User</h6>
            <button class="btn btn-success ml-auto" data-toggle="modal" data-target="#tambahProduk">Tambah</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Judul Produk</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Unduhan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Judul Produk</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Unduhan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk as $doc) {
                            $id = $doc->id_produk;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $doc->title_produk ?></td>
                                <td> <?php
                                        if ($doc->id_cat_file == '1') {
                                            echo "<i class='fas fa-file-video' style='font-size: 75px; color:purple;'></i>";
                                        } else if ($doc->id_cat_file == '2') {
                                            echo "<i class='fas fa-file-image' style='font-size: 75px;color:lightblue;'></i>";
                                        }
                                        ?></td>
                                <td><?= $doc->status ?></td>
                                <td><?php
                                    $date = $doc->upload_date;
                                    $newdate = date("d-m-Y", strtotime($date));
                                    echo $newdate;
                                    ?>
                                </td>
                                <td><?php
                                    $totalunduh = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $id]);
                                    echo $totalunduh->num_rows();
                                    ?> Unduhan</td>
                                <?php if ($doc->status == 'Ditolak') { ?>
                                    <td>
                                        <a class="btn btn-warning" href="<?= base_url('member/produk/detail_produk/' . $id) ?>">Detail</a>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#alasanProduk/<?= $id ?>">Alasan</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProduk/<?= $id ?>">Hapus</button>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <a class="btn btn-warning" href="<?= base_url('member/produk/detail_produk/' . $id) ?>">Detail</a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProduk/<?= $id ?>">Hapus</button>
                                    </td>
                                <?php } ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Produk -->
<?php
foreach ($produk as $g) {
    $id_produk = $g->id_produk;
?>
    <div class="modal fade" id="detailProduk/<?= $id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <?= $g->title_produk ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php
                                        $totalunduh = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $id_produk]);
                                        echo $totalunduh->num_rows();
                                        ?> Unduhan</div>
                <div class="modal-body mx-auto">
                    <?php if ($g->id_cat_file == '1') {
                        echo "<video controls style='width:412px ;height:auto;'>
                                <source src=" . base_url('storage/  _user/' . $g->name_produk) . ">
                            </video>";
                    } else if ($g->id_cat_file == '2') {
                        echo "<img class='' style='width:312px ;height:auto;' src=" . base_url('storage/media_user/' . $g->name_produk) . " >";
                    } ?>

                </div>
                <div class="mx-3">
                    <div class="row">
                        <div class="col">
                            <label for="fname">Judul:</label>
                            <input class="form-control bg-white" type="text" value="<?= $g->title_produk ?>" disabled>
                        </div>
                        <div class="col">
                            <label for="fname">Kategori:</label>
                            <input class="form-control bg-white" type="text" value="<?= $g->kategori_file ?>" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="deskripsi">Deskripsi :</label>
                            <textarea class="form-control font-italic bg-white" id="inputAbout" name="about" rows="3" disabled>"<?= $g->desc_produk; ?>"</textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <a class="col btn btn-success m-3" href="<?= base_url('profile/download_image/' . $id_produk) ?>">Download</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal tambah produk-->
<?php $id_user = $this->session->userdata('id_user') ?>
<div class="modal fade" id="tambahProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action=<?= base_url('member/produk/add_produk/' . $id_user) ?> method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="title">Judul</label>
                    <div class="form-label-group mb-3">
                        <input type="text" id="inputTitle" accept="file_extension" autocomplete="off" name="title_produk" class="form-control" placeholder="Judul Produk" required autofocus>
                    </div>
                    <?= form_error('title_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                    <label for="desc">Deskripsi</label>
                    <div class="form-label-group mb-3">
                        <textarea class="form-control" id="inputDesc" name="desc_produk" rows="3"></textarea>
                    </div>
                    <label for="produk">Produk</label>
                    <div class="mb-3">
                        <input type="file" name="produk" id="produk" multiple="true" class="form-control form-control-lg mb-2" required accept=".jpg,.png,.jpeg,.mp4,.mkv,.mpeg">
                        <span style="color: red;">*Max size : 100 MB</span>
                    </div>
                    <label for="kategori">Kategori</label>
                    <div class="form-label-group mb-3">
                        <select name="kategori_file" class="custom-select" required>
                            <option value="" selected disabled>
                                <--Pilih salah satu-->
                            </option>

                            <?php foreach ($kategori as $kat) { ?>
                                <option value="<?= $kat['id_kategori_file']; ?>"><?= $kat['kategori_file']; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="row ">
                        <div class="col p-0 mr-2">
                            <label for="kegiatan">Kegiatan Terkait</label>
                            <div class="mb-3">
                                <input type="text" id="kegiatan" accept="file_extension" autocomplete="off" name="kegiatan" class="form-control" placeholder="Kegiatan" required>
                            </div>
                        </div>
                        <div class="col p-0 ml-2">
                            <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                            <div class="mb-3">
                                <input name="tgl_kegiatan" type="date" id="example" class="form-control" placeholder="Tanggal" required>
                            </div>
                        </div>
                    </div>
                    <label for="doc_produk">Dokumen Pelengkap</label>
                    <div class="mb-3">
                        <div class="row mb-2">
                            <input type="file" name="doc_produk[]" id="doc_produk1" class="col form-control mr-2" required accept=".doc,.docx,.pdf,.csv,.xls,.xlsx">
                            <input type="file" name="doc_produk[]" id="doc_produk2" class="col form-control mr-2" accept=".doc,.docx,.pdf,.csv,.xls,.xlsx">
                            <input type="file" name="doc_produk[]" id="doc_produk3" class="col form-control " accept=".doc,.docx,.pdf,.csv,.xls,.xlsx">
                        </div>
                        <small>*Minimal unggah 1 dokumen</small>
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

<!-- Modal edit produk-->
<?php foreach ($produk as $doc) {
    $id = $doc->id_produk; ?>
    <div class="modal fade" id="editProduk/<?= $doc->id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=<?= base_url('member/produk/edit_produk/' . $id) ?> method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="title">Judul</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputTitle" accept="file_extension" autocomplete="off" value="<?= $doc->title_produk ?>" name="title_produk" class="form-control" placeholder="Judul Document" required autofocus>
                        </div>
                        <?= form_error('title_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                        <label for="desc">Deskripsi</label>
                        <div class="form-label-group mb-3">
                            <textarea class="form-control" id="inputDesc" name="desc_produk" rows="3"><?= $doc->desc_produk ?></textarea>
                        </div>

                        <span>current file : <?= $doc->name_produk ?></span>
                        <div class="mb-3">
                            <input type="hidden" value="<?= $doc->name_produk ?>" name="name_produk1" id="name_produk1">
                            <input type="file" name="name_produk" id="name_produk" multiple="true" class="form-control form-control-lg mb-2">
                            <span style="color: red;">*Max size : 100 MB</span>
                        </div>
                        <?= form_error('name_produk', '<small class="text-danger pl-3">', '</small>'); ?>
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

<!-- Modal delete -->
<?php foreach ($produk as $doc) {
    $id = $doc->id_produk; ?>
    <div class="modal fade" id="deleteProduk/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus produk <?= $doc->title_produk ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('member/produk/delete_produk/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Alasan -->
<?php foreach ($produk as $med) {
    $id = $med->id_produk; ?>
    <div class="modal fade" id="alasanProduk/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <textarea class="form-control bg-white" id="inputAlasan" name="alasan" rows="3" disabled><?= $med->alasan ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>