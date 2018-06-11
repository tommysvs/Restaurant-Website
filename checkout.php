<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <title>Checkout</title>
</head>
<body>
<form action="SubmitOrder.php" method="post">

    <!--  Email Field -->
    <label for="email"><i class="fa fa-envelope"></i>Email</label>
    <input type="text" id="email" name="email" placeholder="john@email.com">
    <br>

    <!--  First Name Field -->
    <label for="firstName"><i class="fa fa-envelope"></i>First Name</label>
    <input type="text" id="firstName" name="firstName" placeholder="John">
    <br>

    <!--  Last Name Field -->
    <label for="lastName"><i class="fa fa-envelope"></i>Last Name</label>
    <input type="text" id="lastName" name="lastName" placeholder="Doe">
    <br>

    <!-- Address Field -->
    <label for="address"><i class="fa fa-envelope"></i>Address</label>
    <input type="text" id="address" name="address" placeholder="123 Street Dr">
    <br>

    <!-- City Field -->
    <label for="city"><i class="fa fa-envelope"></i>City</label>
    <input type="text" id="city" name="city" placeholder="My city">
    <br>

    <!-- State Or Region Field -->
    <label for="region"><i class="fa fa-envelope"></i>State Or Region</label>
    <input id="region" name="region" placeholder="My region">
    <br>

    <!-- Country Field -->
    <label for="region"><i class="fa fa-envelope"></i>Country</label>
    <input id="country" name="country" placeholder="My country">
    <br>

    <!-- Postal Code Field -->
    <label for="postalCode"><i class="fa fa-envelope"></i>Postal Code</label>
    <input type="text" id="postalCode" name="postalCode" placeholder="00000">
    <br>

    <!-- Phone Number Field -->
    <label for="phoneNumber"><i class="fa fa-envelope"></i>Phone Number</label>
    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="4078485236">
    <br>

    <!-- Input Button -->
    <input name="submit1" type="submit" value="Submit"/><br>
    <br>&nbsp;

</form>
</body>
</html>