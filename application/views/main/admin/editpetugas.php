<div class="main" style="margin-top: 9%;">
    <div class="prev">
        <a href="javascript:window.history.go(-1);" class="previous round">&laquo;</a>
    </div>
    <div class="container" style="width: 70%; ">

        <center>
            <h3 style="margin-bottom: 15px;">Ubah Data Petugas</h3>
        </center>
        <hr>
        <form action="" method="POST">
            <input type="hidden" name="id_petugas" value="<?= $petugas['id_petugas']; ?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="inputusername" placeholder="Username" name="username"
                    value="<?= $petugas['username']; ?>">
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label>Nama petugas</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Nama Petugas" name="nama_petugas"
                    value="<?= $petugas['nama_petugas']; ?>">
                <?= form_error('nama_petugas', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group">
                <label for="inputState">level</label>
                <input type="text" class="form-control" id="inputZip" name="level" value="<?= $petugas['level']; ?>">
                <?= form_error('level', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>