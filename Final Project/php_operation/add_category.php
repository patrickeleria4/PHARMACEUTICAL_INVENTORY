<?php
    require_once('../database.php');
    date_default_timezone_set('Asia/Manila');
    $history_id = $_POST['history_id'];
    $item_category = $_POST['item_category'];
    $sql = "INSERT INTO category_table (category_name) VALUES ('$item_category')";
    $query = mysqli_query($connection,$sql);

    $ItemAndHistory_id = $history_id;
    $added = $item_category." added to category";
    $transaction = "INSERT INTO history_table (id, history_id, history_action, history_date) VALUES (null, '$ItemAndHistory_id', '$added',now())";
    $query = mysqli_query($connection, $transaction);
?>
