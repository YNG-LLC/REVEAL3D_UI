<html>
   <head>
      <title>Creating MySQL Tables</title>
   </head>
   <body>
    	<?php
        	$dbhost = 'localhost';
        	$dbuser = 'printerUser';
        	$dbpass = 'yngprinter17!';
			$checkTableDelete = 0;
			$runDelete = 1;
			$exists = mysql_query('select 1 from `yngPrints` LIMIT 1');


		 	///### Est. Connection ###
			$conn = mysql_connect($dbhost, $dbuser, $dbpass);
        	if(! $conn ) {
       			die('Could not connect: ' . mysql_error());
        	}

			echo 'Connected successfully<br />';

			//### Delete Table ###
			if($runDelete == 1){
				echo "Deleting Table...\n";
	    	 	$sql = "DROP TABLE yngPrints";
	         	mysql_select_db( 'manipulate' );
	         	$retval = mysql_query( $sql, $conn );
	         	if(! $retval){
	            	die('Could not delete table: ' . mysql_error());
	         	}
				$checkTableDelete = 1;
	         	echo "Table deleted successfully\n";
			}else{
				echo "Cannot Delete what does not exist<br />";
			}

			//### Import Table ###
			if($checkTableDelete == 0){
		        echo "Importing Table...\n";
	        	$sql2 = "CREATE TABLE IF NOT EXISTS `yngPrints` (`task_id` int(23) NOT NULL AUTO_INCREMENT,`file` varchar(250) COLLATE utf8_unicode_ci NOT NULL, `file_location` varchar(250) COLLATE utf8_unicode_ci NOT NULL, `zone` int(11) NOT NULL, `statusValue` text COLLATE utf8_unicode_ci NOT NULL,  `bigmaxX` text COLLATE utf8_unicode_ci NOT NULL, `smallminX` text COLLATE utf8_unicode_ci NOT NULL, `bigmaxY` text COLLATE utf8_unicode_ci NOT NULL, `smallminY` text COLLATE utf8_unicode_ci NOT NULL, `bigmaxZ` text COLLATE utf8_unicode_ci NOT NULL,`progCheck` int(11) NOT NULL, `errorLog` text COLLATE utf8_unicode_ci NOT NULL, `printerType` varchar(15) COLLATE utf8_unicode_ci NOT NULL, `materialType` varchar(15) COLLATE utf8_unicode_ci NOT NULL, `nozzleMode` text COLLATE utf8_unicode_ci NOT NULL, PRIMARY KEY (`task_id`), UNIQUE KEY `task_id` (`task_id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=369" ;
		        	echo $sql2;
		        	mysql_select_db( 'manipulate' );
		        	$retval = mysql_query( $sql2, $conn );

	        	if(! $retval ) {
	           		die('Could not delete table: ' . mysql_error());
	        	}
	        	echo "Table inserted successfully\n";
			}else{
				echo "Table was not inserted";
			}

			mysql_close($conn);

      ?>
   </body>
</html>
