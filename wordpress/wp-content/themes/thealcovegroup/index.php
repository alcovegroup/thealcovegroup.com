<?php get_header();?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <div id="fullpage-slider"> <!-- Start fullpage slider -->

      <!-- Hero -->
      <!-- FOOBAR test comment 2 -->
      
      <div id="hero"
      <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
       style="background-image: url('<?php echo $image[0]; ?>');"
      <?php endif; ?>
      class="section">
        

        <?php get_template_part( 'partials/hero-overlay' ); ?>

          <!-- Hero Buttons -->
          <div class="row v-center">
            <div class="large-12 columns hero-buttons">
              <div>
                <a href="<?php echo network_site_url() . '/about/'; ?>" class="btn">Realtors</a>
              </div>

              <div>
                <?php if ($GLOBALS['isChildThemePage']) {
                    $neighborhood_name = get_neighborhood_value();
                    $find_hvalue_path = get_find_homes_value_value();
                    ?>
                  <!-- <a href="<?=$find_hvalue_path;?>" class="btn">What's my <?=$neighborhood_name;?> home worth?</a> -->
                  <a href="http://housevaluereport.com/index.cfm?websiteid=3784&fbclid=IwAR09n3Nj7XHrkOG-iod4CZMAnf7Zq2dwKVxESi9z4itiUqr6QE0v3nSxvFo" class="btn">What's my <?=$neighborhood_name;?> home worth?</a>
                <?php } else { ?>
                  <!-- <a href="<?php echo get_page_link(6); ?>" class="btn">What's my home worth?</a> -->
                  <a href="http://housevaluereport.com/index.cfm?websiteid=3784&fbclid=IwAR09n3Nj7XHrkOG-iod4CZMAnf7Zq2dwKVxESi9z4itiUqr6QE0v3nSxvFo" class="btn">What's my home worth?</a>
                <?php } ?>
              </div>
              <div>
                <?php if ($GLOBALS['isChildThemePage']) {
                    $search_homes_path = get_search_homes_value();
                    ?>
                  <a href="<?=$search_homes_path;?>" class="btn">Search <?=$neighborhood_name;?> Homes</a>;
                <?php } else { ?>
                  <a href="<?php echo get_page_link(343); ?>" class="btn">Search Homes</a>
                <?php } ?>
              </div>
              
            </div>
          </div>
          <!-- Hero Buttons -->

          <!-- Scroll CTA -->
          <div class="row scroll-cta">
            <div class="large-12 columns">
              <h3>Alcove Featured Homes</h3>
              <span class="outer-circle"><span class="icon-icon-arrow-down"></span></span>
            </div>
          </div>
          <!-- Scroll CTA -->

        </div>
      </div>
      <!-- Hero -->

      <!-- Featured Home Section -->

      <?php $loop = new WP_Query( array( 'post_type' => 'featured_home', 'posts_per_page' => -1 ) ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
          <?php if ( post_custom('mls_id') ) {
              $fetch_mls_id = post_custom('mls_id');
              include_once('template-render-homepage-mls-listing.php');
          } else { ?>
          <!-- Featured Home -->
      <div class="featured-home section">
        <div class="featured-home-image">
          <ul class="slickslide">
            <?php 
            $images = get_field('photo_gallery');
            if( $images ): ?>

            <?php
              $i=1;
              $limit=4;
            ?>

            <?php foreach( $images as $image ): ?>

              <li style="background-image: url('<?php echo $image['sizes']['large']; ?>');"></li>
              
              <?php $i=$i+1; if ($i>$limit) break; ?>

            <?php endforeach; ?>
 
            <?php endif; ?>
          </ul>
        </div>
        <div class="featured-overlay"></div>
        <div class="row full-width featured-home-details">
          <div class="small-12 columns v-center">
              <div class="featured-home-details-inner">
                <div class="left-group">

                  <?php if ( post_custom('address_1') ): ?>
                  <h4><?php the_field( 'address_1' ); ?></h4>
                  <?php endif; ?>

                  <?php if ( post_custom('address_2') ): ?>
                  <h4><?php the_field( 'address_2' ); ?></h4>
                  <?php endif; ?>

                  <?php if ( post_custom('list_price') ): ?>
                  <h3><?php the_field( 'list_price' ); ?></h3>
                  <?php endif; ?>

                </div>
                <div class="right-group">
                  <a href="<?php echo get_post_permalink(); ?>" class="btn">View Home</a>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Featured Home -->
          <?php
          }#if mls_id
      endwhile; wp_reset_query(); ?>


      <!-- Featured Home Section -->

    

      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture section">
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->

      </div> <!-- End of fullpage slider -->

    </div>
    <!-- Expanding content frame -->

    
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
    <script>
    jQuery(function ($) {
	    $(document).ready(function() {

        // alert("<?php echo get_option('global_listing_agent'); ?>");

        function showPage(){
          setTimeout(function(){   
            $('#pageHide').css({
              "opacity": "1",
              "pointer-events": "auto"
            });
          }, 35);
        }
        showPage();

        var responsiveWidth = 640;
        var pageHeight;
        var transformedValue;
        var remUnit = parseInt($('html').css("font-size"));
        
        var featuredHomeSections = $(".section:not(#hero,#footer)");
        var anchorsToUse = [];
        anchorsToUse.push('fullpage-home');
        for (i = 0; i < featuredHomeSections.length; i++) {
          anchorsToUse.push('featured-home-' + i);
        }
        anchorsToUse.push('fullpage-footer');
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
          anchors: anchorsToUse,
          responsiveWidth: responsiveWidth,
          afterRender: function () {

            if ($(window).width() > responsiveWidth) {
              <?php if ( post_custom('use_video_background') ): ?>
              var videoDiv =  '<div class="video-bg"><video id="videoPreload" width="100%" height="100%" preload autoplay loop muted><source src="<?php echo the_field( "mp4_video_file" ); ?>" type="video/mp4"><source src="<?php echo the_field( "webm_video_file" ); ?>" type="video/webm"><source src="<?php echo the_field( "ogg_video_file" ); ?>" type="video/ogg">Your browser does not support the video tag.</video></div>';
              $('#hero').css("background-image", "none");
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
          }
        });

        if (document.documentElement.clientWidth <= responsiveWidth) {
          $.fn.fullpage.destroy('all');
          if (featuredHomeSections[0]) {
            $(featuredHomeSections[0]).attr('id', 'featured-home-0');
          }
        }
        pageHeight = $('#hero').css("height");
        $('.scroll-cta > div > *').on("click", function(){
          if (document.documentElement.clientWidth > responsiveWidth) {
            $.fn.fullpage.moveSectionDown();
          } else {
            $('html, body').animate({scrollTop: $("#featured-home-0").offset().top});
          }
        });
    });
	});
  </script>

<?php get_footer(); ?>
