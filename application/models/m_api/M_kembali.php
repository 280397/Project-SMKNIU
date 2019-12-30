<?php

defined('BASEPATH') or exit('No direct script access allowed');



class M_kembali extends CI_Model
{

    public function get_data($barcode)
    {
        $this->db->select('peminjaman.*,barang_kategori.kategori as nama_barang');
        $this->db->from('peminjaman');
        $this->db->join('barang', 'barang.barcode=peminjaman.barcode');
        $this->db->join('barang_kategori', 'barang_kategori.kategori=barang.nama_barang');
        // $this->db->Where('id_user_pjm', $id_user_pjm);
        // $this->db->Where('peminjaman.id_user_pjm', $barcode);
        $this->db->Where('peminjaman.barcode', $barcode);
        $this->db->Where('peminjaman.status', 'pinjam');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_dataa($barcode)
    {
        $this->db->select('peminjaman.*,barang_kategori.kategori as nama_barang');
        $this->db->from('peminjaman');
        $this->db->join('barang', 'barang.barcode=peminjaman.barcode');
        $this->db->join('barang_kategori', 'barang_kategori.id=barang.nama_barang');
        // $this->db->Where('id_user_pjm', $id_user_pjm);
        $this->db->Where('peminjaman.id_user_pjm', $barcode);
        // $this->db->Where('peminjaman.barcode', $barcode);
        $this->db->Where('peminjaman.status', 'pinjam');
        $query = $this->db->get();
        return $query->result();
    }

    public function post_data($barcode, $kode, $id_user_pjm)
    {
        $this->db->select('peminjaman.*');
        $this->db->from('peminjaman');
        $this->db->join('barang', 'barang.barcode=peminjaman.barcode');
        // $this->db->join('barang_kategori', 'barang_kategori.id=barang.nama_barang');
        // $this->db->Where('id_user_pjm', $id_user_pjm);
        $this->db->Where('peminjaman.barcode', $barcode);
        $this->db->Where('peminjaman.kode', $kode);
        $this->db->Where('peminjaman.id_user_pjm', $id_user_pjm);
        $this->db->Where('peminjaman.status', 'pinjam');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function ambil_data($id)
    {
        $this->db->select('pengembalian_temp.*,barang_kategori.kategori as nama_barang, user_pjm.name as name, barang.barcode as barcode');
        $this->db->from('pengembalian_temp');
        $this->db->join('barang', 'barang.barcode=pengembalian_temp.barcode');
        $this->db->join('barang_kategori', 'barang_kategori.kategori=barang.nama_barang');
        $this->db->join('user_pjm', 'user_pjm.id=pengembalian_temp.id_user_pjm');
        $this->db->Where('id_user_pjm', $id);
        // $this->db->Where('peminjaman.status', 'addlist');
        $query = $this->db->get();
        return $query->result();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pengembalian_temp', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
