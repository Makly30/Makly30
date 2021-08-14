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
 <div class="col-sm-12 col-md-9 col-lg-9">
                  
				  <h4 class="text-center pt-3">แก้ไขข้อมูล</h4>               
	  <?php
                    include 'connectdb.php';
                    if(isset($_GET['submit'])){
                        $dc_id= $_GET['d_ch_int'];
                        $deli_time=$_GET['deli_time'];
                     
                        $d_a_id=$_GET['d_a_id'];
                        $sql        = "update deliver_choices set deli_time='$deli_time',d_ch_active='$d_a_id' where d_ch_int='$dc_id'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                        echo " แก้ไขMy service เรียบร้อยแล้ว<br>";
                        echo '<a href="myservice.php">แสดงMy service list ทั้งหมด</a>';
                    }else{
                        $fdc_id = $_REQUEST['d_ch_int'];
                        $sql =  "SELECT deli_start, deli_stop,deli_time,d_ch_active, deli_avtime_from,deli_avtime_to  from deliver_choices  where d_ch_int='$fdc_id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                     
                        $fdc_time=$row['deli_time'];
                        $fmenu_id=$row['d_ch_active'];
                        mysqli_free_result($result);
                        mysqli_close($conn);                        
                ?>
				
				 <form class="form-horizontal" role="form" name="order_edit" action="<?php echo $_SERVER['PHP_SELF']?>">
         <input type="hidden" name="d_ch_int" id="orp_id" value="<?php echo "$fdc_id";?>">
                  <!-- copy code  -->

                  <!--  -->
                                                  <!-- service activate -->
                        <div class="form-group">
                        <label for="d_a_id" class="col-md-2 col-lg-8 control-label">สถานะ</label>
                        <div class="col-md-10 col-lg-10">
                                <select name="d_a_id" id="d_a_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT * FROM deliver_active order by d_a_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['d_a_id'] . '"';
										if($row['d_a_id']==$fmenu_id){
                                            echo ' selected="selected" ';
                                        }
										echo ">";
                                        echo $row['d_a_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>
                           <!-- ระยะเวลาถีง -->
                           <div class="form-group">
                            <label for="deli_time" class="col-md-2 col-lg-4 control-label">ระยะเดินทาง คิดเป็นชั่วโมง</label>
                            <div class="col-md-10 col-lg-10">
                            <input name='deli_time' type="number" min="0" value="<?php echo $fdc_time; ?>">
                            </div>    
                        </div>
                        <!-- date available -->
                        

                        <!-- pic -->

                        <!-- copy code  -->
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
 <!-- inside container -->
      </div>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>








