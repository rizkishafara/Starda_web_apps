<div class="container-fluid">
    <div class="container-fluid bg-white shadow mb-4">
        <div class="p-5 text-center">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="">
                <div class="profile mx-auto img-fluid">
                    <img id="" class=" rounded-circle " src="<?= base_url('storage/profile_user/' . $biodata->photo_user) ?>" alt="">
                    <div class="overlay rounded-circle">
                        <a href="" class="icon" data-toggle="modal" data-target="#editPhoto">
                            <i class="icn fas fa-pencil-alt"></i>
                        </a>
                    </div>
                </div>
            </div>

            <form action="<?= base_url('member/biodata/save_bio/' . $biodata->id_user) ?>" role="form" method="post">
                <div class="row pt-5">
                    <div class="col text-left">
                        <label for="fullname">Nama Lengkap</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputFullname" autocomplete="off" name="fullname" class="form-control" placeholder="Nama Lengkap" required value="<?= $biodata->fullname; ?>">
                        </div>
                        <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col text-left">
                        <label for="email">Email Aktif</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputEmail" autocomplete="off" name="email" class="form-control" placeholder="Email" disabled value="<?= $biodata->email; ?>">
                        </div>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left">
                        <label for="address">Alamat</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputAddress" autocomplete="off" name="address" class="form-control" placeholder="Alamat lengkap" required value="<?= $biodata->address_user; ?>">
                        </div>
                        <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col text-left">
                        <label for="phone">Nomor WA</label>
                        <div class="pt-0 pl-0">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+62</div>
                                </div>
                                <input type="text" name="phone" class="form-control" id="phone" value="<?= substr($biodata->phone_user, 2) ?>">
                            </div>
                        </div>
                        <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left">
                        <label for="category">Kategori</label>
                        <div class="form-label-group mb-3">
                            <select name="category" class="custom-select" required>

                                <?php if ($biodata->id_category_user == "") { ?>
                                    <option selected value="" disabled>
                                        <--Pilih salah satu-->
                                    </option>
                                <?php } else { ?>
                                    <option selected name="category" value="<?= $biodata->id_cat; ?>"><?= $biodata->category_user; ?></option>
                                    <option value="" disabled>
                                        <--Pilih salah satu-->
                                    </option>
                                <?php } ?>

                                <?php foreach ($category as $kat) { ?>
                                    <option value="<?= $kat['id_cat']; ?>"><?= $kat['category_user']; ?></option>
                                <?php } ?>

                            </select>
                            <?= form_error('category', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col text-left">
                        <label for="gender">Gender</label>
                        <div class="form-label-group mb-3">
                            <label>
                                <input required type="radio" name="gender" value="male" <?php if ($biodata->gender == 'male') echo 'checked' ?>>Pria
                            </label>
                            <label>
                                <input required type="radio" name="gender" value="female" <?php if ($biodata->gender == 'female') echo 'checked' ?>>Wanita
                            </label>
                            <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left">
                        <label for="keahlian">Keahlian</label>
                        <div class="form-label-group mb-3">
                            <select name="keahlian" class="custom-select" required>

                                <?php if ($biodata->id_keahlian_user == "") { ?>
                                    <option selected value="" disabled>
                                        <--Pilih salah satu-->
                                    </option>
                                <?php } else { ?>
                                    <option selected name="keahlian" value="<?= $biodata->id_keahlian_user; ?>"><?= $biodata->keahlian_user; ?></option>
                                <?php } ?>

                                <?php foreach ($keahlian as $ahli) { ?>
                                    <option value="<?= $ahli['id_keahlian']; ?>"><?= $ahli['keahlian_user']; ?></option>
                                <?php } ?>

                            </select>
                            <?= form_error('category', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col text-left">
                        <label for="instansi">Instansi</label>
                        <div class="form-label-group mb-3">
                            <input type="text" id="inputInstansi" autocomplete="off" name="instansi" class="form-control" placeholder="Instansi" required value="<?= $biodata->instansi; ?>">
                        </div>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left">
                        <label for="about">Tentang</label>
                        <div class="form-label-group mb-3">
                            <textarea class="form-control" id="inputAbout" name="about" rows="3"><?= $biodata->about; ?></textarea>
                        </div>
                        <?= form_error('about', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <button class="btn btn-success" id="btn-save">Simpan Perubahan</button>
            </form>
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

                <form method="post" id="upload_image_form" action="<?= base_url('member/biodata/edit_photo/' . $biodata->id_user) ?>" enctype="multipart/form-data">

                    <div class="d-grid text-center">
                        <img class="mb-3" id="ajaxImgUpload" alt="Preview Image" src="https://via.placeholder.com/300" />
                    </div>

                    <div class="mb-3">
                        <input type="hidden" value="<?= $biodata->photo_user; ?>" name="photo_user1" id="photo_user1">
                        <input type="file" name="photo_user" accept="image/png, image/jpeg, image/jpg, image/gif" multiple="true" id="" onchange="onFileUpload(this);" class="form-control form-control-lg mb-2">
                        <span style="color: red;">*Max size : 10MB</span>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="save" class="btn btn-primary float-right">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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