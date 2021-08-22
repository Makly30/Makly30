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

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed">
  <div class="container-fluid">
    <a class="navbar-brand " href="#">Vegetable E-store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="optionchoice.php"  >Login/SignUp</a>
        </li>
      </ul>

    </div>
  </div>
</nav>
<!-- menubar -->
      <div class="container">
      <div class="row">
      <div  class="col-sm-8">
        
                <h4 class='text-info pt-4'><b>Login</b></h4>
                <form name="form1" method="post" action="check_login.php">
                    <div class="form-group">
                     <label class="col-md-2 col-lg-2 control-label">User Name</label>
                     <div class="col-md-10 col-lg-10">
                     <input type="text" name="txtUsername"class="form-control"id="txtUsername" placeholder="User Name">
                  </div>
                <br>
                <br>
                 
                  <div class="form-group">
                     <label class="col-md-2 col-lg-2 control-label">Password</label>
                     <div class="col-md-10 col-lg-10">
                     <input type="password" name="txtPassword"  class="form-control"name="txtPassword"  placeholder="Password">
                  </div>
                  </div>

  <div class="form-group">
  <button type="submit" class="btn btn-success" name="Submit" value="Login">Login</button>
 </div>
</form>

<small >Don't hava an account</small><a href="register.php">Sign Up</a>
      </div>
     </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>