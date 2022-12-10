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
    <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">

        <main class="main-content mt-1 border-radius-lg">
            <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-9">

                <!-- Default Card Example -->
                <div class="card mb-5">
                    <div class="card-header">
                        <i class="fa fa-list-alt"></i> Daftar Match
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">kode match</th>
                                        <th>Team</th>
                                        <th scope="col">Stadion</th>
                                        <th scope="col">tanggal</th>
                                        <th>waktu</th>
                                        <th scope="col">banner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pertandingans as $pertandingan) : ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="<?= base_url(); ?>/assets/img/banner/<?= $pertandingan->banner_image ?>" class="avatar avatar-sm me-3" alt="pertandingan1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $pertandingan->kd_team1;
                                                                                    $pertandingan->kd_team2 ?></h6>
                                                        <p class="text-xs text-secondary mb-0"><?= $pertandingan->kd_pertandingan ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <!-- css table belum rapih yang deskripsi-->
                                                <div class="d-flex px-2 py-1">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <?= $pertandingan->skor_team1;
                                                        $pertandingan->skor_team2;  ?>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <p class="text-xs font-weight-bold mb-0"><?= $pertandingan->kd_stadion ?></p>
                                            </td>
                                            <td>

                                                <a class="btn btn-outline-info" href="<?= base_url('user/before-order/' . $pertandingan->id) ?>">
                                                    Pesan
                                                </a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <a href="<?php echo base_url('landpage') ?>" class="btn btn-primary pull-left">Kembali </a>
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
                        made with <i class="fa fa-heart"></i> by
                        <a href="" class="font-weight-bold" target="_blank">Liga1-Tix</a>
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