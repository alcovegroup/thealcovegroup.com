<?php get_header(); ?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <div id="fullpage-slider"> <!-- Start fullpage slider -->

      <!-- Hero -->
      
      <div id="hero"
      <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
       style="background-image: url('<?php echo $image[0]; ?>');"
      <?php endif; ?>
      class="section">
        

        <div class="hero-overlay reverse">

          <!-- Hero Buttons -->
          <div class="row">
            <div class="large-12 columns hero-buttons">
              <div>
                <a href="<?php echo get_page_link(6); ?>" class="btn">Find your Home’s Value</a>
              </div>
              <div>
                <a href="<?php echo get_page_link(8); ?>" class="btn">Search Homes</a>
              </div>
            </div>
          </div>
          <!-- Hero Buttons -->

          <!-- Scroll CTA -->
          <div class="row scroll-cta">
            <div class="large-12 columns">
              <h3>The Alcove Group Featured Homes</h3>
              <span class="outer-circle"><span class="icon-icon-arrow-down"></span></span>
            </div>
          </div>
          <!-- Scroll CTA -->

        </div>
      </div>
      <!-- Hero -->


      <!-- Featured Home Section -->

      <!-- Featured Home -->
      <div class="featured-home reverse section">
        <div class="featured-home-image">
          <ul class="slickslide">
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></li>
          </ul>
        </div>
        <div class="featured-overlay"></div>
        <div class="row full-width featured-home-details">
          <div class="small-12 columns v-center">
              <div class="featured-home-details-inner">
                <div class="left-group">
                  <h4>6336 E Via Estrella Ave</h4>
                  <h4>Paradise Valley, AZ 85253</h4>
                  <h3>$1,774,950</h3>
                </div>
                <div class="right-group">
                  <a href="#" class="btn">View Home</a>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Featured Home -->

      <!-- Featured Home -->
      <div class="featured-home reverse section">
        <div class="featured-home-image">
          <ul class="slickslide">
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></li>
          </ul>
        </div>
        <div class="featured-overlay"></div>
        <div class="row full-width featured-home-details">
          <div class="small-12 columns v-center">
              <div class="featured-home-details-inner">
                <div class="left-group">
                  <h4>6336 E Via Estrella Ave</h4>
                  <h4>Paradise Valley, AZ 85253</h4>
                  <h3>$1,774,950</h3>
                </div>
                <div class="right-group">
                  <a href="#" class="btn">View Home</a>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Featured Home -->

      <!-- Featured Home -->
      <div class="featured-home section">
        <div class="featured-home-image">
          <ul class="slickslide">
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg');"></li>
            <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></li>
          </ul>
        </div>
        <div class="featured-overlay"></div>
        <div class="row full-width featured-home-details">
          <div class="small-12 columns v-center">
              <div class="featured-home-details-inner">
                <div class="left-group">
                  <h4>6336 E Via Estrella Ave</h4>
                  <h4>Paradise Valley, AZ 85253</h4>
                  <h3>$1,774,950</h3>
                </div>
                <div class="right-group">
                  <a href="#" class="btn">View Home</a>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Featured Home -->

      <!-- Featured Home Section -->

    

      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture section">
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->

      </div> <!-- End of fullpage slider -->


      <div id="darken-overlay"></div>

    </div>
    <!-- Expanding content frame -->

    
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
    <script>
    jQuery(function ($) {
	    $(document).ready(function() {
        var pageHeight;
        var transformedValue;
        var remUnit = parseInt($('html').css("font-size"));
        // var responsiveWidth = Math.ceil(37.70588*remUnit);
        var responsiveWidth = 640;
        console.log(remUnit);

        $('.slickslide').slick({
          dots: true,
          arrows: false,
          customPaging : function() {
            return '<span></span>';
          }
        });

        $('#fullpage-slider').fullpage({
          navigation: true,
          navigationPosition: 'right',
          responsiveWidth: responsiveWidth,
          afterRender: function () {
            if ($(window).width() > responsiveWidth) {
              <?php if ( post_custom('use_video_background') ): ?>
              var videoDiv =  '<div class="video-bg"><video width="100%" height="100%" preload autoplay loop muted><source src="<?php echo the_field( "mp4_video_file" ); ?>" type="video/mp4"><source src="<?php echo the_field( "webm_video_file" ); ?>" type="video/webm"><source src="<?php echo the_field( "ogg_video_file" ); ?>" type="video/ogg">Your browser does not support the video tag.</video></div>';
              $('#hero').prepend( videoDiv );
              $('video').get(0).play();
              <?php endif; ?>
            }
          },
          onLeave: function(index, nextIndex, direction){
            <?php if ( post_custom('use_video_background') ): ?>
            $('video').get(0).play();
            <?php endif; ?>
            var leavingSection = $(this);
            var $header = $('#header');
            var $logoImg = $('img.logo');
            var headerSwapTrue = false;
            if(index == 1 && direction =='down'){
              console.log("leaving section 1 and going down!");
              headerSwapTrue = true;
            } else if(nextIndex == 1 && direction == 'up'){
              console.log("Going up to section 1!");
              headerSwapTrue = true;
            }
            if (headerSwapTrue) {
              if (!$header.hasClass("minimized")) {
                $header.addClass("minimized");
                $logoImg.attr( "src", "<?php echo get_template_directory_uri(); ?>/img/temp-logo-mark.png" )
              } else if ($header.hasClass("minimized")) {
                $header.removeClass("minimized");
                $logoImg.attr( "src", "<?php echo get_template_directory_uri(); ?>/img/temp-logo-full.png" )
              }
            }
          }
        });
        if (document.documentElement.clientWidth <= responsiveWidth) {
        // if (document.documentElement.clientWidth <= 640) {
          $.fn.fullpage.destroy('all');
        }
        pageHeight = $('#hero').css("height");
        $('.scroll-cta > div > *').on("click", function(){
          $.fn.fullpage.moveSectionDown();
        });
    });
	});
  </script>

<?php get_footer(); ?>