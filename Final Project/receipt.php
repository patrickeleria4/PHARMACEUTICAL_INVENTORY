<?php
    require_once("database.php");
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
  background-repeat: no-repeat; background-size: cover; background-image: url(img/pharmacyback.jpg);">
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
    <div class="container bg-light mt-5 text-center p-5" style="width:600px;">
        <img class="text-center"src="img/artemis.png" style="widht:100px; height:100px;">
        <h3>Artemis Drug Store</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    $table_id = $_GET['id'];
                    $table_customer = $_GET['name'];
                    $table_time = $_GET['date'];
                    $sql = "SELECT * FROM order_table where table_order_id = '$table_id'";
                    $query = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_assoc($query))
                    {
                        $order_name = $row['order_name'];
                        $order_quantity = $row['order_quantity'];
                        $order_price = $row['order_price'];
                        $order_number = $row['table_order_id'];
                        $total += $order_price * $order_quantity;

                ?>
                <tr>
                    <td><?php echo $order_name?></td>
                    <td><?php echo $order_quantity?></td>
                    <td><?php echo $order_price?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <h6 class="text-start"> Total: ₱ <?php echo $total?></h6>    
        <h6 class="text-start">Reciept Number: <?php echo $order_number?></h6>       
        <h6 class="text-start">Ordered By: <?php echo $table_customer?></h6>
        <h6>----------------------------------------------------------------------</h6>
        <br><img class="text-center"src="img/barcode.png" ><br>
        <br><h6><?php echo $table_time?></h6><br>
    </div>
<footer class="text-center text-dark mt-auto" style="background-color: black">
    <div class="text-center p-3 text-light">
        <p>Artemis Drugstore IMS 2.0</p>
    </div>
</footer>
</body> 
<script>
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
</html>
