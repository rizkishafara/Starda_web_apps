<body>
    <div id="data_detail" class="container my-3  py-4 ">

        <a class="back-link" href="<?= base_url('stakeholder') ?>">
            <h6 ><i class="fas fa-arrow-left "></i> Kembali</h6>
        </a>
        <div class="detail row my-auto px-3 py-3">
            <img id="profile_image" class=" photo_user" src="<?= base_url('storage/profile_user/' . $stakeholder_data->photo_user) ?>" alt="">
            <div class="col biodata">
                <table>
                    <tr class="txtbio">
                        <td> Nama</td>
                        <td>:</td>
                        <td><?= $stakeholder_data->fullname ?></td>
                    </tr>
                    <tr class="txtbio">
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            <?php if (!$this->session->userdata('id_user')) {
                                $address = $stakeholder_data->address_user;
                                if ($address != '') {
                                    $count = strlen($address) - 4;
                                    $output = substr_replace($address, str_repeat('*', $count), 4, $count);
                                    echo $output;
                                }
                            } else {
                                echo $stakeholder_data->address_user;
                            } ?>
                        </td>
                    </tr>
                    <tr class="txtbio">
                        <td>Email</td>
                        <td>:</td>
                        <td>
                            <?php if (!$this->session->userdata('id_user')) {
                                $email = $stakeholder_data->email;
                                $count = strlen($email) - 7;
                                $output = substr_replace($email, str_repeat('*', $count), 4, $count);
                                echo $output;
                            } else {
                                echo $stakeholder_data->email;
                            } ?>

                        </td>
                    </tr>
                    <tr class="txtbio">
                        <td>No HP</td>
                        <td>:</td>
                        <td>
                            <?php if (!$this->session->userdata('id_user')) {
                                $phone = $stakeholder_data->phone_user;
                                $count = strlen($phone) - 5;
                                $output = substr_replace($phone, str_repeat('*', $count), 3, $count);
                                echo $output;
                            } else {
                                echo $stakeholder_data->phone_user;
                            } ?>
                        </td>
                    </tr>
                    <tr class="txtbio">
                        <td> Instansi</td>
                        <td>:</td>
                        <td><?= $stakeholder_data->instansi ?></td>
                    </tr>
                </table>
            </div>
            <div class="text-center col col-lg-2">
                <h3 class="fas fa-<?= $stakeholder_data->gender ?> "></h3>
                <br>
                <span class="text-primary"><?= $stakeholder_data->keahlian_user ?></span>
            </div>
        </div>
        <div class="row">
            <a href=<?= base_url('stakeholder/detailData/' . $stakeholder_data->id_user . '#About') ?>>About</a>
            <a class="mx-2 text-primary">|</a>
            <a href="<?= base_url('stakeholder/detailData/' . $stakeholder_data->id_user . '#Kegiatan') ?>">Kegiatan</a>
            <a class="mx-2 text-primary">|</a>
            <a href="<?= base_url('stakeholder/detailData/' . $stakeholder_data->id_user . '#Gallery') ?>">Gallery</a>
        </div>
        <div style="margin-top: 20px;" id="About">
            <h5>About</h5>
            <p class="font-italic"><?= $stakeholder_data->about ?></p>
        </div>
        <div style="margin-top: 20px;" id="Kegiatan">
            <h5>Riwayat Kegiatan</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Tanggal Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($kegiatan as $kgtn) {
                    ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $kgtn->kegiatan ?></td>
                            <td><?= $kgtn->tanggal_kegiatan ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (empty($kegiatan)){ echo "<div class='text-center font-italic'><span class='' disabled>Belum ada Kegiatan yang ditambahkan</span></div>";}?>
        </div>
        <div class="row row-item galery" id="Gallery">
            <div class="col">
                <h5 class="mb-3 mt-3">Galeri</h5>
                <div class="container grid container-galery">
                    <?php foreach ($gallery as $g) { ?>
                        <a href="<?= base_url('stakeholder/detail_produk/' . $g->id_produk) ?>">
                            <div class="item align-left text-center mb-4 " data-toggle="modal" data-target="modalMedia/<?= $g->id_produk ?>">
                                <?php
                                if ($g->id_cat_file == '1') {
                                    echo "<i class='fas fa-file-video' style='font-size: 130px; color:purple;'></i>";
                                } else if ($g->id_cat_file == '2') {
                                    echo "<i class='fas fa-file-image' style='font-size: 130px;color:lightblue;'></i>";
                                }
                                ?>
                                <div class="text-truncate mx-auto" style="max-width: 120px;">
                                    <div class="">
                                        <h6 class=""><?= $g->title_produk ?></h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php if ($this->session->userdata('id_user')) { ?>
            <!-- <div class="row row-item galery" id="Document">
                <div class="col">
                    <h5 class="mb-3 mt-3">Dokumen</h5>
                    <div class="container grid container-galery">
                        <?php foreach ($document as $doc) { ?>
                            <div class="item align-left text-center mb-4" data-toggle="modal" data-target="#modalDocument/<?= $doc->id_document ?>">
                                <?php
                                if ($doc->id_cat_file == '3') {
                                    echo "<i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>";
                                } else if ($doc->id_cat_file == '4') {
                                    echo "<i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>";
                                } else if ($doc->id_cat_file == '5') {
                                    echo "<i class='fas fa-file-pdf' style='font-size: 130px;color:red;'></i>";
                                }
                                ?>
                                <div class="text-truncate mx-auto" style="max-width: 120px;">
                                    <div class="">
                                        <h6><?= $doc->title_document ?></h6>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div> -->
        <?php } ?>
    </div>
    <!-- Modal Popup Profile -->
    <div id="profile_modal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>


    <!-- Modal produk -->
    <?php
    foreach ($gallery as $g) {
        $id_produk = $g->id_produk;
    ?>
        <div class="modal fade" id="modalMedia/<?= $g->id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <div class="modal-body">
                        <span><?php
                                $totalunduh = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $id_produk]);
                                echo $totalunduh->num_rows();
                                ?> Unduhan</span>
                    </div>
                    <div class="modal-body mx-auto">
                        <?php if ($g->id_cat_file == '1') {
                            echo "<video controls>
                                <source src=" . base_url('storage/media_user/' . $g->name_produk) . ">
                            </video>";
                        } else if ($g->id_cat_file == '2') {
                            echo "<img class='' style='width:412px;height:auto;' src=" . base_url('storage/media_user/' . $g->name_produk) . " >";
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

    <!-- Modal Document
    <?php
    // foreach ($document as $doc) {
    //     $id_doc = $doc->id_document;
    ?>
        <div class="modal fade" id="modalDocument/<?= $doc->id_document ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <div class="row">
                        <a class="col btn btn-success m-3" href="<?= base_url('profile/download_document/' . $id_doc) ?>">Download</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    // }
    ?> -->

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
</body>