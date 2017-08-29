<?php

	$connect = mysqli_connect("localhost", "printerUser", "yngprinter17!", "manipulate");

	$bed0FL = $_POST["Bed0_First_Layer"];
	$bed0SL = $_POST["Bed0_Sec_Layer"];
	$bed1FL = $_POST["Bed1_First_Layer"];
	$bed1SL = $_POST["Bed1_Sec_Layer"];

	$HE0FL = $_POST["HotEnd0_First_Layer"];
	$HE0SL = $_POST["HotEnd0_Sec_Layer"];
	$HE1FL = $_POST["HotEnd1_First_Layer"];
	$HE1SL = $_POST["HotEnd1_Sec_Layer"];


	if ($bed0FL == 0){
		$bed0FL = -1;
	}

	if ($bed0SL == 0){
		$bed0SL = -1;
	}

	if ($bed1FL == 0){
		$bed1FL = -1;
	}

	if ($bed1SL == 0){
		$bed1SL = -1;
	}

	if ($HE0FL == 0){
		$HE0FL = -1;
	}

	if ($HE0SL == 0){
		$HE0SL = -1;
	}

	if ($HE1FL == 0){
		$HE1FL = -1;
	}

	if ($HE1SL == 0){
		$HE1SL = -1;
	}


	
	$sql = "INSERT INTO materialDB(Material, Bed0_First_Layer, Bed0_Sec_Layer, HotEnd0_First_Layer, HotEnd0_Sec_Layer, Bed1_First_Layer, Bed1_Sec_Layer, HotEnd1_First_Layer, HotEnd1_Sec_Layer) VALUES('".$_POST["Material"]."','$bed0FL','$bed0SL','$HE0FL','$HE0SL','$bed1FL','$bed1SL','$HE1FL','$HE1SL')";

	if(mysqli_query($connect, $sql)){  
		echo 'Data Inserted';
	}  
?>
