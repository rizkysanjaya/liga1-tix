<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/img/favicon">
  <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url(); ?>/assets/img/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url(); ?>/assets/img/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url(); ?>/assets/img/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>/assets/img/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>/assets/img/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url(); ?>/assets/img/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url(); ?>/assets/img/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url(); ?>/assets/img/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>/assets/img/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>/assets/img/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>/assets/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>/assets/img/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/img/favicon-16x16.png">
  <title>
    Login | Liga1-tix
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
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-6 mb-7">
                <div class="card-header pb-0 text-left bg-transparent">

                  <a href="<?= base_url() ?>">
                    <h2 class="font-weight-bolder text-primary text-gradient">Liga1-Tix</h2>
                  </a>

                  <p class="mb-0">Selamat datang. Silahkan login untuk melanjutkan.</p>
                </div>
                <div class="card-body">
                  <div class="mt-3 ml-5 mr-3">
                    <?= view('Myth\Auth\Views\_message_block') ?>

                  </div>

                  <form action="<?= url_to('login') ?>" method="post" role="form">
                    <?= csrf_field() ?>

                    <?php if ($config->validFields === ['email']) : ?>

                      <div class="mb-3">
                        <label>Email atau Username</label>
                        <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" aria-label="Email" aria-describedby="email-addon" name="login">
                        <div class="invalid-feedback">
                          <?= session('errors.login') ?>
                        </div>
                      </div>
                    <?php else : ?>

                      <div class="mb-3">
                        <h6>Username atau email</h6>
                        <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.emailOrUsername') ?>" aria-label="Email" aria-describedby="email-addon" name="login">
                        <div class="invalid-feedback">
                          <?= session('errors.login') ?>
                        </div>
                      </div>
                    <?php endif; ?>

                    <h6>Password</h6>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                      <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                      </div>
                    </div>

                    <?php if ($config->allowRemembering) : ?>
                      <div class="form-check form-switch">
                        <input class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?> type="checkbox" name="remember">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                      </div>
                    <?php endif; ?>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0"><?= lang('Auth.loginAction') ?></button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <?php if ($config->allowRegistration) : ?>
                    <p class="mb-4 text-sm mx-auto">
                      Belum punya akun?
                      <a href="<?= url_to('register') ?>" class="text-primary text-gradient font-weight-bold">Daftar</a>
                    </p>
                  <?php endif; ?>
                  <?php if ($config->activeResetter) : ?>
                    <p class="mb-0 text-sm">
                      <a href="<?= url_to('forgot') ?>" class="text-primary text-gradient font-weight-bold">Lupa password?</a>
                    </p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n7" style="background-image:url('<?= base_url(); ?>/assets/img/curved-images/log-reg2.png')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Liga1-Tix.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="<?= base_url(); ?>/assets/js/core/popper.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="<?= base_url(); ?>/assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

</html>