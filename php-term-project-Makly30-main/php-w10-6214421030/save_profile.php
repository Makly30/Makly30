<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}
include 'connectdb.php';
	
	if($_POST["txtPassword"] != $_POST["txtConPassword"])
	{
		echo "Password not Match!";
		exit();
	}
	$strSQL = "UPDATE customer SET  Username='".trim($_POST['txtUsername'])."', Password = '".trim($_POST['txtPassword'])."',cus_phone='".trim($_POST['cus_phone'])."',status='".trim($_POST['txtstatus'])."',cus_address='".trim($_POST['cus_address'])."',cus_fname='".trim($_POST['txtfname'])."',cus_lname='".trim($_POST['txtlname']).
	"' WHERE cus_id = '".$_SESSION["UserID"]."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	
	echo "Save Completed!<br>";		
	echo "<br> Go to <a href='login.php'>Login Again</a>";

	
	mysqli_close($conn);
?>