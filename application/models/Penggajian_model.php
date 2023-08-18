<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penggajian_model extends CI_Model
{
    private $table = 'penggajian';
    private $users = 'users';

    public function get_all()
    {
        $this->db->select('penggajian.*, users.nama, users.foto, users.divisi, divisi.nama_divisi');
        $this->db->join($this->users, 'users.id_user = penggajian.id_user');
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi');
        $this->db->order_by('penggajian.bulan', 'ASC');
        $this->db->order_by('penggajian.id_user', 'ASC');

        return $this->db->get($this->table)->result();
    }

    public function insert_data($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function find($id)
    {
        $this->db->where('id_penggajian', $id);
        $this->db->join($this->users, 'users.id_user = penggajian.id_user');
        return $this->db->get($this->table)->row();
    }

    public function update_data($id, $data)
    {
        return $this->db->where('id_penggajian', $id)->update($this->table, $data);
    }

    public function delete_data($id)
    {
        return $this->db->where('id_penggajian', $id)->delete($this->table);
    }

    public function get_all_users()
    {
        return $this->db->where('level', 'Karyawan')->get($this->users)->result();
    }

    public function get_by_month_year($bulan, $tahun)
    {
        $this->db->select('penggajian.*, users.nama, users.foto, users.divisi, divisi.nama_divisi');
        $this->db->join($this->users, 'users.id_user = penggajian.id_user');
        $this->db->join('divisi', 'users.divisi = divisi.id_divisi');
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $this->db->order_by('penggajian.bulan', 'ASC');
        $this->db->order_by('penggajian.id_user', 'ASC');

        return $this->db->get($this->table)->result();
    }
}
