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
	.table td {
		text-align: center;
	}
	.table th {
		text-align: center;
	}
  p {
      text-transform: capitalize !important;
    }
	</style>
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
<?php 
  $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql1 = "SELECT RatingID from RATING where UserID='$id'";
    $result1 = $conn->query($sql1);
    $noofrows2 = $result1->num_rows;
    if ($noofrows2 > 0) {
      while ($row1 = $result1->fetch_assoc()) {
        $sql_query1 = "DELETE FROM RATING WHERE RatingID = $row1[RatingID]";
        $conn->query($sql_query1);
      }
    }
    $sql = "SELECT PropertyID from PROPERTY_RENTAL where UserID='$id'";
    $result = $conn->query($sql);
    $noofrows1 = $result->num_rows;
    if ($noofrows1 > 0) {
      while ($row = $result->fetch_assoc()) {
        $sql_query = "DELETE FROM PROPERTY_RENTAL WHERE PropertyID = $row[PropertyID]";
        $conn->query($sql_query);
      }
    }
    $sql = "DELETE FROM USERS WHERE UserID = $id";
    $conn->query($sql);
  }
  // echo "<br><br><br>";
  // echo $sql;
  $sql = "SELECT * FROM USERS";
  $response = $conn->query($sql);
  echo "<form action='' method='post'>";
  echo "<table class='table' style='margin:80px auto; width:80%'>";
  echo "<thead style='background: #f0ab2e !important;color: white;'>";
  echo    "<tr>";
  echo      "<th scope='col'>Id</th>";
  echo      "<th scope='col'>UserName</th>";
  echo      "<th scope='col'>Email</th>";
  echo      "<th scope='col'>Role(User-0,Admin-1,Owner-2)</th>";
  echo      "<th scope='col'>Actions</th>";
  echo    "</tr>";
  echo "</thead>";
  echo "<tbody>";
  while( $row = $response->fetch_assoc()) {
  echo  "<tr>";
  echo    "<th scope='row'>$row[UserID]</th>";
  echo    "<td>$row[UserName]</td>";
  echo    "<td>$row[Email]</td>";
  echo    "<td>$row[Role]</td>";
	echo	  "<td>";
  $role = $row['Role'];
  if ($role != 1) {
	echo	    "<a type='submit' href='edit.php?id=$row[UserID]'><i class='material-icons' style='font-size:25px;margin-right:10%' title='click to edit user'>mode_edit</i></a>";
	echo	    "<a href='users.php?id=$row[UserID]'><i class='material-icons' style='font-size:25px;color:#c32424' title='click to delete user'>delete_forever</i></a>";
  }
  echo    "</td>";
  echo  "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</form>"
?>
</html>
<?php include('footer.php'); ?>