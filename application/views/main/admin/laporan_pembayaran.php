<div class="main" style="margin-top:6%" class="table table-striped table-bordered">
    <div class="prev" style="margin-left: -30px;">
        <a href="javascript:window.history.go(-1);" class="previous round">&laquo;</a>
    </div><br>
    <table class="table" style="margin-left: 45px;margin-top:-35px;width:90%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Bulan bayar</th>
                <th scope="col">Tahun bayar</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <?php
        $i = 0;
        foreach ($laporan as $l) :
            $i++
        ?>
        <tbody>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $l['bulan'] ?></td>
                <td><?= $l['tahun']; ?></td>
                <td><?= $l['status']; ?></td>

            </tr>

        </tbody>
        <?php endforeach; ?>
    </table>

</div>