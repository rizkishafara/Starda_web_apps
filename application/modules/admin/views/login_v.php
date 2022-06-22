<body class="loginbg" id="loginbg">
    <div class="container">
        <div class="login row">
            <div id="col" class="col col-md-6 col-lg-6 text-center">
                <div class="login-wrap">
                    <i class="fas fa-user mb-3"></i>
                    <h4 class="mb-5">LOGIN ADMIN</h4>
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?php base_url('admin/login'); ?>" method="post">
                        <div class="form-label-group mb-3">
                            <input value="<?php echo set_value('username_admin'); ?>" type="text" id="inputUsername" name="username_admin" class="form-control" placeholder="Username" required autofocus autocomplete="off" >
                            <?= form_error('username_admin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-label-group mb-3">
                            <input type="password" id="inputPassword" name="password_admin" class="form-control" placeholder="Password" required autocomplete="off" >
                            <?= form_error('password_admin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button class="text-wrap btn btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2" name="btnSubmit" type="submit">Login</button>
                    </form>
                </div>
            </div>

        </div>
    </div>