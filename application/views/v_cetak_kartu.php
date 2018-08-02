<?php
    foreach ($dataPeminjam as $dp) {
        $nis = $dp->nis;
        $nama = $dp->nama_peminjam;
        $alamat = $dp->alamat_peminjam;
        $jenis_kelamin = $dp->jenis_kelamin;
        $angkatan = $dp->angkatan;
        $kelas = $dp->kelas;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surat Bebas Perpustakaan SMAN 27 Bandung</title>
	<!-- Bootstrap Styles-->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="<?php echo base_url();?>assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body onload="window.print();">
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" style="margin: 0px; min-height: 0px;">
            <div id="page-inner" style="min-height: 560px;">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header text-center">
                            Perpustakaan SMAN 27 Bandung
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-6">
                                    <p>Dengan ini kami menyatakan bahwa:</p>
                                    <table width="400px;">
                                        <tr>
                                            <td>NIS</td>
                                            <td> : </td>
                                            <td><?php echo $nis; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td> : </td>
                                            <td><?php echo $nama; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td> : </td>
                                            <td><?php echo $alamat; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td> : </td>
                                            <td><?php echo $jenis_kelamin; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Angkatan</td>
                                            <td> : </td>
                                            <td><?php echo $angkatan; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td> : </td>
                                            <td><?php echo $kelas; ?></td>
                                        </tr>
                                    </table>
                                    <p>Telah bebas dari peminjaman buku di perpustakaan SMAN 27 Bandung.</p>
                                </div>
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                    Dicetak pada tanggal <?php echo date('d - F - Y'); ?> oleh <?php echo $this->session->userdata['logged_in']['nama_lengkap'];?>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<footer><p align="center">All right reserved. &copy; 2018 Perpustakaan SMAN 27 Bandung</p></footer>
			</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
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