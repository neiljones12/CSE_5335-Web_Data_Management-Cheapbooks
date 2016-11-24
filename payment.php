<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <style>
         .my-block {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
    </style>
</head>
<body style="padding-top:15em;padding-left:30em">
    <div class="my-block">
        <div>
            <h1>SUCCESSFUL CHECKOUT</h1><hr />
            <button class="btn btn-outline-info" onclick="dashboard()">Go Home</button>
        </div>
    </div> 
    <script src="bootstrap/js/jquery.min.js"></script>
    <script>

        function dashboard() {
            window.location = "http://" + window.location.hostname + ':' + window.location.port + '/cheapbooks/dashboard.php'
        };

    </script>
</body>
</html>
