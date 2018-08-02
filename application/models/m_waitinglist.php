<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_waitinglist extends CI_Model {
		public function __construct() {
			parent::__construct();
		}

		function getAllData() {
			$this->db->from('waitinglist');
			$this->db->join('peminjam', 'peminjam.nis = waitinglist.nis');
			$this->db->join('buku', 'buku.kode_ddc = waitinglist.kode_ddc');
			$this->db->join('kategori', 'kategori.kategori_id = buku.kategori_id');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function insertData($data) {
			return $this->db->insert('waitinglist', $data);
		}

		function updateData($idwaitinglist, $data) {
			$this->db->where('idwaitinglist', $idwaitinglist);
			$this->db->update('waitinglist', $data);
			return TRUE;
		}

		function getSiswa($nis){
			$this->db->from('peminjam');
			$this->db->where('nis',$nis);
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}

		function getDataBuku(){
			$this->db->from('buku');
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result();
			}
		}
	}