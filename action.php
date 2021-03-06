<?php
//action.php
session_start();
require 'db.php';
if (isset($_POST["product_id"])) {
    $order_table = '';
    $message = '';
    if ($_POST["action"] == "add") {
        if (isset($_SESSION["shopping_cart"])) {
            $is_available = 0;
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                if ($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"]) {
                    $is_available++;
                    $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
                }
            }
            if ($is_available < 1) {
                $item_array = array(
                    'product_id' => $_POST["product_id"],
                    'product_name' => $_POST["product_name"],
                    'product_price' => $_POST["product_price"],
                    'product_quantity' => $_POST["product_quantity"]
                );
                $_SESSION["shopping_cart"][] = $item_array;
            }
        } else {
            $item_array = array(
                'product_id' => $_POST["product_id"],
                'product_name' => $_POST["product_name"],
                'product_price' => $_POST["product_price"],
                'product_quantity' => $_POST["product_quantity"]
            );
            $_SESSION["shopping_cart"][] = $item_array;
        }
    }
    if ($_POST["action"] == "remove") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["product_id"] == $_POST["product_id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                $message = '<h2 class="cartEmpty"><strong>Product removed</strong></h2>';
            }
        }
    }
    if ($_POST["action"] == "quantity_change") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"]) {
                $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];
            }
        }
    }
    $order_table .= '  
           ' . $message . '  
           <table>  
                <tr>  
                     <th width="40%">Product Name</th>  
                     <th width="10%">Quantity</th>  
                     <th width="20%">Price</th>  
                     <th width="15%">Total</th>  
                     <th width="5%">Action</th>  
                </tr>  
           ';
    if (!empty($_SESSION["shopping_cart"])) {
        $total = 0;
        $subtotal = 0;
        $tax = 0;
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            $order_table .= '  
                     <tr>  
                          <td>' . $values["product_name"] . '</td>  
                          <td><input type="text" name="quantity[]" id="quantity' . $values["product_id"] . '" value="' . $values["product_quantity"] . '" class="textQuantity quantity" data-product_id="' . $values["product_id"] . '" /></td>  
                          <td align="right">$ ' . $values["product_price"] . '</td>  
                          <td align="right">$ ' . number_format($values["product_quantity"] * $values["product_price"], 2) . '</td>  
                          <td><button name="delete" class="deleteButton delete" id="' . $values["product_id"] . '">Remove</button></td>  
                     </tr>  
                ';
            $subtotal = $subtotal + ($values['product_quantity'] * $values['product_price']);
            $tax = $tax + (($values['product_quantity'] * $values['product_price']) * 0.075);
            $total = $subtotal + $tax;
            $_SESSION['total_price'] = $total;
        }
        $order_table .= '  
                <tr>  
                            <td colspan="3" align="right">Subtotal<br></br>Tax (7.5%)<br><br>Total</td>
                            <td align="right">$ ' . number_format($subtotal, 2) . '<br><br>$  ' . number_format($tax, 2) . '<br><br>$   ' . number_format($total, 2) . '</td>
                            <td></td>
                </tr>  
                <tr>  
                     <td colspan="5" align="center">  
                                <button id="goToCheckout" class="submitButton submit-button">Checkout</button>
                                <script type="text/javascript">
                                    document.getElementById("goToCheckout").onclick = function () {
                                        location.href = "checkout.php";
                                    };
                                </script>
                     </td>  
                </tr>  
           ';
    }
    $order_table .= '</table>';
    $output = array(
        'order_table' => $order_table,
        'cart_item' => count($_SESSION["shopping_cart"])
    );
    echo json_encode($output);
} else {
    echo ("<h2 class=\"cartEmpty\">Cart is empty</h2>");
}
