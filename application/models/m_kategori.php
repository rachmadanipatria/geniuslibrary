<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_kategori extends CI_Model {
		public function __construct() {
			parent::__construct();
		}

		function getAllData() {
			$this->db->from('kategori');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataById($id) {
			$this->db->from('kategori');
			$this->db->where('kategori_id', $id);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function insertData($data) {
			return $this->db->insert('kategori', $data);
		}

		function updateData($id, $data) {
			$this->db->where('kategori_id', $id);
			$this->db->update('kategori', $data);
			return TRUE;
		}

		function deleteData($id) {
			$this->db->where('kategori_id', $id);
			$this->db->delete('kategori');
			if ($this->db->affected_rows() == 1) {
				return TRUE;
			}
			return FALSE;
		}
	}