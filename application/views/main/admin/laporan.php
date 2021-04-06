<div class="main">
    <div class="row">
        <div class="col-md-4">
            <form action="<?= base_url('data_kelas') ?>" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="cari tanggal.."
                        aria-label="Recipient's username" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" id="button-addon2" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NISN</th>
                <th scope="col">Nama siswa</th>
                <th scope="col">Bulan bayar</th>
                <th scope="col">Tahun bayar</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <?php

        foreach ($laporan as $l) :
            ++$start;
        ?>
        <tbody>
            <tr>
                <th scope="row"><?= $start ?></th>
                <td><?= $l['nisn']; ?></td>
                <td><?= $l['nama']; ?></td>
                <td><?= $l['bulan'] ?></td>
                <td><?= $l['tahun']; ?></td>
                <td><?= $l['status']; ?></td>

            </tr>

        </tbody>
        <?php endforeach; ?>
    </table>
</div>