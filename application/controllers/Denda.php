<?php

class Denda extends CI_Controller
{
	
	public function __construct() {
		parent::__construct();
		$this->load->model('m_transaksi');
		$this->load->model('m_admin');
		$this->load->model('m_buku');
		$this->load->model('m_peminjam');
	}
}
?>