<?php 
    require_once("database.php");
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
    <div class="container bg-light mt-5 p-5" style="opacity:0.85;">
    
        <table class="" id="view_table">
            <thead>
                <tr class="text-start" style="font-weight: bold;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Date created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>                                
                <?php
                    $sql = "SELECT * from user_table";
                    $query = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_assoc($query))
                    {
                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $user_username = $row['user_username'];
                        $user_password = $row['user_password'];
                        $user_email = $row['user_email'];
                        $user_birthday = $row['user_birthday'];
                        $user_acquisition= $row['user_acquisition'];
                ?>
                    <tr>
                        <td><?php echo $user_id?></td>
                        <td><?php echo $user_name?></td>
                        <td><?php echo $user_username?></td>
                        <td><?php echo $user_password?></td>
                        <td><?php echo $user_email?></td>
                        <td><?php echo $user_birthday?></td>
                        <td><?php echo $user_acquisition?></td>
                        <td>                                              
                            <div class="text-start">
                                <button id="SelectBtn"type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                Option
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" id="updateBtn"
                                        data-user_id = "<?php echo $user_id?>"
                                        data-user_name = "<?php echo $user_name?>"
                                        data-user_username = "<?php echo $user_username?>"
                                        data-user_password = "<?php echo $user_password?>"
                                        data-user_email = "<?php echo $user_email?>"
                                        data-user_birthday = "<?php echo $user_birthday?>"
                                        data-user_acquisition = "<?php echo $user_acquisition?>"
                                        data-bs-toggle="modal" data-bs-target="#updateModal"
                                        >Update</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" id="delete_btn" 
                                        data-user_id="<?php echo $user_id?>"
                                        data-user_name = "<?php echo $user_name?>">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>    
                <?php } ?>
            </tbody>
        </table>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Create Account</button><!--ADD ACCOUNT MODAL-->
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><span>ID:</span></td>
                            <td>
                                <input name="enter_id" type="text" class="form-control" id="enter_id" required>
                                <button class="btn btn-primary btn-sm" id="generate_id">Generate</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Name:</span></td>
                            <td><input name="enter_name" type="text" class="form-control" placeholder="Enter name" id="enter_name" required></td>
                        </tr>
                        <tr>
                            <td><span>Username:</span></td>
                            <td><input name="enter_username" type="text" class="form-control" placeholder="Enter username" id="enter_username" required></td>
                        </tr>
                        <tr>
                            <td><span>Password:</span></td>
                            <td><input name="enter_password" type="password" class="form-control" placeholder="Enter password" id="enter_password" required></td>
                        </tr>
                        <tr>
                            <td><span>Confirm Password:</span></td>
                            <td>
                                <input name="enter_confirm" type="password" class="form-control" placeholder="Confirm password" id="enter_confirm" required>
                                <span id="check_confirm" class="text-danger"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Email:</span></td>
                            <td><input name="enter_email" type="text" class="form-control" placeholder="Enter Email" id="enter_email" required></td>
                        </tr>
                        <tr>
                            <td><span>Birthday: </span></td>
                            <td><input type="date" name="birth_date" class="form-control" id="birth_date" required></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="check_confrim();"id="register_btn">Register</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"><!--UPDATE ACCOUNT MODAL-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><span>ID:</span></td>
                            <td>
                                <input name="enter_id" type="text" class="form-control" id="update_user_id">
                            </td>
                        </tr>
                        <tr>
                            <td><span>Name:</span></td>
                            <td><input name="enter_name" type="text" class="form-control" placeholder="Enter name" id="update_user_name" required></td>
                        </tr>
                        <tr>
                            <td><span>Username:</span></td>
                            <td><input name="enter_username" type="text" class="form-control" placeholder="Enter username" id="update_user_username" required></td>
                        </tr>
                        <tr>
                            <td><span>Password:</span></td>
                            <td><input name="enter_password" type="password" class="form-control" placeholder="Enter password" id="update_user_password" required></td>
                        </tr>
                        <tr>
                            <td><span>Confirm Password:</span></td>
                            <td>
                                <input name="enter_confirm" type="password" class="form-control" placeholder="Confirm password" id="update_user_confirm" required>
                                <span id="update_check_confirm" class="text-danger"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Email:</span></td>
                            <td><input name="enter_email" type="text" class="form-control" placeholder="Enter Email" id="update_user_email" required></td>
                        </tr>
                        <tr>
                            <td><span>Birthday: </span></td>
                            <td><input type="date" name="birth_date" class="form-control" id="update_user_birthday" required></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="check_confrim();"id="update_register_btn">Register</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-center text-white mt-auto">
        <div class="text-center p-3 text-light">
            <p>Artemis Drugstore IMS 1.0</p>
        </div>
    </footer>
</body>
<script>
    $(document).ready(function()
    {
        let x = Math.ceil(Math.random() * 100000);
        $("#enter_id").val("ID-"+x);
        $("#enter_id").attr('readonly', 'readonly');
    });
    $("#generate_id").click(function()
    {
        let x = Math.ceil(Math.random() * 100000);
        $("#enter_id").val("ID-"+x);
        $("#enter_id").attr('readonly', 'readonly');
    });
    $(function()
    {
        $("#view_table").DataTable({
            "responsive":true,
            "autoWidth":true
        });
    });
    $(document).on('click','#updateBtn', function()
    {
        var user_id = $(this).data('user_id');
        var user_name = $(this).data('user_name')
        var user_username = $(this).data('user_username');
        var user_password = $(this).data('user_password');
        var user_email = $(this).data('user_email');
        var user_birthday = $(this).data('user_birthday');
        var user_acquisition = $(this).data('user_acquisition');
        $("#update_user_id").val(user_id);
        $("#update_user_id").attr('readonly', 'readonly');
        $("#update_user_name").val(user_name);
        $("#update_user_username").val(user_username);
        $("#update_user_password").val(user_password);
        $("#update_user_email").val(user_email);
        $("#update_user_birthday").val(user_birthday);
        $("#update_user_acquisition").val(user_acquisition);
    });
    $(document).on('click', '#delete_btn', function()
    {
        var user_id = $(this).data('user_id');
        var user_name = $(this).data('user_name');
        var history_id = (Math.random()).toString(36).substring(7).toUpperCase();
        var values = {
            "user_id" : user_id, "user_name":user_name, "history_id":history_id
        };
        Swal.fire({
        title: 'Are you sure you want to delete this ' + user_name + '?',
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
            url: "php_operation/delete_account.php",
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
    $(document).on('click', '#register_btn', function()
    {
        var id = $("#enter_id").val();
        var name = $("#enter_name").val();
        var username = $("#enter_username").val();
        var correct_pass = $("#enter_password").val();
        var pass = $("#enter_confirm").val();
        var email = $("#enter_email").val();
        var birthday = $("#birth_date").val();
        var data_values = 
        {
            "user_id" : id, "user_name" : name, "user_username" : username, "user_password" : pass, "user_email" : email, "user_birthday" : birthday
        }
        if(pass == correct_pass)
        {
            $("#check_confirm").html("");
            Swal.fire({
            title: 'Are you sure you want to Register ?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => {
            if (result.isConfirmed){
                register(data_values);
            }
            });
        }
        else
        {
            $("#check_confirm").html("wrong confirmation");
        }
    })
    function register(data_values)
    {
        $.ajax
        ({
            type: "POST",
            url: "php_operation/add_user.php",
            data: data_values,
            cache: false,
            success: function(data)
            {
                register_success();
            }
        });
    }
    function register_success()
    {
        Swal.fire
        ({
            icon: 'success',
            title: 'Registered',
            text: 'You have successfully Registered!',
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
    $(document).on('click', '#update_register_btn', function()
    {
        //alert("Asdasd");
        var id = $("#update_user_id").val();
        var name = $("#update_user_name").val();
        var username = $("#update_user_username").val();
        var correct_pass = $("#update_user_password").val();
        var pass = $("#update_user_confirm").val();
        var email = $("#update_user_email").val();
        var birthday = $("#update_user_birthday").val();
        var data_values = 
        {
            "user_id" : id, "user_name" : name, "user_username" : username, "user_password" : pass, "user_email" : email, "user_birthday" : birthday
        }
        if(pass == correct_pass)
        {
            $("#update_check_confirm").html("");
            Swal.fire({
            title: 'Are you sure you want to update '+name+'?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            }).then((result) => {
            if (result.isConfirmed){
                update_register(data_values);
            }
            });
        }
        else
        {
            $("#update_check_confirm").html("Password does not Match");
        }
    })
    function update_register(data_values)
    {
        $.ajax
        ({
            type: "POST",
            url: "php_operation/update_user.php",
            data: data_values,
            cache: false,
            success: function(data)
            {
                update_register_success();
            }
        });
    }
    function update_register_success()
    {
        Swal.fire
        ({
            icon: 'success',
            title: 'Registered',
            text: 'You have successfully Updated!',
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
</script>
</html>
