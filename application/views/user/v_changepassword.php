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
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-lg-12">
                                      <?php if (validation_errors()) : ?>
                                          <?= $this->session->flashdata('message'); ?>
                                      <?php endif; ?>

                                      <form action="<?= base_url('user/v_changepassword'); ?>" method="post">

                                          <div class="form-group">
                                              <label for="current_password">Password Lama</label>
                                              <input type="password" class="form-control" id="current_password" name="current_password">
                                              <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                          </div>
                                          <div class="form-group">
                                              <label for="new_password1">Password Baru</label>
                                              <input type="password" class="form-control" id="new_password1" name="new_password1">
                                              <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                          </div>
                                          <div class="form-group">
                                              <label for="new_password2">Ulangi Password Baru</label>
                                              <input type="password" class="form-control" id="new_password2" name="new_password2">
                                              <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                          </div>
                                          <div class="form-group">
                                              <button type="submit" class="btn btn-primary">Change Password</button>
                                              <a href="<?= base_url('user/v_editprofile'); ?>" class="btn bg-lightblue">Kembali</a>
                                          </div>

                                      </form>

                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

  </div>