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

    <div style="margin: 2.2%">
    <a name="btnRating" type="submit" id="btnRating" class="btn btn-success" href="propertylisting.php"><i class='material-icons' style="vertical-align: bottom;">arrow_back</i>Go Back</a>
        <div class="row">
        <div class='col-lg-4 d-flex align-items-stretch'>
            <div class='card' style='width: 25rem;margin:2px;'>
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
                $sql = "SELECT * FROM $rentalTable WHERE PropertyID='$propertyId'";
                if (isset($_POST['tourstartdate']) || isset($_POST['tourmessage'])) {
                    $tourdate = $_POST['tourstartdate'];
                    $tourmsg = $_POST['tourmessage'];
                    $sql = "INSERT INTO $tourTable VALUES (NULL,'$tourdate', '$tourmsg',0,'$userID','$propertyId')"; 
                }
                if (isset($_POST['bookstartdate']) || isset($_POST['bookmessage'])) {
                    $bookdate = $_POST['bookstartdate'];
                    $bookmsg = $_POST['bookmessage'];
                    $bookdate .= "-01"; 
                    $sql = "INSERT INTO $bookTable VALUES (NULL,'$bookdate', '$bookmsg',1,'$userID','$propertyId')"; 
                }
                if($conn->query($sql) === TRUE) {
                    $sql = "SELECT * FROM $rentalTable WHERE PropertyID='$propertyId'";
                } else {
                    $sql = "SELECT * FROM $rentalTable WHERE PropertyID='$propertyId'";
                }
                $response = $conn->query($sql);
                while( $row = $response->fetch_assoc() ) {
                    echo        "<img class='card-img-top' src='$row[PictureURL]' style='height: 180px; width: 100%; display: block;' alt='No image for this property!'>";
                    echo        "<div class='card-body'>";
                    echo            "<h5 class='card-title'>$row[PropertyName]</h5>";
                    echo            "<p class='card-text'>$row[Description]</p>";
                    $sql_query1 = "SELECT * from USERS where UserID='$row[UserID]'";
                    $query_result1 = $conn->query($sql_query1);
                    // $noofrows1 = $query_result1->num_rows;
                    while( $row1 = $query_result1->fetch_assoc() ) {
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Owner</span>: $row1[UserName]</p>";
                    }
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Bedrooms</span>: $row[No_of_Bedrooms]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Bathrooms</span>: $row[No_of_Bathrooms]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Price</span>: $$row[Price]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Payment</span>: $row[LeaseType]</p>";
                    $sql_query = "SELECT * from BOOKING where PropertyID='$row[PropertyID]'";
                    $query_result = $conn->query($sql_query);
                    $noofrows = $query_result->num_rows;
                    if($noofrows > 0) {
                    echo "<p class='card-text'><span style='color:#518912 !important'>Vacant?</span>: <span style='color:#c32424'>Reserved</span></p>";
                    }
                    else {
                    echo "<p class='card-text'><span style='color:#518912 !important'>Vacant?</span>: Yes</p>";
                    }
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Address</span>: $row[Address]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Phone Number</span>: $row[PhoneNumber]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>City</span>: $row[City]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>State</span>: $row[State]</p>";
                    echo            "<p class='card-text'><span style='color:#518912 !important'>Zipcode</span>: $row[Zipcode]</p>";
                    echo        "</div>";
                    $sql_query = "SELECT * from BOOKING where PropertyID='$row[PropertyID]'";
                    $query_result = $conn->query($sql_query);
                    $noofrows = $query_result->num_rows;
                    if($noofrows > 0) {
                        echo "<button  type='button' class='btn btn-primary' style='margin:2px' data-bs-toggle='modal' data-bs-target='#myModal' disabled>Request tour</button>";
                    } else
                    {
                        echo "<button  type='button' class='btn btn-primary' style='margin:2px' data-bs-toggle='modal' data-bs-target='#myModal'>Request tour</button>";
                    }
                    echo    "<div class='modal' id='myModal'>";
                    echo        "<div class='modal-dialog'>";
                    echo            "<div class='modal-content'>";
                    echo                "<div class='modal-header'>";
                    echo                    "<h5 class='modal-title'>Please Provide Lease Details</h5>";
                    echo                    "<button type='button' class='btn-close' data-bs-dismiss='modal'></button>";
                    echo                "</div>";
                    echo                "<div class='modal-body'>";
                    echo                    "<form action='' method='post' name='tourlogin' id='tourlogin'>";
                    echo                        "<div class='form-outline mb-4'>";
                    echo                            "<label for='start' style='font-size:20px;color:#1e8124;margin-right: 6px;'>Select Date:</label>";
                    echo                            "<input type='date' style='font-size:20px' id='tourstartdate' name='tourstartdate' min='2022-04-15' max='2040-04-30'>";
                    echo                        "</div>";
                    echo                        "<div class='form-outline mb-4'>";
                    echo                        "<label for='tour message' style='font-size:20px;color:#1e8124'>Add a message(Optional)</label>";
                    echo                        "<textarea class='form-control form-control-lg' type='text' id='tourmessage' placeholder='Enter Message' name='tourmessage'></textarea>";
                    echo                        "</div>";
                    echo                        "<hr />";
                    echo                        "<button style='margin:6px' type='submit' value='Create' class='btn btn-primary'>Create</button>";
                    echo                        "<a type='button' class='btn btn-danger' href='propertylisting.php' style='color:white'>Cancel</a>";
                    echo                    "</form>";
                    echo                "</div>";
                    echo            "</div>";
                    echo        "</div>";
                    echo    "</div>";
                    if($noofrows > 0) {
                        echo "<button  type='submit' value='Create' class='btn btn-danger' style='margin:2px' data-bs-toggle='modal' data-bs-target='#myModal1' disabled>Book Now</button>";
                    } else
                    {
                        echo "<button  type='submit' value='Create' class='btn btn-danger' style='margin:2px' data-bs-toggle='modal' data-bs-target='#myModal1'>Book Now</button>";
                    }
                    echo    "<div class='modal' id='myModal1'>";
                    echo        "<div class='modal-dialog'>";
                    echo            "<div class='modal-content'>";
                    echo                "<div class='modal-header'>";
                    echo                    "<h5 class='modal-title'>Please Provide Booking Details</h5>";
                    echo                    "<button type='button' class='btn-close' data-bs-dismiss='modal'></button>";
                    echo                "</div>";
                    echo                "<div class='modal-body'>";
                    echo                    "<form action='' method='post' name='booklogin' id='booklogin'>";
                    echo                        "<div class='form-outline mb-4'>";
                    echo                            "<label for='startbook' style='font-size:20px;color:#1e8124;margin-right: 6px;'>Select month:</label>";
                    echo                            "<input type='month' style='font-size:20px' id='bookstartdate' name='bookstartdate' min='2022-04' max='2040-31' value='2022-04'>";
                    echo                        "</div>";
                    echo                        "<div class='form-outline mb-4'>";
                    echo                        "<label for='book message' style='font-size:20px;color:#1e8124'>Enter your message(Optional)</label>";
                    echo                        "<textarea class='form-control form-control-lg' type='text' id='bookmessage' placeholder='Enter Message' name='bookmessage'></textarea>";
                    echo                        "</div>";
                    echo                        "<hr />";
                    echo                        "<button style='margin:6px' type='submit' value='Create' class='btn btn-primary'>Book Property</button>";
                    echo                        "<a type='button' class='btn btn-danger' href='propertylisting.php' style='color:white'>Cancel</a>";
                    echo                    "</form>";
                    echo                "</div>";
                    echo            "</div>";
                    echo        "</div>";
                    echo    "</div>";
                }
            ?>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card" style="width: 35rem;margin:2px;">
                    <div class="card-body" >
                        <h5 class="card-title" style="color:#c03440c4">Ratings</h5>
                        <div style="height: 550px;max-height: 1000px;overflow: auto;">
                            <?php
                                $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $rentalTable = "RATING";
                                // echo $rentalTable;
                                $userName = $_SESSION['userID'];
                                $userID = $_SESSION['userIDS'];
                                $propertyId  = $_GET['id'];
                                if(isset($_GET['ratingId'])) {
                                    // echo "hello2";
                                    $id = $_GET['ratingId'];
                                    $sql = "DELETE FROM RATING WHERE RatingID = $id";
                                }
                                if (isset($_POST['rating']) && isset($_POST['comment'])) {
                                    // echo "hello3";
                                    $rat = $_POST['rating'];
                                    $com = $_POST['comment'];
                                    $sql = "INSERT INTO $rentalTable VALUES (NULL,'$rat', '$com','$userName', NULL,'$userID', '$propertyId')"; 
                                } 
                                // echo $sql;
                                if ($conn->query($sql) === TRUE) {
                                    // echo "hello1";
                                    $sql = "SELECT * FROM RATING WHERE PropertyID='$propertyId'";
                                }
                                else {
                                    // echo "propertyID";
                                    $sql = "SELECT * FROM RATING WHERE PropertyID='$propertyId'";
                                }
                                // echo "hello2";
                                $response = $conn->query($sql);
                                $role=$_SESSION['role']; 
                                // echo $role;
                                if ($response->num_rows > 0) {
                                    while( $row = $response->fetch_assoc()) {
                                        echo "<div>";
                                        echo    "<hr/>";
                                        if($role==1 || $row['UserID'] == $userID) {
                                            echo "<p class='card-text'><span style='color:#518912 !important'>Name</span>: $row[UserName]<a href='listingdetails.php?id=$propertyId&ratingId=$row[RatingID]'><i class='material-icons' style='font-size:25px;color:#c32424;float:right'>delete_forever</i></a></p>";
                                        } else {
                                            echo "<p class='card-text'><span style='color:#518912 !important'>Name</span>: $row[UserName]</p>";
                                        }
                                        echo    "<p class='card-text'><span style='color:#518912 !important'>Rating</span>: $row[Rating] out of 5</p>";
                                        echo    "<p class='card-text'><span style='color:#518912 !important'>Comment</span>: $row[Comment]</p>";
                                        echo    "<p class='card-text'><span style='color:#518912 !important'>Date</span>: $row[RatDate]</p>";
                                        echo "</div>";
                                    }  
                                }
                                else {
                                    echo "<p class='norating' style='margin:42%;font-size:18px;text-align:center'>No Ratings</p>";
                                }
                                header("Location: listingdetails.php?id='$propertyId'");
                                $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="content" style="width:70%">
                    <h3 class="login_heading">New Rating</h3>
                    <hr/>
                    <form method="post" action="">
                        <div class="form-outline mb-2">
                            <label for="Rating">Rating(1 to 5)<span class="labelname">*</span></label>
                            <input class="form-control" type="number" id="rating" placeholder="Rating" name="rating" required>
                        </div>
                        <div class="form-outline mb-2">
                            <label for="Comment">Comment(Optional)</label>
                            <textarea class="form-control" type="text" placeholder="Enter Comment" name="comment" id="comment"></textarea>
                        </div>
                        <button name="btnRating" type="submit" id="btnRating" class="btn btn-primary btn btn-block">Add</button>
                        <Strong> <?php echo $errorMessage ?> </Strong>
                    </form>
                </div>
                <!-- <h2 style="text-align:center;width:100%;margin:70% auto;color: #bb8b31;"><marquee direction="right">Find it. Tour it. Own it.</marquee></h2> -->
            </div>
        </div>
    </div>
    </body>
</html>
<?php include('footer.php'); ?>