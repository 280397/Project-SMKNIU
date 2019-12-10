<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_m extends CI_Model
{

    public function getall()
    {

        $this->db->select('peminjaman.*,user_pjm.name as a, user.name as b');
        $this->db->join('user_pjm', 'user_pjm.id=peminjaman.id_user_pjm');
        $this->db->join('user', 'user.id=peminjaman.id_user');

        $this->db->from('peminjaman');

        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('peminjaman');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
