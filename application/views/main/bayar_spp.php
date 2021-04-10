<!DOCTYPE html>
<html>

<head>
    <title>Bayar spp</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="<?php echo base_url(); ?>assets/css2.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <img src="<?php echo base_url(); ?>assets/images/bpi.png">
        <h1>SMK BPI</h1>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="margin-right: 3%;">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <form class="form-inline my-2 my-lg-0" style="margin-right: -10px;">
                <li class="nav dropdown no-arrow text-gray-600">
                    <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <h5 class="mr-2 d-lg-inline"><?= $petugas['nama_petugas']; ?></h5>

                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">


                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                            <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>


            </form>
        </div>
    </nav>
    <br>
    <div class="main" style="margin-top: 6%;">
        <div class="prev">
            <a href="javascript:window.history.back();" class="previous round">&laquo;</a>
        </div>
    </div>

    <div style="width: 50%; float:right;margin-top: -60px;height:10px;">
        <?= $this->session->flashdata('message'); ?>
    </div>
    <div class=" row" style="margin-top: 30px;margin-left:2%;margin-right:2%;">
        <div class="col">
            <div class="card-group">
                <div class="card" style="border: none;">
                    <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/<?= $siswa['gambar'] ?>"
                        alt="Card image cap" style=" height:240px;width:60%;margin-left:140px">
                </div>
                <div class="card" style=" height:240px">

                    <div class="card-body" style="margin-top: 20px;">
                        <h5 class="card-title">Nama : <?= $siswa['nama'] ?></h5>
                        <h5 class="card-title">NISN : <?= $siswa['nisn'] ?></h5>
                        <h5 class="card-title">NIS : <?= $siswa['nis'] ?></h5>
                        <h5 class="card-title">no telp : <?= $siswa['no_telp'] ?></h5>
                    </div>
                </div>

            </div>
        </div>

        <div class="col">
            <div class="row">
                <div class="col" style="border: 1px solid black;height:240px">
                    <h3>Pembayaran</h3>
                </div>
                <div class="col" style="border: 1px solid black;">

                    <form method="post" action="<?= base_url('petugas/tambah_pembayaran/'); ?><?= $siswa['nisn']; ?>">
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
                            <input type="hidden" class="form-control" aria-label="Amount (to the nearest dollar)"
                                name="jumlah_bayar" value="<?= $spp['nominal'] ?>">

                        </div>
                        <input type="hidden" name="tgl_bayar" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                        echo date('Y-m-d'); ?>">
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <br>




    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">keluar dari halaman ini?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('main_petugas/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Bulan</th>
                <th scope="col">Tanggal bayar</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tahun dibayar</th>
            </tr>
        </thead>

        <?php
        $i = 0;
        foreach ($pembayaran as $row) :
            $i++ ?>
        <th scope="row"><?= $i ?></th>
        <td><?php echo $row['bulan_dibayar'] ?></td>
        <td><?php echo $row['tgl_bayar'] ?></td>
        <td><?php echo $row['jumlah_bayar'] ?></td>
        <td><?php echo $row['tahun_dibayar'] ?></td>
        </tr>
        </tbody>

        <?php endforeach; ?>
    </table>
</body>


</html>