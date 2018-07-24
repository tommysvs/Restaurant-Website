<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - Nonna's Table</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/font_styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery.ui.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.ui.timepicker.css"/>
    <!-- jQuery -->
    <script>
        $(function () {
            $('#datepicker').datepicker({
                dateFormat: 'mm/dd/yy',
                minDate: 0,
                maxDate: 2
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
        <div class="sec-animate">
            <span class="title2">Checkout</span>
            <hr class="one">

            <form action="cart.php" method="post">
                <div class="container-Fields form-group">
                    <!--  First Name Field -->
                    <div style="display: inline-block;">
                        <label for="firstName">First Name</label><br>
                        <input class="checkout-Input" type="text" id="firstName" name="firstName" placeholder="e.g., John">
                    </div>

                    <!--  Last Name Field -->
                    <div style="display: inline-block;">
                        <label for="lastName">Last Name</label><br>
                        <input class="checkout-Input" type="text" id="lastName" name="lastName" placeholder="e.g., Doe">
                    </div><br><br>

                    <!--  Email Field -->
                    <div style="display: inline-block;">
                        <label for="email">Email:</label><br>
                        <input class="checkout-Input" type="email" id="email" name="email" placeholder="e.g., john@email.com">
                    </div>

                    <!-- Phone Number Field -->
                    <div style="display: inline-block;">
                        <label for="phoneNumber">Phone Number (Only numbers)</label><br>
                        <input class="checkout-Input" type="text" pattern="[0-9]{10}" id="phoneNumber" name="phoneNumber" placeholder="e.g., 4078485236">
                    </div><br><br>

                    <!-- Address Field -->
                    <div style="display: inline-block;">
                        <label for="address">Address</label><br>
                        <input class="checkout-Input" style="width: 645px;" type="text" id="address" name="address" placeholder="e.g., 123 Street Dr">
                    </div><br><br>

                    <!-- City Field -->
                    <div style="display: inline-block;">
                        <label for="city">City</label><br>
                        <input class="checkout-Input" type="text" id="city" name="city" placeholder="e.g., Orlando">
                    </div>

                    <!-- State Or Region Field -->
                    <div style="display: inline-block;">
                        <label for="region">State Or Region</label><br>
                        <input class="checkout-Input" id="region" name="region" placeholder="e.g., Florida">
                    </div><br><br>

                    <!-- Country Field -->
                    <div style="display: inline-block;">
                        <label for="region">Country</label><br>
                        <input class="checkout-Input" id="country" name="country" placeholder="e.g., United States">
                    </div>

                    <!-- Postal Code Field -->
                    <div style="display: inline-block;">
                        <label for="postalCode">Postal Code (U.S. postal code only)</label><br>
                        <input class="checkout-Input" type="tel" pattern="[0-9]{5}" id="postalCode" name="postalCode" placeholder="e.g., 00000">
                    </div><br><br>                

                    <!-- Date Picker Field -->
                    <div style="display: inline-block;">
                        <label for="datepicker">Date of Pickup</label><br>
                        <input class="checkout-Input" type="text" id="datepicker" name="date" readonly="readonly">
                    </div>

                    <!-- Time Picker Field -->
                    <div style="display: inline-block;">
                        <label for="timepicker">Time of Pickup</label><br>
                        <input class="checkout-Input" type="text" id="timepicker" name="time" readonly="readonly">
                    </div><br><br><br><br>

                    <!-- Input Button -->
                    <input class="submitButton" name="place_order" type="submit" value="Place Order">
                </div>
            </form>
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
<<<<<<< HEAD
</html>

<script src="js/functions.js"></script>
=======
</html>
>>>>>>> a4c0e538b1128d4a44474a987cf4a1f1da6a424a
