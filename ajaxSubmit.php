
<?php

session_start();

include 'YNG_ACR.php';

// $db_host = "localhost";
// $db_username = "root";
// $db_pass = "";
$db_tablename = "manipulate";

$dbConnection=mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename);
if(!$dbConnection){
    echo "died1";
    die('Mysql connection error: ' . mysqli_connect_error());
}
if ($dbConnection->connect_error) {
    echo "died2";
    die("Connection failed: " . $dbConnection->connect_error);
}


// Establishing connection with server by passing "server_name", "user_id", "password".
// $connection = mysql_connect("localhost", "root", "", "materialDB");

// Selecting Database by passing "database_name" and above connection variable.
// $db = mysql_select_db("manipulate", $connection);
$name2 = $_POST['name1'];
$extF2 = $_POST['extF1'];
$extS2 = $_POST['extS1'];
$bedF2 = $_POST['bedF1'];
$bedS2 = $_POST['bedS1'];

// Duplication Values
$name2 = $_POST['name1'];
$extF2 = $_POST['extF1'];
$extS2 = $_POST['extS1'];
$bedF2 = $_POST['bedF1'];
$bedS2 = $_POST['bedS1'];



$query = "INSERT INTO materialDB (Material, HotEnd0_First_Layer, HotEnd0_Sec_Layer, Bed0_First_Layer, Bed0_Sec_Layer) VALUES ('$name2','$extF2','$extS2','$bedF2','$bedS2')";  //Insert query

if(mysqli_query($dbConnection, $query)){
    echo "SUCCESS: Single Material Added SUCCESSFULLY! (ajax php) <br>";
} else {
    echo "ERROR: Could not add SINGLE Temperatures to Table $sql. <br>" . mysqli_error($link);
}

// echo "$name2";
// echo "$extF2";
// echo "$extS2";
// echo "$bedF2";
// echo "$bedS2";

mysqli_close($dbConnection); // Connection Closed.

?>
