<?php
    require_once('../database.php');
    session_start();
    $item_quantity = $_POST['item_quantity'];
    $item_name = $_POST['item_name'];
    $total = "SELECT item_quantity as qty FROM product_table where item_name = '$item_name'";
    $query_total = mysqli_query($connection, $total);
    $max = mysqli_fetch_assoc($query_total);


    $sql = "SELECT item_price as price FROM product_table where item_name = '$item_name'";
    $price_total = mysqli_query($connection, $sql);
    $price = mysqli_fetch_assoc($price_total);

    $total_price = floatval($price['price']) * floatval($item_quantity);

    if($item_quantity > $max['qty'])
    {
        echo "<span style='color:red'>Quantity should be less than </span>";
        echo "<b>".$max['qty']."</b>";
        echo "<script>$('#submit_orders').prop('disabled', true);</script>";
    }
    else
    {
        $_SESSION['price'] = $price['price'];
        echo "<span> Price: <b>₱".$price['price']."</b></span><br>";
        echo "<span>Total Amount: <b>₱".$total_price."</b></span>";
        echo "<script>$('#submit_orders').prop('disabled', false);</script>";
    }

?>
