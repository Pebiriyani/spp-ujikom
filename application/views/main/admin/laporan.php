<div class="main" style="margin-top: 6%;">
    <div class="prev">
        <a href="javascript:window.history.go(-1);" class="previous round">&laquo;</a>
    </div>

    <table class="table" style="margin-left:50px">
        <thead>
            <tr>
                <th scope="col">no</th>
                <th scope="col">tahun</th>
                <th scope="col">nominal lama</th>
                <th scope="col">nominal baru</th>
                <th scope="col">tanggal update</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            <?php

            $i = 0;
            foreach ($spp as $s) :
                $i++;
            ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $s['tahun']; ?></td>
                <td><?= $s['harga_lama']; ?></td>
                <td><?= $s['harga_baru']; ?></td>
                <td><?= $s['tgl_update']; ?></td>

            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
</div>