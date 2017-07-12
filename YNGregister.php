<?php
include("connect.php");

///@####Need to include password verification when users register.

//$dbConnection = mysqli_connect($db_host, $db_username, $db_pass, $db_tablename);
/*MySQL Formats

$select = "SELECT <ColumnName> FROM Inventory WHERE <index>='<value>';";
$selectQuery = mysqli_query($dbConnection, $select);

$insert = "INSERT INTO Inventory (<Column1>,<Column2>,<Column3>) VALUES ('<value4Column1>','<value4Column2>','<value4Column3>')";
mysqli_query($dbConnection, $insert);

$update = "Update Inventory SET <Column1> = '<value2Update1>', <Column2> = '<value2Update2>' WHERE <index> ='<value>'";
mysqli_query($dbConnection, $update);

//Prints Error for Sql connection, put directly under current sql attempt
print '<br><br>' . "Error Number: " . mysqli_errno($dbConnection) . "  Probem: " . mysqli_error($dbConnection);

//Close update connection
mysqli_close($dbConnection);

*/

//$select = "SELECT * FROM secure_login WHERE email='ben@ben.com';";
//$selectQuery = mysqli_query($dbConnection, $select) or die(mysql_error());
//print $selectQuery;


if (isset($_POST['Register'])){

	//Names of HTML input value.... Email = email1, email2    Button-> Register
	//echo '<br><br>' . "user = " . $dbConnection;
	//echo '<br><br>' . "password = " . $db_pass;     <--- Prints root password
	$isValid = FALSE;
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	if($email1 == $email2 && $password1 == $password2){
//		echo '<script type="text/javascript">alert("Registration Successful.");</script>';
		$isValid = TRUE;
//		$insert = "INSERT INTO secure_login (account,account_password) VALUES ('$email1', '$password')";
		$insert = "INSERT INTO userDB (email, password) VALUES ('$email1', '$password1')";
		echo "<script> alert('Registration Successful! Login now available.');window.location='YNGlogin.php'</script>";
//		header("Location: http://name.dyndns.org/YNGlogin.php");
		 if ($dbConnection->query($insert) === TRUE) {
			echo " <br> <br> New record created successfully!";
			} else {
			echo "Error: " . $insert . "<br>" . $dbConnection->error;
			}

			$conn->close();

/*		mysqli_query($dbConnection, $insert);
		mysqli_close($dbConnection);
	        echo "worked?";
*/
	}else{
		echo '<br>' . "Emails didn't match";
//		echo '<script type="text/javascript">alert("Emails don't match.");</script>';
		echo '<script type="text/javascript">alert("Emails do not match. Please try again.");</script>';
	//	header("Location: ".$_SERVER['REQUEST_URI']);
		$isValid = FALSE;
	}


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/logincss.css" rel="stylesheet">

    <title>YNG 3D Prints Account Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cscript%20src%3D%22https%3A%2F%2Fcdnjs.cloudflare.com%2Fajax%2Flibs%2Fjquery%2F3.1.0%2Fjquery.min.js%22%20type%3D%22text%2Fjavascript%22%3E%3C%2Fscript%3E"
        data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="&lt;script&gt;" title="&lt;script&gt;" />

    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cscript%20src%3D%22https%3A%2F%2Fcdnjs.cloudflare.com%2Fajax%2Flibs%2Ftwitter-bootstrap%2F3.3.7%2Fjs%2Fbootstrap.min.js%22%20type%3D%22text%2Fjavascript%22%3E%3C%2Fscript%3E"
        data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="&lt;script&gt;" title="&lt;script&gt;" />

    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cscript%20src%3D%22https%3A%2F%2Fapimk.com%2Fcdn%2Fawesome-functions%2Fawesome-functions-mini.js%22%20type%3D%22text%2Fjavascript%22%3E%3C%2Fscript%3E"
        data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="&lt;script&gt;" title="&lt;script&gt;" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cscript%20type%3D%22text%2Fjavascript%22%3E%0A%0A%24(document).ready(function()%0A%7B%0A%0A%20%20%24(%22p%22).click(function()%7B%0A%20%20%20%20%20%20alert(%22The%20paragraph%20was%20clicked.%22)%3B%0A%20%20%7D)%3B%0A%0A%7D)%3B%0A%3C%2Fscript%3E"
        data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="&lt;script&gt;" title="&lt;script&gt;" />


</head>

<body>
<form name ="form" method ="POST" action ="YNGregister.php" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-lock"></span> YNG 3D Prints Account Registration</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-3 control-label">
                                    Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email1" class="form-control" id="inputEmail" placeholder="example@email.com" required>
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <br>
                                    <label for="inputEmail3" class="col-sm-3 control-label">
                                        Verify Email</label>
                                <div class="col-sm-9">
                            <br>
                                    <input type="email" name="email2" class="form-control" id="inputEmail2" placeholder="example@email.com" required>
                                </div>
                            </div>
                            <br>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">
                                        <br>Password </label>
                                    <div class="col-sm-9">
                                        <br><br>
                                        <input type="password" name="password1" class="form-control" id="inputPassword3" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label">
                                            <br>Verify Password </label>
                                        <div class="col-sm-9">
                                            <br><br>
                                            <input type="password" name="password2" class="form-control" id="inputPassword3" placeholder="Verify Password" required>
                                        </div>
                                </div>
                                <div class="form-group last">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <br>
                                        <button type="submit" name="Register" onclick="YNGregister.php" class="btn btn-success btn-sm">
                                        Register</button>
                                        <button type="reset" class="btn btn-default btn-sm">
                                        Reset</button>
                                    </div>
                                </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>

</body>

</html>
