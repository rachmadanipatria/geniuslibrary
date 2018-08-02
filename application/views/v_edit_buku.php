<?php
  foreach ($qData as $row) {
    $kode_ddc = $row->kode_ddc;
    $isbn_buku = $row->isbn_buku;
    $penerbit = $row->penerbit;
    $tahun_terbit = $row->tahun_terbit;
    $tahun_masuk = $row->tahun_masuk;
    $kode_rakbuku = $row->kode_rakbuku;
    $subyek = $row->subyek;
    $judul_buku = $row->judul_buku;
    $kategori_id = $row->kategori_id;
    $nama_kategori = $row->nama_kategori;
    $stok_buku = $row->stok_buku;
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Genius Library</title>
	<!-- Bootstrap Styles-->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom Styles-->
    <link href="<?php echo base_url();?>assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <?php $this->load->view('header.php'); ?>
        <!--/. NAV TOP  -->
        <?php $this->load->view('sidebar.php'); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <?php echo $this->session->flashdata('pesan'); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Edit Buku
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="<?php echo base_url();?>index.php/buku/ubahData">
                                <div class="col-md-3 form-group">
                                    <label>Kode DDC</label>
                                    <input readonly="" type="number" class="form-control" placeholder="Kode DDC" name="kode_ddc" value="<?php echo $kode_ddc; ?>"  maxlength="11">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Tahun Masuk</label>
                                    <select name="tahun_masuk" class="form-control">
                                        <option selected="" value="<?= $tahun_masuk?>"><?= $tahun_masuk ?></option>
                                        <?php $tahun = 2010;
                                            for ($i=0; $i <= 10 ; $i++) { ?> 
                                                <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                        <?php $tahun++; }  ?>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Kode Rak Buku</label>
                                    <input type="text" class="form-control" placeholder="Kode Rak" name="kode_rakbuku" value="<?= $kode_rakbuku?>" maxlength="11">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Tahun Terbit</label>
                                    <input type="number" class="form-control" placeholder="Tahun Terbit" value="<?= $tahun_terbit?>" name="tahun_terbit" maxlength="11">
                                </div>
                                <div class="form-group">
                                    <label>ISBN buku</label>
                                    <input type="text" class="form-control" placeholder="ISBN Buku" name="barcode" value="<?php echo $isbn_buku; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Judul buku</label>
                                    <input type="text" class="form-control" placeholder="Judul Buku" name="judul_buku" value="<?php echo $judul_buku; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <input type="text" class="form-control" placeholder="Penerbit" name="penerbit" value="<?php echo $penerbit; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Subyek</label>
                                    <input type="text" class="form-control" placeholder="Subyek" name="subyek" value="<?php echo $subyek; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori_id">
                                        <option value="<?php echo $kategori_id; ?>"><?php echo $nama_kategori; ?></option>
                                        <?php foreach ($dataKategori as $dk) { ?>
                                        <option value="<?php echo $dk->kategori_id; ?>"><?php echo $dk->nama_kategori; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Stok Buku</label>
                                    <input type="number" class="form-control" placeholder="Stok Buku" name="stok_buku" value="<?php echo $stok_buku; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a type="reset" href="<?php echo base_url();?>index.php/buku/" class="btn btn-default">Batal</a>
                            </form>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
            <!-- /. ROW  -->
        </div>
        <footer><p align="center">All right reserved. &copy; 2018 Perpustakaan SMAN 27 Bandung</p></footer>
    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->

    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url()?>assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url()?>assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="<?php echo base_url()?>assets/js/custom-scripts.js"></script>
</body>
</html>