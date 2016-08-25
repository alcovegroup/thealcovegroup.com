<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header(); ?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <div id="office-map-row" class="row">
        <div class="small-12 columns">
          <h1><?php the_title(); ?></h1>
        </div>
        <div id="google-map-id" class="small-12 columns office-map-embed">
         
        </div>
      </div>

      <div class="row contact-content">
        <div class="small-12 medium-6 columns office-details-col">
          <h2><span><?php the_field( 'company_address_1' ); ?></span><span><?php the_field( 'company_address_2' ); ?></span></h2>
          <?php if ( post_custom('phone_number') ): ?>
          <div class="lined-header-lockup">
            <table class="line-section-table">
              <tr>
                <td><h4>Phone Number</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <h3><a href="tel:<?php echo the_field( 'phone_number' ); ?>" class="link-no-border">123-456-7890</a></h3>
          </div>
          <?php endif; ?>
          <?php if ( post_custom('fax_number') ): ?>
          <div class="lined-header-lockup">
            <table class="line-section-table">
              <tr>
                <td><h4>Fax Number</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <h3><a href="tel:<?php echo the_field( 'fax_number' ); ?>" class="link-no-border">123-456-7890</a></h3>
          </div>
          <?php endif; ?>
          <?php if ( post_custom('company_email') ): ?>
          <div class="lined-header-lockup">
            <table class="line-section-table">
              <tr>
                <td><h4>Email Address</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <h3><a href="mailto:<?php echo the_field( 'company_email' ); ?>" class="link-no-border"><?php the_field( 'company_email' ); ?></a></h3>
          </div>
          <?php endif; ?>
        </div>
        <div class="small-12 medium-6 columns contact-form-col form-button-right">
          <?php if ( post_custom('form_title') ): ?>
            <table class="line-section-table">
              <tr>
                <td><h4><?php the_field( 'form_title' ); ?></h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <?php endif; ?>
            <form>
              <input type="text" placeholder="First Name*" required />
              <input type="text" placeholder="Last Name*" required />
              <input type="text" placeholder="Email Address*" required />
              <input type="text" placeholder="Phone Number*" required />
              <textarea rows="7" placeholder="Optional Message"></textarea>
              <div>
                <span><sup>*</sup>Required</span>
                <input type="submit" value="Inquire" />
              </div>
            </form>
        </div>
      </div>


      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture">
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->


      <div id="darken-overlay"></div>

    </div>
    <!-- Expanding content frame -->

    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
    <script>
      function initMap() {

        var myLatLng = {lat: 33.5650816, lng: -111.91640030000002};
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('google-map-id'), {
          center: myLatLng,
          scrollwheel: false,
          zoom: 10
        });

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 style="font-size: 1rem; margin: 0.5rem 0; text-align: center;">The Alcove Group</h4>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'The Alcove Group'
        });

        infowindow.open(map, marker);
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmCM_w4VaOnhY8XQgyl7SFawfm2c5s21A&callback=initMap"
    async defer></script>

<?php get_footer(); ?>