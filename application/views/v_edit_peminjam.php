<?php
  foreach ($qData as $row) {
    $nis = $row->nis;
    $nama_peminjam = $row->nama_peminjam;
    $alamat_peminjam = $row->alamat_peminjam;
    $jenis_kelamin = $row->jenis_kelamin;
    $angkatan = $row->angkatan;
    $kelas = $row->kelas;
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
                             Edit Peminjam
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="<?php echo base_url();?>index.php/peminjam/ubahData">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" placeholder="Nomor Induk Siswa" name="nis" value="<?php echo $nis; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input type="text" class="form-control" placeholder="Nama Peminjam" name="nama_peminjam" value="<?php echo $nama_peminjam; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Alamat Peminjam</label>
                                    <textarea name="alamat_peminjam" class="form-control" placeholder="Alamat Peminjam" style="resize: vertical;"><?php echo $alamat_peminjam; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="<?php echo $jenis_kelamin; ?>"><?php echo $jenis_kelamin; ?></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Angkatan</label>
                                    <select class="form-control" name="angkatan">
                                        <option value="<?php echo $angkatan; ?>"><?php echo $angkatan; ?></option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control" name="kelas">
                                        <option value="<?php echo $kelas; ?>"><?php echo $kelas; ?></option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a type="reset" href="<?php echo base_url();?>index.php/peminjam/" class="btn btn-default">Batal</a>
                            </form>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
            <!-- /. ROW  -->
        </div>
        <footer><p align="center">All right reserved. &copy; 2018 Perpustakan SMAN 27 Bandung</p></footer>
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