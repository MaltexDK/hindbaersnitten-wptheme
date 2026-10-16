<?php
/**
 * Hindbærsnitten child theme functions
 */

add_action( 'wp_enqueue_scripts', function () {
    // Parent style is automatically loaded in TT5, but enqueue child for custom CSS.
    wp_enqueue_style( 'hindbaersnitten-child', get_stylesheet_uri(), [], wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'hindbaersnitten-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', ['hindbaersnitten-child'], wp_get_theme()->get( 'Version' ) );
});

// Add featured images and title-tag support (in case parent changes).
add_action( 'after_setup_theme', function () {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', ['flex-width' => true, 'flex-height' => true] );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/custom.css' );
} );

// Pattern category.
add_action( 'init', function () {
    register_block_pattern_category(
        'hindbaersnitten',
        [ 'label' => __( 'Hindbærsnitten', 'hindbaersnitten' ) ]
    );
} );

/** Use the packaged wordmark when no WordPress site logo has been selected. */
function hindbaersnitten_header_logo_fallback($content, $block) {
    $classes = preg_split('/\s+/', $block['attrs']['className'] ?? '');
    if (trim($content) !== '' || !in_array('hs-header-logo', $classes, true)) return $content;
    $image = sprintf(
        '<img class="custom-logo" src="%s" width="2176" height="723" alt="%s" decoding="async" fetchpriority="high">',
        esc_url(get_stylesheet_directory_uri().'/assets/images/hindbaersnitten-logo.png'),
        esc_attr(get_bloginfo('name'))
    );
    if ($block['attrs']['isLink'] ?? true) {
        $image = '<a class="custom-logo-link" href="'.esc_url(home_url('/')).'" rel="home">'.$image.'</a>';
    }
    return '<div class="wp-block-site-logo hs-header-logo">'.$image.'</div>';
}
add_filter('render_block_core/site-logo', 'hindbaersnitten_header_logo_fallback', 10, 2);

require_once __DIR__ . '/includes/updates.php';
