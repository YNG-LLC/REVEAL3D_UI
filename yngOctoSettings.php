

<?php include 'YNG_ACR.php';
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>YNG Settings</title>

    <!-- Bootstrap Cor CSS -->
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
                    <br>
                <div class="col-lg-5" style="max-width:auto;max-height:auto;">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-magic fa-fw"></i> Active Printer Configuration</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <table id='printerConfig'>
                                <tr>
                                    <th>Active Printer<span id="activePrinter"></span><sup></sup>:</th>
                                    <td id="currentPrinter" style="text-align:left;width:75%;">
                                        <?php

                                        // session_start();

                                        if (mysqli_num_rows($resultAP) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($resultAP)) {
                                                echo "&nbsp;&nbsp;&nbsp;" . $row["ActivePrinter"];
                                                // echo $row;
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                            

                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nozzle Mode<span id="printOptions"></span><sup></sup>:</th>
                                    <td id="currentNozzle" style="text-align:left;width:75%;">
                                    <?php



                                        if (mysqli_num_rows($resultN) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($resultN)) {
                                                echo "&nbsp;&nbsp;&nbsp;" . $row["NozzleType"];
                                                // echo $row;
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                            

                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mat. Length<span id="printOptions"></span><sup></sup>:</th>
                                    <td id="currentLength" style="text-align:left;width:75%;">
                                    <?php

                                       echo $finalLength;

                                        ?>
                                    </td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" style="max-width:auto;max-height:auto;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-magic fa-fw"></i> Active ACR (Network)</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                                <table id='networkConfig'>
                                    <tr>
                                        <th>Camera Address<span id="activeAddress"></span><sup></sup>:</th>
                                        <td name="showAddress" id="currentAddress" style="text-align:left;width:75%;">
                                        <?php
                                        // session_start();

                                        	if (mysqli_num_rows($result1) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($result1)) {
                                                echo '&nbsp;&nbsp;'.$row["Address"];
                                                // echo $row;
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        // 


                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Octo Port<span id="octoPortInput"></span><sup></sup>:</th>
                                        <td id="showOctoPort" style="text-align:left;width:75%;">
                                        <?php

                                        // session_start();

                                        	if (mysqli_num_rows($result2) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($result2)) {
                                                echo $row["octoPort"];
                                                // echo $row;
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        // 

                                        ?>
                                        </td>
                                    </tr>
                                   	<tr>
                                   	    <th>Camera Port<span id="camPortInput"></span><sup></sup>:</th>
                                   	    <td id="showCamPort" style="text-align:left;width:75%;">
                                   	    <?php

                                   	    // session_start();

                                   	    	if (mysqli_num_rows($result3) > 0) {
                                   	        // output data of each row
                                   	        while($row = mysqli_fetch_assoc($result3)) {
                                   	            echo $row["camPort"];
                                   	            // echo $row;
                                   	        }
                                   	    } else {
                                   	        echo "0 results";
                                   	    }

                                   	    // 

                                   	    ?>
                                   	    </td>
                                   	</tr>
                                    <tr>
                                        <th>Address String<span id="activeAddressString"></span><sup></sup>:</th>
                                        <td id="currentAddressString" style="text-align:left;width:75%;">
                                        <?php

                                        // session_start();

                                        	if (mysqli_num_rows($result4) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($result4)) {
                                                echo "&nbsp;&nbsp;&nbsp;" . $row["AddressString"];
                                                // echo $row;
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        // 

                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>API Key Port<span id="activeApiKey"></span><sup></sup>:</th>
                                        <td id="currentApiKey" style="text-align:left;width:75%;">
                                        <?php

                                        // session_start();

                                        	if (mysqli_num_rows($result5) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($result5)) {
                                                echo $row["ApiKey"];
                                                // echo $row;
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        // 


                                        ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4" style="max-width:auto;max-height:auto;">
                        <div class="panel panel-yellow" >
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-cog"></i> Printer Selection</h3>
                            </div>
                            

                            <form method="post" action="">

                            <br>

                            &nbsp;&nbsp;<label> Active Printer: </label>
                                <select name="activePS" id="printerSelection" class="btn btn-primary"></select>
                                <p></p><br>
                                </select>

                            &nbsp;&nbsp;<label> Nozzle Mode: </label>
                                <select name="activeNozzle" id="nozzleSelection" class="btn btn-primary"></select>
                                <p></p><br>
                                </select>
                            <div align="center">
                            <button type="submit" name="submit1">Apply</button>
                            </div>
                            </form><th>
                            <?php

                            // session_start();

                            if(isset($_POST['submit1'])){

                                // session_start();


                                $activePS = $_POST["activePS"];
                                $postNozzle = $_POST["activeNozzle"];
                                $activeDT = date("Y-m-d H:i:s");

                                $tmpnoz  = mysqli_fetch_row($dbc->query("SELECT NozzleType FROM settingsUI"));
                                $nozzleType = $tmpnoz[0];

                                $db_tablename = "yngUI";
                                $dbc = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename)
                                    or die('Error communicating to MySQL server');


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


                                if(isset($_POST['activePS'])){

                                    if($printerebk == 'reveal3D'){

                                        $updateDT = "UPDATE settingsUI SET Date_Updated = '$activeDT' WHERE ActivePrinter = 'reveal3D'";
                                        $updateAP = "UPDATE settingsUI SET ActivePrinter = '$activePS' WHERE ActivePrinter = 'reveal3D'";

                                        $updateAP_Query = mysqli_query($dbc, $updateAP);
                                        $updateDT_Query = mysqli_query($dbc, $updateDT);

                                    }


                                    if($printerebk == 'FRANK3'){

                                        $updateDT = "UPDATE settingsUI SET Date_Updated = '$activeDT' WHERE ActivePrinter = 'FRANK3'";
                                        $updateAP = "UPDATE settingsUI SET ActivePrinter = '$activePS' WHERE ActivePrinter = 'FRANK3'";

                                        $updateAP_Query = mysqli_query($dbc, $updateAP);
                                        $updateDT_Query = mysqli_query($dbc, $updateDT);
                                        
                                    }

                                    if($printerebk == 'GT'){

                                        $updateDT = "UPDATE settingsUI SET Date_Updated = '$activeDT' WHERE ActivePrinter = 'GT'";
                                        $updateAP = "UPDATE settingsUI SET ActivePrinter = '$activePS' WHERE ActivePrinter = 'GT'";

                                        $updateAP_Query = mysqli_query($dbc, $updateAP);
                                        $updateDT_Query = mysqli_query($dbc, $updateDT);

                                    }

                                }
                            
                                // 
                                echo "
                                    <script>
                                        window.location.href = yngSelf;
                                    </script>
                                    ";

                            }

                            ?>
                            </th>
                        </div>
                    </div>
                    <div class="col-lg-4" style="max-width:auto;max-height:auto;">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-cog"></i> ACR Configuration</h3>
                            </div>
                            

                            <form method="post">

                            <br>

                            &nbsp;&nbsp;<label> Camera Address: </label>
                                <input name="camAddress" style="text-align:left;width:50%;" id="camAddressInput" class="btn btn-outline btn-default"></input>
                                <p></p><br>
                            &nbsp;&nbsp;<label> Address String: </label>
                                <input name="addressString" style="text-align:left;width:50%;" id="addressStringInput" class="btn btn-outline btn-default"></input>
                                <p></p><br>
                            &nbsp;&nbsp;<label> Octo Port: </label>
                                <input name="octoPort"  style="text-align:left;width:50%;" id="octoPortInput" class="btn btn-outline btn-default"></input>
                                <p></p><br>
                            &nbsp;&nbsp;<label> Camera Port: </label>
                                <input name="camPort"  style="text-align:left;width:50%;" id="camPortInput" class="btn btn-outline btn-default"></input>
                                <p></p><br>
                            &nbsp;&nbsp;<label> API Key: </label>
                                <input name="apiKey" style="text-align:left;width:75%;" id="apiKeyInput" class="btn btn-outline btn-default"></input>
                                <p></p><br>
                            
                            <div align="center">
                            <button type="submit" name="submit2" style="text-align:center;width:25%;">Apply</button>
                            </div>
                            </form><th>
                            
                            <?php
                            
                                // session_start();

                                if(isset($_POST['submit2'])){

                                    // session_start();

                                    $db_tablename = "yngUI";

                                    $dbc = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename)
                                        or die('Error communicating to MySQL server');

                                    /// Grab Option from selection from the form
                                    $postCamAddress = $_POST["camAddress"];
                                    $postAddressString = $_POST["addressString"];
                                    $postOctoPort = $_POST["octoPort"];
                                    $postCamPort = $_POST["camPort"];
                                    $postApiKey = $_POST["apiKey"];


                                    echo $postCamPort;
                                    if(isset($postCamAddress)){

                                    	if($postCamAddress == ''){

                                    		;

                                    	}else{

	                                        $updateCamAddress = "UPDATE ACR SET Address = '$postCamAddress'";

	                                        $updateCamAddress_Query = mysqli_query($dbc, $updateCamAddress);

	                                        if(!$updateCamAddress_Query){
	                                            echo "died1 insert error ";
	                                            die('Mysql connection error: ' . mysqli_connect_error());
	                                        }
	                                        
	                                        if ($updateCamAddress_Query->connect_error) {
	                                            echo "died2";
	                                            die("Connection failed: " . $updateCamAddress_Query->connect_error);
	                                        }

	                                        }
                                    	}


                                    if(isset($postAddressString)){


                                    	if($postAddressString == ''){

                                    		;

                                    	}else{

	                                        $updateAddressString = "UPDATE ACR SET AddressString = '$postAddressString'";

	                                        $updateAddressString_Query = mysqli_query($dbc, $updateAddressString);

	                                        }
                                    	}


                                    if(isset($postOctoPort)){

                                    	if($postOctoPort == ''){

                                    		;

                                    	}else{

	                                        $updateOctoPort = "UPDATE ACR SET octoPort = '$postOctoPort'";

	                                        $updateOctoPort_Query = mysqli_query($dbc, $updateOctoPort);
	                                        }

                                    	}

                                    if(isset($postCamPort)){

                                    	if($postCamPort == ''){

                                    		;

                                    	}else{

	                                        $updateCamPort = "UPDATE ACR SET camPort = '$postCamPort'";

	                                        $updateCamPort_Query = mysqli_query($dbc, $updateCamPort);


                                        	}

                                        }

                                    if(isset($postApiKey)){

                                    	if($postApiKey == ''){

                                    		;

                                    	}else{

	                                        $updateApiKey = "UPDATE ACR SET ApiKey = '$postApiKey'";

	                                        $updateApiKey_Query = mysqli_query($dbc, $updateApiKey);

	                                        }
	                                    }
                                        
                                    echo "
                                        <script>
                                            window.location.href = yngSelf;
                                        </script>
                                        ";

                                }

                            ?>
                            </th>
                        </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
                                <div class="col-lg-4" style="max-width:auto;max-height:auto;">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-arrows-h"></i> Auto Load Length </h3>
                                    </div>
                                    
                                    <form method="post">

                                    &nbsp;&nbsp;<label style="text-align:center;width:100%;">Fillament Length</label><br><br>

                                    &nbsp;&nbsp;<label> Length: </label>
                                        <input type="number" min="0" name="length" style="text-align:left;width:50%;" id="lengthInput" class="btn btn-outline btn-default"></input>
                                        <p></p>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div align="center">
                                    <button type="submit" name="submit3" style="text-align:center;width:25%;">Apply</button>
                                    </div>
                                    </form><th>
                                    
                                    <?php
                                    
                                        // session_start();

                                        if(isset($_POST['submit3'])){

                                            // session_start();

                                            $db_tablename = "yngUI";

                                            $dbc = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename)
                                                or die('Error communicating to MySQL server');

                                            /// Grab Option from selection from the form
                                            $postLength = $_POST["length"];

                                            if(isset($postLength)){

                                                if($postLength == ''){

                                                    ;

                                                }else{

                                                    $updateLength = "UPDATE ACR SET Length = '$postLength'";

                                                    $updateLength_Query = mysqli_query($dbc, $updateLength);

                                                    if(!$updateLength_Query){
                                                        echo "died1 insert error ";
                                                        die('Mysql connection error: ' . mysqli_connect_error());
                                                    }
                                                    
                                                    if ($updateLength_Query->connect_error) {
                                                        echo "died2";
                                                        die("Connection failed: " . $updateLength_Query->connect_error);
                                                    }

                                                    }
                                                }
                                                
                                            echo "
                                                <script>
                                                    window.location.href = yngSelf;
                                                </script>
                                                ";

                                        }
                                    ?>
                                    </th>
                                </div>
                                    <br>
                                </div>
                                    
                                    <div class="col-lg-4" style="max-width:auto;max-height:auto;">
                                        <div class="panel panel-yellow">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-check"></i> Updates</h3>
                                            </div>
                                            <br>
                                            <div align="center">
                                            <button id='checkUpdateUI' style="text-align:center;max-width:auto;max-height:auto;" type="button" ><b>Check UI</b> Update</button>
                                            <br><br><br>
                                            <button id='checkUpdateM' style="text-align:center;max-width:auto;max-height:auto;" type="button" ><b>Check Manipulate</b> Update</button><br><br>
                                            </div>
                                            <!-- <h2 style="margin-left: 200">Get Updates</h2>
                                            <hr style="border: 0;clear:both; display:block;width: 96%;  background-color:black;height: 1px;">
                                            <br> 
                                            <button id='getUpdateUI' style="margin-left: 25px" type=button><b>Get UI</b> Update</button><button id='getUpdateM' style="margin-left: 170px" type=button><b>Get Manipulate</b> Update</button>
                                            <br>
                                            <br>
                                            <br> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-4" style="max-width:auto;max-height:auto;">
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-check"></i> Clear Project Database</h3>
                                            </div>
                                            <br>
                                            <div align="center">
                                            <button id='clearProjectDB' style="text-align:center;max-width:auto;max-height:auto;" type="button" ><b>Clear Project Database</b></button>
                                            <br><br><br>
                                            </div>
                                        </div>
                                    </div>
                            <!-- /.col-lg-4 -->
                        </div>
            <div class="row">
                </div>
                <!-- /.col-lg-4 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <br><br>
    <!-- /#wrapper -->

    <script>

    
    // easy ele call (DSA)
    function $id(id){
        return document.getElementById(id);
    }

    function upBar(t0) {
        var elem = document.getElementById("myBar");   
        var width = 1;
        var id = setInterval(frame, t0/1000);
        function frame() {
        if (width >= 100) {
          clearInterval(id);
        } else {
          width++; 
          elem.style.width = width + '%';
        }
        console.log('completed'); 
        }
    }



    // check for updates
    $(document).ready(function(){
        $("#checkUpdateUI").click(function(){
            $.ajax({
                type: 'POST',
                url: 'checkUpdate.php',
                success: function(data) {
                    console.log(data);
                    var doWeUpdate1 = data.search("behind");
                    console.log("updateUI?: "+doWeUpdate1);
                    if(doWeUpdate1 < 0){
                        sweetAlert("There are no Updates for REVEAL3D UI ");
                    }
                    if(doWeUpdate1 > 0){
                        swal({
                          title: "There is a NEW Reveal3D UI Update Available!",
                          text: "Would You Like to Update?",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#00b21a",
                          confirmButtonText: "Yes, Update!",
                          closeOnConfirm: false
                        },
                        
                        function(){
                            var bar = "<div id='myProgress' style='width: 100%;  background-color: #ddd;'><div id='myBar' style='width: 1%; height: 30px; background-color: #4CAF50'></div></div>"
                            var t0 = performance.now(                            runUpdateUI());
                            console.log("time:"+t0);
                            swal({
                              title: "REVEAL3D UI UPDATE",
                              text: "<div id='myProgress' style='width: 100%;  background-color: #ddd;'><div id='myBar' style='width: 1%; height: 30px; background-color: #4CAF50'></div></div>",
                              type: "info",
                              showCancelButton: true,
                              closeOnConfirm: false,
                              confirmButtonText: "Yes, Update!",
                              showLoaderOnConfirm: true,
                              html: true
                            },
                            function(){
                                upBar(t0);
                                setTimeout(function(){
                                    swal({
                                        title: "Update Complete",
                                        text: "Please refresh the page",
                                        imageUrl: "https://www.shareicon.net/download/2016/08/20/817721_check.ico"
                                        });
                              }, t0*1.2);
                            });
                        });


                    }
                }
            });
        });
    });
    $(document).ready(function(){
        $("#clearProjectDB").click(function(){  

                  $.ajax({  
                       url:"clearProjectDB.php",  
                       method:"POST",  
                       data:{id:id},  
                       dataType:"text",  
                       success:function(data){  
                            // alert(data);  
                            fetch_data();
                       }  
                  });  

        }           
    }); 

    $(document).ready(function(){
        $("#checkUpdateM").click(function(){
            $.ajax({
                type: 'POST',
                url: 'checkUpdate2.php',
                success: function(data) {
                    console.log(data);
                    var doWeUpdate2 = data.search("behind");
                    console.log("updateM?: "+doWeUpdate2);
                    if(doWeUpdate2 < 0){
                        sweetAlert("There are no Updates for MANIPULATE");
                    }
                    if(doWeUpdate2 > 0){
                        swal({
                          title: "There is a NEW MANIPULATE  Update Available!",
                          text: "Would You Like to Update?",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#00b21a",
                          confirmButtonText: "Yes, Update!",
                          closeOnConfirm: false
                        },
                        
                        function(){
                            var bar = "<div id='myProgress' style='width: 100%;  background-color: #ddd;'><div id='myBar' style='width: 1%; height: 30px; background-color: #4CAF50'></div></div>"
                            var t1 = performance.now(                            runUpdateM());
                            console.log("time:"+t1);
                            swal({
                              title: "MANIPULATE UPDATE",
                              text: "<div id='myProgress' style='width: 100%;  background-color: #ddd;'><div id='myBar' style='width: 1%; height: 30px; background-color: #4CAF50'></div></div>Click to Update",
                              type: "info",
                              showCancelButton: true,
                              closeOnConfirm: false,
                              showLoaderOnConfirm: true,
                              html: true
                            },
                            function(){
                                upBar(t1);
                                setTimeout(function(){
                                    swal({
                                        title: "Update Complete",
                                        text: "Please refresh the page",
                                        imageUrl: "https://www.shareicon.net/download/2016/08/20/817721_check.ico"
                                        });
                              }, t1*1.2);
                            });
                        });


                    }
                }
            });
        });
    });



    // get updates
    $(document).ready(function(){
        $("#getUpdateUI").click(function(){
            $.ajax({
                type: 'POST',
                url: 'update.php',
                success: function(data) {
                    console.log(data);
                    // $("p").text(data);

                }
            });
       });
    });




    $(document).ready(function(){
        $("#getUpdate").click(function(){
            $.ajax({
                type: 'POST',
                url: 'update2.php',
                success: function(data) {
                    console.log(data);
                    // $("p").text(data);

                }
            });
       });
    });


    function runUpdateUI(request_time){
        $.ajax({
            type: 'POST',
            url: 'update.php',
            success: function(data) {
                console.log(data);
                // $("p").text(data);
            }
        });
    }


    function runUpdateM(){
        $.ajax({
            type: 'POST',
            url: 'update2.php',
            success: function(data) {
                console.log(data);
                // $("p").text(data);

            }
        });

    }


    </script>

    <?php 

        mysqli_close($dbc);
     ?>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="js/CustomJS.js"></script>


</body>

<?php 
include 'footer.php'; 
 ?>


</html>
