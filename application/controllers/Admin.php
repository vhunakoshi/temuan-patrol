<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->model('M_admin', 'admin');
        $this->load->helper('date');
    }

    public function index()
    {
        redirect('admin/v_beranda');
    }

    public function template($data, $posisi)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/' . $posisi, $data);
        $this->load->view('templates/footer', $data);
    }

    public function v_beranda()
    {
        $data['judul'] = 'Dashboard';
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['tot_jml_seksi'] = $this->db->query("SELECT `id_seksi` FROM master_seksi")->num_rows();
        $data['tot_jml_zona'] = $this->db->query("SELECT `id_zona` FROM master_zona")->num_rows();
        $data['tot_jml_tim'] = $this->db->query("SELECT `id_tim` FROM master_tim")->num_rows();
        $data['tot_jml_temuan'] = $this->db->query("SELECT `status` FROM jadwal_patrol WHERE `status` = 'Pendingan Job'")->num_rows();
        $data['tot_jml_perbaikan'] =  $this->db->query("SELECT `status` FROM jadwal_patrol WHERE `status` = 'Perbaikan Temuan'")->num_rows();
        $data['tot_jml_verifikasi'] =  $this->db->query("SELECT `status` FROM jadwal_patrol WHERE `status` = 'Verifikasi Temuan'")->num_rows();
        $data['tot_jml_success'] = $this->db->query("SELECT `status` FROM jadwal_patrol WHERE `status` = 'Success'")->num_rows();
        $data['tot_petugas'] = $this->db->count_all('petugas');
        $posisi = 'v_beranda';
        $this->template($data, $posisi);
    }

    //============================================ Master User ===================================================

    public function v_masterpetugas()
    {
        $data['judul'] = 'Dashboard';
        $data['title'] = 'Master Petugas';
        $data['user'] = $this->db->get_where('petugas', ['level' =>
        $this->session->userdata('level')])->row_array();

        $data['petugas'] = $this->admin->getPegawai();
        $data['seksi'] = $this->db->get('master_seksi')->result_array();

        $posisi = 'v_masterpetugas';
        $this->template($data, $posisi);
    }

    public function addMasterPetugas()
    {
        $this->form_validation->set_rules('name_user', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[petugas.username]', ['is_unique' => 'Username ini Sudah Pernah Teregistrasi!']);
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('id_seksi', 'Id_seksi', 'required');
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[5]|matches[password2]', ['matches' => 'Password tidak sama!', 'min_length' => 'Password terlalu pendek!']);
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data petugas masih ada yang belum diisi atau sudah ada di dalam system</div>');
            redirect('admin/v_masterpetugas');
        } else {
            $username = $this->input->post('username', true);
            $data = [
                'name_user' => htmlspecialchars($this->input->post('name_user', true)),
                'username' => htmlspecialchars($username),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'level' => $this->input->post('level'),
                'id_seksi' => $this->input->post('id_seksi')
            ];
            $this->db->insert('petugas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Petugas Berhasil ditambahkan!</div>');
            redirect('admin/v_masterpetugas');
        }
    }

    public function getUbahMasterPetugas()
    {
        echo json_encode($this->admin->getMasterPetugas($_POST['id']));
    }

    public function updateMasterPetugas()
    {
        $this->form_validation->set_rules('name_user', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('id_seksi', 'Id_seksi', 'required');
        // $this->form_validation->set_rules('password1', 'Password', 'matches[password2]');
        // $this->form_validation->set_rules('password2', 'Password', 'matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data petugas masih ada yang belum diisi</div>');
            redirect('admin/v_masterpetugas');
        } else {
            $id_user = $this->input->post('id');
            $username = $this->input->post('username', true);

            if ($this->input->post('password1') != null) {
                $pwsd = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            } else {
                $pwsd = $this->admin->getPasswordPetugas($this->input->post('id'));
            }

            $data = [
                'name_user' => htmlspecialchars($this->input->post('name_user', true)),
                'username' => htmlspecialchars($username),
                'password' => $pwsd,
                'level' => $this->input->post('level'),
                'id_seksi' => $this->input->post('id_seksi')
            ];

            $this->db->where('id_user', $id_user);
            $this->db->update('petugas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Petugas Berhasil diupdate!</div>');
            redirect('admin/v_masterpetugas');
        }
    }

    public function hapus_petugas($u)
    {
        $this->admin->hapusDataPetugas($u);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Petugas Berhasil dihapus!</div>');
        redirect('admin/v_masterpetugas');
    }

    //============================================ Master Zona ===================================================

    public function v_masterzona()
    {
        $data['judul'] = 'Dashboard';
        $data['title'] = 'Master Zona';
        $data['user'] = $this->db->get_where('petugas', ['level' =>
        $this->session->userdata('level')])->row_array();

        $data['zona'] = $this->db->get('master_zona')->result_array();
        $data['petugas'] = $this->admin->getPegawai();

        $posisi = 'v_masterzona';
        $this->template($data, $posisi);
    }

    public function addMasterZona()
    {
        $this->form_validation->set_rules('nama_zona', 'Nama Zona', 'required|trim|is_unique[masterzona.nama_zona]', ['is_unique' => 'Zona ini Sudah Pernah Teregistrasi!']);
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data zona masih ada yang belum diisi atau sudah ada di dalam system</div>');
            redirect('admin/v_masterzona');
        } else {
            $data = [
                'nama_zona' => $this->input->post('nama_zona'),
                'lokasi' => $this->input->post('lokasi')
            ];
            $this->db->insert('master_zona', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Zona Berhasil ditambahkan!</div>');
            redirect('admin/v_masterzona');
        }
    }

    public function getUbahMasterZona()
    {
        echo json_encode($this->admin->getMasterZona($_POST['id']));
    }

    public function updateMasterZona()
    {
        $this->form_validation->set_rules('nama_zona', 'Nama Zona', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data zona masih ada yang belum diisi</div>');
            redirect('admin/v_masterzona');
        } else {
            $id_zona = $this->input->post('id');

            $data = [
                'nama_zona' => $this->input->post('nama_zona'),
                'lokasi' => $this->input->post('lokasi')
            ];

            $this->db->where('id_zona', $id_zona);
            $this->db->update('master_zona', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Zona Berhasil diupdate!</div>');
            redirect('admin/v_masterzona');
        }
    }

    public function hapus_zona($u)
    {
        $this->admin->hapusDataZona($u);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Zona Berhasil dihapus!</div>');
        redirect('admin/v_masterzona');
    }

    //============================================ Master Tim ===================================================

    public function v_mastertim()
    {
        $data['judul'] = 'Dashboard';
        $data['title'] = 'Master Tim';
        $data['user'] = $this->db->get_where('petugas', ['level' =>
        $this->session->userdata('level')])->row_array();

        $data['tim'] = $this->admin->getTim();
        $data['petugas'] = $this->db->get('petugas')->result_array();

        $posisi = 'v_mastertim';
        $this->template($data, $posisi);
    }

    public function addMasterTim()
    {
        $this->form_validation->set_rules('nama_tim', 'Nama Tim', 'required|trim|is_unique[master_tim.nama_tim]', ['is_unique' => 'Tim ini Sudah Pernah Teregistrasi!']);
        $this->form_validation->set_rules('id_user', 'ID User', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tim masih ada yang belum diisi atau sudah ada di dalam system</div>');
            redirect('admin/v_mastertim');
        } else {
            //cek ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $config['upload_path'] = './assets/img/logo/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data();

                    //compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/logo/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width']         = 550;
                    $config['height']       = 550;
                    $config['new_image'] = './assets/img/logo/' . $image['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $new_image = $this->upload->data('file_name');

                    $data = [
                        'nama_tim' => $this->input->post('nama_tim'),
                        'id_user' => $this->input->post('id_user'),
                        'logo_tim' => $new_image
                    ];
                    $this->db->insert('master_tim', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tim Berhasil ditambahkan!</div>');
                    redirect('admin/v_mastertim');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gambar tidak support dan harus dibawah 2MB !!</div>');
                    redirect('admin/v_mastertim');
                }
            } else {
                $data = [
                    'nama_tim' => $this->input->post('nama_tim'),
                    'id_user' => $this->input->post('id_user'),
                    'logo_tim' => 'default.png'
                ];

                $this->db->insert('master_tim', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tim Berhasil ditambahkan!</div>');
                redirect('admin/v_mastertim');
            }
        }
    }

    public function getUbahMasterTim()
    {
        echo json_encode($this->admin->getMasterTim($_POST['id']));
    }

    public function updateMasterTim()
    {
        $this->form_validation->set_rules('nama_tim', 'Nama Tim', 'required');
        $this->form_validation->set_rules('id_user', 'ID User', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tim masih ada yang belum diisi</div>');
            redirect('admin/v_mastertim');
        } else {
            $id_tim = $this->input->post('id');

            //cek ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $config['upload_path'] = './assets/img/logo/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data();

                    //compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/logo/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width']         = 550;
                    $config['height']       = 550;
                    $config['new_image'] = './assets/img/logo/' . $image['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $old_image = $this->admin->getPictureLogo($id_tim);
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/logo/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');

                    $data = [
                        'nama_tim' => $this->input->post('nama_tim'),
                        'id_user' => $this->input->post('id_user'),
                        'logo_tim' => $new_image
                    ];

                    $this->db->where('id_tim', $id_tim);
                    $this->db->update('master_tim', $data);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tim Berhasil diUbah!</div>');
                    redirect('admin/v_mastertim');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gambar tidak support dan harus dibawah 2MB !!</div>');
                    redirect('admin/v_mastertim');
                }
            } else {
                $data = [
                    'nama_tim' => $this->input->post('nama_tim'),
                    'id_user' => $this->input->post('id_user'),
                ];

                $this->db->where('id_tim', $id_tim);
                $this->db->update('master_tim', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tim Berhasil diUbah!</div>');
                redirect('admin/v_mastertim');
            }
        }
    }

    public function hapus_tim($u)
    {
        $this->admin->hapusDataTim($u);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Tim Berhasil dihapus!</div>');
        redirect('admin/v_mastertim');
    }

    public function v_changetim($id)
    {
        $data['judul'] = 'Dashboard';
        $data['title'] = 'Anggota Tim';
        $data['user'] = $this->db->get_where('petugas', ['level' =>
        $this->session->userdata('level')])->row_array();

        $data['team'] = $this->admin->changeTim($id);
        $data['anggota'] = $this->admin->changeAnggota($id);

        $data['row'] = $this->db->query("SELECT * FROM detail_anggota WHERE id_tim = $id")->row();
        $data['petugas'] = $this->db->get("petugas")->result_array();
        $data['id_tim'] = $id;

        $data['pendingan'] = $this->db->query("SELECT `status` FROM jadwal_patrol WHERE `status` = 'Pendingan Job' AND `id_tim` = $id")->num_rows();
        $data['progress'] = $this->db->query("SELECT `status` FROM jadwal_patrol WHERE `status` = 'Perbaikan Temuan' OR `status` = 'Verifikasi Temuan' AND `id_tim` = $id")->num_rows();
        $data['success'] = $this->db->query("SELECT `status` FROM jadwal_patrol WHERE `status` = 'Success' AND `id_tim` = $id")->num_rows();
        $posisi = 'v_changetim';
        $this->template($data, $posisi);
    }

    public function addAnggotaTim()
    {
        $this->form_validation->set_rules('id_user', 'ID User', 'required');
        $this->form_validation->set_rules('id_tim', 'ID Tim', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Anggota masih ada yang belum diisi</div>');
            redirect('admin/v_changetim');
        } else {
            $id_tim = $this->input->post('id_tim');

            $data = [
                'id_user' => $this->input->post('id_user'),
                'id_tim' => $id_tim
            ];
            $this->db->insert('detail_anggota', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anggota Berhasil ditambahkan!</div>');
            redirect('admin/v_changetim/' . $id_tim);
        }
    }

    public function getUbahAnggota()
    {
        echo json_encode($this->admin->changeAnggota($_POST['id']));
    }

    public function hapus_anggota($a, $id_tim)
    {
        $this->admin->hapusDetailAnggota($a);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anggota Berhasil dikurangi!</div>');
        redirect('admin/v_changetim/' . $id_tim);
    }

    //============================================ Master Seksi ===================================================

    public function v_masterseksi()
    {
        $data['judul'] = 'Dashboard';
        $data['title'] = 'Master Seksi';
        $data['user'] = $this->db->get_where('petugas', ['level' =>
        $this->session->userdata('level')])->row_array();

        $data['seksi'] = $this->db->get('master_seksi')->result_array();
        $data['petugas'] = $this->admin->getPegawai();

        $posisi = 'v_masterseksi';
        $this->template($data, $posisi);
    }

    public function addMasterSeksi()
    {
        $this->form_validation->set_rules('kode_seksi', 'Kode Seksi', 'required|trim|is_unique[master_seksi.nama_seksi]', ['is_unique' => 'Nama Seksi ini Sudah Pernah Teregistrasi!']);
        $this->form_validation->set_rules('nama_seksi', 'Nama Seksi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data seksi masih ada yang belum diisi atau sudah ada di dalam system</div>');
            redirect('admin/v_masterseksi');
        } else {
            $data = [
                'kode_seksi' => $this->input->post('kode_seksi'),
                'nama_seksi' => $this->input->post('nama_seksi')
            ];
            $this->db->insert('master_seksi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seksi Berhasil ditambahkan!</div>');
            redirect('admin/v_masterseksi');
        }
    }

    public function getUbahMasterSeksi()
    {
        echo json_encode($this->admin->getMasterSeksi($_POST['id']));
    }

    public function updateMasterSeksi()
    {
        $this->form_validation->set_rules('kode_seksi', 'Kode Seksi', 'required');
        $this->form_validation->set_rules('nama_seksi', 'Nama Seksi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data seksi masih ada yang belum diisi</div>');
            redirect('admin/v_masterseksi');
        } else {
            $id_seksi = $this->input->post('id');

            $data = [
                'kode_seksi' => $this->input->post('kode_seksi'),
                'nama_seksi' => $this->input->post('nama_seksi')
            ];

            $this->db->where('id_seksi', $id_seksi);
            $this->db->update('master_seksi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Seksi Berhasil diupdate!</div>');
            redirect('admin/v_masterseksi');
        }
    }

    public function hapus_seksi($u)
    {
        $this->admin->hapusDataSeksi($u);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Seksi Berhasil dihapus!</div>');
        redirect('admin/v_masterseksi');
    }

    //============================================ Jadwal Patrol ===================================================

    public function v_jadwalpatrol()
    {
        $data['judul'] = 'Dashboard';
        $data['title'] = 'Jadwal Patrol';
        $data['user'] = $this->db->get_where('petugas', ['level' =>
        $this->session->userdata('level')])->row_array();

        $data['tim'] = $this->admin->getTim();
        $data['zona'] = $this->db->get('master_zona')->result_array();
        $data['jadwal'] = $this->admin->getJadwalPatrol();

        $posisi = 'v_jadwalpatrol';
        $this->template($data, $posisi);
    }

    public function addJadwalPatrol()
    {
        $this->form_validation->set_rules('id_tim', 'Id Tim', 'required');
        $this->form_validation->set_rules('id_zona', 'Id zona', 'required');
        $this->form_validation->set_rules('tgl_patrol', 'Tgl patrol', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jadwal patrol masih ada yang belum diisi</div>');
            redirect('admin/v_jadwalpatrol');
        } else {
            $data = [
                'id_tim' => $this->input->post('id_tim'),
                'id_zona' => $this->input->post('id_zona'),
                'tgl_patrol' => $this->input->post('tgl_patrol'),
                'status' => 'Pendingan Job'
            ];

            $this->db->insert('jadwal_patrol', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal Patrol Berhasil ditambahkan!</div>');
            redirect('admin/v_jadwalpatrol');
        }
    }

    public function updateJadwalPatrol()
    {
        $this->form_validation->set_rules('id_tim', 'Id Tim', 'required');
        $this->form_validation->set_rules('id_zona', 'Id zona', 'required');
        $this->form_validation->set_rules('tgl_patrol', 'Tgl patrol', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jadwal patrol masih ada yang belum diisi</div>');
            redirect('admin/v_jadwalpatrol');
        } else {
            $status = $this->admin->getStatusPendingan($this->input->post('id'));
            $id_jadwal = $this->input->post('id');

            $data = [
                'id_tim' => $this->input->post('id_tim'),
                'id_zona' => $this->input->post('id_zona'),
                'tgl_patrol' => $this->input->post('tgl_patrol'),
                'status' => $status
            ];

            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->update('jadwal_patrol', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal Patrol Berhasil diupdate!</div>');
            redirect('admin/v_jadwalpatrol');
        }
    }

    public function getUbahJadwalPatrol()
    {
        echo json_encode($this->admin->getJadwal($_POST['id']));
    }

    public function hapus_jadwal($u)
    {
        $this->admin->hapusDataJadwal($u);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal Patrol Berhasil dihapus!</div>');
        redirect('admin/v_jadwalpatrol');
    }
}
