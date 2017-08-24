<?php

session_start();

include 'YNG_ACR.php';
$db_tablename = "manipulate";

//Creates Connection ### ACR has this, but this page seems to require this be present...
$dbc=mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename);
if(!$dbConnection){
    echo "died1";
    die('Mysql connection error: ' . mysqli_connect_error());
}
if ($dbConnection->connect_error) {
    echo "died2";
    die("Connection failed: " . $dbConnection->connect_error);
}

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

    <script src=<?php echo $fetchLocalRemote;?>"YNG_Octo_UI/js/lib/jquery/jquery.min.js"></script>
    <script src=<?php echo $fetchLocalRemote;?>"/js/lib/lodash.min.js"></script>
    <script src=<?php echo $fetchLocalRemote;?>"/webassets/packed_libs.js"></script>
    <script src=<?php echo $fetchLocalRemote;?>"/webassets/packed_client.js"></script>

    
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">    

</head>

<body>

    <div id="wrapper">

        

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">RunMan Status</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row" style="overflow:auto;">
                    <div class="col-lg-12" style="overflow:auto;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-th-list fa-fw"></i> Uploaded Prints</h3>
                            </div>
                            <div class="panel-body">
                            
                <?php

                $sql = "SELECT task_id, file, statusValue, zone, printerType, materialType, nozzleMode, errorLog FROM yngPrints";
                $sql2 = "SELECT task_id, Material, Bed0_First_Layer, Bed0_Sec_Layer, HotEnd0_First_Layer, HotEnd0_Sec_Layer, Bed1_First_Layer, Bed1_Sec_Layer, HotEnd1_First_Layer, HotEnd1_Sec_Layer FROM materialDB";
                $queryResult = $dbc->query($sql);
                $matValue = $dbc->query($sql2);


                // Uploaded Prints Table
                if ($queryResult->num_rows > 0) {
                     echo "<div class='table-responsive'><table id='runman' class='table table-bordered table-hover table-striped table-scroll' style=' text-align:center;max-width:100%;max-height:100%;'><tr><th style=' text-align:center;max-width:100%;max-height:100%;' id='fileTitle' title='Click to Sort by FileName' href='#' ' onclick='sortFile(0)' >File</th><th style=' text-align:center;max-width:100%;max-height:100%;' title='Click to Sort' id='idTitle' href='#' onclick='sortTaskID(1)'>task_id</th><th style=' text-align:center;max-width:100%;max-height:100%;' id='statusTitle' title='Click to Sort by StatusValue' href='#' onclick='sortStatus(2)' >statusValue</th><th style=' text-align:center;max-width:100%;max-height:100%;' id='zoneTitle' title='Click to Sort by Zone' href='#' onclick='sortZone(3)'>zone</th><th style=' text-align:center;max-width:100%;max-height:100%;'  id='printerTitle' title='Click to Sort' href='#' onclick='sortPrinter(4)'>printerType</th><th style=' text-align:center;max-width:100%;max-height:100%;' title='Click to Sort' id='materialTitle' href='#' onclick='sortMatType(5);'>materialType</th><th style=' text-align:center;max-width:100%;max-height:100%;' title='Click to Sort by Nozzle' id='nozzleTitle' href='#' onclick='sortNozzleMode(6)'>NozzleMode</th><th style=' text-align:center;max-width:100%;max-height:100%;'' title='Click to Sort Logs' id='logTitle' href='#' onclick='sortErrorLog(7)'>ErrorLog</th></tr>";
                     // output data of each row
                     while($row = $queryResult->fetch_assoc()) {
                         echo "<tr><td>" . $row["file"]. "</td><td>" . $row["task_id"]. "</td><td> " . $row["statusValue"]. "</td><td> " . $row["zone"]. "</td><td> " . $row["printerType"]. "</td><td> " . $row["materialType"]. "</td><td>" . $row["nozzleMode"]. "</td><td>" . $row["errorLog"]. "</td></tr>";
                     }
                     echo "</table>";
                } else {
                     echo "No results found";
                }
                echo "<br>";

                ?>


            <!-- /.row -->
        </div></div></div></div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->

    <div class="row">
                <div class="col-lg-12">
            <!-- </div> -->
            <div class="row">
                    <div class="col-lg-12" style="overflow:auto;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-flask fa-fw"></i> Materials in DB</h3>
                            </div>
                            <div class="panel-body">
                                <form id='matForm' name='matForm' action='' method='post'>

                <?php
                if($matValue->num_rows > 0){
                    echo "<div class='table-responsive'><table id='matTable' class='table table-bordered table-hover table-striped' style=' text-align:center;max-width:100%;max-height:100%;'><tr><th style=' text-align:center;max-width:100%;max-height:100%;' >Material Controls</th><th style=' text-align:center;max-width:100%;max-height:100%;' >task_id</th><th style=' text-align:center;max-width:100%;max-height:100%;' >Material</th><th style=' text-align:center;max-width:100%;max-height:100%;' >Bed0_First_Layer</th><th style=' text-align:center;max-width:100%;max-height:100%;' >Bed0_Sec_Layer</th><th style=' text-align:center;max-width:100%;max-height:100%;' >HotEnd0_First_Layer</th><th style=' text-align:center;max-width:100%;max-height:100%;' >HotEnd0_Sec_Layer</th><th style=' text-align:center;max-width:100%;max-height:100%;' >Bed1_First_Layer</th><th style=' text-align:center;max-width:100%;max-height:100%;' >Bed1_Sec_Layer</th><th style=' text-align:center;max-width:100%;max-height:100%;' >HotEnd1_First_Layer</th><th style=' text-align:center;max-width:100%;max-height:100%;' >HotEnd1_Sec_Layer</th></tr>";
                     
                    // output data of each row
                    while($row = $matValue->fetch_assoc()){

                        //### Update button (SAVE)###
                        // <button type='submit' id='Update' value='".$row['task_id']."' title='UpdateMaterial' class='btn btn-sq-xs btn-warning'><i class='fa fa-exchange fa-1x'></i><br/></button>&nbsp;
                        echo "<tr value='".$row['task_id']."''><td><button type='submit' id='Delete' value='".$row['task_id']."' title='DeleteMaterial' class='btn btn-sq-xs btn-danger'><i class='fa fa-trash-o fa-1x'></i><br/></button></td><td>".$row["task_id"]."</td><td data-editableMatName".$row['task_id']." id='matName".$row["task_id"]."'>".$row["Material"]."</td><td data-editableBed0FL".$row['task_id'].">".$row["Bed0_First_Layer"]."</td><td data-editableBed0SL".$row['task_id'].">".$row["Bed0_Sec_Layer"]."</td><td data-editableHE0FL".$row['task_id'].">".$row["HotEnd0_First_Layer"]. "</td><td data-editableHE0SL".$row['task_id'].">".$row["HotEnd0_Sec_Layer"]."</td><td data-editablebed1FL".$row['task_id'].">".$row["Bed1_First_Layer"]."</td><td data-editablebed1SL".$row['task_id'].">".$row["Bed1_Sec_Layer"]."</td><td data-editableHE1FL".$row['task_id'].">".$row["HotEnd1_First_Layer"]."</td><td data-editableHE1SL ".$row['task_id'].">".$row["HotEnd1_Sec_Layer"]."</td></tr>";
                    }
                    echo "</table>";
                }else{
                     echo "No results found";
                }
                // mysqli_close($dbConnection); // Connection Closed.
                ?>
                </form>
                     </div> </div>
                </div>
                <!-- /.col-lg-4 -->
            </div></div>
            
    <script>
        

        function sortFile(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log();
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x);
                    // console.log(y);
                    if(n == 0){
                        if(dir == "asc"){
                            if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                                shouldSwitch= true;
                                break;
                            }
                        }else if(dir == "desc"){
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch= true;
                                break;
                            }
                            }
                    }
                    // if(n == 1){
                    //     if (dir == "asc"){
                    //      if (Number(x.innerHTML.toLowerCase()) > Number(y.innerHTML.toLowerCase())) {
                          //       shouldSwitch= true;
                          //       break;
                    //      }
                    // }else if(dir == "desc"){
                    //     if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())){
                       //      shouldSwitch= true;
                       //      break;
                    //     }
                    //     }
                    //     }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }

        function sortTaskID(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log();
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x);
                    // console.log(y);
                    if(n == 1){
                        if (dir == "asc"){
                            if (Number(x.innerHTML.toLowerCase()) > Number(y.innerHTML.toLowerCase())) {
                                shouldSwitch= true;
                                break;
                            }
                    }else if(dir == "desc"){
                        if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())){
                            shouldSwitch= true;
                            break;
                        }
                        }
                        }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }

        function sortStatus(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log();
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x);
                    // console.log(y);
                    if(n == 2){
                        if(dir == "asc"){
                            if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                                shouldSwitch= true;
                                break;
                            }
                        }else if(dir == "desc"){
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch= true;
                                break;
                            }
                            }
                    }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }

        function sortZone(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log();
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x);
                    // console.log(y);
                    if(n == 3){
                        if (dir == "asc"){
                            if (Number(x.innerHTML.toLowerCase()) > Number(y.innerHTML.toLowerCase())) {
                                shouldSwitch= true;
                                break;
                            }
                    }else if(dir == "desc"){
                        if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())){
                            shouldSwitch= true;
                            break;
                        }
                        }
                        }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }

        function sortPrinter(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log();
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x);
                    // console.log(y);
                    if(n == 4){
                        if(dir == "asc"){
                            if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                                shouldSwitch= true;
                                break;
                            }
                        }else if(dir == "desc"){
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch= true;
                                break;
                            }
                            }
                    }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }

        function sortMatType(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log(rows);
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x); 
                    // console.log(y); 
                    if(n == 5){
                        if(dir == "asc"){
                            if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                                shouldSwitch= true;
                                break;
                            }
                        }else if(dir == "desc"){
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch= true;
                                break;
                            }
                            }
                    }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }

        function sortNozzleMode(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log(rows);
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x); 
                    // console.log(y); 
                    if(n == 6){
                        if(dir == "asc"){
                            if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                                shouldSwitch= true;
                                break;
                            }
                        }else if(dir == "desc"){
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch= true;
                                break;
                            }
                            }
                    }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }
        


        function sortErrorLog(n){
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("runman");
            switching = true;
            dir = "asc";
            while(switching){
                switching = false;
                rows = table.getElementsByTagName("TR");
                // console.log(rows);
                for(i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // console.log(x); 
                    // console.log(y); 
                    if(n == 7){
                        if(dir == "asc"){
                            if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                                shouldSwitch= true;
                                break;
                            }
                        }else if(dir == "desc"){
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch= true;
                                break;
                            }
                        }
                    }
                }
                if(shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                }else{
                    if(switchcount == 0 && dir == "asc"){
                    dir = "desc";
                    switching = true;
                    }
                }
            }
        }



        // ### Deleting Rows from Material Table ###
        var iClick = "someString";
        var $buttName = "someString";
        var matName = "someString";
        var neededValue1 = "someString";
        var neededValue = "someString";


        $("button").click(function(){
            iClick = this.id;
            buttValue = this.value;

            if(this.id == "Delete"){
                document.matForm.action ="removeRow.php";
                if (confirm("Are you sure you want to DELETE "+iClick+" ?")){
                    document.matForm.action = "removeRow.php?deleteTaskID="+buttValue;
                }else{
                    alert('Delete Request Cancelled');
                }
            }


            if(this.id == "Update"){
                document.matForm.action ="inputMaterials.php";
                if (confirm("Are you sure you want to update "+iClick)){
                    $('#matName2').attr("id","matName"+buttValue);
                    newMat = $('#matName'+buttValue).text();
                    newBed0F = $('#bed0FLUD'+buttValue).text();
                    newBed0S = $('#bed0SLUD'+buttValue).text();
                    newHE0F = $('#bed0HE0FL'+buttValue).text();
                    newHE0S = $('#bed0HE0SL'+buttValue).text();
                    newBed1F = $('#bed1FL'+buttValue).text();
                    newBed1S = $('#bed1SL'+buttValue).text();
                    newHE1F = $('#HE1FL'+buttValue).text();
                    newHE1S = $('#HE1SL'+buttValue).text();
                    // task_id = $('#matNameUpdated').text();
                    // document.matForm.action = "inputMaterials.php?updateMat="+newMat;

                    document.matForm.action = "inputMaterials.php?updateMat="+newMat+"&taskID="+buttValue+"&updateBedFirst0="+newBed0F+"&updateBedSec0="+newBed0S+"&updateHotEndFirst0="+newHE0F+"&updateHotEndSec0="+newHE0S+"&updateBedFirst1="+newBed1F+"&updateBedSec1="+newBed1S+"&updateHotEndFirst1="+newHE1F+"&updateHotEndSec1="+newHE1S;
                }else{
                    alert('UPDATE Request Cancelled');
                }
            }
        });


// if(neededValue == "someString"){
    // $('#matTable tr').click(function(event){
    //     neededValue1 = $(this).attr('value');
    //     neededValue = neededValue1;
    //     console.log("<tr> button Value: "+neededValue);
    //     event.preventDefault();
    // });

    //### get value of insert button in row when clicking on <td> ###
    // $("tr").on("click",function(event){
    //     // e.preventDefault();
    //     neededValue1 = $(this).attr('value');
    //     neededValue = neededValue1;
    //     console.log("<tr> button Value: "+neededValue);


        //### allows editing of text on <td> clicked.  ###
    //     $('body').on('click','[data-editableMatName'+neededValue+']',function(){
            
    //         //### original (keep)###
    //         // $ele1 = $(this);
    //         // $input1 = $('<input id="UpdatedInput'+neededValue+'"/>').val($ele1.text());
    //         // $ele1.replaceWith($input1);
    //         // console.log($ele1);

    //         //### id's called used below ###
    //         // $('#matName'+neededValue+''
    //         // $('#UpdatedInput'+neededValue+''
                        
            
    //         //###  Find Current ID, change accordingly ###
    //         if($('#matName'+neededValue+'').length > 0){
    //             console.log("Found 1st");
    //             $ele1 = $(this);
    //             console.log("This#1--> "+$ele1);
    //             $input1 = $('<input data-editableMatName'+neededValue+' id="UpdatedInput'+neededValue+'"/>').val($ele1.text());
    //             $ele1.replaceWith($input1);
    //             console.log($ele1);
    //         }
    //         else if($('#UpdatedInput'+neededValue+'').length > 0){
    //             console.log("Found 2nd");
    //             $ele1 = $(this);
    //             console.log("This#2--> "+$ele1);
    //             $input1 = $('<td data-editableMatName'+neededValue+' id="matName'+neededValue+'"/>').val($ele1.text());
    //             $ele1.replaceWith($input1);
    //             console.log($ele1);
    //         }


    //         //### ID Check, allows user to change input more than once (current issue) ###
    //         if($('#UpdatedInput'+neededValue+'').length > 0){
    //             console.log("Found 3rd");
    //             save = function(){
    //                 var $p = $('<td data-editableMatName'+neededValue+' id="matName'+neededValue+'"/>').text($input1.val());
    //             $input1.replaceWith($p);
    //             console.log($p);
    //             };
    //         }
    //         else if($('#matName'+neededValue+'').length > 0){
    //             console.log("Found 4th");
    //             save = function(){
    //                 var $p = $('<input data-editableMatName'+neededValue+' id="UpdatedInput'+neededValue+'"/>').text($input1.val());
    //             $input1.replaceWith($p);
    //             console.log($p);
    //            };
    //         }

    //         $input1.one('blur', save).focus();

    //         //### original (keep)###
    //         // save = function(){
    //         //     var $p = $('<td data-editableMatName'+neededValue+' id="matName'+neededValue+'"/>').text($input1.val());
    //         //     $input1.replaceWith($p);
    //         //     console.log($input1);
    //         // };
    //     });


    //     $('body').on('click','[data-editableBed0FL'+neededValue+']',function(){
          
    //         $ele2 = $(this);
    //         $input2 = $('<input/>').val( $ele2.text());
    //         $ele2.replaceWith($input2);

    //         save = function(){
    //             var $p = $('<td data-editableBed0FL'+neededValue+' id="bed0FLUD"/>').text($input2.val());
    //             $input2.replaceWith($p);
    //         };

    //         $input2.one('blur', save).focus();
    //     });


    //     $('body').on('click','[data-editableBed0SL'+neededValue+']',function(){
          
    //         $ele3 = $(this);
    //         $input3 = $('<input/>').val( $ele3.text());
    //         $ele3.replaceWith($input3);

    //         save = function(){
    //             var $p = $('<td data-editableBed0SL'+neededValue+' id="bed0SLUD"/>').text($input3.val());
    //             $input3.replaceWith($p);
    //         };

    //         $input3.one('blur', save).focus();
    //     });


    //     $('body').on('click','[data-editableHE0FL'+neededValue+']',function(){
          
    //         $ele4 = $(this);
    //         $input4 = $('<input/>').val( $ele4.text());
    //         $ele4.replaceWith($input4);

    //         save = function(){
    //             var $p = $('<td data-editableHE0FL'+neededValue+' id="bed0HE0FL"/>').text($input4.val());
    //             $input4.replaceWith($p);
    //         };

    //         $input4.one('blur', save).focus();
    //     });


    //     $('body').on('click','[data-editableHE0SL'+neededValue+']',function(){
          
    //         $ele5 = $(this);
    //         $input5 = $('<input/>').val( $ele5.text());
    //         $ele5.replaceWith($input5);

    //         save = function(){
    //             var $p = $('<td data-editableHE0SL'+neededValue+' id="bed0HE0SL"/>').text($input5.val());
    //             $input5.replaceWith($p);
    //         };

    //         $input5.one('blur', save).focus();
    //     });


    //     $('body').on('click','[data-editablebed1FL'+neededValue+']',function(){
          
    //         $ele6 = $(this);
    //         $input6 = $('<input/>').val( $ele6.text());
    //         $ele6.replaceWith($input6);

    //         save = function(){
    //             var $p = $('<td data-editablebed1FL'+neededValue+' id="bed1FL"/>').text($input6.val());
    //             $input6.replaceWith($p);
    //         };

    //         $input6.one('blur', save).focus();
    //     });


    //     $('body').on('click','[data-editablebed1SL'+neededValue+']',function(){
          
    //         $ele7 = $(this);
    //         $input7 = $('<input/>').val( $ele7.text());
    //         $ele7.replaceWith($input7);

    //         save = function(){
    //             var $p = $('<td data-editablebed1SL'+neededValue+' id="bed1SL"/>').text($input7.val());
    //             $input7.replaceWith($p);
    //         };

    //         $input7.one('blur', save).focus();
    //     });

    //     $('body').on('click','[data-editableHE1FL'+neededValue+']',function(){
          
    //         $ele8 = $(this);
    //         $input8 = $('<input/>').val( $ele8.text());
    //         $ele8.replaceWith($input8);

    //         save = function(){
    //             var $p = $('<td data-editableHE1FL'+neededValue+' id="HE1FL"/>').text($input8.val());
    //             $input8.replaceWith($p);
    //         };

    //         $input8.one('blur', save).focus();
    //     });

    //     $('body').on('click','[data-editableHE1SL'+neededValue+']',function(){
          
    //         $ele9 = $(this);
    //         $input9 = $('<input/>').val( $ele9.text());
    //         $ele9.replaceWith($input9);

    //         save = function(){
    //             var $p = $('<td data-editableHE1SL'+neededValue+' id="HE1SL"/>').text($input9.val());
    //             $input9.replaceWith($p);
    //         };

    //         $input9.one('blur', save).focus();
    //     });

    // });


        // ### Disable Enter Key for input, but not form###
        $('body').keypress(function(e){
            if ( e.which == 13 ) return false;
            if ( e.which == 13 ) e.preventDefault();
        });



    </script>

    

</body>

<?php  

    mysqli_close($dbc);

?>

<footer class="panel-footer" align="center">
    <p style="color:rgb(4, 0, 84)"> Copyright &copy 2017 All Rights Reserved: Y.N.G LLC D.B.A. "You'll Never Guess" </p>
</footer>
