<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "seller")
	{
		echo "This page for Admin only!";
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
<!-- navbar -->
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
          <a class="dropdown-item active" href="orderlistadmin.php">My Order</a>
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
<!-- navbar -->
<div class="container"> 
<div class="row">
  <div class="col-3">
    <a href="graph_all_data.php" class="btn btn-danger mt-4">ยอดสรุปร่วม</a>
  </div>
  <div class="col-6">
    <br>
    <form class="form-inline my-2 my-lg-1 col-9" action="orderlistadmin_day.php">
      <input class="form-control mr-sm-2 col-7" name="search_day" type="search" placeholder="ระบุ ปี-เดือน-วันที่" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">ค้นหาตามวัน</button>
    </form>
  </div>
</div>


  <h4 class="text-center p-3"> My order list: </h4>
   <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>Customer Name</th>
                               
                                <th>ราคาสรุป</th>
                                <th>วันเดือนปีดำเนินงาน</th>
                            </tr>                
                        </thead>
                        <tbody>
      <?php
      include "connectdb.php";
    $sql="select a.orp_id,a.orp_dc,k.user_username uk,tracking.tr_id,round((a.orp_amount/p.product_measure) * p.product_price+p.product_deli_price_out,2) total_out,round((a.orp_amount/p.product_measure) * p.product_price+p.product_deli_price,2) total_in ,a.orp_datetime from order_product as a join products as p on a.orp_pr_id=p.product_id join user as u on p.product_owner=u.user_id join tracking on a.orp_tr_id=tracking.tr_id join province as pr on p.product_from=pr.province_id join user as k on a.orp_cus_id=k.user_id where u.user_id='".$objResult['user_id']."' order by a.orp_id;";
    $result = mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
        echo '<tr>';
        echo '<td>' . $row['orp_id'] . '</td>';
       
        echo '<td>' . $row['uk']. '</td>';
         
if ($row['orp_dc']==1){
// echo "<p>ราคาขนส่งภายนอกจังหวัด:   ".$row['product_deli_price_out']."</p>";
echo "<td>".$row['total_out']."</td>";
}else{
  // echo "<p>ราคาขนส่งภายในจังหวัด:  ".$row['product_deli_price']."</p>";
  echo "<td>".$row['total_in']."</td>";
}
        echo '<td>' . $row['orp_datetime'] . '</td>';


       
        echo '<td>';
?>
  <a href="order_edit.php?orp_id=<?php echo $row['orp_id'];?>" class="btn btn-warning">แก้ไข</a>
  <a href="orderlist_1.php?orp_id=<?php echo $row['orp_id'];?>" class="btn btn-info">ดูรายละเอียด</a>
                                <a href="JavaScript:if(confirm('ยืนยันการลบ')==true){window.location='order_delete.php?orp_id=<?php echo $row["orp_id"];?>'}" class="btn btn-danger">ลบ</a>
                                <?php 
                                if ($row['tr_id']==0){
                                    echo '<span class="text-danger text-center"><b>ยังไม่ได้หาที่ส่ง</b></span>';
                                }
                                ?>
                            <?php
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                mysqli_free_result($result);
                            mysqli_close($conn);
                            ?>
                        </tbody>    
                    </table>
    


</div>
                    
         
    
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>