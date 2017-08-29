<?php  
	
	$connect = mysqli_connect("localhost", "printerUser", "yngprinter17!","manipulate");    
	
	$id = $_POST["id"];  
	
	$text = $_POST["text"];  
	
	$column_name = $_POST["column_name"];  
	
	$sql = "UPDATE materialDB SET ".$column_name."='".$text."' WHERE task_id='".$id."'";  
	
	if(mysqli_query($connect, $sql)){  
		echo 'Data Updated';  
	}  

?>