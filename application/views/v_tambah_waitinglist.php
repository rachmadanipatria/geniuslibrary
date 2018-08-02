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
                             Tambah Waiting List
                        </div>
                        <div class="panel-body">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input class="form-control" type="number" id="nis" name="nis" placeholder="NIS" title="NIS">
                                </div>
                                <div id="cari">
                                    <button class="cariSiswa btn btn-primary">Cari</button>
                                <a type="reset" href="<?php echo base_url();?>index.php/waitinglist/" class="btn btn-default">Batal</a>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Judul Buku</label>
                                    <select class="form-control" name="no_buku" required>
                                        <?php foreach ($dataBuku as $db) { ?>
                                        <option value="<?php echo $db->no_buku; ?>"><?php echo $db->no_buku." - ".$db->judul_buku; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <select class="form-control" name="nis">
                                        <?php foreach ($dataPeminjam as $dp) { ?>
                                        <option value="<?php echo $dp->nis; ?>"><?php echo $dp->nis." - ".$dp->nama_peminjam; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Antrian</label>
                                    <select class="form-control" name="no_antri">
                                        <?php for($i=1;$i<=20;$i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
 -->                             
                            
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

    <script type="text/javascript">
        $(document).on('click','.cariSiswa', function(){
            var nis = document.getElementById('nis').value;

            $.ajax({
                url: '<?= base_url()?>index.php/waitinglist/tampilCari/'+nis,
                method: 'POST',
                data:{nis: nis},
                success: function(data){
                    $('#cari').html(data);
                    //alert('ok');
                }
            });
        });
    </script>
</body>
</html>