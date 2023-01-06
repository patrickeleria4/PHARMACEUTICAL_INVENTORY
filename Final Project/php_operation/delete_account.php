<?php
    require_once('../database.php');
    date_default_timezone_set('Asia/Manila');
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $history_id = $_POST['history_id'];
    $sql = "DELETE FROM user_table WHERE user_id='$user_id' and user_name='$user_name'";
    $query = mysqli_query($connection, $sql);
    $ItemAndHistory_id = $history_id;
    $Deleted = $user_name." Deleted";
    $transaction = "INSERT INTO history_table (id, history_id, history_action, history_date) VALUES (null, '$ItemAndHistory_id', '$Deleted',now())";
    $query = mysqli_query($connection, $transaction);
?>