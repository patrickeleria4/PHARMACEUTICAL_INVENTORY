<?php
    require_once('../database.php');
    session_start();
    date_default_timezone_set('Asia/Manila');
    
    $item_name = $_POST['item_name'];
    //$add_item_customer = $_POST['add_item_customer'];
    $item_quantity = $_POST['item_quantity'];
    $item_price = $_SESSION['price'];

    $sql = "INSERT INTO table_order (table_id, table_name, table_quantity, table_price) VALUES
    (null, '$item_name', '$item_quantity', '$item_price')";
    $query = mysqli_query($connection,$sql);

?>
