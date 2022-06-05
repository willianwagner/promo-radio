
/*=========================*/
     /*========Animation on scroll with wow.js====*/
     /*==========================*/
     
   wow = new WOW(
      {
        animateClass: 'animated',
        offset:       110,
        mobile:       true
      }
    );
    wow.init();


  (function ($) {
                "use strict";
                var slider = new MasterSlider();
                // adds Arrows navigation control to the slider.
                slider.control('arrows');
                slider.control('bullets');

                slider.setup('masterslider', {
                    width: 1400, // slider standard width
                    height: 700, // slider standard height
                    space: 0,
                    speed: 45,
                    layout: 'fillwidth',
                    loop: true,
                    preload: 0,
                    autoplay: true,
                    view: "parallaxMask"
                });
            })(jQuery);
