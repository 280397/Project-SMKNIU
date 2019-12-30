<?php

defined('BASEPATH') or exit('No direct script access allowed');



class M_pinjam extends CI_Model
{

    public function get_data($barcode)
    {
        $this->db->select('barang.*');
        $this->db->from('barang');
        // $this->db->select('barang.*,barang_kondisi.kondisi as id_kondisi,barang_lokasi.lokasi as id_lokasi, barang_kategori.kategori as nama_barang');
        // $this->db->from('barang');
        // $this->db->join('barang_kategori', 'barang_kategori.id=barang.nama_barang');
        // $this->db->join('barang_kondisi', 'barang_kondisi.id=barang.id_kondisi');
        // $this->db->join('barang_lokasi', 'barang_lokasi.id=barang.id_lokasi');
        $this->db->Where('barcode', $barcode);
        $query = $this->db->get();
        return $query->result();

        // return $this->db->get('barang')->result();
    }

    public function ambil_data($id)
    {
        $this->db->select('peminjaman_temp.*,barang_kategori.kategori as nama_barang, user_pjm.name as name, barang.barcode as barcode');
        $this->db->from('peminjaman_temp');
        $this->db->join('barang', 'barang.barcode=peminjaman_temp.barcode');
        $this->db->join('barang_kategori', 'barang_kategori.kategori=barang.nama_barang');
        $this->db->join('user_pjm', 'user_pjm.id=peminjaman_temp.id_user_pjm');
        $this->db->Where('id_user_pjm', $id);
        // $this->db->Where('peminjaman.status', 'addlist');
        $query = $this->db->get();
        return $query->result();
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('peminjaman_temp', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function put($kode, $tgl_pinjam, $tgl_kembali, $id_user, $keperluan, $status)
    {

        $this->db->set('tgl_pinjam', $tgl_pinjam);
        $this->db->set('tgl_kembali', $tgl_kembali);
        $this->db->set('id_user', $id_user);
        $this->db->set('keperluan', $keperluan);
        $this->db->set('status', $status);
        $this->db->where('kode', $kode);
        $this->db->update('peminjaman');
        return $this->db->affected_rows();
    }
    // public function petet($kode, $status)
    // {
    //     $this->db->set('status', $status);
    //     $this->db->where('kode', $kode);
    //     $this->db->update('peminjaman_detail');
    //     return $this->db->affected_rows();
    // }

    public function list_data($id)
    {
        $this->db->select('peminjaman.*,barang_kategori.kategori as nama_barang, user_pjm.name as name, barang.barcode as barcode');
        $this->db->from('peminjaman');
        $this->db->join('barang', 'barang.barcode=peminjaman.barcode');
        $this->db->join('barang_kategori', 'barang_kategori.kategori=barang.nama_barang');
        $this->db->join('user_pjm', 'user_pjm.id=peminjaman.id_user_pjm');
        $this->db->Where('id_user_pjm', $id);
        $this->db->Where('peminjaman.status', 'pinjam');
        $query = $this->db->get();
        return $query->result();
    }

    public function cekSession($id_user_pjm)
    {
        $this->db->select("COUNT('kode') AS sesi");
        $this->db->where('id_user_pjm', $id_user_pjm);
        return $this->db->get('peminjaman_temp')->row();
    }

    public function ambilSession($id_user_pjm)
    {
        $this->db->select('kode');
        $this->db->from('peminjaman_temp');
        $this->db->where('id_user_pjm', $id_user_pjm);
        return $this->db->get()->row();
    }
}



/* End of file M_auth.php */

/* Location: ./application/models/m_api/M_auth.php */
