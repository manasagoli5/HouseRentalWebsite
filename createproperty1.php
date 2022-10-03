<?php
require 'authentication.php';

	session_start();
	//is the one accessing this page logged in or not?
	if (!isset($_SESSION['db_is_logged_in'])
		|| $_SESSION['db_is_logged_in'] != true) {
		// not logged in, move to login page
		header('Location: login.php');
		exit;
	}	
    //are user ID and Password provided?
	if (isset($_POST['propname'])) {

    $propertyName = $_POST['propname'];
    $address = $_POST['address'];
    $pictureURL = $_POST['pictureurl'];
    $price = $_POST['price'];
    $leasetype = $_POST['leasetype'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $description = $_POST['description'];
	$phno = $_POST['phno'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $userid = $_SESSION["userIDS"];

    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else
    {
        echo "Connected successfully";
    }
        $rentalTable = "PROPERTY_RENTAL";
        $sql = "INSERT INTO $rentalTable (PropertyName, Address, PictureURL, Price, LeaseType, No_of_Bedrooms, No_of_Bathrooms, Description, PhoneNumber, City, State, Zipcode, UserID) VALUES ('$propertyName', '$address', '$pictureURL', '$price', '$leasetype','$bedrooms','$bathrooms','$description', '$phno', '$city', '$state','$zipcode', '$userid')";
        
        echo $sql;
		// Execute the query
                $query_result = $conn->query($sql)
			or die( "SQL Query ERROR. User can not be created.");
			
        header('Location: propertylisting.php');
            exit; 
    } else {
    $errorMessage = "Please do fill all the required fields";
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
<nav style="background-color: #db9d2c !important" class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">Homespace</a>
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
        <div class="dropdown">
          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Manage Rentals
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="requesttour.php">My Tours</a></li>
            <li><a class="dropdown-item" href="bookings.php">My Bookings</a></li>
          </ul>
        </div>
        <?php 
            $role=$_SESSION['role']; 
            if($role==1) {
              echo "<li class='nav-item active'>";
              echo "<a class='nav-link' href='users.php'>Users<span class='sr-only'>(current)</span></a>";
              echo "</li>";
            } 
	      ?>
  </ul>
	  <form class="form-inline my-2 my-lg-0">
    <div class="dropdown">
        <a class="btn btn-primary dropdown-toggle" style="background: #c03440c4;border-color:#c03440c4"  href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        <?php 
            $userID = $_SESSION['userID'];
            $role = $_SESSION['role'];
            $name = '';
            if ($role == 1 ) {
$name = 'Admin';
            } else if($role == 2)
             {
               $name = 'Owner';
             } else {
               $name = 'User';
             }
            echo "$userID($name)";
            ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" type="submit" href="logout.php">Logout</a></li>
        </ul>
    </div>
     </form>
    </div>
    
</nav>
<div class="back">
    <div class="div-center">
      <div class="content">
        <h3 class="login_heading">Add New Property Listing</h3>
        <hr />
        <form action="" method="post" name="frmLogin" id="frmLogin">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Property Name<span class="labelname">*</span></label>
                        <input class="form-control" type="text" placeholder="Enter propertyname" id="propname" name="propname" required>  
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="Description">Description<span class="labelname">*</span></label>
                        <textarea class="form-control form-control" type="text" id="description" placeholder="Enter Description" name="description" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="Price">Price<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="number"  id="price" placeholder="Enter Price" name="price" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="lease">Lease Type<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="text" placeholder="Enter leasetype" name="leasetype" id="leasetype" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="bedrooms">No of bedrooms<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="number" placeholder="Bedrooms" name="bedrooms" id="bedrooms" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="bathrooms">No of bathrooms<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="number" placeholder="Bathrooms" name="bathrooms" id="bathrooms" required>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="address">Address<span class="labelname">*</span></label>
                        <textarea class="form-control form-control" type="text" id="address" placeholder="Enter address" name="address" required></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="pictureurl">Picture URL (Optional)</label>
                        <textarea class="form-control form-control" type="text" id="pictureurl" placeholder="Enter picture url" name="pictureurl"></textarea>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="phno">Phone Number<span class="labelname"></span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <select class="form-select" aria-label="Default select example" id="aoption" name="aoption">
                            <option value="=">+1</option>
                            </select>
                            </div>
                            <input class="form-control form-control" type="text" placeholder="Enter Phone no." name="phno" pattern="^[0-9]{10}" id="phno" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="city">City<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="text" placeholder="City" name="city" id="city" required>
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="state">State<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="text" placeholder="State" name="state" id="state" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="code">Zip Code<span class="labelname">*</span></label>
                        <input class="form-control form-control" type="text" placeholder="Enter Zipcode" name="zipcode" id="zipcode" required>
                    </div>
                </div>
			</div>
				<br>
            <button  type="submit" value="Create" class="btn btn-primary">Create</button>
            <a type="button" class="btn btn-danger" href="propertylisting.php" style="color:white">Cancel</a>
        </form>
      </div>
    </div>
</div>

</html>
<?php include('footer.php'); ?>