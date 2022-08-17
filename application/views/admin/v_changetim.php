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
          <div class="col-md-12">
              <?php if (validation_errors()) : ?>
                  <div class="alert alert-danger" role="alert">
                      <?= validation_errors(); ?>
                  </div>
              <?php endif; ?>
              <?= $this->session->flashdata('message'); ?>
          </div>
          <div class="container-fluid">
              <div class="col-md-12">
                  <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-purple">
                          <h3 class="widget-user-username"><?= $team['name_user']; ?></h3>
                          <h5 class="widget-user-desc"><?= $team['nama_tim']; ?></h5>
                      </div>
                      <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="<?= base_url('assets/img/logo/') . $team['logo_tim']; ?>" alt="User Avatar">
                      </div>
                      <div class="card-footer">
                          <div class="row">
                              <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                      <h5 class="description-header"><?= $pendingan; ?></h5>
                                      <span class="description-text">JOB Pending</span>
                                  </div>
                                  <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                      <h5 class="description-header"><?= $progress; ?></h5>
                                      <span class="description-text">ON Progresss</span>
                                  </div>
                                  <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4">
                                  <div class="description-block">
                                      <h5 class="description-header"><?= $success; ?></h5>
                                      <span class="description-text">JOB Success</span>
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

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">
                      <a href="" class="btn btn-primary tampilAnggotaModalTambah" data-toggle="modal" data-target="#newAnggotaModal">+ Tambah Anggota Tim</a>
                      <a href="<?= base_url("admin/v_mastertim"); ?>" class="btn btn-secondary">Kembali</a>
                  </h3>

                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                      </button>
                  </div>
              </div>
              <div class="card-body p-0">
                  <table class="table table-striped projects">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Anggota</th>
                              <th>Photos</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (isset($row)) : ?>
                              <?php $i = 1; ?>
                              <?php foreach ($anggota as $a) : ?>
                                  <tr>
                                      <td scope="row"><?= $i; ?></td>
                                      <td>
                                          <a><?= $a['name_user']; ?></a>
                                          <br />
                                          <small>
                                              <?= $a['nama_seksi']; ?>
                                          </small>
                                      </td>
                                      <td>
                                          <ul class="list-inline">
                                              <li class="list-inline-item">
                                                  <img alt="Avatar" class="table-avatar" src="<?= base_url('assets/img/profile/') . $a['image']; ?>">
                                              </li>
                                          </ul>
                                      </td>
                                      <td class="text-center">
                                          <a href="<?= base_url('admin/hapus_anggota/'), $a['id_detailanggota'], '/', $a['id_tim']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ingin menghapus data Anggota <?= $a['name_user']; ?> ?');"><i class="far fa-trash-alt"></i></button></a>
                                      </td>
                                  </tr>
                                  <?php $i++; ?>
                              <?php endforeach; ?>
                          <?php else : ?>
                              <tr>
                                  <td colspan="4" class="text-center"><i>Belum ada Anggota yang ikut Dalam Tim ini</i></td>
                              </tr>
                          <?php endif; ?>
                      </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
  <div class="modal fade" id="newAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="newAnggotaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newAnggotaModalLabel">Tambah Anggota</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= base_url('admin/addAnggotaTim'); ?>" method="post">
                      <input type="hidden" name="id" id="id">
                      <input type="hidden" name="id_tim" id="id_tim" value="<?= $id_tim; ?>">
                      <div class="form-group">
                          <label for="exampleInputFile">Anggota Tim</label>
                          <select name="id_user" id="id_user" class="form-control select2" style="width: 100%;">
                              <option value="">Anggota Tim</option>
                              <?php foreach ($petugas as $p) : ?>
                                  <option value="<?= $p['id_user']; ?>"><?= $p['name_user']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                          <button type="submit" id="tombol" class="btn btn-primary">Tambah</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- Hapus Modal
  <div class="modal fade" id="hapusAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kamu yakin ingin menghapus Data Anggota?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body DeleteModalBody">klik Delete untuk menghapus data anggota.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger btnDelete" href="#">Delete</a>
              </div>
          </div>
      </div>
  </div> -->