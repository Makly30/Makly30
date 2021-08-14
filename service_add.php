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
   <!-- menu bar -->
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
          <a class="dropdown-item" href="list_order_service.php">My Order Service</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      </ul>
    </div>
  </div>
</nav>

   <!-- menu bar -->
      <div class="container">
    
     
      <div class="col-sm-12 col-md-9 col-lg-9">
                <h4 class='text-center pt-4'>เพิ่ม Service</h4>    
                <?php
                    if(isset($_POST['submit'])){

                      $target_dir = "";
                      $target_file =  basename($_FILES["fileToUpload"]["name"]);
                      $uploadOk = 1;
                      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                      
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                          // echo "File is an image - " . $check["mime"] . ".";
                          $uploadOk = 1;
                        } else {
                          echo "File is not an image.";
                          $uploadOk = 0;
                        }
                      
                      
                      // Check if file already exists
                      /*if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                      }*/
                      
                      // Check file size
                      if ($_FILES["fileToUpload"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                      }
                      
                      // Allow certain file formats
                      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                      && $imageFileType != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                      }
                      
                      // Check if $uploadOk is set to 0 by an error
                      if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                      // if everything is ok, try to upload file
                      } else {
                          include "connectdb.php";
                          // $menu_id=$_GET['product_id'];
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            // sql for create sql

                      // check image       
                     $deli_start=$_POST['deli_start'];
                     $deli_price=$_POST['deli_price'];
                     $deli_stop=$_POST['deli_stop'];
                     $deli_time=$_POST['deli_time'];
                     $d_a_id=$_POST['d_a_id'];
                     $deli_avtime_from=$_POST['deli_av_from'];
                     $deli_avtime_to=$_POST['deli_av_to'];
                        $sql = "insert into deliver_choices (deli_start,deli_stop,deli_time,d_ch_active,deli_deliver_id,deli_avtime_from,deli_avtime_to,deli_pic,deli_price)";
                        $sql .="values ($deli_start,$deli_stop,$deli_time,$d_a_id,'".$_SESSION['UserID']."','$deli_avtime_from','$deli_avtime_to','$target_file','$deli_price' )";
                        // echo $sql;
                             include 'connectdb.php';
                        mysqli_query($conn,$sql);
                        }}
                        mysqli_close($conn); 
                        echo "เพิ่มserviceใหม่ เรียบร้อยแล้ว<br>";
                        echo '<a href="myservice.php">แสดง My service ทั้งหมด</a>';
                      }
                        else{
                ?>
                    <form class="form-horizontal" method="POST" role="form" name="service_add" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <!-- service location start -->
                        <div class="form-group">
                        <label for="deli_start" class="col-md-2 col-lg-8 control-label">ทางเริ่มต้น</label>
                        <div class="col-md-10 col-lg-10">
                                <select name="deli_start" id="deli_start" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT PROVINCE_ID,PROVINCE_NAME FROM province order by PROVINCE_ID";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['PROVINCE_ID'] . '">';
                                        echo $row['PROVINCE_NAME'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>
                                     <!-- service location start -->
                        <div class="form-group">
                        <label for="deli_stop" class="col-md-2 col-lg-8 control-label">ปลายทาง</label>
                        <div class="col-md-10 col-lg-10">
                                <select name="deli_stop" id="deli_stop" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT PROVINCE_ID,PROVINCE_NAME FROM province order by PROVINCE_ID";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['PROVINCE_ID'] . '">';
                                        echo $row['PROVINCE_NAME'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>
                                                  <!-- service activate -->
                        <div class="form-group">
                        <label for="d_a_id" class="col-md-2 col-lg-8 control-label">สถานะ</label>
                        <div class="col-md-10 col-lg-10">
                                <select name="d_a_id" id="d_a_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT * FROM deliver_active order by d_a_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['d_a_id'] . '">';
                                        echo $row['d_a_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>
                           <!-- ระยะเวลาถีง -->
                           <div class="form-group">
                            <label for="deli_time" class="col-md-2 col-lg-4 control-label">ระยะเดินทาง คิดเป็นชั่วโมง</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='deli_time' type="number" min="0" value="0">
                            </div>    
                        </div>
                        <!-- date available -->
                        <div class="form-group">
                            <label for="deli_price" class="col-md-2 col-lg-4 control-label">Price</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='deli_price' type="number" min="0.00"step="0.1" value="0.00">
                            </div>    
                        </div>
                        
<div class="form-group">
                            <label for="deli_av_from" class="col-md-2 col-lg-2 control-label">วันหยุดข่าย</label>
                            <div class="col-md-10 col-lg-10">
                            <input type="datetime-local" name='deli_av_from' value="2021-07-26">
                            </div>    
                        </div>
                        <!-- date not available -->
                        
<div class="form-group">
                            <label for="deli_av_to" class="col-md-2 col-lg-2 control-label">วันหยุดข่าย</label>
                            <div class="col-md-10 col-lg-10">
                            <input type="datetime-local" name='deli_av_to' value="2021-07-26">
                            </div>    
                        </div>
                        <!-- pic -->
                        Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  
<!-- submit button -->
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
            </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>