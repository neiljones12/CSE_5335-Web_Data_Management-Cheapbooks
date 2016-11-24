<?php
session_start();
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title></title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="custom.css" rel="stylesheet" /> 
</head>
<body>
    <div class="container"> 
        <?php
        if(!isset ($_SESSION["username"]))
        {
            echo "<h1>Unauthorized Access</h1><hr/>";
            echo "<p>Login to access the page</p>";
            echo "<button class='btn btn-default' onclick='redirectToLogin()'>Login</button>";
        }
        else
        {
            //loading the search page
            include '/views/checkout.php';
        }
        ?>
    </div> 
    <!-- jQuery -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        function redirectToLogin() { 
            window.location = "http://" + window.location.hostname + ':' + window.location.port +'/cheapbooks';
        };
    </script>
</body>