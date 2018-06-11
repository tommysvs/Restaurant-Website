/*** NAVIGATION BAR ***/
$(window).scroll(function() {
    if($(document).scrollTop() > 100) {
        $('nav').addClass('shrink');
    } 
    else {
        $('nav').removeClass('shrink');
    }
});

/*** GOOGLE MAPS ***/
function myMap() {
    var mapCanvas = document.getElementById("map");
    var myCenter = new google.maps.LatLng(51.508742,-0.120850); 
    var mapOptions = {center: myCenter, zoom: 5};
    var map = new google.maps.Map(mapCanvas,mapOptions);
    var marker = new google.maps.Marker({
        position: myCenter, 
        animation: google.maps.Animation.BOUNCE
    });
    
    marker.setMap(map);
}

/*** BUTTON-TO-TOP ***/
$(window).scroll(function() {
    if ($(this).scrollTop() >= 400) {
        $('#return-to-top').fadeIn(200); 
    } else {
        $('#return-to-top').fadeOut(200);
    }
});
$('#return-to-top').click(function() { 
    $('body,html').animate({
        scrollTop : 0 
    }, 500);
});