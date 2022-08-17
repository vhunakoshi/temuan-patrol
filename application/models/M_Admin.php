<?php
defined('BASEPATH') or exit('NO direct script access allowed');

class M_admin extends CI_Model
{
    //========================================== Master Petugas =============================================

    public function getPegawai()
    {
        $query = "SELECT * from petugas a join master_seksi b on a.id_seksi = b.id_seksi";

        return $this->db->query($query)->result_array();
    }

    public function getPasswordPetugas($id)
    {
        $query = $this->db->query("SELECT `password` FROM `petugas` WHERE `id_user` = $id");
        foreach ($query->result() as $q) {
            $pass = $q->password;
        }
        return $pass;
    }

    public function getMasterPetugas($id)
    {
        $query = "SELECT * FROM `petugas` WHERE id_user = $id";
        return $this->db->query($query)->row_array();
    }

    public function hapusDataPetugas($p)
    {
        $query = "DELETE FROM `petugas` WHERE `id_user` = $p";
        $this->db->query($query);
    }

    //==========================================  Master Tim  =============================================

    public function getTim()
    {
        $query = "SELECT * from master_tim a join petugas b on a.id_user = b.id_user";

        return $this->db->query($query)->result_array();
    }

    public function changeTim($id)
    {
        $query = "SELECT * from master_tim a join petugas b on a.id_user = b.id_user WHERE id_tim = $id";

        return $this->db->query($query)->row_array();
    }

    public function changeAnggota($id)
    {
        $query = "SELECT * from detail_anggota a join petugas b on a.id_user = b.id_user join master_seksi c on b.id_seksi = c.id_seksi WHERE id_tim = $id";

        return $this->db->query($query)->result_array();
    }

    public function getPegawaiSeksi()
    {
        $query = "SELECT * from `petugas` where `level` = 'Seksi'";

        return $this->db->query($query)->result_array();
    }

    public function getMasterTim($id)
    {
        $query = "SELECT * FROM `master_tim` WHERE `id_tim` = $id";
        return $this->db->query($query)->row_array();
    }

    public function getPictureLogo($id)
    {
        $query = "SELECT 'logo_tim' FROM `master_tim` WHERE `id_tim` = $id";
        return $this->db->query($query);
    }

    public function hapusDataTim($t)
    {
        $query = "DELETE FROM `master_tim` WHERE `id_tim` = $t";
        $this->db->query($query);
    }

    public function hapusDetailAnggota($da)
    {
        $query = "DELETE FROM `detail_anggota` WHERE `id_detailanggota` = $da";
        $this->db->query($query);
    }

    //==========================================  Master Zona  =============================================

    public function getMasterZona($id)
    {
        $query = "SELECT * FROM `master_zona` WHERE id_zona = $id";
        return $this->db->query($query)->row_array();
    }

    public function hapusDataZona($z)
    {
        $query = "DELETE FROM `master_zona` WHERE `id_zona` = $z";
        $this->db->query($query);
    }

    //========================================== Master Seksi =============================================

    public function getMasterSeksi($id)
    {
        $query = "SELECT * FROM `master_seksi` WHERE id_seksi = $id";
        return $this->db->query($query)->row_array();
    }

    public function hapusDataSeksi($p)
    {
        $query = "DELETE FROM `master_seksi` WHERE `id_seksi` = $p";
        $this->db->query($query);
    }

    //========================================== Jadwal Patrol =============================================

    public function getJadwalPatrol()
    {
        $query = "SELECT a.id_jadwal, a.tgl_patrol, a.status, b.id_tim, b.nama_tim, c.id_zona, c.nama_zona FROM jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join master_zona c on a.id_zona=c.id_zona";

        return $this->db->query($query)->result_array();
    }

    public function getJadwal($id)
    {
        $query = "SELECT a.id_jadwal, a.tgl_patrol, a.status, b.id_tim, b.nama_tim, b.id_user, c.id_zona, c.nama_zona, c.lokasi FROM jadwal_patrol a join master_tim b on a.id_tim=b.id_tim join master_zona c on a.id_zona=c.id_zona WHERE id_jadwal = $id";

        return $this->db->query($query)->row_array();
    }

    public function getStatusPendingan($id)
    {
        $query = $this->db->query("SELECT `status` FROM `jadwal_patrol` WHERE `id_jadwal` = $id");
        foreach ($query->result() as $q) {
            $status = $q->status;
        }
        return $status;
    }

    public function hapusDataJadwal($j)
    {
        $query = "DELETE FROM `jadwal_patrol` WHERE `id_jadwal` = $j";
        $this->db->query($query);
    }
}
