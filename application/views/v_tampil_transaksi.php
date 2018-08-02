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
                    <?php echo $this->session->flashdata('pesanDenda'); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Kelola Transaksi
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Kode DDC</th>
                                            <th>Judul Buku</th>
                                            <th>NIS</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tgl Peminajaman</th>
                                            <th>Tgl Pengembalian</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if (empty($dataTransaksi)) { ?>
                                                <tr>
                                                    <td colspan="7" style="text-align: center;">Tidak ada transaksi</td>
                                                </tr>
                                        <?php } else {
                                        foreach ($dataTransaksi as $data) { ?>
                                            <tr>
                                                <td><?php echo $data->kode_ddc; ?></td>
                                                <td><?php echo $data->judul_buku; ?></td>
                                                <td><?php echo $data->nis; ?></td>
                                                <td><?php echo $data->nama_peminjam; ?></td>
                                                <td><?php echo $data->tgl_peminjaman; ?></td>    
                                                <td><?php echo $data->tgl_pengembalian; ?></td>
                                                <td>
                                                <?php
                                                    if ($data->status == 1) { ?>
                                                <a data-toggle="modal" data-target=".modalPengembalian" id="<?= $data->transaksi_id?>" class="btn btn-primary btn-sm pengembalian">Mengembalikan
                                                <?php if ($data->tgl_pengembalian < date('Y-m-d')) { ?>
                                                 <a href="<?= base_url()?>index.php/Transaksi/smsDenda/<?= $data->transaksi_id?> " style="margin: 4px" class="btn-primary btn-sm pengembalian">Sms
                                                <?php } ?>
        
                                                <?php  } else { ?>
                                                <a class="btn btn-success btn-sm">Sudah dikembalikan</a>                                                
                                                <?php }?>
                                                
                                                </td>
                                            </tr>
                                        <?php } } ?>
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
            <div class="modal fade modalPengembalian">
                <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Pengembalian Buku</h4>
                        </div>
                        <div class="modal-body">
                            <label>Denda : Rp 
                                <span class="content-body"></span>    
                            </label>
                            <form method="POST" action="<?= base_url()?>index.php/Transaksi/tambahLaporanDenda">
                            <label>ISBN</label>
                            <input type="text" name="barcode" class="form-control"></input>
                            <input type="hidden" id="denda" name="denda"></input>
                            <input type="hidden" id="transaksi_id" name="transaksi_id"></input>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button  type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        <footer><p align="center">All right reserved. &copy; 2017 Genius Library</p></footer>
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
    <script type="text/javascript">
        $(document).on('click','.pengembalian',function(){
            var  transaksi_id = $(this).attr("id");

            $.ajax({
                url: '<?= base_url()?>index.php/Transaksi/tampilDenda/'+transaksi_id,
                method: 'POST',
                data: {transaksi_id:transaksi_id},
                dataType:"json",
                success: function(data){
                    $('.content-body').html(data.denda);
                    $('#denda').val(data.denda);
                    $('#transaksi_id').val(data.transaksi_id);

                }
            });
        });

       

    </script>

    <script type="text/javascript">
         $(document).on('click','.sms',function(){
            var id =$(this).attr("data-id");

            $.ajax({
                url:'<?= base_url()?>index.php/Transaksi/smsDenda',
                method: 'POST',
                data: {id: id},
                success: function(data){
                    alert(id);
                }
            });
        });
    </script>

         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>