<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "USER")
	{
		echo "This page for User only!";
		exit();
	}	
	
	include 'connectdb.php';
	$strSQL = "SELECT * FROM customer WHERE cus_id = '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>

</body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@300&display=swap" rel="stylesheet"> 
<style>
.navbar {
  overflow: hidden;
  background-color: #5b2c6f;
  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background: #ddd;
  color: black;
}


</style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="font-family: 'Bai Jamjuree', sans-serif;">
  <?php if($_SESSION["Status"]) {
?>
Welcome
 <?php 
 include 'connectdb.php';
 $sql = " SELECT * FROM customer where cus_id='".$_SESSION['UserID']."' ";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
 echo $_SESSION["Status"];
 echo "(  ". $row['Username']."  )"  ?>. Click here to <a href="logout.php" tite="Logout">Logout.
<?php

}else if($_SESSION['Status']=NULL){ echo "<h1>Please login first .</h1>";} 
?>

      <div class="jumbotron" style="background-color:#fdebd0;color:#21618c">
       <?php
       include "menu.php";
       ?>
      </div>
      <div class="container">
      <div class="row">
      <div class="col-sm-4 border-right">
      </div>
      <div class="col-sm-12 col-md-9 col-lg-9">
             <h5 class='text-success'><b>   Welcome to User Page! </b></h5>
               <table class="table table-bordered table-striped">
               <tr>
                <th>Username</th>
                <th>Full Name</th>
                </tr>
                <tr>
                <td><?php echo $objResult["Username"];?></td>
               <td><?php echo $objResult["cus_fname"].' '.$objResult["cus_lname"];
              
               ?></td>
                </tr>
                </table>
          
                
              
                
  <div class='form-group'>
  <div class="col-md-10 col-lg-10">
  <span class="label label-warning "><a href="edit_profile.php" >Edit Profile</a></span>

  <span class="label label-light "><a  href="logout.php">Logout</a></span> 

  </div>
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








