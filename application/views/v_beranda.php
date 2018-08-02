<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>perpus 27</title>
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
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" style="font-size: 25px;" href="<?php echo base_url();?>beranda">Perpus SMAN 27</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a data-toggle="modal" data-target=".modalPeminjaman"  aria-expanded="false">
                         <i class="fa fa-book fa-fw"></i> Peminjaman
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?php echo base_url();?>index.php/admin" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> Login
                    </a>
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" style="margin: 0px; min-height: 0px;">
            <div id="page-inner" style="min-height: 560px;">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header text-center">
                            Katalog Buku SMAN 27 Bandung
                        </h1>
                    </div>
                </div>
                    <?php echo $this->session->flashdata('pesan'); ?>

                 <!-- /. ROW  -->
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode DDC</th>
                                            <th>Judul Buku</th>
                                            <th>Kategori</th>
                                            <th>Stok Buku</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($dataBuku as $data) { ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data->kode_ddc; ?></td>
                                                <td><?php echo $data->judul_buku; ?></td>
                                                <td><?php echo $data->nama_kategori; ?></td>
                                                <td><?php echo $data->stok_buku; ?></td>
                                                <?php if ($data->stok_buku == 0) { ?>
                                                <td>Tidak Tersedia</td>
                                                <?php } else { ?>
                                                <td>Tersedia</td>
                                                <?php } ?>
                                            </tr>
                                        <?php $no++; }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="modal fade modalPeminjaman">
                <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Peminjaman Buku</h4>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label style="font-size: 15px">NIS</label>
                                <input type="number" name="nis" id="nis" class="form-control" placeholder="Nomor Induk Siswa"></input> 
                            </div>
                            <div class="form-group">
                                <a class="cari btn btn-default btn-sm" style="float: right;">Cari</a>
                            </div>
                            <div class="data">
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                        </form>
                    </div>
                </div>
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
    <script type="text/javascript">
        $(document).on('click','.cari', function(){
            var nis = document.getElementById('nis').value;
            
            $.ajax({
                url:"<?php echo base_url()?>index.php/peminjam/dataSiswa/"+nis,
                method:"POST",
                data:{'nis':nis},
                success:function(data){
                    $('.data').html(data);        
                }
            });
        });
    </script>
</body>
</html>