<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "customer")
	{
		echo "This page for customer only!";
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
          <a class="nav-link " href="index_user.php">Home</a>
        </li>
        <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item active" href="user_page.php">My Personal Info</a>
          <a class="dropdown-item" href="order_show.php">My Order</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      </ul>
    </div>
  </div>
</nav>
<!-- menubar -->

      <div class="container">
     <h1 class='text-center text-info pt-4 pb-3'>Search Result For : " <?php echo $_REQUEST['search_vegetable']; ?>  "</h1> 
     <div class="row"> 
    <?php
    include 'connectdb.php';
    $sql="SELECT product_name,product_id,product_deli_price,province_name,product_available_p,product_deli_price_out,product_start,product_stop,product_arrivetime_in,product_arrivetime_out, product_price,product_pic,product_amount, user_username ,product_measure from products join user on products.product_owner=user.user_id join province on products.product_from=province.PROVINCE_ID where product_name='".$_REQUEST['search_vegetable']."' or province_name='".$_REQUEST['search_vegetable']."';";
$result=mysqli_query($conn,$sql); 
    if(mysqli_fetch_row($result)!=0){
        $sql1="SELECT product_name,product_id,product_deli_price,province_name,product_available_p,product_deli_price_out,product_start,product_stop,product_arrivetime_in,product_arrivetime_out, product_price,product_pic,product_amount, user_username ,product_measure from products join user on products.product_owner=user.user_id join province on products.product_from=province.PROVINCE_ID where product_name='".$_REQUEST['search_vegetable']."' or province_name='".$_REQUEST['search_vegetable']."';";
$result1=mysqli_query($conn,$sql1);
while(($row=mysqli_fetch_array($result1,MYSQLI_ASSOC))){
    ?>
<div class="col-4">
     <div class="card mt-4" style="width: 18rem;">
     <img src="<?php echo $row['product_pic']; ?>" class="card-img-top" alt="<?php echo $row['product_name'];?> " height="180">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['product_name'] ;?></h5>
    <p class='card-text text-info '>น้ำหนัก <?php echo $row['product_measure'];?> กิโลกรัม</p>
    <p class="card-text text-success h6">ราคา <?php echo $row['product_price'];?> บาท</p>
    <p class="card-text text-primary h6">seller : <?php echo $row['user_username'];?> </p>
    <!-- <a href="#" class="btn btn-primary">Detail</a> -->
<!-- collapse medal -->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne<?=$row['product_id']?>">
      <h4 class="panel-title">
        <button type="button"  class="btn btn-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$row['product_id']?>" aria-expanded="false" aria-controls="collapseOne<?=$row['product_id']?>">
         Detail
        </button>
        <button type="button"  class="btn btn-success" ><a  class="text-light"href="order_add.php?product_id=<?php echo $row['product_id'];?>">
         Order</a>
        </button>
      </h4>
    </div>
    <!-- collapse1 -->
    <div id="collapseOne<?=$row['product_id']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?=$row['product_id']?>">
      <div class="panel-body">
      
   
      <p>ราคา: <?php echo $row['product_price'];?> บาท ต่อน้ำหนัก <?php echo $row['product_measure'];?> กิโลกรัม </p>
      <p>สินค้าที่มีว่างข่าย:       <?php echo $row['product_amount'];?>  กิโลกรัม</p>
      <p>จังหวัดที่ว่างข่าย : <?php echo $row['province_name'];?> </p>
      <p>จังหวัดที่ซื้อได้ : <?php echo $row['product_available_p'];?> </p>
      <p>วันว่างข่าย : <?php echo $row['product_start'];?></p>
      <p>  วันหยุดข่าย:  <?php echo $row['product_stop'];?></p>
      <p>ราคาขนส่่งภายในจังหวัด : <?php echo $row['product_deli_price'];?> </p>
      <p> ราคาขนส่งนอกจังหวัด:   <?php echo $row['product_deli_price_out'];?> </p>
      <p>ระยะเวลาส่งภายในจังหวัดคิดเป็นวัน : <?php echo $row['product_arrivetime_in'];?>   วัน</p>
      <p> ระยะเวลาส่งภายนอกจังหวัดคิดเป็นวัน:   <?php echo $row['product_arrivetime_out'];?>    วัน</p>
      <p>seller : <?php echo $row['user_username'];?> </p>
    </div>
    </div>
    <!-- collapse2 -->

   <!-- order add -->
    </div>
    </div>
 
<!-- Modal -->

  </div>
</div>
</div>
<?php
 } }else{
     echo"<div class='container'> ";
      echo "<h5 class='text-center text-danger'>Not Found!</h5>";
      echo"</div>";
  }

mysqli_close($conn);
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
