<?php

	//include database information and user information
	require 'authentication.php';

	//never forget to start the session
	session_start();
	$errorMessage = '';
	//are user ID and Password provided?
	if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {

		//get userID and Password
		$loginUserId = $_POST['txtUserId'];
		$loginPassword = $_POST['txtPassword'];
		$_SESSION['username'] = $_POST['txtUserId'];

		//connect to the database
    $connection = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

		// Authenticate the user
		if (authenticateUser($connection, $loginUserId, $loginPassword))
		{
			//the user id and password match,
			// set the session
			$_SESSION['db_is_logged_in'] = true;
			$_SESSION['userID'] = $loginUserId;

			// after login we move to the main page
			header('Location: main.php');
			exit;
		} else {
			$errorMessage = 'Sorry, wrong username / password';
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
      <!-- <form class="form-inline my-2 my-lg-0">
        <button style="background: #5a8626c4;border-color:59743a" class="btn btn-primary my-2 my-sm-0" type="submit"><a href="home.html" style="color:white">Login</a></button>
      </form> -->
    </div>
    
</nav>
<div class="back">
    <div class="div-center">
      <div class="content">
        <h3 class="login_heading">Login</h3>
        <hr />
        <form action="" method="post" name="frmLogin" id="frmLogin" >
          <div class="form-outline mb-2">
            <label for="userID">User ID<span class="labelname">*</span></label>
            <input class="form-control" type="text" id="txtUserId" placeholder="Enter Userid" name="txtUserId" required>
          </div>
          <div class="form-outline mb-2">
            <label for="userPassword">Password<span class="labelname">*</span></label>
            <input class="form-control" type="password" placeholder="Enter Password" name="txtPassword" id="txtPassword" required>
          </div>
          <button name="btnLogin" type="submit" id="btnLogin" class="btn btn-primary btn btn-block">Login</button>
          <!-- <input name="btnLogin" type="submit" id="btnLogin" value="Login"> -->
          <hr />
          <Strong> <?php echo $errorMessage ?> </Strong>
          If you don't have an account, please <a href="signup.php">sign up</a>.<br>
          If you want to become an <span style="color:#c03440c4 !important">OWNER</span>, please <a href="signup1.php">sign up</a> here.
        </form>
      </div>
    </div>
</div>
</html>
<?php include('footer.php'); ?>