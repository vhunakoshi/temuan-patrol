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
                              <a href="" class="btn btn-primary tampilJadwalModalTambah" data-toggle="modal" data-target="#newJadwalModal">+ Tambah Jadwal Tugas</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nama Tim</th>
                                          <th>Nama Zona</th>
                                          <th>Tanggal</th>
                                          <th>Status</th>
                                          <th class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1; ?>
                                      <?php foreach ($jadwal as $j) : ?>
                                          <tr>
                                              <th scope="row"><?= $i; ?></th>
                                              <td><?= $j['nama_tim']; ?></td>
                                              <td><?= $j['nama_zona']; ?></td>
                                              <td><?= $j['tgl_patrol']; ?></td>
                                              <td><?= $j['status']; ?></td>
                                              <td>
                                                  <center>
                                                      <a href="" data-toggle="modal" data-target="#infoJadwalModal"><button type="button" class="btn btn-info btn-sm tampilJadwalModalInfo" data-id="<?= $j['id_jadwal']; ?>"><i class="fa fa-info"></i></button></a>
                                                      <?php if ($j['status'] == 'Pendingan Job') : ?>
                                                      <a href="" data-toggle="modal" data-target="#newJadwalModal"><button type="button" class="btn btn-success btn-sm tampilJadwalModalUbah" data-id="<?= $j['id_jadwal']; ?>"><i class="fas fa-pencil-alt"></i></button></a>
                                                      <?php else : ?>
                                                      <a href="" data-toggle="" data-target=""><button type="button" class="btn btn-success btn-sm disabled" data-id=""><i class="fas fa-pencil-alt"></i></button></a>
                                                      <?php endif; ?>
                                                      <a href="" data-toggle="modal" data-target="#hapusJadwalModal"><button type="button" class="btn btn-danger btn-sm tampilJadwalModalDelete" data-id="<?= $j['id_jadwal']; ?>"><i class="far fa-trash-alt"></i></button></a>
                                                  </center>
                                              </td>
                                          </tr>
                                          <?php $i++; ?>
                                      <?php endforeach; ?>
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
  <div class="modal fade" id="newJadwalModal" tabindex="-1" role="dialog" aria-labelledby="newJadwalModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newJadwalModalLabel">Tambah Jadwal Patrol</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= base_url('admin/addJadwalPatrol'); ?>" method="post">
                      <input type="hidden" name="id" id="id">
                      <div class="form-group">
                          <label for="exampleInputFile">Nama Tim</label>
                          <select name="id_tim" id="id_tim" class="form-control select2" style="width: 100%;">
                              <option value="">Nama Tim</option>
                              <?php foreach ($tim as $t) : ?>
                                  <option value="<?= $t['id_tim']; ?>">[<?= $t['nama_tim']; ?>] - <?= $t['name_user']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Nama Zona</label>
                          <select name="id_zona" id="id_zona" class="form-control select2" style="width: 100%;">
                              <option value="">Nama Zona</option>
                              <?php foreach ($zona as $z) : ?>
                                  <option value="<?= $z['id_zona']; ?>">[<?= $z['nama_zona']; ?>] - <?= $z['lokasi']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Tanggal Patrol</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" id="tgl_patrol" name="tgl_patrol" placeholder="Tanggal Patrol" />
                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
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
                                  <p>- Rasyid Hidayat</p>
                                  <p>- Rasyid Hidayat</p>
                                  <p>- Rasyid Hidayat</p>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <th>Status</th>
                          <td>:</td>
                          <td>
                              <p id="infoStatusJob">-</p>
                          </td>
                      </tr>
                  </table>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

  <!-- Hapus Modal-->
  <div class="modal fade" id="hapusJadwalModal" tabindex="-1" role="dialog" aria-labelledby="hapusJadwalModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="hapusJadwalModalLabel">Kamu yakin ingin menghapus Data Jadwal Patrol?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body DeleteModalBody">klik Delete untuk menghapus data jadwal.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger btnDelete" href="#">Delete</a>
              </div>
          </div>
      </div>
  </div>