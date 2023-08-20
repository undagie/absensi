<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Absensi_model extends CI_Model
{
    public function get_absen($id_user, $bulan, $tahun)
    {
        $this->db->select("DATE_FORMAT(a.tgl, '%d-%m-%Y') AS tgl, a.waktu AS jam_masuk, (SELECT waktu FROM absensi al WHERE al.tgl = a.tgl AND al.keterangan = 'Pulang' AND al.id_user = a.id_user) AS jam_pulang");
        $this->db->from('absensi a');
        $this->db->where('a.id_user', $id_user);
        $this->db->where("DATE_FORMAT(a.tgl, '%m') =", $bulan);
        $this->db->where("DATE_FORMAT(a.tgl, '%Y') =", $tahun);
        $this->db->group_by("a.tgl");

        $result = $this->db->get();
        return $result->result_array();
    }



    public function absen_harian_user($id_user)
    {
        $today = date('Y-m-d');
        $this->db->where('tgl', $today);
        $this->db->where('id_user', $id_user);
        $data = $this->db->get('absensi');
        return $data;
    }

    public function insert_data($data)
    {
        $result = $this->db->insert('absensi', $data);
        return $result;
    }

    public function get_jam_by_time($time)
    {
        $this->db->where('start', $time, '<=');
        $this->db->or_where('finish', $time, '>=');
        $data = $this->db->get('jam');
        return $data->row();
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\models\Absensi_model.php */