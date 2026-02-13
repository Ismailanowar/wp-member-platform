<?php
add_theme_support('post-thumbnails');
add_action('wp_enqueue_scripts', function () {

    wp_enqueue_style('member-style', get_stylesheet_uri());

    wp_enqueue_script(
        'member-ajax',
        get_stylesheet_directory_uri() . '/assets/js/member-ajax.js',
        ['jquery'],
        null,
        true
    );

// Mobile menu toggle script
 wp_enqueue_script(
    'mp-menu-toggle',
    get_stylesheet_directory_uri() . '/assets/js/menu-toggle.js',
    ['jquery'],
    null,
    true
);

    wp_localize_script('member-ajax', 'mpAjax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('mp_ajax_nonce')
    ]);
});


