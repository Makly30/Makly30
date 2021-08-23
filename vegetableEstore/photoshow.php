<?php
	include 'connectdb.php';
	$strSQL = "SELECT * FROM user WHERE user_id = '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
    ?>
<!DOCTYPE html>
<html>
<body>
    
             <form action=" " method="post" enctype="multipart/form-data" >
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-info">
            <button  name="save" class="btn btn-success">Upload Image</button>
            </form>
  

<?php


// Check if image file is a actual image or fake image
if(isset($_POST["save"])) {
    $target_dir = "";
$target_file =  basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
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
$user_id=$_REQUEST['user_id'];
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $sql="update user set user_picture ='".$target_file."' where user_id=".$user_id." ;";
      $result=mysqli_query($conn,$sql);
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded."."<br>";
    
    if($objResult["status"] == "seller")
    {
        header("location:admin_page.php");
    }
    else if ($objResult["status"] == "customer")
    {
        header("location:user_page.php");
    }
    else if($objResult["status"] == "deliver")
    {
        header("location:deliver_page.php");
    }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }}
}?>
</body>
</html>