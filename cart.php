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
    <title>cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <style>
        @media print {
            #print {
                display: none;
            }

            #makeAnotherOrder {
                display: none;
            }
        }
    </style>
</head>
<body>
<br/>
<div class="container" style="width:800px;">
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
            echo '<script>alert("You have successfully placed an order...Thank you")</script>';
            echo '<script>window.location.href="cart.php"</script>';
        } else {
            echo "Error entering values into database: " . $mysqli->error . "<br>";
        }
    }
    if (isset($_SESSION["order_id"])) {
        $customer_details = '';
        $order_details = '';
        $total = 0;
        $query = '  
                     SELECT * FROM orders  
                     INNER JOIN customers  
                     ON customers.Customer_ID = orders.Customer_ID 
                     WHERE orders.Order_ID = "' . $_SESSION["order_id"] . '"  
                     ';
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_array($result)) {
            $customer_details = '  
                          <label>' . $row["Customer_Last_Name"] . ', ' . $row["Customer_First_Name"] . '</label>  
                          <p>' . $row["Customer_Address"] . '</p>  
                          <p>' . $row["Customer_City"] . ', ' . $row["Customer_Postal_Code"] . '</p>  
                          <p>' . $row["Customer_Country"] . '</p>  
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
            $total = $total + ($row["Order_Product_Quantity"] * $row["Product_Price"]);
        }
        echo '  
                     <h3 align="center">Order Summary for Order No.' . $_SESSION["order_id"] . '</h3>  
                     <div class="table-responsive">  
                          <table class="table">  
                               <tr>  
                                    <td><label>Customer Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>' . $customer_details . '</td>  
                               </tr>  
                               <tr>  
                                    <td><label>Order Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>  
                                         <table class="table table-bordered">  
                                              <tr>  
                                                   <th width="50%">Product Name</th>  
                                                   <th width="15%">Quantity</th>  
                                                   <th width="15%">Price</th>  
                                                   <th width="20%">Total</th>  
                                              </tr>  
                                              ' . $order_details . '  
                                              <tr>  
                                                   <td colspan="3" align="right"><label>Total</label></td>  
                                                   <td>' . number_format($total, 2) . '</td>  
                                              </tr>  
                                         </table>  
                                                                         
                                
                                       <input type="button" 
                                       style="margin-top:5px;" id= "print" class="btn btn-info print"
                                       value="Print"/>
                                <script type="text/javascript">
                                    document.getElementById("print").onclick = function () {
                                        
                                        window.print();
                                    };
                                </script>
                                         
                                       <input type="button" 
                                       style="margin-top:5px;" id= "makeAnotherOrder" class="btn btn-info make-new-order"
                                       value="Make another order"/>
                                <script type="text/javascript">
                                    document.getElementById("makeAnotherOrder").onclick = function () {
                                        location.href = "all-products-tab.php";
                                    };
                                </script>

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
</body>
</html>