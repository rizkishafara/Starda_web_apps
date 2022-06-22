<div class="container-fluid">
    <div class="container-fluid bg-white shadow mb-4">
        <div class="p-5 text-center">
            <?= $this->session->flashdata('pesan'); ?>
            <h6 class="back-link " onclick="window.history.back()"><i class="fas fa-arrow-left "></i> Kembali</h6>

            <div>

                <?php if ($detail->id_cat_file == '1') {
                    echo "<video style='max-width:90% ;max-height:30rem;' controls>
                                <source src=" . base_url('storage/media_user/' . $detail->name_produk) . ">
                            </video>";
                } else if ($detail->id_cat_file == '2') {
                    echo "<img class='' style='max-width:90% ;max-height:30rem;' src=" . base_url('storage/media_user/' . $detail->name_produk) . " >";
                } ?>
                <div class="my-3">
                    <h2 class="font-weight-bold text-left"><?= $detail->title_produk ?></h2>
                </div>
                <div class="row mb-2">
                    <span class="col text-left pl-0">Diunggah oleh : <a href="<?= base_url('stakeholder/detailData/' . $detail->id_user) ?>"><?= $detail->fullname ?></a></span>
                    <span class="col text-right pr-0">Diunduh <?= $unduhan ?> kali</span>
                </div>
                <a class="col btn btn-success" href="<?= base_url('profile/download_image/' . $detail->id_produk) ?>">Download</a>
                <hr>
                <div class="text-left">
                    <span>Deskripsi :</span>
                    <div class="font-italic text-left rounded">"<?= $detail->desc_produk ?>"</div>
                </div>
                <?php if (!empty($kegiatan)) { ?>
                    <hr>
                    <div class="text-left">
                        <span>Kegiatan Terkait :</span>
                        <span><?= $kegiatan->kegiatan; ?></span>
                    </div>
                <?php } ?>
                <?php if ($this->session->userdata('id_user')) { ?>
                    <hr>
                    <div class="text-left">
                        <span>Dokumen Pelengkap :</span>
                        <div class="row row-cols-3">
                            <?php foreach ($dokumen as $dok) { ?>
                                <div class="col">
                                    <a data-toggle="modal" data-target="#exampleModalCenter/<?= $dok->name_document ?>">
                                        <div class="card text-center p-2 my-2" style="height: 15rem;">
                                            <?php
                                            if ($dok->id_cat_doc == '3') {
                                                echo "<i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>";
                                            } else if ($dok->id_cat_doc == '4') {
                                                echo "<i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>";
                                            } else if ($dok->id_cat_doc == '5') {
                                                echo "<i class='fas fa-file-pdf' style='font-size: 130px;color:red;'></i>";
                                            }
                                            ?>
                                            <div class="card-body">
                                                <p class="card-text"><?= substr($dok->name_document, 5) ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($dokumen as $dok) { ?>
    <div class="modal fade" id="exampleModalCenter/<?= $dok->name_document ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal <?= substr($dok->name_document, 5) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <?php $link = base_url('storage/doc_media_user/' . $dok->name_document); ?>

                    <?php if ($dok->id_cat_doc == '3') { ?>
                        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?= $link ?>' width='100%' height='450' frameborder='0'></iframe>
                        This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>. -->
                        <i class='fas fa-file-word' style='font-size: 130px; color:blue;'></i>
                    <?php } else if ($dok->id_cat_doc == '4') { ?>
                        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?= $link ?>' width='100%' height='450' frameborder='0'> </iframe>
                        This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>. -->
                        <i class='fas fa-file-excel' style='font-size: 130px;color:green;'></i>
                    <?php } else if ($dok->id_cat_doc == '5') { ?>
                        <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $link ?>" width="100%" height="450">
                        <!-- <object data="" type=""><embed class="text-center" src="<?= $link ?>" width="100%" height="450" type="application/pdf"></object> -->
                        <!-- <i class=' fas fa-file-pdf' style='font-size: 130px;color:red;'></i> -->
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class=" btn btn-success m-3" href="<?= base_url('member/produk/download_document/' . $dok->id_document) ?>">Download</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>