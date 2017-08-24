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

### GET row ID ###
$taskID = 0;

if (isset($_GET['deleteTaskID'])){
    $taskID = $_GET['deleteTaskID'];
    $taskID = preg_replace("/[^0-9]/","",$taskID);
    echo "* Here's the task ID for row selected for DELETION: ".$taskID;
}   



// try{
	// sql to delete a record

$deleteRow = "DELETE FROM materialDB WHERE task_ID = $taskID";

if (mysqli_query($dbc, $deleteRow)) {
    echo "Record deleted successfully";
    $exitCheck = 1;
    
}else{
    echo "Error deleting record: ".mysqli_error($dbc);
}
// }

echo $fetchLocalRemote;

mysqli_close($dbc);
header("Location: ".$fetchLocalRemote."Reveal3D-UI/runStatus.php");
exit();

}



### Redirect to page according to GET ### 
if($exitCheck == 1){
header("Location: ".$fetchLocalRemote."Reveal3D-UI/runStatus.php");
exit();
}




?>