<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->library('form_validation');
    }

    public function index()
    {
        redirect('user/v_viewprofile');
    }

    public function v_viewprofile()
    {
        $data['judul'] = 'My Profile';
        $data['title'] = 'View Profile';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/v_viewprofile', $data);
        $this->load->view('templates/footer');
    }

    public function v_editprofile()
    {
        $data['judul'] = 'My Profile';
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name_user', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/v_editprofile', $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nama Tidak Boleh Kosong !!</div>');
        } else {
            $username = $this->input->post('username');
            $name_user = $this->input->post('name_user');

            //cek ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '5120';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data();

                    //compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/profile/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width']         = 550;
                    $config['height']       = 550;
                    $config['new_image'] = './assets/img/profile/' . $image['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">File Terlalu Besar, Maximum file 5 MB !!</div>');
                    redirect('user/v_viewprofile');
                }
            }

            $this->db->set('name_user', $name_user);
            $this->db->where('username', $username);
            $this->db->update('petugas');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data User Berhasil diubah</div>');
            redirect('user/v_viewprofile');
        }
    }

    public function v_changepassword()
    {
        $data['judul'] = 'My Profile';
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('petugas', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password1', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'New Password2', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/v_changepassword', $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data yang anda masukan belum lengkap</div>');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', 'Password Lama, Salah!');
                redirect('user/v_changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data yang anda masukan belum lengkap</div>');
                    redirect('user/v_changepassword');
                } else {
                    //password sudah oke
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('petugas');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil diubah</div>');
                    redirect('user/v_editprofile');
                }
            }
        }
    }
}
