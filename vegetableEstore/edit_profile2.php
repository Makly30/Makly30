<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}
  if($_SESSION['Status'] != "deliver")
	{
		echo "This page for deliver only!";
		exit();
	}	
	include 'connectdb.php';
	$strSQL = "SELECT * FROM user WHERE user_id = '".$_SESSION['UserID']."' ";
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

</style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="font-family: 'Bai Jamjuree', sans-serif;">
  <!-- navbar -->
  <nav class="navbar  navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand " href="#">Vegetable E-store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="index_deliver.php">Home</a>
        </li>
        <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="deliver_page.php">My Personal Info</a>
          <a class="dropdown-item" href="myservice.php">My Service</a>
          <a class="dropdown-item" href="#">My Order Service</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- navbar -->
      <div class="container">
      <div class="row">
      <div class="col-sm-4 border-right">
      </div>
      <div class="col-sm-12 col-md-9 col-lg-9">
<!-- submit -->
<?php
        if(isset($_POST['submit'])){
    

          if($_SESSION['UserID'] == "")
          {
            echo "Please Login!";
            exit();
          }
        include 'connectdb.php';
          
          if($_POST["txtPassword"] != $_POST["txtConPassword"])
          {
            echo "Password not Match!";
            exit();
          }

                                                  $strSQL = "UPDATE user SET  user_username='".trim($_POST['txtUsername'])."',
                                                            user_password = '".trim($_POST['txtPassword'])."',
                                                            user_phone='".trim($_POST['cus_phone'])."',
                                                            user_address='".trim($_POST['cus_address'])."',
                                                            user_fname='".trim($_POST['txtfname'])."',
                                                            user_email='".trim($_POST['txtEmail'])."',
                                                          
                                                            user_lname='".trim($_POST['txtlname']).
                                                            "' WHERE user_id = '".$_SESSION["UserID"]."' ";
                                                            $objQuery = mysqli_query($conn,$strSQL);
                                                            
                                                            echo "<br>Save Completed!<br>";	
                                                          echo "<a href='deliver_page.php'>My Personal Information</a>";
                                                            
                                                        
                                                  
                                                        mysqli_close($conn); 
     
          // end if three
         
      // end if two             
                           }
                          //  end if one
              else{
          
             ?>
        <!-- form -->
<form name="form1" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
<h5 class='text-danger'><b>Edit Profile</b></h5>
  <!-- <div class='form-group'>
  <label>UserID</label>
  <input type='text' class='form-control'name="txtUserId" id="txtUserId"  value="<?php echo $objResult["user_id"];?>">
  </div> -->
  <div class='form-group'>
  <label>Username</label>
  <input type='text'name="txtUsername" id="txtUsername"  class='form-control' value="<?php echo $objResult["user_username"];?>">
  </div>
  <!-- email -->
  <div class='form-group'>
  <label>Email</label>
  <input type='text'name="txtEmail" id="txtEmail"  class='form-control' value="<?php echo $objResult["user_email"];?>">
  </div>
  <div class='form-group'>
  <label>First Name</label>
  <input type='text' class='form-control'name="txtfname" id="txtfname"  value="<?php echo $objResult["user_fname"];?>">
  </div>
  <div class='form-group'>
  <label>Last Name</label>
  <input type='text' class='form-control'name="txtlname" id="txtlname"  value="<?php echo $objResult["user_lname"];?>">
  </div>
  <div class='form-group'>
  <label>Password</label>
  <input type='password'name="txtPassword" id="txtPassword"  class='form-control' value="<?php echo $objResult["user_password"];?>">
  </div>
  <div class='form-group'>
  <label>Confirm Password</label>
  <input type='password' name="txtConPassword" id="txtConPassword" class='form-control' value="<?php echo $objResult["user_password"];?>">
  </div>
  <div class="form-group">             
                        <label >Phone</label>
                                <input type="text" name="cus_phone" id="cus_phone" class="form-control" value="<?php echo $objResult["user_phone"];?>">
                           </div>
                        <div class="form-group">
                            <label >ที่อยู่</label>
                                <textarea name="cus_address" rows="5" id="cus_address" class="form-control"><?php echo $objResult["user_address"];?></textarea>  
                        </div> 
  <!-- <div class='form-group'>

  <label>Status</label>
  
  <input type='text' name='txtstatus' id='txtstatus' class='form-control' value="<?php echo $objResult["status"];?>">
  </div> -->
<!-- pic -->

<!-- pic -->
  <button type="submit" class="btn btn-success" name="submit" value="submit">Save</button>
 
</form>
<?php
                }
                ?>
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











              
