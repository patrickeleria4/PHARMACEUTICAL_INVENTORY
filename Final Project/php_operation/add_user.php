<?php
    require_once('../database.php');
    date_default_timezone_set('Asia/Manila');
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_birthday = $_POST['user_birthday'];


    $sql = "INSERT INTO user_table (id, user_id, user_name, user_username, user_password, user_email, user_birthday, user_acquisition) 
    VALUES (null,'$user_id','$user_name','$user_username','$user_password','$user_email','$user_birthday', now())";
    $query = mysqli_query($connection, $sql);
?>
