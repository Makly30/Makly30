<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
        header("location:login.php");
       
		exit();
	}

	if($_SESSION['Status'] != "USER")
	{
		echo "This page for User only!";
		exit();
	}	
	
	include 'connectdb.php';
	$strSQL = "SELECT * FROM customer WHERE cus_id = '".$_SESSION['UserID']."' ";
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
  <?php if($_SESSION["Status"]) {
?>
Welcome
 <?php echo $_SESSION["Status"]; ?>. Click here to <a href="logout.php" tite="Logout">Logout.
<?php

}else if($_SESSION['Status']=NULL){ echo "<h1>Please login first .</h1>";} 
?>
      <div class="jumbotron" style="background-color:#f5b7b1;color:#21618c">
       <?php
       include "menu.php";
       ?>
      </div>
      <div class="container">
    
     
      <div class="col-sm-12 col-md-9 col-lg-9">
      <h6>คุณกำลังใช้บัญชี : <?php echo $objResult['Username'] ?> </h6>
     <!--<p class='text-danger'>กรุณาใส่ข้อมูลให้ถูกต้องตาราง เพราะระบบจะดำเนินงานตามข้อมูลในตาราง</p>-->
    
                <h4>เพิ่มออเดอร์</h4>    
                <?php
                    if(isset($_GET['submit'])){
                        
                  
                        $menu_id=$_GET['menu_id'];
                        $amount=$_GET['amount'];
                        $cus_id=$_GET['cus_id'];
                        $em_id=$_GET['em_id'];
                        
                        $pro_id=$_GET['pro_id'];
                        $o_addtition=$_GET['o_addtition'];
                        $sql = "insert into order_online(menu_id,amount,pro_id,o_addtition,cus_id,delivery_price,em_id,date_process)";
                        $sql .=" values ('$menu_id','$amount','$pro_id','$o_addtition','$cus_id',9,'$em_id',CURRENT_TIMESTAMP)";
                        //echo $sql;
                        include 'connectdb.php';
                        mysqli_query($conn,$sql);
                        
                        mysqli_close($conn);
                        echo "เพิ่มOrder เรียบร้อยแล้ว<br>";
                        echo '<a href="order_show.php">แสดงออเดอร์ทั้งหมด</a>';
                    }else{
                ?>
               
                    <form class="form-horizontal" role="form" name="order_add" action="<?php echo $_SERVER['PHP_SELF']?>">
                  <div class='form-group'>
                   <select name="menu_id" id="menu_id" class="form-control">
                                <?php
                                $menu_id=$_GET['menu_id'];
                                    include 'connectdb.php';
                                    $sql = " SELECT * FROM menu where menu_id=".$menu_id.";";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['menu_id'] . '">';
                                        echo $row['menu_name'];
                                        echo '</option>';
                                    }
                    
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                </div>
                                <div class='form-group'>
                   <select  class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT size.s_name,size.s_id,menu.menu_id FROM size  join menu on menu.menu_size=size.s_id where menu.menu_id=".$menu_id.";";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['s_id'] . '">';
                                        echo $row['s_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                </div>
                                <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อโปรโมชั่น</th>
                                <th>เงือนไข</th>
                                <th>ส่วนลด</th>
                                <th>วันหมดอายุ</th>
                            </tr>                
                        </thead>
                        <tbody>
      <?php
    include "connectdb.php";
    $sql="SELECT pro_id,pro_name,pro_condition,pro_discount,deadline FROM `promotion` ";
    $result = mysqli_query($conn,$sql);
    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
        echo '<tr>';
        echo '<td>' . $row['pro_id'] . '</td>';
        echo '<td>' . $row['pro_name'] . '</td>';
        echo '<td>' . $row['pro_condition'] . '</td>';
        echo '<td>' . $row['pro_discount'] . '</td>';
        echo '<td>' . $row['deadline'] . '</td>';}

mysqli_free_result($result);
mysqli_close($conn);
?>
     </tr>
</tbody>
</table>

<div class='form-group'>
<label class="col-md-2 col-lg-2 control-label">ชื่อ นามสกุล ลูกค้า </label>
                   <select name="cus_id" id="cus_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT * FROM customer where cus_id='".$_SESSION['UserID']."' ";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['cus_id'] . '">';
                                       // echo $row['cus_fname'].''.$row['cus_lname'];
                                       echo $objResult['cus_fname'].''.$objResult['cus_lname'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                </div>


                                <div class='form-group'>
                                <label class="col-md-2 col-lg-2 control-label">รหัสโปรโมชั่น</label>
                   <select name="pro_id" id="pro_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql = " SELECT * FROM promotion order by pro_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['pro_id'] . '">';
                                        echo $row['pro_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                <small class='text-danger'>กรุณาเลือกให้ถูกตามเงื่อนไขในตาราง</small>
                                </div>
                               
                                <div class="form-group">
                            <label for="amount" class="col-md-2 col-lg-2 control-label">จำนวน</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="amount" id="amount" class="form-control">
                            </div>  
                            <label  class="col-md-2 col-lg-2 control-label">เพิ่มเติ่ม</label>
                            <div class="col-md-10 col-lg-10">
                                <textarea name='o_addtition' id='o_addtition' class='form-control'> </textarea>
                            </div> 
                            <div class='form-group'> 
                                <label > Delivery Price :<span class='text-danger'>  9บาท</span></label>
                                 
                               
                                </div>
                                <div class='form-group'>
                                <label class="col-md-2 col-lg-2 control-label">พนักงาน</label>
                   <select name="em_id" id="em_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $position="cashier";
                                    $sql = " SELECT * FROM employer where em_position='".$position."';";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['em_id'] . '">';
                                        echo $row['em_fname'].' '.$row['em_lname'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
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