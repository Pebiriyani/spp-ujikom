<div class="main">
    <div class="row">
        <div class="col-md-4">
            <form action="<?= base_url('data_petugas') ?>" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="cari nama petugas.."
                        aria-label="Recipient's username" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" id="button-addon2" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button type="submit" class="tambah btn btn-secondary btn-lg" data-toggle="modal" data-target="#exampleModalCenter">
        Tambah Petugas</button>
    <?= $this->session->flashdata('message'); ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Nama petugas</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($petugas as $p) :
                ++$start;
            ?>
            <tr>
                <th scope="row"><?= $start ?></th>
                <td><?= $p['username']; ?></td>
                <td><?= $p['nama_petugas']; ?></td>
                <td><a href="<?= base_url('data_petugas/editDataPetugas/'); ?><?= $p['id_petugas'] ?>"
                        class="badge badge-primary ">edit</a>
                    <a href="<?= base_url('data_petugas/hapusDataPetugas/'); ?><?= $p['id_petugas']; ?>"
                        class="badge badge-danger" onclick="return confirm('hapus data siswa?');">hapus</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <?= $this->pagination->create_links(); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('data_petugas/tambah_petugas') ?>

                <div class="form-group">
                    <input type="text" class="form-control" id="inputusername" placeholder="Username" name="username"
                        value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Nama Petugas"
                        name="nama_petugas" value="<?= set_value('nama_petugas'); ?>">
                    <?= form_error('nama_petugas', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="password">
                        <small class="text-danger"><?= form_error('password'); ?></small>
                    </div>
                    <div class="fform-group col-md-6">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="password2">

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>