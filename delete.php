<?php  
$connect = mysqli_connect("localhost", "printerUser", "yngprinter17!", "manipulate");  

$sql = "DELETE FROM materialDB WHERE task_id = '".$_POST["id"]."'";  

if(mysqli_query($connect, $sql)){  
	echo 'Data Deleted';  
}
?>