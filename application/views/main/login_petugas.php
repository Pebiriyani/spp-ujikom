<!DOCTYPE html>
<html>

<head>
    <title>login siswa</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect">

    <link href="<?php echo base_url(); ?>assets/css1.css" rel="stylesheet" type="text/css" />
</head>
</head>
<div class="container" style="margin-top: -10px;">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">

                <div class="row">

                    <div class="col-lg">
                        <div class="p-3">
                            <div class="text-center">
                                <img src="<?php echo base_url(); ?>assets/images/bpi.png" class="image">
                                <h1 class="h4 text-gray-900 mb-4">SMK BPI</h1>
                            </div>
                            <hr style="margin-top: -20px;">
                            <form class="user" method="post" action="<?= base_url('main_petugas'); ?>">
                                <?= $this->session->flashdata('message'); ?>
                                <div class="form-inline mb-3">
                                    <label for="floatingInput">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                <img src="<?php echo base_url(); ?>assets/images/user.png"
                                                    class="image"></span>
                                        </div>
                                        <input type="text" class="form-control" id="floatingInput" name="username"
                                            value="<?= set_value('username'); ?>"><br>
                                    </div>
                                    <small class=" text-danger"><?= form_error('username'); ?></small>
                                </div>

                                <div class="form-inline mb-3">
                                    <label for="floatingInput">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                <img src="<?php echo base_url(); ?>assets/images/padlock.png"
                                                    class="image"></span>
                                        </div>
                                        <input type="password" class="form-control" id="floatingInput" name="password"
                                            value="<?= set_value('password'); ?>">
                                    </div>
                                    <small class=" text-danger"><?= form_error('password'); ?></small>
                                </div>


                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </div>
                                <hr>

                                <div class="text-center">
                                    <a class="small" href="<?= base_url('main'); ?>"
                                        style="text-decoration: none;">masuk sebagai
                                        siswa</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<body>

</body>

</html>