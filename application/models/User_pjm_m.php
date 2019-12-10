<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_pjm_m extends CI_Model
{

    public function getId($id = null)
    {
        $this->db->from('user_pjm');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user_pjm');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['name'],
            'nis' => $post['nis'],
            'kelas' => $post['kelas'],
            'username' => $post['username'],
            'password' => $post['password']
        ];
        $this->db->insert('user_pjm', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'nis' => $post['nis'],
            'kelas' => $post['kelas'],
            'username' => $post['username'],
            'password' => $post['password']
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('user_pjm', $params);
    }

    // hapus user
    public function hapususer($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_pjm', ['id' => $id]);
    }
}
