<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu - Nonna's Table</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/sections.css">
    <link rel="stylesheet" href="css/font_styles.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<header>
    <div class="container">
        <nav class="fixNav">
            <span id="home" class="fixSpan">Nonna's Table</span>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="all-products-tab.php" style="color: khaki;">Order Now</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="sec-MCR">
    <span class="title2">Discover the menu</span>
    <hr class="one">

    <div class="container-Menu">
        <div class="container-Tabs">
            <a class="tabs" href="all-products-tab.php">All Products</a>
            <a class="tabs" href="appetizers-tab.php">Appetizers</a>
            <a class="tabs" href="soups-tab.php">Soups</a>
            <a class="tabs" href="entrees-tab.php">Entrees</a>
            <a class="tabs" href="seafood-tab.php">Seafood</a>
            <a class="tabs" href="desserts-tab.php" style="background-color: khaki;">Desserts</a>
            <a class="tabs" href="drinks-tab.php">Drinks</a>
            <a class="tabs" href="cart-tab.php">Cart <span class="badge">
                    <?php if (isset($_SESSION["shopping_cart"])) {
                        echo count($_SESSION["shopping_cart"]);
                    } else {
                        echo '0';
                    } ?></span>
            </a>
        </div>

        <div id="desserts" class="container-Products pro-animate">
            <?php

            require 'db.php';
            $query = "SELECT * FROM PRODUCTS 
                      WHERE Product_Type = 'Desserts'
                      ORDER BY PRODUCT_ID ASC";

            /* Try to query the database */
            if ($result = $mysqli->query($query)) {
                // Verify that there are more than 0 rows
                if ($result->num_rows > 0) {
                    // Fetch and print associated rows
                    while ($row = $result->fetch_assoc()) {
                        // print_r($product);
                        ?>
                        <div class="grid-menu">
                            <div class="grid-items">
                                <!-- Prints the Product Name -->
                                <img class="imgRadius" src="food/<?php echo $row['Product_Image']; ?>" height="180" width="258"/><br/>
                                <h3 class="food-title"><?php echo $row['Product_Name']; ?></h3>
                                <button class="accordion">View details &darr;</button>
                                <div class="panel">
                                    <p class="food-desc" id="viewdetails<?php echo $row['Product_Type'];
                                    echo $row['Product_ID']; ?>"><?php echo $row['Product_Description']; ?></p>
                                </div>
                                <h3 class="tPrice">$ <?php echo $row['Product_Price']; ?></h3>
                                <input type="text" name="quantity" id="quantity<?php echo $row["Product_ID"]; ?>"
                                       class="textProduct form-control" value="1"/>
                                <input type="hidden" name="hidden_name" id="name<?php echo $row["Product_ID"]; ?>"
                                       value="<?php echo $row["Product_Name"]; ?>"/>
                                <input type="hidden" name="hidden_price" id="price<?php echo $row["Product_ID"]; ?>"
                                       value="<?php echo $row["Product_Price"]; ?>"/>
                                <input type="button" name="add_to_cart" id="<?php echo $row["Product_ID"]; ?>"
                                       class="buttonProduct form-control add_to_cart"
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
    </div>
</div>

<a href="javascript:" id="return-to-top"><i class="fa fa-angle-double-up"></i></a>

<footer>
    <div class="line"></div>
    <div class="info-container">
        <span class="logo">Nonna's Table</span>
        <span class="info-footer">1800 Denn John Lane, Kissimmee, FL 34744</span>

        <span class="title-footer">Email: <span style="color: rgba(255, 255, 255, 0.45); text-transform: lowercase;">nonnastable@gmail.com</span></span>
        <span class="title-footer" style="margin-top: 20px;">Working Hours:</span>
        <span class="info-footer">MON - FRI: 11:00 A.M. - 10:00 P.M.</span>
        <span class="info-footer">SAT - SUN: 11:00 A.M. - 11:00 P.M.</span>
        <span class="title-footer">Phone: <span
                    style="color: rgba(255, 255, 255, 0.45);">+1 (407) 563 7883</span></span>
        <form class="newsletter">
            <input type="text" class="newsletter-box" placeholder="Subscribe to our newsletter">
            <input type="submit" value="SUBMIT" class="newsletter-button">
        </form>
    </div>

    <div class="line" style="margin-top: 30px;"></div>

    <div class="copy-container">
        <span class="copyright">&copy; Nonna's Table 2018. All rights reserved.</span>
    </div>
    
    <div class="warning-container">
        <marquee behavior="scroll" direction="left" class="project-warning">This page is for a college project and is not a real website. We and Valencia College do not own or are making any money off from anything included in the website including images and backgrounds. This website has been made for educational purposes only. </marquee>
    </div>
</footer>
</body>
</html>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/functions.js"></script>

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
                        alert("Product has been added into Cart");
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
