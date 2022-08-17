  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0"><?= $title; ?></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><?= $judul; ?></a></li>
                          <li class="breadcrumb-item active"><?= $title; ?></li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="col-md-12">
                  <?php if (validation_errors()) : ?>
                      <?= $this->session->flashdata('message'); ?>
                  <?php endif; ?>
              </div>
              <div class="col-md-12">
                  <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-info">
                          <h3 class="widget-user-username"><?= $user['name_user']; ?></h3>
                          <h5 class="widget-user-desc"><?= $user['level']; ?></h5>
                      </div>
                      <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="User Avatar">
                      </div>
                      <div class="card-footer">
                          <div class="row">
                              <div class="col-sm-3 border-right">
                                  <div class="description-block">
                                      <h5 class="description-header">2</h5>
                                      <span class="description-text">Pendingan Job</span>
                                  </div>
                                  <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-3 border-right">
                                  <div class="description-block">
                                      <h5 class="description-header">5</h5>
                                      <span class="description-text">Perbaikan Temuan</span>
                                  </div>
                                  <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-3 border-right">
                                  <div class="description-block">
                                      <h5 class="description-header">10</h5>
                                      <span class="description-text">Verifikasi Temuan</span>
                                  </div>
                                  <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-3">
                                  <div class="description-block">
                                      <h5 class="description-header">10</h5>
                                      <span class="description-text">JOB success</span>
                                  </div>
                                  <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                          </div>
                          <!-- /.row -->
                      </div>
                  </div>
                  <!-- /.widget-user -->
              </div>
          </div>
      </section>
  </div>