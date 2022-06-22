<div id="data_detail" class="container my-3  py-4 ">
    <h6 class="back-link " onclick="window.history.back()"><i class="fas fa-arrow-left "></i> Kembali</h6>
    <div class="detail row my-auto px-3 py-3">
        <img id="profile_image" class=" photo_user" src="<?= base_url('storage/profile_user/' . $userdata->photo_user) ?>" alt="">
        <div class="col biodata">
            <table>
                <tr class="txtbio">
                    <td> Nama</td>
                    <td>:</td>
                    <td><?= $userdata->fullname ?></td>
                </tr>
                <tr class="txtbio">
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $userdata->address_user ?></td>
                </tr>
                <tr class="txtbio">
                    <td>Email</td>
                    <td>:</td>
                    <td><?= $userdata->email ?></td>
                </tr>
                <tr class="txtbio">
                    <td>No HP</td>
                    <td>:</td>
                    <td>+<?= $userdata->phone_user ?></td>
                </tr>
                <tr class="txtbio">
                    <td>Instansi</td>
                    <td>:</td>
                    <td><?= $userdata->instansi ?></td>
                </tr>

            </table>
        </div>
        <div class="text-center col col-sm-2">
            <h3 class="fas fa-<?= $userdata->gender ?> "></h3>
            <br>
            <a class="font-italic"><?= $userdata->keahlian_user ?></a>
            <br>
            <a class="btn btn-success m-1" href=<?= base_url('admin/userdata/export_excel/' . $userdata->id_user) ?>><i class="fas fa-file-excel"></i></a>
        </div>
    </div>
    <div class="row">
        <a href="#about">About</a>
        <a class="mx-2 text-primary">|</a>
        <a href="#kegiatan">Kegiatan</a>
        <a class="mx-2 text-primary">|</a>
        <a href="#media">Gallery</a>
    </div>
    <div style="margin-top: 20px;" id="about">
        <h5>About</h5>
        <p class="font-italic">"<?= $userdata->about ?>"</p>
    </div>
    <div style="margin-top: 20px;" id="kegiatan">
        <h5>Riwayat Kegiatan</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kegiatan</th>
                    <th scope="col">Tanggal Kegiatan</th>
                    <!-- <th scope="col">Aksi</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($kegiatan as $kgtn) {
                    // $idkegiatan = $kgtn->id_user_kegiatan;
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $kgtn->kegiatan ?></td>
                        <td><?= $kgtn->tanggal_kegiatan ?></td>
                        <!-- <td>

                            <button class="btn btn-warning" data-toggle="modal" data-target="#editKegiatan/<?= $idkegiatan ?>">Edit</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteKegiatan/<?= $idkegiatan ?>">Hapus</button>
                        </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if (empty($kegiatan)){ echo "<div class='text-center font-italic'><span class='' disabled>Belum ada Kegiatan yang ditambahkan</span></div>";}?>
    </div>
    <div class="text-right">
        <!-- <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#tambahKegiatan">Tambah Kegiatan</button> -->
    </div>
    <div class="row row-item galery" id="media">
        <div class="col">
            <h5 class="mb-3 mt-3">Galeri</h5>
            <div class="container grid container-galery">
                <?php foreach ($galery as $g) { ?>
                    <a href="<?= base_url('admin/media/detail_produk/' . $g->id_produk) ?>">

                        <div class="item align-left text-center mb-4 ">
                            <?php
                            if ($g->id_cat_file == '1') {
                                echo "<i class='fas fa-file-video' style='font-size: 130px; color:purple;'></i>";
                            } else if ($g->id_cat_file == '2') {
                                echo "<i class='fas fa-file-image' style='font-size: 130px;color:lightblue;'></i>";
                            }
                            ?>
                            <div class="text-truncate mx-auto" style="max-width: 120px;">
                                <div class="text-">
                                    <h6 class=""><?= $g->title_produk ?></h6>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>


</div>
<!-- Modal Popup Profile -->
<div id="profile_modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<!-- Modal Tambah Kegiatan -->
<div class="modal" id="tambahKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/userdata/tambah_kegiatan_user/' . $userdata->id_user) ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="kegiatan">Nama Kegiatan</label>
                    <div class="form-label-group mb-3">
                        <select name="kegiatan" class="custom-select" required>
                            <option value="" selected disabled>
                                <--Pilih salah satu-->
                            </option>

                            <?php foreach ($listkegiatan as $list) { ?>
                                <option value="<?= $list['id_kegiatan']; ?>"><?= $list['kegiatan']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label for="tanggal_mulai">Tanggal Mulai Kegiatan</label>
                    <input name="tanggal_mulai" type="date" id="example" class="form-control" required>
                    <label for="tanggal_selesai">Tanggal Selesai Kegiatan</label>
                    <input name="tanggal_selesai" type="date" id="example" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kegiatan -->
<!-- <?php 
// foreach ($kegiatan as $edit) {
    // $idedit = $edit->id_user_kegiatan ?>
    <div class="modal" id="editKegiatan/<?= $idedit ?>" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/userdata/ubah_kegiatan_user/' . $idedit) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="kegiatan">Nama Kegiatan</label>
                        <div class="form-label-group mb-3">
                            <select name="kegiatan" class="custom-select" required>
                                <option value="<?= $edit->id_kegiatan ?>" selected>
                                    <?= $edit->kegiatan ?>
                                </option>
                                <option value="" disabled>
                                    <--Pilih salah satu-->
                                <!-- </option>

                                <?php foreach ($listkegiatan as $list) { ?>
                                    <option value="<?= $list['id_kegiatan']; ?>"><?= $list['kegiatan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="tanggal_mulai">Tanggal Mulai Kegiatan</label>
                        <input name="tanggal_mulai" type="date" id="example" class="form-control" value="<?= $edit->waktu_mulai_kegiatan ?>" required>
                        <label for="tanggal_selesai">Tanggal Selesai Kegiatan</label>
                        <input name="tanggal_selesai" type="date" id="example" class="form-control" value="<?= $edit->waktu_selesai_kegiatan ?>" required>
                        <input type="text" name="id_user" value="<?= $userdata->id_user ?>" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Kegiatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --> -->
<?php 
// } ?>

<!-- Modal delete kegiatan-->
<!-- <?php 
// foreach ($kegiatan as $k) {
    // $id = $k->id_user_kegiatan; ?>
    <div class="modal fade" id="deleteKegiatan/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/userdata/hapus_kegiatan_user/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php
//  } ?> -->
<script>
    // Get the modal
    var modal = document.getElementById("profile_modal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("profile_image");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>