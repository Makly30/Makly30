
</html>
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
      <form name="form1" method="post" action="save_register.php">
      <a href="login.php">Login/Sign Up</a>
      <h6>Contact Us</h6>

      </div>
      <div  class="col-sm-8">
     
    
      <h4 class='text-primary'><b>Register Form</b></h4>
   <div class="form-group ">
   <label>Username</label>
   <input name="txtUsername" type="text" id="txtUsername"class='form-control' >
   </div>
   <div class="form-group ">
   <label>First Name</label>
   <input name="txtfName" type="text" id="txtfName" class='form-control' >
   </div>
   <div class="form-group ">
   <label>Last Name</label>
   <input name="txtlName" type="text" id="txtlName" class='form-control' >
   </div>
   <div class="form-group ">
   <label>Password</label>
   <input name="txtPassword" type="password" id="txtPassword" class='form-control'>
   </div>
 
   <div class="form-group ">
   <label>Confirm Password</label>
   <input name="txtConPassword" type="password" id="txtConPassword" class='form-control' >
   </div>
   <div class="form-group">             
                        <label >Phone</label>
                                <input type="text" name="cus_phone" id="cus_phone" class="form-control">
                           </div>
                        <div class="form-group">
                            <label >ที่อยู่</label>
                                <textarea name="cus_address" rows="5" id="cus_address" class="form-control"></textarea>  
                        </div> 
   <div class="form-group ">
   <label>Status</label>
   <select name="ddlStatus" id="ddlStatus" class='form-control'>
            <option value="ADMIN">ADMIN</option>
            <option value="USER">USER</option>
          </select>
   </div>
  
  <div class="form-group">
  <button type="submit" class="btn btn-success" name="Submit" value="Save">Sign Up</button>
 </div>
</form>
<br>
<small>Have an account?</small>
<a href="login.php">Login</a>
      </div>
     </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>