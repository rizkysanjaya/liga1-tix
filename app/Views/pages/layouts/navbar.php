<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <a class="navbar-brand m-0" href="<?= base_url() ?>">
        <img src="<?= base_url(); ?>/assets/img/logo-ct.png" class="avatar avatar-sm  me-3 " alt="main_logo">
        <span class="ms-1 font-weight-bold">Liga1-Tix</span>
      </a>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>


        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user cursor-pointer bg-gradient-light border-radius-md p-2"></i>
          </a>
          <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <?php if (logged_in()) : ?>

              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="<?= base_url('user/profile/' . user()->id) ?>">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="<?= base_url('assets/img/user_profile/' . user()->user_image) ?>" class="avatar avatar-sm  me-3 ">


                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">Profil Saya</span>
                      </h6>
                    </div>
                  </div>
                </a>
              </li>
            <?php else : ?>

            <?php endif; ?>

            <?php if (logged_in()) : ?>
              <li>
                <a class="dropdown-item border-radius-md" href="<?= base_url('logout') ?>">
                  <div class="d-flex py-1">
                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                      <i class="fa fa-sign-out cursor-pointer p-2"></i>

                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        Logout
                      </h6>

                    </div>
                  </div>
                </a>
              </li>
            <?php else : ?>
              <li>
                <a class="dropdown-item border-radius-md" href="<?= base_url('login') ?>">
                  <div class="d-flex py-1">
                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                      <i class="fa fa-sign-in cursor-pointer p-2"></i>

                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        Login
                      </h6>

                    </div>
                  </div>
                </a>
              </li>
            <?php endif; ?>

          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->