<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Karyawan_model extends CI_Model
{
    public function get_all()
    {
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi', 'LEFT');
        $this->db->where('level', 'Karyawan');
        $result = $this->db->get('users');
        return $result->result();
    }

    public function find($id)
    {
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi', 'LEFT');
        $this->db->where('id_user', $id);
        $result = $this->db->get('users');
        return $result->row();
    }

    public function insert_data($data)
    {
        $result = $this->db->insert('users', $data);
        return $result;
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->update('users', $data);
        return $result;
    }

    public function delete_data($id)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->delete('users');
        return $result;
    }

    public function get_by_divisi($divisi)
    {
        if ($divisi != 'all') {
            $this->db->where('divisi', $divisi);
        }
        return $this->db->get('karyawan')->result();
    }
}
