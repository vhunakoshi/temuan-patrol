<?php
defined('BASEPATH') or exit('NO direct script access allowed');

class M_karyawan extends CI_Model
{
    //========================================== Master Petugas =============================================

    public function getPegawai($username)
    {
        $query = "SELECT * from petugas a join master_seksi b on a.id_seksi = b.id_seksi WHERE `username` = '$username'";

        return $this->db->query($query)->row_array();
    }

    public function cariPosisiUser($username)
    {
        $query = $this->db->query("SELECT `id_user` FROM `petugas` WHERE `username` = '$username'");
        foreach ($query->result() as $q) {
            $id_user = $q->id_user;
        }
        return $id_user;
    }

    public function cariPosisiTim($id)
    {
        $query = $this->db->query("SELECT b.id_tim from detail_anggota a join master_tim b on a.id_tim = b.id_tim WHERE b.id_user = '$id' OR a.id_user = '$id'");
        $id_tim = 0;

        foreach ($query->result() as $n) {
            $id_tim = $n->id_tim;
        }

        if ($id_tim != 0) {
            return $id_tim;
        } else {
            return 0;
        }
    }

    public function getJadwalPendingan($id)
    {
        $query = "SELECT a.id_jadwal, a.tgl_patrol, a.status, b.id_tim, b.nama_tim, b.id_user, c.id_zona, c.nama_zona, c.lokasi FROM jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join master_zona c on a.id_zona=c.id_zona WHERE a.id_tim = $id AND a.status = 'Pendingan Job'";

        return $this->db->query($query)->result_array();
    }

    public function getJadwalAll($id)
    {
        $query = "SELECT a.id_jadwal, a.tgl_patrol, a.status, b.id_tim, b.nama_tim, b.id_user, c.id_zona, c.nama_zona, c.lokasi FROM jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join master_zona c on a.id_zona=c.id_zona WHERE a.id_tim = $id ";

        return $this->db->query($query)->result_array();
    }

    public function getJadwalByIdJadwal($id)
    {
        $query = "SELECT a.id_jadwal, a.tgl_patrol, a.status, b.id_tim, b.nama_tim, b.id_user, c.id_zona, c.nama_zona, c.lokasi FROM jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join master_zona c on a.id_zona=c.id_zona WHERE id_jadwal = $id";

        return $this->db->query($query)->row_array();
    }

    public function getMasterPetugas($id)
    {
        $query = "SELECT * FROM `petugas` WHERE id_user = $id";
        return $this->db->query($query)->row_array();
    }

    public function changeAnggota($id)
    {
        $query = "SELECT * from detail_anggota a join petugas b on a.id_user = b.id_user join master_seksi c on b.id_seksi = c.id_seksi WHERE id_tim = $id";

        return $this->db->query($query)->result_array();
    }

    public function getKetuaTim($id_jadwal)
    {
        $query = "SELECT c.name_user from jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join petugas c on b.id_user=c.id_user where id_jadwal = '$id_jadwal'";

        return $this->db->query($query)->row_array();
    }

    public function getDaftarTemuan($id_jadwal)
    {
        $query = "SELECT * FROM bukti_temuan a join master_seksi b on a.id_seksi=b.id_seksi WHERE id_jadwal = '$id_jadwal'";

        return $this->db->query($query)->result_array();
    }

    public function hapusDataTemuan($t)
    {
        $query = "DELETE FROM `bukti_temuan` WHERE `id_temuan` = $t";
        $this->db->query($query);
    }

    //================================================== Perbaikan Temuan ==============================================================

    public function getJadwalPerbaikan($id_seksi)
    {
        $query = "SELECT DISTINCT a.id_seksi, b.id_jadwal, b.tgl_patrol, b.status, c.nama_tim, d.nama_zona FROM bukti_temuan a join jadwal_patrol b on a.id_jadwal=b.id_jadwal join master_tim c on b.id_tim=c.id_tim join master_zona d on b.id_zona=d.id_zona join master_seksi e on a.id_seksi=e.id_seksi WHERE a.id_seksi = $id_seksi AND b.status = 'Perbaikan Temuan'";

        return $this->db->query($query)->result_array();
    }

    public function cariPosisiSeksi($username)
    {
        $query = $this->db->query("SELECT a.username, b.id_seksi FROM petugas a join master_seksi b on a.id_seksi=b.id_seksi WHERE `username` = '$username'");
        foreach ($query->result() as $q) {
            $id_seksi = $q->id_seksi;
        }
        return $id_seksi;
    }

    public function cariPosisiTemuan($id_jadwal)
    {
        $query = $this->db->query("SELECT a.id_temuan from bukti_temuan a join jadwal_patrol b on a.id_jadwal = b.id_jadwal WHERE b.id_jadwal = '$id_jadwal'");
        $id_temuan = 0;

        foreach ($query->result() as $n) {
            $id_temuan = $n->id_temuan;
        }

        if ($id_temuan != 0) {
            return $id_temuan;
        } else {
            return 0;
        }
    }

    public function getJadwalBuktiPerbaikan($id_seksi)
    {
        $query = "SELECT DISTINCT a.id_seksi, a.action, b.id_jadwal, b.tgl_patrol, b.status, c.nama_tim, d.nama_zona, d.lokasi FROM bukti_temuan a join jadwal_patrol b on a.id_jadwal=b.id_jadwal join master_tim c on b.id_tim=c.id_tim join master_zona d on b.id_zona=d.id_zona join master_seksi e on a.id_seksi=e.id_seksi WHERE a.id_seksi = $id_seksi AND (b.status = 'Verifikasi Temuan' OR b.status = 'Success' OR b.status = 'Perbaikan Temuan')";

        return $this->db->query($query)->result_array();
    }

    public function getDaftarTemuanByIdSeksi($id_jadwal, $id_seksi)
    {
        $query = "SELECT a.id_temuan, a.foto_temuan, a.uraian_temuan, a.kategori, b.id_jadwal, c.nama_tim, d.id_seksi, d.nama_seksi FROM `bukti_temuan` a join `jadwal_patrol` b on a.id_jadwal=b.id_jadwal join `master_tim` c on b.id_tim = c.id_tim join `master_seksi` d on a.id_seksi=d.id_seksi WHERE b.id_jadwal = '$id_jadwal' AND d.id_seksi = '$id_seksi'";

        return $this->db->query($query)->result_array();
    }

    public function getDaftarPerbaikan($id_jadwal, $id_seksi)
    {
        $query = "SELECT a.id_perbaikan, a.foto_perbaikan, a.uraian_perbaikan, b.id_temuan FROM bukti_perbaikan a join bukti_temuan b on a.id_temuan=b.id_temuan join jadwal_patrol c on b.id_jadwal=c.id_jadwal WHERE b.id_jadwal = '$id_jadwal' AND b.id_seksi = '$id_seksi'";

        return $this->db->query($query)->result_array();
    }

    public function totalDataPerbaikan ($id_jadwal)
    {
        $query = "SELECT COUNT(*) AS `numrows` FROM bukti_perbaikan a join bukti_temuan b on a.id_temuan=b.id_temuan join jadwal_patrol c on b.id_jadwal=c.id_jadwal where b.id_jadwal = '$id_jadwal'";
        
        return $this->db->query($query)->row_array();
    }

    public function totalDataAction ($id_jadwal) {
        $query = "SELECT COUNT(*) AS `numrows` FROM bukti_temuan a join master_seksi b on a.id_seksi=b.id_seksi join jadwal_patrol c on a.id_jadwal=c.id_jadwal WHERE a.id_jadwal = $id_jadwal";
        
        return $this->db->query($query)->row_array();
    }

    public function cekDataAction ($id_jadwal) {
        $query = "SELECT a.id_temuan, a.action FROM bukti_temuan a join master_seksi b on a.id_seksi=b.id_seksi join jadwal_patrol c on a.id_jadwal=c.id_jadwal WHERE a.id_jadwal = $id_jadwal";
        
        return $this->db->query($query)->result_array();
    }

    public function update_action ($id_jadwal, $id_seksi) {
        $query = "SELECT a.id_temuan, a.action FROM bukti_temuan a join master_seksi b on a.id_seksi=b.id_seksi join jadwal_patrol c on a.id_jadwal=c.id_jadwal WHERE a.id_jadwal = $id_jadwal AND a.id_seksi = $id_seksi";
        
        return $this->db->query($query)->result_array();
    }

    public function hapusDataPerbaikan($p)
    {
        $query = "DELETE FROM `bukti_perbaikan` WHERE `id_perbaikan` = $p";
        $this->db->query($query);
    }

    //=================================================== Verifikasi Temuan ===============================================================

    public function getDaftarTemuanByIdJadwal($id_jadwal)
    {
        $query = "SELECT a.id_temuan, a.foto_temuan, a.uraian_temuan, a.kategori, b.id_jadwal, c.id_tim, c.nama_tim, d.id_seksi, d.nama_seksi FROM `bukti_temuan` a join `jadwal_patrol` b on a.id_jadwal=b.id_jadwal join `master_tim` c on b.id_tim = c.id_tim join `master_seksi` d on a.id_seksi=d.id_seksi WHERE b.id_jadwal = '$id_jadwal'";

        return $this->db->query($query)->result_array();
    }

    public function getDaftarPerbaikanByIdJadwal($id_jadwal)
    {
        $query = "SELECT a.id_perbaikan, a.foto_perbaikan, a.uraian_perbaikan, b.id_temuan FROM bukti_perbaikan a join bukti_temuan b on a.id_temuan=b.id_temuan join jadwal_patrol c on b.id_jadwal=c.id_jadwal join master_tim d on c.id_tim=d.id_tim WHERE b.id_jadwal = '$id_jadwal'";

        return $this->db->query($query)->result_array();
    }

    public function getJadwalVerifikasi($id)
    {
        $query = "SELECT a.id_jadwal, a.tgl_patrol, a.status, b.id_tim, b.nama_tim, b.id_user, c.id_zona, c.nama_zona, c.lokasi FROM jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join master_zona c on a.id_zona=c.id_zona WHERE a.id_tim = $id AND a.status = 'Verifikasi Temuan'";

        return $this->db->query($query)->result_array();
    }

    public function getJadwalBuktiVerifikasi()
    {
        $query = "SELECT a.id_jadwal, a.tgl_patrol, a.status, b.id_tim, b.nama_tim, b.id_user, c.id_zona, c.nama_zona, c.lokasi FROM jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join master_zona c on a.id_zona=c.id_zona WHERE a.status = 'Verifikasi Temuan' OR a.status = 'Success'";

        return $this->db->query($query)->result_array();
    }

    public function getDaftarVerifikasi($id_jadwal)
    {
        $query = "SELECT * FROM verifikasi_perbaikan a join bukti_temuan b on a.id_temuan=b.id_temuan join jadwal_patrol c on b.id_jadwal=c.id_jadwal where b.id_jadwal = '$id_jadwal'";

        return $this->db->query($query)->result_array();
    }

    public function hapusDataVerifikasi($v)
    {
        $query = "DELETE FROM `verifikasi_perbaikan` WHERE `id_verifikasi` = $v";
        $this->db->query($query);
    }

    public function totalDataVerifikasi ($id_jadwal) {
        $query = "SELECT COUNT(*) AS `numrows` FROM verifikasi_perbaikan a join bukti_temuan b on a.id_temuan=b.id_temuan join jadwal_patrol c on b.id_jadwal=c.id_jadwal where b.id_jadwal = '$id_jadwal'";
        
        return $this->db->query($query)->row_array();
    }

    public function totalDataTemuan ($id_jadwal) {
        $query = "SELECT COUNT(*) AS `numrows` FROM bukti_temuan where id_jadwal = '$id_jadwal'";
        
        return $this->db->query($query)->row_array();
    }
}
