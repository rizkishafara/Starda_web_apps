<div class="container  my-3 py-4">
    <div class="row">
        <div class="col-8">
            <div class="row ">
                <?php foreach ($user_data as $user) { ?>

                    <a class="link-card" href="<?= base_url('stakeholder/detailData/' . $user->id_user) ?>" style="text-decoration:none; display:inline-block;">
                        <div class="card m-2" style="width: 13rem; height: 22rem;">
                            <img class="card-img-top mx-auto mt-4" src=<?php echo base_url('storage/profile_user/' . $user->photo_user)  ?> alt="Card image cap">
                            <div class="card-body">

                                <div class="card-title wrapper-card my-top">
                                    <div class="wrap-name">
                                        <h5 class="txt-name"><?php echo $user->fullname ?></h5>
                                    </div>
                                </div>
                                <div class="card-text align-items-start" id="text-about">
                                    <p class="mb-auto"><?php echo $user->about ?></p>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush" id="text-category">
                                <li class=" list-group-item text-right"><?php echo $user->category_user ?></li>
                            </ul>
                        </div>
                    </a>


                <?php } ?>
            </div>
            <div class="mx-auto">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <div class="col">
            <form class="form-inline row" action="<?= base_url('stakeholder/search') ?>" method="post">
                <input class="col form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="keyword" id="keyword">
                <input class="col col-3 btn btn-outline-success my-2 my-sm-0" type="submit" ` value="Cari"></input>
            </form>
            <div class="list-group">
                <a class="list-group-item"><strong>KATEGORI</strong></a>
                <a href="<?php echo base_url('stakeholder') ?>" class="list-group-item">Semua</a>
                <?php
                foreach ($category as $kat) {
                ?>
                    <a href="<?= base_url('stakeholder/kategori/') ?><?= $kat->id_cat ?>" class="list-group-item"> <?= $kat->category_user ?></a>
                <?php
                }
                ?>
            </div><br>
        </div>
    </div>
</div>