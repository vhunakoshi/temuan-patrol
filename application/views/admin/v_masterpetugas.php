  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1><?= $title; ?></h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><?= $judul; ?></a></li>
                          <li class="breadcrumb-item active"><?= $title; ?></li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>


      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <?php if (validation_errors()) : ?>
                          <div class="alert alert-danger" role="alert">
                              <?= validation_errors(); ?>
                          </div>
                      <?php endif; ?>
                      <?= $this->session->flashdata('message'); ?>
                      <div class="card">
                          <div class="card-header">
                              <a href="" class="btn btn-primary tampilUserModalTambah" data-toggle="modal" data-target="#newUserModal">+ Tambah Petugas</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nama Petugas</th>
                                          <th>Level</th>
                                          <th>Kode Seksi</th>
                                          <th class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1; ?>
                                      <?php foreach ($petugas as $u) : ?>
                                          <tr>
                                              <th scope="row"><?= $i; ?></th>
                                              <td><?= $u['name_user']; ?></td>
                                              <td><?= $u['level']; ?></td>
                                              <td><?= $u['kode_seksi']; ?></td>
                                              <td>
                                                  <center>
                                                      <a href="" data-toggle="modal" data-target="#newUserModal"><button type="button" class="btn btn-info btn-sm tampilUserModalUbah" data-id="<?= $u['id_user']; ?>"><i class="fas fa-pencil-alt"></i></button></a>
                                                      <a href="" data-toggle="modal" data-target="#hapusUserModal"><button type="button" class="btn btn-danger btn-sm tampilUserModalDelete" data-id="<?= $u['id_user']; ?>"><i class="far fa-trash-alt"></i></button></a>
                                                  </center>
                                              </td>
                                          </tr>
                                          <?php $i++; ?>
                                      <?php endforeach; ?></td>
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
          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal -->
  <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newUserModalLabel">Tambah Petugas</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= base_url('admin/addMasterPetugas'); ?>" method="post">
                      <input type="hidden" name="id" id="id">
                      <div class="form-group">
                          <label for="exampleInputFile">Nama Lengkap</label>
                          <input type="text" class="form-control" id="name_user" name="name_user" placeholder="Nama">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Username</label>
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Level</label>
                          <select name="level" id="level" class="form-control">
                              <option value="">Select Level</option>
                              <option value="Sekretariat">Sekretariat</option>
                              <option value="Seksi">Seksi</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Nama Seksi</label>
                          <select name="id_seksi" id="id_seksi" class="form-control select2" style="width: 100%;">
                              <option value="">Nama Seksi</option>
                              <?php foreach ($seksi as $s) : ?>
                                  <option value="<?= $s['id_seksi']; ?>"><?= $s['nama_seksi']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Password</label>
                          <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Ulangi Password</label>
                          <input type="password" class="form-control" id="password2" name="password2" placeholder="re-Password">
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" id="tombol" class="btn btn-primary">Tambah</button>
              </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Hapus Modal-->
  <div class="modal fade" id="hapusUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kamu yakin ingin menghapus Data user?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body DeleteModalBody">klik Delete untuk menghapus data user.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger btnDelete" href="#">Delete</a>
              </div>
          </div>
      </div>
  </div>