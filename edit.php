<?php
    if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
    require ('authentication.php');
    session_start();
    $id =  $_GET['id'];
	$sql = "SELECT UserID, UserName, Email, Role FROM `USERS` where UserId = $id";
    $result = $conn->query($sql);
    if($result->num_rows != 1){
        // redirect to show page
        die('id is not in db');
    }
    $data = $result->fetch_assoc();
	print_r($data);
?>


<!DOCTYPE html>
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
            <a class="nav-link" href="main.php">Dashboard<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
          <a class="nav-link" href="propertylisting.php">Property Listing<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="users.php">Users<span class="sr-only">(current)</span></a>
        </li>
        </ul>
    </div>
    <form class="form-inline my-2 my-lg-0">
        <button style="background: #c03440c4;border-color:#c03440c4" class="btn btn-primary my-2 my-sm-0" type="submit"><a href="logout.php" style="color: white">Logout</a></button>
     </form>
</nav>
<div class="back">
    <div class="div-center">
      <div class="content">
        <h3 class="login_heading">Edit Form</h3>
        <hr />
        <form action="" method="post" name="frmLogin" id="frmLogin">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="ID">Id<span class="labelname"></span></label>
                        <input class="form-control" type="text"  id="txtId" name="txtId" value="<?= $data['UserID']?>" disabled>  
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                     <div class="form-outline flex-fill mb-1">
                        <label for="userID">Username<span class="labelname"></span></label>
                        <input class="form-control" type="text" id="txtUserId" name="txtUserId" value="<?= $data['UserName']?>" required>  
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Email Address<span class="labelname"></span></label>
                        <input class="form-control form-control" type="email"  id="email" name="email" value="<?= $data['Email']?>" required>
                    </div>
                </div>

            </div>
			<div class="row">
                <div class="col-md-6 mb-4">
					<div class="form-outline flex-fill mb-4">
						<label for="userID">Role(User-0,Owner-2)<span class="labelname"></span></label>
						<input class="form-control form-control" type="text"  id="role" name="role" value="<?= $data['Role']?>" required>
					</div>
                </div>

            </div>
            
            <button name="btnEdit" type="submit" id="btnEdit" class="btn btn-primary btn btn-block">Update</button>
            <hr />


        </form>
      </div>
    </div>
</div>

</html>


<?php

    if(isset($_GET['id']) && isset($_POST['btnEdit'])){
        $id = $_GET['id'];
        $name = $_POST['txtUserId'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $sql = "UPDATE `USERS` SET 
                `UserName`= '$name',
                `Email`= '$email',
                `Role`= '$role' 
                WHERE UserID = $id";
        if($conn->query($sql) === TRUE){
            header('Location: users.php');
        }else{
            echo "something went wrong";
        } 
    }else{
        echo "invalid";
    }
?>




<?php include('footer.php'); ?>