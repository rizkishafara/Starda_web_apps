<body class="loginbg" id="loginbg">
    <div class="container">
        <div class="login row">
            <div id="col" class="col col-md-6 col-lg-6">
                <div class="login-wrap">
                    <i class="fas fa-user mb-3"></i>
                    <h4 class="mb-5 text-center">REGISTER</h4>
                    <form action="<?php base_url('register') ?>" method="post">
                        <label for="fullname">Nama Lengkap</label>
                        <div class="form-label-group mb-3">
                            <input value="<?php echo set_value('fullname'); ?>" type="text" id="inputFullname" autocomplete="off" name="fullname" class="form-control" placeholder="Ahmad Coba Coba" required autofocus>
                        </div>
                        <label for="username">Email</label>
                        <div class="form-label-group mb-3">
                            <input value="<?php echo set_value('email'); ?>" type="text" id="inputEmail" autocomplete="off" name="email" class="form-control" placeholder="ahmad321@gmail.com" required autofocus>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <label for="password">Password</label>
                        <div class="form-label-group mb-3">
                            <input type="password" id="inputPassword" autocomplete="off" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-label-group mb-3">
                            <input type="password" id="inputPassword2" autocomplete="off" name="password2" class="form-control" placeholder="Masukan Lagi Password" required>
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
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
</body>