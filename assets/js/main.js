(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Fit Text Plugin for Main Header
    $("h1").fitText(
        1.2, {
            minFontSize: '35px',
            maxFontSize: '65px'
        }
    );

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    // Initialize WOW.js Scrolling Animations
    new WOW().init();

   
$(document).ready(function(){

    echo.init({
      offset: 100,
      offsetLeft: 200,
      offsetRight: 200,
      throttle: 10,
      unload: false
    });

    var $window = $(window);
    // Cache the Window object
    $window = $(window);
                
   $('section[data-type="background"]').each(function(){
     var $bgobj = $(this); // assigning the object
                    
      $(window).scroll(function() {
                    
        // Scroll the background at var speed
        // the yPos is a negative value because we're scrolling it UP!                              
        var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
        
        // Put together our final background position
        var coords = '50% '+ yPos + 'px';

        // Move the background
        $bgobj.css({ backgroundPosition: coords });
        
}); // window scroll Ends

 });    

});

})(jQuery); // End of use strict
