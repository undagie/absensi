<?php
defined('BASEPATH') or die('No direct script access allowed');

class Divisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        redirect_if_level_not('Manager');
        $this->load->model('Divisi_model', 'divisi');
    }

    public function index()
    {
        $data['divisi'] = $this->divisi->get_all();
        return $this->template->load('template', 'divisi', $data);
    }

    public function store()
    {
        $post = $this->input->post();
        $data = [
            'nama_divisi' => $post['nama_divisi'],
            'gaji_pokok' => $post['gaji_pokok'],
            'honor_lembur' => $post['honor_lembur'] // Menambahkan field honor_lembur
        ];
        $result = $this->divisi->insert_data($data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Data divisi telah ditambahkan!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Divisi gagal ditambahkan!'
            ];
        }

        return $this->response_json($response);
    }

    public function update()
    {
        $post = $this->input->post();
        $data = [
            'id_divisi' => $post['id_divisi'],
            'nama_divisi' => $post['nama_divisi'],
            'gaji_pokok' => $post['gaji_pokok'],
            'honor_lembur' => $post['honor_lembur'] // Menambahkan field honor_lembur
        ];

        $result = $this->divisi->update_data($post['id_divisi'], $data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Divisi berhasil diupdate!',
                'data' => $result
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Divisi gagal diupdate!'
            ];
        }

        return $this->response_json($response);
    }

    public function destroy()
    {
        $id_divisi = $this->uri->segment(3);
        $result = $this->divisi->delete_data($id_divisi);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Divisi telah dihapus!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Divisi gagal dihapus!'
            ];
        }

        return $this->response_json($response);
    }

    private function response_json($response)
    {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
