<?php
/**
 * Template Name: Home Details
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header(); ?>

    <!-- Expanding content frame -->
    <div id="content-frame">

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
          <h1><span>6336 E Via Estrella Ave</span>
            <span>Paradise Valley, AZ 85253</span></h1>
          <div class="listing-price">
            <table class="line-section-table">
              <tr>
                <td><h4>List Price</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <h3>$1,774,950</h3>
          </div>
          <div class="listing-details clearfix">
            <table class="line-section-table">
              <tr>
                <td><h4>Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <div class="listing-details-tile">
              <h4>Bedrooms</h4>
              <h3>4</h3>
            </div>
            <div class="listing-details-tile">
              <h4>Bathrooms</h4>
              <h3>2.5</h3>
            </div>
            <div class="listing-details-tile">
              <h4>Sq. Ft. House</h4>
              <h3>1000</h3>
            </div>
            <div class="listing-details-tile">
              <h4>Sq. Ft. Lot</h4>
              <h3>5000</h3>
            </div>
          </div>
          <div class="listing-description">
            <h4>Description</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sem ex, luctus a felis vel, condimentum fringilla nulla. Proin lobortis vehicula tortor, a bibendum odio elementum non. Vivamus eget nisi nulla. Fusce magna massa, scelerisque vel pellentesque in, feugiat id nulla. Pellentesque quam felis, pretium eget nulla non, pharetra lobortis mauris. Aenean rhoncus convallis lobortis. Etiam tempus auctor lectus, eu gravida lectus ullamcorper sed. Pellentesque id gravida nulla, sed fermentum massa. Nunc rhoncus nisi quis molestie viverra. Curabitur gravida mi ut enim maximus dignissim. Vivamus rutrum ligula eu sem semper tempus. Morbi nulla mauris, ullamcorper et nisl ac, aliquam vehicula velit. Cras ut fringilla diam.</p>

            <p>Donec tempus massa ut tellus fringilla suscipit. Aenean iaculis risus erat, quis pretium arcu congue accumsan. Etiam sed semper nibh, eget egestas nisl. Sed finibus justo interdum turpis tincidunt sagittis. Maecenas eu tortor eu dui placerat pretium. Duis sed mattis augue. Integer eget sagittis massa. Etiam vitae risus mollis odio hendrerit pharetra. Nunc semper, ex et lacinia accumsan, neque tellus dignissim arcu, nec iaculis risus odio vitae nunc. Ut placerat tincidunt tellus, et sagittis tellus laoreet vel. Integer non sodales elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus luctus sagittis orci vitae ultricies. Nullam sed ex in eros lacinia tempor id id risus. Nullam tempus justo eget rutrum porttitor.</p>
          </div>
          <div class="listing-schools">
            <table class="line-section-table">
              <tr>
                <td><h4>School Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <h4>District</h4>
            <h3>Phoenix Central School District</h3>

            <h4>Elementary School</h4>
            <h3>MICHAEL A MAROUN Elementary</h3>

            <h4>Middle School</h4>
            <h3>EMERSON J DILLON Middle</h3>

            <h4>High School</h4>
            <h3>JOHN C BIRDLEBOUGH High</h3>
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
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->

    </div>
    <!-- Expanding content frame -->

    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick.min.js"></script>
    <script>
    jQuery(function ($) {
		$(document).ready(function() {
			
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

	function initMap() {
		var myLatLng = {lat: 33.5650816, lng: -111.91640030000002};
		// Create a map object and specify the DOM element for display.
		var map = new google.maps.Map(document.getElementById('home-map'), {
			center: myLatLng,
			scrollwheel: false,
			zoom: 10
		});
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Home Location'
		});
	}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmCM_w4VaOnhY8XQgyl7SFawfm2c5s21A&callback=initMap"
    async defer></script>

<?php get_footer(); ?>