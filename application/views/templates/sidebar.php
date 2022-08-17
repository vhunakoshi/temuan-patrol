<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php if ($this->session->userdata('level') == 'Sekretariat') : ?>
        <a href="<?= base_url('admin/v_beranda'); ?>" class="brand-link">
            <img src="<?= base_url('assets'); ?>/img/logo.png" alt="TPM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">TEMUAN PATROL</span>
        </a>
    <?php else : ?>
        <a href="<?= base_url('user/v_viewprofile'); ?>" class="brand-link">
            <img src="<?= base_url('assets'); ?>/img/logo.png" alt="TPM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">TEMUAN PATROL</span>
        </a>
    <?php endif ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url('user/v_profile'); ?>" class="d-block"><?= $user['name_user']; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <?php
        $level = $this->session->userdata('level');
        ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <?php if ($level == 'Sekretariat') : ?>
                    <li class="nav-header"><?= $level; ?></li>
                    <li class="nav-item">
                        <?php if ($judul == 'Dashboard') : ?>
                            <a href="#" class="nav-link active">
                            <?php else : ?>
                                <a href="#" class="nav-link">
                                <?php endif; ?>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <?php if ($title == 'Beranda') : ?>
                                            <a href="<?= base_url('admin/v_beranda'); ?>" class="nav-link active">
                                                <i class="fas fa-home nav-icon"></i>
                                                <p>Beranda</p>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/v_beranda'); ?>" class="nav-link">
                                                <i class="fas fa-home nav-icon"></i>
                                                <p>Beranda</p>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php if ($title == 'Master Seksi') : ?>
                                            <a href="<?= base_url('admin/v_masterseksi'); ?>" class="nav-link active">
                                                <i class="fas fa-cogs nav-icon"></i>
                                                <p>Master Seksi</p>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/v_masterseksi'); ?>" class="nav-link">
                                                <i class="fas fa-cogs nav-icon"></i>
                                                <p>Master Seksi</p>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php if ($title == 'Master Zona') : ?>
                                            <a href="<?= base_url('admin/v_masterzona'); ?>" class="nav-link active">
                                                <i class="fas fa-map-marker-alt nav-icon"></i>
                                                <p>Master Zona</p>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/v_masterzona'); ?>" class="nav-link">
                                                <i class="fas fa-map-marker-alt nav-icon"></i>
                                                <p>Master Zona</p>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php if ($title == 'Master Petugas') : ?>
                                            <a href="<?= base_url('admin/v_masterpetugas'); ?>" class="nav-link active">
                                                <i class="fas fa-user nav-icon"></i>
                                                <p>Master Petugas</p>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/v_masterpetugas'); ?>" class="nav-link">
                                                <i class="fas fa-user nav-icon"></i>
                                                <p>Master Petugas</p>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php if ($title == 'Master Tim' || $title == 'Anggota Tim') : ?>
                                            <a href="<?= base_url('admin/v_mastertim'); ?>" class="nav-link active">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>Master Tim</p>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/v_mastertim'); ?>" class="nav-link">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>Master Tim</p>
                                            </a>
                                        <?php endif; ?>
                                    </li>

                                    <li class="nav-item">
                                        <?php if ($title == 'Jadwal Patrol') : ?>
                                            <a href="<?= base_url('admin/v_jadwalpatrol'); ?>" class="nav-link active">
                                                <i class="fas fa-calendar-alt nav-icon"></i>
                                                <p>Jadwal Patrol</p>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/v_jadwalpatrol'); ?>" class="nav-link">
                                                <i class="fas fa-calendar-alt nav-icon"></i>
                                                <p>Jadwal Patrol</p>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-header">User</li>
                <li class="nav-item">
                    <?php if ($judul == 'My Profile') : ?>
                        <a href="#" class="nav-link active">
                        <?php else : ?>
                            <a href="#" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-fw fa-user-circle"></i>
                            <p>
                                My Profile
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($title == 'Edit Profile') : ?>
                                        <a href="<?= base_url('user/v_editprofile'); ?>" class="nav-link active">
                                            <i class="fas fa-edit nav-icon"></i>
                                            <p>Edit Profile</p>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= base_url('user/v_editprofile'); ?>" class="nav-link">
                                            <i class="fas fa-edit nav-icon"></i>
                                            <p>Edit Profile</p>
                                        </a>
                                    <?php endif; ?>
                                </li>
                                <li class="nav-item">
                                    <?php if ($title == 'View Profile') : ?>
                                        <a href="<?= base_url('user/v_viewprofile'); ?>" class="nav-link active">
                                            <i class="fas fa-image nav-icon"></i>
                                            <p>View Profile</p>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= base_url('user/v_viewprofile'); ?>" class="nav-link">
                                            <i class="fas fa-image nav-icon"></i>
                                            <p>View Profile</p>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                </li>

                <li class="nav-header">Karyawan</li>
                <?php if ($level == 'Seksi' || $level == 'Sekretariat') : ?>
                    <li class="nav-item">
                        <?php if ($judul == 'Temuan Patrol') : ?>
                            <a href="#" class="nav-link active">
                            <?php else : ?>
                                <a href="#" class="nav-link">
                                <?php endif; ?>
                                <i class="nav-icon fas fa-fw fa-tasks"></i>
                                <p>
                                    Temuan Patrol
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if ($title == 'Jadwal Temuan') : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_jadwaltemuan'); ?>" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal Temuan</p>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_jadwaltemuan'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal Temuan</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($title == 'Bukti Temuan') : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_buktitemuan'); ?>" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bukti Temuan</p>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_buktitemuan'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bukti Temuan</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                    </li>
                <?php endif; ?>

                <?php if ($level == 'Seksi' || $level == 'Sekretariat') : ?>
                    <li class="nav-item">
                        <?php if ($judul == 'Perbaikan Temuan') : ?>
                            <a href="#" class="nav-link active">
                            <?php else : ?>
                                <a href="#" class="nav-link">
                                <?php endif ?>

                                <i class="nav-icon fas fa-fw fa-tasks"></i>
                                <p>
                                    Perbaikan Temuan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if ($title == 'Jadwal Perbaikan') : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_jadwalperbaikan'); ?>" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal Perbaikan</p>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_jadwalperbaikan'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal Perbaikan</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($title == 'Bukti Perbaikan') : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_buktiperbaikan'); ?>" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bukti Perbaikan</p>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_buktiperbaikan'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bukti Perbaikan</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                    </li>
                <?php endif; ?>

                <?php if ($level == 'Sekretariat') : ?>
                    <li class="nav-item">
                        <?php if ($judul == 'Verifikasi Perbaikan') : ?>
                            <a href="#" class="nav-link active">
                            <?php else : ?>
                                <a href="#" class="nav-link">
                                <?php endif; ?>
                                <i class="nav-icon fas fa-fw fa-tasks"></i>
                                <p>
                                    Verifikasi Perbaikan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if ($title == 'Jadwal Verifikasi') : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_jadwalverifikasi'); ?>" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal Verifikasi</p>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_jadwalverifikasi'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jadwal Verifikasi</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($title == 'Bukti Verifikasi') : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_buktiverifikasi'); ?>" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bukti Verifikasi</p>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url('karyawan/v_buktiverifikasi'); ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bukti Verifikasi</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>