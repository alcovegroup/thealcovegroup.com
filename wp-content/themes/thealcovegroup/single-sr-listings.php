<?php
/**
 * The Template for displaying SIMPLY RETS Listings
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
session_start();
$fb_listed_metadata = 1;
$listing_url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$mls_id = preg_replace('~http:(.*)\/listings\/([0-9]+)\/(.*)~', '$2', $listing_url);
$mls_data = SimplyRetsApiHelper::pullDataDump('/'.$mls_id);
require_once ('header.php');
?>

  <!-- Expanding content frame -->
  <div id="content-frame">
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
        <?php
      the_content(); ?>
      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture">
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->


    <?php endwhile; endif; wp_reset_query(); ?>
  </div>
  <!-- Expanding content frame -->

  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/single_listings.js"></script>
  <!-- Footer -->
  <div id="footer" class="reverse alcove-texture">
    <?php get_template_part( 'partials/footerContent' ); ?>
  </div>
  <!-- Footer -->
<?php get_footer(); ?>