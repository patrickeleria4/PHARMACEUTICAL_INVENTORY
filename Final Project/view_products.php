<?php 
    require_once("database.php");
    $sql = "DELETE FROM product_table WHERE item_quantity <=0 ";
    $query = mysqli_query($connection, $sql);
    session_start();
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
  background-repeat: no-repeat; background-size: cover; background-image: url('img/warehouse.jpg');">
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
    <div class="container bg-light mt-5" style="opacity:0.85;"><!-----------------------------------------------------view_product body---------->
        <div class="row m-3">
            <h3 class="text-center p-3">Manage Items</h3><hr>
            <div class="col">
                <table class="table table-hover table-responsive" id="view_table">
                    <thead>
                        <tr class="text-start" style="font-weight: bold;">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>                                
                        <?php
                            $sql = "SELECT * from product_table";
                            $query = mysqli_query($connection, $sql);
                            while($row = mysqli_fetch_assoc($query))
                            {
                                $item_id = $row['item_id'];
                                $item_name = $row['item_name'];
                                $item_brand = $row['item_brand'];
                                $item_price = $row['item_price'];
                                //$item_supplier = $row['item_supplier'];
                                $item_category = $row['item_category'];
                                $item_description = $row['item_description'];
                                $item_quantity = $row['item_quantity'];
                                $acquisition_date = $row['acquisition_date'];
                                $expiry_date = $row['expiry_date'];
                        ?>
                            <tr>
                                <td><?php echo $item_id?></td>
                                <td><?php echo $item_name?></td>
                                <td><?php echo $item_brand?></td>
                                <td><?php echo $item_price?></td>
                                
                                <td><?php echo $item_category?></td>
                                <td><?php echo $item_quantity?></td>
                                <td>                                              
                                    <div class="text-start">
                                        <button id="SelectBtn"type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Option
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" id="updateBtn"
                                                data-item_id = "<?php echo $item_id?>"
                                                data-item_name = "<?php echo $item_name?>"
                                                data-item_brand = "<?php echo $item_brand?>"
                                                data-item_price = "<?php echo $item_price?>"
                                                
                                                data-item_category = "<?php echo $item_category?>"
                                                data-item_description = "<?php echo $item_description?>"
                                                data-item_quantity = "<?php echo $item_quantity?>"
                                                data-acquisition_date = "<?php echo $acquisition_date?>"
                                                data-expiry_date = "<?php echo $expiry_date?>"
                                                data-bs-toggle="modal" data-bs-target="#updateModal"
                                                >Update</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="view_btn"
                                                data-item_id = "<?php echo $item_id?>"
                                                data-item_name = "<?php echo $item_name?>"
                                                data-item_brand = "<?php echo $item_brand?>"
                                                data-item_price = "<?php echo $item_price?>"
                                                
                                                data-item_category = "<?php echo $item_category?>"
                                                data-item_description = "<?php echo $item_description?>"
                                                data-item_quantity = "<?php echo $item_quantity?>"
                                                data-acquisition_date = "<?php echo $acquisition_date?>"
                                                data-expiry_date = "<?php echo $expiry_date?>"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                >View</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id="delete_btn" 
                                                data-item_id="<?php echo $item_id?>"
                                                data-item_name = "<?php echo $item_name?>">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>    
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-center text-white mt-auto">
        <div class="text-center p-3 text-light">
            <p>Artemis Drugstore IMS 1.0</p>
        </div>
    </footer>
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"><!--------------------------------------view---------------Modal -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="view_title"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <tbody>
                                <tr>
                                    <td><b>Id:</b></td>
                                    <td class="col-8" id="view_item_id"></td>
                                </tr>
                                <tr>
                                    <td><b>Name:</b></td>
                                    <td class="col-8" id="view_item_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Item Brand:</b></td>
                                    <td class="col-8" id="view_item_brand"></td>
                                </tr>
                                <tr>
                                    <td><b>Item Price:</b></td>
                                    <td class="col-8" id="view_item_price"></td>
                                </tr>
                                
                                <tr>
                                    <td><b>Item Category:</b></td>
                                    <td class="col-8" id="view_item_category"></td>
                                </tr>
                                <tr>
                                    <td><b>Item Description:</b></td>
                                    <td class="col-8" id="view_item_description"></td>
                                </tr>
                                <tr>
                                    <td><b>Item Quantity:</b></td>
                                    <td class="col-8" id="view_item_quantity"> </td>
                                </tr>
                                <tr>
                                    <td><b>Acquisition date:</b></td>
                                    <td class="col-8" id="view_acquisition_date"></td>
                                </tr>
                                <tr>
                                    <td><b>Expiry date:</b></td>
                                    <td class="col-8" id="view_expiry_date"></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModal"  tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"><!----------update modal-------------------->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-warning text-white">
                    <h1 class="modal-title">update Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td><b>Id:</b></td>
                                <td><input name="item_id" type="text" class="form-control" id="update_item_id"></td>
                            </tr>
                            <tr>
                                <td><b>Category</b></td>
                                <td>
                                    <select name="item_category" class="form-select" id="update_item_category">
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
                                <td><b>Name:</b></td>
                                <td><input name="item_name" type="text" class="form-control" placeholder="Enter Item name" id="update_item_name"></td>
                            </tr>
                            <tr>
                                <td><b>Brand:</b></td>
                                <td><input name="item_brand" type="text" class="form-control" placeholder="Enter Item Brand" id="update_item_brand"></td>
                            </tr>
                            <tr>
                                <td><b>Price:</b></td>
                                <td><input name="item_price" type="number" class="form-control" placeholder="Enter Item Price" id="update_item_price"></td>
                            </tr>
                            <tr>
                                <td><b>Description:</b></td>
                                <td><textarea class="form-control" name="item_description" placeholder="Enter Decription" id="update_item_description"></textarea></td>
                            </tr>
                            <tr>
                                <td><b>Quantity:</b></td>
                                <td><input name="item_quantity" type="number" class="form-control" placeholder="Enter Quantity" id="update_item_quantity"></td>
                            </tr>
                            <tr>
                                <td><b>Aquisition Date</b></td>
                                <td><input type="date" name="acquisition_date" class="form-control" id="update_acquisition_date"></td>
                            </tr>
                            <tr>
                                <td><b>Expiry Date</b></td>
                                <td><input type="date" name="expiry_date" class="form-control" id="update_expiry_date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-warning" data-bs-dismiss="modal" value="Save changes" id="update_btn">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function()
        {
            $("#view_table").DataTable({
                "responsive":true,
                "autoWidth":true
            });
        });
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
        $(document).on('click', '#update_btn', function()
        {
            var item_id = $("#update_item_id").val();
            var item_name = $('#update_item_name').val();
            var item_brand = $('#update_item_brand').val();
            var item_price = $('#update_item_price').val();
            //var item_supplier = $('#update_item_supplier').val();
            var item_category = $('#update_item_category').val();
            var item_description = $('#update_item_description').val();
            var item_quantity = $('#update_item_quantity').val();
            var acquisition_date = $('#update_acquisition_date').val();
            var history_id = (Math.random()).toString(36).substring(7).toUpperCase();
            var data_values = 
            {
                "item_id" : item_id, "item_name" : item_name,"item_brand" : item_supplier, "item_quantity" : item_quantity, "item_price" : item_price,
                "item_category" : item_category, "acquisition_date" : acquisition_date, "item_description": item_description, "history_id":history_id
            }
            Swal.fire({
            title: 'Are you sure you want to Update '+item_name+'?',
            text: "Updating this will change into your Drusgtore Inventory!",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => 
            {
            if (result.isConfirmed)
            {
                $.ajax
                ({
                    type: "POST",
                    url: "php_operation/update_product.php",
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
        $(document).on('click', '#delete_btn', function()
        {
            var item_id = $(this).data('item_id');
            var item_name = $(this).data('item_name');
            var history_id = (Math.random()).toString(36).substring(7).toUpperCase();
            var values = {
                "item_id" : item_id, "item_name":item_name, "history_id":history_id
            };
            Swal.fire({
            title: 'Are you sure you want to delete this item ' + item_name + '?',
            text: "Deleting this will not undo changes!",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => {
            if (result.isConfirmed){
                delete_product(values);
            }
            });
        });
        function delete_product(values)
        {
            $.ajax
            ({
                type: "POST",
                url: "php_operation/delete_product.php",
                data: values,
                cache: false,
                success: function(data)
                {
                    delete_success();
                }
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
        $(document).on('click','#updateBtn', function(){
            var item_id = $(this).data('item_id');
            var item_name = $(this).data('item_name');
            var item_brand = $(this).data('item_brand');
            var item_price = $(this).data('item_price');
           // var item_supplier = $(this).data('item_supplier');
            var item_category = $(this).data('item_category');
            var item_description = $(this).data('item_description');
            var item_quantity = $(this).data('item_quantity');
            var acquisition_date = $(this).data('acquisition_date');
            var expiry_date = $(this).data('expiry_date');
            $("#update_item_id").val(item_id);
            $("#update_item_id").attr('readonly', 'readonly');
            $("#update_item_name").val(item_name);
            $("#update_item_brand").val(item_brand);
            $("#update_item_price").val(item_price);
            $("#update_item_supplier").val(item_supplier);
            $("#update_item_category").val(item_category);
            $("#update_item_description").val(item_description);
            $("#update_item_quantity").val(item_quantity);
            $("#update_acquisition_date").val(acquisition_date);
            $("#update_expiry_date").val(expiry_date);
        });
        $(document).on('click','#view_btn', function(){
            var item_id = $(this).data('item_id');
            var item_name = $(this).data('item_name');
            var item_brand = $(this).data('item_brand');
            var item_price = $(this).data('item_price');
           // var item_supplier = $(this).data('item_supplier');
            var item_category = $(this).data('item_category');
            var item_description = $(this).data('item_description');
            var item_quantity = $(this).data('item_quantity');
            var acquisition_date = $(this).data('acquisition_date');
            var expiry_date = $(this).data('expiry_date');
            $("#view_title").text(item_name+" Details");
            $("#view_item_id").text(item_id);
            $("#view_item_name").text(item_name);
            $("#view_item_brand").text(item_brand);
            $("#view_item_price").text(item_price);
            $("#view_item_supplier").text(item_supplier);
            $("#view_item_category").text(item_category);
            $("#view_item_description").text(item_description);
            $("#view_item_quantity").text(item_quantity);
            $("#view_acquisition_date").text(acquisition_date);
            $("#view_expiry_date").text(expiry_date);
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
</html>