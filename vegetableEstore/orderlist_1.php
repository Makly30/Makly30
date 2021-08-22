
<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
        header("location:login.php");
       
		exit();
	}

	if($_SESSION['Status'] != "seller")
	{
		echo "This page for seller only!";
		exit();
	}	
	
	include 'connectdb.php';
	$strSQL = "SELECT * FROM user WHERE user_id = '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
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

  <?php
    include "connectdb.php";
    $orp_id= $_REQUEST['orp_id'];
    $sql=" select a.orp_id, p.product_name,status_process.status_name,tracking.tr_place,p.product_arrivetime_in tin,p.product_arrivetime_out tout,a.orp_amount,p.product_deli_price,p.product_deli_price_out,a.orp_dc,a.orp_tr_id,round((a.orp_amount/p.product_measure) * p.product_price,2) total,round((a.orp_amount/p.product_measure) * p.product_price+p.product_deli_price,2) total_in,round((a.orp_amount/p.product_measure) * p.product_price+p.product_deli_price_out,2) total_out ,pr.province_name,u.user_address k,k.user_username urname,k.user_phone,u.user_username,k.user_address cus_address,p.product_measure,a.orp_datetime,p.product_pic , a.orp_amount, p.product_price from order_product as a join products as p on a.orp_pr_id=p.product_id join user as u on p.product_owner=u.user_id join province as pr on p.product_from=pr.province_id join user as k on a.orp_cus_id=k.user_id join tracking on a.orp_tr_id=tracking.tr_id join status_process on tracking.ps_id=status_process.status_id where  a.orp_id='".$orp_id."';";
    $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
?>
<h5>รายละเอียด</h5>
<div class='row'>
<div class='col-md-6'>
<img src="<?php echo $row['product_pic']; ?>" height="318">
<hr>
<p>ชื่อเมนู:  <?php echo $row['product_name'];?></p>
<p>น้ำหนัก:  <?php echo $row['product_measure'];?>  KG</p>
<p>ราคาต่อหน่วย:  <?php echo $row['product_price']; ?>  บาท</p>

<p>เวลาดำเนินงาน: <?php echo $row['orp_datetime'];?></p>
<h5 class='text-success text-center'>Contact Customer</h5>
<p>Customer:    <?php echo $row['urname']; ?> </p>
<p>Phone:    <?php echo $row['user_phone']; ?> </p>
<p>Address:    <?php echo $row['cus_address']; ?> </p>

<hr>
</div>

<div class="col-md-6">
<p>น้ำหนักสินค้าที่ออเดอร์:   <?php echo $row['orp_amount'];?> KG </p>
<p>สรุป:   <?php echo $row['total'];?>  </p>
<?php 
if ($row['orp_dc']==1){
echo "<p>ราคาขนส่งภายนอกจังหวัด:   ".$row['product_deli_price_out']."</p>";
echo "<p>ราคาทั้งหมด:   ".$row['total_out']."</p>";
}else{
  echo "<p>ราคาขนส่งภายในจังหวัด:  ".$row['product_deli_price']."</p>";
  echo "<p>ราคาทั้งหมด:   ".$row['total_in']."</p>";
}?>
<p>จังหวัดที่ว่างข่าย:   <?php echo $row['province_name'];?>  </p>
<p>ที่อยู่แม่ค้า:  <?php echo $row['k']; ?> </p>
<p>ที่อยู่ลูกค้า:  <?php echo $row['cus_address']; ?> </p>
<p>Seller:    <?php echo $row['user_username']; ?> </p>
<p>รหัสติดตามสถานะขนส่ง: <?php echo $row['orp_tr_id'];?></p> 
<p>สถานะ: <?php echo $row['status_name'];?></p>
<hr>

   

                          
<a href="orderlistadmin.php?orp_id=<?php echo $row['orp_id'];?>" class="btn btn-info">กลับไปหน้าสั่งซื้อOnline</a>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne<?=$row['orp_tr_id']?>">
<h4 class="panel-title">
        <button type="button"  class="btn btn-danger mt-2" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$row['orp_tr_id']?>" aria-expanded="false" aria-controls="collapseOne<?=$row['orp_tr_id']?>">
         เช็คสถานะ
        </button>
</h4>
<div>
<div id="collapseOne<?=$row['orp_tr_id']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?=$row['orp_tr_id']?>">
      <div class="panel-body">
      <p>ที่อยู่ตอนนี้: <?php echo $row['tr_place'] ; ?></p>
   

    </div>
    </div>
    <!-- collapse2 -->

   <!-- order add -->
    </div>
    </div>
</div>
</div>
 
<br>
     <?php
   
                               
                                mysqli_close($conn);
                            ?> </div>
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>