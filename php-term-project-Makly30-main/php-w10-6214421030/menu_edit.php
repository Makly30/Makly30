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
          <a class="nav-link " href="indexadmin.php">เกี่ยวกับร้าน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="menu_admin.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orderlistadmin.php">สั่งซื้อOnline</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="promotionadmin.php">Promotion</a>
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
                  
                <h4>แก้ไขเมนู</h4>    
                <?php
                    include 'connectdb.php';
                    if(isset($_GET['submit'])){
                        $menu_id     = $_GET['menu_id'];
                        $menu_name   = $_GET['menu_name'];
                        $menu_size=$_GET['menu_size'];
                        $menu_type=$_GET['menu_type'];
                        $price=$_GET['price'];
                        $sql        = "update menu set menu_name='$menu_name' ,menu_type='$menu_type',menu_size='$menu_size',price='$price' where menu_id='$menu_id'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                        echo " แก้ไขเมนู $menu_name เรียบร้อยแล้ว<br>";
                        echo '<a href="menu_admin.php">แสดงเมนูทั้งหมด</a>';
                    }else{
                        $fmenu_id = $_REQUEST['menu_id'];
                        $sql =  "SELECT * FROM menu where menu_id='$fmenu_id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $fmenu_name = $row['menu_name'];
                        $fmenu_type=$row['menu_size'];
                        $fmenu_size=$row['menu_size'];
                        $fprice=$row['price'];
                        mysqli_free_result($result);
                        mysqli_close($conn);                        
                ?>
                    <form class="form-horizontal" role="form" name="menu_add" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="menu_id" id="menu_id" value="<?php echo "$fmenu_id";?>">
                        <div class="form-group">
                            <label for="menu_name" class="col-md-2 col-lg-2 control-label">ขื่อเมนู</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="menu_name" id="menu_name" class="form-control" value="<?php echo "$fmenu_name";?>">
                            </div>    
                        </div>
                        <div class="form-group">
                        <div class="col-md-10 col-lg-10">
                            <label for="menu_type" class="col-md-2 col-lg-2 control-label">ประเภท</label>
                                <select name="menu_type" id="menu_type" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  "SELECT * FROM type1 order by t_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['t_id'].'"';
                                        if($row['t_id']==$fmenu_type){
                                            echo ' selected="selected" ';
                                        }
                                        echo ">";
                                        echo $row['t_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>
                     
                        <div class="form-group">
                        <div class="col-md-10 col-lg-10">
                            <label for="menu_size" class="col-md-2 col-lg-2 control-label">ประเภท</label>
                                <select name="menu_size" id="menu_type" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  "SELECT * FROM size order by s_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['s_id'].'"';
                                        if($row['s_id']==$fmenu_size){
                                            echo ' selected="selected" ';
                                        }
                                        echo ">";
                                        echo $row['s_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>
                     
                        <div class="form-group">
                            <label for="price" class="col-md-2 col-lg-2 control-label">ราคา</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="price" id="price" class="form-control" value="<?php echo "$fprice";?>">
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