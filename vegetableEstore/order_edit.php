
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
		echo "This page for ADMIN only!";
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
          <a class="dropdown-item" href="#">Delivery Service</a>
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

     <!-- navbar -->
      <div class="container">
	  <div class="col-sm-12 col-md-9 col-lg-9">
                  
				  <h4>แก้ไขข้อมูล</h4>               
	  <?php
                    include 'connectdb.php';
                    if(isset($_GET['submit'])){
                        $orp_id= $_GET['orp_id'];
						$orp_amount=$_GET['orp_amount'];
					
                        $orp_dc=$_GET['orp_dc'];
                        $orp_tr_id=$_GET['orp_tr_id'];
                        $sql        = "update order_product set orp_amount='$orp_amount',orp_dc='$orp_dc',orp_tr_id='$orp_tr_id' where orp_id='$orp_id'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                        echo " แก้ไขOrderลูกค้า เรียบร้อยแล้ว<br>";
                        echo '<a href="orderlistadmin.php">แสดงOrderลูกค้าทั้งหมด</a>';
                    }else{
                        $forp_id = $_REQUEST['orp_id'];
                        $sql =  "SELECT order_product.orp_amount,order_product.orp_dc,user.user_address ,order_product.orp_tr_id FROM order_product join user on order_product.orp_cus_id=user.user_id where orp_id='$forp_id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                       $forp_tr_id=$row['orp_tr_id'];
                        $forp_amount=$row['orp_amount'];
                     
					           
                        $forp_dc=$row['orp_dc'];
                        mysqli_free_result($result);
                        mysqli_close($conn);                        
                ?>
				
				 <form class="form-horizontal" role="form" name="order_edit" action="<?php echo $_SERVER['PHP_SELF']?>">
         <input type="hidden" name="orp_id" id="orp_id" value="<?php echo "$forp_id";?>">
                  <div class='form-group'>
                   <select name="orp_dc" id="orp_dc" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT * FROM customer_deliver order by cu_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['cu_id'] . '"';
										if($row['cu_id']==$forp_dc){
                                            echo ' selected="selected" ';
                                        }
										echo ">";
                                        echo $row['cus_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                </div>
                                <div class='form-group'>
                                
                               
                                <div class="form-group">
                            <label for="orp_amount" class="col-md-2 col-lg-2 control-label">จำนวน</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="number" name="orp_amount" id="orp_amount" class="form-control" value="<?php echo $forp_amount ;?>">
                            </div>  
        
<!-- orp_tr_id -->
<div class="form-group">
                            <label for="orp_tr_id" class="col-md-2 col-lg-2 control-label">Tracking Code</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="orp_tr_id" id="orp_tr_id" class="form-control" value="<?php echo $forp_tr_id ;?>">
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
				</div>
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>