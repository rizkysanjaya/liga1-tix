
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/img/favicon.png">
  <title>
    Add User | Liga1-Tix
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
              <h4>Add User</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <?php $validation = \Config\Services::validation(); ?>
            <form class="p-md-4" action="<?= url_to('admin/data/create/add-user') ?>" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" name="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : null?>" id="" placeholder="name@mail.com">
                            <!-- Error -->
                  <?php if($validation->getError('email')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('email'); ?>
                      </div>
                  <?php }?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" placeholder="Username" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : null?>" />
                    <!-- Error -->
                  <?php if($validation->getError('username')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('username'); ?>
                      </div>
                  <?php }?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group mb-4">
                    
                    <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="Password" name="password" aria-label="Password" aria-describedby="password-addon" autocomplete="off">
                      <!-- Error -->
                  <?php if($validation->getError('password')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('password'); ?>
                      </div>
                  <?php }?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group mb-4">
                    <input type="password" placeholder="Ulangi Password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" aria-label="Password" aria-describedby="password-addon" autocomplete="off">
                    <!-- Error -->
                  <?php if($validation->getError('pass_confirm')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('pass_confirm'); ?>
                      </div>
                  <?php }?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-success">
                  <input type="text" placeholder="Full Name" name="fullname" class="form-control <?= $validation->hasError('fullname') ? 'is-invalid' : null?>" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-danger">
                <select class="form-control <?= $validation->hasError('role') ? 'is-invalid' : null?>" id="role" name="role">
                  <option value="">- Pilih Role -</option>
                  <option value="1">Admin</option>
                  <option value="2">User</option>
                </select>
                </div>
              </div>
              <!-- Error -->
              <?php if($validation->getError('role')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('role'); ?>
                      </div>
                  <?php }?>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group has-success">
                <textarea class="form-control <?= $validation->hasError('bio') ? 'is-invalid' : null?>" name="bio" placeholder="Bio" id="exampleFormControlTextarea1" rows="3"></textarea>
                  <!-- Error -->
              <?php if($validation->getError('bio')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('bio'); ?>
                      </div>
                  <?php }?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-danger">
                <select class="form-control <?= $validation->hasError('status') ? 'is-invalid' : null?>" id="status" name="status">
                  <option value="">- Pilih Status Keaktifan -</option>
                  <option value="1">Aktif</option>
                  <option value="2">Non-Aktif</option>
                </select>
                </div>
              </div>
              <!-- Error -->
              <?php if($validation->getError('status')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('status'); ?>
                      </div>
                  <?php }?>
            </div>
            <div class="row">
              <!-- <input type="file" id="img" name="img" accept="image/*"> -->
              <div class="col-md-6">
                <input type="file" class="custom-file-input btn btn-outline-info" name="user_image" accept="image/*">  
                <label class="ms-md-3 mb-md-5" for="customFile">Upload Profile Picture</label>
                <!-- Error -->
                <?php if($validation->getError('user_image')) {?>
                      <div class='alert alert-danger mt-2'>
                        <?= $error = $validation->getError('user_image'); ?>
                      </div>
                  <?php }?>
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