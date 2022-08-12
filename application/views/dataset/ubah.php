<div class="content container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ubah Dataset</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dataset">Dataset</a></li>
            <li class="breadcrumb-item active">Ubah Dataset</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Id</label>
                      <input type="text" class="form-control disabled" name="id" value="<?= $ubah['id'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Penulis</label>
                      <input type="text" class="form-control" name="penulis" value="<?= $ubah['penulis'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Komentar</label>
                      <input type="text" class="form-control" name="komentar" value="<?= $ubah['komentar'] ?>">
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper