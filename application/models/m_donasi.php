<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_donasi extends CI_Model {
		public function __construct() {
			parent::__construct();
		}

		function getAllData() {
			$this->db->from('donasi');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function insertData($data) {
			return $this->db->insert('donasi', $data);
		}
	}