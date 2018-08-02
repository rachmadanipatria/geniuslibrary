<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_kategori');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataKategori'] = $this->m_kategori->getAllData();
			$this->load->view('v_tampil_kategori',$data);
		} else {
			redirect('admin');
		}	
	}

	public function tambah() {
		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('v_tambah_kategori');
		} else {
			redirect('admin');
		}
	}

	public function tambahData() {
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Inputan Tidak Boleh Kosong</div>");
			$this->load->view('v_tambah_kategori');
		} else {
			$data = array(
				'nama_kategori' => $this->input->post('nama_kategori')
				);
			$result = $this->m_kategori->insertData($data);
			if ($result == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Kategori Berhasil di Simpan</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Kategori Gagal di Simpan</div>");
			}
			redirect('kategori');
		}
	}

	public function ubah() {
		if (isset($this->session->userdata['logged_in'])) {
			$id = $this->uri->segment(3);
			if ($id == NULL) {
				redirect('kategori');
			} else {
				$data['qData'] = $this->m_kategori->getDataById($id);
				$this->load->view('v_edit_kategori',$data);
			}
		} else {
			redirect('admin');
		}
	}

	public function ubahData() {
		$id = addslashes($this->input->post('id'));
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Isikan Data yang ingin diubah dengan Benar</div>");
			redirect("kategori/ubah/".$id);
		} else {
			$data = array(
				'nama_kategori' => $this->input->post('nama_kategori')
			);
			$result = $this->m_kategori->updateData($id, $data);
			if ($result == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Kategori Berhasil di Edit</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Kategori Gagal di Edit</div>");
			}
			redirect('kategori');
		}
	}

	public function hapusData() {
		$id = $this->uri->segment(3);
		$this->m_kategori->deleteData($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Kategori Berhasil Dihapus</div>");
		redirect('kategori');
	}
}