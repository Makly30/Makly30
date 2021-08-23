<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
        header("location:login.php");
       
		exit();
	}

	if($_SESSION['Status'] != "customer")
	{
		echo "This page for User only!";
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
          <a class="nav-link " href="index_user.php">Home</a>
        </li>
        <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="user_page.php">My Personal Info</a>
          <a class="dropdown-item active" href="order_show.php">My Order</a>
          <div class="dropdown-divider"></div>
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
<!-- navbar -->
      <div class="container">
      
                  <h2>Order List: </h2>
                    <p class='text-danger'>(!กรณีต้องการแก้ไขการออเดอร์,  กรุณาติดต่อทางร้านด่วน)</p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อเมนู </th>
                               
                                <th>ราคาสรุป</th>
                                <!-- <th>เวลาดำเนินงาน</th> -->
                                
                            </tr>                
                        </thead>
                        <tbody>
      <?php
      include "connectdb.php";
    $sql="select a.orp_id,p.product_name, u.user_username,a.orp_dc, a.orp_amount,round((a.orp_amount/p.product_measure) * p.product_price+p.product_deli_price,2) total_in ,round((a.orp_amount/p.product_measure) * p.product_price+p.product_deli_price_out,2) total_out from order_product as a join user as u on a.orp_cus_id=u.user_id join products as p on a.orp_pr_id=p.product_id where u.user_id
    =".$objResult['user_id']." order by a.orp_id;";
    $result = mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
        echo '<tr>';
        echo '<td>' . $row['orp_id'] . '</td>';
       
        echo '<td>' . $row['product_name'].'</td>';

        if ($row['orp_dc']==1){
  
        echo "<td>".$row['total_out']."</td>";
   
        }else{
     
          echo "<td>  ".$row['total_in']."</td>";}
      

        echo '<td>';
?>
 <!-- <a href="order_edit.php?o_id=<?php //echo $row['o_id'];?>" class="btn btn-warning">แก้ไข</a>-->
  <a href="order_list.php?orp_id=<?php echo $row['orp_id'];?>" class="btn btn-info ">ดูรายละเอียด</a>
                             
                            <?php
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                mysqli_free_result($result);
                            mysqli_close($conn);
                            ?>
                        </tbody>    
                    </table>
      </div><?php 
    } else{echo " (คุณยังไม่ได้ทำรายการสั่งซื้อ) ";}?>   


         
    
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>