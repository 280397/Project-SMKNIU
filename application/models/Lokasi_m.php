<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Lokasi_m extends CI_Model
{
    public function getbarang($id)
    {
        $q = $this->db->query("SELECT * FROM barang a join barang_lokasi b on a.id_lokasi = b.id join barang_kategori c on a.nama_barang = c.id join barang_kondisi d on a.id_kondisi = d.id where a.id_lokasi = '" . $id . "' group by a.id")->result_array();
        return $q;
    }
    public function get($id = null)
    {
        $this->db->from('barang_lokasi');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params = [
            'lokasi' => $post['lokasi']
        ];
        $this->db->insert('barang_lokasi', $params);
    }
    public function edit($post)
    {
        $params = [
            'lokasi' => $post['lokasi']
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('barang_lokasi', $params);
    }
    // hapus lokasi
    public function hapuslokasi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('barang_lokasi', ['id' => $id]);
    }
}