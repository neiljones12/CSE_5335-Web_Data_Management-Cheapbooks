<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <style>
        .my-block {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
    </style>
</head>
<body style="padding-bottom:50px">
    <!-- Fixed navbar -->
    <div class="pos-f-t">
        <div class="collapse" id="navbar-header">
            <div class="container bg-inverse p-1">
                <h3>Collapsed content</h3>
                <p>Toggleable via the navbar brand.</p>
            </div>
        </div>
        <nav class="container navbar navbar-light navbar-static-top bg-faded">
            <div class="container">
                <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-expanded="false" aria-controls="exCollapsingNavbar2" aria-label="Toggle navigation"></button>
                <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
                    <a class="navbar-brand" onclick="dashboard()">
                        <?php
                        echo "WELCOME <span class='text-uppercase'>".$_SESSION["username"]."</span>";
                        ?>
                    </a>
                    <ul class="nav navbar-nav float-lg-right">
                        <li class="nav-item">
                            <button class="btn btn-outline-info" type="button" onclick="logout()" href="#">
                                Cart
                                <span id="cart"></span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-outline-danger" type="button" onclick="logout()" href="#">
                                Log out
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Begin page content -->
    <div class="" style="padding-top:70px">
        <div class="mt-1">
            <h1>Checkout</h1>
            <hr />
        </div>
        <div id="nodata" class="">
            <h4>Cart is empty</h4>
            <button class="btn btn-outline-info" onclick="dashboard()">Go Home</button>
        </div>
        <div id="data"></div>
        <hr />
        <button class="btn btn-lg btn-outline-info float-lg-right" type="button" onclick="checkout()">Checkout</button>
        <div id="total"></div>
    </div>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            loadCart();
            cart();
        });

        function checkout() {
            $.ajax({
                url: 'api/checkout.php',
                complete: function (response) {
                    window.location = "http://" + window.location.hostname + ':' + window.location.port + '/cheapbooks/dashboard.php'
                },
                error: function () {

                },
            });
            return false;
        };

        function loadCart() {
            $.ajax({
                url: 'api/loadCart.php',
                complete: function (response) {
                    if (response.responseText != 0)
                    {
                        $('#nodata').hide();
                    }
                    $('#data').empty(); 
                    var data = $.parseJSON(response.responseText); 
                    for (var i = 0; i < data.length; i++) {
                        $('#data').append('<button type="button" class="list-group-item list-group-item-action"> <div class="float-lg-left"> <h5 class="list-group-item-heading">' + data[i].title + '</h5> <p class="list-group-item-text">' + data[i].name + '</p> </div> <div class="float-lg-right"> <p>QUANTITY: ' + data[i].number + '</p> <p>COST: $' + data[i].price + '</p><hr /> <p>TOTAL COST: $' + data[i].total + '</p> </div> </button><br/>');
                        $('#total').empty();
                        $('#total').append('<h2 class="">GRAND TOTAL: $' + data[i].gtotal + '</h2>');
                    } 
                },
                error: function () {

                },
            });
            return false;
        };

        function cart() {
            $.ajax({
                url: 'api/cart.php',
                complete: function (response) {
                    $('#cart').empty();
                    $('#cart').append(response.responseText);
                },
                error: function () {

                },
            });
            return false;
        };

        function dashboard() {
            window.location = "http://" + window.location.hostname + ':' + window.location.port + '/cheapbooks/dashboard.php'
        };

        function logout() {
            $.ajax({
                url: 'api/deletesessionvariable.php',
                complete: function (response) {
                    window.location = "http://" + window.location.hostname + ':' + window.location.port + '/cheapbooks/'
                },
                error: function () {

                },
            });
            return false;
        };
    </script>
</body>
</html>
