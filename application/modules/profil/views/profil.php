            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <?= $this->session->flashdata('message'); ?>
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">
                <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="<?=base_url('assets/images/users/').$user['image'];?>" class="card-img" style="margin: 10px;max-width: 100%;max-height: 100%;" >
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">My Profile</h5>
                        <p class="card-text">Name : <?= $user ['name'] ?></p>
                        <p class="card-text">Email : <?= $user ['email'] ?></p>
                        <p class="card-text">Telephone : <?= $user ['telephone'] ?></p>
                        <p class="card-text"><small class="text-muted">Member Since : <?= date('d F y', $user['date_created']); ?></small></p></p>
                    </div>
                    </div>
                </div>
                </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->