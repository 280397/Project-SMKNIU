<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_model extends CI_Model
{
    // hapus lokasi
    public function hapusLokasi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('barang_lokasi', ['id' => $id]);
    }

    // edit lokasi
    public function getLokasi($id)
    {
        return $this->db->get_where('barang_lokasi', ['id' => $id])->row_array();
    }

    public function ubahLokasi()
    {
        $data = [
            'lokasi' => $this->input->post('lokasi', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('barang_lokasi', $data);
    }
}
