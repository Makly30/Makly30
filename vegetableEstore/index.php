
<!doctype html>
<html lang="en">
  <head>
    <title>Vegetable E-store</title>
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

      <!-- menu navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed">
  <div class="container-fluid">
    <a class="navbar-brand " href="#">Vegetable E-store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="optionchoice.php"  >Login/SignUp</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search for product" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </div>
  </div>
</nav>
    <!-- menu navbar -->
    <!-- php for get products -->
    <?php
    include 'connectdb.php';
    $sql="SELECT product_name,product_deli_price,province_name,product_available_p,product_deli_price_out,product_start,product_stop,product_arrivetime_in,product_arrivetime_out, product_price,product_pic,product_amount, user_username ,product_measure from products join user on products.product_owner=user.user_id join province on products.product_from=province.PROVINCE_ID;";
$result=mysqli_query($conn,$sql);

?>

    <!-- php for get products -->
      <div class="container">
    
    
     <h1 class='text-center text-info pt-4 pb-3'>Vegetable Boards:</h1>   
     
  <div class="row">
  <?php 

while (($row= mysqli_fetch_array($result,MYSQLI_ASSOC))){?>
<div class="col-4">
     <div class="card mt-4" style="width: 18rem;">
     <img src="<?php echo $row['product_pic']; ?>" class="card-img-top" alt="<?php echo $row['product_name'];?> " height="180">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['product_name'] ;?></h5>
    <p class='card-text text-info '>น้ำหนัก <?php echo $row['product_measure'];?> กิโลกรัม</p>
    <p class="card-text text-success h6">ราคา <?php echo $row['product_price'];?> บาท</p>
    <p class="card-text text-primary h6">seller : <?php echo $row['user_username'];?> </p>
    <!-- <a href="#" class="btn btn-primary">Detail</a> -->
<!-- collapse medal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Detail
</button>

<!-- Modal -->

<!-- collapse medal -->
  </div>
</div>
</div>
<?php
}

?>
     </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>