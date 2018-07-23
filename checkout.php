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
    
    <div class="sec1-checkout">
        <span class="title2">Checkout</span>
        <hr class="one">
        
        <form action="cart.php" method="post">
            <div class="form-group">

                <!--  Email Field -->
                <label for="email"><i class="fa fa-envelope"></i>Email</label>
                <input type="email" id="email" name="email" placeholder="e.g., john@email.com">
                <br>

                <!--  First Name Field -->
                <label for="firstName"><i class="fa fa-envelope"></i>First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="e.g., John">
                <br>

                <!--  Last Name Field -->
                <label for="lastName"><i class="fa fa-envelope"></i>Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="e.g., Doe">
                <br>

                <!-- Address Field -->
                <label for="address"><i class="fa fa-envelope"></i>Address</label>
                <input type="text" id="address" name="address" placeholder="e.g., 123 Street Dr">
                <br>

                <!-- City Field -->
                <label for="city"><i class="fa fa-envelope"></i>City</label>
                <input type="text" id="city" name="city" placeholder="e.g., Orlando">
                <br>

                <!-- State Or Region Field -->
                <label for="region"><i class="fa fa-envelope"></i>State Or Region</label>
                <input id="region" name="region" placeholder="e.g., Florida">
                <br>

                <!-- Country Field -->
                <label for="region"><i class="fa fa-envelope"></i>Country</label>
                <input id="country" name="country" placeholder="e.g., United States">
                <br>

                <!-- Postal Code Field -->
                <label for="postalCode"><i class="fa fa-envelope"></i>Postal Code (Input U.S. postal code only)</label>
                <input type="tel" pattern="[0-9]{5}" id="postalCode" name="postalCode" placeholder="e.g., 00000">
                <br>

                <!-- Phone Number Field -->
                <label for="phoneNumber"><i class="fa fa-envelope"></i>Phone Number (Only input numbers)</label>
                <input type="text" pattern="[0-9]{10}" id="phoneNumber" name="phoneNumber" placeholder="e.g., 4078485236">
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