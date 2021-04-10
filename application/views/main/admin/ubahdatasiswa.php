<div class="main" style="margin-top: 9%;">
    <div class="prev">
        <a href="javascript:window.history.go(-1);" class="previous round">&laquo;</a>
    </div>
    <div class="container" style="width: 70%; ">

        <center>
            <h3 style="margin-bottom: 15px;margin-top:-40px">Ubah Data Siswa</h3>
        </center>
        <hr>
        <form action="" method="POST">
            <input type="hidden" name="nisn" value="<?= $siswa['nisn']; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <!-- <label>NISN</label> -->
                    <input type="hidden" class="form-control" id="inputnisn" placeholder="NISN" name="nisn"
                        value="<?= $siswa['nisn']; ?>" style="height: 40%;">
                    <?= form_error('nis', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-md-6" style="margin-left:-50%">
                    <label>NIS</label>
                    <input type="text" class="form-control" id="inputnis" placeholder="NIS" name="nis"
                        value="<?= $siswa['nis']; ?>" style="height: 40%;">
                    <?= form_error('nis', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Nama" name="nama"
                        value="<?= $siswa['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-md-6">
                    <label>No telp</label>
                    <input type="number" class="form-control" id="inputAddress2" placeholder="No telp" name="no_telp"
                        value="<?= $siswa['no_telp']; ?>">
                    <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputState">id kelas</label>
                    <input type="number" class="form-control" id="inputZip" name="id_kelas"
                        value="<?= $siswa['id_kelas']; ?>">
                    <?= form_error('id_kelas', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputZip">id spp</label>
                    <input type="number" class="form-control" id="inputZip" name="id_spp"
                        value="<?= $siswa['id_spp']; ?>">
                    <?= form_error('id_spp', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Alamat" name="alamat"
                    value="<?= $siswa['alamat']; ?>">
                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>