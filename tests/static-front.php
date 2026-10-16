<?php
/** Run with WordPress wp-load.php; uses an in-memory page, no database changes. */
require $argv[1];
$page = new WP_Post((object)[
    'ID'=>987654321, 'post_type'=>'page', 'post_status'=>'publish', 'post_title'=>'Min egen forside',
    'post_content'=>'<!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Min egen overskrift</h1><!-- /wp:heading --><!-- wp:paragraph --><p>STATISK-FORSIDE-INDHOLD</p><!-- /wp:paragraph -->',
]);
$previous = $GLOBALS['post'] ?? null;
wp_cache_add($page->ID, $page, 'posts');
$GLOBALS['post'] = $page;
try {
    $template = file_get_contents(get_stylesheet_directory().'/templates/front-page.html');
    $html = do_blocks($template);
    if (!str_contains($html,'STATISK-FORSIDE-INDHOLD') || !str_contains($html,'Min egen overskrift')) throw new RuntimeException('Static page content missing');
    if (str_contains($template,'wp:query') || str_contains($template,'hindbaersnitten/hero')) throw new RuntimeException('Fixed homepage content remains');
    if (!str_contains($html,'hs-site-header') || !str_contains($html,'hs-site-footer')) throw new RuntimeException('Header or footer missing');
    echo "PASS: front-page renders the selected page content and heading between header and footer, without fixed hero or query\n";
} finally {
    $GLOBALS['post'] = $previous;
    wp_cache_delete($page->ID, 'posts');
}
