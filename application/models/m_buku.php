<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_buku extends CI_Model {
		public function __construct() {
			parent::__construct();
		}

		function getAllData() {
			$this->db->from('buku');
			$this->db->join('kategori', 'kategori.kategori_id = buku.kategori_id');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataTersedia() {
			$kondisi = "stok_buku > 0";
			$this->db->from('buku');
			$this->db->join('kategori', 'kategori.kategori_id = buku.kategori_id');
			$this->db->where($kondisi);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataTidakTersedia() {
			$kondisi = "stok_buku = 0";
			$this->db->from('buku');
			$this->db->join('kategori', 'kategori.kategori_id = buku.kategori_id');
			$this->db->where($kondisi);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataRak($kode_rakbuku){
			$this->db->from('buku');
			$this->db->where('kode_rakbuku', $kode_rakbuku);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function getKategori() {
			$this->db->from('kategori');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataByNoBuku($kode_ddc) {
			$this->db->from('buku');
			$this->db->join('kategori', 'kategori.kategori_id = buku.kategori_id');
			$this->db->where('kode_ddc', $kode_ddc);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function insertData($data) {
			return $this->db->insert('buku', $data);
		}

		function updateData($kode_ddc, $data) {
			$this->db->where('kode_ddc', $kode_ddc);
			$this->db->update('buku', $data);
			return TRUE;
		}

		function updateStok($kode_ddc, $data) {
			$this->db->where('kode_ddc', $kode_ddc);
			$this->db->update('buku', $data);
			return TRUE;
		}

		function deleteData($kode_ddc) {
			$this->db->where('kode_ddc', $kode_ddc);
			$this->db->delete('buku');
			if ($this->db->affected_rows() == 1) {
				return TRUE;
			}
			return FALSE;
		}
	}