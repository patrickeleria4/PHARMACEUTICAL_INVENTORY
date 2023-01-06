<?php 
    require_once("database.php");
    session_start();
    $total_price=0;
    $sql = "SELECT table_price, table_quantity FROM table_order";
    $query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $item_price = $row['table_price'];
        $item_quantity = $row['table_quantity'];
        $total_price += $item_price*$item_quantity;
    }
?>
<!DOCTYPE html>
<head>
<title>Artemis Drugstore</title>
    <link rel="stylesheet" href="add_category.php">
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
  background-repeat: no-repeat; background-size: cover; background-image: url(img/warehouse.jpg);">
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
    <div class="container bg-white mt-5 mb-5 p-5 shadow shadow-lg" style="opacity:0.85;">
        <div class="row">
            <div class="mt-3 col-4">
                <div>
                    <h3 class="text-center">Orders</h3>
                </div>
                <div class="p-3">
                    <table class="table table-hover">
                        <tr>
                            <th>
                                <h6><span>Customer Name</span></h6>
                                <p>(<i>optional</i>)</p>
                            </th>
                            <th><input type="Text" class="form-control" id ="add_item_customer" placeholder="Enter Name"></th>
                        </tr>
                        <tr>
                            <th><h6><span>Item Name</span></h6></th>
                            <th>
                                <select name="item_name" class="form-select" id="add_item_name" onclick="checkExist()">
                                <?php
                                    $sql = "SELECT item_name from product_table";
                                    $query = mysqli_query($connection, $sql);
                                    while($row = mysqli_fetch_assoc($query))
                                    {
                                        $item_name = $row['item_name'];
                                        $item_id = $row['item_id'];   
                                ?>
                                    <option value="<?php echo $item_name?>"><?php echo $item_name?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th><h6><span>Item Quantity</span></h6></th>
                            <th><input type="number" class="form-control" id ="add_item_quantity" oninput="checkExist()" required></th>
                        </tr>
                    </table>
                    <div class="card-footer bg-white">
                        <div class=""row>
                            <div class="col">
                                <p id="check_total"></p>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-primary" id="add_orders" onclick="add_table()">add</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3>Total: ₱<?php echo $total_price?></h3>
                    </div>
                </div>
            </div>
            <div class="p-3 mt-3 col">
                <table class="table table-hover" id="order_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM table_order";
                            $query = mysqli_query($connection,$sql);
                            while($row = mysqli_fetch_assoc($query))
                            {
                                $table_id = $row['table_id'];
                                $table_name = $row['table_name'];
                                $table_quantity = $row['table_quantity'];
                                $table_price = $row['table_price'];
                        ?>
                        <tr>
                            <td><?php echo $table_name?></td>
                            <td><?php echo $table_quantity?></td>
                            <td><?php echo $table_price?></td>
                            <td><button class="btn btn-danger btn-sm"
                            data-table_name = "<?php echo $table_name?>"
                            data-table_id = "<?php echo $table_id?>"id="remove_btn">Remove</button></td>
                        </tr>
                        
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <button type="button" class="btn btn-primary" style="float:right" id="submit_orders" onclick="order_done()">Add Order</button>
    </div>
    <footer class="bg-dark text-center text-white mt-auto">
        <div class="text-center p-3 text-light">
            <p>Artemis Drugstore IMS 1.0</p>
        </div>
    </footer>
    
</body>
<script>
    $(function()
    {
        $("#order_table").DataTable({
            "responsive" : true,
            "autoWidth" : true
        });
    });
    $(document).on('click', '#remove_btn', function()
    {
        var table_name = $(this).data('table_name');
        var table_id = $(this).data('table_id');
        var data_values = 
        {
            "table_name" : table_name, "table_id" : table_id
        }
        Swal.fire
        ({
            title: 'Are you sure you want to remove '+table_name+'?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => {
            if (result.isConfirmed){
                $.ajax
                ({
                    type: "POST",
                    url: "php_operation/remove_order.php",
                    data: data_values,
                    success: function(data)
                    {
                        //$("#check_total").html(data);
                        //location.reload(true);
                        success_action();
                    },
                    error:function(){}
                });
            }
        });
    })
    function remove_table_done()
    {

    }
    function checkExist()
    {
        var item_name = $('#add_item_name').val();
        var item_quantity = $('#add_item_quantity').val();

        var data_values = 
        {
            "item_name" : item_name, "item_quantity" : item_quantity 
        };
        $.ajax
        ({
            type: "POST",
            url: "php_operation/check_order.php",
            data: data_values,
            success: function(data)
            {
                $("#check_total").html(data);
            },
            error:function(){}
        });
    }
    function add_table()
    {
        var item_name = $('#add_item_name').val();
        var item_quantity = $('#add_item_quantity').val();
        var data_values = 
        {
            "item_name" : item_name, "item_quantity" : item_quantity
        };
        Swal.fire({
            title: 'Are you sure you want to add '+item_name+'?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => {
            if (result.isConfirmed)
            {
                $.ajax
                ({
                    type: "POST",
                    url: "php_operation/table_order.php",
                    data: data_values,
                    success: function(data)
                    {
                        //$("#check_total").html(data);
                        //location.reload(true);
                        success_action();
                    },
                    error:function(){}
                });
            }
        });

    }
    function order_done()
    {
        var history_id = (Math.random()).toString(36).substring(7).toUpperCase()+Math.ceil(Math.random() * 100000);
        var add_item_customer = $('#add_item_customer').val();
        var data_values = 
        {
            "history_id" : history_id, "add_item_customer":add_item_customer
        }
        Swal.fire({
        title: 'Are you sure you want to add this order?',
        text: "Adding this will make changes in Inventory database!",
        icon: 'question',
        showCancelButton: true,
        }).then((result) => {
        if (result.isConfirmed){
            $.ajax
            ({
                type: "POST",
                url: "php_operation/add_order.php",
                data: data_values,
                success: function(data)
                {
                    success_action();
                },
                error:function(){}
            })
        }
        });
    }
    function success_action()
    {
        Swal.fire
        ({
            icon: 'success',
            title: 'Success',
            confirmButtonText: 'CONTINUE',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {

        if(result.isConfirmed) 
        {
            location.reload(true);
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
    /*
    $(document).on('click','#submit_orders', function()
    {
        //alert("sadas");
        var item_name = $('#add_item_name').val();
        var item_quantity = $('#add_item_quantity').val();
        var data_values = 
        {
            "item_name" : item_name, "item_quantity" : item_quantity
        };
        $.ajax
        ({
            type: "POST",
            url: "php_operation/table_order.php",
            data: data_values,
            success: function(data)
            {
                //$("#check_total").html(data);
                location.reload(true);
            },
            error:function(){}
        });
    })
    
    /*$(document).on('click','#submit_orders', function()
    {
        //alert("sadas");
        var item_name = $('#add_item_name').val();
        var item_quantity = $('#add_item_quantity').val();
        var data_values = 
        {
            "item_name" : item_name, "item_quantity" : item_quantity
        };
        $.ajax
        ({
            type: "POST",
            url: "php_operation/table_order.php",
            data: data_values,
            success: function(data)
            {
                //$("#check_total").html(data);
                location.reload(true);
            },
            error:function(){}
        });
    })*/
    /*function done_action()
    {
        var add_item_name = $("#add_item_name").val();
        var add_item_customer = $("#add_item_customer").val();
        var add_item_quantity = $("#add_item_quantity").val();
        
        var history_id = (Math.random()).toString(36).substring(7).toUpperCase()+Math.ceil(Math.random() * 100000);
        var data_values = 
        {
            "add_item_name" : add_item_name, "add_item_customer": add_item_customer, "add_item_quantity":add_item_quantity,
            "history_id" : history_id
        }
        Swal.fire({
        title: 'Are you sure you want to add this order?',
        text: "Adding this will make changes in Inventory database!",
        icon: 'question',
        showCancelButton: true,
        }).then((result) => {
        if (result.isConfirmed){
            $.ajax
            ({
                type: "POST",
                url: "php_operation/add_order.php",
                data: data_values,
                success: function(data)
                {
                    success_action();
                },
                error:function(){}
            })
        }
        });
    }*/
    /*function success_action()
    {
        Swal.fire
        ({
            icon: 'success',
            title: 'Success',
            confirmButtonText: 'CONTINUE',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {

        if(result.isConfirmed) 
        {
            location.reload(true);
        }
        })
    }
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
    }*/
    
</script>
</html>
