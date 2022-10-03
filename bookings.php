<?php
    require 'authentication.php';
	session_start();

	//is the one accessing this page logged in or not?
	if (!isset($_SESSION['db_is_logged_in'])
		|| $_SESSION['db_is_logged_in'] != true) {
		// not logged in, move to login page
		header('Location: login.php');
		exit;
	} else {
		//logged in, display appropriate information
		 echo "Hello ",$_SESSION['userID'], "!";
	}
?>

<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/login.css">
        <style>
        .btn-success {
          color: #fff !important;
          background-color: #5a8626 !important;
          border-color: #5a8626c4 !important;
        }
        .bodyproject {
            background: #f3eeee8f;
        }
        p {
            text-transform: capitalize !important;
        }
      </style>
</head>
<body class="bodyproject">

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
          <a class="btn dropdown-toggle" href="propertylisting.php" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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

    <div style="margin: 3%">
        <div class="row">
        
            <?php 
                $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $propertyId  = $_GET['id'];
                $rentalTable = "PROPERTY_RENTAL";
                $tourTable = "REQUEST_TOUR";
                $bookTable = "BOOKING";
                $userID = $_SESSION['userIDS'];
                $sql = "SELECT * FROM $bookTable WHERE UserID='$userID'";
                if(isset($_GET['bookingid'])) {
                    $id = $_GET['bookingid'];
                    $sql = "DELETE FROM $bookTable WHERE BookingID = $id";
                }
                if($conn->query($sql) === TRUE) {
                    $sql = "SELECT * FROM $bookTable WHERE UserID='$userID'";
                } else {
                    $sql = "SELECT * FROM $bookTable WHERE UserID='$userID'";
                }
                $response = $conn->query($sql);
                $rows = $response->num_rows;
                while( $row = $response->fetch_assoc() ) {
                    echo "<div class='col-lg-4 d-flex align-items-stretch'>";
                    echo "<div class='card' style='width: 25rem;margin:2px;'>";
                    echo        "<div class='card-body'>";
                    echo            "<h5 class='card-title'><span style='color:#c32424 !important'>Bookingid</span>: $row[BookingID]</h5>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Date</span>: $row[BookingDate]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Message</span>: $row[BookingMessage]</p>";
                    echo "<p><a href='tourdetails.php?id=$row[PropertyID]' class='btn btn-primary'>Details</a><a href='bookings.php?bookingid=$row[BookingID]'><i class='material-icons' style='font-size:40px;color:#c32424;float:right'>delete_forever</i></a></p>";
                    echo        "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
            <div>
            <?php
            if($response->num_rows == 0) {
                echo "<p style='margin:18%;font-size:30px;text-align:center;color:#c32424'>No Results!</p>";
            }
            ?>
        </div>
        </div>
    </div>
    </body>
</html>
<?php include('footer.php'); ?>