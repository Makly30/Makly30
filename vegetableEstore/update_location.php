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
          <a class="nav-link " href="index_deliver.php">Home</a>
        </li>
        <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="deliver_page.php">My Personal Info</a>
          <a class="dropdown-item " href="myservice.php">My Service</a>
          <a class="dropdown-item active" href="list_order_service.php">My Order Service</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      </ul>
    </div>
  </div>
</nav>

<!-- menubar -->
     
    
      <div class='container'>
 
      <div class="col-sm-12 col-md-9 col-lg-9">
                  
                <h4>Update Location</h4>    
                <?php
                    include 'connectdb.php';
                    if(isset($_GET['submit'])){
                        $dl_id     = $_GET['dl_id'];
                        $ps_id     = $_GET['ps_id'];
                        $update_location=$_GET['update_location'];
                        $sql        = "UPDATE `tracking` SET `tr_place`='$update_location',`ps_id`='$ps_id' where tr_de_list_id='$dl_id'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                        // echo $sql;
                       
                        echo '<a href="list_order_service.php">แสดงเมนูทั้งหมด</a>';
                    }else{
                        $fdl_id = $_REQUEST['dl_id'];
                        $sql =  "SELECT * FROM tracking where tr_de_list_id='$fdl_id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $ftr_place=$row['tr_place'];
                        $ftr_ps=$row['ps_id'];
                  
                        mysqli_free_result($result);
                        mysqli_close($conn);                        
                ?>
                    <form class="form-horizontal" role="form" name="product_edit" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="dl_id" id="dl_id" value="<?php echo "$fdl_id";?>">
                 
                       
<!-- upload -->

<div class="form-group">
                            <label for="update_location" class="col-md-2 col-lg-2 control-label">จังหวัดที่ซื้อได้</label>
                            <div class="col-md-10 col-lg-12"> 
                            <textarea name="update_location" cols="40" rows="3"><?php echo $ftr_place; ?></textarea>
                                <br>
                            </div>    
                        </div> 
                        <div class="form-group">
                        <label for="ps_id" class="col-md-2 col-lg-8 control-label">สถานะ</label>
                        <div class="col-md-10 col-lg-10">
                                <select name="ps_id" id="ps_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT * FROM status_process order by status_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['status_id'] . '"';
										if($row['status_id']==$ftr_ps){
                                            echo ' selected="selected" ';
                                        }
										echo ">";
                                        echo $row['status_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>
                       
                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-success mt-4">
                            </div>    
                        </div>
                    </form>
                <?php
                    }
                ?>
                </div>    
 <!-- inside container -->
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>








