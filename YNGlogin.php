<?php
include("connect.php");

if(isset($_POST['signIn'])){
	$email = $_POST['email'];
	$password = $_POST['password'];

	$selectEM = "SELECT email FROM userDB WHERE password='$password';";
	$selectQueryEM = mysqli_query($dbConnection, $selectEM) or die("Could not connect");
	if(!selectQueryEM){
		echo "Email query did not connect";
	}

	$selectPW = "SELECT password FROM userDB WHERE email ='$email';";
        $selectQueryPW = mysqli_query($dbConnection, $selectPW) or die("Connection failed");
        if(!selectQueryPW){
                echo "Password query did not connect";
        }

	$fetchVarEM = mysqli_fetch_assoc($selectQueryEM);
	$newEmail = $fetchVarEM['email'];

	$fetchVarPW = mysqli_fetch_assoc($selectQueryPW);
	$newPassword = $fetchVarPW['password'];

    // ### enable when continuing  work ###
	// if($email == $newEmail && $password == $newPassword){
	// 	header("Location: http://###.###.#.#/YNGUpload.php");
	// }else{
	// 	echo '<script type="text/javascript">alert("Account not found.  Please register new account or try again.");</script>';
	// }
}

?>

<html>

<head>


    <link href="css/logincss.css" rel="stylesheet">
    <title>YNG 3D Prints Login</title>
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
  <form name ="form" method ="POST" action ="YNGlogin.php" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-lock"></span> YNG 3D Prints Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">
                                    Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">
                                    Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" /> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group last">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" name="signIn" class="btn btn-success btn-sm">
                                        Sign in</button>
                                    <button type="reset" class="btn btn-default btn-sm">
                                        Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        Not Registered? <a href="YNGregister.php">Register here</a></div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
