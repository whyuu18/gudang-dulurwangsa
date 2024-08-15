<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?= $this->include('Layout/header') ?>

  <!-- ======= sidebar ======= -->
  <?= $this->include('Layout/sidebar') ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= $title ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?= $this->renderSection('content') ?>

  </main><!-- End #main -->

  <!-- footer -->
  <?= $this->include('Layout/footer') ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/php-email-form/validate.js"></script>
  <!-- ajax -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>/assets/js/main.js"></script>

  <!-- periode -->
  <script>
    // membuat kode untuk kode data kriiteria
    $(document).ready(function() {
      $.ajax({
        url: "<?= site_url('kriteria/kode') ?>",
        type: "GET",
        success: function(hasil) {
          // alert(hasil);
          var obj = $.parseJSON(hasil);
          $('#kodeKriteria').val(obj);
        }
      });
    });
  </script>

  <script>
    // alternatif
    document.getElementById('bulan').onchange = changePeriode;
    document.getElementById('tahun').onchange = changePeriode;

    function changePeriode() {
      var bulan = document.getElementById('bulan').value;
      var tahun = document.getElementById('tahun').value;
      if (bulan != '#' && tahun != '#') {
        window.location.href = `<?= base_url() ?>alternatif/periode/${bulan}/${tahun}`;
      }
    }
  </script>
  <script>
    // penilaian
    document.getElementById('bulanA').onchange = changePeriodeA;
    document.getElementById('tahunA').onchange = changePeriodeA;

    function changePeriodeA() {
      var bulan = document.getElementById('bulanA').value;
      var tahun = document.getElementById('tahunA').value;
      if (bulan != '#' && tahun != '#') {
        window.location.href = `<?= base_url() ?>penilaian/periode/${bulan}/${tahun}`;
      }
    }
  </script>
  <script>
    // perhitungan
    document.getElementById('bulanP').onchange = changePeriodeP;
    document.getElementById('tahunP').onchange = changePeriodeP;

    function changePeriodeP() {
      var bulan = document.getElementById('bulanP').value;
      var tahun = document.getElementById('tahunP').value;
      if (bulan != '#' && tahun != '#') {
        window.location.href = `<?= base_url() ?>perhitungan/periode/${bulan}/${tahun}`;
      }
    }
  </script>
  <script>
    // hasil
    document.getElementById('bulanH').onchange = changePeriodeH;
    document.getElementById('tahunH').onchange = changePeriodeH;

    function changePeriodeH() {
      var bulan = document.getElementById('bulanH').value;
      var tahun = document.getElementById('tahunH').value;
      if (bulan != '#' && tahun != '#') {
        window.location.href = `<?= base_url() ?>hasil/periode/${bulan}/${tahun}`;
      }
    }
  </script>


  <!-- popup confirm perhitungan -->
  <script>
    $(document).ready(function() {
      // Ketika form hendak disubmit
      $('#formHasil').on('submit', function(e) {
        // Mencegah form disubmit secara default
        e.preventDefault();

        // Tampilkan alert konfirmasi
        var confirmSave = confirm("Apakah Anda yakin ingin menyimpan hasil perhitungan?");

        if (confirmSave) {
          // Jika pengguna klik "OK", submit form
          this.submit();
        }
        // Jika pengguna klik "Cancel", tidak terjadi apa-apa
      });
    });
  </script>

</body>

</html>