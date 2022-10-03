<html>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/login.css">
      
    </head>
</html>
<body style="background-image: url('https://images.pexels.com/photos/7578939/pexels-photo-7578939.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');
background-size: cover;
background-position:center center;
height: 120vh;">
    <nav style="background-color: #db9d2c !important" class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php" style="color:white">Homespace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Dashboard<span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0 mr-2">
            <button style="background: #5a8626c4;border-color:59743a" class="btn btn-primary my-2 my-sm-0" type="submit"><a href="login.php" style="color: white">Login/Register</a></button>
          </form>
          <!-- <form class="form-inline my-2 my-lg-0">
            <button style="background: #5a8626c4;border-color:59743a" class="btn btn-primary my-2 my-sm-0" type="submit"><a href="login1.php" style="color: white">Owner Login</a></button>
          </form> -->
        </div>
        
      </nav>
      <div class="page_heading" style=" text-align:center;
      color: white;
      margin-top: 4%;">
        <h2>HOMESPACE</h2>
        <span>A Space to market/rent apartments</span>
     </div>
</body>

<?php include('footer.php'); ?>