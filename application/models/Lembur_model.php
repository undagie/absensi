<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lembur_model extends CI_Model
{

    public function getOvertimeDetails($id_user, $tanggal)
    {
        $this->db->select('a.waktu AS waktu_pulang, j.finish AS waktu_finish, d.honor_lembur');
        $this->db->from('absensi a');
        $this->db->join('users u', 'a.id_user = u.id_user');
        $this->db->join('divisi d', 'u.divisi = d.id_divisi');
        $this->db->join('jam j', 'a.keterangan = j.keterangan AND j.keterangan = "Pulang"');
        $this->db->where('a.id_user', $id_user);
        $this->db->where('a.tgl', $tanggal);

        return $this->db->get()->row();
    }

    public function insertOvertime($data)
    {
        $this->db->insert('lembur', $data);
        return $this->db->affected_rows();
    }

    public function getTotalLemburForUser($bulan, $tahun, $id_user)
    {
        $this->db->select_sum('biaya');
        $this->db->from('lembur');
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $this->db->where('id_user', $id_user);
        $result = $this->db->get()->row();

        return $result->biaya;
    }


    public function getAllLembur($bulan = null, $tahun = null)
    {
        $this->db->select('lembur.*, users.*, divisi.nama_divisi');
        $this->db->from('lembur');
        $this->db->join('users', 'lembur.id_user = users.id_user');
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi');

        if ($bulan && $tahun) {
            $this->db->where('MONTH(tanggal)', $bulan);
            $this->db->where('YEAR(tanggal)', $tahun);
        }

        // Menambahkan sorting berdasarkan id_user dan tanggal
        $this->db->order_by('users.id_user', 'ASC');
        $this->db->order_by('lembur.tanggal', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getTotalOvertimeHonor($bulan, $tahun)
    {
        $this->db->select('users.*, SUM(lembur.biaya) as total_honor');
        $this->db->from('users');
        $this->db->join('lembur', 'users.id_user = lembur.id_user', 'left');
        $this->db->where('MONTH(lembur.tanggal)', $bulan);
        $this->db->where('YEAR(lembur.tanggal)', $tahun);
        $this->db->group_by('users.id_user');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_date_month_year_user($tanggal, $bulan, $tahun, $id_user)
    {
        $this->db->select('*');
        $this->db->from('lembur');
        $this->db->where('DAY(tanggal)', $tanggal);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('id_user', $id_user);

        return $this->db->get()->row();
    }

    public function updateOvertime($id_lembur, $data)
    {
        $this->db->where('id_lembur', $id_lembur);
        return $this->db->update('lembur', $data);
    }
}
