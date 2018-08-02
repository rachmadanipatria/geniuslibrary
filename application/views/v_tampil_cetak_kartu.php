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
    <!-- TABLE STYLES-->
    <link href="<?php echo base_url();?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                             Data Peminjam
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama Peminjam</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Angkatan</th>
                                            <th>Kelas</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataPeminjam as $data) { ?>
                                            <tr>
                                                <td><?php echo $data->nis; ?></td>
                                                <td><?php echo $data->nama_peminjam; ?></td>
                                                <td><?php echo $data->jenis_kelamin; ?></td>
                                                <td><?php echo $data->angkatan; ?></td>
                                                <td><?php echo $data->kelas; ?></td>
                                                <td align="center"><a href="<?php echo base_url();?>index.php/cetak_kartu/cetak/<?php echo $data->nis; ?>" class="btn btn-primary btn-sm">Cetak Kartu</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url();?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>