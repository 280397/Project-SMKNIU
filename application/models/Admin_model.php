<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function get_count()
    {
        $count = "SELECT count(barcode) as stok from barang";
        $result = $this->db->query($count);
        return $result->row()->stok;
    }
    public function getUser()
    {
        // $query = "SELECT `user`.*, `user_role`.`role`
        //             FROM `user` JOIN `user_role`
        //             ON `user`.`role_id` = `user_role`.`id`
        //             ";
        // return $this->db->query($query)->result_array();

        $this->db->select('user.*,user_role.role,activation.active');
        $this->db->join('user_role', 'user.role_id=user_role.id');
        $this->db->join('activation', 'user.is_active=activation.id');
        $this->db->from('user');

        $query = $this->db->get();

        return $query;
    }


    // edit 
    public function getId($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getIdRole($id = null)
    {

        $this->db->from('user_role');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function getIdActive($id = null)
    {

        $this->db->from('activation');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function check_id($code, $id = null)
    {
        $this->db->from('user');
        $this->db->where('id_admin', $code);
        if ($id != null) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {
        $data = [
            'name' => $post['name'],
            'id_admin' => $post['id_admin'],
            'username' => $post['username'],
            'role_id' => $post['role_id'],
            'is_active' => $post['is_active']
        ];

        $this->db->where('id', $post['id']);
        $this->db->update('user', $data);
    }

    // hapus user model
    public function hapusUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user', ['id' => $id]);
    }
}
