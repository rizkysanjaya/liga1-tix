<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/img/favicon.png">
  <title>
    Add Team | Liga1-Tix
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
  <!----===== Import Datatables===== -->
  <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
         -->

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
              <h4>Add Team</h4>
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
              <form class="p-md-4" action="<?= base_url('admin/data/create/saveteam') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="nama_team" class="form-control <?= $validation->hasError('nama_team') ? 'is-invalid' : null ?>" id="" placeholder="Nama Team">
                      <!-- Error -->

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" placeholder="Kota" name="kota" class="form-control <?= $validation->hasError('kota') ? 'is-invalid' : null ?>" />
                      <!-- Error -->

                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : null ?>" name="deskripsi" placeholder="Deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customFile">Upload Team Logo (256x256)</label>
                      <input type="file" class="form-control <?= $validation->hasError('logo') ? 'is-invalid' : null ?>" name="logo">

                    </div>
                  </div>
                </div>

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