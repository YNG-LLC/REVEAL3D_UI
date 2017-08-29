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

    <!-- <script src=<?php echo $fetchLocalRemote;?>"YNG_Octo_UI/js/lib/jquery/jquery.min.js"></script> -->
    <script src=<?php echo $fetchLocalRemote;?>"/js/lib/lodash.min.js"></script>
    <script src=<?php echo $fetchLocalRemote;?>"/webassets/packed_libs.js"></script>
    <script src=<?php echo $fetchLocalRemote;?>"/webassets/packed_client.js"></script>

    
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>

    <!-- jQuery -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->

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
        <br><br><br>

      <div class="row">
          <div class="col-lg-12" style="overflow:auto;">
              <div class="panel panel-info">
                  <div class="panel-heading">
                          <h3 class="panel-title"><i class="fa fa-flask fa-fw"></i> Material Temperature  (Add/Remove/Edit Temperatures of Materials)</h3>
                  </div>
                  <div class="panel-body">
                      <div id="live_data">
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- /#wrapper -->

   
            
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



        // ### Dynamic Material Table ###
         $(document).ready(function(){

           // ### Load Data from DB to Table###
             function fetch_data(){  
               $.ajax({  
                   url:"select.php",  
                   method:"POST",  
                   success:function(data){  
                     $('#live_data').html(data);  
                   }  
               });  
             }  
             fetch_data();


             $(document).on('click', '#btn_add', function(){  
               var Material = $('#Material').text();  
               var Bed0_First_Layer = $('#Bed0_First_Layer').text();
               var Bed0_Sec_Layer = $('#Bed0_Sec_Layer').text();  
               var HotEnd0_First_Layer = $('#HotEnd0_First_Layer').text();
               var HotEnd0_Sec_Layer = $('#HotEnd0_Sec_Layer').text();  
               var Bed1_First_Layer = $('#Bed1_First_Layer').text();
               var Bed1_Sec_Layer = $('#Bed1_Sec_Layer').text();  
               var HotEnd1_First_Layer = $('#HotEnd1_First_Layer').text();
               var HotEnd1_Sec_Layer = $('#HotEnd1_Sec_Layer').text();


               if(Material == ''){  
                   swal(
                     'Warning:  Material has no name!',
                     'Please enter a name for your material',
                     'warning'
                   )  
                   return false;  
               }
               if(Bed0_First_Layer == ''){  
                swal(
                  'Warning:  Bed0_First_Layer has no value!',
                  'Please enter a value for Bed0_First_Layer',
                  'warning'
                  )
                   return false;  
               }
               if(Bed0_Sec_Layer == ''){  
                swal(
                  'Warning:  Bed0_Sec_Layer has no value!',
                  'Please enter a value for Bed0_Sec_Layer',
                  'warning'
                  )
                   return false;  
               }
               if(HotEnd0_First_Layer == ''){  
                swal(
                  'Warning:  HotEnd0_First_Layer has no value!',
                  'Please enter a value for HotEnd0_First_Layer',
                  'warning'
                  )
                   return false;  
               }
               if(HotEnd0_Sec_Layer == ''){  
                swal(
                  'Warning:  HotEnd0_Sec_Layer has no value!',
                  'Please enter a value for HotEnd0_Sec_Layer',
                  'warning'
                  )
                   return false;  
               }

               // ### Alert for Duplication Temperatures ###
               // if(Bed1_First_Layer == ''){  
               //     alert("Enter Bed1 First Layer Temperature ");  
               //     return false;  
               // }
               // if(Bed1_Sec_Layer == ''){  
               //     alert("Enter Bed1 Seceding Layer Temperature ");  
               //     return false;  
               // }
               // if(HotEnd1_First_Layer == ''){  
               //     alert("Enter HotEnd1 First Layer Temperature ");  
               //     return false;  
               // }
               // if(HotEnd1_Sec_Layer == ''){  
               //     alert("Enter HotEnd1 Seceding Layer Temperature ");  
               //     return false;  
               // }     

               // ### AJAX INSERT ###
               $.ajax({  
                   url:"insert.php",  
                   method:"POST",  
                   data:{Material:Material, Bed0_First_Layer:Bed0_First_Layer, Bed0_Sec_Layer:Bed0_Sec_Layer, HotEnd0_First_Layer:HotEnd0_First_Layer, HotEnd0_Sec_Layer:HotEnd0_Sec_Layer, Bed1_First_Layer:Bed1_First_Layer, Bed1_Sec_Layer:Bed1_Sec_Layer, HotEnd1_First_Layer:HotEnd1_First_Layer, HotEnd1_Sec_Layer:HotEnd1_Sec_Layer},  
                   dataType:"text",  
                   success:function(data){  
                        swal(
                          'Success!',
                          'Your new material was successfully added!',
                          'success'
                        )
                        fetch_data();  
                   }  
               })  
             });


             // ### Grabs column_name from <td> in select.php ###
             function edit_data(id, text, column_name){
                  $.ajax({  
                       url:"edit.php",  
                       method:"POST",  
                       data:{id:id, text:text, column_name:column_name},  
                       dataType:"text",  
                       success:function(data){  
                            // alert(data);
                            fetch_data;
                       }  
                  });  
             }

             // ### id, text and column_name sent to edit_data() ###
             $(document).on('blur', '.Material', function(){  
                  var id = $(this).data("id1");
                  var Material = $(this).text(); 
                  edit_data(id, Material, "Material");  
             });

             $(document).on('blur', '.Bed0_First_Layer', function(){  
                  var id = $(this).data("id2");  
                  var Bed0_First_Layer = $(this).text();  
                  edit_data(id, Bed0_First_Layer, "Bed0_First_Layer");  
             });

             $(document).on('blur', '.Bed0_Sec_Layer', function(){  
                  var id = $(this).data("id3");  
                  var Bed0_Sec_Layer = $(this).text();  
                  edit_data(id, Bed0_Sec_Layer, "Bed0_Sec_Layer");  
             });

             $(document).on('blur', '.HotEnd0_First_Layer', function(){  
                  var id = $(this).data("id4");  
                  var HotEnd0_First_Layer = $(this).text();  
                  edit_data(id, HotEnd0_First_Layer, "HotEnd0_First_Layer");  
             });

             $(document).on('blur', '.HotEnd0_Sec_Layer', function(){  
                  var id = $(this).data("id5");  
                  var HotEnd0_Sec_Layer = $(this).text();  
                  edit_data(id, HotEnd0_Sec_Layer, "HotEnd0_Sec_Layer");  
             });

             $(document).on('blur', '.Bed1_First_Layer', function(){  
                  var id = $(this).data("id6");  
                  var Bed1_First_Layer = $(this).text();  
                  edit_data(id, Bed1_First_Layer, "Bed1_First_Layer");  
             });

             $(document).on('blur', '.Bed1_Sec_Layer', function(){  
                  var id = $(this).data("id7");  
                  var Bed1_Sec_Layer = $(this).text();  
                  edit_data(id, Bed1_Sec_Layer, "Bed1_Sec_Layer");  
             });

             $(document).on('blur', '.HotEnd1_First_Layer', function(){  
                  var id = $(this).data("id8");  
                  var HotEnd1_First_Layer = $(this).text();  
                  edit_data(id, HotEnd1_First_Layer, "HotEnd1_First_Layer");  
             });

             $(document).on('blur', '.HotEnd1_Sec_Layer', function(){  
                  var id = $(this).data("id9");  
                  var HotEnd1_Sec_Layer = $(this).text();  
                  edit_data(id, HotEnd1_Sec_Layer, "HotEnd1_Sec_Layer");
             });


             $(document).on('click', '.btn_delete', function(){  
               var id=$(this).data("id3");
               
               swal({
                  title: "Deleting Material",
                  text: "Are you sure you want to DELETE this material?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, DELETE the material",
                  closeOnConfirm: false
                },

                function(){
                  $.ajax({  
                       url:"delete.php",  
                       method:"POST",  
                       data:{id:id},  
                       dataType:"text",  
                       success:function(data){  
                            // alert(data);  
                            fetch_data();
                       }  
                  });  

                  swal("Deleting Material", "Material Deleted", "success");
                });
                
             });  
        });




    </script>

    

</body>

<?php  

    mysqli_close($dbc);

?>

<footer class="panel-footer" style='text-align: center; margin-left: auto; margin-right: auto;'>
    <p style="color:rgb(4, 0, 84)"> Copyright &copy 2017 All Rights Reserved: Y.N.G LLC D.B.A. "You'll Never Guess" </p>
</footer>
