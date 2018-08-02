<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_peminjam');
		$this->load->model('m_buku');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataPeminjam'] = $this->m_peminjam->getAllData();
			$this->load->view('v_tampil_peminjam',$data);
		} else {
			redirect('admin');
		}	
	}

	public function tambah() {
		$this->load->view('v_tambah_peminjam');
	}

	public function dataSiswa($nis){
		$datasiswa = $this->m_peminjam->getDataByNis($nis);
		$dataBuku = $this->m_buku->getDataTersedia();
		$dataPeminjam = $this->m_peminjam->getAllData();
		
		if (empty($datasiswa)) {
			echo '
				<br><br>
				<div class="alert alert-danger" id="alert">
					NIS belum terdaftar
				</div>
			';			
		} else {
			foreach ($datasiswa as $ds) {
			}

			echo '	
				<form action="'.base_url().'index.php/peminjam/tambahData" method="POST">
				<br><br>
				<div class="form-group">
					<label style="font-size: 15px">Nama</label>
                    <input type="text" name="nama" value="'.$ds->nama_peminjam.'" class="form-control" placeholder="Nomor Induk Siswa" readonly></input> 
                    <input type="hidden" name="nis" value="'.$nis.'" class="form-control"></input> 
				</div>
				<div class="form-group">
					<label style="font-size: 15px">Kelas</label>
                    <input type="text" name="kelas" value="'.$ds->kelas.'" class="form-control" placeholder="Kelas" readonly></input> 
				</div>
				<div class="form-group">
					<label style="font-size: 15px">Angkatan</label>
                    <input type="text" name="angkatan" value="'.$ds->angkatan.'" class="form-control" placeholder="Angkatan" readonly></input> 
				</div>
			 	<div class="form-group">
                    <label>Judul Buku</label>
                    <select class="form-control" name="kode_ddc">';
                        foreach ($dataBuku as $db) { 
            echo 			'<option value="'.$db->kode_ddc.'">'.$db->kode_ddc.' - '.$db->judul_buku.'</option> ';
                        }
            echo    '</select>
                </div>
                <div class="form-group">
					<label style="font-size: 15px">Tanggal kembali</label>
                    <input type="date" min="'.date('Y-m-d').'" name="tglkembali" class="form-control" placeholder="Tanggal Kembali"></input> 
				</div>
                <div class="form-group" style="float:right">
                	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                	<button  type="submit" class="btn btn-success">Pinjam</button>
                </div>
                <br>
                </form>
			';
		}
	}

	public function tambahData(){	
		$nis = $this->input->post('nis');
		$kode_ddc = $this->input->post('kode_ddc');
		$tgl_peminjaman = date('Y-m-d');
		$tgl_pengembalian = $this->input->post('tglkembali');

		$cekstok = $this->m_buku->getDataByNoBuku($kode_ddc);

		foreach ($cekstok as $key) {
			$stok = $key->stok_buku-1;
		} 

		if ($tgl_pengembalian < $tgl_peminjaman) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Tanggal pengembalian tidak sesuai<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
			redirect('beranda');
		} else {
			$stokBaru = array(
				'stok_buku' => $stok
			);
			$updatestok = $this->m_buku->updateData($kode_ddc,$stokBaru);

			$data = array(
				'kode_ddc' => $kode_ddc,
				'no_unik' => $cekstok[0]->no_unik,
				'isbn_buku' => $cekstok[0]->isbn_buku,
				'nis' => $nis,
				'tgl_peminjaman' => $tgl_peminjaman,
				'tgl_pengembalian' => $tgl_pengembalian,
				'status' => 1
			);

			$resulttransaksi = $this->m_peminjam->insertBuku($data);

			if ($resulttransaksi == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Peminjam Berhasil di Simpan<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
				redirect('beranda');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Peminjam Gagal di Simpan<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
				redirect('beranda');	
			}
		}
	}

	public function tambahSiswa(){
		if (isset($this->session->userdata['logged_in'])) {
			$nis = addslashes($this->input->post('nis'));
			$this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'trim|required');
			$this->form_validation->set_rules('alamat_peminjam', 'Alamat Peminjam', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Isikan Data yang ingin diubah dengan Benar</div>");
				redirect("peminjam");
			} else {
				$data = array(
					'nis' => $nis,
					'nama_peminjam' => $this->input->post('nama_peminjam'),
					'alamat_peminjam' => $this->input->post('alamat_peminjam'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'angkatan' => $this->input->post('angkatan'),
					'notlp' => $this->input->post('notlp'),
					'kelas' => $this->input->post('kelas')
				);
				$result = $this->m_peminjam->insertData($data);
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Peminjam Berhasil di Simpan<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
				redirect('peminjam');
			}
		} else {
			redirect('admin');
		}
	}

	public function ubah() {
		if (isset($this->session->userdata['logged_in'])) {
			$nis = $this->uri->segment(3);
			if ($nis == NULL) {
				redirect('peminjam');
			} else {
				$data['qData'] = $this->m_peminjam->getDataByNis($nis);
				$this->load->view('v_edit_peminjam',$data);
			}
		} else {
			redirect('admin');
		}
	}

	public function ubahData() {
		$nis = addslashes($this->input->post('nis'));
		$this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'trim|required');
		$this->form_validation->set_rules('alamat_peminjam', 'Alamat Peminjam', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Isikan Data yang ingin diubah dengan Benar</div>");
			redirect("peminjam/ubah/".$nis);
		} else {
			$data = array(
				'nis' => $nis,
				'nama_peminjam' => $this->input->post('nama_peminjam'),
				'alamat_peminjam' => $this->input->post('alamat_peminjam'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'angkatan' => $this->input->post('angkatan'),
				'kelas' => $this->input->post('kelas')
			);
			$result = $this->m_peminjam->updateData($nis, $data);
			if ($result == TRUE) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Peminjam Berhasil di Edit</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Peminjam Gagal di Edit</div>");
			}
			redirect('peminjam');
		}
	}

	public function hapusData() {
		$nis = $this->uri->segment(3);
		$this->m_peminjam->deleteData($nis);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Peminjam Berhasil Dihapus</div>");
		redirect('peminjam');
	}
}