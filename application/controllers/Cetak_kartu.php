<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak_kartu extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_cetak_kartu');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataPeminjam'] = $this->m_cetak_kartu->getAllData();
			$this->load->view('v_tampil_cetak_kartu',$data);
		} else {
			redirect('admin');
		}	
	}

	public function cetak() {
		if (isset($this->session->userdata['logged_in'])) {
			$nis = $this->uri->segment(3);
			$hasil = "";
			$result = $this->m_cetak_kartu->getAllDataByNis($nis);
			if (empty($result)) {
				$data['dataPeminjam'] = $this->m_cetak_kartu->getDataByNis($nis);
				$this->load->view('v_cetak_kartu',$data);
			} else {
				foreach ($result as $r) {
					if ($r->status == 2) {
						$hasil = "Invalid";
						break;
					}
				}

				if ($hasil == "Invalid") {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Masih ada buku yang belum dikembalikan. Mohon Kembalikan terlebih dahulu.</div>");
					redirect('cetak_kartu');
				} else {
					$data['dataPeminjam'] = $this->m_cetak_kartu->getDataByNis($nis);
					$this->load->view('v_cetak_kartu',$data);
				}
			}
		} else {
			redirect('admin');
		}	
	}
}