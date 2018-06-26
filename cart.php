<?php
require 'CartTracker.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="cart.css">

</head>
<body>
<div class="container">
    <?php

    require 'db.php';
    $query = 'SELECT * FROM PRODUCTS ORDER BY PRODUCT_ID ASC';

    /* Try to query the database */
    if ($result = $mysqli->query($query)) {
        // Verify that there are more than 0 rows
        if ($result->num_rows > 0) {
            // Fetch and print associated rows
            while ($product = $result->fetch_assoc()) {
                // print_r($product);
                ?>
                <!-- Columns that will display products -->
                <div class="col-sm-4 col-md-3">
                    <!-- Uses post to send the Product ID to the URL -->
                    <form method="post" action="cart.php?action=add&id=<?php echo $product['Product_ID']; ?>">
                        <div class="products">
                            <!-- Prints the Product Name -->
                            <img src="" class="img-responsive"/>
                            <h4 class="text-info"><?php echo $product['Product_Name']; ?></h4>
                            <h4>$ <?php echo $product['Product_Price']; ?></h4>
                            <input type="text" name="quantity" class="form-control" value="1"/>
                            <input type="hidden" name="name" value="<?php echo $product['Product_Name']; ?>"/>
                            <input type="hidden" name="price" value="<?php echo $product['Product_Price']; ?>"/>
                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info"
                                   value="Add to Cart"/>
                        </div>
                        <br>
                    </form>
                </div>

                <?php
            }
        }
    } else {
        echo "Error getting products from the database: " . $mysqli->error . "<br>";
    }
    ?>
    <div style="clear:both"></div>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th colspan="5"><h3>Order Details</h3></th>
            </tr>
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

                foreach ($_SESSION['shopping_cart'] as $key => $product):
                    ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>

                        <td><?php echo $product['quantity']; ?></td>
                        <td>$ <?php echo $product['price']; ?></td>
                        <td>$ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
                        <td>
                            <a href="cart.php?action=delete&id=<?php echo $product['id']; ?>">
                                <div class="btn-danger">Remove</div>
                            </a>
                        </td>
                    </tr>
                    <?php
                    $total = $total + ($product['quantity'] * $product['price']);
                endforeach;
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <!-- Show checkout button only if the shopping cart is not empty -->
                    <td colspan="5">
                        <?php
                        if (isset($_SESSION['shopping_cart'])) {
                            if (count($_SESSION['shopping_cart']) > 0) {
                                ?>
                                <a href="#" class="button">Checkout</a>
                            <?php };
                        }; ?>
                    </td>
                </tr>
                <?php
            };
            ?>
        </table>
    </div>
</div>
</body>
</html>
