<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Produk User</h1>

    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Tabel Data Produk User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama User</th>
                            <th>Judul Document</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Nama User</th>
                            <th>Judul Document</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Tanggal Upload</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($mediapending as $med) {
                            $id = $med->id_produk;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $med->fullname ?></td>
                                <td><?= $med->title_produk ?></td>
                                <td> <?php
                                        if ($med->id_cat_file == '1') {
                                            echo "<i class='fas fa-file-video' style='font-size: 130px; color:purple;'></i>";
                                        } else if ($med->id_cat_file == '2') {
                                            echo "<i class='fas fa-file-image' style='font-size: 130px;color:lightblue;'></i>";
                                        }
                                        ?>
                                </td>
                                <td><?= $med->status ?></td>
                                <td><?php
                                    $date = $med->upload_date;
                                    $newdate = date("d-m-Y", strtotime($date));
                                    echo $newdate;
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/media/detail_produk/' . $med->id_produk) ?>" class="btn btn-warning" >Preview</a>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#accMedia/<?= $id ?>">Setujui</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#tolakMedia/<?= $id ?>">Tolak</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Media -->
<?php
foreach ($mediapending as $med) {
    $id_produk = $med->id_produk;
?>
    <div class="modal fade" id="detailMedia/<?= $med->id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <div class="modal-body mx-auto">
                    <?php if ($med->id_cat_file == '1') {
                        echo "<video controls style='width:312px;height:auto;'>
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

<!-- Modal delete -->
<?php foreach ($mediapending as $med) {
    $id = $med->id_produk; ?>
    <div class="modal fade" id="deleteMedia/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus produk <?= $med->title_produk ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/media/delete_media/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal accept -->
<?php foreach ($mediapending as $med) {
    $id = $med->id_produk; ?>
    <div class="modal fade" id="accMedia/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setujui</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menyetujui produk <?= $med->title_produk ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a type="button" class="btn btn-success" href="<?= base_url('admin/media/accept_media/' . $id) ?>">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal tolak -->
<?php foreach ($mediapending as $med) {
    $id = $med->id_produk; ?>
    <div class="modal fade" id="tolakMedia/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=<?= base_url('admin/media/tolak_media/' . $id) ?> method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="tolak">Alasan</label>
                        <textarea class="form-control " id="inputAlasan" name="alasan" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                        <!-- <a type="button" class="btn btn-danger" href="<?= base_url('admin/media/tolak_media/' . $id) ?>">Tolak</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>