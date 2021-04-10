<div class="main">
    <table class="table" style="margin-top: 10%;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NISN</th>
                <th scope="col">Bulan bayar</th>
                <th scope="col">Tahun bayar</th>
                <th scope="col">Tanggal bayar</th>
                <th scope="col">Jumlah</th>
                <th scope="col">id petugas</th>

            </tr>
        </thead>

        <?php

        foreach ($history as $row) :
            $start++ ?>
        <th scope="row"><?= $start ?></th>
        <td><?php echo $row['nisn'] ?></td>
        <td><?php echo $row['bulan_dibayar'] ?></td>
        <td><?php echo $row['tahun_dibayar'] ?></td>
        <td><?php echo $row['tgl_bayar'] ?></td>
        <td><?php echo $row['jumlah_bayar'] ?></td>
        <td><?php echo $row['id_petugas'] ?></td>
        </tr>
        </tbody>

        <?php endforeach; ?>
    </table>
    <?= $this->pagination->create_links(); ?>
</div>