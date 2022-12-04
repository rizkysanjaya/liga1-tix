<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/img/favicon.png">
    <title>
        Edit Pertandingan | Liga1-Tix
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url(); ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url(); ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url(); ?>/assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?> " rel="stylesheet">
    <!-- Page level plugins -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

</head>

<body class="g-sidenav-show  bg-gray-100">
    <?= $this->include('admin/layouts/sidebar') ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?= $this->include('admin/layouts/navbar-data') ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4>Edit Pertandingan</h4>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
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
                            <form class="p-md-4" action="<?= base_url('admin/data/edit/update_pertandingan/' . $pertandingan->id) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Team 1</label>
                                            <select name="kd_team1" class="form-control <?= $validation->hasError('kd_team1') ? 'is-invalid' : null ?>" id="">
                                                <option disabled>-- Team 1 --</option>
                                                <option value="<?= $team1->kd_team ?>" selected><?= $team1->nama_team ?> </option>

                                                <?php foreach ($teams as $team) : ?>
                                                    <option value="<?= $team->kd_team ?>"><?= $team->nama_team ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Team 2</label>
                                            <select name="kd_team2" class="form-control <?= $validation->hasError('kd_team2') ? 'is-invalid' : null ?>" id="">
                                                <option disabled>-- Team 2 --</option>
                                                <option value="<?= $team2->kd_team ?>" selected><?= $team2->nama_team ?></option>
                                                <?php foreach ($teams as $team) : ?>
                                                    <option value="<?= $team->kd_team ?>"><?= $team->nama_team ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Stadion</label>
                                            <select name="kd_stadion" class="form-control <?= $validation->hasError('kd_stadion') ? 'is-invalid' : null ?>" id="">

                                                <option disabled>-- Stadion --</option>
                                                <option value="<?= $stadion->kd_stadion ?>" selected><?= $stadion->nama_stadion ?> | Kapasitas : <?= $stadion->kapasitas ?> </option>
                                                <?php foreach ($stadions as $stadion) : ?>
                                                    <option value="<?= $stadion->kd_stadion ?>"><?= $stadion->nama_stadion ?> | Kapasitas : <?= $stadion->kapasitas ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Banner Match Image (1920x1080)</label>
                                            <input type="file" class="form-control <?= $validation->hasError('banner_match') ? 'is-invalid' : null ?>" name="banner_match">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Tanggal Pertandingan</label>
                                            <input type="date" name="tanggal" class="form-control <?= $validation->hasError('tanggal') ? 'is-invalid' : null ?>" value="<?= $pertandingan->tanggal ?>" min="2022-01-01" max="2099-12-31">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Jam Pertandingan</label>
                                            <input type="time" value="<?= $pertandingan->waktu ?>" name="waktu" class="form-control <?= $validation->hasError('waktu') ? 'is-invalid' : null ?>" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Harga Tribun Timur</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="number" name="harga_tb_timur" class="form-control <?= $validation->hasError('harga_tb_timur') ? 'is-invalid' : null ?>" id="" value="<?= $pertandingan->harga_tb_timur ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Harga Tribun VVIP</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="number" name="harga_tb_vvip" class="form-control <?= $validation->hasError('harga_tb_vvip') ? 'is-invalid' : null ?>" id="" value="<?= $pertandingan->harga_tb_vvip ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Harga Tribun Barat</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="number" name="harga_tb_barat" class="form-control <?= $validation->hasError('harga_tb_barat') ? 'is-invalid' : null ?>" id="" value="<?= $pertandingan->harga_tb_barat ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="team1">Harga Tribun VIP</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="number" name="harga_tb_vip" class="form-control <?= $validation->hasError('harga_tb_vip') ? 'is-invalid' : null ?>" id="" value="<?= $pertandingan->harga_tb_vip ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="team1">Status</label>
                                            <select name="status" class="form-control <?= $validation->hasError('status') ? 'is-invalid' : null ?>" id="">
                                                <option disabled>-- Status Pertandingan --</option>
                                                <option value="0" <?= $pertandingan->status == '0' ? 'selected' : null ?>>Belum Dimulai</option>
                                                <option value="1" <?= $pertandingan->status == '1' ? 'selected' : null ?>>Sedang Berlangsung</option>
                                                <option value="2" <?= $pertandingan->status == '2' ? 'selected' : null ?>>Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="team1">Skor Team 1</label>
                                                    <input type="number" name="skor_team1" class="form-control <?= $validation->hasError('skor_team1') ? 'is-invalid' : null ?>" id="" value="<?= $pertandingan->skor_team1 ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="team1">Skor Team 2</label>
                                                    <input type="number" name="skor_team2" class="form-control <?= $validation->hasError('skor_team2') ? 'is-invalid' : null ?>" id="" value="<?= $pertandingan->skor_team2 ?>">
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card fixed-plugin">
                                    <div class="card-header d-flex justify-content-center mb-3">
                                        <img src="<?= base_url('/assets/img/banner/' . $pertandingan->banner_image) ?>" class="img-fluid border-radius-lg">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description d-flex justify-content-center mb-3">
                                            <?= $pertandingan->banner_image ?>
                                        </p><br>
                                        <small>
                                            *Kosongkan field upload jika tidak ingin mengubah banner
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn bg-gradient-success">
                        Submit
                    </button>
                    <button type="reset" class="btn bg-gradient-warning">
                        Clear
                    </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/chartjs.min.js"></script>

    <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins/chartjs.min.js"></script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".user_image").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url(); ?>/assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

</html>