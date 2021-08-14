<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "deliver")
	{
		echo "This page for deliver only!";
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
    $myquery =  "SELECT if ( count(deliver_list.dl_id)>1,round(sum(deliver_choices.deli_price),2) ,deliver_choices.deli_price)as expense, DATE(deliver_list.dl_datetime) as timenew from order_product as orp join products as p on orp.orp_pr_id=p.product_id join user as u on p.product_owner=u.user_id join deliver_list on orp.orp_id=deliver_list.dl_orp_id join deliver_choices on deliver_list.dl_dc_id=deliver_choices.d_ch_int join user as deliver on deliver_list.dl_deli_id=deliver.user_id  where deliver.user_id='".$objResult['user_id']."' GROUP by timenew" ;

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