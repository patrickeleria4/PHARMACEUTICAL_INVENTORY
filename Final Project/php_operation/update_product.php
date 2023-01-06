<?php
    require_once('../database.php');
    date_default_timezone_set('Asia/Manila');
    //session_start();
    $history_id = $_POST['history_id'];
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_brand = $_POST['item_brand'];
    $item_price = $_POST['item_price'];
    $item_supplier = $_POST['item_supplier'];
    $item_description = $_POST['item_description'];
    $item_quantity = $_POST['item_quantity'];
    $acquisition_date = date('Y-m-d', strtotime($_POST['acquisition_date']));
    $expiry_date = $_POST['expiry_date'];
    
    $sql= "UPDATE product_table SET item_name = '$item_name',item_category='$item_category', item_brand = '$item_brand', item_price = '$item_price', item_supplier = '$item_supplier',
    item_description='$item_description', item_quantity='$item_quantity', acquisition_date = '$acquisition_date', expiry_date = '$expiry_date' WHERE item_id = '$item_id'";
    $query = mysqli_query($connection,$sql);

    $ItemAndHistory_id = $history_id.''.$item_id;
    $updated = $item_name." Updated";
    $transaction = "INSERT INTO history_table (id, history_id, history_action, history_date) VALUES (null, '$ItemAndHistory_id', '$updated',now())";
    $query = mysqli_query($connection, $transaction);
?>