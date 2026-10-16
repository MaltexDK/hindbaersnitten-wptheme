<?php
/**
 * Title: Anmeldelseskort
 * Slug: hindbaersnitten/anmeldelseskort
 * Categories: cards, posts, hindbaersnitten
 * Block Types: core/group, core/query
 * Description: Et kompakt kort design til at vise en anmeldelse.
 */
?>
<!-- wp:group {"className":"card","layout":{"type":"constrained"}} -->
<div class="wp-block-group card">
    <!-- wp:post-title {"isLink":true} /-->
    <!-- wp:group {"layout":{"type":"flex","justifyContent":"left"}} -->
    <div class="wp-block-group">
        <!-- wp:paragraph {"className":"badge-rating"} -->
        <p class="badge-rating">Karakter: <span class="krymmel"></span><span class="krymmel"></span><span class="krymmel"></span><span class="krymmel"></span><span class="krymmel"></span><span class="krymmel"></span></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
    <!-- wp:post-excerpt {"moreText":"Læs anmeldelsen"} /-->
</div>
<!-- /wp:group -->