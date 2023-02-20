const $ = jQuery;

$(document).ready(function() {
    site_header_buttons();
    map_slider();
    faq_accordion();
    text_area_slider();
});

function site_header_buttons() {
    let cookie_list_string = document.cookie;
    let cookie_name = 'expanded_site_header_nav_menu=';
    let cookie_name_index = cookie_list_string.indexOf(cookie_name);
    if (cookie_name_index != -1) {
        let expanded_site_header_nav_menu = cookie_list_string[cookie_name_index + cookie_name.length];

        if (expanded_site_header_nav_menu == '1' && $(window).width() >= 1200) {
            $('#site-header .toggle-nav').toggleClass('expanded');
            $('#site-header .nav-menu').toggleClass('expanded');
        }
    }

    $('#site-header .toggle-nav').click(function() {
        $(this).toggleClass('expanded');
        $('#site-header .nav-menu').toggleClass('expanded');
        if ($(this).hasClass('expanded')) {
            document.cookie = 'expanded_site_header_nav_menu=1; path=/';
        } else {
            document.cookie = 'expanded_site_header_nav_menu=0; path=/';
        }
    });

    $('#site-header .toggle-nav-drop').click(function() {
        $(this).toggleClass('expanded');
        $(this).next('.nav-drop').slideToggle(500);
    });
}

function map_slider() {
    $('#site-footer .map-slider').slick({
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
    });
}

function faq_accordion() {
    $('.faq .question .toggle-expand').click(function() {
        $(this).toggleClass('expand');
        $(this).next('.text').slideToggle(500);
    });
}

function text_area_slider() {
    $('.text-area .image-slider .image-container').each(function() {
        if ($(this).children('img').length > 1) {
            $(this).slick({
                infinite: true,
                dots: true,
                arrows: false,
                slidesToShow: 1,
            });
        }
    });
}