<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_buku');
		$this->load->model('m_peminjam');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataBuku'] = $this->m_buku->getAllData();
			$this->load->view('v_tampil_buku',$data);
		} else {
			redirect('admin');
		}	
	}

	public function tambah() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataKategori'] = $this->m_buku->getKategori();
			$data['jmlbuku'] = count($this->m_buku->getAllData());
			$this->load->view('v_tambah_buku',$data);
		} else {
			redirect('admin');
		}
	}

	public function tambahData() {
		$this->form_validation->set_rules('judul_buku', 'Judul Buku', 'trim|required');
		$this->form_validation->set_rules('stok_buku', 'Stok Buku', 'trim|required|is_natural');
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');

		$datasiswa = $this->m_peminjam->getAllData();
		$cekrak = $this->m_buku->getDataRak($this->input->post('kode_rakbuku'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Inputan Tidak Sesuai Isikan Data Buku Dengan Benar</div>");
			redirect('buku/tambah');
		} else {
			if (empty($cekrak)) {
				$data = array(
				'kode_ddc' => $this->input->post('kode_ddc'),
				'tahun_masuk' => $this->input->post('tahun_masuk'),
				'kode_rakbuku' => $this->input->post('kode_rakbuku'),
				'tahun_terbit' => $this->input->post('tahun_terbit'),
				'kode_rakbuku' => $this->input->post('kode_rakbuku'),
				'isbn_buku' => $this->input->post('barcode'),
				'judul_buku' => $this->input->post('judul_buku'),
				'kategori_id' => $this->input->post('kategori_id'),
				'stok_buku' => $this->input->post('stok_buku'),
				'penerbit' => $this->input->post('penerbit'),
				'subyek' => $this->input->post('subyek')
				);
			$result = $this->m_buku->insertData($data);
			if ($result == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Buku Berhasil di Simpan</div>");
				foreach ($datasiswa as $siswa) {
					exec('c:\gammu\bin\gammu-smsd-inject.exe -c c:\gammu\bin\smsdrc EMS '.$siswa->notlp.' -text "Terdapat buku baru berjudul '.$this->input->post('judul_buku').' diperpustakaan SMA 27 Bandung"');	
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Buku Gagal di Simpan</div>");
			}
			redirect('buku');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-check\"></i> Rak sudah terisi</div>");
				redirect('buku/tambah');
			}	
		}
	}

	public function ubah() {
		if (isset($this->session->userdata['logged_in'])) {
			$no_buku = $this->uri->segment(3);
			if ($no_buku == NULL) {
				redirect('buku');
			} else {
				$data['dataKategori'] = $this->m_buku->getKategori();
				$data['qData'] = $this->m_buku->getDataByNoBuku($no_buku);
				$this->load->view('v_edit_buku',$data);
			}
		} else {
			redirect('admin');
		}
	}

	public function ubahData() {
		$kode_ddc = addslashes($this->input->post('kode_ddc'));
		$this->form_validation->set_rules('judul_buku', 'Judul Buku', 'trim|required');
		$this->form_validation->set_rules('stok_buku', 'Stok Buku', 'trim|required|is_natural');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Isikan Data yang ingin diubah dengan Benar</div>");
			redirect("buku/ubah/".$no_buku);
		} else {
			$data = array(
				'kode_ddc' => $this->input->post('kode_ddc'),
				'tahun_masuk' => $this->input->post('tahun_masuk'),
				'kode_rakbuku' => $this->input->post('kode_rakbuku'),
				'tahun_terbit' => $this->input->post('tahun_terbit'),
				'kode_rakbuku' => $this->input->post('kode_rakbuku'),
				'isbn_buku' => $this->input->post('barcode'),
				'judul_buku' => $this->input->post('judul_buku'),
				'kategori_id' => $this->input->post('kategori_id'),
				'stok_buku' => $this->input->post('stok_buku'),
				'penerbit' => $this->input->post('penerbit'),
				'subyek' => $this->input->post('subyek')
			);
			$result = $this->m_buku->updateData($kode_ddc, $data);
			if ($result == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Buku Berhasil di Edit</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Buku Gagal di Edit</div>");
			}
			redirect('buku');
		}
	}

	public function hapusData() {
		$kode_ddc = $this->uri->segment(3);
		$this->m_buku->deleteData($kode_ddc);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Buku Berhasil Dihapus</div>");
		redirect('buku');
	}
}