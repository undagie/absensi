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
        $this->load->model('User_model');

        $data['users'] = $this->User_model->get_all_users();

        $this->template->load('template', 'penggajian/create', $data);
    }


    public function store()
    {
        $post = $this->input->post();
        $total_gaji = $post['gaji_pokok'] + $post['bonus'] - $post['potongan'];

        $data = [
            'id_user' => $post['id_user'],
            'bulan' => $post['bulan'],
            'tahun' => $post['tahun'],
            'gaji_pokok' => $post['gaji_pokok'],
            'bonus' => $post['bonus'],
            'potongan' => $post['potongan'],
        ];

        $result = $this->penggajian->insert_data($data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Data penggajian telah ditambahkan!'
            ];
            $redirect = 'penggajian/';
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data penggajian gagal ditambahkan'
            ];
            $redirect = 'penggajian/create';
        }

        $this->session->set_flashdata('response', $response);
        redirect($redirect);
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
        ];

        $result = $this->penggajian->update_data($post['id_penggajian'], $data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Data penggajian berhasil diubah!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data penggajian gagal diubah!'
            ];
        }

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
        $this->load->model('User_Model');
        $user = $this->User_Model->find_by('id_user', $id_user, TRUE);

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
}
