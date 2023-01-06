<!DOCTYPE html>
<html lang="en">
<head>
<title>Artemis Drugstore</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="shortcut icon" href="img/artemis.png">
</head>

<body style="background-color:#F7F7F7;">
    <div class="container mt-5 text-center">
        <img src="img/artemis.png" alt="" style="width:300px; height:300px;">
        <h1><b>Pharmaceutical Inventory System</b></h1>  
        <div class="bg-white p-3 mt-5 shadow shadow-lg" style="width:400px; border-radius:10px; margin:auto;">
            <input type="text" class="form-control input-lg" placeholder="Enter username" style="height:50px;" id="username"><br>
            <input type="password" class="form-control input-lg" placeholder="Enter password" style="height:50px;" id="password"> <br>
            <div class="d-grid gap-2">
                <button class="btn btn-primary text-center btn-lg" id="login_btn">Login</button>
            </div>
        </div>
    </div>
</body>
<script>
    $(function()
    {
        $("#login_btn").click(function()
        {
            var username = $("#username").val();
            var password = $("#password").val();
            if(username=="")
            {
                isEmpty("username");
                return;
            }
            if(password=="")
            {
                isEmpty("password");
                return;
            }
        checkLogin(username, password)
    });

    function checkLogin(username, password)
    {
        var values = 
        {
            "username": username, "password": password
        };
        $.ajax
        ({
            type: "POST",
            url: "php_operation/check_login.php",
            data: values,
            cache: false,
            success: function(data)
            {
                if(data=="success")
                {
                    gotoNewPage(username)
                }
                
                if(data=="invalid")
                {
                    alertDialog("error","Error", "Your login credentials are incorrect");
                }
            }
        });

        function gotoNewPage(username)
        {
            let timerInterval
            Swal.fire
            ({
                icon: 'success',
                title: 'Congratulations! You successfully login your account!',
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
                    location.href = 'profile.php?username='+username;
                }
            })
        }
        function alertDialog(icon,title,content)
        {
            Swal.fire(
            title,
            content,
            icon
        )}
    }
    function isEmpty(input)
    {
        Swal.fire(
        'Error',
        'Invalid input',
        'error'
    )}
    $("#cancelbtn").click(function()
        {
            $("#username").val("");
            $("#password").val("");
        });
    });
</script>
</html>
