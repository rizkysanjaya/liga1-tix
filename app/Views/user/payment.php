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
                        <div class="col-lg-12">
                            <!-- Default Card Example -->
                            <div class="card mb-5">
                                <div class="card-header" align="center">
                                    <b><i class="fa fa-ticket"></i> KODE ORDER <?= $tiket->kd_order; ?></b>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No Tiket</th>
                                                    <th scope="col">Kode Pertandingan</th>
                                                    <th scope="col">Jadwal Match</th>
                                                    <th scope="col">Kategori Tribun</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <?php $now = hari_indo(date('N', strtotime($tiket->tanggal))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $tiket->tanggal . ''))) . ', ' . date('H:i', strtotime($tiket->waktu)); ?>
                                                    <th scope="row"><?= $tiket->kd_tiket ?></th>
                                                    <td><?= $tiket->kd_pertandingan ?></td>
                                                    <td><?= $now ?></td>
                                                    <td><?= $tiket->tribun ?></td>
                                                    <td><?= $tiket->jml_tiket ?></td>
                                                    <td>Rp <?= $tiket->harga_awal ?></td>
                                                </tr>

                                                <td colspan="6"> <b style="display:flex; justify-content:right;">Total Rp <?php $total = $tiket->jml_tiket * $tiket->harga_awal;
                                                                                                                            echo $total ?></b></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <!-- Default Card Example -->
                            <div class="card">
                                <div class="card-header" align="center">
                                    <i class="fa fa-ticket"></i> Proses Pembayaran
                                </div>
                                <div class="card-body" align="center">
                                    <h4>Segera Menyelesaikan Pembayaran Anda</h4><br>
                                    <p>Batas waktu pembayaran Anda akan berakhir pada</p>
                                    <h2 id="expired">

                                    </h2>
                                    <p>(Sebelum <?php $payexpired = hari_indo(date('N', strtotime($tiket->expired))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $tiket->expired . ''))) . ', ' . date('H:i', strtotime($tiket->expired));
                                                echo $payexpired; ?>)</p>
                                    <hr>
                                    <div class="medium-title col-12 mb-20">
                                        <h4>
                                            <p>Silahkan transfer pembayaran ke nomor rekening berikut ini</p>
                                        </h4>
                                    </div>
                                    <div class="col-lg-10 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-3 col-4 mb-xs-10 pr-xs-0">
                                                <img src="<?= base_url('assets/img/bank/' . $tiket->logo_bank)  ?>" height="50" width="100" alt="Icon Bank" />
                                            </div>
                                            <div class="col-md-6 col-8 mb-xs-12">
                                                <input type="hidden" name="" id="myInput" value="<?= $tiket->no_rekening ?> an <?= $tiket->atas_nama ?>">
                                                <h3 id="myInput"><?= number_format((float)($tiket->no_rekening), 0, "-", "-"); ?>
                                                    <br>

                                                    </h4>

                                            </div>
                                            <div class="col-md-3 mt-2">
                                                <p>an
                                                    <strong><?= $tiket->atas_nama ?></strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-20">
                                        <hr>
                                        <h4><b>
                                                Sebesar
                                            </b></h4>
                                    </div>
                                    <div class="col-12">
                                        <h1 class="mb-20">
                                            Rp <?= number_format($total, 0, ',', '.'); ?>,-
                                        </h1>
                                    </div>
                                    <div class="col-14 mt-15 mb-15">
                                        <hr>
                                        <div class="col-md-8 mt-sm-30">
                                            <h3 class="mb-20">PANDUAN PEMBAYARAN</h3>
                                            <br>
                                            <div class="">
                                                <ol class="ordered-list" align="left">
                                                    <li>Masukkan Kartu ATM <?= $tiket->nama_bank ?> Anda</li>
                                                    <li>Masukan PIN ATM Anda</li>
                                                    <li>Pilih Menu Transaksi Lainnya</li>
                                                    <li>Pilih menu Transfer dan Ke Rek <?= $tiket->nama_bank ?></li>
                                                    <li>Masukkan no rekening <?= $tiket->nama_bank ?> yang dituju</li>
                                                    <li>Masukkan Nominal Jumlah Uang yang akan di transfer</li>
                                                    <li>Layar ATM akan menampilkan data transaksi anda ,</li>
                                                    <li>Jika data sudah benar pilih “YA” (OK)</li>
                                                    <li>Selesai (struk akan keluar dari mesin ATM)</li>
                                                    <li>Ambil Kartu ATM anda</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-primary " id="btnKonfirm">
                                        <a class="text-white" href="<?= base_url('user/konfirmasi/' . $tiket->kd_order . '/' . $total) ?>" id="btnKonfirm">Konfirmasi Pembayaran </a>
                                    </button>

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
    <!-- js -->
    <?php $expired1 = tanggal_ing(date('Y-m-d', strtotime($tiket->expired))) . ', ' . date('Y', strtotime($tiket->expired)) . ' ' . date('H:i', strtotime($tiket->expired)) ?>

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?= $expired1 ?>").getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get todays date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="demo"
            document.getElementById("expired").innerHTML = hours + " Jam : " +
                minutes + " Menit : " + seconds + " Detik ";
            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("expired").innerHTML = "Waktu Pembayaran Selesai";
                document.getElementById("btnKonfirm").disabled = true;
            }
        }, 1000);
    </script>


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