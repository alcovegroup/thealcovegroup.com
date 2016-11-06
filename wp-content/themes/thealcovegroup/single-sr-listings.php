<?php
/**
 * The Template for displaying SIMPLY RETS Listings
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header(); ?>

  <!-- Expanding content frame -->
  <div id="content-frame">
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
        <?php the_content(); ?>
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
  <script>
    jQuery(function ($) {
      $(document).ready(function() {

        //fix height of overlay- bugs due to slick slider
        // setTimeout(function(){
        //   var theHeight = $(document).height();
        //   $('#darken-overlay').css( "height", theHeight );
        // }, 500);

        $('.slickslide').slick({
          dots: true,
          arrows: true,
          infinite: true,
          speed: 200,
          prevArrow:'<span class="icon-icon-arrow-down arrow-prev"></span>',
          nextArrow:'<span class="icon-icon-arrow-down arrow-next"></span>',
          fade: false,
          slide: 'li',
          cssEase: 'ease-in-out',
          centerMode: true,
          slidesToShow: 1,
          variableWidth: true,
          autoplay: false,
          autoplaySpeed: 4000,
          responsive: [{
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: false,
              centerPadding: '40px',
              variableWidth: false,
              slidesToShow: 1,
              dots: false
            }
          }],
          customPaging: function (slider, i) {
            return "<button class='tab' "
                + "style='background-image: "
                + $('.slick-thumbs li:nth-child(' + (i + 1) + ')').css('background-image')
                +  ";'></button>"
          }
        });
      });
    });

</script>
  <!-- Footer -->
  <div id="footer" class="reverse alcove-texture">
    <?php get_template_part( 'partials/footerContent' ); ?>
  </div>
  <!-- Footer -->
<?php get_footer(); ?>