<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "seller")
	{
		echo "This page for Seller only!";
		exit();
	}	
	
	include 'connectdb.php';
	$strSQL = "SELECT * FROM user WHERE user_id= '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@300&display=swap" rel="stylesheet"> 
<style>
</style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="font-family: 'Bai Jamjuree', sans-serif;">
<!-- menubar -->
<nav class="navbar  navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand " href="#">Vegetable E-store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="indexadmin.php">Home</a>
        </li>
        <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item active" href="admin_page.php">My Personal Info</a>
          <a class="dropdown-item" href="myproduct.php">My Product</a>
          <a class="dropdown-item" href="orderlistadmin.php">My Order</a>
          <a class="dropdown-item" href="myorderservice.php">My Delivery</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="service_board.php">Delivery Service</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      </ul>
      <!-- <form class="form-inline my-2 my-lg-1">
      <input class="form-control mr-sm-2" type="search" placeholder="Search for  deliver" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
    </div>
  </div>
</nav>

<!-- menubar -->
     
    
      <div class='container'>
        <div class="row">
                <div class="col-4"></div>   
                <div class="col-4">
                    <div class="card  mb-2" style="width:350px">
                        <img class="card-img-top" src="<?php  echo $objResult["user_picture"];?>" alt="Card image" height=auto width=50%>
                        <div class="card-body">
                          <!-- <h4 class="card-title">John Doe</h4>
                          <p class="card-text">Some example text.</p>
                          <a href="#" class="btn btn-primary">See Profile</a> -->
                        </div>
                        </div>
                </div>
        </div>
             <h5 class='text-success pt-1 text-center'><b>   Personal Information: </b></h5>

               <table class="table table-bordered table-striped ">
               <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                </tr>
                <tr>
                <td><?php echo $objResult["user_username"];?></td>
               <td><?php echo $objResult["user_fname"].' '.$objResult["user_lname"];?></td>
               <td><?php echo $objResult["user_email"];?></td>
               <td><?php echo $objResult["user_phone"];?></td>
               <td><?php echo $objResult["user_address"];?></td>
                </tr>
                </table>
          
                
              
                
  <div class='form-group'>
  <div class="col-md-10 col-lg-10">
  <span class="label label-warning "><a class="btn btn-warning" href="edit_profile3.php" >Edit Profile</a></span>
  <a href="photoshow_seller_change.php?user_id=<?php echo $objResult['user_id'];?>" class="btn btn-info">เปลี่ยนภาพ</a>
  <!-- <span class="label label-light "><a  href="logout.php">Logout</a></span>  -->
  </div>
  </div>

      </div>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>








