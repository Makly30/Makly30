<?php
	session_start(); 
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "ADMIN")
	{
		echo "This page for Admin only!";
		exit();
	}	
	
	include 'connectdb.php';
	
	$strSQL = "SELECT * FROM customer WHERE cus_id= '".$_SESSION['UserID']."' ";
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
          <a class="nav-link "  href="indexadmin.php">เกี่ยวกับร้าน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="menu_admin.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="orderlistadmin.php">สั่งซื้อOnline</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="promotionadmin.php">Promotion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="customer_list.php">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="employer_list.php">Employer</a>
        </li>
    </div>
  </div>
</nav>
      </div>
      <div class="container">
    
     
      <div class="col-sm-12 col-md-9 col-lg-9">
                  
                <h4>แก้ไขข้อมูล</h4>    
                <?php
                    include 'connectdb.php';
                    if(isset($_GET['submit'])){
                        $pro_id     = $_GET['pro_id'];
                        $pro_name  = $_GET['pro_name'];
                        $pro_condition=$_GET['pro_condition'];
                        $deadline=$_GET['deadline'];
                        $pro_discount=$_GET['pro_discount'];
                    
                        $sql        = "update promotion set pro_name='$pro_name' ,pro_condition='$pro_condition',deadline='$deadline',pro_discount='$pro_discount' where pro_id='$pro_id'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                        echo " แก้ไขข้อมูล Promotion เรียบร้อยแล้ว<br>";
                        echo '<a href="promotionadmin.php">แสดงข้อมูลพนักงานทั้งหมด</a>';
                    }else{
                        $fpro_id = $_REQUEST['pro_id'];
                        $sql =  "SELECT * FROM promotion
                         where pro_id='$fpro_id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $fpro_name = $row['pro_name'];
                        $fpro_condition=$row['pro_condition'];
                        $fdeadline=$row['deadline'];
                        $fpro_discount=$row['pro_discount'];
                        
                        mysqli_free_result($result);
                        mysqli_close($conn);                        
                ?>
                    <form class="form-horizontal" role="form" name="em_edit" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="pro_id" id="pro_id" value="<?php echo "$fpro_id";?>">
                        <div class="form-group">
                            <label for="pro_name" class="col-md-2 col-lg-2 control-label">ชื่อ Promotion</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="pro_name" id="pro_name" class="form-control" value="<?php echo "$fpro_name";?>">
                            </div>   
                            <div class="form-group">
                            <label for="pro_condition" class="col-md-2 col-lg-2 control-label">เงือนไข</label>
                            <div class="col-md-10 col-lg-10"> 
                                <textarea name="pro_condition" rows="5" id="pro_condition" class="form-control"><?php echo $fpro_condition; ?></textarea>
                                <br>
                            </div>    
                        </div>  
                        </div>
                        <div class="form-group">
                            <label for="deadline" class="col-md-2 col-lg-2 control-label">Deadline</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="deadline" id="deadline" class="form-control" value="<?php echo "$fdeadline";?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="pro_discount" class="control-label">Discount Percent%</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="pro_discount" id="pro_discount" class="form-control" value="<?php echo "$fpro_discount";?>">
                            </div>    
                        </div>
        

                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-default">
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