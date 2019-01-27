<div class="hero-overlay reverse"
<?php if (has_post_thumbnail( $post->ID ) ) { ?>
  style="background-color: rgba(1, 38, 57, <?php the_field( 'background_opacity' ); ?>);">
<?php } else { ?>
  style="background: url('<?php echo get_template_directory_uri(); ?>/img/default-image-bg-tile-@2x.jpg'), rgba(1, 38, 57, 0.75); background-size: 25%;">
<?php } ?>