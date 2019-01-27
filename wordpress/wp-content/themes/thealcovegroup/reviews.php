<?php
/**
 * Template Name: Reviews
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header(); ?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <!-- Hero -->
      <div id="hero"
      <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
       style="background-image: url('<?php echo $image[0]; ?>');"
      <?php endif; ?>
      >
        <?php get_template_part( 'partials/hero-overlay' ); ?>

        <div id="realtorHeader" class="row review-bio-header">
            <div class="review-bio-photo">
              <img id="realtorImage" />
            </div>
            <div class="review-bio-info">
              <h3 class="review-bio-headline"><a id="realtorURL" href="" target="_blank"><span id="realtorName"></span> Reviews</a></h3>
              <span class="review-bio-stats"><span id="reviewsCount"></span> Reviews on Zillow</span>
              <span class="review-bio-stats"><span id="reviewsAve"></span><span class="icon-icon-star"></span> Ave. Rating</span>
              <a id="zillowLogo" href="" target="_blank">
                <img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_200x50.gif" width="200" height="50" alt="Zillow Real Estate Search" id="yui_3_18_1_1_1533615001397_351">
              </a>
            </div>
          </div>

          <ul id="zillowReviews" class="zillow-reviews-list"><img class="loader-gif" src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" /></ul>
          <div class="zillow-footer">
            <small>© Zillow, Inc., 2006-2016. Use is subject to <a href="https://www.zillow.com/corp/Terms.htm" target="_blank">Terms of Use</a></small>
          </div>

        </div>
      </div>
      <!-- Hero -->


      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture">
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->

    </div>
    <!-- Expanding content frame -->

    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
    <script>var $zillowUser = '<?php echo the_field( 'zillow_user' ); ?>'</script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/reviews.js"></script>
<?php get_footer(); ?>