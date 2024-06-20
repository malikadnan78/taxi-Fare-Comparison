(function( $ ) {
    "use strict";

    // Start Slider Js
    var Slider = function ($scope, n) {
        var $_this = $scope.find('.tmle-section-style-4');
        var $currentID = '#' + $_this.attr('id');
        var slider_autoplay = $_this.data('slider-autoplay');
        var slider_autoplay_speed = $_this.data('slider-autoplay-speed');
        var slider_vertical = $_this.data('slider-vertical');
        var slider_dots = $_this.data('slider-dots');
        
        jQuery($currentID + ".tmle-section-style-4").slick({
            infinite: true,
            dots: (slider_dots == 'yes') ? true : false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: (slider_autoplay == 'yes') ? true : false,
            autoplaySpeed: slider_autoplay_speed,
            arrows: true,
            vertical: (slider_vertical == 'vertical') ? true : false,
            verticalSwiping: (slider_vertical == 'vertical') ? true : false,
        });
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/timelentor.default', Slider);
    });

})(jQuery);
/* End slider Style JS */