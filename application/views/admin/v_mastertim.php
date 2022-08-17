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
                              <a href="" class="btn btn-primary tampilTimModalTambah" data-toggle="modal" data-target="#newTimModal">+ Tambah Tim</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nama Tim</th>
                                          <th>Ketua Tim</th>
                                          <th>Image</th>
                                          <th class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1; ?>
                                      <?php foreach ($tim as $t) : ?>
                                          <tr>
                                              <th scope="row"><?= $i; ?></th>
                                              <td><?= $t['nama_tim']; ?></td>
                                              <td><?= $t['name_user']; ?></td>
                                              <td><?= $t['logo_tim']; ?></td>
                                              <td>
                                                  <center>
                                                      <a href="" data-toggle="modal" data-target="#newTimModal"><button type="button" class="btn btn-info btn-sm tampilTimModalUbah" data-id="<?= $t['id_tim']; ?>"><i class="fas fa-pencil-alt"></i></button></a>
                                                      <a href="<?= base_url("admin/v_changetim/" . $t['id_tim']); ?>" <button type=" button" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i></button></a>
                                                      <a href="" data-toggle="modal" data-target="#hapusTimModal"><button type="button" class="btn btn-danger btn-sm tampilTimModalDelete" data-id="<?= $t['id_tim']; ?>"><i class="far fa-trash-alt"></i></button></a>
                                                  </center>
                                              </td>
                                          </tr>
                                          <?php $i++; ?>
                                      <?php endforeach; ?>
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
  <div class="modal fade" id="newTimModal" tabindex="-1" role="dialog" aria-labelledby="newTimModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newTimModalLabel">Tambah Tim</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <?= form_open_multipart('admin/addMasterTim'); ?>
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                      <label for="exampleInputFile">Nama Tim</label>
                      <input type="text" class="form-control" id="nama_tim" name="nama_tim" placeholder="Nama Tim">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputFile">Ketua Team</label>
                      <select name="id_user" id="id_user" class="form-control select2" style="width: 100%;">
                          <option value="">Ketua Team</option>
                          <?php foreach ($petugas as $p) : ?>
                              <option value="<?= $p['id_user']; ?>"><?= $p['name_user']; ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputFile">File input</label>
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
  <div class="modal fade" id="hapusTimModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kamu yakin ingin menghapus Data Tim?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body DeleteModalBody">klik Delete untuk menghapus data tim.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-danger btnDelete" href="#">Delete</a>
              </div>
          </div>
      </div>
  </div>