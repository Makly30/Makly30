
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@300&display=swap" rel="stylesheet"> 
<style>
.navbar {
  overflow: hidden;
  background-color: #5b2c6f;
  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background: #ddd;
  color: black;
}


</style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="font-family: 'Bai Jamjuree', sans-serif;">
      <div class="jumbotron" style="background-color:#f5b7b1;color:#21618c">
       <?php
       include "menu.php";
       ?>
      </div>
      <div class="container">
     
                    <h2>เมนู</h2>
                    <a href="menu_add.php" class="btn btn-link">เพิ่มเมนู</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อเมนู</th>
                                <th>ประเภท</th>
                                <th>ขนาด</th>
                                <th>ราคา</th>
                            </tr>                
                        </thead>
                        <tbody>
      <?php
    include "connectdb.php";
    $sql="select menu.menu_id,menu.menu_name,type1.t_name,size.s_name,menu.price from menu join type1 on menu.menu_type=type1.t_id join size on menu.menu_size=size.s_id order by menu_id ";
    $result = mysqli_query($conn,$sql);
    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
        echo '<tr>';
        echo '<td>' . $row['menu_id'] . '</td>';
        echo '<td>' . $row['menu_name'] . '</td>';
        echo '<td>' . $row['t_name'] . '</td>';
        echo '<td>' . $row['s_name'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
       
        echo '<td>';
?>
  <a href="menu_edit.php?menu_id=<?php echo $row['menu_id'];?>" class="btn btn-warning">แก้ไข</a>
  <a href="photoshow.php?menu_id=<?php echo $row['menu_id'];?>" class="btn btn-warning">ใส่ภาพ</a>
                                <a href="JavaScript:if(confirm('ยืนยันการลบ')==true){window.location='menu_delete.php?menu_id=<?php echo $row["menu_id"];?>'}" class="btn btn-danger">ลบ</a>
                            <?php
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                mysqli_free_result($result);
                                mysqli_close($conn);
                            ?>
                        </tbody>    
                    </table>
      </div>
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>