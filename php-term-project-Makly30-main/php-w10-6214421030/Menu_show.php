
<?php
session_start();
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
          <a class="nav-link " aria-current="page" href="index.php">เกี่ยวกับร้าน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="Menu_show.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order_show.php">สั่งซื้อOnline</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="promotion_list.php">Promotion</a>
        </li>
    </div>
  </div>
</nav>
      </div>
      <div class="container">
      <?php
      if(!$_SESSION["Status"]){  echo "<h1>Please login first!</h1>";?>
  <p>Click here to Login: <a href="login.php" title="login">Login.</a></p>
  <?php
      }
      
      else if($_SESSION["Status"]) {
                ?>
                Welcome
                <?php 
                include 'connectdb.php';
                $sql = " SELECT * FROM customer where cus_id='".$_SESSION['UserID']."' ";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo $_SESSION["Status"];
                echo "(  ". $row['Username']."  )"  ?>
                <p>Click here to <a href="logout.php" tite="Logout">Logout</a></p>
                <?php
                }
                else if($_SESSION["Status"]=NULL) { echo "<h1>Please login first!</h1>";?>
                <p>Click here to Login: <a href="login.php" title="login">Login.</a></p>
                <?php
                } 
                else if(!$_SESSION["Status"]){ echo "<h1>Please login first!</h1>";?>
                  <p>Click here to Login: <a href="login.php" title="login">Login.</a></p> <?php 
                  }
?>
<?php 
$image=array("cake1.jpg"," bubble1.jpg","bananacupcake.jpg","lemon.jpg","chocolate.jpg","pancake1.jpg");
include 'connectdb.php';
$sql="SELECT menu.menu_id,menu.menu_name,type1.t_name,size.s_name,menu.price,menu_pic from menu join type1 on menu.menu_type=type1.t_id join size on menu.menu_size=size.s_id;";
$result=mysqli_query($conn,$sql);

?>
<h5>All Menu</h5>
<div class="row">
<?php 

while (($row= mysqli_fetch_array($result,MYSQLI_ASSOC))){?>
<div class="col-4">
<div class="card" style="width: 20rem;">
<img src="<?php echo $row['menu_pic']; ?>" class="card-img-top" height="318">
<div class="card-body">
<h5 class="card-title"><?php echo $row['menu_id']."\t". $row['menu_name']."\t(".$row["t_name"].")\t ขนาด\t".$row['s_name'];?></h5>
<p class="card-text text-danger"><?php echo $row['price'];?></p>
<a href="order_add.php?menu_id=<?php echo $row['menu_id'];?>" class="btn btn-success">Order</a>
</div>
  </div>
</div>
<?php
}

?>

<!--
      <h4>เครื่องดืม</h4>
      <div class="row">
      <div class='col-4'>
      <div class="card" style="width: 20rem;">
  <img src="bubble1.jpg" class="card-img-top" alt="bubble 1" height="318" >
  <div class="card-body">
    <h5 class="card-title">ชานมไต้หวันมุก&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspขนาด M </h5>
    <p class="card-text text-danger">30 บาท</p>
    <a href="order_add.php?menu_id=<?php echo $row['menu_id'];?>" class="btn btn-warning">แก้ไข</a>
    <a href="order_add.php" class="btn btn-primary">สั่งซื้อ</a>
    </div>
  </div>
</div>
<div class='col-4'>
<div class="card" style="width: 20rem;">
  <img src="ชามะนาว.jpg" class="card-img-top" alt="ชามะนาว 1" height="318" >
  <div class="card-body">
    <h5 class="card-title">ชามะนาว&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspขนาด S </h5>
    <p class="card-text text-danger">24 บาท</p>
    <a href="order_add.php" class="btn btn-primary">สั่งซื้อ</a>
  </div>
  </div>
</div>
<div class='col-4'>
<div class="card" style="width: 20rem;">
  <img src="chocolate.jpg" class="card-img-top" alt="ชามะนาว 1"height="318"  >
  <div class="card-body">
    <h5 class="card-title">ชานมโกโก้&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspขนาด S </h5>
    <p class="card-text text-danger">24 บาท</p>
    <a href="order_add.php" class="btn btn-primary">สั่งซื้อ</a>
  </div>
  </div>
</div>
                   
      </div>
      <h4 class='mt-4'>ขนมหวาน</h4>
      <div class="row">
      <div class='col-4'>
      <div class="card" style="width: 20rem;">
  <img src="cake1.jpg" class="card-img-top" alt="bubble 1" height="318" >
  <div class="card-body">
    <h5 class="card-title">เค้กไข่ไต้หวัน&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspขนาด S </h5>
    <p class="card-text text-danger">35 บาท</p>
    <a href="order_add.php" class="btn btn-primary">สั่งซื้อ</a>
    </div>
  </div>
</div>
<div class='col-4'>
<div class="card" style="width: 20rem;">
  <img src="pancake1.jpg" class="card-img-top" alt="ชามะนาว 1" height="318" >
  <div class="card-body">
    <h5 class="card-title">PanCake&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspขนาด S </h5>
    <p class="card-text text-danger">35 บาท</p>
    <a href="order_add.php" class="btn btn-primary">สั่งซื้อ</a>
  </div>
  </div>
</div>
<div class='col-4'>
<div class="card" style="width: 20rem;">
  <img src="bananacupcake.jpg" class="card-img-top" alt="ชามะนาว 1" height="318" >
  <div class="card-body">
    <h5 class="card-title">Banana Cup Cake&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspขนาด S </h5>
    <p class="card-text text-danger">15 บาท</p>
    <a href="order_add.php" class="btn btn-primary">สั่งซื้อ</a>
  </div>
  </div>
</div>
           
      </div>-->
      </div>
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>