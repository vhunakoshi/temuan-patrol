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
                              <a href="" class="btn btn-primary tampilZonaModalTambah" data-toggle="modal" data-target="#newZonaModal">+ Tambah Zona</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nama Zona</th>
                                          <th>Lokasi</th>
                                          <th class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1; ?>
                                      <?php foreach ($zona as $z) : ?>
                                          <tr>
                                              <th scope="row"><?= $i; ?></th>
                                              <td><?= $z['nama_zona']; ?></td>
                                              <td><?= $z['lokasi']; ?></td>
                                              <td>
                                                  <center>
                                                      <a href="" data-toggle="modal" data-target="#newZonaModal"><button type="button" class="btn btn-info btn-sm tampilZonaModalUbah" data-id="<?= $z['id_zona']; ?>"><i class="fas fa-pencil-alt"></i></button></a>
                                                      <a href="" data-toggle="modal" data-target="#hapusZonaModal"><button type="button" class="btn btn-danger btn-sm tampilZonaModalDelete" data-id="<?= $z['id_zona']; ?>"><i class="far fa-trash-alt"></i></button></a>
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
  <div class="modal fade" id="newZonaModal" tabindex="-1" role="dialog" aria-labelledby="newZonaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newZonaModalLabel">Tambah Zona</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= base_url('admin/addMasterZona'); ?>" method="post">
                      <input type="hidden" name="id" id="id">
                      <div class="form-group">
                          <label for="exampleInputFile">Nama Zona</label>
                          <input type="text" class="form-control" id="nama_zona" name="nama_zona" placeholder="Nama Zona">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Lokasi</label>
                          <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi">
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
  <div class="modal fade" id="hapusZonaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kamu yakin ingin menghapus Data Zona?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body DeleteModalBody">klik Delete untuk menghapus data zona.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger btnDelete" href="#">Delete</a>
              </div>
          </div>
      </div>
  </div>