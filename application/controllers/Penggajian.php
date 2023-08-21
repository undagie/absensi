<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Penggajian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        redirect_if_level_not('Manager');
        $this->load->model('penggajian_model', 'penggajian');
        $this->load->model('User_model', 'user');
        $this->load->model('Divisi_Model');
        $this->load->helper('Tanggal');
    }

    public function index()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if ($bulan && $tahun) {
            $data['penggajian'] = $this->penggajian->get_by_month_year($bulan, $tahun);
        } else {
            $data['penggajian'] = $this->penggajian->get_all();
        }

        return $this->template->load('template', 'penggajian/index', $data);
    }

    public function create()
    {
        $data['users'] = $this->user->get_all_users();
        $this->template->load('template', 'penggajian/create', $data);
    }

    public function store()
    {
        $post = $this->input->post();

        $data = [
            'id_user' => $post['id_user'],
            'bulan' => $post['bulan'],
            'tahun' => $post['tahun'],
            'gaji_pokok' => $post['gaji_pokok'],
            'bonus' => $post['bonus'],
            'potongan' => $post['potongan'],
            'lembur' => $this->get_lembur($post['id_user'], $post['bulan'], $post['tahun']) // Mengambil honor lembur dari fungsi get_lembur
        ];

        $result = $this->penggajian->insert_data($data);

        $response = $result
            ? ['status' => 'success', 'message' => 'Data penggajian telah ditambahkan!']
            : ['status' => 'error', 'message' => 'Data penggajian gagal ditambahkan'];

        $this->session->set_flashdata('response', $response);
        redirect($result ? 'penggajian/' : 'penggajian/create');
    }

    public function edit($id_penggajian)
    {
        $data['users'] = $this->user->get_all_users();
        $data['penggajian'] = $this->penggajian->find($id_penggajian);
        return $this->template->load('template', 'penggajian/edit', $data);
    }

    public function update()
    {
        $post = $this->input->post();

        $data = [
            'id_user' => $post['id_user'],
            'bulan' => $post['bulan'],
            'tahun' => $post['tahun'],
            'gaji_pokok' => $post['gaji_pokok'],
            'bonus' => $post['bonus'],
            'potongan' => $post['potongan'],
            'lembur' => $this->get_lembur($post['id_user'], $post['bulan'], $post['tahun'])
        ];

        $result = $this->penggajian->update_data($post['id_penggajian'], $data);

        $response = $result
            ? ['status' => 'success', 'message' => 'Data penggajian berhasil diubah!']
            : ['status' => 'error', 'message' => 'Data penggajian gagal diubah!'];

        $this->session->set_flashdata('response', $response);
        redirect('penggajian');
    }

    public function destroy($id_penggajian)
    {
        $result = $this->penggajian->delete_data($id_penggajian);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Data penggajian berhasil dihapus!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data penggajian gagal dihapus!'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_gaji_pokok_by_user($id_user)
    {
        $this->load->model('User_model');
        $user = $this->User_model->find_by('id_user', $id_user, TRUE);

        $this->load->model('Divisi_Model');
        $divisi = $this->Divisi_Model->find($user->divisi);

        $response = [
            'success' => true,
            'gaji_pokok' => $divisi->gaji_pokok
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function cetakpenggajian()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if ($bulan && $tahun) {
            $data['penggajian'] = $this->penggajian->get_by_month_year($bulan, $tahun);
        } else {
            $data['penggajian'] = $this->penggajian->get_all();
        }
        return $this->template->load('template', 'penggajian/cetakpenggajian', $data);
    }

    public function print_report()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if ($bulan && $tahun) {
            $data['penggajian'] = $this->penggajian->get_by_month_year($bulan, $tahun);
        } else {
            $data['penggajian'] = $this->penggajian->get_all();
        }

        $this->load->view('penggajian/report', $data);
    }

    public function cetak_slip_gaji($id_penggajian)
    {
        $data['penggajian'] = $this->penggajian->getDetailPenggajian($id_penggajian); // Ambil detail penggajian berdasarkan ID

        if ($data['penggajian']) {
            $this->load->view('penggajian/slipgaji', $data); // Load view report slip gaji dengan data penggajian yang bersangkutan
        } else {
            // Tampilkan pesan error jika data tidak ditemukan
            show_error('Data penggajian tidak ditemukan.');
        }
    }

    public function generate_gaji()
    {
        $bulan = date('m'); // Ambil bulan sekarang
        $tahun = date('Y'); // Ambil tahun sekarang

        $users = $this->user->get_all_users();

        foreach ($users as $user) {
            $gaji_pokok = $this->get_gaji_pokok($user->id_user);
            $lembur = $this->get_lembur($user->id_user, $bulan, $tahun); // Perhitungan lembur

            $data = [
                'id_user' => $user->id_user,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'gaji_pokok' => $gaji_pokok,
                'bonus' => 0, // Anda bisa mengubah logika ini jika Anda memiliki metode perhitungan bonus
                'potongan' => 0, // Anda bisa mengubah logika ini jika Anda memiliki metode perhitungan potongan
                'lembur' => $lembur // Menambahkan data lembur ke array data yang akan disimpan
            ];

            // Cek apakah data sudah ada
            $existing_data = $this->penggajian->find_by_month_year_user($bulan, $tahun, $user->id_user);

            if ($existing_data) {
                // Update data yang ada
                $this->penggajian->update_data($existing_data->id_penggajian, $data);
            } else {
                // Tambahkan ke database
                $this->penggajian->insert_data($data);
            }
        }

        redirect('penggajian');
    }


    private function get_gaji_pokok($id_user)
    {
        $user = $this->user->find_by('id_user', $id_user, TRUE);

        $divisi = $this->Divisi_Model->find($user->divisi);

        return $divisi->gaji_pokok;
    }

    private function get_lembur($id_user, $bulan, $tahun)
    {
        $jam_lembur = $this->penggajian->get_jam_lembur($id_user, $bulan, $tahun);

        $honor_per_jam = $this->get_honor_lembur_by_user($id_user);

        $total_lembur = $jam_lembur * $honor_per_jam;

        return $total_lembur;
    }

    private function get_honor_lembur_by_user($id_user)
    {
        $user = $this->user->find_by('id_user', $id_user, TRUE);

        $this->load->model('Divisi_Model');
        $divisi = $this->Divisi_Model->find($user->divisi);

        return $divisi->honor_lembur;
    }
}
