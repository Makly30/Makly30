
<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "seller")
	{
		echo "This page for Admin only!";
		exit();
	}	
	
	include 'connectdb.php';
	$strSQL = "SELECT * FROM user WHERE user_id= '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);
?>
<?php
    header('Content-Type: application/json');
    $username = "root";
    $password = "";
    $host = "localhost";
    $database = "vegetablephp";

    $server = mysqli_connect($host,$username,$password,$database);
    mysqli_set_charset($server,"utf8");
    $myquery =  ;

    $query = mysqli_query($server,$myquery);
    if(!$query){
        echo mysqli_error();
        die;
    }

    $data = array();
    for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
      }

    echo json_encode($data);
    mysqli_close($server);
?>