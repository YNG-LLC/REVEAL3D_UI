jQuery(function($) {
    "use strict";

    $('.navigation').singlePageNav({
        currentClass: 'active',
        changeHash: true,
        scrollSpeed: 750,
        offset: 0,
        filter: ':not(.external)',
        easing: 'swing',

    });

    $.noConflict();
    $('.nav a').on('click', function() {
        if ($('.navbar-toggle').css('display') != 'none') {
            $(".navbar-toggle").trigger("click");
        }
    });




    // accordian
    $('.accordion-toggle').on('click', function() {
            $(this).closest('.panel-group').child().each(function() {
                $(this).find('>.panel-heading').removeClass('active');
            });

            $(this).closest('.panel-heading').toggleClass('active');
        }
    });

$('#home-page .navigation')

});

< /script>

< /body>

< /html>
