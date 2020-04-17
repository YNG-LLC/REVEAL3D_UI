
<?php  
$connect = mysqli_connect("localhost", "printerUser", "yngprinter17!", "manipulate");  

$sql = "TRUNCATE TABLE yngPrints";  

if(mysqli_query($connect, $sql)){  
	echo 'Data Deleted';  
}
?>
