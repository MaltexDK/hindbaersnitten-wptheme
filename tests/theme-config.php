<?php
/** Run: php tests/theme-config.php /path/to/wordpress/wp-load.php */
require $argv[1];
$root = get_stylesheet_directory();
function hs_theme_verify($ok, $message) { if (!$ok) throw new RuntimeException($message); }
$data = json_decode(file_get_contents($root.'/theme.json'), true, 512, JSON_THROW_ON_ERROR);
hs_theme_verify($data['version'] === 3, 'Theme JSON schema version');
$families = array_column($data['settings']['typography']['fontFamilies'], null, 'slug');
foreach (['fraunces','manrope'] as $slug) {
    $face = $families[$slug]['fontFace'][0];
    $file = $root.'/'.substr($face['src'][0], 7);
    hs_theme_verify(is_file($file) && substr(file_get_contents($file), 0, 4) === 'wOF2', 'Local WOFF2 missing: '.$slug);
    hs_theme_verify($face['fontDisplay'] === 'swap', 'Font loading blocks text');
}
function hs_theme_inspect_blocks($blocks, &$mains) {
    foreach ($blocks as $block) {
        if (($block['attrs']['tagName'] ?? '') === 'main') $mains++;
        if ($block['blockName']) hs_theme_verify(WP_Block_Type_Registry::get_instance()->is_registered($block['blockName']), 'Unregistered block: '.$block['blockName']);
        hs_theme_inspect_blocks($block['innerBlocks'], $mains);
    }
}
foreach (glob($root.'/templates/*.html') as $file) {
    $mains = 0;
    $blocks = parse_blocks(file_get_contents($file));
    hs_theme_inspect_blocks($blocks, $mains);
    hs_theme_verify($mains === 1, 'Exactly one main landmark required: '.basename($file));
}
$header = file_get_contents($root.'/parts/header.html');
hs_theme_verify(str_contains($header, '"level":0'), 'Site title must not duplicate page h1');
wp_enqueue_scripts();
hs_theme_verify(wp_style_is('hindbaersnitten-custom','enqueued'), 'Theme stylesheet not enqueued');
hs_theme_verify(current_theme_supports('editor-styles'), 'Editor stylesheet support missing');
echo "PASS: local fonts, font-display, registered template blocks, main landmarks, header semantics and frontend/editor styles\n";
