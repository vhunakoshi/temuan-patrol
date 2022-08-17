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
                  </div>
              </div>

              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">Daftar Bukti Temuan :</h3>
                              <div class="card-tools">
                                  <div class="input-group input-group-sm" style="width: 150px;">
                                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                      <div class="input-group-append">
                                          <button type="submit" class="btn btn-default">
                                              <i class="fas fa-search"></i>
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                              <table class="table table-hover text-nowrap">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nama Tim</th>
                                          <th>Zona Patrol</th>
                                          <th>Tanggal</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php if ($jadwal == array()) : ?>
                                          <td colspan="6" class="table-secondary text-center">
                                              <b><i>Pendingan Masih Kosong</i></b>
                                          </td>
                                      <?php else : ?>
                                          <?php $i = 1; ?>
                                          <?php foreach ($jadwal as $j) : ?>
                                              <?php if ($j['status'] == 'Pendingan Job') : ?>
                                                  <tr class="table-light">
                                                  <?php elseif ($j['status'] == 'Perbaikan Temuan') : ?>
                                                  <tr class="table-warning">
                                                  <?php elseif ($j['status'] == 'Verifikasi Temuan') : ?>
                                                  <tr class="table-danger">
                                                  <?php elseif ($j['status'] == 'Success') : ?>
                                                  <tr class="table-success">
                                                  <?php else : ?>
                                                  <tr class="table-light">
                                                  <?php endif ?>

                                                  <th scope="row"><?= $i; ?></th>
                                                  <td><?= $j['nama_tim']; ?></td>
                                                  <td><?= $j['nama_zona']; ?></td>
                                                  <td><?= $j['tgl_patrol']; ?></td>
                                                  <td><?= $j['status']; ?></td>

                                                  <?php if ($j['status'] == 'Pendingan Job') : ?>
                                                      <td>
                                                          <a href="<?= base_url('karyawan/v_uploadbuktitemuan/' . $j['id_jadwal']); ?>"><button type="button" class="btn btn-success float-left"><i class="fas fa-download"></i> Upload Bukti Temuan </button></a>
                                                      </td>
                                                  <?php else : ?>
                                                      <td>
                                                          <a href="<?= base_url('karyawan/v_viewbuktitemuan/' . $j['id_jadwal']); ?>"><button type="button" class="btn btn-primary float-left"><i class="fas fa-book"></i> Lihat Bukti Temuan </button></a>
                                                      </td>
                                                  <?php endif; ?>
                                                  </tr>
                                                  <?php $i++; ?>
                                              <?php endforeach; ?>
                                          <?php endif; ?>
                                  </tbody>
                              </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>
              <!-- /.row -->
          </div>
      </section>
  </div>