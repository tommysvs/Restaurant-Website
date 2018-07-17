<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" href="cart.css">

</head>
<body>

<header>
    <div class="container ">
        <nav>
            <span id="home">Nonna's Table</span>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html" style="color: khaki;">About</a></li>
                <li><a href="all-products-tab.php">Order Now</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container" style="width:1000px;">
    <h3 align="center">Orders</h3>
    <p>
        <a href="all-products-tab.php">All Products</a>&emsp;|&emsp;
        <a href="appetizers-tab.php">Appetizers</a>&emsp;|&emsp;
        <a href="soups-tab.php">Soups</a>&emsp;|&emsp;
        <a href="entrees-tab.php">Entrees</a>&emsp;|&emsp;
        <a href="seafood-tab.php">Seafood</a>&emsp;|&emsp;
        <a href="desserts-tab.php">Desserts</a>&emsp;|&emsp;
        <a href="drinks-tab.php">Drinks</a>&emsp;|&emsp;
        <a href="cart-tab.php">Cart <span class="badge"><?php if (isset($_SESSION["shopping_cart"])) {
                    echo count($_SESSION["shopping_cart"]);
                } else {
                    echo '0';
                } ?></span></a>
    </p>
    <div>

        <div id="drinks">
            <?php

            require 'db.php';
            $query = "SELECT * FROM PRODUCTS 
                      WHERE Product_Type = 'Drinks'
                      ORDER BY PRODUCT_ID ASC";

            /* Try to query the database */
            if ($result = $mysqli->query($query)) {
                // Verify that there are more than 0 rows
                if ($result->num_rows > 0) {
                    // Fetch and print associated rows
                    while ($row = $result->fetch_assoc()) {
                        // print_r($product);
                        ?>
                        <!-- Columns that will display products -->
                        <div class="col-sm-3 col-md-4">
                            <!-- Uses post to send the Product ID to the URL -->
                            <div class="products">
                                <!-- Prints the Product Name -->
                                <img src="food/<?php echo $row['Product_Image']; ?>" height="180" width="258"/><br/>
                                <h4 class="text-info"><?php echo $row['Product_Name']; ?></h4>
                                <p class="collapse" id="viewdetails<?php echo $row['Product_Type'];
                                echo $row['Product_ID']; ?>"><?php echo $row['Product_Description']; ?></p>
                                <p><a class="btn" data-toggle="collapse"
                                      data-target="#viewdetails<?php echo $row['Product_Type'];
                                      echo $row['Product_ID']; ?>">View details &raquo;</a></p>
                                <h4 class="text-danger">$ <?php echo $row['Product_Price']; ?></h4>
                                <input type="text" name="quantity" id="quantity<?php echo $row["Product_ID"]; ?>"
                                       class="form-control" value="1"/>
                                <input type="hidden" name="hidden_name" id="name<?php echo $row["Product_ID"]; ?>"
                                       value="<?php echo $row["Product_Name"]; ?>"/>
                                <input type="hidden" name="hidden_price" id="price<?php echo $row["Product_ID"]; ?>"
                                       value="<?php echo $row["Product_Price"]; ?>"/>
                                <input type="button" name="add_to_cart" id="<?php echo $row["Product_ID"]; ?>"
                                       style="margin-top:5px;" class="btn btn-info form-control add_to_cart"
                                       value="Add to Cart"/>
                                <br>
                            </div>
                        </div>

                        <?php
                    }
                }
            } else {
                echo "Error getting products from the database: " . $mysqli->error . "<br>";
            }
            ?>
        </div>
</body>
</html>
<script>
    $(document).ready(function (data) {
        $('.add_to_cart').click(function () {
            var product_id = $(this).attr("id");
            var product_name = $('#name' + product_id).val();
            var product_price = $('#price' + product_id).val();
            var product_quantity = $('#quantity' + product_id).val();
            var action = "add";
            if (product_quantity > 0) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        product_id: product_id,
                        product_name: product_name,
                        product_price: product_price,
                        product_quantity: product_quantity,
                        action: action
                    },
                    success: function (data) {
                        $('#order_table').html(data.order_table);
                        $('.badge').text(data.cart_item);
                        alert("Product has been Added into Cart");
                    }
                });
            }
            else {
                alert("Please Enter Number of Quantity")
            }
        });
        $(document).on('click', '.delete', function () {
            var product_id = $(this).attr("id");
            var action = "remove";
            if (confirm("Are you sure you want to remove this product?")) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    dataType: "json",
                    data: {product_id: product_id, action: action},
                    success: function (data) {
                        $('#order_table').html(data.order_table);
                        $('.badge').text(data.cart_item);
                    }
                });
            }
            else {
                return false;
            }
        });
        $(document).on('keyup', '.quantity', function () {
            var product_id = $(this).data("product_id");
            var quantity = $(this).val();
            var action = "quantity_change";
            if (quantity != '') {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    dataType: "json",
                    data: {product_id: product_id, quantity: quantity, action: action},
                    success: function (data) {
                        $('#order_table').html(data.order_table);
                    }
                });
            }
        });
    });
</script>
