<?php
	include 'connectdb.php';
	
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
	$strSQL = "SELECT * FROM customer WHERE Username = '".($_POST['txtUsername'])."' ";
	$objResult = mysqli_query($conn,$strSQL);
	$num=mysqli_num_rows($objResult);
	if(!$num)
	{
		$strADD = "INSERT INTO customer (Username,cus_fname,cus_lname,Password,cus_phone,cus_address,Status) VALUES ('".$_POST["txtUsername"]."','".$_POST["txtfName"]."','".$_POST["txtlName"]."',
		'".$_POST["txtPassword"]."','".$_POST["cus_phone"]."','".$_POST["cus_address"]."','".$_POST["ddlStatus"]."')";
		$objQuery = mysqli_query($conn,$strADD);
		
		echo "Register Completed!<br>";		
	
		echo "<br> Go to <a href='login.php'>Login page</a>";
	}
	else
	{	
		echo "Username has already had!";
		echo "<br> Go back to Sign Up again <a href='register.php'>Sign Up</a>";
		
	}
	
	
	/*$strSQL = "SELECT * FROM customer WHERE Username = '".trim($_POST['txtUsername'])."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);
	if($objResult)
	{
			echo "Username already exists!";
	}
	else
	{	
		
		$strSQL = "INSERT INTO customer (Username,cus_fname,cus_lname,Password,cus_phone,cus_address,Status) VALUES ('".$_POST["txtUsername"]."','".$_POST["txtfName"]."','".$_POST["txtlName"]."',
		'".$_POST["txtPassword"]."','".$_POST["cus_phone"]."','".$_POST["cus_address"]."','".$_POST["ddlStatus"]."')";
		$objQuery = mysqli_query($conn,$strSQL);
		
		echo "Register Completed!<br>";		
	
		echo "<br> Go to <a href='login.php'>Login page</a>";
		
	}*/

	mysqli_close($conn);
?>