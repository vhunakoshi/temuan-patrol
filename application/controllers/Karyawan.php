<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->model('M_Karyawan', 'karyawan');
        $this->load->helper('date');
        $this->load->library('form_validation');
    }

    public function index()
    {
        redirect('karyawan/v_jadwalpatrol');
    }

    public function template($data, $posisi)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karyawan/' . $posisi, $data);
        $this->load->view('templates/footer', $data);
    }

    //============================================ Jadwal Patrol ==============================================
    public function v_jadwaltemuan()
    {
        $data['judul'] = 'Temuan Patrol';
        $data['title'] = 'Jadwal Temuan';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['pegawai'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $cari_id = $this->karyawan->cariPosisiUser($this->session->userdata('username'));
        $cari_tim = $this->karyawan->cariPosisiTim($cari_id);
        $data['jadwal'] = $this->karyawan->getJadwalPendingan($cari_tim);

        $posisi = 'v_jadwaltemuan';
        $this->template($data, $posisi);
    }

    public function getUbahJadwalPatrol()
    {
        echo json_encode($this->karyawan->getJadwalByIdJadwal($_POST['id']));
    }

    public function getUbahMasterPetugas()
    {
        echo json_encode($this->karyawan->getMasterPetugas($_POST['id']));
    }

    public function getUbahAnggota()
    {
        echo json_encode($this->karyawan->changeAnggota($_POST['id']));
    }

    //============================================ Bukti Temuan Patrol ==============================================
    public function v_buktitemuan()
    {
        $data['judul'] = 'Temuan Patrol';
        $data['title'] = 'Bukti Temuan';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['pegawai'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $cari_id = $this->karyawan->cariPosisiUser($this->session->userdata('username'));
        $cari_tim = $this->karyawan->cariPosisiTim($cari_id);
        $data['jadwal'] = $this->karyawan->getJadwalAll($cari_tim);

        $posisi = 'v_buktitemuan';
        $this->template($data, $posisi);
    }

    public function v_viewbuktitemuan($id_jadwal)
    {
        $data['judul'] = 'Temuan Patrol';
        $data['title'] = 'Bukti Temuan';
        $data['user'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalByIdJadwal($id_jadwal);
        $data['ketuaTim'] = $this->karyawan->getKetuaTim($id_jadwal);
        $data['seksi'] = $this->db->get('master_seksi')->result_array();
        $data['daftarTemuan'] = $this->karyawan->getDaftarTemuan($id_jadwal);

        $posisi = 'v_viewbuktitemuan';
        $this->template($data, $posisi);
    }

    public function v_uploadbuktitemuan($id_jadwal)
    {
        $data['judul'] = 'Temuan Patrol';
        $data['title'] = 'Bukti Temuan';
        $data['user'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalByIdJadwal($id_jadwal);
        $data['ketuaTim'] = $this->karyawan->getKetuaTim($id_jadwal);
        $data['seksi'] = $this->db->get('master_seksi')->result_array();
        $data['daftarTemuan'] = $this->karyawan->getDaftarTemuan($id_jadwal);

        $posisi = 'v_uploadbuktitemuan';
        $this->template($data, $posisi);
    }

    public function uploadBuktiTemuan($id_jadwal)
    {
        $this->form_validation->set_rules('id_seksi', 'Id_seksi', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Input Bukti masih ada yang belum diisi</div>');
            redirect('karyawan/v_uploadbuktitemuan/' . $id_jadwal);
        } else {
            //cek ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $config['upload_path'] = './assets/img/temuan_patrol/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '5120';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data();

                    //compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/temuan_patrol/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width']         = 900;
                    $config['height']       = 550;
                    $config['new_image'] = './assets/img/temuan_patrol/' . $image['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $new_image = $this->upload->data('file_name', $this->session->userdata('username'));

                    $data = [
                        'id_seksi' => $this->input->post('id_seksi'),
                        'id_jadwal' => $id_jadwal,
                        'foto_temuan' => $new_image,
                        'uraian_temuan' => $this->input->post('keterangan'),
                        'kategori' => $this->input->post('kategori'),
                        'action' => 'null'
                    ];
                    $this->db->insert('bukti_temuan', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Temuan Berhasil ditambahkan!</div>');
                    redirect('karyawan/v_uploadbuktitemuan/' . $id_jadwal);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gambar tidak support dan harus dibawah 2MB !!</div>');
                    redirect('karyawan/v_uploadbuktitemuan/' . $id_jadwal);
                }
            } else {
                $data = [
                    'id_seksi' => $this->input->post('id_seksi'),
                    'id_jadwal' => $id_jadwal,
                    'foto_temuan' => 'default.jpg',
                    'uraian_temuan' => $this->input->post('keterangan'),
                    'kategori' => $this->input->post('kategori'),
                    'action' => 'null'
                ];

                $this->db->insert('bukti_temuan', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Temuan Berhasil ditambahkan!</div>');
                redirect('karyawan/v_uploadbuktitemuan/' . $id_jadwal);
            }
        }
    }

    public function updateStatusPendingan($id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('jadwal_patrol', ['status' => 'Perbaikan Temuan']);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Temuan Patrol Berhasil dilaporkan!</div>');
        redirect('karyawan/v_buktitemuan');
    }

    public function hapus_datatemuan($id_temuan, $id_jadwal)
    {
        $this->karyawan->hapusDataTemuan($id_temuan);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Temuan Berhasil dihapus!</div>');
        redirect('karyawan/v_uploadbuktitemuan/' . $id_jadwal);
    }
    //============================================ Jadwal Perbaikan ==============================================
    public function v_jadwalperbaikan()
    {
        $data['judul'] = 'Perbaikan Temuan';
        $data['title'] = 'Jadwal Perbaikan';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['pegawai'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $cari_id_seksi = $this->karyawan->cariPosisiSeksi($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalPerbaikan($cari_id_seksi);

        $posisi = 'v_jadwalperbaikan';
        $this->template($data, $posisi);
    }

    //============================================= Bukti Perbaikan ==============================================
    public function v_buktiperbaikan()
    {
        $data['judul'] = 'Perbaikan Temuan';
        $data['title'] = 'Bukti Perbaikan';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['pegawai'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $cari_id_seksi = $this->karyawan->cariPosisiSeksi($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalBuktiPerbaikan($cari_id_seksi);

        $posisi = 'v_buktiperbaikan';
        $this->template($data, $posisi);
    }

    public function v_uploadbuktiperbaikan($id_jadwal)
    {
        $data['judul'] = 'Perbaikan Temuan';
        $data['title'] = 'Bukti Temuan';
        $data['user'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalByIdJadwal($id_jadwal);
        $data['ketuaTim'] = $this->karyawan->getKetuaTim($id_jadwal);
        $data['seksi'] = $this->karyawan->cariPosisiSeksi($this->session->userdata('username'));

        $id_seksi = $this->karyawan->cariPosisiSeksi($this->session->userdata('username'));
        $data['daftarTemuan'] = $this->karyawan->getDaftarTemuanByIdSeksi($id_jadwal, $id_seksi);
        $data['daftarPerbaikan'] = $this->karyawan->getDaftarPerbaikan($id_jadwal, $id_seksi);
        $data['totalDataPerbaikan'] = $this->karyawan->totalDataPerbaikan($id_jadwal);

        $posisi = 'v_uploadbuktiperbaikan';
        $this->template($data, $posisi);
    }

    public function v_viewbuktiperbaikan($id_jadwal)
    {
        $data['judul'] = 'Perbaikan Temuan';
        $data['title'] = 'Bukti Temuan';
        $data['user'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalByIdJadwal($id_jadwal);
        $data['ketuaTim'] = $this->karyawan->getKetuaTim($id_jadwal);

        $id_seksi = $this->karyawan->cariPosisiSeksi($this->session->userdata('username'));

        $data['daftarTemuan'] = $this->karyawan->getDaftarTemuanByIdSeksi($id_jadwal, $id_seksi);
        $data['daftarPerbaikan'] = $this->karyawan->getDaftarPerbaikan($id_jadwal, $id_seksi);
        $data['totalDataPerbaikan'] = $this->karyawan->totalDataPerbaikan($id_jadwal);

        $posisi = 'v_viewbuktiperbaikan';
        $this->template($data, $posisi);
    }

    public function uploadBuktiPerbaikan($id_jadwal)
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Input Bukti masih ada yang belum diisi</div>');
            redirect('karyawan/v_uploadbuktiperbaikan/' . $id_jadwal);
        } else {
            //cek ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $config['upload_path'] = './assets/img/perbaikan_temuan/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '5120';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data();

                    //compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/perbaikan_temuan/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width']         = 900;
                    $config['height']       = 550;
                    $config['new_image'] = './assets/img/perbaikan_temuan/' . $image['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $new_image = $this->upload->data('file_name', $this->session->userdata('username'));

                    $data = [
                        'id_temuan' => $this->input->post('id_temuan'),
                        'uraian_perbaikan' => $this->input->post('keterangan'),
                        'foto_perbaikan' => $new_image,
                    ];
                    $this->db->insert('bukti_perbaikan', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Perbaikan Berhasil ditambahkan!</div>');
                    redirect('karyawan/v_uploadbuktiperbaikan/' . $id_jadwal);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gambar tidak support dan harus dibawah 2MB !!</div>');
                    redirect('karyawan/v_uploadbuktiperbaikan/' . $id_jadwal);
                }
            } else {
                $data = [
                    'id_temuan' => $this->input->post('id_temuan'),
                    'uraian_perbaikan' => $this->input->post('keterangan'),
                    'foto_perbaikan' => 'default.jpg',
                ];

                $this->db->insert('bukti_perbaikan', $data);
                
                //update status
                $this->db->set('action', 'ok');
                $this->db->where('id_temuan', $this->input->post('id_temuan'));
                $this->db->update('bukti_temuan');
                
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Perbaikan Berhasil ditambahkan!</div>');
                redirect('karyawan/v_uploadbuktiperbaikan/' . $id_jadwal);
            }
        }
    }

    public function check_action($id_jadwal) {
        $no = 0;
        $list = $this->karyawan->cekDataAction($id_jadwal);
        $target = $this->karyawan->totalDataAction($id_jadwal);

        foreach($list as $l) {
            if($l['action'] == 'ok') {
                $no = $no + 1;
            }
        }

        if ($no == $target['numrows']) {
            return 'benar';
        } else {
            return 'salah';
        }

    }

    public function updateStatusPerbaikan($id_jadwal, $id_seksi)
    {
        $seksi = $this->karyawan->update_action($id_jadwal, $id_seksi);
        foreach ($seksi as $s) {
            $this->db->set('action', 'ok');
            $this->db->where('id_temuan', $s['id_temuan']); 
            $this->db->update('bukti_temuan');       
        }
        
        $status = $this->check_action($id_jadwal);
        
        if($status == 'benar') {
            print_r($status);
            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->update('jadwal_patrol', ['status' => 'Verifikasi Temuan']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perbaikan Temuan Berhasil dilaporkan!</div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Perbaikan Temuan Masih dalam Proses Perbaikan pada Seksi yang Lain</div>');
        }

        redirect('karyawan/v_buktiperbaikan');
    }

    public function hapus_dataperbaikan($id_perbaikan, $id_temuan, $id_jadwal)
    {
        $this->karyawan->hapusDataPerbaikan($id_perbaikan);

        //update status
        $this->db->set('action', 'null');
        $this->db->where('id_temuan', $id_temuan);
        $this->db->update('bukti_temuan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Perbaikan Berhasil dihapus!</div>');
        redirect('karyawan/v_uploadbuktiperbaikan/' . $id_jadwal);
    }

    //============================================ Jadwal Verifikasi ==============================================
    public function v_jadwalverifikasi()
    {
        $data['judul'] = 'Verifikasi Perbaikan';
        $data['title'] = 'Jadwal Verifikasi';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['pegawai'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $cari_id = $this->karyawan->cariPosisiUser($this->session->userdata('username'));
        $cari_tim = $this->karyawan->cariPosisiTim($cari_id);
        $data['jadwal'] = $this->karyawan->getJadwalVerifikasi($cari_tim);

        $posisi = 'v_jadwalverifikasi';
        $this->template($data, $posisi);
    }

    //============================================= Bukti Verifikasi ==============================================
    public function v_buktiverifikasi()
    {
        $data['judul'] = 'Verifikasi Perbaikan';
        $data['title'] = 'Bukti Verifikasi';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $cari_id = $this->karyawan->cariPosisiUser($this->session->userdata('username'));
        $data['id_tim'] = $this->karyawan->cariPosisiTim($cari_id);

        $data['pegawai'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalBuktiVerifikasi();

        $posisi = 'v_buktiverifikasi';
        $this->template($data, $posisi);
    }

    public function v_viewverifikasiperbaikan($id_jadwal)
    {
        $data['judul'] = 'Verifikasi Perbaikan';
        $data['title'] = 'Bukti Verifikasi';
        $data['user'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalByIdJadwal($id_jadwal);
        $data['ketuaTim'] = $this->karyawan->getKetuaTim($id_jadwal);

        $data['daftarTemuan'] = $this->karyawan->getDaftarTemuanByIdJadwal($id_jadwal);
        $data['daftarPerbaikan'] = $this->karyawan->getDaftarPerbaikanByIdJadwal($id_jadwal);
        $data['daftarVerifikasi'] = $this->karyawan->getDaftarVerifikasi($id_jadwal);
        $data['totalDataPerbaikan'] = $this->karyawan->totalDataPerbaikan($id_jadwal);
        $data['totalDataVerifikasi'] = $this->karyawan->totalDataVerifikasi($id_jadwal);

        $posisi = 'v_viewverifikasiperbaikan';
        $this->template($data, $posisi);
    }

    public function v_uploadbuktiverifikasi($id_jadwal)
    {
        $data['judul'] = 'Verifikasi Perbaikan';
        $data['title'] = 'Bukti Verifikasi';
        $data['user'] = $this->karyawan->getPegawai($this->session->userdata('username'));
        $data['jadwal'] = $this->karyawan->getJadwalByIdJadwal($id_jadwal);
        $data['ketuaTim'] = $this->karyawan->getKetuaTim($id_jadwal);

        $data['daftarTemuan'] = $this->karyawan->getDaftarTemuanByIdJadwal($id_jadwal);
        $data['daftarPerbaikan'] = $this->karyawan->getDaftarPerbaikanByIdJadwal($id_jadwal);
        $data['daftarVerifikasi'] = $this->karyawan->getDaftarVerifikasi($id_jadwal);
        $data['totalDataPerbaikan'] = $this->karyawan->totalDataPerbaikan($id_jadwal);
        $data['totalDataVerifikasi'] = $this->karyawan->totalDataVerifikasi($id_jadwal);

        $posisi = 'v_uploadbuktiverifikasi';
        $this->template($data, $posisi);
    }

    public function uploadBuktiVerifikasi($id_jadwal)
    {
        $this->form_validation->set_rules('verifikasi', 'Verifikasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data seksi masih ada yang belum diisi atau sudah ada di dalam system</div>');
            redirect('karyawan/v_uploadbuktiverifikasi/' . $id_jadwal);
        } else {
            $data = [
                'id_temuan' => $this->input->post('id_temuan'),
                'id_perbaikan' => $this->input->post('id_perbaikan'),
                'verifikasi' => $this->input->post('verifikasi')
            ];
            $this->db->insert('verifikasi_perbaikan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Verifikasi Berhasil ditambahkan!</div>');
            redirect('karyawan/v_uploadbuktiverifikasi/' . $id_jadwal);
        }
    }

    public function check_final($id_jadwal) {
        $no = 0;
        $list = $this->karyawan->cekDataAction($id_jadwal);
        $target = $this->karyawan->totalDataAction($id_jadwal);

        foreach($list as $l) {
            if($l['action'] == 'ok') {
                $no = $no + 1;
            }
        }

        if ($no == $target['numrows']) {
            return 'benar';
        } else {
            return 'salah';
        }

    }

    public function updateStatusVerifikasi($id_jadwal)
    {
        $totalDataTemuan = $this->karyawan->totalDataTemuan($id_jadwal);
        $totalDataVerifikasi = $this->karyawan->totalDataVerifikasi($id_jadwal);
        
        if($totalDataTemuan['numrows'] == $totalDataVerifikasi['numrows']) {
            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->update('jadwal_patrol', ['status' => 'Success']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Verifikasi Temuan Berhasil dilaporkan!</div>');
            redirect('karyawan/v_buktiverifikasi');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Masih ada yang belum diverifikasi</div>');
            redirect('karyawan/v_uploadbuktiverifikasi/'. $id_jadwal);
        }
    }

    public function hapus_dataverifikasi($id_verifikasi, $id_jadwal)
    {
        $this->karyawan->hapusDataVerifikasi($id_verifikasi);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Verifikasi Berhasil dihapus!</div>');
        redirect('karyawan/v_uploadbuktiverifikasi/' . $id_jadwal);
    }
}
