<div class="main">
    <div class="row">
        <div class="col-md-4">
            <form action="<?= base_url('data_spp') ?>" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="cari tahun.." aria-label="Recipient's username"
                        name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" id="button-addon2" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button type="submit" class="tambah btn btn-secondary btn-lg" data-toggle="modal" data-target="#exampleModalCenter">
        Tambah spp</button>
    <?= $this->session->flashdata('message'); ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">no</th>
                <th scope="col">tahun</th>
                <th scope="col">nominal</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($spp as $s) :
                ++$start;
            ?>
            <tr>
                <th scope="row"><?= $start ?></th>
                <td><?= $s['tahun']; ?></td>
                <td><?= $s['nominal']; ?></td>
                <td><a href="<?= base_url('data_spp/editDataspp/'); ?><?= $s['id_spp'] ?>"
                        class="badge badge-primary ">edit</a>
                    <a href="<?= base_url('data_spp/hapusDataspp/'); ?><?= $s['id_spp']; ?>" class="badge badge-danger"
                        onclick="return confirm('hapus data spp?');">hapus</a>
                </td>

            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
</div>
<?= $this->pagination->create_links(); ?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah spp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('data_spp/tambah_spp') ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputusername" placeholder="tahun" name="tahun">

                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                        placeholder="nominal" name="nominal">

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