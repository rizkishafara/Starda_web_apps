<body id="loginbg">
    <div class="container">
        <div class="login row">
            <div id="col" class="col col-md-6 col-lg-6">
                <div class="login-wrap">
                    <i class="fas fa-user mb-3"></i>
                    <h4 class="mb-3 text-center">Change Password</h4>
                    <?php $id_user = $this->session->userdata('id_user'); ?>
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?php base_url('profile/changepswd' . $id_user); ?>" method="post" autocomplete="off">
                        <?php echo form_open('auth/login'); ?>
                        <label for="oldpass">Password Lama</label>
                        <div class="form-label-group mb-3">
                            <input type="password" id="inputOldpass" name="oldpass" class="form-control" placeholder="Masukan Password Lama Anda" required autofocus>
                            <?= form_error('oldpass', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="oldpass">Password Baru</label>
                        <div class="form-label-group mb-1">
                            <input type="password" id="inputNewpass" name="newpass" class="form-control" placeholder="Masukan Password Baru" required>
                            <?= form_error('newpass', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-label-group mb-3">
                            <input type="password" id="inputNewpass2" name="newpass2" class="form-control" placeholder="Masukan Lagi Password Baru" required>
                            <?= form_error('newpass', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button class="col text-wrap btn btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2" name="btnSubmit" type="submit">Save New password</button>
                        <button class="col text-wrap btn btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2">Batal</button>
                        <?php echo form_close(); ?>
                    </form>
                </div>
            </div>

        </div>
    </div>