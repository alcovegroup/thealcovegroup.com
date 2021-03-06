<?php
/**
 * Template Name: About
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */

global $minHeader;
if (!post_custom('enable_hero')) {
  $minHeader = true;
} else {
  $minHeader = false;
}

get_header();
?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <div id="fullpage-slider"> <!-- Start fullpage slider -->

      <?php if ( post_custom('enable_hero') ): ?>
      

      <!-- Hero With YouTube Embed-->
      <div id="hero"
      <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
       style="background-image: url('<?php echo $image[0]; ?>');"
      <?php endif; ?>
      <?php if ( post_custom('use_video') ): ?>
      class="section">
      <?php else : ?>
        class="section about-hero-no-video">
      <?php endif; ?>

        <?php get_template_part( 'partials/hero-overlay' ); ?>

          <!-- Contents -->
          <?php if ( post_custom('use_video') ): ?>
          <div class="row about-contents">
          <?php else : ?>
          <div class="row about-contents v-center">
          <?php endif; ?>
          
            <?php if ( post_custom('use_video') ): ?>
            <div class="small-12 medium-10 medium-offset-1 large-6 large-offset-0 columns about-copy">
            <?php else : ?>
            <div class="small-12 small-centered medium-8 columns about-copy about-copy-centered">
            <?php endif; ?>
              <h1><?php the_title(); ?></h1>
              <?php if (have_posts()) : while (have_posts()) : the_post();?>
                <?php the_content(); ?>
                <?php endwhile; endif; wp_reset_query(); ?>
            </div>
            <?php if ( post_custom('use_video') ): ?>
            <div class="small-12 medium-10 medium-offset-1 large-6 large-offset-0 columns feature-video">
              <iframe src="https://www.youtube.com/embed/<?php echo the_field( 'youtube_id' ); ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <?php endif; ?>
          </div>
          <!-- Contents -->

          <!-- Scroll CTA -->
          <div class="row scroll-cta">
            <div class="large-12 columns">
              <span class="outer-circle"><span class="icon-icon-arrow-down"></span></span>
            </div>
          </div>
          <!-- Scroll CTA -->


        </div>
      </div>
      <!-- End Hero With YouTube Embed -->

      <?php endif; ?>      

    
      

      <!-- About Bio Section -->

        <?php $loop = new WP_Query( array( 'post_type' => 'bios', 'posts_per_page' => -1 ) ); ?>
        <?php $c = 0; ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <?php $c++; ?>
        <?php if( $c % 2 != 0 ) : ?>


        <!-- About Bio -->
        <div id="first-bio" class="about-bio-row row full-width section reverse">
          <!-- <div class="about-header-spacer"></div> -->
          <?php if (has_post_thumbnail( $post->ID ) ): ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
          <div class="small-12 medium-5 columns about-photo" style="background-image: url('<?php echo $image[0]; ?>');"></div>
          <?php endif; ?>
          <div class="small-12 medium-7 columns about-bio-text">
            <div class="about-bio-text-inner">
              <h2><?php the_title(); ?></h2>
              <h3><?php the_field( 'job_title' ); ?></h3>
              <?php if ( post_custom('show_reviews') ): ?>
              <a class="about-reviews-btn btn small" href="<?php echo the_field( 'reviews_page' ); ?>"><?php echo the_title(); ?>'s Reviews</a>
              <?php endif; ?>
              <?php the_content(); ?>
              <ul class="social-icons">
                <?php if ( post_custom('email_address') ): ?>
                <li><a href="mailto:<?php echo the_field( 'email_address' ); ?>"><span class="icon-ring"></span><span class="icon-icon-email"></span></a></li>
                <?php endif; ?>
                <?php if ( post_custom('phone_number') ): ?>
                <li><a href="tel:<?php echo the_field( 'phone_number' ); ?>"><span class="icon-ring"></span><span class="icon-icon-phone"></span></a></li>
                <?php endif; ?>
                <?php if ( post_custom('linked_in_profile') ): ?>
                <li><a href="<?php echo the_field( 'linked_in_profile' ); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-linkedin"></span></a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>

          <!-- Scroll CTA -->
          <div class="row scroll-cta">
            <div class="large-12 columns">
              <span class="outer-circle"><span class="icon-icon-arrow-down"></span></span>
            </div>
          </div>
          <!-- Scroll CTA -->

        </div>
        <!-- End About Bio -->


          <?php else : ?>
      
        <!-- About Bio -->
        <div class="about-bio-row row full-width section">
          <?php if (has_post_thumbnail( $post->ID ) ): ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
          <div class="small-12 medium-5 medium-push-7 columns about-photo" style="background-image: url('<?php echo $image[0]; ?>');"></div>
          <?php endif; ?>
          <div class="small-12 medium-7 medium-pull-5 columns about-bio-text">
            <div class="about-bio-text-inner">
              <h2><?php the_title(); ?></h2>
              <h3><?php the_field( 'job_title' ); ?></h3>
              <?php the_content(); ?>
              <ul class="social-icons">
                <?php if ( post_custom('email_address') ): ?>
                <li><a href="mailto:<?php echo the_field( 'email_address' ); ?>"><span class="icon-ring"></span><span class="icon-icon-email"></span></a></li>
                <?php endif; ?>
                <?php if ( post_custom('phone_number') ): ?>
                <li><a href="tel:<?php echo the_field( 'phone_number' ); ?>"><span class="icon-ring"></span><span class="icon-icon-phone"></span></a></li>
                <?php endif; ?>
                <?php if ( post_custom('linked_in_profile') ): ?>
                <li><a href="<?php echo the_field( 'linked_in_profile' ); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-linkedin"></span></a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
        <!-- End About Bio -->


      <?php endif; ?>
      <?php endwhile; wp_reset_query(); ?>

        <!-- End About Bio Section -->

      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture section">
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->

      </div> <!-- End of fullpage slider -->

    </div>
    <!-- Expanding content frame -->

    
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
    <script>
    jQuery(function ($) {
	    $(document).ready(function() {
	        var pageHeight;
	        var transformedValue;
	        var remUnit = parseInt($('html').css("font-size"));
          var responsiveWidth = 640;
	        $('#fullpage-slider').fullpage({
	          navigation: true,
	          navigationPosition: 'right',
	          responsiveWidth: 45.1764*remUnit,
	          onLeave: function(index, nextIndex, direction){
              <?php if ( post_custom('enable_hero') ): ?>
	            var leavingSection = $(this);
	            var $header = $('#header');
	            var $logoImg = $('img.logo');
	            var headerSwapTrue = false;
              if(index == 1 && direction =='down'){
                headerSwapTrue = true;
              } else if(nextIndex == 1 && direction == 'up'){
                headerSwapTrue = true;
              }
              if (headerSwapTrue) {
                if (!$header.hasClass("minimized")) {
                  $header.addClass("minimized");
                } else if ($header.hasClass("minimized")) {
                  $header.removeClass("minimized");
                }
              }
              <?php endif; ?>
	          }
	        });
	        if (document.documentElement.clientWidth < 45.1764*remUnit) {
	          $.fn.fullpage.destroy('all');
	        }
	        pageHeight = $('#hero').css("height");
	        $('.scroll-cta > div > *').on("click", function(){
          if (document.documentElement.clientWidth > responsiveWidth) {
            $.fn.fullpage.moveSectionDown();
          } else {
            $('html, body').animate({scrollTop: $("#first-bio").offset().top});
          }
        });
	    });
	});
  </script>

<?php get_footer(); ?>