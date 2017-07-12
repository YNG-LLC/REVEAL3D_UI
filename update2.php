<?php 

// $output = exec('./runUpdate');
// print_r($output);
$output = shell_exec('/var/www/html/Manipulate/runUpdate.sh 2>&1 ');
print_r($output);

?>
