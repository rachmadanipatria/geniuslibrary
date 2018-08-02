<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_transaksi extends CI_Model {
		public function __construct() {
			parent::__construct();
		}

		function getAllData() {
			$this->db->from('transaksi');
			$this->db->join('buku', 'transaksi.kode_ddc = buku.kode_ddc');
			$this->db->join('peminjam', 'transaksi.nis = peminjam.nis');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataDenda() {
			$this->db->from('transaksi');
			$this->db->join('buku', 'transaksi.kode_ddc = buku.kode_ddc');
			$this->db->join('peminjam', 'transaksi.nis = peminjam.nis');
			$this->db->join('denda', 'denda.transaksi_id = transaksi.transaksi_id');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataTransaksi($transaksi_id) {
			$this->db->from('transaksi');
			$this->db->join('buku', 'transaksi.kode_ddc = buku.kode_ddc');
			$this->db->join('peminjam', 'transaksi.nis = peminjam.nis');
			$this->db->where('transaksi_id', $transaksi_id);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function getDataTransaksiTglPengembalian($transaksi_id, $tgl_peminjaman) {
			$kondisi = "transaksi_id = ".$transaksi_id." AND (tgl_peminjaman >= '".$tgl_peminjaman."' AND tgl_pengembalian < DATE_ADD('".$tgl_peminjaman."', INTERVAL 3 DAY))";
			$this->db->from('transaksi');
			$this->db->where($kondisi);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function getDataById($id) {
			$this->db->from('transaksi');
			$this->db->where('transaksi_id', $id);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			} else {
				return false;
			}
		}

		function insertData($data) {
			return $this->db->insert('transaksi', $data);
		}

		function insertDenda($data) {
			return $this->db->insert('denda', $data);
		}

		function updateData($id, $data) {
			$this->db->where('transaksi_id', $id);
			$this->db->update('transaksi', $data);
			return TRUE;
		}

		function deleteData($id) {
			$this->db->where('transaksi_id', $id);
			$this->db->delete('transaksi');
			if ($this->db->affected_rows() == 1) {
				return TRUE;
			}
			return FALSE;
		}
	}