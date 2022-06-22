<body>

    <?php
    $id_user = $this->session->userdata('id_user');
    ?>
    <div id="data_detail" class="container my-3  py-4 ">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="row my-auto px-3 py-3 row-item">
            <div class="profile">
                <img id="" class="" src="<?= base_url('storage/profile_user/' . $profile->photo_user) ?>" alt="">
                <div class="overlay">
                    <a href="" class="icon" data-toggle="modal" data-target="#editPhoto">
                        <i class="icn fas fa-pencil-alt"></i>
                    </a>
                </div>
            </div>

            <div class="col biodata">
                <table>
                    <tr class="txtbio">
                        <td> Nama</td>
                        <td>:</td>
                        <td><?= $profile->fullname ?></td>
                    </tr>
                    <tr class="txtbio">
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $profile->address_user ?></td>
                    </tr>
                    <tr class="txtbio">
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $profile->email ?></td>
                    </tr>
                    <tr class="txtbio">
                        <td>No HP</td>
                        <td>:</td>
                        <td><?= $profile->phone_user ?></td>
                    </tr>
                </table>
            </div>
            <div class="text-center col col-lg-1">
                <h3 class="fas fa-<?= $profile->gender ?> "></h3>
                <a href=<?= base_url('stakeholder/kategori/'.$profile->id_category)?> class="font-italic"><?= $profile->category ?></a>
            </div>
        </div>
        <div class="row row-item">
            <button type="button" class="btn col" id="btn-edit" data-toggle="modal" data-target="#modalEdit">Edit Data</button>
        </div>
        <div class="row row-item">
            <a href=<?= base_url('stakeholder/detailData/' . $profile->id_user . '#About') ?>>About</a>
            <a class="mx-2 text-primary">|</a>
            <a href="<?= base_url('stakeholder/detailData/' . $profile->id_user . '#Galery') ?>">Galery</a>
            <a class="mx-2 text-primary">|</a>
            <a href="<?= base_url('stakeholder/detailData/' . $profile->id_user . '#Document') ?>">Document</a>
        </div>
        <div style="margin-top: 20px;" id="About">
            <h5>About</h5>
            <p class="font-italic"><?= $profile->about ?></p>
        </div>
        <div class="row row-item galery" id="Galery">
            <div class="col">
                <h5 class="mb-3 mt-3">Galeri</h5>
                <div class="container grid container-galery">
                    <?php foreach ($galery as $g) { ?>
                        <div class="item align-left text-center mb-4 " data-toggle="modal" data-target="#modalMedia<?= $g->id_media ?>">
                            <?php
                            if ($g->id_cat_file == '1') {
                                echo "<i class='fas fa-file-video' style='font-size: 130px; color:purple;'></i>";
                            } else if ($g->id_cat_file == '2') {
                                echo "<i class='fas fa-file-image' style='font-size: 130px;color:lightblue;'></i>";
                            }
                            ?>
                            <div class="text-truncate mx-auto" style="max-width: 120px;">
                                <div class="text-">
                                    <h6 class=""><?= $g->title_media ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="text-right mt-2">
            <button class="btn btn-success add-media" data-toggle="modal" data-target="#modalGalery">Add Media</button>
        </div>

        <div class="row row-item galery" id="Document">
            <div class="col">
                <h5 class="mb-3 mt-3">Dokumen</h5>
                <div class="container grid container-galery">
                    <?php foreach ($document as $doc) { ?>
                        <div class="item align-left mx-auto mb-4" data-toggle="modal" data-target="#modalDocument/<?= $doc->id_document ?>">
                            <?php
                            if ($doc->id_cat_file == '3') {
                                echo "<i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>";
                            } else if ($doc->id_cat_file == '4') {
                                echo "<i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>";
                            } else if ($doc->id_cat_file == '5') {
                                echo "<i class='fas fa-file-pdf' style='font-size: 130px;color:red;'></i>";
                            }
                            ?>
                            <div class=" text-truncate container" style="max-width: 120px;">
                                <div class="text-center">
                                    <h6><?= $doc->title_document ?></h6>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="text-right mt-2">
            <button class="btn btn-success add-document" data-toggle="modal" data-target="#modalDocument">Add Document</button>
        </div>
    </div>
    <!-- end of content -->


    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?= base_url('profile/edit_profile') ?>" method="post">
                        <label for="fullname">Nama Lengkap</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $profile->fullname ?>" type="text" id="inputFullname" autocomplete="off" name="fullname" class="form-control" placeholder="Nama Lengkap" required autofocus>
                        </div>
                        <label for="email">Email</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $profile->email ?>" type="text" id="inputEmail" autocomplete="off" name="email" class="form-control" placeholder="Email Aktif" required>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="address">Alamat</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $profile->address_user ?>" type="text" id="inputAddress" autocomplete="off" name="address_user" class="form-control" placeholder="Alamat Lengkap" required>
                            <?= form_error('address_user', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="phone">No Telphone / HP</label>
                        <div class="form-label-group mb-3">
                            <input value="<?= $profile->phone_user ?>" type="text" id="inputPhone" autocomplete="off" name="phone_user" class="form-control" placeholder="Phone" required>
                            <?= form_error('phone_user', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="category">Kategori</label>
                        <div class="form-label-group mb-3">
                            <select name="category" class="custom-select">
                                <option selected value="<?= $profile->id_category ?>"><?= $profile->category ?></option>
                                <?php foreach ($category as $kat) { ?>
                                    <option id="category" value="<?php echo $kat['id_category'] ?>">
                                        <?php echo $kat['category']; ?></option>
                                <?php } ?>

                            </select>
                            <?= form_error('category', '<small class="text-danger pl-3">', '</small>'); ?>

                        </div>
                        <label for="gender">Gender</label>
                        <div class="form-label-group mb-3">
                            <label>
                                <input type="radio" name="gender" value="male" <?php if ($profile->gender == 'male') echo 'checked' ?>>Pria
                            </label>
                            <label>
                                <input type="radio" name="gender" value="female" <?php if ($profile->gender == 'female') echo 'checked' ?>>Wanita
                            </label>
                            <label>
                                <input type="radio" name="gender" value="users" <?php if ($profile->gender == 'users') echo 'checked' ?>>Lainnya
                            </label>
                        </div>
                        <label for="about">Tentang</label>
                        <div class="form-label-group mb-3">
                            <textarea class="ckeditor" name="about" id="inputAbout" required><?= $profile->about ?></textarea>
                            <?= form_error('about', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <?= form_error('category', '<small class="text-danger pl-3">', '</small>'); ?>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" name="btn" value="Simpan Perubahan" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit photo -->
    <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="upload_image_form" action="<?= base_url('profile/edit_photo/' . $id_user) ?>" enctype="multipart/form-data">

                        <div class="d-grid text-center">
                            <img class="mb-3" id="ajaxImgUpload" alt="Preview Image" src="https://via.placeholder.com/300" />
                        </div>

                        <div class="mb-3">
                            <input type="hidden" value="<?= $profile->photo_user; ?>" name="photo_user1" id="photo_user1">
                            <input type="file" name="photo_user" accept="image/png, image/jpeg, image/jpg, image/gif" multiple="true" id="" onchange="onFileUpload(this);" class="form-control form-control-lg">
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="save" class="btn button-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah Galery -->
    <div class="modal fade" id="modalGalery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Media Foto/Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('profile/add_media/' . $id_user) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="title">Judul</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputTitle" autocomplete="off" name="title_media" class="form-control" placeholder="Judul Foto/Video" required autofocus>
                        </div>
                        <?= form_error('title_media', '<small class="text-danger pl-3">', '</small>'); ?>

                        <div class="mb-3">
                            <input type="file" name="media" id="media" accept="image/png, image/jpeg, image/jpg, image/gif, video/mp4, video/mkv" multiple="true" class="form-control form-control-lg">
                        </div>
                        <div class="text-right" disabled>max media 100mb</div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal tambah Document -->
    <div class="modal fade" id="modalDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('profile/add_document/' . $id_user) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="title">Judul</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputTitle" accept="file_extension" autocomplete="off" name="title_document" class="form-control" placeholder="Judul Document" required autofocus>
                        </div>
                        <?= form_error('title_media', '<small class="text-danger pl-3">', '</small>'); ?>

                        <div class="mb-3">
                            <input type="file" name="document" id="media" multiple="true" class="form-control form-control-lg">
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

    <!-- Modal Media -->
    <?php
    foreach ($galery as $g) {
        $id_media = $g->id_media;
    ?>
        <div class="modal fade" id="modalMedia/<?= $g->id_media ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?= $g->title_media ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">
                        <?php if ($g->id_cat_file == '1') {
                            echo "<video controls>
                                <source src=" . base_url('storage/media_user/' . $g->name_media) . ">
                            </video>";
                        } else if ($g->id_cat_file == '2') {
                            echo "<img class='' style='width:512;height:auto;' src=" . base_url('storage/media_user/' . $g->name_media) . " >";
                        } ?>

                    </div>
                    <div class="row">
                        <a class="col btn btn-success m-3" href="<?= base_url('profile/download_image/' . $id_media) ?>">Download</a>
                        <a class="col btn btn-danger m-3" href="<?= base_url('profile/hapus_image/' . $id_media) ?>">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Modal Document -->
    <?php
    foreach ($document as $doc) {
        $id_doc = $doc->id_document;
    ?>
        <div class="modal fade" id="modalDocument/<?= $doc->id_document ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
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
                        <a class="col btn btn-danger m-3" href="<?= base_url('profile/hapus_document/' . $id_doc) ?>">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function onFileUpload(input, id) {
            id = id || '#ajaxImgUpload';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id).attr('src', e.target.result).width(300)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        <?php foreach ($galery as $g) { ?>
            $(function() {
                $('#modalMedia/<?= $g->id_media ?>').modal({
                    show: false
                }).on('hidden.bs.modal', function() {
                    $(this).find('video')[0].pause();
                });
            });
        <?php } ?>
    </script>

</body>