<?php

defined('BASEPATH') or exit('No direct script access allowed');



class M_auth extends CI_Model
{



	public function check_login($table, $user, $password)

	{

		$this->db->where('username', $user);

		$this->db->where('password', $password);

		return $this->db->get($table)->row();
	}

	public function get_alldata()
	{
// 		$this->db->select('barang.*');
// 		$this->db->from('barang');
		$this->db->select('barang.*,barang_kondisi.kondisi as id_kondisi,barang_lokasi.lokasi as id_lokasi, barang_kategori.kategori as nama_barang');
		$this->db->from('barang');
		$this->db->join('barang_kategori', 'barang_kategori.id=barang.nama_barang');
		$this->db->join('barang_kondisi', 'barang_kondisi.id=barang.id_kondisi');
		$this->db->join('barang_lokasi', 'barang_lokasi.id=barang.id_lokasi');

		$this->db->order_by('barcode', 'desc');
		$query = $this->db->get();
		return $query->result();

		// return $this->db->get('barang')->result();
	}
}



/* End of file M_auth.php */

/* Location: ./application/models/m_api/M_auth.php */
