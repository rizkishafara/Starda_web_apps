<div class="container  my-3 py-4">
    <div class="row">
        <div class="col-8">
            <div class="row ">
                <?php foreach ($user_produk as $produk) {
                    $id = $produk->id_produk; ?>

                    <a href="<?= base_url('stakeholder/detail_produk/' . $produk->id_produk) ?>" class="link-card"  style="text-decoration:none; display:inline-block;">
                        <div class="card m-2" style="width: 21rem; height: 12rem;">

                            <div class="card-body row">
                                <div class="col-4">
                                    <?php
                                    if ($produk->id_cat_file == '1') {
                                        echo "<i class='fas fa-file-video' style='font-size: 100px; color:purple;'></i>";
                                    } else if ($produk->id_cat_file == '2') {
                                        echo "<i class='fas fa-file-image' style='font-size: 100px;color:lightblue;'></i>";
                                    }
                                    ?>
                                </div>
                                <div class="col-8">
                                    <div class="card-title wrapper-card">
                                        <div class="">
                                            <h6 class="txt-name"><?php echo $produk->title_produk ?></h4>
                                        </div>
                                    </div>
                                    <div class="card-text align-items-start" id="text-about">
                                        <p class="mb-auto"><?php echo $produk->desc_produk ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <p class=" col"><?php
                                                $totalunduh = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $id]);
                                                echo $totalunduh->num_rows();
                                                ?> Unduhan</p>
                                <p class=" col text-right"><?php echo $produk->kategori_file ?></p>

                            </div>

                        </div>
                    </a>


                <?php } ?>
            </div>
            <div class="mx-auto">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <div class="col">
            <form class="form-inline row" style="width:100%;" action="<?= base_url('unggahan/search') ?>" method="post">
                <input class="col form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="keyword" id="keyword">
                <input class="col col-3 btn btn-outline-success my-2 my-sm-0" type="submit" value="Cari"></input>
            </form>
            <div class="list-group">
                <a class="list-group-item"><strong>KATEGORI</strong></a>
                <a href="<?php echo base_url('unggahan') ?>" class="list-group-item">Semua</a>
                <?php
                foreach ($category as $kat) {
                ?>
                    <a href="<?= base_url('unggahan/kategori/') ?><?= $kat->id_kategori_file ?>" class="list-group-item"> <?= $kat->kategori_file ?></a>
                <?php
                }
                ?>
            </div><br>
        </div>
    </div>
</div>

<!-- Modal Media -->
<?php
foreach ($user_produk as $med) {
    $id_produk = $med->id_produk;
?>
    <div class="modal fade" id="detailMedia/<?= $id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <?= $med->title_produk ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <span class="col">Diunggah oleh : <a href="<?= base_url('stakeholder/detailData/' . $med->id_user) ?>"><?= $med->fullname ?></a></span>
                    <span class="col mx-3 text-right"><?php
                                                        $totalunduh = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $id_produk]);
                                                        echo $totalunduh->num_rows();
                                                        ?> Unduhan</span>
                </div>
                <div class="modal-body mx-auto">
                    <?php if ($med->id_cat_file == '1') {
                        echo "<video controls style='width:412px;height:auto;'>
                                <source src=" . base_url('storage/media_user/' . $med->name_produk) . ">
                            </video>";
                    } else if ($med->id_cat_file == '2') {
                        echo "<img class='' style='width:312px;height:auto;' src=" . base_url('storage/media_user/' . $med->name_produk) . " >";
                    } ?>

                </div>
                <div class="mx-3">
                    <div class="row">
                        <div class="col">
                            <label for="fname">Judul:</label>
                            <input class="form-control bg-white" type="text" value="<?= $med->title_produk ?>" disabled>
                        </div>
                        <div class="col">
                            <label for="fname">Kategori:</label>
                            <input class="form-control bg-white" type="text" value="<?= $med->kategori_file ?>" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="deskripsi">Deskripsi :</label>
                            <textarea class="form-control font-italic bg-white" id="inputAbout" name="about" rows="3" disabled>"<?= $med->desc_produk; ?>"</textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <a class="col btn btn-success m-3" href="<?= base_url('profile/download_image/' . $id_produk) ?>">Download</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>