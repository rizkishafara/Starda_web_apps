            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">

                <div class="col-lg-6">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('profil/changepassword') ?>" method="post">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input class="form-control" type="password" id="current_password" name="current_password" placeholder="">
                            <?= form_error('current_password', '<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="new_password1">New Password</label>
                            <input class="form-control" type="password" id="new_password1" name="new_password1" placeholder="">
                            <?= form_error('new_password1', '<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="new_password1">Repeat Password</label>
                            <input class="form-control" type="password" id="new_password2" name="new_password2" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
                </div>

                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->