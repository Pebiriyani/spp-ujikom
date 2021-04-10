<div class="main">
    <div class="row">
        <div class="col-md-4">
            <form action="<?= base_url('admin') ?>" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="cari nama siswa.."
                        aria-label="Recipient's username" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" id="button-addon2" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button type="submit" class="tambah btn btn-secondary btn-lg" data-toggle="modal" data-target="#exampleModalCenter">
        Tambah Siswa</button>
    <?= $this->session->flashdata('message'); ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nisn</th>
                <th scope="col">Nis</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Alamat</th>
                <th scope="col">No telp</th>
                <th scope="col">Id spp</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($siswa as $s) :
                ++$start;
            ?>
            <tr>
                <th scope="row"><?= $start ?></th>
                <td><?= $s['nisn']; ?></td>
                <td><?= $s['nis']; ?></td>
                <td><?= $s['nama']; ?></td>
                <td><?= $s['nama_kelas'] . " " . $s['kompetensi_keahlian'] ?></td>
                <td><?= $s['alamat']; ?></td>
                <td><?= $s['no_telp']; ?></td>
                <td><?= $s['id_spp']; ?></td>
                <td> <a href="<?= base_url('admin/editDataSiswa/'); ?><?= $s['nisn']; ?>"
                        class="badge badge-primary ">edit</a>
                    <a href="<?= base_url('admin/hapusDataSiswa/'); ?><?= $s['nisn']; ?>" class="badge badge-danger"
                        onclick="return confirm('hapus data siswa?');">hapus</a>
                    <a href="<?= base_url('admin/laporan/'); ?><?= $s['nisn']; ?>"
                        class="badge badge-primary ">laporan</a>
                    <a href="<?= base_url('admin/pembayaran/'); ?><?= $s['nisn']; ?>" class="badge badge-primary ">Bayar
                        Spp</a>

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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('admin/tambah_siswa') ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control" id="inputnisn" placeholder="NISN" name="nisn"
                            value="<?= set_value('nisn'); ?>" required>
                        <small class="text-danger pl-3"> <?= form_error('nisn') ?> </small>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="inputnis" placeholder="NIS" name="nis"
                            value="<?= set_value('nis'); ?>" required>
                        <?= form_error('nis', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Nama" name="nama"
                        value="<?= set_value('nama'); ?>" required>
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <textarea type="text" class="form-control" id="inputAddress2" placeholder="Alamat" name="alamat"
                        value="<?= set_value('alamat'); ?>" required></textarea>
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="inputAddress2" placeholder="No telp" name="no_telp"
                        value="<?= set_value('no_telp'); ?>" required>
                    <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label style="color: grey;margin-left:10px">gambar</label>
                    <input type="file" class="form-control" id="inputAddress2" name="userfile" size="20" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="number" class="form-control" id="inputZip" name="id_kelas"
                            value="<?= set_value('id_kelas'); ?>" placeholder="id kelas" required>
                        <?= form_error('id_kelas', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="number" class="form-control" id="inputZip" name="id_spp"
                            value="<?= set_value('id_spp'); ?>" placeholder="id spp" required>
                        <?= form_error('id_spp', '<small class="text-danger pl-3">', '</small>') ?>
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