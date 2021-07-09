

<!DOCTYPE html>
<html>
<body>
<form action=" " method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
<?php


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $target_dir = "";
$target_file =  basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
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
    $menu_id=$_GET['menu_id'];
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $sql="update menu set menu_pic ='".$target_file."' where menu_id=".$menu_id." ;";
      $result=mysqli_query($conn,$sql);
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    echo "Go to see !";?><a href="menu_admin.php">Menu</a>

    <?php
  } else {
    echo "Sorry, there was an error uploading your file.";
    echo "Go to see !";?><a href="menu_admin.php">Menu</a>
    <?php
  }}
}?>
</body>
</html>
