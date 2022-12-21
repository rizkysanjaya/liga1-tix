<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">

      <?php $uri = current_url(true);
      ?>

      <?php if ($uri->getSegment(1) === 'admin') {
      } ?>
      <h6 class="font-weight-bolder mb-0"><?= ucfirst($uri->getSegment(2)); ?> <?= ucfirst($uri->getSegment(3)); ?></h6>
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
        <li class="nav-item px-3 d-flex align-items-center">

        </li>
        <li class="nav-item dropdown pe-2 d-flex align-items-center">

        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->