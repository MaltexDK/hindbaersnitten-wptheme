<?php
/**
 * Hindbærsnitten child theme functions
 */

add_action( 'wp_enqueue_scripts', function () {
    // Parent style is automatically loaded in TT5, but enqueue child for custom CSS.
    wp_enqueue_style( 'hindbaersnitten-child', get_stylesheet_uri(), [], wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'hindbaersnitten-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', [], wp_get_theme()->get( 'Version' ) );
});

// Add featured images and title-tag support (in case parent changes).
add_action( 'after_setup_theme', function () {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
} );

// Pattern category.
add_action( 'init', function () {
    register_block_pattern_category(
        'hindbaersnitten',
        [ 'label' => __( 'Hindbærsnitten', 'hindbaersnitten' ) ]
    );
} );

require_once __DIR__ . '/includes/updates.php';
