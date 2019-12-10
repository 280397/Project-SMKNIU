<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_kategori_m extends CI_Model
{
    public function getbarang($id)
    {

        $q = $this->db->query("SELECT * FROM barang a join barang_lokasi b on a.id_lokasi = b.id join barang_kategori c on a.nama_barang = c.id join barang_kondisi d on a.id_kondisi = d.id where a.id_kondisi = '" . $id . "' group by a.id")->result_array();
        return $q;
    }

    public function get($id = null)
    {
        $this->db->from('user_pjm_kategori');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'kategori' => $post['kategori']
        ];
        $this->db->insert('user_pjm_kategori', $params);
    }

    public function edit($post)
    {
        $params = [
            'kategori' => $post['kategori']
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('user_pjm_kategori', $params);
    }

    // hapus kategori
    public function hapuskategori($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_pjm_kategori', ['id' => $id]);
    }
}
