<?php
    require_once('../database.php');
    date_default_timezone_set('Asia/Manila');
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $history_id = $_POST['history_id'];
    $sql = "DELETE FROM product_table WHERE item_id='$item_id'";
    $query = mysqli_query($connection, $sql);
    $ItemAndHistory_id = $history_id.''.$item_id;
    $Deleted = $item_name." Deleted";
    $transaction = "INSERT INTO history_table (id, history_id, history_action, history_date) VALUES (null, '$ItemAndHistory_id', '$Deleted',now())";
    $query = mysqli_query($connection, $transaction);
?>