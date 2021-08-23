<?php
    // $host = "stu2.rbru.ac.th";
    // $db = "s6214421030";
    // $usr = "s6214421030";
    // $pwd = "it621";
   $host='127.0.0.1';
   $db='vegetablephp';
   $usr='root';
   $pwd='';
    $conn = mysqli_connect($host,$usr,$pwd,$db);
    if (!$conn) {
        die('Could not connect to MySQL: ' . mysqli_connect_error());
    }
    mysqli_query($conn, 'SET NAMES \'utf8\'');
?>