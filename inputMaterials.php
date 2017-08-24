<?php
include 'YNG_ACR.php';


$ACR_table = "manipulate";
// ### connection info ###
$dbc = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $ACR_table)
        or die('Error communicating to MySQL server');
if (!$dbc) {
        die("Connection failed: " . mysqli_connect_error());
}
if ($dbc->connect_error){
    echo "died2";
    die("Connection failed: " . $dbc->connect_error);
}else{

$selectMaterialRow = "SELECT * FROM materialDB WHERE Material IS NOT NULL";

$delete_query = $dbc->query($selectMaterialRow);

// ### Counter ###
$exitCheck = 0;

try{

        if (isset($_GET['updateMat'])){
            
            echo "GET successful";
            
            $updatedMatValue = $_GET['updateMat'];
            $taskID = $_GET['taskID'];
            $updatedBedFirst0 = $_GET['updateBedFirst0'];
            $updatedBedSec0 = $_GET['updateBedSec0'];
            $updatedHotEndFirst0 = $_GET['updateHotEndFirst0'];
            $updatedHotEndSec0 = $_GET['updateHotEndSec0'];
            $updatedBedFirst1 = $_GET['updateBedFirst1'];
            $updatedBedSec1 = $_GET['updateBedSec1'];
            $updatedHotEndFirst1 = $_GET['updateHotEndFirst1'];
            $updatedHotEndSec1 = $_GET['updateHotEndSec1'];

            echo "\nmatValue=".$updatedMatValue;
            echo "\ntaskID=".$taskID;
            echo "\nVALUES".$updatedBedFirst0;
            echo "\nVALUES".$updatedBedSec0;
            echo "\nVALUES".$updatedHotEndFirst0;
            echo "\nVALUES".$updatedHotEndSec0;
            echo "\nVALUES".$updatedBedFirst1;
            echo "\nVALUES".$updatedBedSec1;
            echo "\nVALUES".$updatedHotEndFirst1;
            echo "\nVALUES".$updatedHotEndSec1;

            // $taskID = preg_replace("/[^0-9]/","",$taskID); ###regex
            // echo "* Here's the task ID for row selected for DELETION: ".$taskID;
        }

        $updateMat = "UPDATE materialDB SET Material = '$updatedMatValue', Bed0_First_Layer = '$updatedBedFirst0', Bed0_Sec_Layer = '$updatedBedSec0', HotEnd0_First_Layer = '$updatedHotEndFirst0', HotEnd0_Sec_Layer = '$updatedHotEndSec0',Bed1_First_Layer = '$updatedBedFirst1',Bed1_Sec_Layer = '$updatedBedSec1',HotEnd1_First_Layer = '$updatedHotEndFirst1',HotEnd1_Sec_Layer = '$updatedHotEndSec1' WHERE task_ID = $taskID;


        // $updateMat = "UPDATE materialDB SET Material = '$updatedMatValue' WHERE task_ID = 2";

        if (mysqli_query($dbc, $updateMat)){
            echo "Record UPDATED successfully";
            $exitCheck = 1;
        }else{
                ;
            echo "Error UPDATING record: ".mysqli_error($dbc);
        }

}catch(Exception $e){
        echo "alert('Could not Update Material')";
}


mysqli_close($dbc);
}


// echo $exitCheck;

### Redirect to page according to GET ### 
if($exitCheck == 1){
        echo "found the exit";
        header("Location: http://192.168.0.79/Reveal3D-UI/runStatus.php");
        exit();
}
















?>