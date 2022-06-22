<body class="loginbg" id="loginbg">
    <div class="container">
        <div class="login row">
            <div id="col" class="col col-md-6 col-lg-6">
                <div class="login-wrap">
                    <i class="fas fa-user mb-3"></i>
                    <h4 class="mb-5 text-center">PENGAJUAN AKUN</h4>
                    <form action="<?php base_url('register') ?>" method="post" enctype="multipart/form-data">
                        <label for="fullname">Nama Lengkap</label>
                        <div class="form-label-group mb-3">
                            <input value="<?php echo set_value('fullname'); ?>" type="text" id="inputFullname" autocomplete="off" name="fullname" class="form-control" placeholder="Ahmad Coba Coba" required autofocus>
                            <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="email">Email</label>
                        <div class="form-label-group mb-3">
                            <input value="<?php echo set_value('email'); ?>" type="text" id="inputEmail" autocomplete="off" name="email" class="form-control" placeholder="ahmad321@gmail.com" required>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="phone">Nomor HP / Whatsapp</label>
                        <div class="pt-0 pl-0">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+62</div>
                                </div>
                                <input value="<?php echo set_value('phone'); ?>" type="text" name="phone" class="form-control" id="phone" required>
                                <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <label for="category">Kategori</label>
                        <div class="form-label-group mb-3">
                            <select name="category" class="custom-select">
                                <option value="" selected disabled>
                                    <--Pilih salah satu-->
                                </option>

                                <?php foreach ($category as $kat) { ?>
                                    <option class="" value="<?= $kat['id_cat']; ?>"><?= $kat['category_user']; ?></option>
                                <?php } ?>

                            </select>
                            <?= form_error('category', '<small class="text-danger pl-3">', '</small>'); ?>

                        </div>
                        <label for="instansi">Instansi</label>
                        <div class="form-label-group mb-3">
                            <input value="<?php echo set_value('instansi'); ?>" type="text" id="inputInstansi" autocomplete="off" name="instansi" class="form-control" placeholder="Instansi terkait" required autofocus>
                            <?= form_error('instansi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button class="text-wrap btn btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2" name="btnSubmit" type="submit">Register now</button>
                        <div class="text-center">
                            <a class="small" href="login">Already have account?</a>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>