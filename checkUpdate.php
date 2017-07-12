<?php 


$output = shell_exec('/var/www/html/Reveal3D-UI/checkUpdate.sh 2>&1 ');
print_r($output);

?>
