<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_transaksi');
		$this->load->model('m_admin');
		$this->load->model('m_buku');
		$this->load->model('m_peminjam');
	}

	public function index() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataTransaksi'] = $this->m_transaksi->getAllData();
			$this->load->view('v_tampil_transaksi',$data);
		} else {
			redirect('admin');
		}	
	}

	public function denda() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataDenda'] = $this->m_transaksi->getDataDenda();
			$this->load->view('v_tampil_denda',$data);
		} else {
			redirect('admin');
		}	
	}

	public function tambahPeminjaman() {
		if (isset($this->session->userdata['logged_in'])) {
			$data['dataAdmin'] = $this->m_admin->getAllData();
			$data['dataBuku'] = $this->m_buku->getDataTersedia();
			$data['dataPeminjam'] = $this->m_peminjam->getAllData();
			$this->load->view('v_tambah_peminjaman',$data);
		} else {
			redirect('admin');
		}
	}

	public function tampilDenda($transaksi_id){

		$dataTransaksi = $this->m_transaksi->getDataTransaksi($transaksi_id);
		$sysdate = date('Y-m-d');

		foreach ($dataTransaksi as $key) {
			
		}

		if ($key->tgl_pengembalian < $sysdate) {
			$tgl_batas = new DateTime($key->tgl_pengembalian) ;
			$tgl_sekarang = new DateTime();

			$perbedaan = $tgl_sekarang->diff($tgl_batas)->format("%a");
			$denda = $perbedaan * 500;	

			$data = array(
					'denda' => $denda,
					'transaksi_id' => $transaksi_id
				);
		} else {
			$denda = 0;
			$data = array(
					'denda' => $denda,
					'transaksi_id' => $transaksi_id
				);
		}

		echo json_encode($data);
	}

	public function tambahLaporanDenda(){
		$denda = $this->input->post('denda');
		$transaksi_id = $this->input->post('transaksi_id');
		$isbn_buku = $this->input->post('barcode');
		$dataTransaksi = $this->m_transaksi->getDataById($transaksi_id);

		if ($dataTransaksi[0]->isbn_buku == $isbn_buku) {
			if ($denda != 0) {

			$data = array(
				'total_denda' => $denda,
				'transaksi_id' => $transaksi_id
			);

			$result = $this->m_transaksi->insertDenda($data);

			}

			$dataStatus = array(
					'status' => 2
				);

			foreach ($dataTransaksi as $dt) {
				$kode_ddc = $dt->kode_ddc;
			}

			$dataBuku = $this->m_buku->getDataByNoBuku($kode_ddc);

			foreach ($dataBuku as $db) {
				$stok_buku = $db->stok_buku;
			}

			$dataStok = array(
					'stok_buku' => $stok_buku + 1
				);

			$updateData = $this->m_transaksi->updateData($transaksi_id,$dataStatus);
			$updateStok = $this->m_buku->updateData($kode_ddc,$dataStok);

			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Buku Sudah Dikembalikan</div>");
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-check\"></i> Buku Tidak Sesuai</div>");
		}

		redirect('transaksi');		
	}	

	public function tambahDataPeminjaman() {
		$data = array(
			'no_buku' => $this->input->post('no_buku'),
			'nis' => $this->input->post('nis'),
			'user_id' => $this->session->userdata['logged_in']['user_id'],
			'tgl_peminjaman' => date("Y-m-d"),
			'tgl_pengembalian' => ''
			);
		$result = $this->m_transaksi->insertData($data);
		if ($result == TRUE) {
			$dataS = $this->m_buku->getDataByNoBuku($this->input->post('no_buku'));
			foreach ($dataS as $r) {
				$stok = $r->stok_buku;	
			}

			$dataStok = array(
				'stok_buku' => $stok-1
				);
			
			$this->m_buku->updateData($this->input->post('no_buku'), $dataStok);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Data Peminjaman Berhasil di Simpan</div>");
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Data Peminjaman Gagal di Simpan</div>");
		}
		redirect('transaksi');
	}

	public function pengembalianBuku() {
		$transaksi_id = $this->uri->segment(3);
		$no_buku = $this->uri->segment(4);
		$data = array(
			'tgl_pengembalian' => date("Y-m-d")
		);
		$result = $this->m_transaksi->updateData($transaksi_id, $data);
		if ($result == TRUE) {
			$dataT = $this->m_transaksi->getDataById($transaksi_id);
			foreach ($dataT as $r) {
				$tgl_peminjaman = $r->tgl_peminjaman;	
			}

			$result2 = $this->m_transaksi->getDataTransaksiTglPengembalian($transaksi_id, $tgl_peminjaman);
			if ($result2 == FALSE) {
				$dataD = array(
					'transaksi_id' => $transaksi_id,
					'total_denda' => 10000
					);
				$this->m_transaksi->insertDenda($dataD);
				$this->session->set_flashdata("pesanDenda", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Anda Lewat Dari Masa Peminjaman Sehingga Mendapatkan Denda</div>");

			}

			$dataS = $this->m_buku->getDataByNoBuku($no_buku);
			foreach ($dataS as $r) {
				$stok = $r->stok_buku;	
			}

			$dataStok = array(
				'stok_buku' => $stok+1
				);
			
			$this->m_buku->updateData($no_buku, $dataStok);
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Buku Sudah di Kembalikan</div>");
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"fa fa-times\"></i> Pengembalian Buku Gagal</div>");
		}
		redirect('transaksi');
	}

	public function smsDenda($transaksi_id){
		$datatransaksi = $this->m_transaksi->getDataTransaksi($transaksi_id);
		
		exec('c:\gammu\bin\gammu-smsd-inject.exe -c c:\gammu\bin\smsdrc EMS '.$datatransaksi[0]->notlp.' -text "Di mohon untuk mahasiswa bernama '.$datatransaksi[0]->nama_peminjam.' agar segera mengembalikan buku berjudul '.$datatransaksi[0]->judul_buku.' karena sudah melewati batas tanggal pengembalian"');

		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"fa fa-check\"></i> Sms telah dikirim</div>");
		redirect('transaksi');		
	}
}