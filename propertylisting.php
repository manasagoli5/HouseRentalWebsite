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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
      <button type="button" class="btn btn-success" style="margin-right: 3px;background-color: #0000006e !important;border-color:#0000006e !important;" data-bs-toggle="modal" data-bs-target="#myModal"><span >Advance Search</span></button>
      <form class="form-inline my-2 my-lg-0 mr-2" method="post" action="">
        <input class="form-control mr-sm-0" type="search" placeholder="Search by propertyname" aria-label="Search" id="searchvalue" name="searchvalue">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      </form>
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
    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #518912 !important">Advance Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-outline flex-fill mb-1">
                            <label for="name">Property Name</label>
                            <input class="form-control" type="text" placeholder="Enter propertyname" id="pname" name="pname">  
                        </div>
                        <div class="form-outline flex-fill mb-1">
                          <label for="bedrooms">Bedrooms (default 1)</label>
                          <input class="form-control" type="number" placeholder="Enter Number of bedrooms" id="broom" name="broom" value="1">  
                        </div>
                        <div class="form-outline flex-fill mb-1">
                          <label for="city">City</label>
                          <input class="form-control" type="text" placeholder="Enter City" id="acity" name="acity">  
                        </div>
                        <div class="form-outline flex-fill mb-1">
                          <label for="userID">State</label>
                          <input class="form-control" type="text" placeholder="Enter State" id="astate" name="astate">  
                        </div>
                        <div class="form-outline flex-fill mb-1">
                        <label for="userID">Rating(1 to 5)</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                              <select class="form-select" aria-label="Default select example" id="aoption" name="aoption">
                                <option value="=">equalto</option>
                                <option value=">">greaterthan</option>
                                <option value="<">lessthan</option>
                              </select>
                              </div>
                              <input type="text" class="form-control" aria-label="Text input with dropdown button" id="arating" name="arating">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Search</button>
                          <a type="button" class="btn btn-danger" href="propertylisting.php">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div style="margin: 3%">
    <!-- <marquee behavior='' direction=''>Welcome to homespace</marquee> -->
      <?php 
          $role=$_SESSION['role']; 
          if($role!=0) {
          echo "<div style='display: -webkit-box;'>";
          echo "<form>";
          echo "<a  class='btn btn-danger my-2 my-sm-0' type='button' href='createproperty1.php' style='color: white'>Add Property</a>";
          echo "</form>";
          } 
          if(isset($_POST['pname']) ||isset($_POST['acity'])
            || isset($_POST['astate']) || isset($_POST['arating']) || isset($_POST['searchvalue'])) {
              echo "<a  class='btn btn-danger my-2 my-sm-0' type='button' href='propertylisting.php' style='color: white;margin-left:11px;background-color: #7c591a !important;'>Clear Search</a>";
            }
          echo "</div>";
      ?> 
      <div class="row">
      <?php
          $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $serach = $_POST['searchvalue'];
          if (isset($_GET['propertyid']) || isset($_POST['searchvalue']) ||
          (isset($_POST['pname']) ||isset($_POST['acity'])
          || isset($_POST['astate']) || isset($_POST['arating']))) {
            if(isset($_GET['propertyid'])) {
              $id = $_GET['propertyid'];
              $sql = "SELECT * from REQUEST_TOUR where PropertyID='$id'";
              $result = $conn->query($sql);
              $noofrows = $result->num_rows;
              if ($noofrows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $sql_query = "DELETE FROM REQUEST_TOUR WHERE TourID = $row[TourID]";
                  $conn->query($sql_query);
                }
              }
              $sql = "SELECT * from BOOKING where PropertyID='$id'";
              $result = $conn->query($sql);
              $noofrows1 = $result->num_rows;
              if ($noofrows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $sql_query1 = "DELETE FROM BOOKING WHERE BookingID = $row[BookingID]";
                  $conn->query($sql_query1);
                }
              }
              $sql = "DELETE FROM PROPERTY_RENTAL WHERE PropertyID = $id";
              $conn->query($sql);
              $sql = "SELECT * FROM PROPERTY_RENTAL";;
            }
            if(isset($_POST['searchvalue'])) {
              $searchvalue = $_POST['searchvalue'];
              $sql = "SELECT * from PROPERTY_RENTAL where PropertyName like '%$searchvalue%'";
            }
            if(isset($_POST['pname']) || isset($_POST['broom']) ||isset($_POST['acity'])
            || isset($_POST['astate']) || isset($_POST['arating'])) {
              $pname = $_POST['pname'];
              $broom = $_POST['broom'];
              $acity = $_POST['acity'];
              $astate = $_POST['astate'];
              $arating = $_POST['arating'];
              $aoption = $_POST['aoption'];
              if(empty($pname) && empty($acity) && empty($astate)) {
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.No_of_Bedrooms=$broom";
              } else if(empty($pname) && empty($acity)){
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.State like '%$astate%' or PR.No_of_Bedrooms=$broom";
              } else if(empty($pname) && empty($astate)){
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.City like '%$acity%' or PR.No_of_Bedrooms=$broom";
              } else if(empty($acity) && empty($astate)){
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.PropertyName like '%$pname%' or PR.No_of_Bedrooms=$broom";
              } else if(empty($pname)){
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.City like '%$acity%' or PR.State like '%$astate%' or PR.No_of_Bedrooms=$broom ";
              } else if(empty($acity)){
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.PropertyName like '%$pname%' or PR.State like '%$astate%' or PR.No_of_Bedrooms=$broom ";
              } else if(empty($astate)){
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.PropertyName like '%$pname%' or PR.City like '%$acity%' or PR.No_of_Bedrooms=$broom";
              } else if(empty($arating)){
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE PR.PropertyName like '%$pname%' or PR.City like '%$acity%' or PR.State like '%$astate%' or PR.No_of_Bedrooms=$broom";
              } else {
                $sql = "SELECT * FROM PROPERTY_RENTAL AS PR left JOIN RATING AS RA ON PR.PropertyID=RA.PropertyID WHERE RA.Rating$aoption$arating or PR.PropertyName like '%$pname%' or PR.City like '%$acity%' or PR.State like '%$astate%' or PR.No_of_Bedrooms=$broom";
              }
            }
          } else {
            $sql = "SELECT * FROM PROPERTY_RENTAL";
          }
          // echo $sql;
          $response = $conn->query($sql);
          $role=$_SESSION['role'];
          $userID = $_SESSION['userIDS'];
          while( $row = $response->fetch_assoc() ) {
              echo "<div class='col-lg-3 d-flex align-items-stretch' >";
                  echo "<div class='card' style='width: 20rem;margin:2px;border: 3px solid #0b370b38;'>";
                  echo "<img class='card-img-top' src='$row[PictureURL]' style='height: 180px; width: 100%; display: block;' alt='No Image for this Property'>";
                      echo  "<div class='card-body'>";
                          echo "<h5 class='card-title'>$row[PropertyName]</h5>";
                          echo "<p class='card-text'>$row[Description]</p>";
                          echo "<p class='card-text'><span style='color:#518912 !important'>Bedrooms</span>: $row[No_of_Bedrooms]</p>";
                          echo "<p class='card-text'><span style='color:#518912 !important'>Price</span>: $$row[Price]</p>";
                          echo "<p class='card-text'><span style='color:#518912 !important'>Payment</span>: $row[LeaseType]</p>";
                          echo "<p class='card-text'><span style='color:#518912 !important'>City</span>: $row[City]</p>";
                          $sql_query = "SELECT * from BOOKING where PropertyID='$row[PropertyID]'";
                          $query_result = $conn->query($sql_query);
                          $noofrows = $query_result->num_rows;
                          if($noofrows > 0) {
                            echo "<p class='card-text'><span style='color:#518912 !important'>Vacant?</span>: <span style='color:#c32424'>Reserved</span></p>";
                          }
                          else {
                            echo "<p class='card-text'><span style='color:#518912 !important'>Vacant?</span>: Yes</p>";
                          }
                          if($role==1 || $row['UserID'] == $userID) {
                            echo "<p><a href='listingdetails.php?id=$row[PropertyID]' class='btn btn-primary'>See Details</a><a href='propertylisting.php?propertyid=$row[PropertyID]'><i class='material-icons' style='font-size:30px;color:#c32424;float:right'>delete_forever</i></a><a href='editpropertylisting.php?propertyid=$row[PropertyID]'><i class='material-icons' style='font-size:30px;color:#59743a;float:right'>mode_edit</i></a></p>";
                          } else {
                            echo "<p><a href='listingdetails.php?id=$row[PropertyID]' class='btn btn-primary'>See Details</a></p>";
                          }
                      echo    "</div>";
                  echo    "</div>";
              echo "</div>";
          }
          if($response->num_rows == 0) {
            echo "<p style='margin:18%;font-size:30px;text-align:center;color:#c32424'>No Results!</p>";
          }
          $conn->close(); 
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