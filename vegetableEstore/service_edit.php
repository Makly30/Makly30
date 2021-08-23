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
 <!-- inside container -->
 <h4 class="text-center p-3"> My Service list: </h4>
   <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>เส้นทาง</th>
                                <th>ราคา</th>
                                <th>สถานะทำงาน</th>
                                <th>วันเดือนปีดำเนินงาน</th>
                                <th></th>
                            </tr>                
                        </thead>
                        <tbody>
      <?php
      include "connectdb.php";
    $sql="SELECT p.province_name pf, f.province_name pt,dc.d_ch_int,dc.deli_avtime_from, dc.deli_avtime_to,dc.deli_price,d_a.d_a_name active  from deliver_choices as dc join province as p on dc.deli_start=p.province_id join province as f on dc.deli_stop=f.province_id join deliver_active as d_a on d_ch_active=d_a.d_a_id where dc.deli_deliver_id='".$objResult['user_id']."' order by dc.d_ch_int desc;";
    $result = mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
        echo '<tr>';
        echo '<td>' . $row['d_ch_int']. '</td>';
        echo '<td>' . $row['pf'] .'   ไป   '. $row['pt'] . '</td>';
       
        echo '<td>' . $row['deli_price']. '</td>';
        echo '<td>' . $row['active']. '</td>';
        echo '<td>' . $row['deli_avtime_from'] .'  ถึง   '. $row['deli_avtime_to'] . '</td>';


       
        echo '<td>';
?>
  <a href="service_edit_final.php?d_ch_int=<?php echo $row['d_ch_int'];?>" class="btn btn-warning">แก้ไข</a>
                                <!-- <a href="JavaScript:if(confirm('ยืนยันการลบ')==true){window.location='service_delete1.php?d_ch_int=<?php echo $row["d_ch_int"];?>'}" class="btn btn-danger">ลบ</a> -->
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








