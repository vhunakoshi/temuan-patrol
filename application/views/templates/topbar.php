<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?php if ($this->session->userdata('level') == 'Sekretariat') : ?>
                <a href="<?= base_url('admin/v_beranda'); ?>" class="nav-link">Home</a>
            <?php else : ?>
                <a href="<?= base_url('user/v_viewprofile'); ?>" class="nav-link">Home</a>
            <?php endif ?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="https://www.instagram.com/hidayatrasyid25?igshid=4u9im7cxwers" class="nav-link" target="_blank">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('auth/logout'); ?>" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-fw fa-cogs"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->