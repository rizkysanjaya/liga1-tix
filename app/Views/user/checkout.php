<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('/assets/img/apple-icon.png') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('/assets/img/favicon.png') ?>">
    <title>
        <?= $title ?> | Liga1-Tix
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url('/assets/css/nucleo-icons.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('/assets/css/nucleo-svg.css" ') ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<? base_url('/assets/css/nucleo-svg.css') ?>" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('/assets/css/soft-ui-dashboard.css?v=1.0.6') ?>" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100 virtual-reality">
    <div>
        <?= $this->include('pages/layouts/navbar') ?>

    </div>
    <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('<? base_url('/assets/img/vr-bg.jpg') ?>') ; background-size: cover;">
        <?php $validation = \Config\Services::validation(); ?>
        <?php if (!empty(session()->getFlashdata('message'))) : ?>
            <div class="alert alert-success alert-dismissible fade show m-md-4" role="alert">

                <span class="alert-text"><strong>Yay Order Berhasil!</strong> </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo session()->getFlashdata('message'); ?>
                <br>
                <small>Refresh halaman ini jika email belum terkirim</small>

            </div>
        <?php endif; ?>
        <main class="main-content mt-1 border-radius-lg">
            <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-9">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-7">
                            <!-- Default Card Example -->
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-info-circle"></i> Pembelian Berhasil Lanjutkan Pembayaran
                                </div>
                                <div class="card-body" align="center">
                                    <p class="card-text">Kode Pemesanan Tiket :</p>
                                    <h1 class="card-title"><b><?php echo $tiket; ?></b></h1>
                                    <p><img src="<?php echo base_url('assets/img/qrcode/' . $tiket) ?>.png"></p>
                                    <a href="<?php echo base_url('assets/img/qrcode/' . $tiket) ?>.png" class="btn btn-secondary" download>Download QrCode</a>
                                    <a href="<?php echo base_url('user/payment/' . $tiket) ?>" class="btn btn-primary">Cek Pembayaran</a>
                                    <br>
                                    <p class="card-text">Mohon Simpan Kode Pemesanan Dan QrCode Anda Untuk Melanjutkan Proses Pembayaran.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
    <footer class="footer pt-3">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,

                        <a href="" class="font-weight-bold" target="">Liga1-Tix</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>

    <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url(); ?>/assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

</html>