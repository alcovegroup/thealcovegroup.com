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
          <a href="<?php echo get_page_link(4); ?>" class="btn small">Home</a>
        </div>
        <div class="small-12 medium-8 large-6 columns">
          <div class="subheader-share-2">
            <table class="line-section-table">
              <tr>
                <td class="table-left-header">
                  <h4>Share this Home</h4>
                  <a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
                    <span class="social-icon"><span class="icon-icon-facebook"></span></span>
                  </a>
                  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php echo the_title(); ?>&summary=<?php echo get_the_content() ?>&source=<?php echo get_site_url(); ?>" target="_blank">
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

          <?php if ( post_custom('property_style') || post_custom('num_stories') || post_custom('interior_features') || post_custom('exterior_features') || post_custom('year_built') || post_custom('heating_cooling') || post_custom('additional_rooms') ): ?>
          <div class="additional-details">
            <table class="line-section-table">
              <tr>
                <td><h4>Additional Property Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <table class="features-table">
              <?php if ( post_custom('property_style') ): ?>
              <tr>
                <td>Property Style</td>
                <td><?php the_field( 'property_style' ); ?></td>
              </tr>
              <?php endif; ?>

              <?php if ( post_custom('num_stories') ): ?>
              <tr>
                <td>Stories</td>
                <td><?php the_field( 'num_stories' ); ?></td>
              </tr>
              <?php endif; ?>

              <?php if ( post_custom('interior_features') ): ?>
              <tr>
                <td>Features</td>
                <td><?php the_field( 'interior_features' ); ?></td>
              </tr>
              <?php endif; ?>

              <?php if ( post_custom('exterior_features') ): ?>
              <tr>
                <td>Exterior Features</td>
                <td><?php the_field( 'exterior_features' ); ?></td>
              </tr>
              <?php endif; ?>

              <?php if ( post_custom('year_built') ): ?>
              <tr>
                <td>Year Built</td>
                <td><?php the_field( 'year_built' ); ?></td>
              </tr>
              <?php endif; ?>

              <!-- <tr>
                <td>Fireplaces</td>
                <td>1</td>
              </tr>
              <tr>
                <td>Subdivisions</td>
                <td>Waterstone Springs</td>
              </tr>
              <tr>
                <td>View</td>
                <td>Golf Course</td>
              </tr>
              <tr>
                <td>Roof</td>
                <td>Tile</td>
              </tr> -->

              <?php if ( post_custom('heating_cooling') ): ?>
              <tr>
                <td>Heating &amp; Cooling</td>
                <td><?php the_field( 'heating_cooling' ); ?></td>
              </tr>
              <?php endif; ?>

              <!-- <tr>
                <td>Foundation</td>
                <td>Slab</td>
              </tr>
              <tr>
                <td>Accessibility</td>
                <td>Manned Gate</td>
              </tr>
              <tr>
                <td>Lot Description</td>
                <td>Private Backyard</td>
              </tr>
              <tr>
                <td>Laundry Features</td>
                <td>Area,Electric Dryer Hookup,Individual Room,Washer Hookup</td>
              </tr> -->

              <?php if ( post_custom('additional_rooms') ): ?>
              <tr>
                <td>Additional Rooms</td>
                <td><?php the_field( 'additional_rooms' ); ?></td>
              </tr>
              <?php endif; ?>

            </table>
          </div>
          <?php endif; ?>


        </div>
        <div id="home-content-right" class="small-12 large-6 columns">
          <div id="home-map"></div>

          <div class="additional-details">

          <?php if ( post_custom('directions') || post_custom('county') || post_custom('market_area') ): ?>
            <table class="line-section-table">
              <tr>
                <td><h4>Geographic Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <table class="features-table">
              <?php if ( post_custom('directions') ): ?>
              <tr>
                <td>Directions</td>
                <td><?php the_field( 'directions' ); ?></td>
              </tr>
              <?php endif; ?>

              <?php if ( post_custom('county') ): ?>
              <tr>
                <td>County</td>
                <td><?php the_field( 'county' ); ?></td>
              </tr>
              <?php endif; ?>

              <?php if ( post_custom('market_area') ): ?>
              <tr>
                <td>Market Area</td>
                <td><?php the_field( 'market_area' ); ?></td>
              </tr>
              <?php endif; ?>
            </table>
            <?php endif; ?>

            <table class="line-section-table">
              <tr>
                <td><h4>Address Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <table class="features-table">
              <?php if ( post_custom('address_1') && post_custom('address_2')): ?>
              <tr>
                <td>Address</td>
                <td><?php the_field( 'address_1' ); ?><br>
                <?php the_field( 'address_2' ); ?></td>
              </tr>
              <?php endif; ?>

              <!-- <tr>
                <td>Unit</td>
                <td>18393</td>
              </tr>
              <tr>
                <td>Postal Code</td>
                <td>77096</td>
              </tr>
              <tr>
                <td>City</td>
                <td>Houston</td>
              </tr> -->

              <?php if ( post_custom('cross_street') ): ?>
              <tr>
                <td>Cross Street</td>
                <td><?php the_field( 'cross_street' ); ?></td>
              </tr>
              <?php endif; ?>

              <!-- <tr>
                <td>State</td>
                <td>Texas</td>
              </tr>
              <tr>
                <td>Country</td>
                <td>United States</td>
              </tr> -->
            </table>

            <?php if ( post_custom('listing_agent') ): ?>
            <table class="line-section-table">
              <tr>
                <td><h4>Listing Information</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <table class="features-table">
              <tr>
                <td>Listing Agent</td>
                <td><?php the_field( 'listing_agent' ); ?></td>
              </tr>
              <!-- <tr>
                <td>Terms</td>
                <td>Conventional</td>
              </tr>
              <tr>
                <td>MLS Status</td>
                <td>Active</td>
              </tr>
              <tr>
                <td>Listing Date</td>
                <td>May 23, 2011</td>
              </tr>
              <tr>
                <td>Tax ID</td>
                <td>593-723-781-8056</td>
              </tr>
              <tr>
                <td>MLS Area</td>
                <td>Spring/Klein</td>
              </tr>
              <tr>
                <td>MLS #</td>
                <td>49699701</td>
              </tr>
              <tr>
                <td>Disclaimer</td>
                <td>This information is believed to be accurate, but without warranty.</td>
              </tr> -->
            </table>
            <?php endif; ?>

          </div>
         
          <div class="inquire-form form-button-right">
            <h4>Interested in this home?</h4>
            <form id="inquire-form" action="" method="post" data-abide onsubmit="event.preventDefault(); formSubmission(event);">
              <input type="checkbox" name="Submitted Listing Inquiry" value="Submitted Listing Inquiry" checked style="display: none;" />
              <input type="text" name="MLS-id" style="display: none;"/>
              <?php $listing_url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
              <input type="text" name="listing-url" value="<?=$listing_url;?>" style="display: none;"/>

              <input type="text" name="first-name" placeholder="First Name*" required />
              <small class="error">We need to know who to contact!</small>

              <input type="text" name="last-name" placeholder="Last Name" />

              <input type="text" name="email-address" placeholder="Email Address*" pattern="email" required />
              <small class="error">A valid email address is required.</small>

              <input type="text" name="phone-number" placeholder="Phone Number*" required />
              <small class="error">A phone number is required.</small>

              <span class="select-span">How soon are you interested in buying?</span>
              <select name="buying-timeframe" required>
                <option selected disabled value>Select<sup>*</sup></option>
                <option value="planning-now">Now</option>
                <option value="planning-1-3">1-3 months</option>
                <option value="planning-6-plus">6 months - 1 year</option>
              </select>
              <small class="error">More info is required.</small>

              <textarea rows="7" name="optional-message" placeholder="Optional Message"></textarea>
              <div>
                <span><sup>*</sup>Required</span>
                <input type="submit" value="Inquire" />
              </div>
            </form>
            <script type="text/javascript">
              var __ss_noform = __ss_noform || [];
              __ss_noform.push(['baseURI', 'https://app-3QEHIZGEXU.marketingautomation.services/webforms/receivePostback/MzYwtzQwMDG0BAA/']);
              __ss_noform.push(['form', 'inquire-form', '7c39939e-318b-4fb1-a3cf-93d47759eb2a']);
              __ss_noform.push(['submitType', 'manual']);
            </script>
            <script type="text/javascript" src="https://koi-3QEHIZGEXU.marketingautomation.services/client/noform.js?ver=1.24" ></script>

            <!-- Shows after form submit hides form -->
            <div id="thank-you-message">
              <h3>Thanks for contacting The Alcove Group!</h3>
              <p>A specialist will get back to you shortly to discuss your submission.</p>
            </div>

          </div>


        </div>
      </div>
      <!-- Details content -->


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
    </script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/single_listings.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvOFHf88DsjnHQ0lDbjK7tE-AAgqvNsVc&callback=initMap" async defer></script>

<?php get_footer(); ?>