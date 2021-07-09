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
      <div class="jumbotron" style="background-color:#f5b7b1;color:#21618c">
       <?php
       include "menu.php";
       ?>
      </div>
      <div class="container">
      <div class="row">
      <div class="col-sm-4 border-right">
      </div>
      <div class="col-sm-12 col-md-9 col-lg-9">
<form name="form1" method="post" action="save_profile.php">
<h5 class='text-danger'><b>Edit Profile</b></h5>
  <div class='form-group'>
  <label>UserID</label>
  <input type='text' class='form-control'name="txtUserId" id="txtUserId"  value="<?php echo $objResult["cus_id"];?>">
  </div>
  <div class='form-group'>
  <label>Username</label>
  <input type='text'name="txtUsername" id="txtUsername"  class='form-control' value="<?php echo $objResult["Username"];?>">
  </div>
  <div class='form-group'>
  <label>First Name</label>
  <input type='text' class='form-control'name="txtfname" id="txtfname"  value="<?php echo $objResult["cus_fname"];?>">
  </div>
  <div class='form-group'>
  <label>Last Name</label>
  <input type='text' class='form-control'name="txtlname" id="txtlname"  value="<?php echo $objResult["cus_lname"];?>">
  </div>
  <div class='form-group'>
  <label>Password</label>
  <input type='password'name="txtPassword" id="txtPassword"  class='form-control' value="<?php echo $objResult["Password"];?>">
  </div>
  <div class='form-group'>
  <label>Confirm Password</label>
  <input type='password' name="txtConPassword" id="txtConPassword" class='form-control' value="<?php echo $objResult["Password"];?>">
  </div>
  <div class="form-group">             
                        <label >Phone</label>
                                <input type="text" name="cus_phone" id="cus_phone" class="form-control" value="<?php echo $objResult["cus_phone"];?>">
                           </div>
                        <div class="form-group">
                            <label >ที่อยู่</label>
                                <textarea name="cus_address" rows="5" id="cus_address" class="form-control"><?php echo $objResult["cus_address"];?></textarea>  
                        </div> 
  <div class='form-group'>

  <label>Status</label>
  
  <input type='text' name='txtstatus' id='txtstatus' class='form-control' value="<?php echo $objResult["Status"];?>">
  </div>

  <button type="submit" class="btn btn-success" name="Submit" value="Save">Save</button>
 
</form>
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











              
