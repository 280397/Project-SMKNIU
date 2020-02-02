<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_m extends CI_Model
{
    public function get()
    {
        $this->db->select('peminjaman.*,user_pjm.name as id_user_pjm, user_pjm.kelas as kelas,barang_kategori.kategori as bar, user.name as id_admin');
        $this->db->from('peminjaman');
        $this->db->join('user_pjm', 'user_pjm.id=peminjaman.id_user_pjm');
        $this->db->join('barang', 'barang.barcode=peminjaman.barcode');
        $this->db->join('barang_kategori', 'barang_kategori.id=barang.nama_barang');
        $this->db->join('user', 'user.id_admin=peminjaman.id_admin');
        $this->db->Where('peminjaman.status', 'pinjam');
        $query = $this->db->get();
        return $query->result();
    }

    public function getk()
    {
        $this->db->select('peminjaman.*,user_pjm.name as id_user_pjm, user_pjm.kelas as kelas,barang_kategori.kategori as barcode, user.name as id_admin');
        $this->db->from('peminjaman');
        $this->db->join('user_pjm', 'user_pjm.id=peminjaman.id_user_pjm');
        $this->db->join('barang', 'barang.barcode=peminjaman.barcode');
        $this->db->join('barang_kategori', 'barang_kategori.id=barang.nama_barang');
        $this->db->join('user', 'user.id_admin=peminjaman.id_admin');
        $this->db->Where('peminjaman.status', 'kembali');
        $query = $this->db->get();
        return $query->result();
    }


    public function getId($id = null)
    {


        $this->db->from('barang');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_count()
    {
        $count = 'SELECT count(barcode) as stok from peminjaman WHERE peminjaman.status = "pinjam"';
        $result = $this->db->query($count);
        return $result->row()->stok;
    }
    public function get_countk()
    {
        $count = 'SELECT count(barcode) as stok from peminjaman WHERE peminjaman.status = "kembali"';
        $result = $this->db->query($count);
        return $result->row()->stok;
    }
}
