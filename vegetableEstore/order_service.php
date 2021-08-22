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
      <form class="form-inline my-2 my-lg-1">
      <input class="form-control mr-sm-2" type="search" placeholder="Search for  deliver" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </div>
  </div>
</nav>


<!-- menubar -->
     <!-- submit -->
     <div class="container">
       <?php 
   if(isset($_GET['submit'])){

     
                     $orp_id=$_GET['orp_id'];
                   $deliver=$_GET['deliver'];
                     $seller=$objResult['user_id'];
                    $dl_id1=$_GET['dc_id'];
                        $sql = "insert into deliver_list (dl_orp_id,dl_s_id,dl_deli_id,dl_dc_id)";
                        $sql .="values($orp_id,$seller,$deliver,$dl_id1); ";
                        //  echo $sql;
                             include 'connectdb.php';
                        mysqli_query($conn,$sql);
                        $s2="select * from deliver_list where deliver_list.dl_orp_id='".$orp_id."';";
                        $re2=mysqli_query($conn,$s2);
                        $row2=mysqli_fetch_array($re2,MYSQLI_ASSOC);
                        $sql1="insert into tracking (orp_id,ps_id,tr_de_list_id)";
                        $sql1 .="values($orp_id,2,".$row2['dl_id'].");";
                        mysqli_query($conn,$sql1);
                        // echo $sql1;
                        echo "<a href='myorderservice.php' class='text-center'>My order service</a>";
                        mysqli_close($conn); 
                     
                      
                        
    }else{ ?>
     </div>
   

     <!-- submit -->
<div class='container'>
 



 <?php
include 'connectdb.php';
$sql="SELECT user.user_picture,deliver_choices.d_ch_date,deliver_choices.d_ch_int,deliver_choices.deli_pic,deliver_choices.deli_avtime_to,deliver_choices.deli_avtime_from,user_username pk,province.province_name ps,deliver_choices.deli_time,province.province_name pt,deliver_choices.d_ch_active,deliver_choices.deli_start,deliver_choices.deli_stop from deliver_choices join user on deliver_choices.deli_deliver_id=user.user_id join  province on deliver_choices.deli_start=province.province_id  ;";
$result=mysqli_query($conn,$sql);

?>
<h1 class='text-center text-success pt-3'>Order Service:</h1>
<p class="text-center text-warning">กรุณาผู้ส่งสินค้ามาส่งสินค้าถึงสถานที่รับขนส่งก่อนเวลาเดินทางอย่างน้อย 1 ชั่วโมง</p>
<form class="form-horizontal" role="form" name="order_service" action="<?php echo $_SERVER['PHP_SELF']?>">
<!-- select orp -->
<div class="form-group">
                        <div class="col-md-10 col-lg-10">
                            <label for="orp_id" class="col-md-2 col-lg-2 control-label">ชื่อผู้รับสินค้า</label>
                                <select name="orp_id" id="orp_dc" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  "SELECT order_product.orp_id,order_product.orp_datetime,order_product.orp_amount,products.product_name , user.user_username, user.user_address FROM order_product join user on order_product.orp_cus_id=user.user_id join products on order_product.orp_pr_id=products.product_id join user as own on products.product_owner=own.user_id join tracking on order_product.orp_tr_id=tracking.tr_id where tracking.tr_id=0 and own.user_id=".$objResult['user_id']." ;";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['orp_id'].'"';
                                      
                                        echo ">";
                                        echo $row['user_username'].' ซื้อ  '.$row['product_name'].'  จำนวน'.$row['orp_amount'].' kg  วันที่:  '.$row['orp_datetime'].' ที่อยู่: '.$row['user_address'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>

<!-- select orp -->
<!-- select deliver -->
<div class="form-group">
                        <div class="col-md-10 col-lg-10">
                            <label for="deliver" class="col-md-2 col-lg-2 control-label">ชื่อบริการขนส่ง</label>
                                <select name="deliver" id="deliver" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  "SELECT user.user_id,user.user_username FROM user where user.user_id='".$_REQUEST['deli_deliver_id']."';";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['user_id'].'"';
                                      
                                        echo ">";
                                        echo $row['user_username'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>
                        <!-- dc_id -->
                        <div class="form-group">
                            <label for="dc_id" class="col-md-2 col-lg-4 control-label">รหัสที่ให้บริการ</label>
                            <div class="col-md-10 col-lg-10">
                            <select name="dc_id" id="dc_id" class="form-control">
                            <option value="<?php echo $_REQUEST['d_ch_int'];?>"><?php echo $_REQUEST['d_ch_int'];?></option>
                            </select>
                            </div>    
                        </div>
<!-- select deliver -->
<div class="form-group">
                            <label for="orp_seller" class="col-md-2 col-lg-4 control-label">ชื่อผู้ส่ง</label>
                            <div class="col-md-10 col-lg-10">
                            <h5 class="text-info"><b><?php echo $objResult['user_username'];?></b></h5>
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
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>








