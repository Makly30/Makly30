<?php
	session_start(); 
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "seller")
	{
		echo "This page for seller only!";
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
          <a class="nav-link " href="indexadmin.php">Home</a>
        </li>
        <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin_page.php">My Personal Info</a>
          <a class="dropdown-item" href="myproduct.php">My Product</a>
          <a class="dropdown-item" href="#">My Order</a>
          <a class="dropdown-item" href="#">My Delivery</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="service_board.php">Delivery Service</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      </ul>
      <form class="form-inline my-2 my-lg-1">
      <input class="form-control mr-sm-2" type="search" placeholder="Search for  deliver" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </div>
  </div>
</nav>

   <!-- menu bar -->
      <div class="container">
    
     
      <div class="col-sm-12 col-md-9 col-lg-9">
                <h4 class='text-center pt-4'>เพิ่มMenu</h4>    
                <?php
                    if(isset($_POST['submit'])){
                   
                      // check image
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

                                 
                        $product_name = $_POST['product_name'];
                        $product_price=$_POST['product_price'];
                        $product_amount=$_POST['product_amount'];
                        $product_measure=$_POST['product_measure'];
                        $product_owner=$_SESSION['UserID'];
                        $product_deli_price=$_POST['product_deli_price'];
                        $product_deli_price_out=$_POST['product_deli_price_out'];
                        $product_start=$_POST['product_start'];
                        $product_stop=$_POST['product_stop'];
                        $product_arrive_time_in=$_POST['product_arrive_time_in'];
                        $product_arrive_time_out=$_POST['product_arrive_time_out'];
                        $product_from=$_POST['product_from'];
                        $product_avai=$_POST['product_avai'];

                        $sql = "insert into products (product_name,product_price,product_amount,product_measure,product_owner,product_deli_price
                 ,product_deli_price_out,product_start,product_stop,product_arrivetime_in,product_arrivetime_out,product_from,product_available_p,product_pic)";
                        $sql .="values ('$product_name','$product_price','$product_amount','$product_measure','$product_owner',$product_deli_price
                   ,$product_deli_price_out,'$product_start','$product_stop',$product_arrive_time_in,$product_arrive_time_out,$product_from,'$product_avai'	,'$target_file')";
                        // echo $sql;

                            // sql for create sql
                            // $sql="update products set product_pic ='".$target_file."' where product_id=".$menu_id." ;";
                            // $result=mysqli_query($conn,$sql);
                             include 'connectdb.php';
                        mysqli_query($conn,$sql);
                    
                       
                          // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                        

                        // new code from employer_add.php

                     


                        // new code from employer_add.php
                       
                        }}
                        mysqli_close($conn); 
                        echo "เพิ่มเมนูใหม่ เรียบร้อยแล้ว<br>";
                        echo '<a href="myproduct.php">แสดงเมนูทั้งหมด</a>';
                      }
                        else{

                       
                   
                ?>
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" role="form" name="products_add" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <!-- product name -->
                    <div class="form-group">
                            <label for="product_name" class="col-md-2 col-lg-2 control-label">ขื่อเมนู</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="product_name" id="product_name" class="form-control">
                            </div>    
                        </div>
                        <!-- product measure -->
                        <div class="form-group">
                            <label for="product_measure" class="col-md-2 col-lg-2 control-label">ขนาดหน่วย</label>
                            <div class="col-md-10 col-lg-10">
                            <input type="number" name='product_measure' onchange="setTwoNumberDecimal" min="0" max="10" step="0.1" value="0.00" />
                            </div>    
                        </div>
                        <!-- product price -->
                        <div class="form-group">
                            <label for="product_price" class="col-md-2 col-lg-2 control-label">ราคาต่อหน่วย</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='product_price' type="number" min="0" step="0.1"value="0.00">
                            </div>    
                        </div>
                  
                        <!-- product_amount -->
                        <div class="form-group">
                            <label for="product_amount" class="col-md-2 col-lg-4 control-label">สินค้าที่มีว่างข่าย</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='product_amount' type="number" min="0" value="0">
                            </div>    
                        </div>

                        <!-- product from -->
                        <div class="form-group">
                        <label for="product_from" class="col-md-2 col-lg-8 control-label">จังหวัดที่ว่างข่าย</label>
                        <div class="col-md-10 col-lg-10">
                                <select name="product_from" id="product_from" class="form-control">
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

       <!-- product province available -->

                        <div class="form-group">
                            <label for="product_avai" class="col-md-2 col-lg-2 control-label">จังหวัดที่ซื้อได้</label>
                            <div class="col-md-10 col-lg-12"> 
                            <textarea name="product_avai" cols="40" rows="3"></textarea>
                                <br>
                            </div>    
                        </div> 
                           <!-- product deli price in -->
                           <div class="form-group">
                            <label for="product_deli_price" class="col-md-2 col-lg-2 control-label">ราคาขนส่่งภายในจังหวัด</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='product_deli_price' type="number" min="0" value="0.00">
                            </div>    
                        </div>
                           <!-- product deli price out -->
                           <div class="form-group">
                            <label for="product_deli_price_out" class="col-md-2 col-lg-2 control-label">ราคาขนส่งนอกจังหวัด</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='product_deli_price_out' type="number" min="0" value="0.00">
                            </div>    
                        </div>
                  
                  
<!-- product start -->
                        <div class="form-group">
                            <label for="product_start" class="col-md-2 col-lg-2 control-label">วันว่างข่าย</label>
                            <div class="col-md-10 col-lg-10">
                            <input type="datetime-local" name='product_start' value="2021-07-26">
                            </div>    
                        </div>
                        
<!-- product stop -->

<div class="form-group">
                            <label for="product_stop" class="col-md-2 col-lg-2 control-label">วันหยุดข่าย</label>
                            <div class="col-md-10 col-lg-10">
                            <input type="datetime-local" name='product_stop' value="2021-07-26">
                            </div>    
                        </div>
<!-- product_arrive_time_in  -->
<div class="form-group">
                            <label for="product_arrive_time_in" class="col-md-2 col-lg-12 control-label">ระยะเวลาส่งภายในจังหวัดคิดเป็นวัน</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='product_arrive_time_in' type="number" min="0" value="0">
                            </div>    
                        </div>


<!-- product_arrive_time_out  -->
<div class="form-group">
                            <label for="product_arrive_time_out" class="col-md-2 col-lg-12 control-label">ระยะเวลาส่งภายนอกจังหวัดคิดเป็นวัน</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='product_arrive_time_out' type="number" min="0" value="0">
                            </div>    
                        </div>
      <!-- pic -->
      </div>
 <!-- product_picture -->
 Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">

<!-- submit button -->
                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-success">
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