<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style_pages.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/fontawesome-free-6.1.1-web/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title><?= $judul; ?></title>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">Analisis Sentimen</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url() ?>Dataset"><i class="fa fa-table"></i> Dataset</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url() ?>Klasifikasi"><i class="fa-solid fa-code-merge"></i> Klasifikasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url() ?>PerformaKoeman"><i class="fa-solid fa-chart-column"></i> Performa Ronald Koeman</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>