<form method="POST" action="data_pembayaran/tambah_pembayaran"
    style="border: 1px solid black;margin-top:10%;width:50%;margin-left:30%;padding:40px">
    <center>
        <h3>Pembayaran</h3>
    </center>
    <hr>
    <?= $this->session->flashdata('message'); ?>


    <div class="form-group">
        <input type="text" class="form-control" id="inputusername" placeholder="nisn siswa" name="nisn"
            value="<?= set_value('nisn'); ?>">
    </div>
    <div class="form-group">
        <select class="form-control" id="exampleFormControlSelect1" name="tahun_dibayar"
            value="<?= set_value('tahun_dibayar'); ?>">
            <option value="2019">2018/2019</option>
            <option value="2020">2019/2020</option>
            <option value="2021">2020/2021</option>
        </select>
    </div>
    <div class="form-group" style="margin-top: 10px;">
        <select class="form-control" id="exampleFormControlSelect1" name="bulan_dibayar"
            value="<?= set_value('bulan_dibayar'); ?>">
            <?php foreach ($bulan as $b) : ?>
            <option value="<?= $b; ?>"><?= $b ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Rp.</span>
        </div>
        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="jumlah_bayar"
            value="<?= set_value('jumlah_bayar'); ?>">

    </div>
    <input type="hidden" name="tgl_bayar" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                    echo date('Y-m-d'); ?>">
    <button type="submit" class="btn btn-primary">Bayar</button>
</form>


</div>