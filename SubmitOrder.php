<?php
// This php file is currently used for entering people into the database

require 'db.php';

// Capture the values posted to this php program from the text fields in the form

$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$city = $_POST['city'];
$region = $_POST['region'];
$country = $_POST['country'];
$postalCode = $_POST['postalCode'];
$phoneNumber = $_POST['phoneNumber'];


//Build a SQL Query using the values from above

$query = "INSERT INTO customers
         (CUSTOMER_EMAIL, CUSTOMER_FIRST_NAME, CUSTOMER_LAST_NAME, CUSTOMER_ADDRESS, CUSTOMER_CITY,
          CUSTOMER_STATE, CUSTOMER_COUNTRY, CUSTOMER_POSTAL_CODE, CUSTOMER_PHONE )
         VALUES ( '$email', '$firstName', '$lastName', '$address', '$city', '$region', '$country', '$postalCode',
        '$phoneNumber' )";

// Print the query to the browser so you can see it
echo($query . "<br>");

/*Try to insert into the database*/
if ($result = $mysqli->query($query)) {
    echo "<p>You have successfully entered values into the database.</p>";
} else {
    echo "Error entering values into database: " . mysqli_error($mysqli) . "<br>";
}
$mysqli->close();
