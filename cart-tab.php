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

<div class="sec1-menu">
        <span class="title2">Let's take a look!</span>
        <hr class="one">
        
        <div class="container-Menu">        
            <div class="container-Tabs">
                <a class="tabs" href="all-products-tab.php">All Products</a>
                <a class="tabs" href="appetizers-tab.php">Appetizers</a>
                <a class="tabs" href="soups-tab.php">Soups</a>
                <a class="tabs" href="entrees-tab.php">Entrees</a>
                <a class="tabs" href="seafood-tab.php">Seafood</a>
                <a class="tabs" href="desserts-tab.php">Desserts</a>
                <a class="tabs" href="drinks-tab.php">Drinks</a>
                <a class="tabs" href="cart-tab.php" style="background-color: khaki;">Cart <span class="badge">
                    <?php if (isset($_SESSION["shopping_cart"])) {
                            echo count($_SESSION["shopping_cart"]);
                        } else {
                            echo '0';
                        } ?></span>
                </a>
            </div>

        <div id="cart" class="container-Products">
            <div id="order_table">
                <table>
                    <tr>
                        <th width="40%">Product Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price</th>
                        <th width="15%">Total</th>
                        <th width="5%">Action</th>
                    </tr>
                    <?php
                    if (!empty($_SESSION['shopping_cart'])) {

                        $total = 0;
                        $subtotal = 0;
                        $tax = 0;
                        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                            ?>
                            <tr>
                                <td><?php echo $values["product_name"]; ?></td>
                                <td><input type="text" name="quantity[]"
                                           id="quantity<?php echo $values["product_id"]; ?>"
                                           value="<?php echo $values["product_quantity"]; ?>"
                                           data-product_id="<?php echo $values["product_id"]; ?>"
                                           class="textQuantity quantity"/></td>
                                <td align="right">$ <?php echo $values["product_price"]; ?></td>
                                <td align="right">
                                    $ <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>
                                <td>
                                    <button name="delete" class="deleteButton delete"
                                            id="<?php echo $values["product_id"]; ?>">Remove
                                    </button>
                                </td>
                            </tr>
                            <?php
                            $subtotal = $subtotal + ($values['product_quantity'] * $values['product_price']);
                            $tax = $tax + (($values['product_quantity'] * $values['product_price']) * 0.075);
                            $total = $subtotal + $tax;
                            $_SESSION['total_price'] = $total;
                        }
                        ?>
                        <tr>
                            <td colspan="3" align="right">Subtotal<br><br>Tax (7.5%)<br><br>Total</td>
                            <td align="right">$ <?php echo number_format($subtotal, 2); ?>
                                <br><br>$ <?php echo number_format($tax, 2); ?>
                                <br><br>$ <?php echo number_format($total, 2); ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <!-- Show checkout button only if the shopping cart is not empty -->
                            <td colspan="5" align="center">
                                <button id="goToCheckout" class="submitButton submit-button">Checkout</button>
                                <script type="text/javascript">
                                    document.getElementById("goToCheckout").onclick = function () {
                                        location.href = "checkout.php";
                                    };
                                </script>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
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
            <span class="title-footer">Phone: <span style="color: rgba(255, 255, 255, 0.45);">+1 (407) 563 7883</span></span>
            <form class="newsletter">
                <input type="text" class="newsletter-box" placeholder="Subscribe to our newsletter">
                <input type="submit" value="SUBMIT" class="newsletter-button">
            </form>
        </div>
        
        <div class="line" style="margin-top: 30px;"></div>
        
        <div class="copy-container">
            <span class="copyright">&copy; Nonna's Table 2018. All rights reserved.</span>
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
