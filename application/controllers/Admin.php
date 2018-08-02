<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index() {
		if (!isset($this->session->userdata['logged_in'])) {
			$this->load->view('v_login');
		} else {
			redirect('admin/home');
		}	
	}

	function login() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				redirect('admin/home');
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Username atau Password Tidak Sesuai</div>");
				redirect('admin');
			}
		} else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
				);
			$result = $this->m_admin->cekLogin($data);
			if ($result == TRUE) {
				$username = $this->input->post('username');
				$result = $this->m_admin->getDataByUsername($username);

				if ($result != false) {
					$session_data = array(
						'user_id' => $result[0]->user_id,
						'username' => $result[0]->username,
						'nama_lengkap' => $result[0]->nama_lengkap
						);
					$this->session->set_userdata('logged_in', $session_data);
					redirect('admin/home');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Username atau Password Salah</div>");
				redirect('admin');
			}
		}
	}

	public function logout() {
		$sess_array = array(
			'user_id' => '',
			'username' => '',
			'nama_lengkap' => ''
			);
		$this->session->unset_userdata('logged_in', $sess_array);
		redirect('admin');
	}

	public function home() {
		if (isset($this->session->userdata['logged_in'])) {
			redirect('buku');
		} else {
			redirect('admin');
		}
	}
}