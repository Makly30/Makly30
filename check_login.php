<?php
	session_start();
	include ("connectdb.php");
    $myusername = mysqli_real_escape_string($conn,$_POST['txtUsername']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['txtPassword']); 
	$strSQL = "SELECT * FROM user WHERE user_username = '".$myusername."'and user_password = '".$mypassword."'";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
	}
	else
	{
			$_SESSION["UserID"] = $objResult["user_id"];
			$_SESSION["Status"] = $objResult["status"];

			session_write_close();
			
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
	}
	mysqli_close($conn);
?>

