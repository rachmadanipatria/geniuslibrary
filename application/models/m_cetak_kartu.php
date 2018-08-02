<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_cetak_kartu extends CI_Model {
		public function __construct() {
			parent::__construct();
		}

		function getAllData() {
			$this->db->from('peminjam');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataByNis($nis) {
			$this->db->from('peminjam');
			$this->db->where('nis', $nis);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function getAllDataByNis($nis) {
			$this->db->from('transaksi');
			// $this->db->join('user', 'peminjam.user_id = user.user_id');
			// $this->db->join('transaksi', 'transaksi.nis = peminjam.nis');
			$this->db->where('nis', $nis);

			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}
	}