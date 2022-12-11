<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        <?= $title ?> | Liga1-Tix
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100 virtual-reality">
    <div>
        <?= $this->include('pages/layouts/navbar') ?>

    </div>
    <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/curved-images/bg-color.png') ; background-size: cover;">

        <main class="main-content mt-1 border-radius-lg">
            <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-9">

                <!-- Default Card Example -->
                <div class="card mb-5">
                    <div class="card-header">
                        <i class="fa fa-list-alt"></i> Daftar Match
                        <a href="<?php echo base_url('user/landpage') ?>" class="btn btn-primary ml-10 justify-content-end">Kembali </a>
                    </div>
                    <div class="card-body">

                        <!-- jika data tidak ada : -->
                        <?php if (!isset($pertandingans)) : ?>
                            <div class="alert alert-warning" role="alert">
                                Belum Ada Pertandingan Yang Diadakan, Stay Tuned!
                            </div>

                        <?php else : ?>
                            <?php foreach ($pertandingans as $pertandingan) : ?>

                                <div class="card">
                                    <!-- Card image -->
                                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                        <img class="border-radius-lg w-100" src="<?= base_url(); ?>/assets/img/banner/<?= $pertandingan->banner_image ?>" alt="Image placeholder">
                                        <!-- List group -->
                                        <ul class="list-group list-group-flush mt-2">
                                            <li class="list-group-item">
                                                <h4 class="card-title mb-3"><?= nama_hari($pertandingan->tanggal) . ",  " . tgl_indo($pertandingan->tanggal) ?></h4>
                                                <span class="badge badge-sm bg-gradient-warning card-title mb-3">
                                                    <?= " pukul" . $pertandingan->waktu ?>
                                                </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <h3 class="card-title mb-3"><?= $pertandingan->nama_team1 . ' VS ' .
                                                                        $pertandingan->nama_team2 ?></h3>

                                        <a class="btn bg-gradient-primary" href="<?= base_url('user/before-order/' . $pertandingan->id) ?>">
                                            Pesan
                                        </a>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>

                        <?php endif; ?>
                        <br>


                    </div>
                </div>
        </main>
    </div>
    <footer class="footer pt-3  ">
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
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

</html>