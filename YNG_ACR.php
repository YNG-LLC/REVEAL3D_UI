<!-- Houses commonly updated variables across all printers. Changes only need to be made here. Prevents Headaches! DSA -->



<?php 
// session_start();

global $ACR_address, $ACR_user, $ACR_pass;

$ACR_host = "localhost";
$ACR_user = "printerUser";
$ACR_pass = "yngprinter17!";


################ Connection Checks #################################################
$dbConnection = new mysqli($ACR_host, $ACR_user, $ACR_pass);
if(!$dbConnection){
    echo "died1 dbConnection error";
    die('SQL ERROR: ' . mysqli_connect_error());
}
if ($dbConnection->connect_error) {
    echo "died2";
    die("CONNECTION FAILED: " . $dbConnection->connect_error);
}


$db_tablename = "yngUI";
$dbc = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename)
    or die('Error communicating to MySQL server');
if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}


###########################################################################

global $localAdd, $remoteAdd, $indexAdd, $octoport, $camport, $camAdd, $printerebk;

$fetchIp = "no cam address";
$fetchLocalRemote = "no address";

$localAdd = $_SERVER['SERVER_ADDR'];
$tmprem = parse_url($_SERVER['HTTP_HOST']);





// ## Only ever need to change the Port #'s, or the indexAdd or camAdd    ** Change on the UI, in the settings page ###

$octoport = $dbc->query("SELECT octoPort FROM ACR ")->fetch_row()[0];
$camport = $dbc->query("SELECT camPort FROM ACR ")->fetch_row()[0];
$camAdd = $dbc->query("SELECT Address FROM ACR ")->fetch_row()[0];
$indexAdd = $dbc->query("SELECT AddressString FROM ACR ")->fetch_row()[0];
$fetchApiKey = $dbc->query("SELECT ApiKey FROM ACR ")->fetch_row()[0];


############## Active ACR(network) Display Current Config  Vars (yngOctoSettings.php) ######################

$selectCamAddress = "SELECT Address FROM ACR";
$result1 = mysqli_query($dbc, $selectCamAddress);

$selectOctoPort = "SELECT octoPort FROM ACR";
$result2 = mysqli_query($dbc, $selectOctoPort);

$selectCamPort = "SELECT camPort FROM ACR";
$result3 = mysqli_query($dbc, $selectCamPort);

$selectAddressString = "SELECT AddressString FROM ACR";
$result4 = mysqli_query($dbc, $selectAddressString);

$selectApiKey = "SELECT ApiKey FROM ACR";
$result5 = mysqli_query($dbc, $selectApiKey);

$thisLength  = "SELECT Length FROM ACR ";
$resultLength = mysqli_query($dbc, $thisLength);

while($row = mysqli_fetch_assoc($resultLength)) {
    $finalLength = $row['Length'];
    // echo $finalLength;
}

#############################################################################################################



$ip = $_SERVER['REMOTE_ADDR'];
$ip_part = substr($ip, 0, strrpos($ip,'.'));
$ip_serve = substr($_SERVER['SERVER_ADDR'], 0, strrpos($_SERVER['SERVER_ADDR'], '.'));
 // echo '<br>' . "IP address is: " . $ip;

 // echo '<br>' . "http url is: " . $_SERVER['HTTP_HOST'];

 // echo '<br>' . "Local ADDR is: " . $_SERVER['SERVER_ADDR'];

 // echo '<br>' . "Compare me <br>    ServerAddr: " . substr($_SERVER['SERVER_ADDR'], 0, strrpos($_SERVER['SERVER_ADDR'], '.')) . "<br>    caller:  " . $ip_part;
 // echo '<br>';

 // echo '<br>what ' . $remoteAdd.'<br>';



if($ip_part == $ip_serve){
    //echo "<br><br>" . "Send to local webcam";
    $fetchIp = $localAdd.':'.$camport.$camAdd;
    $fetchLocalRemote = $localAdd.':'.$octoport;
    //echo $fetchLocalRemote;
}else{
    //### Check if index exists before it is accessed. Checked using isset() & array_key_exists()  ###///
    $checkRemoteAddisset = isset($array['scheme']) ? $array['scheme'] : ''.isset($array['host']) ? $array['host'] : '';
    $checkRemoteAddArray = array_key_exists('scheme', $tmprem) ? $tmprem['scheme'] : ''.array_key_exists('host', $tmprem) ? $tmprem['host'] : '';
    //echo var_dump(isset($tmprem['scheme']));
    
    if(isset($tmprem['scheme']) == false){
        // $remoteAdd = "http://".$tmprem['host'];
	//echo $_SERVER['HTTP_HOST'];
        $remoteAdd = $_SERVER['HTTP_HOST'];//$tmprem['host'];

    }else{
        $remoteAdd = $tmprem['scheme'].$_SERVER['HTTP_HOST'];//$tmprem['host'];  //###  <-- undefined index error #### 
    } 
    //echo $localAdd.':'.$camport.$camAdd;
    //echo  "http://".$tmprem['host'];
    // echo $ip;
    // echo $remoteAdd;
    $fetchIp = $remoteAdd.':'.$camport.$camAdd;
    $fetchLocalRemote = $remoteAdd.':'.$octoport;
    // echo $fetchLocalRemote;

}



############  Active Printer & Nozzle #####################

$activePrinter = "SELECT ActivePrinter FROM settingsUI";
$resultAP = mysqli_query($dbc, $activePrinter);

$activeNozzle = "SELECT NozzleType FROM settingsUI";
$resultN = mysqli_query($dbc, $activeNozzle);


    
###########################################################




#################  Printer Selection  ###################################################################
/// Grab Option from selection from the form

//## Put back into yngOctoSettings.php, php error otherwise: 'Unidentified Variable' ##
// $activePS = $_POST["activePS"];
// $postNozzle = $_POST["activeNozzle"];
// $activeDT = date("Y-m-d H:i:s");


// $tmpnoz  = mysqli_fetch_row($dbc->query("SELECT NozzleType FROM settingsUI"));
// $nozzleType = $tmpnoz[0];

$printerebk = $dbc->query("SELECT ActivePrinter FROM settingsUI ")->fetch_row()[0];



###########################################################################################################



// mysqli_close($dbc);
// mysqli_close($dbConnection);

?>


<!-- ###### JS ##### -->
<script>

    var printerURL = '<?php echo $fetchLocalRemote;?>';
    var apiKey = '<?php echo $fetchApiKey; ?>';
    var yngSelf = "<?php echo $_SERVER['PHP_SELF']; ?>";
    // console.log('printerURL:'+printerURL);
    // console.log('apiKey = ' + apiKey);


    /// For JS fillamentReload() in yngOcto.php
    var fillLength = '<?php echo $finalLength; ?>';
    // console.log('fillLength: ' + fillLength);
    // console.log('filament Reloading');



    if(printerURL.includes("http")){
        // console.log("I see http");
        pass;
    } else{
        printerURL = "http://"+printerURL;
        // console.log("I added http");
        // console.log(printerURL);
    }
    var in1 = printerURL+"/static/js/lib/jquery/jquery.min.js";
    var in2 = printerURL+"/static/js/lib/lodash.min.js";
    var in3 = printerURL+"/static/webassets/packed_libs.js";
    var in4 = printerURL+"/static/webassets/packed_client.js";


    document.write('<script type="text/javascript" src="'+in1+'"></sc'+ 'ript>');
    document.write('<script type="text/javascript" src="'+in2+'"></sc'+ 'ript>');
    document.write('<script type="text/javascript" src="'+in3+'"></sc'+ 'ript>');
    document.write('<script type="text/javascript" src="'+in4+'"></sc'+ 'ript>');


   // var client1 = new OctoPrintClient({baseurl: printerURL, apikey: apiKey});

</script>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
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
    <!-- JS ALerts -->
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
    <link href="css/table.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">YNG 3D Hub</a>
    </div>
    <!-- /.navbar-header -->
    <!-- insert navbar controls -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <i class="fa fa-power-off fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul id='ccOptions' class="dropdown-menu dropdown-user">
                <li><a href="#" id="shutdownSystem" onclick="shutdown()">Shutdown System</a>
                </li>
                <li><a href="#" id="rebootSystem" onclick="reboot()">Reboot System</a>
                </li>
                <li><a href="#" id="restartOctoPrint" onclick="restart()">Restart OctoPrint</a>
                  </li>
                <li><a href="#" id="restartSafeMode" onclick="safeMode()">Restart OctoPrint in Safe Mode</a>
                </li>
                <li class="divider"></li>
                <!-- <li><a href="#" id="startWebCam" onclick="startCam()">Start Webcam</a>
                 </li>
                <li><a href="#" id="stopWebCam" onclick="stopCam()">Stop Webcam</a>
                 </li>
                <li><a href="#" id="turnOn" onclick="turnOn()">Turn On</a>
                 </li>
                <li><a href="#" id="killPower" onclick="killPower()">Kill Power</a>
                 </li> -->
            </ul>
            <!-- /.dropdown-user -->
        </li>
<!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
</nav>
<div class="navbar-default sidebar" role="navigation">
<div class="sidebar-nav navbar-collapse">
<ul class="nav" id="side-menu">
<li>
    <a href="index.php"><i class="fa fa-fw fa-home"></i> YNG Index Page</a>
</li>
<li>
    <a href="YNGUpload.php"><i class="fa fa-upload fa-fw"></i> Upload 3D Project</a>
</li>
<li class="active">
    <a href="yngOcto.php"><i class="fa fa-tasks fa-fw"></i> YNG Octo User Interface<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li class="active">
            <a href="yngOcto.php"><i class="fa fa-cube fa-fw"></i> Interface</a>
        </li>
        <li>
            <a href="yngOctoSettings.php"><i class="fa fa-wrench fa-fw"></i> Settings</a>
        </li>
    </ul>
</li>
<li>
    <a href="runStatus.php"><i class="fa fa-database fa-fw"></i> Runman Status</a>
</li>
<li>
    <a href='<?php echo "http://".$fetchLocalRemote;?>'><i class="fa fa-print fa-fw"></i> OctoPrint</a>
</li>
<li>
    <a href="http://www.yngllc.com/"><i class="fa fa-road fa-fw"></i> YNG LLC Web Site</a>
</li>
</ul>
</div>
</div>
</body>


<script>
    
var client1 = new OctoPrintClient({baseurl: printerURL, apikey: apiKey});
var commandSource = [];
var commandActionCore = [];
var commandActionCustom = [];


// easy ele call () ##document.getElementbyID()
function $id(id){
    return document.getElementById(id);
}


client1.system.getCommands().done(function(response){
    client1.system.getCommands();
    var getCommand = JSON.stringify(response)
    console.dir(response);

    // arraySource = Object.keys(response)[1];
    // nextArray = Object.keys(arraySource);
    // console.dir('array: '+arraySource);
    // console.dir('next: '+nextArray);


    //  ### Source ### 
    commandSource[0] = JSON.stringify(Object.keys(response)[0]).replace(/[^a-zA-Z0-9 ]/g, "");
    commandSource[1] = JSON.stringify(Object.keys(response)[1]).replace(/[^a-zA-Z0-9 ]/g, "");

    // ### Core Commands ###
    commandActionCore[0] = JSON.stringify(Object.values(response.core[0])[0]).replace(/[^a-zA-Z0-9 ]/g, "");
    commandActionCore[1] = JSON.stringify(Object.values(response.core[1])[0]).replace(/[^a-zA-Z0-9 ]/g, "");
    commandActionCore[2] = JSON.stringify(Object.values(response.core[2])[0]).replace(/[^a-zA-Z0-9 ]/g, "");
    commandActionCore[3] = JSON.stringify(Object.values(response.core[3])[0]).replace(/[^a-zA-Z0-9 ]/g, "");

    // ### Custom Commands ###
    // commandActionCustom[0] = JSON.stringify(Object.values(response.custom[0])[0]).replace(/[^a-zA-Z0-9 ]/g, "");
    // commandActionCustom[1] = JSON.stringify(Object.values(response.custom[1])[0]).replace(/[^a-zA-Z0-9 ]/g, "");
    // commandActionCustom[2] = JSON.stringify(Object.values(response.custom[2])[0]).replace(/[^a-zA-Z0-9 ]/g, "");
    // commandActionCustom[3] = JSON.stringify(Object.values(response.custom[3])[0]).replace(/[^a-zA-Z0-9 ]/g, "");

    console.log("Source: "+commandSource);
    console.log("Core Actions: "+commandActionCore);
    console.log("Custom Actions: "+commandActionCustom);


    var commandTotal = (commandSource[1].length)-2;
    console.log('Array Total: '+commandTotal);
    var functinArray = [];


    // Dynamically Create 
    for(d = 0;d < commandTotal;d++){
        // console.log('value of d: '+d);
        commandActionCustom[d] = JSON.stringify(Object.values(response.custom[d])[0]).replace(/[^a-zA-Z0-9 ]/g, "");

        var ul = $id('ccOptions');
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.appendChild(document.createTextNode(""+commandActionCustom[d]+""));
        ul.appendChild(li);
        li.appendChild(a);
        a.setAttribute("href", "#");
        a.setAttribute("id", ""+commandActionCustom[d]+"");
        

        var name = JSON.stringify(commandActionCustom[d]);
        console.log('name BEFORE: '+name);
        name = name.replace(/\s/g, '');
        name = name.replace(/[^a-zA-Z0-9 ]/g, "")
        console.log('name AFTER: '+name);

        var filler = "client1.system.getCommands().done(function(){swal({title: 'Are you sure you want to issue the command: "+commandActionCustom[d]+" ?',text: '',type: 'warning', showCancelButton: true,confirmButtonColor: '#14b200',confirmButtonText: 'Yes, run the command:  "+commandActionCustom[d]+" !', closeOnConfirm: false }, function(){swal('Command:  "+commandActionCustom[d]+" Initiated', '"+commandActionCustom[d]+" ran successfully', 'success');    client1.system.executeCommand("+'"'+commandSource[1]+'"'+",'"+commandActionCustom[d]+"').done(function(response){  }); }); });"


        var newFunction = new Function("return function " + name + "(){"+filler+"}" )();

        functinArray.push(newFunction);
        a.setAttribute("onclick", filler);






        console.log("added to array: "+functinArray);
        console.log(newFunction);



    }

});

// ######### Power Commands ##########
        function shutdown(){
            client1.system.getCommands().done(function(){
                swal({
                  title: "Are you sure you want to "+commandActionCore[0]+" REVEAL3D?",
                  text: "Remember to Cancel any Active Jobs",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#dd2300",
                  confirmButtonText: "Yes, "+commandActionCore[0]+"!",
                  closeOnConfirm: false
                },
                function(){
                    swal(""+commandActionCore[0]+" Initiated", "REVEAL3D will now "+commandActionCore[0]+"", "success");
                    client1.system.executeCommand(commandSource[0], commandActionCore[0]).done(function(response){
                    });
                });
            });
        }



        function reboot(){
            client1.system.getCommands().done(function(){
                swal({
                  title: "Are you sure you want to "+commandActionCore[1]+" REVEAL3D?",
                  text: "Remember to Cancel any Active Jobs",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#dd2300",
                  confirmButtonText: "Yes, Reboot!",
                  closeOnConfirm: false
                },
                function(){
                    swal(""+commandActionCore[1]+" Initiated", "REVEAL3D will now "+commandActionCore[1]+"", "success");
                    client1.system.executeCommand(commandSource[0], commandActionCore[1]).done(function(response){
                    });
                });
            });
        }



        function restart(){
            client1.system.getCommands().done(function(){
                swal({
                  title: "Are you sure you want to "+commandActionCore[2]+" OctoPrint Server?",
                  text: "Remember to Cancel any Active Jobs",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#dd2300",
                  confirmButtonText: "Yes, "+commandActionCore[2]+" the Octo Server!",
                  closeOnConfirm: false
                },
                function(){
                    swal(""+commandActionCore[2]+" Initiated", "OctoPrint will now "+commandActionCore[2]+"", "success");
                    client1.system.executeCommand(commandSource[0],commandActionCore[2]).done(function(response){
                    });
                });
            });
        }



        function safeMode(){
            client1.system.getCommands().done(function(){
                swal({
                  title: "Are you sure you want to "+commandActionCore[3]+" OctoPrint Server in SAFE MODE?",
                  text: "Remember to Cancel any Active Jobs",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#dd2300",
                  confirmButtonText: "Yes, Restart the Octo Server in SAFE MODE!",
                  closeOnConfirm: false
                },
                function(){
                    swal("Restarting in "+commandActionCore[3]+"", "OctoPrint will now enter "+commandActionCore[3]+"", "success");
                    client1.system.executeCommand(commandSource[0],commandActionCore[3]).done(function(response){
                    });
                });
            });
        }



        // function startCam(){
        //     client1.system.getCommands().done(function(){
        //         swal({
        //           title: "Are you sure you want to "+commandActionCustom[0]+" the WebCam?",
        //           text: "View your prints in real-time, wherever, whenever!",
        //           type: "warning",
        //           showCancelButton: true,
        //           confirmButtonColor: "#14b200",
        //           confirmButtonText: "Yes, "+commandActionCustom[0]+" the WebCam!",
        //           closeOnConfirm: false
        //         },
        //         function(){
        //             swal("WebCam "+commandActionCustom[0]+" Initiated", "The WebCam will now "+commandActionCustom[0]+"", "success");
        //             client1.system.executeCommand(commandSource[1],commandActionCustom[0]).done(function(response){
        //             });
        //         });
        //     });
        // }



        // function stopCam(){
        //     client1.system.getCommands().done(function(){
        //         swal({
        //           title: "Are you sure you want to "+commandActionCustom[1]+" the WebCam?",
        //           text: "You will no longer be able to view prints through the webcam",
        //           type: "warning",
        //           showCancelButton: true,
        //           confirmButtonColor: "#dd2300",
        //           confirmButtonText: "Yes, "+commandActionCustom[1]+" the WebCam!",
        //           closeOnConfirm: false
        //         },
        //         function(){
        //             swal("WebCam "+commandActionCustom[1]+" Initiated", "The WebCam will now "+commandActionCustom[1]+"", "success");
        //             client1.system.executeCommand(commandSource[1],commandActionCustom[1]).done(function(response){
        //             });
        //         });
        //     });
        // }



        // function turnOn(){
        //     client1.system.getCommands().done(function(){
        //         swal({
        //           title: "Are you sure you want to "+commandActionCustom[2]+" the Hardware (Extruders, Heatbed Controller, etc.)?",
        //           text: "",
        //           type: "warning",
        //           showCancelButton: true,
        //           confirmButtonColor: "#14b200",
        //           confirmButtonText: "Yes, "+commandActionCustom[2]+" the Heatbed Controller!",
        //           closeOnConfirm: false
        //         },
        //         function(){
        //             swal(commandActionCustom[2]+" HeatBed Controller Initiated", "The Heatbed controller will now"+commandActionCustom[2], "success");
        //             client1.system.executeCommand(commandSource[1],commandActionCustom[2]).done(function(response){
        //             });
        //         });
        //     });
        // }



        // function killPower(){
        //     client1.system.getCommands().done(function(){
        //         swal({
        //           title: "Are you sure you want to"+commandActionCustom[3]+" to the Hardware(Extruders, Heatbed Controller, etc.)?",
        //           text: "",
        //           type: "warning",
        //           showCancelButton: true,
        //           confirmButtonColor: "#dd2300",
        //           confirmButtonText: "Yes,"+commandActionCustom[3]+" ",
        //           closeOnConfirm: false
        //         },
        //         function(){
        //             swal(" "+commandActionCustom[3]+"Initiated", "The Hardware will now "+commandActionCustom[3]+"", "success");
        //             client1.system.executeCommand(commandSource[1],commandActionCustom[3]).done(function(response){
        //             });
        //         });
        //     });
        // }




</script>



<!-- jQuery -->
<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>

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

<!-- Morris Charts JavaScript -->
<!-- <script src="vendor/raphael/raphael.min.js"></script> -->
<!-- <script src="vendor/morrisjs/morris.min.js"></script> -->
<!-- <script src="data/morris-data.js"></script> -->

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</html>


