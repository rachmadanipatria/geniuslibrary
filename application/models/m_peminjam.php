<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_peminjam extends CI_Model {
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

		function insertData($data) {
			return $this->db->insert('peminjam', $data);
		}

		function insertBuku($data){
			return $this->db->insert('transaksi', $data);
		}

		function updateData($nis, $data) {
			$this->db->where('nis', $nis);
			$this->db->update('peminjam', $data);
			return TRUE;
		}

		function deleteData($nis) {
			$this->db->where('nis', $nis);
			$this->db->delete('peminjam');
			if ($this->db->affected_rows() == 1) {
				return TRUE;
			}
			return FALSE;
		}
	}