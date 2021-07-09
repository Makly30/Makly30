
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
       <?php
       include "menu.php";
       ?>
      </div>
      <div class="container">
    
    
      <div class="row">
      <div class="col-sm-4 border-right">
    <!--  <p> <a href="login.php"> Login</a> Or <a href="register.php">Sign Up</a></p>-->
     
      <h6>Contact Us</h6>

      </div>
      <div  class="col-sm-8">
      <h6>ร้านCoffee&Dessert</h6>
        <p>เป็นร้านที่มีที่ตั้งอยู่ในจันทบุรี บรรยากาศดีแบบธรรมชาติ มีที่จอดรถที่กวาง เมมูลากหลายของขนมหวานกันเครื่องดืม 
        เปิดให้บริการทุกวัน ตั้งแต่ 9โมงเช้า ถีง 6โมงเย็น สามารถทานที่ร้านหรือสั่งDeliveryตามออนไลน์ก็ได้</p>
        <p class='text-success'>Deliveryมีแค่ภายในอำเภอที่มีร้านอยู่ ราคาขนส่ง 9บาท</p>
        <p class='text-danger'>บริการสั่งซื้อในเว็บไซต์ดำเนินให้แก่ลูกค้าที่สั่งและต้องการขนส่งเท่านั้น</p>
      </div>
     </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>