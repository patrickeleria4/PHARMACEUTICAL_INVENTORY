<?php
    require_once('../database.php');
    session_start();
    date_default_timezone_set('Asia/Manila');
    $category_name = $_POST['item_category'];
    $sql = "DELETE FROM category_table WHERE category_name='$category_name'";
    $query = mysqli_query($connection, $sql);
    $_SESSION['delete_category'] = "delete_category";
    
    $history_id = $_POST['history_id'];
    $ItemAndHistory_id = $history_id;
    $deleted = $category_name." has been deleted from category";
    $transaction = "INSERT INTO history_table (id, history_id, history_action, history_date) VALUES (null, '$ItemAndHistory_id', '$deleted',now())";
    $query = mysqli_query($connection, $transaction);
?>