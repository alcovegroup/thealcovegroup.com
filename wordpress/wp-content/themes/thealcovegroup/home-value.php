<?php
/**
 * Template Name: Find Your Home's Value
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header();
if ($GLOBALS['isChildThemePage']) {
  $state_value = get_state_value();
  $state_value_long = get_state_value('long');
}
?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <!-- Hero -->
      
      <div id="hero"
      <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
       style="background-image: url('<?php echo $image[0]; ?>');"
      <?php endif; ?>
      >
      
        <?php get_template_part( 'partials/hero-overlay' ); ?>

          <div class="row form-page-header form-and-blurb">
            <div class="small-12 small-centered medium-11 large-9 columns">
              <h3><?php the_title(); ?></h3>
              <?php if (!$GLOBALS['isChildThemePage']) {
                get_template_part( 'partials/call-now-promo' );
              } ?>
              <?php if (have_posts()) : while (have_posts()) : the_post();?>
              <?php the_content(); ?>
              <?php endwhile; endif; wp_reset_query(); ?>
            </div>
          </div>

          <div class="row hero-form form-button-right">
            <div class="small-12 small-centered medium-10 large-6 columns"> <!-- Start form column -->
              <!-- The form itself -->
                <form id="home-value-form" class="row form-and-blurb" action="" method="post" data-abide onsubmit="event.preventDefault(); formSubmission(event);">
                  <input type="checkbox" name="Submitted Home Value Form" value="Submitted Home Value Form" checked style="display: none;" />
                  <div class="row">
                    <div class="small-12 columns">
                      <input type="text" placeholder="Street Address*" name="street-address" required />
                      <small class="error">An address is required.</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 medium-4 columns">
                      <?php if ($GLOBALS['isChildThemePage']) {
                        $neighborhood_name = get_neighborhood_value();
                        echo "<input type='text' value='{$neighborhood_name}' disabled />";
                        echo "<input type='hidden' value='{$neighborhood_name}' name='city'  />";
                      } else { ?>
                        <input type="text" placeholder="City*" name="city" required />
                        <small class="error">A city is required.</small>
                      <?php } ?>
                    </div>
                    <div class="small-12 medium-4 columns">
                      <?php if ($GLOBALS['isChildThemePage']) {
                      echo "<input type='text' value='{$state_value_long}' disabled  />";
                      echo "<input type='hidden' value='{$state_value}' name='state' />";
                      } else { ?>
                        <select  name="state" required>
                          <option selected disabled>State<sup>*</sup></option>
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                          <option value="ME">Maine</option>
                          <option value="MD">Maryland</option>
                          <option value="MA">Massachusetts</option>
                          <option value="MI">Michigan</option>
                          <option value="MN">Minnesota</option>
                          <option value="MS">Mississippi</option>
                          <option value="MO">Missouri</option>
                          <option value="MT">Montana</option>
                          <option value="NE">Nebraska</option>
                          <option value="NV">Nevada</option>
                          <option value="NH">New Hampshire</option>
                          <option value="NJ">New Jersey</option>
                          <option value="NM">New Mexico</option>
                          <option value="NY">New York</option>
                          <option value="NC">North Carolina</option>
                          <option value="ND">North Dakota</option>
                          <option value="OH">Ohio</option>
                          <option value="OK">Oklahoma</option>
                          <option value="OR">Oregon</option>
                          <option value="PA">Pennsylvania</option>
                          <option value="RI">Rhode Island</option>
                          <option value="SC">South Carolina</option>
                          <option value="SD">South Dakota</option>
                          <option value="TN">Tennessee</option>
                          <option value="TX">Texas</option>
                          <option value="UT">Utah</option>
                          <option value="VT">Vermont</option>
                          <option value="VA">Virginia</option>
                          <option value="WA">Washington</option>
                          <option value="WV">West Virginia</option>
                          <option value="WI">Wisconsin</option>
                          <option value="WY">Wyoming</option>
                        </select>
                      <?php } ?>
                    </div>
                    <div class="small-12 medium-4 columns">
                      <input type="text" placeholder="Zip*" name="zip-code" required />
                      <small class="error">A valid zip code is required.</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <textarea rows="7" placeholder="Other details about my home" name="other-details"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <input type="text" placeholder="Email Address*" name="email-address" pattern="email" required />
                      <small class="error">A valid email address is required.</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <input type="text" placeholder="Phone Number*" name="phone-number" required />
                      <small class="error">A phone number is required.</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 medium-6 columns">
                      <input type="text" placeholder="First Name*" name="first-name" required />
                      <small class="error">We need to know who to contact!</small>
                    </div>
                    <div class="small-12 medium-6 columns">
                      <input type="text" placeholder="Last Name" name="last-name" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns select-prefix inline">
                      <span>I am</span>
                      <select name="selling-interest-level" required>
                        <option selected disabled value>Select<sup>*</sup></option>
                        <option value="Interested in selling my home">Interested in selling my home</option>
                        <option value="Just curious">Just curious</option>
                        <option value="Planning to sell now">Planning to sell now</option>
                        <option value="Planning to sell in 1-3 months">Planning to sell in 1-3 months</option>
                        <option value="Planning to sell in 6+ months">Planning to sell in 6+ months</option>
                      </select>
                      <small class="error">More info is required.</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns checkbox-opt">
                      <input type="checkbox" id="newsletter-checkbox" value="newsletter-opt-in" name="newsletter-opt-in" checked>
                      <label class="checkbox-skin" for="newsletter-checkbox"></label>
                      <label class="checkbox-label" for="newsletter-checkbox">Sign me up for the monthly Market Update E-Newsletter</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <span><sup>*</sup>Required</span>
                      <input type="submit" value="Submit" />
                    </div>
                  </div>
                </form>
                <script type="text/javascript">
                  var __ss_noform = __ss_noform || [];
                  __ss_noform.push(['baseURI', 'https://app-3QEHIZGEXU.marketingautomation.services/webforms/receivePostback/MzYwtzQwMDG0BAA/']);
                  __ss_noform.push(['form', 'home-value-form', 'b5322a6c-5d00-4271-bd84-20fccb02c863']);
                  __ss_noform.push(['submitType', 'manual']);
                </script>
                <script type="text/javascript" src="https://koi-3QEHIZGEXU.marketingautomation.services/client/noform.js?ver=1.24" ></script>

              <!-- Shows after form submit hides form -->
              <div id="thank-you-message">
                <h3>Thanks for contacting Alcove!</h3>
                <p>A specialist will get back to you shortly to discuss your submission.</p>
              </div>

            </div> <!-- End form column -->

          </div>
        </div>
      </div>
      <!-- Hero -->


      <!-- Footer -->
      <div id="footer" class="reverse alcove-texture">
        <?php get_template_part( 'partials/footerContent' ); ?>
      </div>
      <!-- Footer -->

    </div>
    <!-- Expanding content frame -->

    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation/foundation.abide.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
    <script>
    $(document).foundation({
      abide : {
        live_validate : false, // validate the form as you go
        validate_on_blur : false, // validate whenever you focus/blur on an input field
        focus_on_invalid : false // automatically bring the focus to an invalid input field
      }
    });
    function formSubmission(event) {
     $('#home-value-form').on('invalid.fndtn.abide', function () {
        var invalid_fields = $(this).find('[data-invalid]');
        // console.log("invalid fields: ");
        // console.log(invalid_fields);
      }).on('valid.fndtn.abide', function () {
        console.log('valid!');
        __ss_noform.push(['submit', null, 'b5322a6c-5d00-4271-bd84-20fccb02c863']);
        $('.form-and-blurb').hide();
        $('#thank-you-message').show();
      });
    }
    </script>

<?php get_footer(); ?>