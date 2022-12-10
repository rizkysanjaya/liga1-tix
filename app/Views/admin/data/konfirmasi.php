<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/img/favicon.png">
  <title>
    <?= $title ?> | Liga1-Tix
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
              <h4>List Konfirmasi Order</h4>

              <?php if (!empty(session()->getFlashdata('message'))) : ?>
                <div class="alert alert-success alert-dismissible fade show m-md-4" role="alert">

                  <span class="alert-text"><strong>Success</strong> </span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <?php echo session()->getFlashdata('message'); ?>

                </div>
              <?php endif; ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

              <div class="table-responsive p-md-3">
                <table class="table align-items-center mb-0" id="dataTable" style="table-layout:auto">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KD Konfirm & Order</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pengirim</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bank</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Rek</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Harga</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($konfirmasi as $k) : ?>

                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">

                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $k['kd_konfirm']; ?></h6>
                              <p class="text-xs text-secondary mb-0"><?= $k['kd_order']; ?></p>
                            </div>
                          </div>
                        </td>
                        <td>

                          <!-- css table belum rapih yang deskripsi-->
                          <div class="d-flex px-2 py-1">
                            <p class="text-xs font-weight-bold mb-0">
                              <?= $k['nama']; ?>
                            </p>
                          </div>
                        </td>
                        <td class="align-middle text-sm">
                          <p class="text-xs font-weight-bold mb-0"><?= $k['nama_bank']; ?></p>
                        </td>
                        <td class="align-middle text-sm">
                          <p class="text-xs font-weight-bold mb-0"><?= $k['no_rek']; ?></p>
                        </td>
                        <td class="align-middle text-sm">
                          <p class="text-xs font-weight-bold mb-0"><?= $k['jml_transfer']; ?></p>
                        </td>
                        <td>
                          <a class="btn bg-gradient-info" href="<?= base_url('admin/data/konfirmasi/view-konfirm/' . $k['kd_order']) ?>">
                            Lihat
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
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

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url(); ?>/assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        pagingType: "simple_numbers",
        language: {
          oPaginate: {
            sNext: '<i class="fa fa-angle-right"></i>',
            sPrevious: '<i class="fa fa-angle-left"></i>',
            sFirst: '<i class="fa fa-step-backward"></i>',
            sLast: '<i class="fa fa-step-forward"></i>'
          }
        }
      });
    });
  </script>
</body>


</html>