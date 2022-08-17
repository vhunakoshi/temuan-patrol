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
                      <div class="card card-purple">
                          <div class="card-header">
                              <h3 class="card-title">Informasi Perbaikan Temuan</h3>
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

                      <div class="card">
                          <div class="card-body">
                              <a href="<?= base_url("karyawan/v_buktiperbaikan"); ?>" class="btn btn-secondary">Kembali</a>
                              <a href="<?= base_url("karyawan/updateStatusPerbaikan/" . $jadwal['id_jadwal'] . "/" . $seksi); ?>" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin untuk mengirim data ini ?');"><i class="fas fa-paper-plane"></i> Kirim</a>
                          </div>
                      </div>
                  </div>

              </div>

              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">Daftar Bukti Perbaikan</h3>
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
                          <div class="card-body p-0">
                              <table class="table table-responsive table-hover text-nowrap">
                                  <thead>
                                      <tr>
                                          <th scope="col" style="width: 20px;" class="text-center">#</th>
                                          <th scope="col" class="text-center">Nama Seksi</th>
                                          <th scope="col" class="text-center">Foto Temuan</th>
                                          <th scope="col" class="text-center">Uraian Temuan</th>
                                          <th scope="col" class="text-center">Kategori</th>
                                          <th scope="col" class="text-center">Action</th>
                                          <th scope="col" class="text-center">Foto Perbaikan</th>
                                          <th scope="col" class="text-center">Uraian Perbaikan</th>
                                          <th scope="col" class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <!-- Sembunyikan Pesan Error, karena skrip sudah berjalan dengan baik -->
                                  <?php error_reporting(0); ?>
                                      <?php $i = 0; ?>
                                      <?php $c = 0; ?>
                                      <?php $status = ""; ?>
                                      <?php foreach ($daftarTemuan as $d) : ?>
                                          <?php $no = $i + 1; ?>
                                          <tr>
                                              <td class="text-center" scope="row"><?= $no; ?></td>
                                              <td style="min-width: 200px;" class="text-center"><?= $d['nama_seksi']; ?></td>
                                              <td class="text-center">
                                                  <img src="<?= base_url('assets/img/temuan_patrol/' . $d['foto_temuan']) ?>" class="rounded mx-auto d-block" style="height: 100px;" alt="Temuan Patrol">
                                              </td>
                                              <td>
                                                  <textarea style="min-width: 460px;" class="form-control" rows="3" disabled> <?= $d['uraian_temuan']; ?> </textarea>
                                              </td>
                                              <td class="text-center"><?= $d['kategori']; ?></td>

                                              <?php $j = $totalDataPerbaikan['numrows'] ?>
                                                <?php for($b = 0; $b<$j; $b++) {
                                                    if($daftarPerbaikan[$b]['id_temuan'] == $d['id_temuan']) {
                                                        $status = 'True';
                                                        $c = $b;
                                                        break;
                                                    }else{
                                                        $status = 'False';
                                                    }
                                                }?>

                                              <?php if ($status == 'True') : ?>
                                                  <td class="text-center">
                                                      <p>Done</p>
                                                  </td>
                                              <?php else : ?>
                                                  <td class="text-center">
                                                      <a href="" data-toggle="modal" data-target="#newModalPerbaikan" class="btn btn-primary btn-sm tampilModalPerbaikan" data-id="<?= $d['id_temuan']; ?>" data-id_jadwal="<?= $d['id_jadwal']; ?>"><i class="far fa-file-alt"> Tambah Perbaikan</i></a>
                                                  </td>
                                              <?php endif; ?>
                                              
                                                  <?php if ($status == 'True') : ?>
                                                      <td class="text-center">
                                                          <img src="<?= base_url('assets/img/perbaikan_temuan/' . $daftarPerbaikan[$c]['foto_perbaikan']) ?>" class="rounded mx-auto d-block" style="height: 100px;" alt="Temuan Patrol">
                                                      </td>
                                                      <td>
                                                          <textarea style="min-width: 460px;" class="form-control" rows="3" disabled> <?= $daftarPerbaikan[$c]['uraian_perbaikan']; ?> </textarea>
                                                      </td>
                                                      <td class="text-center">
                                                          <a href="<?= base_url('karyawan/hapus_dataperbaikan/' . $daftarPerbaikan[$c]['id_perbaikan'] . '/' . $daftarPerbaikan[$c]['id_temuan'] . '/' . $jadwal['id_jadwal']); ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ingin menghapus data temuan ini ?');"><i class="far fa-trash-alt"></i></button></a>
                                                      </td>
                                                  <?php else : ?>
                                                      <td colspan="3" class="table-secondary text-center">
                                                          <b><i>Pendingan Masih Kosong</i></b>
                                                      </td>
                                                  <?php endif; ?>
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

  <!-- Modal -->
  <div class="modal fade" id="newModalPerbaikan" tabindex="-1" role="dialog" aria-labelledby="newModalPerbaikanLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newModalPerbaikanLabel">Tambah Perbaikan Temuan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <?= form_open_multipart('karyawan/uploadBuktiPerbaikan/' . $jadwal['id_jadwal']); ?>
                  <div class="form-group">
                      <input type="hidden" name="id_temuan" id="id_temuan" value="">
                      <!-- <input type="text" name="id_temuan" id="id_temuan" value="" disabled> -->
                      <label for="exampleInputFile">Foto Perbaikan</label>
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
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                  <button type="submit" id="tombol" class="btn btn-primary">+ Tambah</button>
              </div>
              </form>
          </div>
      </div>
  </div>
  </div>