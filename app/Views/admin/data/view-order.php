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

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    #myImg:hover {
      opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 100px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.9);
      /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      text-align: center;
      color: #ccc;
      padding: 10px 0;
      height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
      -webkit-animation-name: zoom;
      -webkit-animation-duration: 0.6s;
      animation-name: zoom;
      animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
      from {
        -webkit-transform: scale(0)
      }

      to {
        -webkit-transform: scale(1)
      }
    }

    @keyframes zoom {
      from {
        transform: scale(0)
      }

      to {
        transform: scale(1)
      }
    }

    /* The Close Button */
    .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }

    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
      .modal-content {
        width: 100%;
      }
    }
  </style>

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
              <h4>Kode Order [<?= $tiket[0]['kd_order']; ?>]</h4>

              <?php if (!empty(session()->getFlashdata('message'))) : ?>
                <div class="alert alert-info alert-dismissible fade show m-md-4" role="alert">

                  <span class="alert-text"><strong>Info</strong> </span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <?php echo session()->getFlashdata('message'); ?>

                </div>
              <?php endif; ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-md-3">
                <form action="<?= base_url('admin/data/order/inserttiket')  ?>" method="post" enctype="multipart/form-data">

                  <div class="card-body">
                    <div class="row">

                      <input type="hidden" class="form-control" name="kd_order" value="<?= $tiket[0]['kd_order'] ?>" readonly>
                      <input type="hidden" class="form-control" name="kd_tiket" value="<?= $tiket[0]['kd_tiket'] ?>" readonly>
                      <div class="col-sm-6">
                        <h5>Kode Tiket <b><?= $tiket[0]['kd_tiket'] ?></b></h5>
                        <hr>
                        <div class="row form-group">
                          <label for="nama" class="col-sm-12 control-label">Kode Pertandingan</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" name="kd_jadwal" value="<?= $tiket[0]['kd_pertandingan'] ?>" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label for="nama" class="col-sm-12 control-label">Email Pemesan</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" name="email" value="<?= $tiket[0]['email'] ?>" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label for="" class="col-sm-12 control-label">Jumlah Tiket</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" name="no_kursi" value="<?= $tiket[0]['jml_tiket'] ?>" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label for="" name="total" class="col-sm-12 control-label">Harga Tiket <small>*Satuan</small> </label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" name="harga" value="<?php echo $tiket[0]['harga_awal']; ?>" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label for="" class="col-sm-12 control-label">Batas Pembayaran</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" name="expired" value="<?= hari_indo(date('N', strtotime($tiket[0]['expired']))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $tiket[0]['expired'] . ''))) . ', ' . date('H:i', strtotime($tiket[0]['expired']));  ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="row form-group">
                          <label for="" class="col-sm-6 control-label">Cek Konfirmasi Pembayaran</label>
                          <div class="col-sm-12">
                            <a href="<?= base_url('admin/data/konfirmasi/view-konfirm/' . $tiket[0]['kd_order']) ?>" class="btn btn-secondary">Lihat</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="row form-group">
                          <label for="" class="col-sm-12 control-label">Status</label>
                          <div class="col-sm-12">
                            <?php if ($tiket[0]['status'] == '1') { ?>
                              <select class="form-control" name="status" required>
                                <option value='' selected disabled>Belum Bayar</option>
                                <option value='2'>Sudah Bayar</option>
                              </select>
                            <?php } elseif ($tiket[0]['status'] == '2') { ?>
                              <span class="badge badge-sm bg-gradient-success">Sudah Bayar</span>

                            <?php } ?>

                          </div>
                        </div>
                        <div class="row form-group">

                          <label for="" class="col-sm-12 control-label">Total Pembayaran</label>
                          <div class="col-sm-12">
                            <p><b>Rp <?php $total =
                                        $tiket[0]['jml_tiket'] * $tiket[0]['harga_awal'];
                                      echo number_format($total) ?></b></p>
                            </select>
                          </div>
                          <input type="hidden" name="total" value="<?= $total ?>">
                        </div>
                      </div>
                    </div>
                    <hr><a class="btn btn-default float-left" href="<?= base_url('admin/data/order') ?>"> Kembali</a>
                    <?php if ($tiket[0]['status'] == '1') { ?>
                      <button type="submit" class="btn btn-info float-right">Proses</button>
                    <?php } else { ?>
                      <a class="btn btn-primary float-right" href="<?= base_url('assets/etiket/' . $tiket[0]['kd_order']) ?>" target="_blank"> Cetak Eticket</a> &nbsp;
                      <a class="btn btn-success float-right" href="<?= base_url('admin/order/kirimemail/' . $tiket[0]['kd_order']) ?>"> Kirim Eticket</a>
                    <?php } ?>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>

  <!-- The Modal -->
  <div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>
  <!-- js -->
  <script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
  </script>
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