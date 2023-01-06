<?php
    require_once('../database.php');
    session_start();
    date_default_timezone_set('Asia/Manila');
    


    //$add_item_name = $_POST['add_item_name'];
    $add_item_customer = $_POST['add_item_customer'];
    //$add_item_quantity = $_POST['add_item_quantity'];
    //$add_item_price = $_SESSION['price'];
    //$cashier = $_SESSION['name'];
    
    if($add_item_customer=="")
    {
        $add_item_customer = "Customer";
    }

    $history_id = $_POST['history_id'];
    $ItemAndHistory_id = $history_id;
    $added = $add_item_customer." makes an order";
    $transaction = "INSERT INTO history_table (id, history_id, history_action, history_date) VALUES (null, '$ItemAndHistory_id', '$added',now())";
    $query = mysqli_query($connection, $transaction);

    //$sql = "INSERT INTO order_table (id, order_name, order_price, order_quantity) SELECT table_id, table_name, table_price, table_quantity 
    //and (table_order_id) VALUES ($history_id) FROM table_order;";
    //$query = mysqli_query($connection,$sql);

    $sql = "SELECT * from table_order";
    $query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $order_name = $row['table_name'];
        $order_price = $row['table_price'];
        $order_quantity = $row['table_quantity'];
        $order_sql = "INSERT INTO order_table( order_customer, order_name, order_price, order_quantity, table_order_id, order_date) 
        VALUES ('$add_item_customer','$order_name','$order_price','$order_quantity','$history_id', now())";
        $sql_query = mysqli_query($connection, $order_sql);
    }
    //$sql = "INSERT INTO order_table (table_order_id) VALUES ($history_id) FROM table_order;";
    //$query = mysqli_query($connection,$sql);
    $sql = "TRUNCATE TABLE table_order";
    $query = mysqli_query($connection, $sql); 

    $sql = "SELECT item_quantity as qty FROM product_table where item_name = '$add_item_name'";
    $query = mysqli_query($connection, $sql);
    $qty = mysqli_fetch_assoc($query);

    $result = $qty['qty'] - $add_item_quantity;
    $sql= "UPDATE product_table SET item_quantity='$result' WHERE item_name = '$add_item_name'";
    $query = mysqli_query($connection,$sql);
    
?>
