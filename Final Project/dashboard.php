<?php
    require_once("database.php");
    session_start();
    $sql = "SELECT COUNT(*) as total FROM product_table";
    $result = mysqli_query($connection, $sql);
    $total = mysqli_fetch_assoc($result);
    $count=0;
    $sql = "SELECT * FROM product_table";
    $query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $item_quantity = $row['item_quantity'];
        $count+=$item_quantity;
    }
    $total_price=0;
    $sql = "SELECT item_price, item_quantity FROM product_table";
    $query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $item_price = $row['item_price'];
        $item_quantity = $row['item_quantity'];
        $total_price += $item_price*$item_quantity;

    }
    $total_sales=0;
    $sql = "SELECT order_price, order_quantity FROM order_table";
    $query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $order_quantity = $row['order_quantity'];
        $order_price = $row['order_price'];
        $total_sales += (float)$order_quantity * (float)$order_price;
    }
    $count = $count-$order_quantity;
?>
<!DOCTYPE html>
<head>
<title>Artemis Drugstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="img/artemis.png">
</head>
<body class="d-flex flex-column min-vh-100" style="background-position: center; 
  background-repeat: no-repeat; background-size: cover; background-image: url('img/pharmacyback.jpg');">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-3">
        <div class="container-fluid">
        <img class="mr-5"src="img/artemis.png" 
        style="width:70px; height:70px; margin-top:-10px; margin-bottom:-10px; margin-right:20px; ">
            <div class="collapse navbar-collapse nav " id="mynavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage</a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="view_products.php">Manage Items</a></li>
                            <li><a class="dropdown-item" href="stock_in.php">Add Items</a></li>
                            <li><a class="dropdown-item" href="stock_out.php">Orders</a></li>
                            <li><a class="dropdown-item" onclick="accounts()">Accounts</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse nav justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link nav-dark nav" onclick="gotoNewPage()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container-fluid p-3 text-center text-dark">
    <h2>Welcome to Aretemis Inventory Management Dashboard</h2>
</div>
<div class="container" style="opacity: 0.85;">
    <div class="row">
        <div class="col border p-3 m-3 bg-light row">
            <div class="row">
                <h4 class="text-center">Reports</h4><hr>
            </div>
            <div class="row">
                <div class="col border m-3 p-3">
                    <h6>Total Items: <b><?php echo $total['total']?></b></h6>
                    <h6>Total Number of Items: <b><?php echo $count?></h6></b> 
                </div>
                <div class="col border m-3 p-3">
                    <h6>Total Sales: ₱<b><?php echo $total_sales?></b></h6>
                    <h6>Total Price: ₱<b><?php echo $total_price?></b></h6><br>
                </div>
            </div>
            <div class="row">
                <div class="col border m-3 p-3">
                    <h6>Low Stocks</h6>
                    <?php
                        $sql = "SELECT ct.category_name FROM category_table ct LEFT JOIN product_table t2 ON t2.item_category = ct.category_name
                        where t2.item_category is null";
                        $query = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($query))
                        {
                            $category_name = $row['category_name'];
                            echo $category_name;
                            echo "<br>";
                        }
                    ?>
                </div>
                <div class="col border m-3 p-3">
                    <h6>Available Stocks</h6>
                    <?php
                        $sql = "SELECT item_category as Category, COUNT(item_category) as Total FROM product_table GROUP BY item_category having count(item_category)>0";
                        $query = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($query))
                        {
                            $category_name = $row['Category'];
                            echo $category_name;
                            echo "<br>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-4 border p-3 m-3 bg-light">
            <h4 class="text-center">Statistics</h4><hr>
            <table class="table table-hover" id="category_table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>% Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT item_category as Category, COUNT(item_category) as Total FROM product_table GROUP BY item_category having count(item_category)>0";
                        $query = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($query))
                        {
                            $category_name = $row['Category'];
                            $category_count = $row['Total'];
                    ?>
                    <tr>
                        <td><?php echo $category_name?></td>
                        <td><?php echo number_format(($category_count/$total['total']*100), 2)." %"?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="border m-3 p-3 col bg-light">
            <div>
                <h4 class="text-center">Recent Transaction</h4><hr>
            </div>
            <div>
                <table class="table table-hover" id="history_table">
                    <thead>
                        <tr>
                            <th>Transaction Number</th>
                            <th>Action</th>
                            <th>Date Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $history = "SELECT * FROM history_table ORDER BY history_date desc limit 3";
                            $query = mysqli_query($connection, $history);
                            while($row = mysqli_fetch_assoc($query))
                            {
                                $history_id = $row['history_id'];
                                $history_action = $row['history_action'];
                                $history_date = $row['history_date'];
                        ?>
                        <tr>
                            <td><?php echo $history_id?></td>
                            <td><?php echo $history_action?></td>
                            <td><?php echo $history_date?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <a class="btn btn-secondary btn-sm"href=""data-bs-toggle="modal" data-bs-target="#all_history">View all</a>
            </div>
        </div>
        <div class="border col-4 m-3 p-3 bg-light">
            <div>
                <h4 class="text-center">Recent Orders</h4><hr>
            </div>
            <div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $latest_added = "SELECT * FROM order_table ORDER BY id desc LIMIT 3";
                        $query = mysqli_query($connection, $latest_added);
                        while($row = mysqli_fetch_assoc($query))
                        {
                        $order_name = $row['order_name'];
                        $order_price = $row['order_price'];
                        $order_quantity = $row['order_quantity'];
                        $order_customer = $row['order_customer'];
                        $order_date = $row['order_date'];
                        //$order_cashier = $row['user_cashier'];
                        $table_order_id = $row['table_order_id'];
                    ?>
                        <tr>
                            <td><?php echo $order_customer?></td>
                            <!--td><button class="btn btn-primary btn-sm" id="receipt_btn"
                            data-order_name = "<?php echo $order_name?>"
                            data-order_price = "<?php echo $order_price?>"
                            data-order_quantity = "<?php echo $order_quantity?>"
                            data-order_customer = "<?php echo $order_customer?>"
                            data-order_date = "<?php echo $order_date?>"
                            data-order_cashier = "<?php echo $order_cashier?>"
                            data-table_order_id = "<?php echo $table_order_id?>"
                            data-bs-toggle="modal" data-bs-target="#receipt_modal">View Receipt</button></td-->
                            <td>
                                <a href="receipt.php?id=<?php echo $table_order_id?>&name=<?php echo $order_customer?>&date=<?php echo $order_date?>" class="btn btn-secondary">view receipt</a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<footer class="text-center text-dark mt-auto" style="background-color: black">
  <div class="text-center p-3 text-light">
    <p>Artemis Drugstore IMS 2.0</p>
  </div>
</footer>
<div class="modal fade" id="all_history" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"><!-- transaction History Modal -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaction History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <th>Transaction Number</th>
                        <th>Action</th>
                        <th>Date and Time</th>
                    </thead>
                    <tbody>
                        <?php
                            $history = "SELECT * FROM history_table ORDER BY history_date desc";
                            $query = mysqli_query($connection, $history);
                            while($row = mysqli_fetch_assoc($query))
                            {
                                $history_id = $row['history_id'];
                                $history_action = $row['history_action'];
                                $history_date = $row['history_date'];
                        ?>
                        <tr>
                            <td><?php echo $history_id?></td>
                            <td><?php echo $history_action?></td>
                            <td><?php echo $history_date?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <script>
        

        $(function()
        {
            $("#category_table").DataTable({
                "responsive":true,
                "autoWidth":true,
                pageLength : 3,
                lengthMenu: [[3, 6], [3, 6]]
            });
        });
        function gotoNewPage()
        {
            Swal.fire
            ({
                title: 'Are you sure you want to Logout?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                }).then((result) => {
                if (result.isConfirmed){
                    logout_success();
                }
            });
        }
        function logout_success()
        {
            <?php unset($_SESSION['name'])?>
            let timerInterval
            Swal.fire
            ({
                icon: 'success',
                title: 'Logging out..',
                html: 'Redirecting you to main page in <b></b> milliseconds.',
                timer: 1500,
                timerProgressBar: true,
                allowEscapeKey: true,
                allowOutsideClick: true,
                didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => 
                {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
                },
                willClose: () => 
                {
                    clearInterval(timerInterval)
                }
            }).then((result) => 
            {
                if (result.dismiss === Swal.DismissReason.timer) 
                {
                    console.log('I was closed by the timer')
                    location.href = 'index.php';
                }
            })
        }
        function accounts()
        {
        Swal.fire
        ({
            title: 'Admin',
            html: `<input type="text" id="login" class="swal2-input" placeholder="Username">
            <input type="password" id="password" class="swal2-input" placeholder="Password">`,
            confirmButtonText: 'Sign in',
            focusConfirm: false,
            preConfirm: () => 
            {
                const login = Swal.getPopup().querySelector('#login').value
                const password = Swal.getPopup().querySelector('#password').value
                if(login == "admin" && password == "admin")
                {
                    location.href = 'accounts.php';
                }
                if(login != "admin" || password != "admin" || !login || !password)
                {
                    Swal.showValidationMessage(`Invalid`)
                }
                return { login: login, password: password }
            }
            })
        }
    </script>
</body>
</html>