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
        <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin_page.php">My Personal Info</a>
          <a class="dropdown-item" href="myproduct.php">My Product</a>
          <a class="dropdown-item" href="orderlistadmin.php">My Order</a>
          <a class="dropdown-item active" href="myorderservice.php">My Delivery</a>
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
<div class="container">
<!-- inside container -->
<?php
    include "connectdb.php"; 
    $sql="SELECT dc.deli_pic,t.user_address t_address,dc.d_ch_int,deli.user_address d_address,f.user_username uf,deli.user_username driver,deli.user_phone dp, f.user_phone  ufp,t.user_phone utp,t.user_username ut,dc.deli_avtime_from,dl.dl_datetime,dl.dl_id, o.orp_amount,p.product_name,f.user_address f_address from deliver_list as dl join deliver_choices as dc on dl.dl_dc_id=dc.d_ch_int join user as f on dl.dl_s_id=f.user_id join order_product as o on dl.dl_orp_id=o.orp_id join user as t on o.orp_cus_id=t.user_id join user as deli on dc.deli_deliver_id=deli.user_id join products as p on o.orp_pr_id=p.product_id where dl.dl_s_id='".$objResult["user_id"]."' and dl.dl_id='".$_REQUEST['dl_id']."';";
    $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
?>
<div class="row">
    <div class="col-5 border-right">
        <h1 class=" text-info p-2">รายละเอียด</h1>
        <img src="<?php echo $row['deli_pic']; ?>" width="60%" height="50%">
        <br>
        <small>Transport Pic</small>
    </div>
    <div class="col-6 mt-4">
    
                <h5>วันที่จัดขนส่งสินค้า: <?php echo $row['deli_avtime_from']; ?></h5>
                <h5>ชื่อสินค้า:  <?php echo $row['product_name'];?></h5>
                <h5>น้ำหนักสินค้า:    <?php echo $row['orp_amount']; ?>  KG</h5>
                <h5>ชื่อผู้รับ: <?php echo $row['ut']; ?></h5>
                <h5>ที่อยู่ผู้รับสินค้า:  <?php echo $row['t_address'];?>  </h5>
                <h5>เบอร์โทรผู้รับ: <?php echo $row['utp']; ?></h5>
                <h5>ชื่อผู้ส่ง: <?php echo $row['uf']; ?></h5>
                <h5>ที่อยู่ผู้ส่งสินค้า:  <?php echo $row['f_address']; ?>  </h5>
                <h5>เบอร์โทรผู้ส่ง: <?php echo $row['utp']; ?></h5>
                <h5>รหัสบริการขนส่ง: <?php echo $row['d_ch_int']; ?></h5>
                <h5>ชื่อผู้ขนส่ง: <?php echo $row['driver']; ?></h5>
                <h5>ที่อยู่ผู้ขนสินค้า:  <?php echo $row['d_address']; ?>  </h5>
                <h5>เบอร์โทรผู้ขนส่ง: <?php echo $row['dp']; ?></h5>
                <h5>เวลาดำเนินการสั่งบริการ: <?php echo $row['dl_datetime'];?></h5>
                <hr>
                <a href="myorderservice.php" class="btn btn-info">กลับไปหน้าMy Delivery</a>
     <?php
       mysqli_close($conn);
       ?>
    </div>
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








