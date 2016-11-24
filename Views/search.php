<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
</head>
<body>
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
                            <button class="btn btn-outline-info" type="button" onclick="loadCart()" href="#">
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
    <div class="container " style="padding-top:70px">
        <div class="mt-1">
            <h1>Search</h1>
            <hr />
        </div>
        <form class="form-inline">
            <input class="form-control" type="text" placeholder="Search" id="search" />
            <button class="btn btn-outline-success" type="button" onclick="authorSearch()">Search by Author</button>
            <button class="btn btn-outline-success" type="button" onclick="titleSearch()">Search by Title</button>
        </form>
        <hr />
        <div class="row" id="noResults">
            <div class="card card-outline-danger text-xs-center">
                <div class="card-block">
                    <blockquote class="card-blockquote">
                        <p>No Results</p>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="row" id="Results">
            <div class="card card-outline-success text-xs-center">
                <div class="card-block">
                    <blockquote class="card-blockquote">
                        <div id="data"></div>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script>
        var isTitle = false;
        var isAuthor = false;
        $(document).ready(function () {
            $("#noResults").hide();
            $("#Results").hide();
            cart();
            var isTitle = false;
            var isAuthor = false;
        });

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

        function authorSearch() {
            isTitle = false;
            isAuthor = true;
            var search = $("#search").val();
            $.ajax({
                url: 'api/search.php?author=' + search,
                complete: function (response) {
                    if (response.responseText == '0') {
                        $("#Results").hide();
                        $("#noResults").show();
                    }
                    else {
                        console.log(response.responseText);
                        $('#data').empty();
                        //$('#data').append(response.responseText);
                        var data = $.parseJSON(response.responseText);
                        for (var i = 0; i < data.length; i++) {
                            //$('#data').append(data[i].name);
                            if (data[i].number < 1) {
                                $('#data').append('<div class="col-md-3"><div class="card"><div class="card-block"> <h5 class="card-title">' + data[i].title + '<hr/><h6 class="card-subtitle text-muted float-lg-left">Stock: ' + data[i].number + '</h6><h6 class="card-subtitle text-muted  float-lg-right">In cart: ' + data[i].inCart + '</h6>&nbsp;</h5> <p class="card-text"><ul class="list-group"> <li class="list-group-item">Author: ' + data[i].name + '</li>  <li class="list-group-item">Publisher: ' + data[i].publisher + '</li> <li class="list-group-item">Address: ' + data[i].address + '</li> <li class="list-group-item">Phone: ' + data[i].phone + '</li>  <li class="list-group-item">Price: ' + data[i].price + '$</li> </ul></p> <button  class="btn btn-outline-danger">Out of stock</button> </div> </div></div>');
                                cart();
                            }
                            else {
                                $('#data').append('<div class="col-md-3"><div class="card"><div class="card-block"> <h5 class="card-title">' + data[i].title + '<hr/><h6 class="card-subtitle text-muted float-lg-left">Stock: ' + data[i].number + '</h6><h6 class="card-subtitle text-muted  float-lg-right">In cart: ' + data[i].inCart + '</h6>&nbsp;</h5> <p class="card-text"><ul class="list-group"> <li class="list-group-item">Author: ' + data[i].name + '</li>  <li class="list-group-item">Publisher: ' + data[i].publisher + '</li> <li class="list-group-item">Address: ' + data[i].address + '</li> <li class="list-group-item">Phone: ' + data[i].phone + '</li>  <li class="list-group-item">Price: ' + data[i].price + '$</li> </ul></p> <button  class="btn btn-outline-success" onclick="addToCart(' + data[i].isbn + ')">Add to cart</button> </div> </div></div>');
                                cart();
                            }
                        }
                        $("#noResults").hide();
                        $("#Results").show();
                    }
                },
                error: function () {

                },
            });
            return false;
        };

        function titleSearch() {
            isTitle = true;
            isAuthor = false;
            var search = $("#search").val();
            $.ajax({
                url: 'api/search.php?title=' + search,
                complete: function (response) {
                    console.log(response.responseText);
                    if (response.responseText == '0') {
                        $("#Results").hide();
                        $("#noResults").show();
                    }
                    else {
                        console.log(response.responseText);
                        $('#data').empty();
                        //$('#data').append(response.responseText);
                        var data = $.parseJSON(response.responseText);
                        for (var i = 0; i < data.length; i++) {
                            //$('#data').append(data[i].name);
                            console.log(data[i].inCart);
                            if (data[i].number < 1) {
                                $('#data').append('<div class="col-md-3"><div class="card"><div class="card-block"> <h5 class="card-title">' + data[i].title + '<hr/><h6 class="card-subtitle text-muted float-lg-left">Stock: ' + data[i].number + '</h6><h6 class="card-subtitle text-muted  float-lg-right">In cart: ' + data[i].inCart + '</h6>&nbsp;</h5> <p class="card-text"><ul class="list-group"> <li class="list-group-item">Author: ' + data[i].name + '</li>  <li class="list-group-item">Publisher: ' + data[i].publisher + '</li> <li class="list-group-item">Address: ' + data[i].address + '</li> <li class="list-group-item">Phone: ' + data[i].phone + '</li>  <li class="list-group-item">Price: ' + data[i].price + '$</li> </ul></p> <button  class="btn btn-outline-danger">Out of stock</button> </div> </div></div>');
                                cart();
                            }
                            else {
                                $('#data').append('<div class="col-md-3"><div class="card"><div class="card-block"> <h5 class="card-title">' + data[i].title + '<hr/><h6 class="card-subtitle text-muted float-lg-left">Stock: ' + data[i].number + '</h6><h6 class="card-subtitle text-muted  float-lg-right">In cart: ' + data[i].inCart + '</h6>&nbsp;</h5> <p class="card-text"><ul class="list-group"> <li class="list-group-item">Author: ' + data[i].name + '</li>  <li class="list-group-item">Publisher: ' + data[i].publisher + '</li> <li class="list-group-item">Address: ' + data[i].address + '</li> <li class="list-group-item">Phone: ' + data[i].phone + '</li>  <li class="list-group-item">Price: ' + data[i].price + '$</li> </ul></p> <button  class="btn btn-outline-success" onclick="addToCart(' + data[i].isbn + ')">Add to cart</button> </div> </div></div>');
                                cart();
                            }
                        }
                        $("#noResults").hide();
                        $("#Results").show();
                    }
                },
                error: function () {

                },
            });
            return false
        };

        function addToCart(isbn) {
            cart()
            $.ajax({
                url: 'api/cartAdd.php?isbn=' + isbn,
                complete: function (response) {
                    if (isAuthor) {
                        authorSearch();
                    }
                    else {
                        titleSearch();
                    }
                },
                error: function () {

                },
            });
            return false;
        };

        function loadCart() {
            window.location = "http://" + window.location.hostname + ':' + window.location.port + '/cheapbooks/checkout.php'
        };

        function dashboard() {
            window.location = "http://" + window.location.hostname + ':' + window.location.port + '/cheapbooks/dashboard.php'
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
    </script>
</body>
</html>
