<?php
    require_once("database.php");
    session_start();
    //$username="";
    if(isset($_GET['username']))
    {
        $username = $_GET['username'];
        $_SESSION['name'] = $_GET['username'];
    }
    if(!isset($username))
    {
        $username = $_SESSION['name'];
    }
    //$username = $_SESSION['name'];
    $sql = "SELECT * from user_table where user_username='$username'";
    $query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($query))
    {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_username = $row['user_username'];
        $user_email = $row['user_email'];
        $user_birthday = $row['user_birthday'];
        $user_acquisition = $row['user_acquisition'];
 $_SESSION['user_id'] = $row['user_id'];
$_SESSION['user_name'] = $row['user_name'];
$_SESSION['user_username'] = $row['user_username'];
$_SESSION['user_email'] =$row['user_email'];
$_SESSION['user_birthday'] = $row['user_birthday'];
$_SESSION['user_acquisition'] = $row['user_acquisition'];

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
<body class="d-flex flex-column min-vh-100">
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
    <?php
        $sql = "SELECT * FROM user_table";
        $query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($query))
        {
            $name = $row['user_name'];
        }
    ?>
    <div class="container mt-3 border">
        <div class="row text-center bg-secondary p-3 text-white">
            <h1 >Profile</h1>
        </div>
        <div class="row">
            <div class="col-3 m-3 text-center">
                <img class="card-img-top" src="img/avatar.jpg" alt="" style="margin:auto;">
                <span><b><?php echo $_SESSION['user_id']?></b></span>
            </div>
            <div class="col p-3">
                <table class="table">
                    <tbody>
                        <br><br><br>
                        <tr>
                            <th><span><b>Name: </b></span></th>
                            <th><span><b><?php echo $_SESSION['user_name']?></b></span></th>
                        </tr>
                        
                        <tr>
                            <th><span><b>Email: </b></span></th>
                            <th><span><b><?php echo $_SESSION['user_email']?></b></span></th>
                        </tr>
                        <tr>
                            <th><span><b>Birthday: </b></span></th>
                            <th><span><b> <?php echo $_SESSION['user_birthday']?></b></span></th>
                        </tr>
                        <tr>
                            <th><span><b>Account Created: </b></span></th>
                            <th><span><b> <?php echo $_SESSION['user_acquisition']?></b></span></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-center text-white mt-auto">
        <div class="text-center p-3 text-light">
            <p>Artemis Drugstore IMS 2.0</p>
        </div>
    </footer>
    <script>
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
    </script>
</body>
</html>