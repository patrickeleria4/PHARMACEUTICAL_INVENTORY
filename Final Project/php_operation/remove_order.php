<?php
    require_once('../database.php');
    $table_name = $_POST['table_name'];
    $table_id = $_POST['table_id'];
    $sql = "DELETE FROM table_order WHERE table_name='$table_name' and table_id = '$table_id'";
    $query = mysqli_query($connection, $sql);

?>