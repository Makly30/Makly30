<?php
    $host = "stu2.rbru.ac.th";
    $db = "s6214421030";
    $usr = "s6214421030";
    $pwd = "it621";
   
    $conn = mysqli_connect($host,$usr,$pwd,$db);
    if (!$conn) {
        die('Could not connect to MySQL: ' . mysqli_connect_error());
    }
    mysqli_query($conn, 'SET NAMES \'utf8\'');
?>