<?php
/**
 * Title: Header – logo og menulinje
 * Slug: hindbaersnitten/header-logo-menu
 * Categories: header, hindbaersnitten
 * Block Types: core/template-part/header
 * Description: Logo over en indrammet menu på pc, logo og burgermenu på mobil og tablet.
 */
?>
<!-- wp:group {"align":"full","className":"hs-site-header","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hs-site-header">
  <!-- wp:group {"align":"wide","className":"hs-header-inner","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap","verticalAlignment":"center"}} -->
  <div class="wp-block-group alignwide hs-header-inner">
    <!-- wp:group {"className":"hs-header-brand","layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-group hs-header-brand">
      <!-- wp:site-logo {"width":460,"shouldSyncIcon":false,"className":"hs-header-logo"} /-->
    </div>
    <!-- /wp:group -->
    <!-- wp:navigation {"overlayMenu":"mobile","showSubmenuIcon":true,"className":"hs-header-menu","layout":{"type":"flex","justifyContent":"center"}} /-->
  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->
