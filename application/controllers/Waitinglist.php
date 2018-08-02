<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waitinglist extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_peminjam');
		$this->load->model('m_buku');
		$this->load->model('m_waitinglist');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataWaitinglist'] = $this->m_waitinglist->getAllData();
			$this->load->view('v_tampil_waitinglist',$data);
		} else {
			redirect('admin');
		}	
	}

	public function tambah() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataKategori'] = $this->m_buku->getKategori();
			$data['dataBuku'] = $this->m_buku->getDataTidakTersedia();
			$data['dataPeminjam'] = $this->m_peminjam->getAllData();
			$this->load->view('v_tambah_waitinglist',$data);
		} else {
			redirect('admin');
		}
	}

	public function tambahData() {
		$data = array(
			'no_buku' => $this->input->post('no_buku'),
			'nis' => $this->input->post('nis'),
			'no_antri' => $this->input->post('no_antri'),
			'status' => 0
			);
		$result = $this->m_waitinglist->insertData($data);
		if ($result == TRUE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Waiting List Berhasil di Simpan</div>");
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Waiting List Gagal di Simpan</div>");
		}
		redirect('waitinglist');
	}

	public function ubahStatus() {
		if (isset($this->session->userdata['logged_in'])) {
			$idwaitinglist = $this->uri->segment(3);
			if ($idwaitinglist == NULL) {
				redirect('waitinglist');
			} else {
				$data = array(
					'status' => 1
				);
				$result = $this->m_waitinglist->updateData($idwaitinglist, $data);
				if ($result == TRUE) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Proses Waiting List Selesai</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Proses Waiting List Terjadi Masalah</div>");
				}
				redirect('waitinglist');
			}
		} else {
			redirect('admin');
		}
	}

	public function tampilCari($nis){
		if (isset($this->session->userdata['logged_in'])) {
			
			$siswa = $this->m_waitinglist->getSiswa($nis);
			$dataBuku = $this->m_waitinglist->getDataBuku();

			echo '
                <form role="form" method="POST" action="'.base_url().'index.php/waitinglist/tambahData">
                <input type="hidden" name="nis" value="'.$nis.'">
				<div class="form-group">
					<label>Judul Buku</label>
                        <select class="form-control" name="no_buku" required>';
                            foreach ($dataBuku as $db) { 
            echo '
                            <option value="'. $db->no_buku .'"> '. $db->no_buku.'  -  '.$db->judul_buku .'</option> ';
                            }
            echo '      </select>
				<div>
				<br>
			';

			echo '
				<div class="form-group">
                    <label>Nomor Antrian</label>
                    <select class="form-control" name="no_antri">';
                        for($i=1;$i<=20;$i++) {
            echo '            
                        <option value="'.$i.'">'.$i.'</option> ';
                        } 
            echo '  </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a type="reset" href="'.base_url().'index.php/waitinglist/" class="btn btn-default">Batal</a>
                </form>
                ';

		} else {
			redirect('admin');
		}
	}
}