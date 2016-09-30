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
        <div class="small-12 medium-8 large-6 columns">
          <div class="subheader-share-2">
            <table class="line-section-table">
              <tr>
                <td class="table-left-header">
                  <h4>Share this Home</h4>
                  <a href="#">
                    <span class="social-icon"><span class="icon-icon-facebook"></span></span>
                  </a>
                  <a href="#">
                    <span class="social-icon"><span class="icon-icon-linkedin"></span></span>
                  </a>
                </td>
                <td class="fill-line"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- Subheader row -->

      <!-- Jumbotron -->
      <div id="home-gallery-row" class="row">
        <ul class="slickslide">

            <?php 
            $images = get_field('photo_gallery');
            if( $images ): ?>

            <?php foreach( $images as $image ): ?>
              <li><img src="<?php echo $image['sizes']['large']; ?>" title="img" alt="img" /></li>
              <!-- Needs titles and alts -->
            <?php endforeach; ?>
 
            <?php endif; ?>

        </ul>
        <div class="slick-thumbs">
            <ul>
              
              <?php 
              $images = get_field('photo_gallery');
              if( $images ): ?>

              <?php foreach( $images as $image ): ?>
                <li style="background-image: url('<?php echo $image['sizes']['large']; ?>')"></li>
                <!-- Needs titles and alts -->
              <?php endforeach; ?>
   
              <?php endif; ?>

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


          <?php if ( post_custom('num_bedrooms') || post_custom('num_bathrooms') || post_custom('square_footage_house') || post_custom('square_footage_lot') || ($post->post_content!=="") ): ?>
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

          <?php endif; ?>


          <?php if ( post_custom('school_district') || post_custom('elementary_school') || post_custom('middle_school') || post_custom('high_school') ): ?>
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
          <?php endif; ?>


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
        <?php get_template_part( 'partials/footerContent' ); ?>
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

      if ($(window).width() > 767) {
        $('.slickslide').on('init', function(event, slick){
          //find number of photos
          var thumbs = $('.slick-dots').children('li');
          var numThumbs = thumbs.length;
          //find size of photo thumb
          var thumbWidth = $(thumbs[0]).width();
          var thumbHeight = $(thumbs[0]).height();
          //find total width of track
          var containerWidth = $('#home-gallery-row').width();
          var totalTrackWidth = Math.floor(numThumbs * thumbWidth) + thumbWidth;
          var posX = 0;
          var numThumbsInVP = Math.floor(containerWidth / thumbWidth);
          var numThumbsOffScreen = numThumbs - numThumbsInVP;
          //wrap slick-dots in track
          $('.slick-dots').wrap(function() {
            return "<div class='slick-dots-track' style='height: " + thumbHeight + "px;'></div>";
          });
          //set width of dots ul to total width & height of 1 thumb
          $('.slick-dots').css({ "height": thumbHeight, "width": totalTrackWidth });

          //if the thumb track is less than the container width, we need arrows
          if (!(totalTrackWidth < containerWidth)) {
            $('.slick-dots-track').append("<span id='scroll-left' class='slick-dots-track-arrow'><span class='icon-icon-arrow-down arrow-prev'></span></span>");
            $('.slick-dots-track').append("<span id='scroll-right' class='slick-dots-track-arrow'><span class='icon-icon-arrow-down arrow-next'></span></span>");
            $('#scroll-left').on("click", function(){
              console.log("left arrow clicked");
              if (posX < 0) {
                $('.slick-dots').css("-webkit-transform", "translateX(" + (posX + thumbWidth) + "px)");
                $('.slick-dots').css("-moz-transform", "translateX(" + (posX + thumbWidth) + "px)");
                $('.slick-dots').css("-o-transform", "translateX(" + (posX + thumbWidth) + "px)");
                $('.slick-dots').css("transform", "translateX(" + (posX + thumbWidth) + "px)");
                posX = (posX + thumbWidth);
              }
            });
            $('#scroll-right').on("click", function(){
              console.log("right arrow clicked");
              if (posX > (numThumbsOffScreen * thumbWidth * -1)) {
                $('.slick-dots').css("-webkit-transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
                $('.slick-dots').css("-moz-transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
                $('.slick-dots').css("-o-transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
                $('.slick-dots').css("transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
                posX = (posX + thumbWidth*-1);
              }
            });
          } //end if track size conditional

        }); //end slick init function
      } //end if window width conditional

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
            return '<span class="slick-thumb-highlight""></span>'
                  + "<button class='tab' "
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