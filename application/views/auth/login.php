  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <div class="left_logo">
          <img src="<?= base_url('assets/img/toto.png'); ?>" class="img-logototo"></>
        </div>
        <div class="right_logo">
          <img src="<?= base_url('assets/img/k3.png'); ?>" class="img-logo"></>
        </div>
      </div>

      <div class="card-body">
        <p class="text-center">
          <b>Aplikasi Temuan Patrol Management</b>
        </p>

        <?= $this->session->flashdata('message'); ?>

        <form class="user" action="<?= base_url('auth'); ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" id="username" name="username" value="<?= set_value('username'); ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
          <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>

          <!-- /.col -->
      </div>
      <p class="login-box-msg">Copyright : Rasyid Hidayat</p>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
  <!-- /.login-box -->