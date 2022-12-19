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
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show m-md-4" role="alert">

                <span class="alert-text"><strong>Periksa Entrian Form</strong> </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo session()->getFlashdata('error'); ?>

            </div>
        <?php endif; ?>
        <main class="main-content mt-1 border-radius-lg">
            <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-9">
                <div class="container">
                    <div class="row">
                        <!-- Default Card Example -->
                        <div class="col-md-12">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <i class="fa fa-info-circle"></i> Keterangan Match
                                </div>
                                <div class="card-body">
                                    <div class="card card-profile card-plain">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <a href="javascript:;">
                                                    <div class="position-relative">
                                                        <div class="blur-shadow-image">
                                                            <img class="wm-800 hm-500 rounded-3 shadow-lg" src="<?= base_url('assets/img/banner/' . $pertandingan->banner_image) ?>">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-7 ps-0 my-auto">
                                                <div class="card-body text-left">
                                                    <div class="p-md-0 pt-3">
                                                        <h5 class="font-weight-bolder mb-0">Team
                                                            <b><?= $team1->nama_team . " VS " . $team2->nama_team ?></b>
                                                        </h5>
                                                        <p class="text-uppercase text-sm font-weight-bold mb-2">Stadion <b><?= $stadion->nama_stadion  ?></b></p>
                                                    </div>
                                                    <ul class="list-inline">
                                                        <li>► Match Day <b><?= nama_hari($pertandingan->tanggal) . "," . tgl_indo($pertandingan->tanggal) ?></b></li>
                                                        <li>► Jam <b>pukul <?= $pertandingan->waktu ?> WIB</b></li>

                                                        <li>► Silahkan pilih tribun pada menu selanjutnya</li>
                                                        <li>► *Dalam satu transaksi max 4 tiket</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <!-- Default Card Example -->
                            <div class="card mb-5">
                                <div class="card-header">
                                    <i class="fa fa-chair"></i> Identitas Pemesan
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('user/gettiket/') ?>" method="post">
                                        <div class="form-control mb-3">
                                            <input type="hidden" name="kd_pertandingan" value="<?= $pertandingan->kd_pertandingan ?>">


                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 pl-5">
                                                    <h5>Kategori Tribun : &nbsp; <strong><?= strtoupper($tribun) ?></strong></h5>
                                                    <h5>Jumlah Tiket : &nbsp; <strong><?= $tiket ?></strong></h5>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="team1">Email</label>
                                                    <input type="email" name="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : null ?>" value="<?= old('email') ?>" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="team1">No. Telp</label>
                                                    <input type="number" name="no_tlp" class="form-control <?= $validation->hasError('no_tlp') ? 'is-invalid' : null ?>" value="<?= old('no_tlp') ?>" required>

                                                </div>

                                            </div>

                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Default Card Example -->
                            <div class="card mb-5">
                                <div class="card-header">
                                    <i class="fa fa-usd"></i> Metode Pembayaran
                                </div>
                                <div class="card-body p-4">
                                    <!-- input hidden -->
                                    <input type="hidden" name="kd_pertandingan" value="<?= $pertandingan->kd_pertandingan ?>">
                                    <input type="hidden" name="tribun" value="<?= strtoupper($tribun) ?>">
                                    <input type="hidden" name="total" value="<?= $total ?>">
                                    <input type="hidden" name="harga" value="<?= $harga ?>">
                                    <input type="hidden" name="jml_tiket" value="<?= $tiket ?>">
                                    <input type="hidden" name="id_user" value="<?= user()->id ?>">
                                    <input type="hidden" name="kd_stadion" value="<?= $pertandingan->kd_stadion ?>">

                                    <div class="row">
                                        <p>
                                            <small>
                                                <?= 'Rp ' . number_format((float)($harga), 0, ",", "."); ?>
                                                &nbsp; X &nbsp; <?= $tiket ?> &nbsp; Tiket
                                            </small>

                                        </p>
                                    </div>
                                    <div class="row">
                                        <h3><small>Total Bayar : </small>&nbsp;
                                            <?= 'Rp ' . number_format((float)($total), 0, ",", "."); ?>
                                        </h3>

                                    </div>
                                    <label for="exampleInputEmail1">Pilih Bank </label>
                                    <select class="form-control <?= $validation->hasError('bank') ? 'is-invalid' : null ?>" name="bank" required>
                                        <option value="" selected disabled="">Pilih Bank</option>
                                        <?php foreach ($bank as $row) { ?>
                                            <option value="<?= $row->kd_bank ?>"><?= $row->nama_bank ?></option>
                                        <?php } ?>
                                    </select>
                                    <hr>
                                    <div class='form-group'>
                                        <a href='javascript:history.back()' class='btn btn-default pull-left'>Kembali</a>
                                        <button class="btn btn-primary pull-right">Proses Tiket</button>
                                    </div>
                                </div>

                                <form>
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