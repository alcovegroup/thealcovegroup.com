<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to the Alcove Group</title>
    <?php wp_head(); ?>
    <meta property="og:title" content="<?php echo the_title(); ?>" />
    <meta property="og:url" content="<?php echo get_post_permalink(); ?>" />
    <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
      <meta property="og:image" content="<?php echo $featured_image[0]; ?>" />
    <?php else : ?>
      <meta property="og:image" content="http://mls.liquinas.com/wp-content/uploads/2016/11/Alcove-FeaturedImageDefault-thumb.jpg" />
    <?php endif; ?>
    <meta property="og:description" content="<?php echo get_the_content() ?>" />
    <meta property="og:site_name" content="<?php echo get_site_url(); ?>" />
  </head>

  <body <?php body_class(); ?>>
  <?php if ( is_front_page() ): ?>
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
        <li><a href="<?php echo get_option('global_company_phone'); ?>"><span class="icon-ring"></span><span class="icon-icon-phone"></span></a></li>
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
      <div class="row">
        <label class="btn small js-menu-btn" for="menu-toggle">Menu</label>
        <a href="<?php echo get_site_url(); ?>" class="show-for-medium-up">
          <img src="<?php echo get_template_directory_uri(); ?>/img/temp-logo-full.png" class="logo" />
        </a>
        <a href="<?php echo get_site_url(); ?>" class="hide-for-medium-up">
          <img src="<?php echo get_template_directory_uri(); ?>/img/temp-logo-mobile.png" class="logo-mobile" />
        </a>
        <ul class="social-icons show-for-medium-up">
          <?php if ( get_option('global_company_email') ): ?>
          <li><a href="mailto:<?php echo get_option('global_company_email'); ?>"><span class="icon-ring"></span><span class="icon-icon-email"></span></a></li>
          <?php endif; ?>

          <?php if ( get_option('global_company_phone') ): ?>
          <li><a href="<?php echo get_option('global_company_phone'); ?>"><span class="icon-ring"></span><span class="icon-icon-phone"></span></a></li>
          <?php endif; ?>

          <?php if ( get_option('global_company_facebook') ): ?>
          <li><a href="<?php echo get_option('global_company_facebook'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-facebook"></span></a></li>
          <?php endif; ?>

          <?php if ( get_option('global_company_linkedin') ): ?>
          <li><a href="<?php echo get_option('global_company_linkedin'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-linkedin"></span></a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <!-- Header -->