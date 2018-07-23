<?php
global $wpdb;
$parent_site_name = $wpdb->get_var("SELECT option_value FROM wp_options WHERE option_name = 'blogname'");
$neighborhood_name = get_neighborhood_value();
$theme_uri = get_template_directory_uri();
$parent_template_dir_name = preg_replace('~^(.*)\/themes\/(.*)$~i', '$2', $theme_uri);
$parent_template_dir_name = dirname(__FILE__) . '/../' . $parent_template_dir_name;
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to the Alcove Group</title>
    <?php wp_head();
    $GLOBALS['isChildThemePage'] = true;
    $post_id = get_the_id();
    if(is_singular('featured_home')) {include_once ($parent_template_dir_name.'/template-fb-metadata-featured.php');}
    else if($fb_listed_metadata == 1) {
      include_once ($parent_template_dir_name.'/template-fb-metadata-listed.php');
    } else {
      include_once ($parent_template_dir_name.'/template-fb-metadata-default.php');
    }
    ?>
  </head>

  <body <?php body_class("microsite-page"); ?>>
  <?php
  if ( is_front_page() ): ?>
  <div id="loadingStatus"></div>
  <div id="pageHide"> <!-- Wraps the page content to hide while video loads -->
    <?php endif; ?>
    <!-- Menu toggle hidden -->
    <input id="menu-toggle" type="checkbox" />
    <!-- Menu toggle hidden -->

    <!-- Menu frame -->
    <div id="menu-frame" class="reverse alcove-texture">
      <label class="js-menu-btn" for="menu-toggle"><span class="icon-icon-x"></span>Close</label>
      <?php wp_nav_menu( array('container' => false, 'menu_class' => 'mobile-menu', 'theme_location' => 'header' ) ); ?>
      <ul class="social-icons">

        <?php if ( get_option('global_company_email') ): ?>
        <li><a href="mailto:<?php echo get_option('global_company_email'); ?>"><span class="icon-ring"></span><span class="icon-icon-email"></span></a></li>
        <?php endif; ?>

        <?php if ( get_option('global_company_phone') ): ?>
        <li><a href="tel:<?php echo get_option('global_company_phone'); ?>"><span class="icon-ring"></span><span class="icon-icon-phone"></span></a></li>
        <?php endif; ?>

        <?php if ( get_option('global_company_facebook') ): ?>
        <li><a href="<?php echo get_option('global_company_facebook'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-facebook"></span></a></li>
        <?php endif; ?>

        <?php if ( get_option('global_company_linkedin') ): ?>
        <li><a href="<?php echo get_option('global_company_linkedin'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-linkedin"></span></a></li>
        <?php endif; ?>

      </ul>
    </div>
    <!-- Menu frame -->

    <!-- Header -->
    <div id="header" class="reverse clearfix">
      <div id="global-header">
        <div class="row">
          <a id="global-home-link" href="/"><span class="icon-icon-home"></span><span class="show-for-medium-up"><?=$parent_site_name;?> Home</span></a>
          <span id="regional-label">Explore <?=$neighborhood_name;?></span>
        </div>
      </div>
      <a href="tel:<?php echo get_option('global_company_phone'); ?>" class="hide-for-large-up">
        <div class="call-now-promo top-nav">
          <h4>Call Today <?php echo get_option('global_company_phone'); ?></h4>
        </div>
      </a>
      <div id="regional-header" class="row">
        <label class="btn small js-menu-btn" for="menu-toggle">Menu</label>
        <a href="<?php echo get_site_url(); ?>" class="show-for-medium-up header-logo-holder">
          <img src="<?php echo get_template_directory_uri(); ?>/img/alcove-logo-sprite-large.png" class="logo" />
        </a>
        <a href="<?php echo get_site_url(); ?>" class="hide-for-medium-up mobile-logo-holder">
          <img src="<?php echo get_template_directory_uri(); ?>/img/alcove-logo-mobile.png" class="logo-mobile" />
        </a>

        <div id="call-now-and-social">
          <ul class="social-icons show-for-medium-up">
          <?php if ( get_option('global_company_email') ): ?>
          <li><a href="mailto:<?php echo get_option('global_company_email'); ?>"><span class="icon-ring"></span><span class="icon-icon-email"></span></a></li>
          <?php endif; ?>

          <?php if ( get_option('global_company_phone') ): ?>
          <li><a href="tel:<?php echo get_option('global_company_phone'); ?>"><span class="icon-ring"></span><span class="icon-icon-phone"></span></a></li>
          <?php endif; ?>

          <?php if ( get_option('global_company_facebook') ): ?>
          <li><a href="<?php echo get_option('global_company_facebook'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-facebook"></span></a></li>
          <?php endif; ?>

          <?php if ( get_option('global_company_linkedin') ): ?>
          <li><a href="<?php echo get_option('global_company_linkedin'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-linkedin"></span></a></li>
          <?php endif; ?>
        </ul>
          <a href="tel:<?php echo get_option('global_company_phone'); ?>" class="call-now-promo show-for-large-up">
            <h4>Call Today <?php echo get_option('global_company_phone'); ?></h4>
          </a>
        </div>
        
      </div>
    </div>

    <!-- MAKE A CUSTOM FIELD FOR SEO HEADING AND ALLOW CUSTOMIZATION ON PAGE-BY-PAGE BASIS -->
    <h1 id="hidden-title"><?php the_field( 'seo_heading' ); ?></h1>
    <!-- Header -->