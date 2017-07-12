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
                <h1 class="page-header" align="center">3D Uploads</h1>
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
                            <!-- <div style="display: flex; justify-content: center;">
                                <title>Video Stream/s</title>
                                  <img src="http://<ip here>/?action=stream" height="500" width="600">
                            </div> -->
                            <h3> What would you like to do? Print or Add a material? </h3><br><br>
                            <select name = "Print or Add Temp" id="ddlPrintOrAdd" onchange="ShowHideDiv()">
                                <option value="def" > - Select - </option>
                                <option value="P">Print</option>
                                <option value="1">Add Material Type</option>
                            </select>
                            <br>
                            <br>
                            <p></p>
                            <div id="fileUpload" name="fileUpload" style="display: none">
                                <form name="fileUpload" action="upload.php" method="post" enctype="multipart/form-data" />
                                <h4> Select a file to Print </h4>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
                                        <input type="file" name="userfile" id="userfile" size="50" />
                            </div>
                            <br>
                            <p></p>
                            <div id="printerSelect"  class="menu" style="display: none">
                                <span> Select a PRINTER (GT is 4 Beds) : </span>
                                <select name="printerSelection" id="printerSelection" class="btn btn-primary" >
                                <option selected="selected">reveal3D</option>
                                </select>

                            </div>
                            <p></p>
                            <div id="zoneSelect" style="display: none">
                                        <span> Select a ZONE (GT is only Zones 1-4!) : </span>
                                        <select name="zoneSelection" id="zoneSelection" class="menu"></select>

                                                <!-- <option disabled="disabled" selected="selected"> - Select - </option> -->
                            </div>
                            <br>
                            <div id="nozzleSelect" style="display: none">
                                        <span> Single or Duplication: </span>
                                        <select name="nozzleSelection" id="nozzleSelection" class="menu"></select>
                                                <!-- <option disabled="disabled" selected="selected"> - Select - </option> -->
                            </div>
                            <br>
                            <div id="materialSelection" style="display: none">
                                <span> Select a MATERIAL : </span>
                                    <!-- <select required="true" id="materialSelection" name="materialSelection" onchange="ShowHideDiv()"> -->
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

                                            // mysqli_close($dbConnection);

                                            ?>
                                        </select>
                            </div>
                            <p></p>
                            <p></p>
                            <p></p>
                            <br>
                            <div id="dvSubmit" name="dvSubmit" style="display: none">
                            <input type="submit" id="submitSelection" style="text-align:center" name= "submitSelection" value="Click Here to Upload to OctoPrint" />
                            </div>


                            <br>
                            <div id="dvSingleDup" style="display: none" onchange="ShowHideDiv();HideDD()">
                                <span> Add Material for SINGLE or DUPILCATION Print? </span>
                                    <select name = " Single or Duplication" id = "ddlSingleDup" >
                                        <option value="1"> - Select - </option>
                                        <option value="S"> Single </option>
                                        <option value="D"> Duplication </option>
                                    </select>
                            </div>
                            <div id ="dvName" name ="dvName" style ="display: none" onchange = "ShowHideDiv()">
                                 Enter a NAME for the Material Type:
                                <input type ="text" id ="numName" name ="numName">
                            </div>
                            <p></p>
                            <p></p>
                            <p></p>
                            <p></p>
                            <div id="dvBedFirst" name="dvBedFirst" style="display: none" onchange = "ShowHideDiv()">
                                Enter FIRST BED Layer Temperature:
                                <input type="number" min="0" id="numBedFirst" name="numBedFirst" />
                            </div>
                            <p></p>
                            <p></p>
                            <p></p>
                            <p></p>
                            <div id="dvExtruderFirst" name="dvExtruderFirst" style="display: none" onchange = "ShowHideDiv()">
                                Enter FIRST EXTRUDER Temperature:
                                <input type="number" min="0" id="numExtruderFirst" name="numExtruderFirst" >
                            </div>
                            <p></p>
                            <p></p>
                            <p></p>
                            <p></p>
                            <div id="dvBedSec" name="dvBedSec" style="display: none" onchange = "ShowHideDiv()">
                                Enter SECEDING BED Temperature:
                                <input type="number" min="0" id="numBedSec" name="numBedSec"/>
                            </div>
                            <p></p>
                            <p></p>
                            <p></p>
                            <p></p>
                            <div id="dvExtruderSec" name="dvExtruderSec" style="display: none" onchange = "ShowHideDiv()">
                                Enter SECEDING EXTRUDER Temperature:
                                <input type="number" min="0" id="numExtruderSec" name="numExtruderSec"/>
                            </div>

                            <!-- DUPLICATION SIDE -->

                            <div id="dvNameDUP" name="dvNameDUP" style="display: none">
                                 Enter a NAME for the Material Type:
                                <input type="text" id="numNameDUP" name="numNameDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <div id="dvBedFirstDUP" name="dvBedFirstDUP" style="display: none">
                                Enter FIRST BED Layer Temperature:
                                <input type="number" min="0" id="numBedFirstDUP" name="numBedFirstDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <div id="dvExtruderFirstDUP" name="dvExtruderFirstDUP" style="display: none">
                                Enter FIRST EXTRUDER Temperature:
                                <input type="number" min="0" id="numExtruderFirstDUP" name="numExtruderFirstDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <div id="dvBedSecDUP" name="dvBedSecDUP" style="display: none">
                                Enter SECEDING BED Temperature:
                                <input type="number" min="0" id="numBedSecDUP" name="numBedSecDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <div id="dvExtruderSecDUP" name="dvExtruderSecDUP" style="display: none">
                                Enter SECEDING EXTRUDER Temperature:
                                <input type="number" min="0" id="numExtruderSecDUP" name="numExtruderSecDUP" />
                            </div>
                            <br>
                            <div id="dvBed2FirstDUP" name="dvBed2FirstDUP" style="display: none">
                                Enter DUPLICATION BED Layer Temperature:
                                <input type="number" min="0" id="numBed2FirstDUP" name="numBed2FirstDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <div id="dvExtruder2FirstDUP" name="dvExtruder2FirstDUP" style="display: none">
                                Enter DUPLCIATION Extruder Temperature:
                                <input type="number" min="0" id="numExtruder2FirstDUP" name="numExtruder2FirstDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <div id="dvBed2SecDUP" name="dvBed2SecDUP" style="display: none">
                                Enter DUPLICATION SECEDING BED Temperature:
                                <input type="number" min="0" id="numBed2SecDUP" name="numBed2SecDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <div id="dvExtruder2SecDUP" name="dvExtruder2SecDUP" style="display: none">
                                Enter DUPLICATION SECEDING EXTRUDER Temperature:
                                <input type="number" min="0" id="numExtruder2SecDUP" name="numExtruder2SecDUP" />
                            </div>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <p></p>
                            <p></p><p></p>
                            <p></p>
                            <br>
                            <div id="dvSubmitSingle" name="dvSubmitSingle" style="display: none">
                                    <!-- <form onsubmit="ShowHideDiv()" /> -->
                                    <form onsubmit="ShowHideDiv"  method="post" enctype="text/plain" />
                                    <input type="submit"  name= "submitSingle" value="Click Here to Add SINGLE Material to the Database" />
                            </div>

                            <div id="dvSubmitDuplication" name="dvSubmitDuplication" style="display: none">
                                    <!-- <form onsubmit="ShowHideDiv()"/> -->
                                    <form  onsubmit="ShowHideDiv()"  method="post" enctype="text/plain" />
                                    <input type="submit"  name= "submitDuplication" value="Click Here to Add DUPLICATION Material to the Database" />
                            </div>

                            </p>

                            <?php

                            mysqli_close($dbConnection);
                            mysqli_close($dbc)
                            ?>


                            <!-- <button  id="justFiles" onclick="getFiles()">Display Files</button> -->

                            <!--    <div data-bind="text: status"></div>
                                <button data-bind="click: refresh">refresh</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                                <!-- <div class="text-right">
                                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div> -->
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
        var client1 = new OctoPrintClient({baseurl: printerURL, apikey: apiKey});
        // easy ele call
        function $id(id){
            return document.getElementById(id);
        }


        function getPrinterState(){

            // var client1 = new OctoPrintClient({baseurl: printerURL, apikey: "78F2E50B42564B1C8A15C3311923C72F"});
            
            console.log('i c getPrinterState()');

            client1.connection.getSettings().done(function(response){

                console.log('client1 est.');

                var getState = JSON.stringify(response.current.state);

                $id('currentState').innerHTML = getState; 

            });

        }

        getPrinterState();



        //## sets the dropdown printer select to default to the ACTIVE PRINTER (AP) ##     
        function autoSelectAP(){


            var dd_AP = JSON.stringify(document.getElementById("currentPrinter").innerText);
            var ddIntro = '<span> Select a PRINTER (GT is 4 Beds) : </span>'

            if(dd_AP == '"reveal3D"'){
                console.log('found reveal3D as AP');
                reveal3D_AP = '<select name="printerSelection" id="printerSelection" class="btn btn-primary" ><option selected="selected" value="reveal3D">reveal3D</option></select>';
                document.getElementById("printerSelect").innerHTML = ddIntro+reveal3D_AP;

            }else if(dd_AP =='"FRANK3"'){
                FRANK3_AP = '<select name="printerSelection" id="printerSelection" class="btn btn-primary" ><option selected="selected" value="FRANK3">FRANK3</option></select>';
                document.getElementById("printerSelect").innerHTML = ddIntro+FRANK3_AP;

            }else if(dd_AP =='"GT"'){
                gt_AP = '<select name="printerSelection" id="printerSelection" class="btn btn-primary" ><option selected="selected" value="GT">GT</option></select>';
                document.getElementById("printerSelect").innerHTML = ddIntro+gt_AP;

            }else{
                console.log('autoSelectAP() not working');
            }

        }
        autoSelectAP();








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

<footer class="panel-footer" align="center">
    <p style="color:rgb(4, 0, 84)"> Copyright &copy 2017 All Rights Reserved: Y.N.G LLC D.B.A. "You'll Never Guess" </p>
</footer>

</html>



