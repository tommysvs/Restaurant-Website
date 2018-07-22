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

        <div id="cart">
            <div class="table-responsive" id="order_table">
                <table class="table table-bordered">
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
                                           class="form-control quantity"/></td>
                                <td align="right">$ <?php echo $values["product_price"]; ?></td>
                                <td align="right">
                                    $ <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>
                                <td>
                                    <button name="delete" class="btn btn-danger btn-xs delete"
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
                            <td colspan="3" align="right">Subtotal<br></br>Tax (7.5%)<br></br>Total</td>
                            <td align="right">$ <?php echo number_format($subtotal, 2); ?>
                                <br></br>$ <?php echo number_format($tax, 2); ?>
                                <br></br>$ <?php echo number_format($total, 2); ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <!-- Show checkout button only if the shopping cart is not empty -->
                            <td colspan="5" align="center">
                                <button id="goToCheckout" class="submit-button">Checkout</button>
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
