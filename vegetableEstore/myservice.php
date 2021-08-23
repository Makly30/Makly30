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
          <a class="dropdown-item active" href="myservice.php">My Service</a>
          <a class="dropdown-item" href="list_order_service.php">My Order Service</a>
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
 
      <?php
    include 'connectdb.php';
    $sql="SELECT deliver_choices.d_ch_date,deliver_choices.d_ch_int,deliver_choices.deli_price,deliver_choices.deli_pic,deliver_choices.deli_avtime_to,deliver_choices.deli_avtime_from,user_username pk,p1.province_name ps, p2.province_name pt,deliver_choices.deli_time,deliver_choices.d_ch_active,deliver_choices.deli_start,deliver_choices.deli_stop from deliver_choices join user on deliver_choices.deli_deliver_id=user.user_id  join province as p1 on deliver_choices.deli_start=p1.PROVINCE_ID join province as p2 on deliver_choices.deli_stop=p2.PROVINCE_ID join deliver_active on deliver_choices.d_ch_active=deliver_active.d_a_id  where user.user_id='".$_SESSION['UserID']."' and deliver_active.d_a_id=2 order by deliver_choices.d_ch_int desc;";
$result=mysqli_query($conn,$sql);

?>
    
      <h2 class='text-center pt-4'>My Service Daily List:</h2>
                    <a href="service_add.php" class="btn btn-link">เพิ่มService</a>
                    <a href="service_edit.php" class="btn btn-link">แก้ไข</a>  
 
 <div class="row">
 <?php 

while (($row= mysqli_fetch_array($result,MYSQLI_ASSOC))){?>
<div class="col-4">
     <div class="card mt-4" style="width: 18rem;">
     <img src="<?php echo $row['deli_pic']; ?>" class="card-img-top" alt="<?php echo $row['pk'];?> " height="180">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['ps'] ;?> ไป  <?php echo $row['pt'] ;?></h5>
    <h5 class="card-title">ราคาส่ง:   <?php echo $row['deli_price'] ;?> บาท</h5>
    <h5 class="card-title">เวลาดำเนินงาน:   <?php echo $row['deli_time'] ;?>  ชั่วโมง</h5>
    <h5 class="card-title">ผู้ให้บริการส่ง:   <?php echo $row['pk'] ;?> </h5>
    <!-- <a href="#" class="btn btn-primary">Detail</a> -->
<!-- collapse medal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> >
 Detail
</button>  -->
<!-- medal -->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne<?=$row['product_id']?>">
      <h4 class="panel-title">
        <button type="button"  class="btn btn-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$row['d_ch_int']?>" aria-expanded="false" aria-controls="collapseOne<?=$row['product_id']?>">
         Detail
        </button>

        <!-- // if condiction -->
<?php 
      if ($row['d_ch_active']==1){
       echo  "<button type='button'  class='btn btn-danger'  href='#'>
       Busy
       </button>";
      
      }else{
        echo  "<button type='button'  class='btn btn-success'  href='#'>
        Available
       </button>";
      //  echo  "<button type='button'  class='btn btn-info ml-1'  href='#'>
      //  Order
      //  </button>";
      }
?>
        <!-- if condition -->
        <!-- <button type="button"  class="btn btn-success" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?=$row['product_id']?>" aria-expanded="false" aria-controls="collapseTwo<?=$row['product_id']?>">
         Order
        </button> -->
      </h4>
    </div>
    <!-- collapse1 -->
    <div id="collapseOne<?=$row['d_ch_int']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?=$row['product_id']?>">
      <div class="panel-body">
        <!-- body -->
<h5 class="text-success ">Start Time:   <?php echo $row['deli_avtime_from'];?></h5>
<h5 class="text-danger ">Stop Time:   <?php echo $row['deli_avtime_to'];?></h5>
<p>Post Time:   <?php echo $row['d_ch_date'];?></p>
    </div>
    </div>
<!-- medal -->
</div>
</div>
    </div>

 </div>
      </div>
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








