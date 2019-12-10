<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function getBarangId()
    {

        // $query = "SELECT `barang`.*, `barang_kondisi`.`kondisi`
        // FROM `barang` JOIN `barang_kondisi`
        // ON `barang`.`id_kondisi` = `barang_kondisi`.`id`
        // ";
        // return $this->db->query($query)->result_array();

        $this->db->select('barang.*,barang_kondisi.kondisi,barang_lokasi.lokasi');
        $this->db->join('barang_kondisi', 'barang.id_kondisi=barang_kondisi.id');
        $this->db->join('barang_lokasi', 'barang.id_lokasi=barang_lokasi.id');
        $this->db->from('barang');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getAll()
    {
        return $this->db->get('barang')->result_array();
    }


    // hapus barang model
    public function hapusBarang($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('barang', ['id' => $id]);
    }

    // edit 
    public function getBarang($id)
    {
        return $this->db->get_where('barang', ['id' => $id])->row_array();
    }

    public function ubahBarang()
    {
        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'merk' => $this->input->post('merk'),
            'model' => $this->input->post('model'),
            'id_kondisi' => $this->input->post('id_kondisi'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'dtl_lokasi' => $this->input->post('dtl_lokasi'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'sumber' => $this->input->post('sumber'),
            'gambar' => $this->input->post('gambar'),
            'barcode' => $this->input->post('barcode')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('barang', $data);
    }
}
