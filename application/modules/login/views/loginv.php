<body class="loginbg" id="loginbg">
    <div class="container">
        <div class="login row">
            <div id="col" class="col col-md-6 col-lg-6 text-center">
                <div class="login-wrap">
                    <i class="fas fa-user mb-3"></i>
                    <h4 class="mb-5">SIGN IN</h4>
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?php base_url('login'); ?>" method="post">
                        <?php echo form_open('auth/login'); ?>
                        <div class="form-label-group mb-3">
                            <input value="<?php echo set_value('email'); ?>" type="text" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-label-group mb-3">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button class="text-wrap btn btn-lg btn-block btn-login text-uppercase font-weight-bold" name="btnSubmit" type="submit">Login</button>
                        <?php echo form_close(); ?>
                        <span>atau</span>
                        <a class="text-wrap  btn-lg btn-block btn-primary text-uppercase font-weight-bold mb-2 mt-2" href="<?= base_url('') ?>">Masuk Sebagai Tamu</a>
                        <div class="text-center">
                            <a class="small" href="register2">Ajukan akun</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>