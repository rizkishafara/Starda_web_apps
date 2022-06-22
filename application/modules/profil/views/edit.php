            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">

                <div class="col-lg-8">
                <form action="<?= base_url('profil/edit') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" readonly value="<?= $user['email']; ?>" id="email" name="email" >
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" >
                            <?= form_error('name', '<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nomor Telephone</label>
                            <div class="col-sm-10">
                            <input type="number" name="telephone" class="form-control" id="telephone" value="<?= $user['telephone']; ?>" >
                            <?= form_error('name', '<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Picture</div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/images/users/') .$user['image'];  ?>" class="img-thumbnail" alt="">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" name="image" id="image">
                                            <label for="image" class="custom-file-label">Pilih Gambar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Profile</button>
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