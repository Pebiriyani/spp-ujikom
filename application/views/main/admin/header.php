<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
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
    <link href="<?php echo base_url(); ?>assets/css1.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <form class="form-inline my-2 my-lg-0" style="margin-right: -10px;">
                <li class="nav dropdown no-arrow text-gray-600">
                    <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <h5 class="mr-2 d-lg-inline"><?= $admin['nama_petugas']; ?></h5>
                        <img class="img-profile rounded-circle" src="<?php echo base_url(); ?>assets/images/user.png">
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


    <div class="sidenav">
        <img src="<?php echo base_url(); ?>assets/images/bpi.png">
        <h1>SMK BPI</h1>

        <a href="<?= base_url('admin'); ?>">
            <i class="fa fa-table" aria-hidden="true"></i>
            <span>Data Siswa</span>
        </a>
        <hr>
        <a href="<?= base_url('admin/data_petugas'); ?>">
            <i class="fa fa-table" aria-hidden="true"></i>
            <span>Data Petugas</span></a>
        <hr>
        <a href="<?= base_url('admin/data_kelas'); ?>">
            <i class="fa fa-table" aria-hidden="true"></i>
            <span>Data Kelas</span></a>
        <hr>
        <a href="<?= base_url('admin/data_spp'); ?>">
            <i class="fa fa-table" aria-hidden="true"></i>
            <span>Data Spp</span></a>
        <hr>
        <a href="<?= base_url('admin/data_pembayaran'); ?>">
            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
            <span>Entri Pembayaran</span></a>

        <hr>
        <a href="<?= base_url('admin/history'); ?>">
            <i class="fa fa-history" aria-hidden="true"></i>
            <span> History</span></a>
        <hr>
        <a href="<?= base_url('admin/laporan'); ?>">
            <i class="fa fa-file" aria-hidden="true"></i>
            <span> Laporan</span></a>
    </div>