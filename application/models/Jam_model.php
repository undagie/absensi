<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Jam_model extends CI_Model
{
    public function get_all()
    {
        $result = $this->db->get('jam');
        return $result->result();
    }

    public function find($id)
    {
        $this->db->where('id_jam', $id);
        $result = $this->db->get('jam');
        return $result->row();
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_jam', $id);
        $result = $this->db->update('jam', $data);
        return $result;
    }

    public function get_jam($keterangan)
    {
        $this->db->where('keterangan', $keterangan);
        $query = $this->db->get('jam');
        return $query->row();
    }

    public function sudah_absen($user_id, $keterangan)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('keterangan', $keterangan);
        $query = $this->db->get('absensi');
        return $query->num_rows() > 0;
    }
}
