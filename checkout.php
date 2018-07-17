<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--Do not use bootstrap on this page-->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery.ui.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.ui.timepicker.css"/>
    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: 'mm/dd/yy',
                minDate: 1,
                maxDate: 3
            });
        });

        $(function () {
            $('#timepicker').timepicker({
                showPeriod: true,
                onHourShow: OnHourShowCallback,
                onMinuteShow: OnMinuteShowCallback
            });
        });

        function OnHourShowCallback(hour) {
            if ((hour > 21) || (hour < 11)) {
                return false; // not valid
            }
            return true; // valid
        }

        function OnMinuteShowCallback(hour, minute) {
            if ((hour == 21) && (minute >= 30)) {
                return false;
            } // not valid
            if ((hour == 11) && (minute < 30)) {
                return false;
            }   // not valid
            return true;  // valid
        }
    </script>

    <title>Checkout</title>
</head>
<body>
<form action="cart.php" method="post">
    <div class="form-group">

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

        <!-- Date Picker Field -->
        <label for="datepicker"><i class="fa fa-envelope"></i>Date of Pickup</label>
        <input type="text" id="datepicker" name="date" readonly="readonly">
        <br>

        <!-- Time Picker Field -->
        <label for="timepicker"><i class="fa fa-envelope"></i>Time of Pickup</label>
        <input type="text" id="timepicker" name="time" readonly="readonly">
        <br>


        <!-- Input Button -->
        <input name="place_order" type="submit" value="Place Order"/><br>
        <br>&nbsp;
    </div>
</form>
</body>
</html>