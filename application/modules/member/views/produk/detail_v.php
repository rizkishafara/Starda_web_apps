<?php foreach ($detail as $det) { ?>
    <div class="container-fluid">
        <div class="container-fluid bg-white shadow mb-4">
            <div class="p-5 text-center">
                <h6 class="back-link " onclick="window.history.back()"><i class="fas fa-arrow-left "></i> Kembali</h6>
                <?= $this->session->flashdata('pesan'); ?>
                <?php
                $query = "select * from user_produk where id_produk='" . $det['id_produk'] . "'";
                $hasil = $this->db->query($query)->row();
                // var_dump($hasil); 
                ?>
                <div>

                    <?php if ($det['id_cat_file'] == '1') {
                        echo "<video style='max-width:90% ;max-height:30rem;' controls><source src=" . base_url('storage/media_user/' . $det['name_produk']) . "></video>";
                    } else if ($det['id_cat_file'] == '2') {
                        echo "<img class='' style='max-width:90% ;max-height:30rem;' src=" . base_url('storage/media_user/' . $det['name_produk']) . " >";
                    } ?>
                    <div>
                        <h2 class="font-weight-bold text-left"><?= $det['title_produk'] ?></h2>
                    </div>
                    <div class="row mb-2">
                        <span class="col text-left pl-0">Diunggah oleh : <?= $det['fullname'] ?></span>
                        <span class="col text-right pr-0">Diunduh <?= $unduhan ?> kali</span>
                    </div>
                    <div class="row">
                        <a class="col btn btn-success mx-2" href="<?= base_url('profile/download_image/' . $det['id_produk']) ?>">Download</a>
                        <button class="col btn btn-warning mx-2" aria-expanded="false" data-toggle="modal" data-target="#editProduk/<?= $det['id_produk'] ?>">Edit</button>
                    </div>
                    <hr>

                    <div class=" text-left">
                        <span>Deskripsi :</span>
                        <div class="font-italic text-left rounded">"<?= $det['desc_produk'] ?>"</div>
                    </div>
                    <hr>
                    <?php if (!empty($det['kegiatan'])){?>
                    <div class=" text-left">
                        <span>Kegiatan Terkait :</span>
                        <span><?= $det['kegiatan'] ?></span>
                    </div>
                    <hr>
                    <?php }?>
                    <div class="text-left">
                        <span>Dokumen Pelengkap :</span>
                        <div class="row row-cols-3">
                            <?php foreach ($dokumen as $dok) { ?>
                                <?php if ($det['id_produk'] == $dok['produk_id']) { ?>
                                    <div class="col ">
                                        <div class="card p-2 text-center my-2" style="height: auto">
                                            <a data-toggle="modal" data-target="#exampleModalCenter/<?= $dok['name_document'] ?>">
                                                <?php
                                                if ($dok['id_cat_doc'] == '3') {
                                                    echo "<i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>";
                                                } else if ($dok['id_cat_doc'] == '4') {
                                                    echo "<i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>";
                                                } else if ($dok['id_cat_doc'] == '5') {
                                                    echo "<i class='fas fa-file-pdf' style='font-size: 130px;color:red;'></i>";
                                                }
                                                ?>
                                                <div class="card-body">
                                                    <p class="card-text"><?= substr($dok['name_document'], 5) ?></p>
                                                </div>
                                            </a>
                                            <div class="row">
                                                <button class="col btn btn-warning  mr-1" data-toggle="modal" data-target="#modalEditDokumen/<?= $dok['id_document'] ?>">Edit</button>
                                                <button class="col  btn btn-danger ml-1" data-toggle="modal" data-target="#modalDeleteDokumen/<?= $dok['id_document'] ?>">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    Data tidak ditemukan
                                <?php } ?>
                            <?php } ?>
                            <?php if ($jml_dokumen < '3') { ?>
                                <div class="border-dashed rounded p-2 my-2">
                                    <div class=" text-center d-flex" style="height:100%;justify-content:center;" data-toggle="modal" data-target="#modalAddDokumen">
                                        <div class="align-middle align-self-center ">
                                            <i class="fas fa-plus-circle"></i>
                                            <h5 class="pt-2">Tambahkan Dokumen</h5>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal -->
<?php foreach ($dokumen as $dok) { ?>
    <div class="modal fade" id="exampleModalCenter/<?= $dok['name_document'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal <?= substr($dok['name_document'], 5) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <?php $link = base_url('storage/doc_media_user/' . $dok['name_document']) ?>

                    <?php if ($dok['id_cat_doc'] == '3') { ?>
                        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?= $link ?>' width='100%' height='450' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> -->
                        <!-- <iframe class="word" src="https://docs.google.com/gview?url=<?php echo $link ?>&embedded=true" width='100%' height='450' frameborder="0"></iframe> -->
                        <!-- <a class="word" href="//docs.google.com/gview?url=<?php echo $link ?>&embedded=true">Open a Word document in Fancybox</a> -->
                        <!-- This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>. -->
                    <?php } else if ($dok['id_cat_doc'] == '4') { ?>
                        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?= $link ?>' width='100%' height='450' frameborder='0'> </iframe> -->
                        <!-- This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>. -->
                    <?php } else if ($dok['id_cat_doc'] == '5') { ?>
                        <!-- <object data="" type=""><embed class="text-center" src="<?= $link ?>" width="100%" height="450" type="application/pdf"></object> -->

                    <?php } ?>
                    <?php
                    if ($dok['id_cat_doc'] == '3') {
                        echo "<i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>";
                    } else if ($dok['id_cat_doc'] == '4') {
                        echo "<i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>";
                    } else if ($dok['id_cat_doc'] == '5') {
                        echo "<i class=' fas fa-file-pdf' style='font-size: 130px;color:red;'></i>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class=" btn btn-success m-3" href="<?= base_url('member/produk/download_document/' . $dok['id_document']) ?>">Download</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- modal edit produk -->
<?php foreach ($detail as $det) {
    $id = $det['id_produk']; ?>
    <div class="modal fade" id="editProduk/<?= $det['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <input type="text" id="inputTitle" accept="file_extension" autocomplete="off" value="<?= $det['title_produk'] ?>" name="title_produk" class="form-control" placeholder="Judul Document" required autofocus>
                        </div>
                        <?= form_error('title_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                        <label for="desc">Deskripsi</label>
                        <div class="form-label-group mb-3">
                            <textarea class="form-control" id="inputDesc" name="desc_produk" rows="3"><?= $det['desc_produk'] ?></textarea>
                        </div>

                        <span>current file : <?= $det['name_produk'] ?></span>
                        <div class="mb-3">
                            <input type="hidden" value="<?= $det['name_produk'] ?>" name="name_produk1" id="name_produk1">
                            <input type="file" name="name_produk" id="name_produk" multiple="true" class="form-control form-control-lg mb-2">
                            <span style="color: red;">*Max size : 100 MB</span>
                        </div>
                        <?= form_error('name_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                        <label for="kategori">Kategori</label>
                        <div class="form-label-group mb-3">
                            <select name="kategori_file" class="custom-select" required>
                                <option value=" <?= $det['id_kategori'] ?>" selected>
                                    <?= $det['kategori_file'] ?>
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

<!-- modal edit dokumen Pelengkap -->

<?php foreach ($dokumen as $dok) {
    $iddoc = $dok['id_document'];
?>
    <div class="modal fade" id="modalEditDokumen/<?= $iddoc ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit <?= substr($dok['name_document'], 5) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=<?= base_url('member/produk/edit_dokumen/' . $iddoc) ?> method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <span>current file : <?= substr($dok['name_document'], 5) ?></span>
                        <div class="mb-3">
                            <input type="hidden" value="<?= $dok['name_document'] ?>" name="old_doc" id="name_produk1">
                            <input type="file" name="name_dokumen" id="name_dokumen" multiple="true" class="form-control form-control-lg mb-2">
                            <span style="color: red;">*Max size : 10 MB</span>
                        </div>
                        <?= form_error('name_produk', '<small class="text-danger pl-3">', '</small>'); ?>

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

<!-- Modal Tambah Dokumen  -->
<div class="modal fade" id="modalAddDokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Dokumen Terkait</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action=<?= base_url('member/produk/add_dokumen/' . $det['id_produk']) ?> method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" name="name_dokumen" id="name_dokumen" multiple="true" class="form-control form-control-lg mb-2" required>
                        <span style="color: red;">*Max size : 10 MB</span>
                    </div>
                    <?= form_error('name_produk', '<small class="text-danger pl-3">', '</small>'); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal delete dokumen pelengkap -->
<?php foreach ($dokumen as $doc) {
    $id = $doc['id_document']; ?>
    <div class="modal fade" id="modalDeleteDokumen/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus dokumen <?= substr($doc['name_document'], 5)    ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('member/produk/delete_dokumen/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
