<?php
//cart.php
session_start();
require 'db.php';
/* $_SESSION['post-data'] = $_POST; */

/* echo( $_SESSION['post-data']['firstName']. "<br>"); 8/

$date = date("Y-m-d H:i:s", strtotime($date));
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Receipt - Nonna's Table </title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/sections.css">
    <link rel="stylesheet" href="css/font_styles.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        @media print {
            #print {
                display: none;
            }

            #makeAnotherOrder {
                display: none;
            }
            
            table, td.receipt {
                width: 500px;
                margin: 0 auto;
            }
            
            header, footer {
                display: none;
            }
        }
    </style>
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
        <div class="sec-animate">
            <span class="title2">Thanks for your order!</span>
            <hr class="one">
            
            <?php

            if (isset($_POST["place_order"])) {
                $email = $_POST['email'];
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $region = $_POST['region'];
                $country = $_POST['country'];
                $postalCode = $_POST['postalCode'];
                $phoneNumber = $_POST['phoneNumber'];
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }
                if (isset($_POST['time'])) {
                    $time = $_POST['time'];
                }
                $date = $date . $time;
                $date = date("Y-m-d H:i:s", strtotime($date));
                $totalPrice = $_SESSION['total_price'];


                $insert_customer = "INSERT INTO customers
                 (Customer_Email, Customer_First_Name, Customer_Last_Name, Customer_Address, Customer_City,
                  Customer_State, Customer_Country, Customer_Postal_Code, Customer_Phone )
                 VALUES ( '$email', '$firstName', '$lastName', '$address', '$city', '$region', '$country', '$postalCode',
                '$phoneNumber' )";
                $customer_id = "";
                if ($mysqli->query($insert_customer)) {
                    $customer_id = $mysqli->insert_id;
                } else {
                    echo "Error entering values into database: " . $mysqli->error . "<br>";
                }

                $insert_order = "  
                             INSERT INTO orders(Customer_ID, Order_Submitted_Date, Order_Pickup_Date, Order_Receipt_Code, Order_Total_Price)  
                             VALUES('" . $customer_id . "', '" . date('Y-m-d H:i:s') . "', '" . $date . "', '111111',  '" . $_SESSION['total_price'] . "')
                             ";
                $order_id = "";
                if ($mysqli->query($insert_order)) {
                    $order_id = $mysqli->insert_id;
                } else {
                    echo "Error entering values into database: " . $mysqli->error . "<br>";
                }
                $_SESSION["order_id"] = $order_id;
                $order_details = "";
                foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                    $order_details .= "  
                                  INSERT INTO order_lines(Order_ID, Product_ID, Order_Product_Quantity)  
                                  VALUES('" . $order_id . "', '" . $values["product_id"] . "', '" . $values["product_quantity"] . "');  
                                  ";
                }
                if ($mysqli->multi_query($order_details)) {
                    unset($_SESSION["shopping_cart"]);
                    echo '<script>alert("You have successfully placed an order... Thank you!")</script>';
                    echo '<script>window.location.href="cart.php"</script>';
                } else {
                    echo "Error entering values into database: " . $mysqli->error . "<br>";
                }
            }
            if (isset($_SESSION["order_id"])) {
                $customer_details = '';
                $order_details = '';
                $total = 0;
                $subtotal = 0;
                $tax = 0;
                $query = '  
                             SELECT * FROM orders  
                             INNER JOIN customers  
                             ON customers.Customer_ID = orders.Customer_ID 
                             WHERE orders.Order_ID = "' . $_SESSION["order_id"] . '"  
                             ';
                $result = $mysqli->query($query);
                while ($row = mysqli_fetch_array($result)) {
                    $customer_details = '  
                                  <label>' . $row["Customer_Last_Name"] . ', ' . $row["Customer_First_Name"] . '</label><br> 
                                  <p>' . $row["Customer_Address"] . '</p>  
                                  <p>' . $row["Customer_City"] . ', ' . $row["Customer_Postal_Code"] . '</p>  
                                  <p>' . $row["Customer_Country"] . '</p>
                                  <p>Pickup Time: ' . date("m-d-Y h:i A", strtotime($row["Order_Pickup_Date"])) . '</p>   
                                  ';
                }
                $query = '  
                             SELECT * FROM order_lines  
                             INNER JOIN orders  
                             ON orders.Order_ID = order_lines.Order_ID
                             INNER JOIN products  
                             ON products.Product_ID = order_lines.Product_ID 
                             WHERE order_lines.Order_ID = "' . $_SESSION["order_id"] . '"  
                             ';
                $result = $mysqli->query($query);
                while ($row = mysqli_fetch_array($result)) {
                    $order_details .= "  
                                       <tr>  
                                            <td>" . $row["Product_Name"] . "</td>  
                                            <td>" . $row["Order_Product_Quantity"] . "</td>  
                                            <td>" . $row["Product_Price"] . "</td>  
                                            <td>" . number_format($row["Order_Product_Quantity"] * $row["Product_Price"], 2) . "</td>  
                                       </tr>  
                                  ";
                    $subtotal = $subtotal + ($row["Order_Product_Quantity"] * $row["Product_Price"]);
                    $tax = $tax + (($row["Order_Product_Quantity"] * $row["Product_Price"]) * 0.075);
                    $total = $subtotal + $tax;
                }
                echo '  
                             <h3 class="orderS">Order summary for Order No. ' . $_SESSION["order_id"] . '</h3>  
                             <div class="container-Receipt">  
                                  <table class="receipt">  
                                       <tr>  
                                            <td><label><strong>Customer Details<strong></label></td>  
                                       </tr>  
                                       <tr>  
                                            <td>' . $customer_details . '</td>  
                                       </tr>  
                                       <tr>  
                                            <td><label><strong>Order Details<strong></label></td>  
                                       </tr>  
                                       <tr>  
                                            <td>  
                                                 <table>  
                                                      <tr>  
                                                           <th width="50%">Product Name</th>  
                                                           <th width="15%">Quantity</th>  
                                                           <th width="15%">Price</th>  
                                                           <th width="20%">Total</th>  
                                                      </tr>  
                                                      ' . $order_details . '  
                                                      <tr>  
                                                      <td colspan="3" align="right">Subtotal<br></br>Tax (7.5%)<br></br>Total</td>
                                                      <td align="right">$ ' . number_format($subtotal, 2) . '<br></br>$  ' . number_format($tax, 2) . '<br></br>$   ' . number_format($total, 2) . '</td>
                                                      </tr>  
                                                 </table>  
                                                    
                                                <div style="text-align: center; margin-top: 12px">
                                                 <input type="button" style="margin-right: 10px;" id="print" class="submitButton print" value="Print"/>
                                                 <script type="text/javascript">
                                                 document.getElementById("print").onclick = function () {
                                                     window.print();
                                                 };
                                                 </script>

                                                 <input type="button" style="width: 200px;" id= "makeAnotherOrder" class="submitButton make-new-order" value="Make another order"/>
                                                 <script type="text/javascript">
                                                 document.getElementById("makeAnotherOrder").onclick = function () {
                                                     location.href = "all-products-tab.php";
                                                 };
                                                 </script>
                                                 </div>
                                            </td>  
                                       </tr>  
                                  </table>  
                             </div>  
                             ';
            } else {
                echo "Error getting values from database: " . $mysqli->error . "<br>";
            }
            ?>
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