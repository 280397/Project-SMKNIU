<?php

defined('BASEPATH') or exit('No direct script access allowed');



class M_addAdmin extends CI_Model
{

    public function get_data($id_admin)
    {
        $this->db->select('user.*,user_role.role as role_id');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        $this->db->Where('id_admin', $id_admin);
        $query = $this->db->get();
        return $query->result();

        // return $this->db->get('barang')->result();
    }
}
