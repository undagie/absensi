<?php
defined('BASEPATH') or die('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function find_by($field, $value, $return = FALSE)
    {
        $this->db->where($field, $value);
        $data = $this->db->get('users');
        if ($return) {
            return $data->row();
        }
        return $data;
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->update('users', $data);
        return $result;
    }

    public function get_all_users()
    {
        return $this->db->get('users')->result();
    }

    public function get_all_divisi()
    {
        return $this->db->get('divisi')->result();
    }

    public function get_all_users_by_divisi($divisi = null)
    {
        if ($divisi != 'all') {
            $this->db->join('divisi', 'users.divisi = divisi.id_divisi', 'LEFT');
            $this->db->where('divisi.nama_divisi', $divisi);
        } else {
            $this->db->join('divisi', 'users.divisi = divisi.id_divisi', 'LEFT');
        }
        return $this->db->get('users')->result();
    }

    public function getUserWithDivisiById($id)
    {
        $this->db->select('users.*, divisi.nama_divisi');
        $this->db->from('users');
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi');
        $this->db->where('users.id_user', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
