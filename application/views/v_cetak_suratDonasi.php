<?php
    foreach ($dataDonasi as $dp) {
        $donasi_id = $dp->donasi_id;
        $nama = $dp->nama_pendonasi;
        $contact = $dp->nohp_pendonasi;
        $jumlah_buku = $dp->jumlah_buku;
        $tgl_donasi = $dp->tgl_donasi;
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
                                    <table >
                                        <tr>
                                            <td width="300" >Donasi Id</td>
                                            <td> : </td>
                                            <td><?php echo $donasi_id; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Pendonasi</td>
                                            <td> : </td>
                                            <td><?php echo $nama; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kontak</td>
                                            <td> : </td>
                                            <td><?php echo $contact; ?></td>
                                        </tr>
                                        
                                    </table>
                                    <p>Bahwa telah mendonasikan sebanyak <?= $jumlah_buku?> buku pada tanggal <?= $tgl_donasi?>.</p>
                                </div>
                                <div class="col-lg-3">
                                </div>
                               	<hr>
                                <div align="right">
									<p>
										Bandung, <?php echo date('d-m-Y'); ?>
										<br>
										<?php echo $this->session->userdata['logged_in']['nama_lengkap'];?>
										<br>
										<br>
										<br>
										<br>
										<br>
										___________________
										<br>
									</p>
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
