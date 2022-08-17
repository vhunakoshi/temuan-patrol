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

      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <a href="" class="btn btn-primary"><i class="fas fa-print"></i> Cetak PDF</a>
                              <a href="<?= base_url("karyawan/v_buktiperbaikan"); ?>" class="btn btn-secondary">Kembali</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                              <table class="table table-responsive table-hover text-nowrap">
                                  <thead>
                                      <tr>
                                          <th scope="col" style="width: 20px;" class="text-center">#</th>
                                          <th scope="col" class="text-center">Nama Seksi</th>
                                          <th scope="col" class="text-center">Foto Temuan</th>
                                          <th scope="col" class="text-center">Uraian Temuan</th>
                                          <th scope="col" class="text-center">Kategori</th>
                                          <th scope="col" class="text-center">Foto Perbaikan</th>
                                          <th scope="col" class="text-center">Uraian Perbaikan</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <!-- Sembunyikan Pesan Error, karena skrip sudah berjalan dengan baik -->
                                  <?php error_reporting(0); ?>
                                      <?php if ($daftarTemuan == array()) : ?>
                                          <tr>
                                              <td colspan="5" class="text-center"><i>Tidak Ada Data Perbaikan Patrol disini!!</i></td>
                                          </tr>
                                      <?php else : ?>
                                          <?php $i = 0; ?>
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
                                                              <img src="<?= base_url('assets/img/perbaikan_temuan/' . $daftarPerbaikan[$c]['foto_perbaikan']) ?>" class="rounded mx-auto d-block" style="height: 100px;" alt="Temuan Patrol">
                                                          </td>
                                                          <td>
                                                              <textarea style="min-width: 460px;" class="form-control" rows="3" disabled> <?= $daftarPerbaikan[$c]['uraian_perbaikan']; ?> </textarea>
                                                          </td>
                                                    <?php else : ?>
                                                          <td colspan="3" class="table-secondary text-center">
                                                              <i>Tidak Ada Data Perbaikan disini</i>
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