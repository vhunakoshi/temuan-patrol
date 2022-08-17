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

                      <!-- Widget: user widget style 1 -->
                      <div class="card card-widget widget-user">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header bg-maroon">
                              <h3 class="widget-user-username"><?= $pegawai['name_user']; ?></h3>
                              <h5 class="widget-user-desc"><?= $pegawai['nama_seksi']; ?></h5>
                          </div>
                          <div class="widget-user-image">
                              <img class="img-circle elevation-2" src="<?= base_url('assets/img/profile/') . $pegawai['image']; ?>" alt="User Avatar">
                          </div>

                          <div class="card-header">
                              <h3 class="card-title">Pendingan JOB</h3>
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
                                          <th class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php if ($jadwal == array()) : ?>
                                          <tr>
                                              <td colspan="6" class="table-secondary text-center"><i>Pendingan Masih Kosong</i></td>
                                          </tr>
                                      <?php else : ?>
                                          <?php $i = 1; ?>
                                          <?php foreach ($jadwal as $j) : ?>
                                              <tr>
                                                  <th scope="row"><?= $i; ?></th>
                                                  <td><?= $j['nama_tim']; ?></td>
                                                  <td><?= $j['nama_zona']; ?></td>
                                                  <td><?= $j['tgl_patrol']; ?></td>
                                                  <td><span class="badge badge-danger"><?= $j['status']; ?></td>
                                                  <td>
                                                      <center>
                                                          <a href="" data-toggle="modal" data-target="#infoJadwalModal"><button type="button" class="btn btn-info btn-sm tampilJadwalModalInfoKaryawan" data-id="<?= $j['id_jadwal']; ?>"><i class="fa fa-folder"></i></button></a>
                                                      </center>
                                                  </td>
                                              </tr>
                                              <?php $i++; ?>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </tbody>
                              </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.widget-user -->
                  </div>
              </div>
          </div>
      </section>
  </div>

  <!--Modal Info-->
  <div class="modal fade" id="infoJadwalModal" tabindex="-1" role="dialog" aria-labelledby="infoJadwalModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="infoJadwalModalLabel">Info Jadwal Patrol</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                  <table class="table table-bordeless">
                      <tr>
                          <th>Nama Tim</th>
                          <td>:</td>
                          <td>
                              <p id="infoNamaTim">-</p>
                          </td>
                      </tr>
                      <tr>
                          <th>Ketua Tim</th>
                          <td>:</td>
                          <td>
                              <p id="infoKetuaTim">-</p>
                          </td>
                      </tr>
                      <tr>
                          <th>Nama Zona</th>
                          <td>:</td>
                          <td>
                              <p id="infoZona">-</p>
                          </td>
                      </tr>
                      <tr>
                          <th>Lokasi Zona</th>
                          <td>:</td>
                          <td>
                              <p id="infoLokasi">-</p>
                          </td>
                      </tr>
                      <tr>
                          <th>Jadwal Patrol</th>
                          <td>:</td>
                          <td>
                              <p id="infoJadwalPatrol">-</p>
                          </td>
                      </tr>
                      <tr>
                          <th>Anggota Team</th>
                          <td>:</td>
                          <td>
                              <div id="infoAnggotaTeam">
                                  <p>-</p>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <th>Status</th>
                          <td>:</td>
                          <td>
                              <div id="infoStatusJob">
                                  <p>-</p>
                              </div>
                          </td>
                      </tr>
                  </table>
              </div>
              <div class="modal-footer">
                  <a class="btn btn-success upload_bukti" href="#"><i class="fa fa-paper-plane"></i> Kirim Verifikasi Temuan</a>
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>