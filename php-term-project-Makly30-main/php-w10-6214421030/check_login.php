<?php
	session_start();
	include ("connectdb.php");
    $myusername = mysqli_real_escape_string($conn,$_POST['txtUsername']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['txtPassword']); 
	$strSQL = "SELECT * FROM customer WHERE Username = '".$myusername."'and Password = '".$mypassword."'";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
	}
	else
	{
			$_SESSION["UserID"] = $objResult["cus_id"];
			$_SESSION["Status"] = $objResult["Status"];

			session_write_close();
			
			if($objResult["Status"] == "ADMIN")
			{
				header("location:admin_page.php");
			}
			else
			{
				header("location:user_page.php");
			}
	}
	mysqli_close($conn);
?>

