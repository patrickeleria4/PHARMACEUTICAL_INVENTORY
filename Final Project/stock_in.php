<?php 
    require_once("database.php");
    //session_start();
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
    <div class="container bg-light mt-5 mb-5" style="opacity:0.85; width:750px;">
        <div class="m-3 p-3" style="width:700px;">
        <h3 class="text-center">Add Items</h3><hr>
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td><span>ID:</span></td>
                        <td>
                            <input type="text" id="add_item_id" class="form-control">
                            <button class="btn btn-primary btn-sm"id="add_generate_btn">Generate</button>
                        </td>
                    </tr>
                    <!--<tr>
                        <td><span>Supplier:</span></td>
                        <td><input name="item_name" type="text" class="form-control" placeholder="Enter Item name" id="add_item_supplier" required></td>
                    </tr>-->
                    <tr>
                        <td><span>Category</span></td>
                        <td>
                            <select name="item_category" class="form-select" id="add_item_category">
                            <?php
                                $sql = "SELECT * from category_table";
                                $query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($query))
                                {
                                    $category = $row['category_name'];
                            ?>
                                <option value="<?php echo $category?>"><?php echo $category?></option>
                            <?php 
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Name:</span></td>
                        <td><input name="item_name" type="text" class="form-control" placeholder="Enter Item name" id="add_item_name" required></td>
                    </tr>
                    <tr>
                        <td><span>Brand:</span></td>
                        <td><input name="item_brand" type="text" class="form-control" placeholder="Enter Item Brand" id="add_item_brand" required></td>
                    </tr>
                    <tr>
                        <td><span>Price per Qty:</span></td>
                        <td><input name="item_price" type="number" class="form-control" placeholder="Enter Item price" id="add_item_price" required></td>
                    </tr>
                    <tr>
                        <td><span>Quantity:</span></td>
                        <td><input name="item_quantity" type="number" class="form-control" placeholder="Enter Quantity" id="add_item_quantity" required></td>
                    </tr>
                    <tr>
                        <td><span>Description:</span></td>
                        <td><textarea class="form-control" name="item_description" placeholder="Enter Decription" id="add_item_description" required></textarea></td>
                    </tr>
                    <tr>
                        <td><span>Aquisition Date</span></td>
                        <td><input type="date" name="acquisition_date" class="form-control" id="add_acquisition_date" required></td>
                    </tr>
                    <tr>
                        <td><span>Expiry Date</span></td>
                        <td><input type="date" name="expiry_date" class="form-control" id="add_expiry_date" required></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-end">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="add_btn">Add</button>
            </div>
        </div>
        <div class="modal-footer">
            <button id="SelectBtn"type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Category</button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletecategoryModal">Delete Category</a>
                </li>
                <li>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addcategoryModal">Add Category</a>
                </li>
            </ul>
        </div>
    </div>
    
    <footer class="bg-dark text-center text-white mt-auto">
        <div class="text-center p-3 text-light">
            <p>Artemis Drugstore IMS 1.0</p>
        </div>
    </footer>
    <div class="modal fade" id="addcategoryModal"  tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"><!----------------add category modal--------------------->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-success text-white">
                    <h1 class="modal-title">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <tr>
                            <td><b>Item Category:</b></td>
                            <td>
                                <span id="check_category"></span>
                                <input name="add_new_item_categoy" type="text" class="form-control" placeholder="Enter Category" id="add_new_item_categoy" oninput="checkExist()">
                                
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal" value="Cancel">
                    <input type="submit" class="btn btn-success"  value="Add Category" id="add_category_btn">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deletecategoryModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"><!--Delete category Modal-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h1 class="modal-title">Delete Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select name="item_category" class="form-select" id="delete_item_category">
                        <?php
                        $sql = "SELECT * from category_table";
                        $query = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($query))
                        {
                            $category = $row['category_name'];
                        ?>
                        <option value="<?php echo $category?>"><?php echo "$category"?></option>   
                        <?php } ?>
                    </select>
                    <br>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete" id="delete_category">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function()
        {
            let x = Math.ceil(Math.random() * 100000);
            $("#add_item_id").val("ID"+x);
            $("#add_item_id").attr('readonly', 'readonly');
        });
        $("#add_generate_btn").click(function()
        {
            let x = Math.ceil(Math.random() * 100000);
            $("#add_item_id").val("ID"+x);
            $("#add_item_id").attr('readonly', 'readonly');
        });
        $(document).on('click','#add_btn', function()
        {
            var item_id = $("#add_item_id").val();
            var item_name = $('#add_item_name').val();
            var item_brand = $('#add_item_brand').val();
            var item_price = $('#add_item_price').val();
            var item_supplier = $('#add_item_supplier').val();
            var item_category = $('#add_item_category').val();
            var item_description = $('#add_item_description').val();
            var item_quantity = $('#add_item_quantity').val();
            var acquisition_date = $('#add_acquisition_date').val();
            var expiry_date = $('#add_expiry_date').val();

            var history_id = (Math.random()).toString(36).substring(7).toUpperCase();
            var data_values = 
            {
                "item_id" : item_id, "item_name" : item_name,"item_brand" : item_brand,"item_supplier" : item_supplier, "item_quantity" : item_quantity, "item_price" : item_price,
                "item_category" : item_category,  "acquisition_date" : acquisition_date, "item_description": item_description, "history_id" : history_id, "expiry_date" : expiry_date
            }
            Swal.fire({
            title: 'Are you sure you want to add '+item_name+'?',
            text: "Adding this will add into your Hardware Inventory!",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => 
            {
            if (result.isConfirmed)
            {
                $.ajax
                ({
                    type: "POST",
                    url: "php_operation/add_product.php",
                    data: data_values,
                    cache: false,
                    success: function(data)
                    {
                        success_action();   
                    }
                });
            }
            });
        });
        $(document).on('click','#add_category_btn', function()
        {
            var add_new_item_categoy = $("#add_new_item_categoy").val();
            var history_id = (Math.random()).toString(36).substring(7).toUpperCase()+Math.ceil(Math.random() * 100000);
            var data_values = 
            {
                 "history_id" : history_id, "item_category":add_new_item_categoy
            }
            Swal.fire({
            title: 'Are you sure you want to add this category ' + add_new_item_categoy + '?',
            text: "Adding this will add data in Inventory database!",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => {
            if (result.isConfirmed){
                $.ajax
                ({
                    type: "POST",
                    url: "php_operation/add_category.php",
                    data: data_values,
                    success: function(data)
                    {
                        success_action();
                    },
                    error:function(){}
                })
            }
            });
        })
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
        function checkExist()
        {
            $.ajax
            ({
                type: "POST",
                url: "php_operation/check_exist.php",
                data: 'item_category='+$("#add_new_item_categoy").val(),
                success: function(data)
                {
                    $("#check_category").html(data);
                },
                error:function(){}
            });
        }
        function delete_success()
        {
            Swal.fire
            ({
                icon: 'success',
                title: 'Deleted',
                text: 'You have successfully deleted!',
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
        $(document).on('click','#delete_category', function(){

            var delete_item_category = $("#delete_item_category").val();
            var history_id = (Math.random()).toString(36).substring(7).toUpperCase()+Math.ceil(Math.random() * 100000);
            var data_values = 
            {
                 "history_id" : history_id, "item_category":delete_item_category
            }
            Swal.fire({
            title: 'Are you sure you want to delete this category ' + delete_item_category + '?',
            text: "Deleting this will remmove data in Inventory database!",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => {
            if (result.isConfirmed){
                $.ajax
                ({
                    type: "POST",
                    url: "php_operation/delete_category.php",
                    data: data_values,
                    success: function(data){
                        delete_success();
                    },
                    error: function(){
                    }
                });
            }
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
