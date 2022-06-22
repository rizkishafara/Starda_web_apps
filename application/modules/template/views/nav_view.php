<!-- navbar-->

<body>
    <header class="header bg-nav">
        <div class="container px-0 px-lg-3">
            <nav class="navbar navbar-expand-lg navbar-light">
                <img class="nav_logo navbar-brand" id="img-nav" src="<?php echo base_url('assets/image/Stardabuck.png') ?>" href="<?php echo base_url('board/dashboard') ?>">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="col navbar-nav my-auto">
                        <li class="nav-item ">
                            <a class="nav-link font-weight-bold" href="<?php echo base_url('beranda') ?>">Beranda</a>
                        </li>
                        <?php if ($this->session->userdata('id_user')) { ?>
                            <li class="nav-item ">
                                <a class="nav-link font-weight-bold" href="<?php echo base_url('member') ?>">Dashboard</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="<?php echo base_url('stakeholder') ?>">Stakeholder</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="<?php echo base_url('unggahan') ?>">Unggahan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="<?php echo base_url('about') ?>">Tentang</a>
                        </li>
                    </ul>
                    <ul class="row navbar-nav d-flex justify-content-end">



                        <?php
                        $id_user = $this->session->userdata('id_user');
                        if (!$id_user) {
                        ?>
                            <li class="nav-item font-weight-bold my-auto"><a class="nav-link" href="<?php echo base_url('login') ?>"> <i class="fas fa-sign-in-alt"></i>&ensp;Login</a></li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item my-auto"><a class="nav-link" href="<?php echo base_url('member') ?>">
                                    <img class="rounded-circle" id="profile-user" src=<?= base_url('storage/profile_user/' . $user->photo_user) ?>>
                                    &ensp;Hai, <?= $user->fullname ?> !</a>
                            </li>
                            <!-- 
                            <li class="dropdown nav-item my-auto">
                                <div class="dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-caret-circle-down"></i>
                                </div>
                                <div class="dropdown-menu nav-item" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item nav-link" href="<?php echo base_url('profile') ?>"><i class="fas fa-user">&ensp;</i>Profile</a>
                                    <a class="dropdown-item nav-link" href="<?php echo base_url('profile/chgpswd/' . $id_user) ?>"> <i class="fas fa-cog"></i>&ensp;Change Password</a>
                                    <a class="dropdown-item nav-link" href="<?php echo base_url('login/logout') ?>"> <i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
                                </div>
                            </li> -->
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- /.navbar -->