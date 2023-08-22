<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lembur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lembur_model');
        $this->load->model('User_model', 'user');
        $this->load->model('Absensi_model');
        $this->load->model('Divisi_model');
        $this->load->model('Jam_model');
        $this->load->helper('Tanggal');
    }

    public function index()
    {
        $bulan = $this->input->get('bulan', TRUE) ? $this->input->get('bulan', TRUE) : date('m');
        $tahun = $this->input->get('tahun', TRUE) ? $this->input->get('tahun', TRUE) : date('Y');

        $data['lembur'] = $this->Lembur_model->getAllLembur($bulan, $tahun);
        $data['rekapitulasi'] = $this->Lembur_model->getTotalOvertimeHonor($bulan, $tahun);


        return $this->template->load('template', 'lembur/daftar_lembur', $data);
    }


    public function hitung_lembur($id_user, $tanggal)
    {
        $details = $this->Lembur_model->getOvertimeDetails($id_user, $tanggal);

        if ($details) {
            $waktu_pulang = new DateTime($details->waktu_pulang);
            $waktu_finish = new DateTime($details->waktu_finish);
            $interval = $waktu_finish->diff($waktu_pulang);

            $jam_lembur = $interval->h;

            if ($jam_lembur > 0) {
                $total_lembur = $jam_lembur * $details->honor_lembur;

                $data = [
                    'id_user' => $id_user,
                    'tanggal' => $tanggal,
                    'jam_lembur' => $jam_lembur,
                    'bulan' => date("m", strtotime($tanggal)),
                    'tahun' => date("Y", strtotime($tanggal))
                ];

                $this->Lembur_model->insertOvertime($data);
                echo "Total Lembur: " . $total_lembur;
            } else {
                echo "Tidak ada lembur hari ini.";
            }
        } else {
            echo "Tidak ada data absensi.";
        }
    }

    public function generate_lembur()
    {
        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');


        // Menghitung jumlah hari dalam bulan saat ini
        $jumlah_hari = date('t', mktime(0, 0, 0, $bulan, 1, $tahun));

        $users = $this->user->get_all_users();

        // Ambil waktu start dan finish untuk 'Masuk' dan 'Pulang' dari tabel jam
        $jam_masuk = $this->Jam_model->get_jam('Masuk');
        $jam_pulang = $this->Jam_model->get_jam('Pulang');

        // Loop untuk setiap hari dalam bulan
        for ($i = 1; $i <= $jumlah_hari; $i++) {
            $tanggal_iterasi = "$tahun-$bulan-$i";

            foreach ($users as $user) {
                $absen_masuk = $this->Absensi_model->getAbsenDetail($user->id_user, $tanggal_iterasi, 'Masuk');
                $absen_pulang = $this->Absensi_model->getAbsenDetail($user->id_user, $tanggal_iterasi, 'Pulang');

                // Validasi absen masuk
                if ($absen_masuk && $absen_masuk->waktu >= $jam_masuk->start && $absen_masuk->waktu <= $jam_masuk->finish) {
                    // Validasi absen pulang
                    if ($absen_pulang && $absen_pulang->waktu > $jam_pulang->finish) {
                        $waktu_pulang = new DateTime($absen_pulang->waktu);
                        $waktu_finish = new DateTime($jam_pulang->finish);
                        $interval = $waktu_finish->diff($waktu_pulang);
                        $jam_lembur = $interval->h;

                        if ($jam_lembur > 0) {
                            // Ambil honor lembur dari divisi pengguna
                            $divisi = $this->Divisi_model->find($user->divisi);
                            $biaya_lembur = $jam_lembur * $divisi->honor_lembur;

                            $data = [
                                'id_user' => $user->id_user,
                                'tanggal' => $tanggal_iterasi,
                                'jam_lembur' => $jam_lembur,
                                'bulan' => $bulan,
                                'tahun' => $tahun,
                                'biaya' => $biaya_lembur
                            ];

                            $existing_data = $this->Lembur_model->find_by_date_month_year_user($i, $bulan, $tahun, $user->id_user);

                            if ($existing_data) {
                                $this->Lembur_model->updateOvertime($existing_data->id_lembur, $data);
                            } else {
                                $this->Lembur_model->insertOvertime($data);
                            }
                        }
                    }
                }
            }
        }

        redirect('lembur');
    }

    public function rekaplembur()
    {
        $bulan = $this->input->get('bulan', TRUE) ? $this->input->get('bulan', TRUE) : date('m');
        $tahun = $this->input->get('tahun', TRUE) ? $this->input->get('tahun', TRUE) : date('Y');
        $data['lembur'] = $this->Lembur_model->getAllLembur($bulan, $tahun);
        $data['rekapitulasi'] = $this->Lembur_model->getTotalOvertimeHonor($bulan, $tahun);

        return $this->template->load('template', 'lembur/rekapitulasi_lembur', $data);
    }

    public function print_report()
    {
        $bulan = $this->input->get('bulan', TRUE) ? $this->input->get('bulan', TRUE) : date('m');
        $tahun = $this->input->get('tahun', TRUE) ? $this->input->get('tahun', TRUE) : date('Y');

        $data['rekapitulasi'] = $this->Lembur_model->getAllLembur($bulan, $tahun);

        $this->load->view('lembur/report', $data);
    }

    public function print_rekapitulasi()
    {
        $bulan = $this->input->get('bulan', TRUE) ? $this->input->get('bulan', TRUE) : date('m');
        $tahun = $this->input->get('tahun', TRUE) ? $this->input->get('tahun', TRUE) : date('Y');

        $data['lembur'] = $this->Lembur_model->getAllLembur($bulan, $tahun);
        $data['rekapitulasi'] = $this->Lembur_model->getTotalOvertimeHonor($bulan, $tahun);

        $this->load->view('lembur/report_rekapitulasi', $data);
    }
}
