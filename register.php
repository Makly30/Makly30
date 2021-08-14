
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
<!-- ajax -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
 
<style>


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
     <!-- menu bar -->
      <div class="container">
      <div class="row">
      <div  class="col-sm-8">
        <!-- php itself -->
<?php
        if(isset($_POST['submit'])){
                   
                   // check image
                   $target_dir = "";
                   $target_file =  basename($_FILES["fileToUpload"]["name"]);
                   $uploadOk = 1;
                   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                   
                     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                     if($check !== false) {
                      //  echo "File is an image - " . $check["mime"] . ".";
                       $uploadOk = 1;
                     } else {
                       echo "File is not an image.";
                       $uploadOk = 0;
                     }
                   
                   
                   // Check if file already exists
                   /*if (file_exists($target_file)) {
                     echo "Sorry, file already exists.";
                     $uploadOk = 0;
                   }*/
                   
                   // Check file size
                   if ($_FILES["fileToUpload"]["size"] > 500000) {
                     echo "Sorry, your file is too large.";
                     $uploadOk = 0;
                   }
                   
                   // Allow certain file formats
                   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                   && $imageFileType != "gif" ) {
                     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                     $uploadOk = 0;
                   }
                   
                   // Check if $uploadOk is set to 0 by an error
                   if ($uploadOk == 0) {
                     echo "Sorry, your file was not uploaded.";
                   // if everything is ok, try to upload file
                   } else {
                       include "connectdb.php";
                       // $menu_id=$_GET['product_id'];
                     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                         // sql for create sql

                         if(trim($_POST["txtUsername"]) == "")
                         {
                           echo "Please input Username!";
                           exit();	
                         }
                         
                         if(trim($_POST["txtPassword"]) == "")
                         {
                           echo "Please input Password!";
                           exit();	
                         }	
                           
                         if($_POST["txtPassword"] != $_POST["txtConPassword"])
                         {
                           echo "Password not Match!";
                           exit();
                         }
                         $strSQL = "SELECT * FROM user WHERE user_username = '".($_POST['txtUsername'])."' ";
                         $objResult = mysqli_query($conn,$strSQL);
                         $num=mysqli_num_rows($objResult);
                         if(!$num)
                         {
                           $strADD = "INSERT INTO user(user_username,user_email,user_fname,user_lname,user_password,user_phone,user_address,status,user_picture,user_province,user_amphur,user_commune) VALUES ('".$_POST["txtUsername"]."','".$_POST["txtEmail"]."','".$_POST["txtfName"]."','".$_POST["txtlName"]."',
                           '".$_POST["txtPassword"]."','".$_POST["cus_phone"]."','".$_POST["cus_address"]."','".$_POST["ddlStatus"]."','".$target_file."','".$_POST["province"]."','".$_POST["amphur"]."','".$_POST["district"]."')";
                           $objQuery = mysqli_query($conn,$strADD);
                          //  echo $strADD;
                           echo "Register Completed!<br>";		
                         
                          //  echo "<br> Go to <a href='login.php'>Login page</a>";
                         }
                         else
                         {	
                           echo "Username has already had!";
                           echo "<br> Go back to Sign Up again <a href='register.php'>Sign Up</a>";
                           
                         }
                            
       
                  
                     }}
                     mysqli_close($conn); 
                    //  echo "เพิ่มเมนูใหม่ เรียบร้อยแล้ว<br>";
                    //  echo '<a href="myproduct.php">แสดงเมนูทั้งหมด</a>';

                   }
                     else{

                    
                
             ?>
        <!-- php itself -->
      <form name="form1" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
    
      <h4 class='text-primary pt-4'><b>Register Form</b></h4>
   <div class="form-group ">
   <label>Username</label>
   <input name="txtUsername" type="text" id="txtUsername"class='form-control' >
   </div>
   <div class="form-group ">
   <label>Email</label>
   <input name="txtEmail" type="email" id="txtEmail"class='form-control' >
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
<!-- province -->
<div class="form-row">
                   
            <div class="col-md-4">
 
 <div class="form-group">
     <!-- แสดงตัวเลือก จังหวัด -->
     <select class="form-control select2-single" id="province" name='province'>
         <option id="province_list"> -- เลือก จังหวัด --</option>

     </select>
 </div>

</div>

     
<div class="col-md-4">

 <div class="form-group">
     <!-- แสดงตัวเลือก อำเภอ -->
     <select class="form-control select2-single" id="amphur" name='amphur'>
         <option id="amphur_list"> -- เลือก อำเภอ --</option>
     </select>
 </div>

</div>

<div class="col-md-4">

 <div class="form-group">
     <!-- แสดงตัวเลือก ตำบล -->
     <select class="form-control select2-single" id="district" name='district'>
         <option> -- เลือก ตำบล --</option>
     </select>
 </div>

</div>
                                  </div>
                           <!-- address -->
                        <div class="form-group">
                            <label >ที่อยู่</label>
                                <textarea name="cus_address" rows="5" id="cus_address" class="form-control"></textarea>  
                        </div> 
   <div class="form-group ">
   <label>Status</label>
   <select name="ddlStatus" id="ddlStatus" class='form-control'>
            <option value="seller">SELLER</option>
            <option value="customer">CUSTOMER</option>
            <option value="deliver">DELIVER</option>
          </select>
   </div>
   <!-- user_picture -->
   <div class="form-group">
      Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
   </div>

  <div class="form-group">
  <button type="submit" class="btn btn-success" name="submit" value="submit">Sign Up</button>
 </div>
</form>
<?php 
                     }
                     ?>
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
  <!-- how to create select address -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    
    <script>
            
            $(function(){
                
                //เรียกใช้งาน Select2
                $(".select2-single").select2();
                
                //ดึงข้อมูล province จากไฟล์ get_data.php
                $.ajax({
                    url:"get_data.php",
                    dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
                    data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
                    success:function(data){
                        
                        //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                        $.each(data, function( index, value ) {
                            //แทรก Elements ใน id province  ด้วยคำสั่ง append
                              $("#province").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                        });
                    }
                });
                
                
                //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
                $("#province").change(function(){
 
                    //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
                    var province_id = $(this).val();
                    
                    $.ajax({
                        url:"get_data.php",
                        dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                        data:{province_id:province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                        success:function(data){
                            
                            //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                            $("#amphur").text("");
                            
                            //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                            $.each(data, function( index, value ) {
                                
                                //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                                  $("#amphur").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                            });
                        }
                    });
 
                });
                
                //แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
                $("#amphur").change(function(){
                    
                    //กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
                    var amphur_id = $(this).val();
                    
                    $.ajax({
                        url:"get_data.php",
                        dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                        data:{amphur_id:amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
                        success:function(data){
                            
                              //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
                              $("#district").text("");
                              
                            //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                            $.each(data, function( index, value ) {
                                
                              //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
                              $("#district").append("<option value='" + value.id + "'> " + value.name + "</option>");
                              
                            });
                        }
                    });
                    
                });
                
                //คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district 
                $("#district").change(function(){
                    
                    //นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
                    var province = $("#province option:selected").text();
                    
                    //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
                    var amphur = $("#amphur option:selected").text();
                    
                    //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
                    var district = $("#district option:selected").text();
                    
                    //ใช้คำสั่ง alert แสดงข้อมูลที่ได้
                    alert("คุณได้เลือก :  จังหวัด : " + province + " อำเภอ : "+ amphur + "  ตำบล : " + district );
                    
                });
                
                
            });
            
    </script>
  
  </body>
</html>

