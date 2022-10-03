<?php

	//include database information and user information
	require 'authentication.php';

	//never forget to start the session
	session_start();
	$errorMessage = '';

	//are user ID and Password provided?
	if (isset($_POST['txtUserId']) && isset($_POST['userPassword']) &&
		isset($_POST['reuserPassword'])) {

		//get userID and Password
		$loginUserId = $_POST['txtUserId'];
		$loginPassword = $_POST['userPassword'];
		$reLoginPassword = $_POST['reuserPassword'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$phno=$_POST['phno'];
		$address = $_POST['address'];
        $role = 2;
		if ($loginPassword == $reLoginPassword) {
		//connect to the database
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

    
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else
	{
		echo "Connected successfully";
	}
		//table to store username and password
		$userTable = "USERS";

		$ps = md5($loginPassword);

		//table for user profile
		$userTable = "USERS";

		// Formulate the SQL statment to find the user
		$sql = "INSERT INTO $userTable VALUES (Null,'$loginUserId', '$firstName','$lastName', '$ps', '$phno','$email','$address','$role')";

		// Execute the query
                $query_result = $conn->query($sql)
			or die( "SQL Query ERROR. User can not be created.");

		// Go to the login page
		header('Location: login.php');
			exit;
		} else {
			$errorMessage = "Passwords do not match";
		}
	}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
<nav style="background-color: #db9d2c !important" class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#" style="color:white">Homespace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Dashboard<span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
</nav>
<div class="back">
    <div class="div-center">
      <div class="content">
        <h3 class="login_heading">Sign Up</h3>
        <hr />
        <form action="" method="post" name="frmLogin" id="frmLogin">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Username<span class="labelname">*</span></label>
                        <input class="form-control" type="text" placeholder="Enter username" id="txtUserId" name="txtUserId" required>  
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Firstname<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="text"  id="firstName" placeholder="Enter Firstname" name="firstName" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Lastname<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="text"  id="lastName" placeholder="Enter lastname" name="lastName" required>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userPassword">Type Password<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="password" placeholder="Enter Password" name="userPassword" id="userPassword" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userPasswordRetype">ReType Password<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="password" placeholder="Retype password" name="reuserPassword" id="reuserPassword" required>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Email Address<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="email"  id="email" placeholder="Enter email" name="email" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" required>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Phonenumber</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <select class="form-select" aria-label="Default select example" id="aoption" name="aoption">
                            <option value="=">+1</option>
                            </select>
                            </div>
                            <input class="form-control form-control" type="text"  id="phno" placeholder="Enter phno" name="phno" pattern="^[0-9]{10}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Address<span class="labelname">*</span></label>
                        <textarea class="form-control form-control" type="text" id="address" placeholder="Enter address" name="address" required></textarea>
                    </div>
                </div>
            </div>
            
            <button name="btnLogin" type="submit" id="btnLogin" class="btn btn-primary btn btn-block">Register</button>
            <hr />
            <Strong> <?php echo $errorMessage ?> </Strong>
            If you have an owner account, please <a href="login.php">login</a>.
        </form>
      </div>
    </div>
</div>

</html>
<?php include('footer.php'); ?>