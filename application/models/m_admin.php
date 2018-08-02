<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_admin extends CI_Model {
		public function __construct() {
			parent::__construct();
		}

		function cekLogin($data) {
			$kondisi = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where($kondisi);
			$this->db->limit(1);

			$query = $this->db->get();
			if ($query->num_rows() == 1) {
				return true;
			} else {
				return false;
			}
		}

		function getAllData() {
			$this->db->from('user');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataById($id) {
			$this->db->from('user');
			$this->db->where('user_id', $id);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function getDataByUsername($username) {
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('username', $username);

			$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			}
		}

		function insertData($data) {
			return $this->db->insert('user', $data);
		}

		function updateData($id, $data) {
			$this->db->where('user_id', $id);
			$this->db->update('user', $data);
			return TRUE;
		}

		function deleteData($id) {
			$this->db->where('user_id', $id);
			$this->db->delete('user');
			if ($this->db->affected_rows() == 1) {
				return TRUE;
			}
			return FALSE;
		}
	}