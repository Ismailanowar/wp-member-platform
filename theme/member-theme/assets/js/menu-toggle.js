jQuery(document).ready(function($){
    $('.mobile-menu-toggle').click(function(){
        $('.site-header .nav-menu').toggleClass('active');
        $('.menu-overlay').toggleClass('active');
    });

    // Close menu when clicking overlay
    $('.menu-overlay').click(function(){
        $('.site-header .nav-menu').removeClass('active');
        $(this).removeClass('active');
    });
});
