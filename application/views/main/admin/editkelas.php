<div class="main" style="margin-top: 9%;">
    <div class="prev">
        <a href="javascript:window.history.go(-1);" class="previous round">&laquo;</a>
    </div>
    <div class="container" style="width: 70%; ">

        <center>
            <h3 style="margin-bottom: 15px;">Ubah Data kelas</h3>
        </center>
        <hr>
        <form action="" method="POST">
            <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']; ?>">
            <div class="form-group" style="margin-top: 10px;">
                <label>Kelas</label>
                <select class="form-control" id="exampleFormControlSelect1" name="nama_kelas">
                    <?php foreach ($nama_kelas as $n) : ?>
                    <?php if ($n == $kelas['nama_kelas']) : ?>
                    <option value="<?= $n; ?>" selected><?= $n; ?></option>
                    <?php else : ?>
                    <option value="<?= $n; ?>"><?= $n; ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="margin-top: 10px;">
                <label>Jurusan</label>
                <select class="form-control" id="exampleFormControlSelect1" name="kompetensi_keahlian">
                    <?php foreach ($jurusan as $j) : ?>
                    <?php if ($j == $kelas['kompetensi_keahlian']) : ?>
                    <option value="<?= $j; ?>" selected><?= $j; ?></option>
                    <?php else : ?>
                    <option value="<?= $j; ?>"><?= $j; ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>