<?php
/** GitHub updates via bundled Plugin Update Checker 5.6 (MIT). */

if (!defined('ABSPATH')) {
    exit;
}

require_once dirname(__DIR__) . '/lib/plugin-update-checker/plugin-update-checker.php';

$hsnitte_theme_checker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
    'https://github.com/MaltexDK/hindbaersnitten-wptheme/',
    dirname(__DIR__) . '/functions.php',
    'hindbaersnitten-child'
);

// Only published stable releases with our installable asset are eligible.
// In particular, do not fall back to tags or development branches.
$hsnitte_theme_checker->setBranch('main');
$hsnitte_theme_checker->getVcsApi()->setStrategyFilterName('hsnitte_theme_release_strategies');
add_filter('hsnitte_theme_release_strategies', function ($strategies) {
    return array_intersect_key($strategies, array('latest_release' => true));
});
$hsnitte_theme_checker->getVcsApi()->enableReleaseAssets(
    '/^hindbaersnitten-child\.zip$/',
    \YahnisElsts\PluginUpdateChecker\v5p6\Vcs\Api::REQUIRE_RELEASE_ASSETS
);

// The theme checker can return header metadata without a usable release.
// Never show an update unless the packaged download is available.
$hsnitte_theme_checker->addFilter('request_update_result', function ($update) {
    return !empty($update->download_url) ? $update : null;
});
