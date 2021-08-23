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
          <a class="dropdown-item" href="orderlistadmin.php">My Order</a>
          <a class="dropdown-item" href="myorderservice.php">My Delivery</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="service_board.php">Delivery Service</a>
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
                  
                <h4>แก้ไขเมนู</h4>    
                <?php
                    include 'connectdb.php';
                    if(isset($_GET['submit'])){
                        $product_id     = $_GET['product_id'];
     
                        $product_stop=$_GET['product_stop'];
                        $product_amount=$_GET['product_amount'];
                        $sql        = "UPDATE `products` SET `product_amount`='$product_amount',`product_stop`='$product_stop' where product_id='$product_id'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                        // echo $sql;
                       
                        echo '<a href="menu_list.php">แสดงเมนูทั้งหมด</a>';
                    }else{
                        $fproduct_id = $_REQUEST['product_id'];
                        $sql =  "SELECT * FROM products where product_id='$fproduct_id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $fproduct_name = $row['product_name'];
                        $fproduct_measure=$row['product_measure'];
                        $fproduct_price=$row['product_price'];
                        $fproduct_amount=$row['product_amount'];
                        $fproduct_deli_price=$row['product_deli_price'];
                        $fproduct_deli_price_out=$row['product_deli_price_out'];
                        $fproduct_start=$row['product_start'];
                        $fproduct_stop=$row['product_stop'];
                        $fproduct_arrivetime_in=$row['product_arrivetime_in'];
                        $fproduct_arrivetime_out=$row['product_arrivetime_out'];
                        $fproduct_from=$row['product_from'];
                        $fproduct_available_p=$row['product_available_p'];
                  
                        mysqli_free_result($result);
                        mysqli_close($conn);                        
                ?>
                    <form class="form-horizontal" role="form" name="product_edit" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo "$fproduct_id";?>">
                 
                        <div class="form-group ">
                            <label for="product_amount" class="col-md-2 col-lg-2 control-label">สินค้าที่มีทั้งหมด</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="number" name="product_amount" id="product_amount" min="0.00" class="form-control" value="<?php echo "$fproduct_amount";?>">
                            </div>    
                        </div>
<!-- date start -->

                        <div class="form-group">
                            <label for="product_stop" class="col-md-2 col-lg-2 control-label">วันหยุดข่าย</label>
                            <div class="col-md-10 col-lg-10">
                            <input type="datetime" name='product_stop' value="<?php echo $fproduct_stop ?>">
                            </div>    
                        </div>
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