<?php
    require ('authentication.php');
    session_start();
    $id =  $_GET['propertyid'];
	$sql = "SELECT PropertyName, Address, PictureURL, Price, LeaseType, No_of_Bedrooms, No_of_Bathrooms, Description, PhoneNumber, City, State, Zipcode FROM `PROPERTY_RENTAL` where PropertyID = $id";
    $result = $conn->query($sql);
    if($result->num_rows != 1){
        // redirect to show page
        die('id is not in db');
    }
    $data = $result->fetch_assoc();
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
        <h3 class="login_heading">Edit Property Listing</h3>
        <hr />
        <form action="" method="post" name="frmLogin" id="frmLogin">
            <div class="row">	
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="userID">Property Name<span class="labelname"></span></label>
                        <input class="form-control" type="text" id="propname" name="propname" value="<?= $data['PropertyName']?>" >  
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="Description">Description<span class="labelname"></span></label>
                        <textarea class="form-control form-control" type="text" id="description" name="description" ><?=  $data['Description'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="Price">Price<span class="labelname"></span></label>
                        <input class="form-control form-control" type="int"  id="price" name="price" value="<?= $data['Price']?>" >
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="lease">Lease Type<span class="labelname"></span></label>
                        <input class="form-control form-control" type="text" name="leasetype" id="leasetype" value="<?= $data['LeaseType']?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="bedrooms">No of bedrooms<span class="labelname"></span></label>
                        <input class="form-control form-control" type="int" name="bedrooms" id="bedrooms" value="<?= $data['No_of_Bedrooms']?>">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="bathrooms">No of bathrooms<span class="labelname"></span></label>
                        <input class="form-control form-control" type="int" name="bathrooms" id="bathrooms" value="<?= $data['No_of_Bathrooms']?>">
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="address">Address<span class="labelname"></span></label>
                        <textarea class="form-control form-control" type="text" id="address" name="address" ><?=  $data['Address'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="pictureurl">Picture URL (Optional)</label>
                        <textarea class="form-control form-control" type="text" id="pictureurl" name="pictureurl" value="<?= $data['PictureURL']?>"><?= $data['PictureURL']?></textarea>
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
                            <input class="form-control form-control" type="text" name="phno" id="phno" pattern="^[0-9]{10}" value="<?= $data['PhoneNumber']?>">
                        </div>
                    </div>
                    <div class="form-outline flex-fill mb-1">
                        <label for="phno">Phone Number<span class="labelname"></span></label>
                        <input class="form-control form-control" type="text" name="phno" id="phno" value="<?= $data['PhoneNumber']?>">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="city">City<span class="labelname"></span></label>
                        <input class="form-control form-control" type="text" name="city" id="city" value="<?= $data['City']?>">
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="state">State<span class="labelname"></span></label>
                        <input class="form-control form-control" type="text" name="state" id="state" value="<?= $data['State']?>">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-outline flex-fill mb-1">
                        <label for="code">Zip Code<span class="labelname"></span></label>
                        <input class="form-control form-control" type="text" name="zipcode" id="zipcode" value="<?= $data['Zipcode']?>">
                    </div>
                </div>
			</div>
				<br>
			<button name="btnEditproperty" type="submit" id="btnEditproperty" class="btn btn-primary btn btn-block">Update</button>

        </form>
      </div>
    </div>
</div>


<?php
    if(isset($_GET['propertyid']) && isset($_POST['btnEditproperty'])){
        $id = $_GET['propertyid'];
        $PropertyName = $_POST['propname'];
        $Address = $_POST['address'];
		$PictureURL = $_POST['pictureurl'];
        $Price = $_POST['price'];
		$LeaseType = $_POST['leasetype'];
		$No_of_Bedrooms = $_POST['bedrooms'];
		$No_of_Bathrooms = $_POST['bathrooms'];
		$Description = $_POST['description'];
		$PhoneNumber = $_POST['phno'];
		$City = $_POST['city'];
		$State = $_POST['state'];
		$Zipcode = $_POST['zipcode'];
        $sql = "UPDATE `PROPERTY_RENTAL` SET 
				`PropertyName` = '$PropertyName',
				`Address` = '$Address',
				`PictureURL` = '$PictureURL',
				`Price` = '$Price',
				`LeaseType` = '$LeaseType',
				`No_of_Bedrooms` = '$No_of_Bedrooms',
				`No_of_Bathrooms` = '$No_of_Bathrooms',
				`Description` = '$Description',
				`PhoneNumber` = '$PhoneNumber',
				`City` = '$City',
				`State` = '$State',
				`Zipcode` = '$Zipcode'
                WHERE PropertyID = $id";
        if($conn->query($sql) === TRUE){
            echo "<script type='text/javascript'>window.top.location='http://localhost:81/DBC_GROUP10/propertylisting.php';</script>"; exit;
            exit;
        }else{
            echo "something went wrong";
        }
    }else{
        echo "invalid";
    }
?>
</html>
<?php include('footer.php'); ?>
