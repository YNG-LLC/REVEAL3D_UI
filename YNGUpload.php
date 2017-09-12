<!-- Tabs = 4 Spaces -->
<?php
//Start Session to get POST Variables
session_start();

include 'YNG_ACR.php';

$db_tablename = "manipulate";



//MySql select
$select = "SELECT Material FROM materialDB";           # this selects material from materialDB
$selectQuery = mysqli_query($dbConnection, $select);

$selectMatType = "SELECT MaterialType FROM yngprints";
$selectprintQuery = mysqli_query($dbConnection, $selectMatType);



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>YNG 3D Hub</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <!-- <link href="vendor/morrisjs/morris.css" rel="stylesheet"> -->
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--<script type="text/javascript" src="YNG_ACR.js"></script>-->
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">

    <script>


        function ShowHideDiv() {
            var ddlPrintOrAdd = document.getElementById("ddlPrintOrAdd");
            var dvBedFirst = document.getElementById("dvBedFirst");
            var dvExtruderFirst = document.getElementById("dvExtruderFirst");
            var ddlSingleDup = document.getElementById("ddlSingleDup");
            var dvSingleDup = document.getElementById("dvSingleDup");
            dvSingleDup.style.display = ddlPrintOrAdd.value == "1" ? "block" : "none";
            dvBedFirst.style.display = ddlSingleDup.value == "S" ?  "block" : "none";
            dvExtruderFirst.style.display = ddlSingleDup.value == "S" ? "block" : "none";
            var dvName = document.getElementById("dvName");
            dvName.style.display = ddlSingleDup.value == "S" ? "block" : "none";
            var dvBedSec = document.getElementById("dvBedSec");
            var dvExtruderSec = document.getElementById("dvExtruderSec");
            dvBedSec.style.display = ddlSingleDup.value == "S" ? "block" : "none";
            dvExtruderSec.style.display = ddlSingleDup.value == "S" ? "block" : "none";
            var fileUpload = document.getElementById("fileUpload");
            fileUpload.style.display = ddlPrintOrAdd.value == "P" ? "block" : "none";
            var printerSelect = document.getElementById("printerSelect");
            printerSelect.style.display = ddlPrintOrAdd.value == "P" ? "block" : "none";
            var materialSelection = document.getElementById("materialSelection");
            materialSelection.style.display = ddlPrintOrAdd.value == "P" ? "block" : "none";
            var zoneSelect = document.getElementById("zoneSelect");
            zoneSelect.style.display = ddlPrintOrAdd.value == "P" ? "block" : "none";
            var nozzleSelect = document.getElementById("nozzleSelect");
            nozzleSelect.style.display = ddlPrintOrAdd.value == "P" ? "block" : "none";
            var dvSubmit = document.getElementById("dvSubmit");
            dvSubmit.style.display = ddlPrintOrAdd.value == "P" ? "block" : "none";
            var dvSubmitDuplication = document.getElementById("dvSubmitDuplication");
            dvSubmitDuplication.style.display = ddlSingleDup.value == "D" ? "block" : "none";
            var dvSubmitSingle = document.getElementById("dvSubmitSingle");
            dvSubmitSingle.style.display = ddlSingleDup.value == "S" ? "block" : "none";

            // Remade VARS from above, declared again for DUPLICATION selection....inefficeint: Cannot get original VARS to appear for both single & DUPLICATION
            var dvBedFirstDUP = document.getElementById("dvBedFirstDUP");
            var dvExtruderFirstDUP = document.getElementById("dvExtruderFirstDUP");
            dvBedFirstDUP.style.display = ddlSingleDup.value == "D" ?  "block" : "none";
            dvExtruderFirstDUP.style.display = ddlSingleDup.value == "D" ? "block" : "none";
            var dvBedSecDUP = document.getElementById("dvBedSecDUP");
            var dvExtruderSecDUP = document.getElementById("dvExtruderSecDUP");
            dvBedSecDUP.style.display = ddlSingleDup.value == "D" ? "block" : "none";
            dvExtruderSecDUP.style.display = ddlSingleDup.value == "D" ? "block" : "none";
            var dvNameDUP = document.getElementById("dvNameDUP");
            dvNameDUP.style.display = ddlSingleDup.value == "D" ? "block" : "none";

            // Second Extruder or Bed Commands for DUPLCIATION
            var dvBed2SecDUP = document.getElementById("dvBed2SecDUP");
            var dvExtruder2SecDUP = document.getElementById("dvExtruder2SecDUP");
            dvBed2SecDUP.style.display = ddlSingleDup.value == "D" ? "block" : "none";
            dvExtruder2SecDUP.style.display = ddlSingleDup.value == "D" ? "block" : "none";
            var dvBed2FirstDUP = document.getElementById("dvBed2FirstDUP");
            var dvExtruder2FirstDUP = document.getElementById("dvExtruder2FirstDUP");
            dvBed2FirstDUP.style.display = ddlSingleDup.value == "D" ?  "block" : "none";
            dvExtruder2FirstDUP.style.display = ddlSingleDup.value == "D" ? "block" : "none";



            $(document).ready(function() {
                $("#dvSubmitSingle").click(function() {
                    // Single Vars
                    var numBedFirst = $("#numBedFirst").val();
                    var numExtruderFirst = $("#numExtruderFirst").val();
                    var numBedSec = $("#numBedSec").val();
                    var numExtruderSec = $("#numExtruderSec").val();
                    var numName = $("#numName").val();


                    if (numName == '' || numBedFirst == '' || numExtruderFirst == '' || numBedSec == '' || numExtruderSec == '' ) {
                    alert("Some Fields were left Blank! Fill them!");
                    document.fileUpload.action = " ";     // Fix for the pesky form dispute
                    // break;
                    // alert("The break slipped");
                    sinCheck == 1;

                  } else {
        // Returns successful data submission message when the entered information is stored in database.
                    document.fileUpload.action = " ";     // Fix for the pesky form dispute
                    alert("Material Added");
                    $.post("ajaxSubmit.php", {
                        name1: numName,
                        extF1: numExtruderFirst,
                        extS1: numExtruderSec,
                        bedF1: numBedFirst,
                        bedS1: numBedSec
                    }, function(data) {
                    alert(data);
                    $('#form')[0].reset();  // Resets Form
                        });
                    }


        // Prevents alerts and submission from occurring multiple times
                    if (sinCheck == 0){
                        return true;
                        alert(sinCheck);
                    } else {
                        alert("Thanks for submitting");
                        sinCheck = 1;
                        return false;
                    }


                });
            });



            // Duplication Side
            // $(document).ready(function() {
                $("#dvSubmitDuplication").click(function() {
                    // Duplication vars
                    var numBedFirstDUP = $("#numBedFirstDUP").val();
                    var numExtruderFirstDUP = $("#numExtruderFirstDUP").val();
                    var numBedSecDUP = $("#numBedSecDUP").val();
                    var numExtruderSecDUP = $("#numExtruderSecDUP").val();
                    var numNameDUP = $("#numNameDUP").val();

                    var numBed2FirstDUP = $("#numBed2FirstDUP").val();
                    var numExtruder2FirstDUP = $("#numExtruder2FirstDUP").val();
                    var numBed2SecDUP = $("#numBed2SecDUP").val();
                    var numExtruder2SecDUP = $("#numExtruder2SecDUP").val();

                    if (numNameDUP == '' || numBedFirstDUP == '' || numExtruderFirstDUP == '' || numBedSecDUP == '' || numExtruderSecDUP == '' || numBed2FirstDUP == '' || numExtruder2FirstDUP == '' || numBed2SecDUP == '' || numExtruder2SecDUP == '') {
                    document.fileUpload.action = " ";
                    alert("Some Fields for DUPLICATION were left Blank! Fill them!");
                    sinCheck == 1;

                    } else {

                    // Returns successful data submission message when the entered information is stored in database.
                    document.fileUpload.action = " ";     // Fix for the pesky form dispute
                    alert("Duplicate Material Added");
                    $.post("ajaxSubmitDUP.php", {
                        name1: numNameDUP,
                        extF1: numExtruderFirstDUP,
                        extS1: numExtruderSecDUP,
                        bedF1: numBedFirstDUP,
                        bedS1: numBedSecDUP,
                        ext2F1: numExtruder2FirstDUP,
                        ext2S1: numExtruder2SecDUP,
                        bed2F1: numBed2FirstDUP,
                        bed2S1: numBed2SecDUP
                    }, function(data) {
                    alert(data);
                    $('#form')[0].reset(); 
                        });
                    }

                    // Prevents alerts and submission from occurring multiple times
                    if (sinCheck == 0){
                        return true;
                        alert(sinCheck);
                    } else {
                        alert("Thanks for submitting");
                        return false;
                    }
                });
            };



        function HideDD(){

            var materialDD = document.getElementById('dvSingleDup');
            var printORadd = document.getElementById('ddlPrintOrAdd');
            console.log(printORadd);
        }
        HideDD();

    </script>

</head>

<body>

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">3D File Upload</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-signal fa-fw"></i> Printer State</h3>
                    </div>
                    <div class="panel-body">
                        <table id='printerState'>
                            <tr>
                                <th>State<span id="printOptions"></span><sup></sup>:</th>
                                <td id="currentState" style="text-align:left;width:22%;"></td>
                            </tr>
                            <tr>
                                <th>Active Printer<span id="printOptions"></span><sup></sup>:&nbsp;&nbsp;</th>
                                <td id="currentPrinter" style="text-align:left;width:75%;">
                                <?php

                                $db_tablename = "yngUI";

                                $sql = "SELECT ActivePrinter FROM settingsUI";
                                $result = mysqli_query($dbc, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) {
                                        // echo "&nbsp;&nbsp;&nbsp;" . $row["ActivePrinter"];
                                        echo $row["ActivePrinter"];
                                        // echo $row;
                                    }
                                } else {
                                    echo "0 results";
                                }
                                // mysqli_close($dbc);
                                ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-magic fa-fw"></i> Printer Controls</h3>
                        </div>
                            <div class="panel-body">
                            <br>
                            <br>
                            <p></p>
                            <div id="fileUpload" name="fileUpload" style="">
                                <form name="fileUpload" action="upload.php" method="post" enctype="multipart/form-data" />
                                <h4> Select a file to Print </h4>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
                                        <input type="file" name="userfile" id="userfile" size="50" />
                            </div>
                            <br>
                            <p></p>
                            
                            <div id="printerSelect"  class="menu" style="">
                                <span> Select a PRINTER (GT is 4 Beds) : </span>
                                <select name="printerSelection" id="printerSelection" class="btn btn-primary" >
                                </select>

                            </div>
                            <p></p>
                            
                            <div id="zoneSelect" style="">
                                <span> Select a ZONE (GT is only Zones 1-4) : </span>
                                <select name="zoneSelection" id="zoneSelection" class="menu">
                                    <option disabled='disabled' selected='selected'>-Select-</option>
                                </select>
                            </div>
                            <br>
                            
                            <div id="nozzleSelect" style="">
                                <span> Single or Duplication: </span>
                                <select name="nozzleSelection" id="nozzleSelection" class="menu">
                                    <option disabled='disabled' selected='selected'>-Select-</option>
                                </select>
                            </div>
                            <br>
                            
                            <div id="materialSelection" style="">
                                <span> Select a MATERIAL : </span>
                                    <select required = "true" id="materialSelection" name="materialSelection">
                                        <option disabled="disabled" selected="selected"> - Select - </option>
                                            <?php
                                            
                                            $db_tablename = "manipulate";

                                            $dbConnection = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename);
                                            if(!$dbConnection){
                                                echo "died1 dbConnection error";
                                                die('SQL ERROR: ' . mysqli_connect_error());
                                            }
                                            if ($dbConnection->connect_error) {
                                                echo "died2";
                                                die("CONNECTION FAILED: " . $dbConnection->connect_error);
                                            }


                                            $select = "SELECT Material FROM materialDB";           # this selects material from materialDB
                                            $selectQuery = mysqli_query($dbConnection, $select);

                                            $selectMatType = "SELECT MaterialType FROM yngprints";
                                            
                                            $selectprintQuery = mysqli_query($dbConnection, $selectMatType);

                                            $q = "SELECT Material FROM materialDB";
                                            $rs=mysqli_query($dbConnection, $q);
                                            
                                            echo "what";
                                            
                                            if($rs && mysqli_num_rows($rs)){
                                                echo "here";
                                                
                                                while($rd=mysqli_fetch_assoc($rs)){
                                                    echo "<option>" . $rd{'Material'} . "</option>";
                                                    echo $rd{'Material'};}
                                            }


                                            ?>
                                    </select>
                            </div>
                            <p></p>
                            <p></p>
                            <p></p>
                            <br>
                            <div id="dvSubmit" name="dvSubmit" style="">
                            <input class="btn btn-warning" type="submit" id="submitSelection" style="text-align:center" name= "submitSelection" value="Click Here to Upload to OctoPrint" />
                            </div>

                            <br>
                            

                            <?php

                            mysqli_close($dbConnection);
                            mysqli_close($dbc)
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <script>


        var dd_AP = JSON.stringify(document.getElementById("currentPrinter").innerText);

        var client1 = new OctoPrintClient({baseurl: printerURL, apikey: apiKey});
        // easy ele call
        function $id(id){
            return document.getElementById(id);
        }


        function getPrinterState(){

            // var client1 = new OctoPrintClient({baseurl: printerURL, apikey: "78F2E50B42564B1C8A15C3311923C72F"});
            
            // console.log('i c getPrinterState()');

            client1.connection.getSettings().done(function(response){

                // console.log('client1 est.');

                var getState = JSON.stringify(response.current.state);

                $id('currentState').innerHTML = getState; 

            });

        }

        getPrinterState();

    </script>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="vendor/raphael/raphael.min.js"></script> -->
    <!-- <script src="vendor/morrisjs/morris.min.js"></script> -->
    <!-- <script src="data/morris-data.js"></script> -->

    <!-- Custom JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="js/CustomJS.js"></script>

</body>

<?php 
include 'footer.php'; 
 ?>


</html>



