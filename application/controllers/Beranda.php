<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_buku');
	}

	public function index() {
		$data['dataBuku'] = $this->m_buku->getAllData();
		$this->load->view('v_beranda',$data);
	}
}