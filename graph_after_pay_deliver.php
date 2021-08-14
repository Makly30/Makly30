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

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
<!-- navigation bar -->
<nav class="navbar  navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand " href="#">Vegetable E-store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="indexadmin.php">Home</a>
        </li>
        <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $objResult['user_username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin_page.php">My Personal Info</a>
          <a class="dropdown-item" href="myproduct.php">My Product</a>
          <a class="dropdown-item active" href="orderlistadmin.php">My Order</a>
          <a class="dropdown-item" href="myorderservice.php">My Delivery</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="service_board.php">Delivery Service</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      </ul>
    </div>
  </div>
</nav>

<!-- navigation bar -->
<div class="container m-9">
<a href="graph_all_data.php" class="btn btn-success mt-4">ยอดสรุปร่วม</a>
<a href="graph_income.php" class="btn btn-info mt-4">ยอดสรุปร่วมของค่าผัก</a>
<a href="graph_user.php" class="btn btn-warning mt-4">ยอดจำนวนการสั่งในแต่ละวัน</a>
<a href="graph_income_deliver.php" class="btn btn-danger mt-4">ยอดเงินที่ลูกค้าจ่ายบริการส่งในแต่ละวัน</a>
<a href="graph_deliver.php" class="btn btn-primary mt-4">ยอดเงินที่จ่ายให้บริการส่งในแต่ละวัน</a>
<a href="graph_after_pay_deliver.php" class="btn btn-success mt-4">ยอดเงินที่เลือแต่ละวันหลังชำระค่าขนส่ง</a>
    <h2 class="text-danger text-center">ยอดเงินที่เลือแต่ละวันหลังชำระค่าขนส่ง</h2>
   <div id="chart-container">
     <h5 class='text-info text-center'>X Axis เป็นวันที่, Y Axis เป็นยอดเงินที่เลือแต่ละวันหลังชำระค่าขนส่งในวันนั้น</h5>
        <canvas id="graphCanvas"></canvas>
    </div>
    <script>
        $(document).ready(function () {
            showGraph();
        });
        function showGraph()
        {
            {
                $.post("after_pay_deliver.php",
                function (data)
                {
                    console.log(data);
                    var name = [];
                    var marks = [];
                    for (var i in data) {
                        name.push(data[i].timenew);
                        marks.push(data[i].total_after);
                    }
                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'จำนวนยอดเงินที่เลือแต่ละวันหลังชำระค่าขนส่งเป็นบาท',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };
                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
      </script> 
</div>
  
  
  </body>
</html>