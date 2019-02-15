<meta property="og:title" content="<?php echo the_title(); ?>" />
<meta property="og:url" content="<?php echo get_post_permalink(); ?>" />
<?php if (has_post_thumbnail($post_id) ): ?>
    <?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
    <meta property="og:image" content="<?php echo $featured_image[0]; ?>" />
<?php else : ?>
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/Alcove-FeaturedImageDefault-thumb.jpg" />
<?php endif; ?>
<meta property="og:description" content="<?php echo get_the_content() ?>" />
<meta property="og:site_name" content="Alcove" />