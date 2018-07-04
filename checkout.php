<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery.timepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.timepicker.css"/>
    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: 0,
                maxDate: 2
            });
        });

        $(function () {
            $('#timepicker').timepicker({
                'disableTimeRanges': [
                    ['12am', '11am'],
                    ['10pm', '11:59pm']
                ]
            });
        });
    </script>

    <title>Checkout</title>
</head>
<body>
<form action="SubmitOrder.php" method="post">
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
        <input type="text" id="datepicker" name="date">
        <br>

        <!-- Time Picker Field -->
        <label for="timepicker"><i class="fa fa-envelope"></i>Time of Pickup</label>
        <input type="text" id="timepicker" name="date">
        <br>


        <!-- Input Button -->
        <input name="submit1" type="submit" value="Submit"/><br>
        <br>&nbsp;
    </div>
</form>
</body>
</html>