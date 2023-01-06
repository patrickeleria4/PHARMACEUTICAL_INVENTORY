<?php
    require_once('../database.php');
    session_start();
    $item_category = $_POST['item_category'];
    $sql = "SELECT category_name FROM category_table WHERE category_name='$item_category'"; 
    $query = mysqli_query($connection, $sql);
    $exist = mysqli_num_rows($query);
    
    if($exist>0)
    {
        echo "<span style='color:red'>Category Already Exist</span>";
        echo "<script>$('#add_category_btn').prop('disabled', true);</script>";
    }
    else
    {
        echo "<script>$('#add_category_btn').prop('disabled',false);</script>";
    }
?>
