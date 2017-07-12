<DOCTYPE html>

    <html lang="en">

    <head>
        <title>Y.N.G. LLC. "You'll Never Guess!"</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <meta name="YNG Print" content="">
        <style>
            body {
                font: 400 15px Lato, sans-serif;
                line-height: 1.8;
            }

            h1 {
                font-size: 24px;
                text-transform: uppercase;
                color: #303030;
                font-weight: 600;
                margin-bottom: 30px;
            }

            h2 {
                font-size: 19px;
                line-height: 1.375em;
                color: #303030;
                font-weight: 400;
                margin-bottom: 30px;
            }

            form{
                align: center;
                vertical-align: text-top;
                margin:0 auto;
            }

            .jumbotron {
                background-color: #002193;
                color: #fff;
                padding: 100px 25px;
                font-family: Montserrat, sans-serif;
                ;
            }

            .jumbotron {
                background-color: #002193;
                color: #fff;
                padding: 100px 25px;
                font-family: Montserrat, sans-serif;
                ;
            }

            .dropbtn {
                background-color: #4CAF50;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {background-color: #f1f1f1}

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dropdown:hover .dropbtn {
                background-color: #3e8e41;
            }
            .divSpecs{
                width:400px;
                margin:0 auto;
                text-align:left;
            }


            .specs{
                list-style-type: square;

            }


            .specs li{
                font-size: 30px;

            }

        </style>


    </head>

    <body id="home-page">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <img src="images/YNGlogo.jpg" height="150" width="150">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="inactive"><a href="http://yng2.dyndns.org:5006">OCTOPRINT</a></li>
                        <li class="inactive"><a href="http://www.yngllc.com">YNG LLC HOME</a></li>
                        <li class="inactive"><a href="http://store.yngllc.com/">YNG LLC STORE</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>
        <div class="content" <h1 class="centerthiscontent" align="center">
            <br> &nbsp;
            <!------PHP-------->
<?php
session_start();

include 'YNG_ACR.php';

// $db_host = "localhost";
// $db_username = "root";
// $db_pass = "ghostly219";
$db_tablename = "manipulate";

$dbConnection = new mysqli($ACR_host, $ACR_user, $ACR_pass, $db_tablename);
if(!$dbConnection){
    echo "died1 dbConnection error";
    die('Mysql connection error: ' . mysqli_connect_error());
}
if ($dbConnection->connect_error) {
    echo "died2";
    die("Connection failed: " . $dbConnection->connect_error);
}
//$dbConnection=mysqli_connect($db_host,$db_username,$db_pass);

// Zone, File Name and Location
$zoneNum = $_POST['zoneSelection'];
$printerType = $_POST['printerSelection'];
$fileName =  $_FILES['userfile']['name'];
$fileLoc = '/var/www/html/uploads/';
$dvName = $_POST['numName'];
$matType = $_POST['materialSelection'];
$dvBedFirst = $_POST['numBedFirst'];
$dvBedSec = $_POST['numBedSec'];
$dvExtruderFirst = $_POST['numExtruderFirst'];
$dvExtruderSec = $_POST['numExtruderSec'];

$dvNameDUP = $_POST['numNameDUP'];
$dvBedFirstDUP = $_POST['numBedFirstDUP'];
$dvBedSecDUP = $_POST['numBedSecDUP'];
$dvExtruderFirstDUP = $_POST['numExtruderFirstDUP'];
$dvExtruderSecDUP = $_POST['numExtruderSecDUP'];
$dvBed2FirstDUP = $_POST['numBed2FirstDUP'];
$dvBed2SecDUP = $_POST['numBed2SecDUP'];
$dvExtruder2FirstDUP = $_POST['numExtruder2FirstDUP'];
$dvExtruder2SecDUP = $_POST['numExtruder2SecDUP'];

//MySql select
  $select = "SELECT * FROM yngPrints WHERE status ='new';";
  $selectQuery = mysqli_query($dbConnection, $select);
//$varGot = mysqli_fetch_assoc($selectQuery);
  while($row=mysqli_fetch_array($selectQuery)){
    echo '<pre>'; print_r($row); echo '</pre>';
  }

//MySql insert
  $status = "new";
  $insert = "INSERT INTO yngPrints (task_id, file, file_location, zone, statusValue, bigmaxX, smallminX, bigmaxY, smallminY, bigmaxZ, progCheck, errorLog, printerType, materialType) VALUES (NULL,'$fileName','$upfile', '$zoneNum', '$status', '0', '0', '0', '0', '0', '0', 'null', '$printerType', '$matType')";
  $insertQuery = mysqli_query($dbConnection, $insert);
//  mysqli_query($dbConnection, $insert);
  if(!$insertQuery){
    echo "died1 insert error ";
    die('Mysql connection error: ' . mysqli_connect_error());
  }
  if ($insertQuery->connect_error) {
    echo "died2";
    die("Connection failed: " . $insertQuery->connect_error);
  }
//  echo var_dump($_POST);    <-- Very Handy

$sqlTemps = "INSERT INTO materialDB (Material, Bed0_First_Layer, Bed0_Sec_Layer, HotEnd0_First_Layer, HotEnd0_Sec_Layer, Bed1_First_Layer, Bed1_Sec_Layer, HotEnd1_First_Layer, HotEnd1_Sec_Layer) VALUES ('$dvNameDUP','$dvBedFirstDUP','$dvBedSecDUP','$dvExtruderFirstDUP','$dvExtruderSecDUP','$dvBed2FirstDUP','$dvBed2SecDUP', '$dvExtruder2FirstDUP', $dvExtruder2SecDUP)";
 if(mysqli_query($dbConnection, $sqlTemps)){
   echo "Bed0_Sec_Layer has been successfully updated. <br>";
 } else {
   echo "ERROR: Could not add DUPLICATION Temperatures to Table $sql. <br>" . mysqli_error($link);
 }



/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////


ini_set('display_errors', 1);
//Close Connection to the DB <-- COmment is more for a divider
mysqli_close($dbConnection);
?>


            <!---------Form Info---------------->
            <!-- <form name="fileUpload" action="index.php" method="POST" enctype="multipart/form-data" /> -->
            <div>
                <br>
                <br>
&nbsp; &nbsp;



            <!hr>
            <!--h3 style="color:rgb(14, 5, 91)">Home  |  Services  | Print Now  |  Filaments  |  Our Printers  |  Order Online  |  Support  |  About YNG</h3-->
            <!hr>



    <!-- This is how to specify that the server accept only certain image files in the file upload, we want .gco or .gcode only:

        <form action="demo_form.asp">
        <input type="file" name="pic" accept="image/*">
        <input type="submit">
        </form>

        -->

            <footer>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p style="color:rgb(4, 0, 84)"> Copyright &copy 2016 All Rights Reserved: Y.N.G LLC D.B.A. "You'll Never Guess" </p>
            </footer>

            <!--Scipts, References etc. ----------->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

            <!-- jQuery library & CSS-->
            <script type="text/javascript" src="js/jquery-3.1.0.js"></script>
            <script type="text/javascript" src="dropit.js"></script>
            <meta name="YNG Print" content="">


            <!-- JS for JQuery dropdown menu-->
            <!--<script type="text/javascript">
                $(function() {
                    $('.menu').dropit();
                });
            </script> -->


    </body>

    </html>
