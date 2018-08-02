<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perpus SMAN 27 BDG</title>
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
                             Tambah Donasi
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="<?php echo base_url();?>index.php/donasi/tambahData">
                                <div class="form-group">
                                    <label>Nama Pendonasi</label>
                                    <input type="text" class="form-control" placeholder="Nama Pendonasi" name="nama_pendonasi">
                                </div>
                                <div class="form-group">
                                    <label>Contact Pendonasi</label>
                                    <input type="text" class="form-control" placeholder="Contact Pendonasi" name="nohp_pendonasi">
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Buku</label>
                                    <input type="number" class="form-control" placeholder="Jumlah Buku" name="jumlah_buku" maxlength="11">
                                </div>
                                 <div class="form-group">
                                    <label>Tanggal Donasi</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Donasi" name="tanggal_donasi" maxlength="11">
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <a type="reset" href="<?php echo base_url();?>index.php/donasi/" class="btn btn-default">Batal</a>
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