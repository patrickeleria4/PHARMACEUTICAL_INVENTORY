<?php
    date_default_timezone_set('Asia/Manila');
    $servername="localhost";
    $username="root";
    $password="";
    $databasename="pharmacydb";
    $connection = mysqli_connect($servername, $username, $password, $databasename);
    if(!$connection)
    die("Can't connect to database ". mysqli_connect_error($connection));
?>
 