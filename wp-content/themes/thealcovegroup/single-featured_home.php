<?php
/**
 * The Template for displaying single unlisted home
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header(); ?>

    <!-- Expanding content frame -->
    <div id="content-frame">
    <?php if (have_posts()) : while (have_posts()) : the_post();?>

      <!-- Subheader row -->
      <div id="subheader-row" class="row">
        <div class="small-12 medium-4 columns">
          <a href="<?php echo get_page_link(8); ?>" class="btn small">Back to Search</a>
        </div>
        <div class="small-12 medium-8 columns">
          <div class="subheader-share-3">
          </div>
          <div class="subheader-share-2">
            <a href="#">
              <span class="social-icon"><span class="icon-icon-facebook"></span></span>
            </a>
            <a href="#">
              <span class="social-icon"><span class="icon-icon-linkedin"></span></span>
            </a>
          </div>
          <div class="subheader-share-1">
            <h4>Share this Home</h4>
          </div>
        </div>
      </div>
      <!-- Subheader row -->

      <!-- Jumbotron -->
      <div id="home-gallery-row" class="row">
        <ul class="slickslide">
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg" title="img" alt="img" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg" title="img2" alt="img2" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg" title="img" alt="img" /></li>
            <li><img src="https://s-media-cache-ak0.pinimg.com/736x/7c/0a/96/7c0a96f30b73a3ff57d66cf5c2eaab98.jpg" title="img" alt="img" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg" title="img" alt="img" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg" title="img2" alt="img2" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg" title="img" alt="img" /></li>
            <li><img src="https://s-media-cache-ak0.pinimg.com/736x/7c/0a/96/7c0a96f30b73a3ff57d66cf5c2eaab98.jpg" title="img" alt="img" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg" title="img" alt="img" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg" title="img2" alt="img2" /></li>
            <li><img src="<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg" title="img" alt="img" /></li>
        </ul>
        <div class="slick-thumbs">
            <ul>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg')"></li>
              <li style="background-image: url('https://s-media-cache-ak0.pinimg.com/736x/7c/0a/96/7c0a96f30b73a3ff57d66cf5c2eaab98.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg')"></li>
              <li style="background-image: url('https://s-media-cache-ak0.pinimg.com/736x/7c/0a/96/7c0a96f30b73a3ff57d66cf5c2eaab98.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg')"></li>
              <li style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-03.jpg')"></li>
            </ul>
        </div>
      </div>
      <!-- Jumbotron -->

      <!-- Details content -->
      <div id="home-content-row" class="row">
        <div id="home-content-left" class="small-12 large-6 columns">
          <h1><span><?php the_field( 'address_1' ); ?></span>
            <span><?php the_field( 'address_2' ); ?></span></h1>

          <?php if ( post_custom('list_price') ): ?>
          <div class="listing-price">
            <table class="line-section-table">
              <tr>
                <td><h4>List Price</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <h3><?php the_field( 'list_price' ); ?></h3>
          </div>
          <?php endif; ?>

          <div class="listing-details clearfix">
            <table class="line-section-table">
              <tr>
                <td><h4>Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>

            <?php if ( post_custom('num_bedrooms') ): ?>
            <div class="listing-details-tile">
              <h4>Bedrooms</h4>
              <h3><?php the_field( 'num_bedrooms' ); ?></h3>
            </div>
            <?php endif; ?>

            <?php if ( post_custom('num_bathrooms') ): ?>
            <div class="listing-details-tile">
              <h4>Bathrooms</h4>
              <h3><?php the_field( 'num_bathrooms' ); ?></h3>
            </div>
            <?php endif; ?>

            <?php if ( post_custom('square_footage_house') ): ?>
            <div class="listing-details-tile">
              <h4>Sq. Ft. House</h4>
              <h3><?php the_field( 'square_footage_house' ); ?></h3>
            </div>
            <?php endif; ?>

            <?php if ( post_custom('square_footage_lot') ): ?>
            <div class="listing-details-tile">
              <h4>Sq. Ft. Lot</h4>
              <h3><?php the_field( 'square_footage_lot' ); ?></h3>
            </div>
            <?php endif; ?>
          </div>

          <?php if($post->post_content!=="") : ?>
          <div class="listing-description">
            <h4>Description</h4>
            <?php the_content(); ?>
          </div>
          <?php endif; ?>


          <div class="listing-schools">
            <table class="line-section-table">
              <tr>
                <td><h4>School Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>

            <?php if ( post_custom('school_district') ): ?>
            <h4>District</h4>
            <h3><?php the_field( 'school_district' ); ?></h3>
            <?php endif; ?>

            <?php if ( post_custom('elementary_school') ): ?>
            <h4>Elementary School</h4>
            <h3><?php the_field( 'elementary_school' ); ?></h3>
            <?php endif; ?>

            <?php if ( post_custom('middle_school') ): ?>
            <h4>Middle School</h4>
            <h3><?php the_field( 'middle_school' ); ?></h3>
            <?php endif; ?>

            <?php if ( post_custom('high_school') ): ?>
            <h4>High School</h4>
            <h3><?php the_field( 'high_school' ); ?></h3>
            <?php endif; ?>

          </div>
        </div>
        <div id="home-content-right" class="small-12 large-6 columns">
          <div id="home-map"></div>
        
          <div class="inquire-form form-button-right">
            <h4>Interested in this home?</h4>
            <form>
              <input type="text" placeholder="First Name*" required />
              <input type="text" placeholder="Last Name*" required />
              <input type="text" placeholder="Email Address*" required />
              <input type="text" placeholder="Phone Number*" required />
              <span class="select-span">How soon are you interested in buying?</span>
              <select required>
                <option selected disabled>Select<sup>*</sup></option>
                <option value="planning-now">Now</option>
                <option value="planning-1-3">1-3 months</option>
                <option value="planning-6-plus">6 months - 1 year</option>
              </select>
              <textarea rows="7" placeholder="Optional Message"></textarea>
              <div>
                <span><sup>*</sup>Required</span>
                <input type="submit" value="Inquire" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Details content -->


      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture">
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


      <div id="darken-overlay"></div>

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
			setTimeout(function(){
				var theHeight = $(document).height();
				$('#darken-overlay').css( "height", theHeight );
			}, 500);

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

	var geocoder, map;
	var homeAddress = "<?php echo the_field( 'address_1' ); ?> <?php echo the_field( 'address_2' ); ?>";

	function initMap() {
	    geocoder = new google.maps.Geocoder();
	    geocoder.geocode({
	        'address': homeAddress
	    }, function(results, status) {
	        if (status == google.maps.GeocoderStatus.OK) {
	            var myOptions = {
	                zoom: 10,
	                center: results[0].geometry.location,
	                mapTypeId: google.maps.MapTypeId.ROADMAP
	            }
	            map = new google.maps.Map(document.getElementById("home-map"), myOptions);

	            var marker = new google.maps.Marker({
	                map: map,
	                position: results[0].geometry.location
	            });
	        }
	    });
	}	

	// function initMap() {
	// 	consol.log("home address is: " + homeAddress);
	// 	var myLatLng = {lat: 33.5650816, lng: -111.91640030000002};
	// 	// Create a map object and specify the DOM element for display.
	// 	var map = new google.maps.Map(document.getElementById('home-map'), {
	// 		center: myLatLng,
	// 		scrollwheel: false,
	// 		zoom: 10
	// 	});
	// 	var marker = new google.maps.Marker({
	// 		position: myLatLng,
	// 		map: map,
	// 		title: 'Home Location'
	// 	});
	// }


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmCM_w4VaOnhY8XQgyl7SFawfm2c5s21A&callback=initMap"
    async defer></script>

<?php get_footer(); ?>