<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/img/favicon.png">
  <title>
    User | Liga1-Tix
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
              <h4>User table</h4>
              <a href="<?= base_url('/admin/data/create/add-user') ?>">
                <button type="button" class="btn bg-gradient-primary">Add User</button>
              </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <script>
                $(document).ready(function() {
                  $('#dataTable').DataTable();
                });
              </script>
              <div class="table-responsive p-md-3">
                <table class="table align-items-center mb-0" id="dataTable" width="100%">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fullname</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>

                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>

                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($users as $key => $user) : ?>

                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?= base_url(); ?>/assets/img/user_profile/<?= $user->user_image ?>" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $user->username ?></h6>
                              <p class="text-xs text-secondary mb-0"><?= $user->email ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?= $user->fullname ?></p>
                          <p class="text-xs text-secondary mb-0"><?= $user->created_at ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"><?= $user->email ?></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                        </td>
                        <td class="align-middle">
                          <button type="button" class="btn btn-outline-info">
                            <a class="nav-link href=" <?= base_url('admin/data/stadion') ?>">
                              <i class="fas fa-edit"></i>
                            </a>
                          </button>
                          <button type="button" class="btn btn-outline-danger">
                            <a class="nav-link href=" <?= base_url('admin/data/stadion') ?>">
                              <i class="fas fa-trash"></i>
                            </a>
                          </button>
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
</body>

</html>