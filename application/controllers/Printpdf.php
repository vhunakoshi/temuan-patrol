<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printpdf extends CI_Controller {
    
    public function bukti_temuan()
    {
        $this->load->model('M_Karyawan', 'karyawan');
        $this->load->helper('date');
        $this->load->library('form_validation');

        $id = $this->input->post('id') ?? 1;
        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Laporan Bukti Temuan';
        $this->data['jadwal'] = $this->karyawan->getJadwalByIdJadwal(16);
        $this->data['bukti_temuan'] = $this->karyawan->getDaftarTemuan(16);
        
        $file_pdf = date('Ymd')."_bukti_temuan";
        $paper = 'A4';
        $orientation = "portrait";
		$html = $this->load->view('export/bukti_temuan', $this->data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function perbaikan_temuan()
    {
        $this->load->model('M_Karyawan', 'karyawan');
        $this->load->helper('date');
        $this->load->library('form_validation');

        $id = $this->input->post('id') ?? 1;
        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Laporan Bukti Perbaikan';
        $this->data['jadwal'] = $this->karyawan->getJadwalByIdJadwal(16);
        $this->data['bukti_temuan'] = $this->karyawan->getDaftarTemuan(16);
        
        $file_pdf = date('Ymd')."_bukti_perbaikan";
        $paper = 'A4';
        $orientation = "landscape";
		$html = $this->load->view('export/bukti_perbaikan', $this->data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function verifikasi_perbaikan()
    {
        $this->load->model('M_Karyawan', 'karyawan');
        $this->load->helper('date');
        $this->load->library('form_validation');

        $id = $this->input->post('id') ?? 1;
        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Laporan Verifikasi Perbaikan';
        $this->data['jadwal'] = $this->karyawan->getJadwalByIdJadwal(16);
        $this->data['bukti_temuan'] = $this->karyawan->getDaftarTemuan(16);
        
        $file_pdf = date('Ymd')."_verifikasi_perbaikan";
        $paper = 'A4';
        $orientation = "landscape";
		$html = $this->load->view('export/verifikasi_perbaikan', $this->data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}