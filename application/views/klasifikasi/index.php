<?php
include("./nbtc-lib/vendor/autoload.php");
$classifier = new \Niiknow\Bayes();
$index = array("stem", "sentimen");
$dataset = $this->db->query("select * from dataset order by rand()")->result_array();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Naive Bayes Classifier</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Naive Bayes Classifier</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Uji Akurasi</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="row">
            <div class="col-md-8">
              <div class="card-body">
                <form method="POST" action="" id="performance">
                  <div class="form-group">
                    <label id="lab">Prosentase Data Training <?= $this->input->post('train') !== NULL ? $this->input->post('train') . '%, Data Testing ' . (100 - $this->input->post('train')) . '%' : '' ?></label>
                    <select name="train" required="" onchange="if($(event.target).val()!=''){$('#lab').html('Prosentase Data Training '+$(event.target).val()+'%, Data Testing '+(100-$(event.target).val())+'%');$('#performance').submit();}else{$('#lab').html('Prosentase Data Training');}" class="form-control">
                      <option value="">-- Pilih Prosentase --</option>
                      <option value="10" <?= $this->input->post('train') == 10 ? 'selected' : '' ?>>10 %</option>
                      <option value="20" <?= $this->input->post('train') == 20 ? 'selected' : '' ?>>20 %</option>
                      <option value="30" <?= $this->input->post('train') == 30 ? 'selected' : '' ?>>30 %</option>
                      <option value="40" <?= $this->input->post('train') == 40 ? 'selected' : '' ?>>40 %</option>
                      <option value="50" <?= $this->input->post('train') == 50 ? 'selected' : '' ?>>50 %</option>
                      <option value="60" <?= $this->input->post('train') == 60 ? 'selected' : '' ?>>60 %</option>
                      <option value="70" <?= $this->input->post('train') == 70 ? 'selected' : '' ?>>70 %</option>
                      <option value="80" <?= $this->input->post('train') == 80 ? 'selected' : '' ?>>80 %</option>
                      <option value="90" <?= $this->input->post('train') == 90 ? 'selected' : '' ?>>90 %</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if ($this->input->post('train') !== NULL) { ?>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- card-body -->
            <div class="card-body">
              <div class="d-flex justify-content-start">
                <h4>Pemisahan Data Training & Testing</h4>
                <div class="table-primary ml-4 mt-2" style="width: 28px; height: 10px;">

                </div>
                <p class="ml-2">Data Training</p>
                <div class="table-danger ml-4 mt-2" style="width: 28px; height: 10px;">

                </div>
                <p class="ml-2">Data Testing</p>
              </div>

              <?php
              $train = $this->input->post('train');
              $countdata = sizeof($dataset);
              $ndatatrain = ($train / 100) * $countdata;
              $ndatatrain = floor($ndatatrain);
              $newtraindata = [];
              ?>
              <table id="datatable_pemisahandataset" class="table table-bordered">
                <thead>
                  <tr class="font-weight-bold">
                    <th>No</th>
                    <th>Komentar</th>
                    <th>Sentimen</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $x = 0;
                  $no = 1;
                  $flagtesting = 0;
                  foreach ($dataset as $key) {
                    $x++;
                    if ($ndatatrain >= $x) {
                  ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td class="table-primary"><?= $key['stem'] ?></td>
                        <td class="table-primary"><?= $key['sentimen'] ?></td>
                        <?php
                        $no++;
                        ?>
                        <?php
                        $newtraindata_temp = [];
                        $x_temp = 0;
                        foreach ($index as $keys) {
                          $newtraindata_temp[] = $key[$keys];
                        ?>
                        <?php
                          if ($x_temp == 0) {
                            $resp = $key[$keys];
                          } else if ($x_temp == 1) {
                            $sentimen = $key[$keys];
                          }
                          $x_temp++;
                        }
                        $classifier->learn($resp, $sentimen);
                        $newtraindata[] = $newtraindata_temp;
                        ?>
                      </tr>
                    <?php
                    } else {
                    ?>
                      <?php if ($flagtesting == 0) {
                        $flagtesting++; ?>
                      <?php } ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td class="table-danger"><?= $key['stem'] ?></td>
                        <td class="table-danger"><?= $key['sentimen'] ?></td>
                      </tr>
                      <?php
                      $no++;
                      ?>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
              <hr />
              <h4 class="mt-3">Proses Testing</h4>
              <table id="datatable_prosestesting" class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Komentar</th>
                    <th>Sentimen</th>
                    <th>Hasil Testing</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $x = 0;
                  $tp = 0;
                  $tn = 0;
                  $fp = 0;
                  $fn = 0;
                  foreach ($dataset as $key) {
                    $x++;
                    if ($x > $ndatatrain) {
                  ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td class="table-danger"><?= $key['stem'] ?></td>
                        <td class="table-danger"><?= $key['sentimen'] ?></td>
                        <?php
                        $no++;
                        ?>
                        <?php
                        $x_temp = 0;
                        foreach ($index as $keys) {
                        ?>
                        <?php
                          if ($x_temp == 0) {
                            $resp = $key[$keys];
                          } else if ($x_temp == 1) {
                            $lab = $key[$keys];
                          }
                          $x_temp++;
                        }
                        $result = $classifier->categorize($resp);
                        ?>
                        <td class="table-primary">
                          <?php
                          if ($lab == 'positif' && $result == 'positif') {
                            $tp++;
                          } else if ($lab == 'negatif' && $result == 'negatif') {
                            $tn++;
                          } else if ($lab == 'positif' && $result == 'negatif') {
                            $fn++;
                          } else if ($lab == 'negatif' && $result == 'positif') {
                            $fp++;
                          }
                          echo $result;
                          ?>
                        </td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
              <hr>
              <h4 class="mt-3">Confusion Matrix</h4>
              <table class="table table-bordered text-center">
                <tr>
                  <th></th>
                  <th>Prediksi Positif</th>
                  <th>Prediksi Negatif</th>
                </tr>
                <tr class="table-success">
                  <th>Sebenarnya Positif</th>
                  <td><?php echo $tp; ?></td>
                  <td><?php echo $fn; ?></td>
                </tr>
                <tr class="table-warning">
                  <th>Sebenarnya Negatif</th>
                  <td><?php echo $fp; ?></td>
                  <td><?php echo $tn; ?></td>
                </tr>
              </table>
              <hr>
              <?php
              if ($tp == 0 && $tn == 0) {
                $tp = 1;
                $tn = 1;
                $akurasi = ((($tp + $tn) - ($tp + $tn)) / ($tp + $tn + $fp + $fn)) * 100;
              }
              if ($tp == 0) {
                $tp = 1;
                $recall = (($tp - $tp) / ($tp + $fn)) * 100;
                $precision = (($tp - $tp) / ($tp + $fp)) * 100;
              } else {
                $akurasi = (($tp + $tn) / ($tp + $tn + $fp + $fn)) * 100;
                $recall = (($tp) / ($tp + $fn)) * 100;
                $precision = (($tp) / ($tp + $fp)) * 100;
              }
              ?>
              <div class="card card-body <?php if ($akurasi < 60) {
                                            echo 'bg-danger';
                                          } else if ($akurasi < 80) {
                                            echo 'bg-warning';
                                          } else {
                                            echo 'bg-primary';
                                          } ?> text-white">
                <h4 class="card-title mb-0 text-white">Hasil Akurasi : <?= round($akurasi, 3); ?> %</h4>
              </div>
              <div class="card card-body <?php if ($recall < 60) {
                                            echo 'bg-danger';
                                          } else if ($recall < 80) {
                                            echo 'bg-warning';
                                          } else {
                                            echo 'bg-primary';
                                          } ?> text-white">
                <h4 class="card-title mb-0 text-white">Hasil Recall : <?= round($recall, 3); ?> %</h4>
              </div>
              <div class="card card-body <?php if ($precision < 60) {
                                            echo 'bg-danger';
                                          } else if ($precision < 80) {
                                            echo 'bg-warning';
                                          } else {
                                            echo 'bg-primary';
                                          } ?> text-white">
                <h4 class="card-title mb-0 text-white">Hasil Precision : <?= round($precision, 3); ?> %</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>
</div>