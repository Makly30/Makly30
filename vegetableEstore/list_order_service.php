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
          <a class="dropdown-item " href="myservice.php">My Service</a>
          <a class="dropdown-item active" href="list_order_service.php">My Order Service</a>
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
      <a href="graph_all_data_deliver.php" class="btn btn-danger mt-4">ยอดสรุปร่วม</a>
 <!-- inside container -->
 <h4 class="text-center p-3"> My order list: </h4>
   <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>Customer Name</th>
                               
                                <th>ราคาสรุป</th>
                                <th>Tracking Code</th>
                                <th>วันเดือนปีดำเนินงาน</th>
                            </tr>                
                        </thead>
                        <tbody>
      <?php
      include "connectdb.php";
    $sql="SELECT d.dl_id, s.user_username, tracking.tr_id,dc.deli_price, d.dl_datetime FROM deliver_list as d join user as s on d.dl_s_id=s.user_id join deliver_choices as dc on d.dl_dc_id=dc.d_ch_int join user as k on d.dl_deli_id=k.user_id join tracking on d.dl_id=tracking.tr_de_list_id where dc.deli_deliver_id='".$objResult['user_id']."';";
    $result = mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
        echo '<tr>';
        echo '<td>' . $row['dl_id'] . '</td>';
       
        echo '<td>' . $row['user_username']. '</td>';
        echo '<td>' . $row['deli_price']. '</td>';
        echo '<td>' . $row['tr_id']. '</td>';
        echo '<td>' . $row['dl_datetime'] . '</td>';


       
        echo '<td>';
?>
  <a href="update_location.php?dl_id=<?php echo $row['dl_id'];?>" class="btn btn-success">Update Location</a>
  <a href="list_order_detail.php?dl_id=<?php echo $row['dl_id'];?>" class="btn btn-info">ดูรายละเอียด</a>
                                <a href="JavaScript:if(confirm('ยืนยันการลบ')==true){window.location='service_delete.php?dl_id=<?php echo $row["dl_id"];?>'}" class="btn btn-danger">ลบ</a>
                            <?php
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                mysqli_free_result($result);
                            mysqli_close($conn);
                            ?>
                        </tbody>    
                    </table>

 <!-- inside container -->
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>








