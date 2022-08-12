<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="<?= base_url() ?>assets/dist/img/favicon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">NAIVE BAYES</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>assets/dist/img/favicon.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Administrator </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="<?= base_url() ?>" class="nav-link active">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard</i>
            </p>
          </a>
        </li>
        <!-- Data Training -->
        <li class="nav-item">
          <a href="<?= base_url() ?>DataTraining" class="nav-link">
            <i class="fas fa-school"></i>
            <p>
              Data Training
            </p>
          </a>
        </li>
        <!-- Data Training  -->

        <!-- Data Uji -->
        <li class="nav-item">
          <a href="<?= base_url() ?>DataUji" class="nav-link">
            <i class="fas fa-school"></i>
            <p>
              Data Uji
            </p>
          </a>
        </li>
        <!-- Data Uji  -->

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>