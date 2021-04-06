<div class="main">
    <div class="row">
        <div class="col-md-4">
            <form action="<?= base_url('data_kelas') ?>" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="cari nama jurusan.."
                        aria-label="Recipient's username" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" id="button-addon2" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button type="submit" class="tambah btn btn-secondary btn-lg" data-toggle="modal" data-target="#exampleModalCenter">
        Tambah Kelas</button>
    <?= $this->session->flashdata('message'); ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kelas</th>
                <th scope="col">kompetensi keahlian</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($kelas as $k) :
                ++$start;
            ?>
            <tr>
                <th scope="row"><?= $start ?></th>
                <td><?= $k['nama_kelas']; ?></td>
                <td><?= $k['kompetensi_keahlian']; ?></td>
                <td><a href="<?= base_url('data_kelas/editDataKelas/'); ?><?= $k['id_kelas']; ?>"
                        class="badge badge-primary ">edit</a>
                    <a href="<?= base_url('data_kelas/hapusDataKelas/'); ?><?= $k['id_kelas']; ?>"
                        class="badge badge-danger" onclick="return confirm('hapus data kelas?');">hapus</a>

                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <?= $this->pagination->create_links(); ?>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('data_kelas/tambah_kelas') ?>

                <div class="form-group" style="margin-top: 10px;">
                    <select class="form-control" id="exampleFormControlSelect1" name="nama_kelas">
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <select class="form-control" id="exampleFormControlSelect1" name="kompetensi_keahlian">
                        <option value="Rekayasa perangkat lunak">Rekayasa perangkat lunak</option>
                        <option value="Teknik komputer jaringan">Teknik komputer jaringan</option>
                        <option value="Administrasi perkantoran">Administrasi perkantoran</option>

                    </select>
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