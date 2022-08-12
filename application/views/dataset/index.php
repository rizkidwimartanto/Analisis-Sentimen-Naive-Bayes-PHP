<div class="content container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dataset</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Dataset</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_training')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_training');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url() ?>Dataset/validation_form" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="penulis">Penulis</label>
                      <input type="text" class="form-control" id="penulis" name="penulis">
                    </div>
                    <div class="form-group">
                      <label for="komentar">Komentar</label>
                      <input type="text" class="form-control" id="komentar" name="komentar">
                    </div>

                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->
          <div class="card-body">
            <label class="mt-2">Import File Excel</label>
            <form action="<?= site_url('Dataset/import_excel') ?>" method="post" enctype="multipart/form-data">
              <div class="input-group mb-3">
                <!-- Upload File -->
                <input name="uploadFile" class="form-control" type="file" accept=".xls,.xlsx,.csv" required>
                <button class="btn btn-primary input-group-text" type="submit" for="inputGroupFile02"><i class="fa fa-upload"></i> Upload</button>
              </div>
            </form>
            <form action="<?php echo base_url() ?>Dataset/hapusSemuaData" method="post" class="d-inline">
              <input type="hidden" name="_method" value="DELETE">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i> Hapus Semua Data</button>
              </div>
            </form>
            <table id="datatable_dataset" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Penulis</th>
                  <th>Komentar</th>
                  <th>Stem</th>
                  <th>Sentimen</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($training as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->penulis ?></td>
                    <?php
                    $a = $row->komentar;
                    require_once FCPATH . 'application/third_party/SentimentAnalysis/autoload.php';
                    require_once FCPATH . '/vendor/autoload.php';
                    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
                    $sentiment = new \PHPInsight\Sentiment();

                    //createStemmer
                    $stemmer  = $stemmerFactory->createStemmer();

                    $strings = array(
                      1 => $a,
                    );

                    $i = 1;
                    foreach ($strings as $string) {

                      $commonWords = array('yang', 'dan', 'atau', 'yg', 'akan', 'dengan', 'lagi', 'kalau', 'di', 'harus', 'telah', 'juga', 'untuk', 'biar', 'serta', 'tetapi', 'namun', 'sedangkan', 'sebaliknya', 'melainkan', 'hanya', 'bahkan', 'malah', 'lagipula', 'apalagi', 'jangankan', 'kecuali', 'hanya', 'lalu', 'kemudian', 'selanjutnya', 'yaitu', 'yakni', 'bahwa', 'adalah', 'ialah', 'jadi', 'karena itu', 'oleh sebab itu', 'oleh karena itu', 'sebab', 'karena', 'kalau', 'jikalau', 'jika', 'bila', 'apalagi', 'asal', 'semakin', 'makin', 'agar', 'supaya', 'seperti', 'sebagai', 'ketika', 'sampai', 'semenjak', 'dari', 'sama', 'nya', 'masih', 'padahal');
                      $stem = $stemmer->stem($row->komentar);
                      $stem = preg_replace('/\b(' . implode('|', $commonWords) . ')\b/', '', $stem);

                      // output:
                      // if (in_array("pos", $scores)) {
                      //   echo "Got positif";
                      // }

                      // calculations:
                      $scores = $sentiment->score($stem);
                      $class = $sentiment->categorise($stem);

                      echo "<td>$string</td>";
                      echo "<td>$stem</td>";
                      echo "<td>$class</td>";
                      // echo "<td>";
                      // // var_dump($scores);
                      // foreach ($scores as $skor) {
                      //   echo $skor;
                      // }
                      // echo "</td>";
                      $i++;
                      $sql = "UPDATE dataset SET sentimen = '" . $class . "', stem = '" . $stem . "' WHERE id = '" . $row->id . "' ";
                      $this->db->query($sql);
                    }
                    ?>
                    <?php
                    $no++;
                    ?>
                    <td>
                      <div class="btn-group">
                        <a href="<?= base_url() ?>Dataset/hapus/<?= $row->id ?>" class="btn btn-danger" onclick="return confirm('yakin ?')"><i class="fa-solid fa-trash-can"></i></a>
                        <a href="<?= base_url() ?>Dataset/ubah/<?= $row->id ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                      </div>
                    </td>
                  <?php } ?>
                  </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper