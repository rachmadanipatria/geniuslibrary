<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donasi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_buku');
		$this->load->model('m_donasi');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataDonasi'] = $this->m_donasi->getAllData();
			$this->load->view('v_tampil_donasi',$data);
		} else {
			redirect('admin');
		}
	}

	public function tambah() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataKategori'] = $this->m_buku->getKategori();
			$this->load->view('v_tambah_donasi',$data);
		} else {
			redirect('admin');
		}
	}

	public function tambahData() {
		$this->form_validation->set_rules('nama_pendonasi', 'Nama Pendonasi', 'trim|required');
		$this->form_validation->set_rules('nohp_pendonasi', 'No Hp Pendonasi', 'trim|required');
		$this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'trim|required');
		$this->form_validation->set_rules('tanggal_donasi', 'Tanggal Donasi', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Inputan Tidak Sesuai Isikan Data Buku Dengan Benar</div>");
			redirect('donasi/tambah');
		} else {
			
			$dataD = array(
				'nama_pendonasi' => $this->input->post('nama_pendonasi'),
				'nohp_pendonasi' => $this->input->post('nohp_pendonasi'),
				'jumlah_buku' => $this->input->post('jumlah_buku'),
				'tgl_donasi' => $this->input->post('tanggal_donasi'),
			);
			$resultD = $this->m_donasi->insertData($dataD);

			if ($resultD == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Donasi Berhasil di Simpan</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Donasi Gagal di Simpan</div>");
			}
			redirect('donasi');
		}
	}

	public function cetakSuratDonasi($id){
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataDonasi'] = $this->m_donasi->getAllData();
			$this->load->view('v_cetak_suratDonasi',$data);
		} else {
			redirect('admin');
		}
	}
}