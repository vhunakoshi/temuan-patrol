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

                  <!-- left column -->
                  <div class="col-md-6">
                      <!-- general form elements -->
                      <div class="card card-secondary">
                          <div class="card-header">
                              <h3 class="card-title">Informasi Petugas</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="table table-borderless">
                              <table>
                                  <tr>
                                      <td>Nama Petugas</td>
                                      <td>:</td>
                                      <td><?= $user['name_user']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>Jabatan</td>
                                      <td>:</td>
                                      <td><?= $user['level']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>Nama Seksi</td>
                                      <td>:</td>
                                      <td><?= $user['nama_seksi']; ?></td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                      <!-- /.card -->

                      <!-- general form elements -->
                      <div class="card card-purple">
                          <div class="card-header">
                              <h3 class="card-title">Informasi Jadwal Temuan</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="table table-borderless">
                              <table>
                                  <tr>
                                      <td>Nama Tim</td>
                                      <td>:</td>
                                      <td><?= $jadwal['nama_tim']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>Ketua Tim</td>
                                      <td>:</td>
                                      <td><?= $ketuaTim['name_user']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>Nama Zona</td>
                                      <td>:</td>
                                      <td><?= $jadwal['nama_zona']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>Lokasi</td>
                                      <td>:</td>
                                      <td><?= $jadwal['lokasi']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>Tanggal Patrol</td>
                                      <td>:</td>
                                      <td><?= $jadwal['tgl_patrol']; ?></td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                      <!-- /.card -->
                  </div>

                  <!-- right column -->
                  <div class="col-md-6">
                      <!-- general form elements -->
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Tambah Temuan</h3>
                          </div>
                          <!-- /.card-header -->

                          <div class="card-body">
                              <div class="form-group">
                                  <?= form_open_multipart('karyawan/uploadBuktiTemuan/' . $jadwal['id_jadwal']); ?>
                                  <!-- <input type="hidden" name="id" id="id"> -->
                                  <label for="exampleInputFile">Nama Seksi</label>
                                  <select name="id_seksi" id="id_seksi" class="form-control select2" style="width: 100%;">
                                      <option value="">Nama Seksi</option>
                                      <?php foreach ($seksi as $s) : ?>
                                          <option value="<?= $s['id_seksi']; ?>">[<?= $s['kode_seksi']; ?>] - <?= $s['nama_seksi']; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputFile">Foto Temuan</label>
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="image" name="image" for="image">
                                          <label class="custom-file-label" for="image">Choose file</label>
                                      </div>
                                      <div class="input-group-append">
                                          <span class="input-group-text">Upload</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputFile">Keterangan</label>
                                  <textarea name="keterangan" id="keterangan" class="form-control" rows="3" style="width: 100%;"></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputFile">Kategori</label>
                                  <select name="kategori" id="kategori" class="form-control select2" style="width: 100%;">
                                      <option value="">Kategori</option>
                                      <option value="K3">K3</option>
                                      <option value="5S">5S</option>
                                  </select>
                              </div>
                          </div>
                          <!-- /.card-body -->

                          <div class="card-footer">
                              <a href="<?= base_url("karyawan/v_buktitemuan"); ?>" class="btn btn-secondary">Kembali</a>
                              <a href="<?= base_url("karyawan/updateStatusPendingan/" . $jadwal['id_jadwal']); ?>" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin untuk mengirim data ini ?');"><i class="fas fa-paper-plane"></i> Kirim</a>
                              <a href="" class="btn btn-danger remove">Clear</a>
                              <button type="submit" id="tombol" class="btn btn-primary">+ Tambah</button>
                          </div>
                          </form>
                      </div>
                      <!-- /.card -->
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Daftar Bukti Temuan</h3>
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
                                      <th style="width: 5%" class="text-center">#</th>
                                      <th style="width: 15%" class="text-center">Nama Seksi</th>
                                      <th style="width: 20%" class="text-center">Foto</th>
                                      <th style="width: 45%" class="text-center">Keterangan</th>
                                      <th style="width: 5%" class="text-center">Kategori</th>
                                      <th style="width: 10%" class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $i = 1; ?>
                                  <?php foreach ($daftarTemuan as $d) : ?>
                                      <tr>
                                          <td class="text-center" scope="row"><?= $i; ?></td>
                                          <td class="text-center"><?= $d['nama_seksi']; ?></td>
                                          <td class="text-center">
                                              <img src="<?= base_url('assets/img/temuan_patrol/' . $d['foto_temuan']) ?>" class="rounded mx-auto d-block" style="height: 100px;" alt="Temuan Patrol">
                                          </td>
                                          <td>
                                              <textarea class="form-control" rows="3" disabled> <?= $d['uraian_temuan']; ?> </textarea>
                                          </td>
                                          <td class="text-center"><?= $d['kategori']; ?></td>
                                          <td class="text-center">
                                              <a href="<?= base_url('karyawan/hapus_datatemuan/'), $d['id_temuan'], '/', $d['id_jadwal']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ingin menghapus data temuan ini ?');"><i class="far fa-trash-alt"></i></button></a>
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
          </div>
          <!-- /.row -->
      </section>
  </div>