<?php
include 'YNG_ACR.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>YNG 3D Hub</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" align="center">YNG 3D Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="clearfix">
                    <div class="col-lg-7" style=" max-width:100%;max-height:100%; display: block; margin: 0 auto;">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Live Print</h3>
                            </div>
                            <div class="panel-body" align="center">
                                <img src='http://<?php echo $fetchIp; ?>' style=" max-width:100%;max-height:100%; display: block; margin: 0 auto;" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="vendor/raphael/raphael.min.js"></script> -->
    <!-- <script src="vendor/morrisjs/morris.min.js"></script> -->
    <!-- <script src="data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>
<?php 
include 'footer.php'; 
 ?>

</html>