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
                              <a href="" class="btn btn-primary tampilSeksiModalTambah" data-toggle="modal" data-target="#newSeksiModal">+ Tambah Seksi</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Kode Seksi</th>
                                          <th>Nama Seksi</th>
                                          <th class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1; ?>
                                      <?php foreach ($seksi as $u) : ?>
                                          <tr>
                                              <th scope="row"><?= $i; ?></th>
                                              <td><?= $u['kode_seksi']; ?></td>
                                              <td><?= $u['nama_seksi']; ?></td>
                                              <td>
                                                  <center>
                                                      <a href="" data-toggle="modal" data-target="#newSeksiModal"><button type="button" class="btn btn-info btn-sm tampilSeksiModalUbah" data-id="<?= $u['id_seksi']; ?>"><i class="fas fa-pencil-alt"></i></button></a>
                                                      <a href="" data-toggle="modal" data-target="#hapusSeksiModal"><button type="button" class="btn btn-danger btn-sm tampilSeksiModalDelete" data-id="<?= $u['id_seksi']; ?>"><i class="far fa-trash-alt"></i></button></a>
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
  <div class="modal fade" id="newSeksiModal" tabindex="-1" role="dialog" aria-labelledby="newSeksiModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newSeksiModalLabel">Tambah Seksi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= base_url('admin/addMasterSeksi'); ?>" method="post">
                      <input type="hidden" name="id" id="id">
                      <div class="form-group">
                          <label for="exampleInputFile">Kode Seksi</label>
                          <input type="text" class="form-control" id="kode_seksi" name="kode_seksi" placeholder="Kode Seksi">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Nama Seksi</label>
                          <input type="text" class="form-control" id="nama_seksi" name="nama_seksi" placeholder="Nama Seksi">
                      </div>
                      <div class="form-group">
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

  <!-- Hapus Modal-->
  <div class="modal fade" id="hapusSeksiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kamu yakin ingin menghapus Data Seksi?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body DeleteModalBody">klik Delete untuk menghapus data seksi.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger btnDelete" href="#">Delete</a>
              </div>
          </div>
      </div>
  </div>