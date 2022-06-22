<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Member</h1>

    <!-- DataTales Example -->
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <h6 class="m-0 font-weight-bold text-primary my-auto">Akun Member</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Keahlian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Keahian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($usermember as $member) {
                            $id = $member->id_user;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $member->fullname ?></td>
                                <td><?= $member->email ?></td>
                                <td><?= $member->category_user ?></td>
                                <td><?= $member->keahlian_user ?></td>
                                <td><?= $member->status ?></td>
                                <td>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteMember/<?= $id ?>">Hapus</button>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal delete -->
<?php foreach ($usermember as $member) {
    $id = $member->id_user; ?>
    <div class="modal fade " id="deleteMember/<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus data <?= $member->fullname ?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger" href="<?= base_url('admin/usermember/delete_member/' . $id) ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>