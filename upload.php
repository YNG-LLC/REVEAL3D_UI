<?php

    session_start();

    include 'YNG_ACR.php';

    $db_tablename = "manipulate";

    $dbConnection = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename);
    if(!$dbConnection){
        echo "died1 dbConnection error";
        die('Mysql connection error: ' . mysqli_connect_error());
    }
    if ($dbConnection->connect_error) {
        echo "died2";
        die("Connection failed: " . $dbConnection->connect_error);
    } else {
        //Upload file code for yngprintsDB
        $dir = 'uploads';

         // create new directory with 744 permissions if it does not exist yet
         // owner will be the user/group the PHP script is run under
         // if ( !file_exists($dir) ) {
         //     $oldmask = umask(0);  // helpful when used in linux server
         //     mkdir ($dir, 0744);
         // }


             file_put_contents ($dir.'WebSite', 'GCode');
            //Check to see if an error code was generated on the upload attempt
              if ($_FILES['userfile']['error'] > 0)
              {
                echo 'Problem: ';

                switch ($_FILES['userfile']['error'])
                {
                  case 1:	echo 'File exceeded upload_max_filesize';
                              break;
                  case 2:	echo 'File exceeded max_file_size';
                              break;
                  case 3:	echo 'File only partially uploaded';
                              break;
                  case 4:	echo 'No file uploaded';
                              break;
                  case 6:   echo 'Cannot upload file: No temp directory specified.';
                              break;
                  case 7:   echo 'Upload failed: Cannot write to disk.';
                              break;
                }
                exit;
              }
            // Zone, File Name and Location
              $zoneNum = $_POST['zoneSelection'];
              //$printerType = $_POST['printerSelection'];
              $printerType = $printerebk;
              $fileName =  $_FILES['userfile']['name'];
              $fileLoc = '/var/www/html/uploads/';
              $dvName = $_POST['numName'];
              $matType = $_POST['materialSelection'];
              $nozMode = $_POST['nozzleSelection'];
              // $dvBedFirst = $_POST['numBedFirst'];
              // $dvBedSec = $_POST['numBedSec'];
              // $dvExtruderFirst = $_POST['numExtruderFirst'];
              // $dvExtruderSec = $_POST['numExtruderSec'];
              //
              // $dvNameDUP = $_POST['numNameDUP'];
              // $dvBedFirstDUP = $_POST['numBedFirstDUP'];
              // $dvBedSecDUP = $_POST['numBedSecDUP'];
              // $dvExtruderFirstDUP = $_POST['numExtruderFirstDUP'];
              // $dvExtruderSecDUP = $_POST['numExtruderSecDUP'];
              // $dvBed2FirstDUP = $_POST['numBed2FirstDUP'];
              // $dvBed2SecDUP = $_POST['numBed2SecDUP'];
              // $dvExtruder2FirstDUP = $_POST['numExtruder2FirstDUP'];
              // $dvExtruder2SecDUP = $_POST['numExtruder2SecDUP'];
              //echo  "var_dump($_POST)";    //<-- Very Handy




            // variable to put the file where we'd like it
              $upfile = $fileLoc.$fileName;
            //  $upfile = $fileLoc;

              if (is_uploaded_file($_FILES['userfile']['tmp_name']))
              {
                 if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile))
                 {
                    echo 'Problem: Could not move file to destination directory';
                    exit;
                 }
              }
              else
              {
                exit;
                echo 'Problem: Possible file upload attack. Filename: ';
                echo $_FILES['userfile']['name'];
                exit;
              }

              $victory = '<p style="font-size: 30px; color: #0004f7;">'.'File uploaded to the queue!<br>'.'</p>';
              //echo $printerType;
            //MySql select
              $select = "SELECT * FROM yngPrints WHERE status ='new';";
              $selectQuery = mysqli_query($dbConnection, $select);
            //$varGot = mysqli_fetch_assoc($selectQuery);
              while($row=mysqli_fetch_array($selectQuery)){
                echo '<pre>'; print_r($row); echo '</pre>';
              }

            //MySql insert
              $status = "new";
              $insert = "INSERT INTO yngPrints (task_id, file, file_location, zone, statusValue, bigmaxX, smallminX, bigmaxY, smallminY, bigmaxZ, progCheck, errorLog, printerType, materialType, nozzleMode) VALUES (NULL,'$fileName','$upfile', '$zoneNum', '$status', '0', '0', '0', '0', '0', '0', 'null', '$printerType', '$matType', '$nozMode')";
              $insertQuery = mysqli_query($dbConnection, $insert);


            // ### Update Nozzle Mode in UI Settings DB ### 
              if(isset($_POST['submitSelection'])){

                  $db_tablename = "yngUI";
                  $dbc = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename)
                      or die('Error communicating to MySQL server');

                  $postNozzle = $_POST["nozzleSelection"];
                  // echo $postNozzle;

                  $tmpnoz  = mysqli_fetch_row($dbc->query("SELECT NozzleType FROM settingsUI"));
                  $nozzleType = $tmpnoz[0];


                  if($nozzleType == "Single"){
                      // echo "single";
                      $updateNT = "UPDATE settingsUI SET NozzleType = '$postNozzle' WHERE NozzleType = 'Single'";
                      $updateDT = "UPDATE settingsUI SET Date_Updated = '$activeDT' WHERE NozzleType = 'Single'";

                      $updateNT_Query = mysqli_query($dbc, $updateNT);
                      $updateDT_Query = mysqli_query($dbc, $updateDT);

                  }

                  elseif($nozzleType == "Duplication"){
                      // echo "duplicationDUP";
                      $updateNT = "UPDATE settingsUI SET NozzleType = '$postNozzle' WHERE NozzleType = 'Duplication'";
                      $updateDT = "UPDATE settingsUI SET Date_Updated = '$activeDT' WHERE NozzleType = 'Duplication'";

                      $updateNT_Query = mysqli_query($dbc, $updateNT);
                      $updateDT_Query = mysqli_query($dbc, $updateDT);
                  }
              }




            //  mysqli_query($dbConnection, $insert);
              if(!$insertQuery){
                echo "died1 insert error ";
                die('Mysql connection error: ' . mysqli_connect_error());
              }
              if ($insertQuery->connect_error) {
                echo "died2";
                die("Connection failed: " . $insertQuery->connect_error);
              }


              //ini_set('display_errors', 1);
              //Close Connection to the DB 
              // mysqli_close($dbConnection);


}


    ini_set('display_errors', 1);
    //Close Connection to the DB <-- Comment is more for a divider
    mysqli_close($dbConnection);


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Post Upload</title>


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <script src="sweetalert-master/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">  

</head>

<body>

    <div id="wrapper">

        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" align="center"><?php echo $victory; ?></h1>
                </div>
                <div class="row">
                <div class="col-lg-7" position ="absolute" >
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-magic fa-fw"></i> Upload Details</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <br>
                            <ul class="specs">
                             <label style="font-size: 150%;">File Name:</label>&nbsp;&nbsp;<text style="font-size: 150%;"><?php echo $_FILES['userfile']['name']; ?></text><br><br>
                             <label style="font-size: 150%;">Zone:</label>&nbsp;&nbsp;<text style="font-size: 150%;"><?php echo $zoneNum; ?></text><br><br>
                             <label style="font-size: 150%;">Nozzle Mode:</label>&nbsp;&nbsp;<text style="font-size: 150%;"><?php echo $nozMode; ?></text><br><br>
                             <label style="font-size: 150%;">Material:</label>&nbsp;&nbsp;<text style="font-size: 150%;"><?php echo $matType; ?></text><br><br>
                            </ul>
                            <br>
                        </div>
                        </div>
                    </div>
                </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>


</body>

<footer class="panel-footer" align="center">
    <p style="color:rgb(4, 0, 84)"> Copyright &copy 2017 All Rights Reserved: Y.N.G LLC D.B.A. "You'll Never Guess" </p>
</footer>

</html>

