<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
  <title>
    Profile | Liga1-Tix
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url('assets/css/nucleo-icons.css" rel="stylesheet') ?>" />
  <link href="<?= base_url('assets/css/nucleo-svg.css" rel="stylesheet') ?>" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url('assets/css/nucleo-svg.css" rel="stylesheet') ?>" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('assets/css/soft-ui-dashboard.css?v=1.0.6') ?>" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">


  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <?= $this->include('pages/layouts/navbar') ?>

    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?= base_url('assets/img/curved-images/curved0.jpg') ?>'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?= base_url('assets/img/user_profile/' . user()->user_image) ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?= user()->fullname ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                <?= user()->email ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
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
          <?php if (!empty(session()->getFlashdata('message'))) : ?>
            <div class="alert alert-success alert-dismissible fade show m-md-4" role="alert">

              <span class="alert-text"><strong>Success!</strong> </span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <?php echo session()->getFlashdata('message'); ?>

            </div>
          <?php endif; ?>
        </div>
        <div class="col-12 col-xl-6">


          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="" data-bs-toggle="modal" data-bs-target="#viewModal-<?= user()->id ?>">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">


              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Bio:</strong> <br>
                  <p class="text-sm">
                    <?= user()->bio ?>
                  </p>
                </li>
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?= user()->fullname ?> </li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?= user()->email ?></li>


              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-6">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Tiket Saya</h6>
                </div>
                <div class="col-6 text-end">
                  <!-- <button class="btn btn-outline-primary btn-sm mb-0">
                    View All
                  </button> -->
                </div>
              </div>
            </div>
            <div class="card-body p-3 pb-0">
              <?php if (!isset($tiket)) : ?>
                <!-- jika data  tidak ada  -->
                <div class="alert alert-warning" role="alert">
                  <h4 class="alert-heading">Belum ada tiket</h4>
                  <p>Maaf, data yang anda cari tidak ditemukan.</p>
                  <hr>
                </div>
              <?php else : ?>
                <table class="table align-items-center mb-2">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>

                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php foreach ($tiket as $t) : ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <a href="<?= base_url('assets/img/qrcode/' . $t->qrcode) ?>" class="" title="Download QRcode" download>
                                <img src="<?= base_url('assets/img/qrcode/' . $t->qrcode) ?>" class="avatar avatar-sm me-3" alt="user1" />
                              </a>

                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $t->kd_order ?></h6>
                              <p class="text-xs text-secondary mb-0">
                                <?= $t->tgl_order ?>
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <?php if ($t->status == '1') { ?>
                            <span class="badge badge-sm bg-gradient-secondary">Pending</span>
                          <?php } else { ?>
                            <span class="badge badge-sm bg-gradient-success">Lunas</span>
                          <?php } ?>
                        </td>
                        <td class="align-middle">
                          <?php if ($t->status == '1') { ?>
                            <a href="<?php echo base_url('user/payment/' . $t->kd_order) ?>" class="btn btn-primary">Cek Pembayaran</a>
                          <?php } else { ?>
                            <a href="<?php echo base_url('user/etiket/download/' . $t->kd_order) ?>" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" data-toggle="tooltip">
                              <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                            </a>

                          <?php } ?>

                        </td>
                      </tr>
                    <?php endforeach; ?>


                  </tbody>
                </table>

              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mt-4">


        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,

                <a class="font-weight-bold" target="">Liga1-Tix</a>

              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <div class="modal fade" id="viewModal-<?= user()->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="p-md-4" action="<?= base_url('user/profile/update_profile/' . user()->id) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="team1">Email</label>
                  <input type="text" name="email" class="form-control" placeholder=" Email" value="<?= user()->email; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="team1">Username</label>
                  <input type="text" placeholder="Username" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : null ?>" value="<?= user()->username ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="team1">Fullname</label>
                  <input type="text" placeholder="Fullname" name="fullname" class="form-control <?= $validation->hasError('fullname') ? 'is-invalid' : null ?>" value="<?= user()->fullname ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="team1">Bio</label>
                  <textarea class="form-control <?= $validation->hasError('bio') ? 'is-invalid' : null ?>" name="bio" placeholder="Bio" id="exampleFormControlTextarea1" rows="4"><?= user()->bio ?></textarea>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="customFile">Upload Users Profile Image</label>
                  <input type="file" class="form-control <?= $validation->hasError('user_image') ? 'is-invalid' : null ?>" name="user_image" placeholder="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <p class="card-description d-flex justify-content-center mb-3">
                    *Kosongkan jika tidak ingin mengubah profile image
                  </p>
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
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>


    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js') ?>"></script>
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
    <script src="<?= base_url('assets/js/soft-ui-dashboard.min.js?v=1.0.6') ?>"></script>
</body>

</html>