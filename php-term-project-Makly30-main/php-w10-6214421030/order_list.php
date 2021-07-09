
<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
        header("location:login.php");
       
		exit();
	}

	/*if($_SESSION['Status'] != "USER")
	{
		echo "This page for User only!";
		exit();
	}	*/
	
	include 'connectdb.php';
	$strSQL = "SELECT * FROM customer WHERE cus_id = '".$_SESSION['UserID']."' ";
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
 echo "(  ". $row['Username']."  )"  ?>. Click here to <a href="logout.php" tite="Logout">Logout.</a>
<?php

}else if($_SESSION['Status']=NULL){ echo "<h1>Please login first .</h1>";} 
?>
      <div class="jumbotron" style="background-color:#fdebd0;color:#21618c">
      <h1 class="display-3 text-right">ร้านCoffee&Dessert</h1>
          <p class="lead text-right">
          เป็นร้านที่สร้างเสมือนจริงเพื่อทดลองการเขียนโปรแกรมโดยภาษาPHP</p>
         
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Coffee&Dessert</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">เกี่ยวกับร้าน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="Menu_show.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="order_show.php">สั่งซื้อOnline</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="promotion_list.php">Promotion</a>
        </li>
    </div>
  </div>
</nav>
      </div>
      <div class="container">
     
                  
      <?php
    include "connectdb.php";
    $o_id= $_GET['o_id'];
    $sql="SELECT order_online.o_id,menu.menu_name,menu.price,customer.cus_address,order_online.o_addtition,menu.menu_pic,promotion.pro_name,promotion.pro_condition,promotion.pro_discount,order_online.amount,promotion.pro_name,(menu.price*order_online.amount+order_online.delivery_price+promotion.pro_price*menu.price*order_online.amount) as Totalcost,customer.cus_fname,customer.cus_lname,customer.cus_phone,customer.cus_phone,order_online.date_process,(menu.price*order_online.amount)as totalreal,order_online.delivery_price,promotion.pro_price,order_online.o_addtition,employer.em_fname,employer.em_lname FROM `order_online` join menu on order_online.menu_id=menu.menu_id join promotion on order_online.pro_id=promotion.pro_id join customer on order_online.cus_id=customer.cus_id join employer on order_online.em_id=employer.em_id  where order_online.o_id=".$o_id.";";
    $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
?>
<h5>รายละเอียด</h5>
<div class='row'>
<div class='col-md-6'>
<img src="<?php echo $row['menu_pic']; ?>" height="318">
<hr>
<p>ชื่อเมนู:  <?php echo $row['menu_name'];?></p>
<p>ราคาเดียว:  <?php echo $row['price']; ?>  บาท</p>
</div>
<div class='col-md-6'>
<p>รหัสออเดอร์:  <?php echo $row['o_id'] ;?></p>
<p>ราคาสรุปทั้งค่าขนส่ง:  <?php echo $row['Totalcost'];?> บาท</p>
<p>จำนวน:  <?php echo $row['amount']; ?></p>
<p>ราคาสรุป:  <?php echo $row['totalreal']; ?>  บาท</p>
<p>ชื่อโปรโมชั่น: <?php echo $row['pro_name'];?></p>
<p>เงื่อนไขโปรโมชั่น: <?php echo $row['pro_condition'];?></p>
<p>โปรโมชั่นที่ได้รับ:  <?php echo $row['pro_discount'];?></p>
<p>ราคาโปรโมชั่น:  <?php echo $row['pro_price']; ?>  บาท</p>
<p>ราคาค่าขนส่ง:  <?php echo $row['delivery_price'];?>  บาท</p>
<p>ชื่อลูกค้า:  <?php echo $row['cus_fname'].'  '.$row['cus_lname'] ;?></p>
<p>เบอร์โทรลูกค้า:  <?php echo $row['cus_phone'];?></p>
<p>ที่อยู่ลูกค้า:  <?php echo $row['cus_address'];?></p>
<p>พนักงานดำเนินงาน:  <?php echo $row['em_fname'].'  '.$row['em_lname'];?></p>
<p>เวลาดำเนินงาน: <?php echo $row['date_process'];?></p>
<p>เพิ่มเติ่ม:  <?php echo $row['o_addtition'];?></p>
<hr>
<?php
   
                               
                                mysqli_close($conn);
                            ?>
                          
<a href="order_show.php?o_id=<?php echo $row['o_id'];?>" class="btn btn-info">กลับไปหน้าสั่งซื้อOnline</a>
      </div>
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>