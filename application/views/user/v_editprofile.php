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
          <div class="col-md-12">
              <?php if (validation_errors()) : ?>
                  <?= $this->session->flashdata('message'); ?>
              <?php endif; ?>
          </div>
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <div class="col-lg-12">
                                  <?= form_open_multipart('user/v_editprofile') ?>
                                  <div class="form-group row">
                                      <label for="email" class="col-sm-2 col-form-label">Username</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="name_user" name="name_user" value="<?= $user['name_user']; ?>">
                                          <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-sm-2">Picture</div>
                                      <div class="col-sm-10">
                                          <div class="row">
                                              <div class="col-sm-3">
                                                  <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                              </div>
                                              <div class="col-sm-9">
                                                  <div class="custom-file">
                                                      <input type="file" class="custom-file-input" id="image" name="image" for="image">
                                                      <label class="custom-file-label" for="image">Choose file</label>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="form-group row justify-content-end">
                                      <div class="col-sm-10">
                                          <button type="submit" class="btn btn-primary editProfile">Edit</button>
                                          <a href="<?= base_url('user/v_changepassword'); ?>" class="btn bg-lightblue">Ubah Password</a>
                                      </div>
                                  </div>

                                  </form>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>