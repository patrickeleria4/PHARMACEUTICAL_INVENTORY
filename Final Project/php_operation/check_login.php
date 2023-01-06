<?php
    require_once('../database.php');
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_table WHERE  user_username = '$username' AND user_password = '$password'";
    $query = mysqli_query($connection,$sql);
    $exist = mysqli_num_rows($query);
    if($exist>0)
    {
        echo "success";
    }else
    {
        echo "invalid";
    }
?>
