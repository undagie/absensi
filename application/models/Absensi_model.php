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

    public function getAbsenDetail($id_user, $tgl, $keterangan)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('tgl', $tgl);
        $this->db->where('keterangan', $keterangan);
        $query = $this->db->get('absensi');
        return $query->row();  // Mengembalikan satu baris
    }

    public function getRekapitulasi($bulan, $tahun)
    {
        $totalDays = date('t', mktime(0, 0, 0, $bulan, 1, $tahun));
        $currentDayOfMonth = date('j');
        $currentMonth = date('m');
        $currentYear = date('Y');
        $weekdayCount = 0;

        // Menghitung jumlah hari kerja dalam bulan ini hingga hari ini
        for ($day = 1; $day <= $totalDays; $day++) {
            $currentDay = mktime(0, 0, 0, $bulan, $day, $tahun);
            $weekday = date('N', $currentDay); // 1 (Senin) to 7 (Minggu)

            if (($currentYear == $tahun && $currentMonth == $bulan && $day <= $currentDayOfMonth) || ($currentYear == $tahun && $currentMonth < $bulan) || ($currentYear < $tahun)) {
                if ($weekday >= 1 && $weekday <= 5) { // Senin sampai Jumat
                    $weekdayCount++;
                }
            }
        }

        // Query Anda
        $this->db->select('u.nama, COUNT(DISTINCT case when a.keterangan="Masuk" AND (SELECT j1.start FROM jam j1 WHERE j1.keterangan = "Masuk") <= a.waktu AND a.waktu <= (SELECT j2.finish FROM jam j2 WHERE j2.keterangan = "Pulang") then a.tgl end) as hadir, COUNT(DISTINCT case when a.keterangan="Masuk" AND a.waktu > (SELECT j1.finish FROM jam j1 WHERE j1.keterangan = "Masuk") then a.tgl end) as terlambat, COUNT(DISTINCT case when a.id_absen is null then 1 end) as tidak_hadir');

        $this->db->from('users u');
        $this->db->join('absensi a', 'u.id_user = a.id_user', 'left');
        $this->db->where('MONTH(a.tgl)', $bulan);
        $this->db->where('YEAR(a.tgl)', $tahun);
        $this->db->group_by('u.nama');

        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as $key => $value) {
            $result[$key]['tidak_hadir'] = $weekdayCount - ($value['hadir'] + $value['terlambat']);
            if ($result[$key]['tidak_hadir'] < 0) {
                $result[$key]['tidak_hadir'] = 0;  // Memastikan bahwa 'tidak_hadir' tidak menjadi negatif
            }
        }

        return $result;
    }
}
