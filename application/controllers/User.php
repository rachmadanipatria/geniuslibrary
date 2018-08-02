<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataUser'] = $this->m_admin->getAllData();
			$this->load->view('v_tampil_user',$data);
		} else {
			redirect('admin');
		}	
	}

	public function tambah() {
		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('v_tambah_user');
		} else {
			redirect('admin');
		}
	}

	public function tambahData() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Inputan Tidak Boleh Kosong</div>");
			$this->load->view('v_tambah_user');
		} else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'nama_lengkap' => $this->input->post('nama_lengkap')
				);
			$result = $this->m_admin->insertData($data);
			if ($result == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data User Berhasil di Simpan</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data User Gagal di Simpan</div>");
			}
			redirect('user');
		}
	}

	public function ubah() {
		if (isset($this->session->userdata['logged_in'])) {
			$id = $this->uri->segment(3);
			if ($id == NULL) {
				redirect('user');
			} else {
				$data['qData'] = $this->m_admin->getDataById($id);
				$this->load->view('v_edit_user.php',$data);
			}
		} else {
			redirect('admin');
		}
	}

	public function ubahData() {
		$user_id = addslashes($this->input->post('id'));
		$password = addslashes($this->input->post('password'));
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Isikan Data yang ingin diubah dengan Benar</div>");
			redirect("user/ubah/".$user_id);
		} else {
			if ($password == NULL) {
				$data = array(
					'username' => $this->input->post('username'),
					'nama_lengkap' => $this->input->post('nama_lengkap')
				);
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'nama_lengkap' => $this->input->post('nama_lengkap')
					);
			}
			$result = $this->m_admin->updateData($user_id, $data);
			if ($result == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data User Berhasil di Edit</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data User Gagal di Edit</div>");
			}
			redirect('user');
		}
	}

	public function hapusData() {
		$id = $this->uri->segment(3);
		$this->m_admin->deleteData($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-check\"></i> Data User Berhasil Dihapus</div>");
		redirect('user');
	}
}