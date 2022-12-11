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

        <main class="main-content mt-1 border-radius-lg">
            <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-9">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <?php if (!empty(session()->getFlashdata('message'))) : ?>
                            <div class="alert alert-danger alert-dismissible fade show m-md-4" role="alert">

                                <span class="alert-text"><strong>Periksa Entrian Form</strong> </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo session()->getFlashdata('message'); ?>

                            </div>
                        <?php endif; ?>
                        <div class="col-lg-8">
                            <!-- Default Card Example -->
                            <div class="card mb-5">
                                <div class="card-header">
                                    Konfirmasi Pembayaran
                                </div>
                                <?php $validation = \Config\Services::validation(); ?>

                                <div class="card-body">
                                    <form action="<?= base_url('user/insertkonfirmasi') ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kode Order</label>
                                            <input type="text" id="" class="form-control <?= $validation->hasError('kd_order') ? 'is-invalid' : null ?>" id="" name="kd_order" value="<?= $id ?>" placeholder="Kode Tiket" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">BANK Kamu</label>
                                            <select class="form-control <?= $validation->hasError('bank_km') ? 'is-invalid' : null ?>" name="bank_km">
                                                <option value="" selected disabled="">Pilih Bank</option>
                                                <option value="BCA">BCA</option>
                                                <option value="Mandiri">Mandiri</option>
                                                <option value="BNI">BNI</option>
                                                <option value="BRI">BRI</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor Rekening</label>
                                            <input type="number" class="form-control <?= $validation->hasError('nomrek') ? 'is-invalid' : null ?>" name="nomrek" value="" placeholder="Nomor Rekening">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Pengirim</label>
                                            <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" name="nama" value="" placeholder="Nama Pengirim">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Pembayaran</label>
                                            <input type="number" class="form-control <?= $validation->hasError('total') ? 'is-invalid' : null ?>" name="total" value="<?= $total ?>" placeholder="Total Harga" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Upload Bukti Transaksi</label>
                                            <input type="file" class="form-control <?= $validation->hasError('userfile') ? 'is-invalid' : null ?>" name="userfile" required="">
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Konfirmasi </button>
                                    </form>
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