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
                              <a href="<?= base_url("karyawan/v_buktitemuan"); ?>" class="btn btn-secondary">Kembali</a>
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
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php if (isset($daftarTemuan)) : ?>
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
                                              </tr>
                                              <?php $i++; ?>
                                          <?php endforeach; ?>
                                      <?php else : ?>
                                          <tr>
                                              <td colspan="5" class="text-center"><i>Tidak Ada Data Temuan Patrol disini!!</i></td>
                                          </tr>
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