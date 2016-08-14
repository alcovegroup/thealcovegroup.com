<?php get_header(); ?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <div id="fullpage-slider"> <!-- Start fullpage slider -->

      <!-- Hero -->
      
      <div id="hero" class="section">
        <div class="video-bg" style="width: 100%; height: 100%; border: 1px dashed red; position: absolute;">
          <video width="100%" height="100%" preload autoplay loop muted style="position: absolute; top: 50%; left: 50%; z-index: 1; min-width: 100%; min-height: 100%; width: auto; height: auto; transform: translate(-50%, -50%); z-index: -1000;">
            <source src="http://mls.liquinas.com/wp-content/uploads/2016/08/earth_night_rotate_1080.mp4" type="video/mp4">
            <source src="http://mls.liquinas.com/wp-content/uploads/2016/08/earth_night_rotate_1080.webm" type="video/webm">
            <source src="http://mls.liquinas.com/wp-content/uploads/2016/08/earth_night_rotate_1080.ogg" type="video/ogg">
          Your browser does not support the video tag.
          </video>
        </div>

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
        <div class="featured-home-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');">
          <ol class="featured-home-gallery">
            <li><span class="active" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></span></li>
          </ol>
        </div>
        <div class="featured-overlay"></div>
        <div class="row featured-home-details">
          <div class="small-12 large-4 large-offset-8 columns v-center">
              <div class="featured-home-details-inner">
                <h4>6336 E Via Estrella Ave</h4>
                <h4>Paradise Valley, AZ 85253</h4>
                <h3>$1,774,950</h3>
                <a href="#" class="btn">View Home</a>
              </div>
          </div>
        </div>
      </div>
      <!-- Featured Home -->

      <!-- Featured Home -->
      <div class="featured-home reverse section">
        <div class="featured-home-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');">
          <ol class="featured-home-gallery">
            <li><span class="active" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></span></li>
          </ol>
        </div>
        <div class="featured-overlay"></div>
        <div class="row featured-home-details">
          <div class="small-12 large-4 columns v-center">
            <div class="featured-home-details-inner">
              <h4>6336 E Via Estrella Ave</h4>
              <h4>Paradise Valley, AZ 85253</h4>
              <h3>$1,774,950</h3>
              <a href="#" class="btn">View Home</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Featured Home -->

      <!-- Featured Home -->
      <div class="featured-home section">
        <div class="featured-home-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg');">
          <ol class="featured-home-gallery">
            <li><span class="active" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg');"></span></li>
            <li><span style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');"></span></li>
          </ol>
        </div>
        <div class="featured-overlay"></div>
        <div class="row featured-home-details">
          <div class="small-12 large-4 large-offset-8 columns v-center">
            <div class="featured-home-details-inner">
              <h4>6336 E Via Estrella Ave</h4>
              <h4>Paradise Valley, AZ 85253</h4>
              <h3>$1,774,950</h3>
              <a href="#" class="btn">View Home</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Featured Home -->

      <!-- Featured Home Section -->

    

      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture section">
        <div class="row">
          <div class="small-12 medium-8 medium-offset-2 columns footer-content">
            <?php if ( get_option('global_footer_message') ): ?>
            <h4><?php echo get_option('global_footer_message'); ?></h4>
            <?php endif; ?>

            <form id="footerSubscribe">
              <input type="checkbox" id="newsletter-checkbox" value="newsletter-opt-in" name="newsletter-opt-in" style="display: none;" checked>
              <input type="text" placeholder="Email Address*" name="footer-email-subscribe" required/>
              <input type="submit" class="small" value="Subscribe" />
            </form>
            <script type="text/javascript">
                var __ss_noform = __ss_noform || [];
                __ss_noform.push(['baseURI', 'https://app-3QEHIZGEXU.marketingautomation.services/webforms/receivePostback/MzYwtzQwMDG0BAA/']);
                __ss_noform.push(['form', 'footerSubscribe', '3575c290-c774-4ae3-b045-c53b68ef65d8']);
            </script>
            <script type="text/javascript" src="https://koi-3QEHIZGEXU.marketingautomation.services/client/noform.js?ver=1.24" ></script>
            <ul class="social-icons">
              
            <?php if ( get_option('global_company_email') ): ?>
            <li><a href="<?php echo get_option('global_company_email'); ?>"><span class="icon-icon-email"></span></a></li>
            <?php endif; ?>

            <?php if ( get_option('global_company_phone') ): ?>
            <li><a href="<?php echo get_option('global_company_phone'); ?>"><span class="icon-icon-phone"></span></a></li>
            <?php endif; ?>

            <?php if ( get_option('global_company_facebook') ): ?>
            <li><a href="<?php echo get_option('global_company_facebook'); ?>" target="_blank"><span class="icon-icon-facebook"></span></a></li>
            <?php endif; ?>

            <?php if ( get_option('global_company_linkedin') ): ?>
            <li><a href="<?php echo get_option('global_company_linkedin'); ?>" target="_blank"><span class="icon-icon-linkedin"></span></a></li>
            <?php endif; ?>

            </ul>
            <?php wp_nav_menu( array('container' => false, 'menu_class' => 'menu', 'theme_location' => 'footer' ) ); ?>
            <p class="copyright"><?php echo comicpress_copyright(); ?></p>
          </div>
        </div>
      </div>
      <!-- Footer -->

      </div> <!-- End of fullpage slider -->


      <div id="darken-overlay"></div>

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
        console.log(remUnit);
        $('#fullpage-slider').fullpage({
          navigation: true,
          navigationPosition: 'right',
          responsiveWidth: 37.70588*remUnit,
          afterRender: function () {
            // $('video').get(0).play();
          },
          onLeave: function(index, nextIndex, direction){
            $('video').get(0).play();
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
        if (document.documentElement.clientWidth < 37.70588*remUnit) {
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