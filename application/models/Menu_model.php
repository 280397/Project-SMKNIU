<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getMenuM()
    {
        $this->db->from('user_menu');
        $query = $this->db->get();
        return $query;
    }
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    ";
        return $this->db->query($query)->result_array();
    }


    // edit menu
    public function getMenu($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }
    public function ubahMenu()
    {
        $data = [

            "menu" => $this->input->post('menu', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }



    // hapus menu model
    public function deleteMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu', ['id' => $id]);
    }

    // hapus sub menu model
    public function deleteSubMenu($id)
    {
        // $this->db->where($where);
        $this->db->delete('user_sub_menu', ['id' => $id]);
        // $this->db->delete($table);
    }
}
