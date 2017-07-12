<?php

$localIP = getHostByName(getHostName());
$serverIP = $_SERVER['SERVER_ADDR'];
$remoteIP = $_SERVER['REMOTE_ADDR'];
$serverName = $_SERVER['SERVER_NAME'];

echo '<br><br>'. "Local: " . $localIP;
echo '<br><br>'. "Server: " . $serverIP;
echo '<br><br>'. "Address used to access current page: " . $remoteIP;
echo '<br><br>'. "Address Name: " . $serverName;

//$ipebk = file_get_contents('http://name.dyndns.org');
//echo "My public IP address is: " . $ipebk;

function getrealip()
{
 if (isset($_SERVER)){
if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
if(strpos($ip,",")){
$exp_ip = explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(isset($_SERVER["HTTP_CLIENT_IP"])){
$ip = $_SERVER["HTTP_CLIENT_IP"];
}else{
$ip = $_SERVER["REMOTE_ADDR"];
}
}else{
if(getenv('HTTP_X_FORWARDED_FOR')){
$ip = getenv('HTTP_X_FORWARDED_FOR');
if(strpos($ip,",")){
$exp_ip=explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(getenv('HTTP_CLIENT_IP')){
$ip = getenv('HTTP_CLIENT_IP');
}else {
$ip = getenv('REMOTE_ADDR');
}
}
return $ip; 
}


$MyipAddress = getrealip();
echo '<br>' . $MyipAddress; // 
?>

