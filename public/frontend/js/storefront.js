(function ($) {
    'use strict';

    function updateHeader() {
        var topHeight = $('#top').outerHeight() || 160;
        var headerHeight = $('header').outerHeight() || 80;

        $('header').toggleClass('background-header', $(window).scrollTop() >= topHeight - headerHeight);
    }

    $('.menu-trigger').on('click', function () {
        $(this).toggleClass('active');
        $('.header-area .nav').slideToggle(200);
    });

    $('.submenu').on('click', function () {
        if ($(window).width() < 767) {
            $(this).find('ul').toggleClass('active');
        }
    });

    $(window).on('scroll', updateHeader);
    $(window).on('load', function () {
        updateHeader();
        $('#preloader').animate({ opacity: 0 }, 400, function () {
            $(this).css('visibility', 'hidden').fadeOut();
        });
    });
})(window.jQuery);
