<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_m extends CI_Model
{
    public function get()
    {
        $this->db->select('barang.*');
        // $this->db->join('barang_kategori', 'barang_kategori.id=barang.nama_barang');
        // $this->db->join('barang_kondisi', 'barang_kondisi.id=barang.id_kondisi');
        // $this->db->join('barang_lokasi', 'barang_lokasi.id=barang.id_lokasi');
        $this->db->from('barang');

        $query = $this->db->get();
        return $query;
    }

    public function get_count()
    {
        $count = "SELECT count(barcode) as stok from barang";
        $result = $this->db->query($count);
        return $result->row()->stok;
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

    public function add($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'nama_barang' => $post['nama_barang'],
            'merk' => $post['merk'],
            'model' => $post['model'],
            'id_kondisi' => $post['id_kondisi'],
            'id_lokasi' => $post['id_lokasi'],
            'dtl_lokasi' => $post['dtl_lokasi'],
            'tgl_masuk' => $post['tgl_masuk'],
            'sumber' => $post['sumber'],
            'gambar' => $post['gambar'],
            'created' => date('Y-m-d H:i:s'),
            'status' => 'ready'
        ];
        $this->db->insert('barang', $params);
    }
    function check_barcode($code, $id = null)
    {
        $this->db->from('barang');
        $this->db->where('barcode', $code);
        if ($id != null) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'nama_barang' => $post['nama_barang'],
            'merk' => $post['merk'],
            'model' => $post['model'],
            'id_kondisi' => $post['id_kondisi'],
            'id_lokasi' => $post['id_lokasi'],
            'dtl_lokasi' => $post['dtl_lokasi'],
            'tgl_masuk' => $post['tgl_masuk'],
            'sumber' => $post['sumber'],
            'updated' => date('Y-m-d H:i:s'),
            'status' => 'ready'
        ];
        if ($post['gambar'] != null) {
            $params['gambar'] = $post['gambar'];
        }
        $this->db->where('id', $post['id']);
        $this->db->update('barang', $params);
    }

    // detail
    public function lihatdetail($id)
    {
        return $this->db->query("SELECT barang.*,barang_kondisi.kondisi as k,barang_lokasi.lokasi as l,barang_kategori.kategori as nk FROM barang LEFT JOIN barang_kategori ON barang_kategori.id=barang.nama_barang LEFT JOIN barang_kondisi ON barang_kondisi.id=barang.id_kondisi LEFT JOIN barang_lokasi ON barang_lokasi.id=barang.id_lokasi WHERE barang.id = '.$id.'")->row_array();
    }

    public function detail($id)
    {
        $result = $this->db->where('id', $id)->get('barang');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    // hapus barang
    public function hapusbarang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('barang', ['id' => $id]);
    }
}
