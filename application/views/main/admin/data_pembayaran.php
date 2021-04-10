<div class="main" style="margin-top: 9%;">
    <div class="prev">
        <a href="javascript:window.history.go(-1);" class="previous round">&laquo;</a>
    </div>
</div>

<form method="post" action="<?= base_url('admin/pembayaran/'); ?><?= $siswa['nisn']; ?>"
    style="border: 1px solid black;width:50%;margin-left:30%;padding:40px">
    <center>
        <h3 style="margin-bottom:30px">Pembayaran</h3>
    </center>
    <?= $this->session->flashdata('mesage'); ?>
    <div class="form-group" style="margin-top: 10px;">
        <select class="form-control" id="exampleFormControlSelect1" name="tahun_dibayar">
            <option value="2019">2018/2019</option>
            <option value="2020">2019/2020</option>
            <option value="2021">2020/2021</option>
        </select>
    </div>
    <div class="form-group" style="margin-top: 10px;">
        <select class="form-control" id="exampleFormControlSelect1" name="bulan_dibayar">
            <?php foreach ($bulan as $b) : ?>
            <option value="<?= $b; ?>"><?= $b ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <input type="hidden" class="form-control" aria-label="Amount (to the nearest dollar)" name="jumlah_bayar"
            value="<?= $spp['nominal'] ?>">

    </div>
    <input type="hidden" name="tgl_bayar" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                    echo date('Y-m-d'); ?>">
    <button type="submit" class="btn btn-primary">Bayar</button>
</form>