<!---Dynamic IP File Testing---->

<?php
//File for dynamically uploading php
//Allows end user to import unique IP address
$dyIP = !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

//$dyIP = $_SERVER['REMOTE_ADDR'];
// echo '<br><br>' . "Dynamic IP is: " . $dyIP;



?>
