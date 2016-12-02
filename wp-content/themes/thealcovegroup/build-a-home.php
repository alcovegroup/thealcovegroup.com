<?php
/**
 * Template Name: Build A Home
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header(); ?>

    <!-- Expanding content frame -->
    <div id="content-frame">

      <!-- Hero -->
      <div id="hero"
      <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
       style="background-image: url('<?php echo $image[0]; ?>');"
      <?php endif; ?>
      >
        <div class="hero-overlay reverse">

          <div class="row form-page-header form-and-blurb">
            <div class="small-12 small-centered medium-11 large-9 columns">
              <h3><?php the_title(); ?></h3>
              <?php if (have_posts()) : while (have_posts()) : the_post();?>
              <?php the_content(); ?>
              <?php endwhile; endif; wp_reset_query(); ?>
            </div>
          </div>

          <div class="row hero-form form-button-right">
            <div class="small-12 small-centered medium-10 large-6 columns"> <!-- Start form column -->
              <!-- The form itself -->
                <form id="build-a-home-form" class="row form-and-blurb" action="" method="post" data-abide onsubmit="event.preventDefault(); formSubmission(event);">
                  <input type="checkbox" name="Submitted Build A Home Form" value="Submitted Build A Home Form" checked style="display: none;" />
                  <div class="row">
                    <div class="small-12 columns select-prefix">
                      <span>Design Style?</span>
                      <select name="home-style">
                        <option selected disabled value>Select one</option>
                        <option value="ranch">Ranch</option>
                        <option value="contemporary">Contemporary</option>
                        <option value="mid-century-modern">Mid Century Modern</option>
                        <option value="santa-fe">Santa Fe</option>
                        <option value="santa-barbara">Santa Barbara</option>
                        <option value="old-world">Old World</option>
                      </select>
                    </div> 
                  </div>
                  <div class="row">
                    <!-- <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                        <div class="slider-bar"></div>
                        <div class="slider-grip" id="sq-ft-range-min"></div>
                        <div class="slider-grip" id="sq-ft-range-max"></div>
                      </div>
                    </div> -->
                    <div class="small-6 columns">
                      <input type="text" placeholder="Sq. Ft. Min." name="sq-ft-min" />
                    </div>
                    <div class="small-6 columns">
                      <input type="text" placeholder="Sq. Ft. Max." name="sq-ft-max" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-6 columns">
                      <input type="text" placeholder="Beds" name="num-beds" />
                    </div>
                    <div class="small-6 columns">
                      <input type="text" placeholder="Baths" name="num-baths" />
                    </div>
                  </div>
                  <div class="row">
                    <!-- <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                        <div class="slider-bar"></div>
                        <div class="slider-grip" id="lot-range-min"></div>
                        <div class="slider-grip" id="lot-range-max"></div>
                      </div>
                    </div> -->
                    <div class="small-6 columns">
                      <input type="text" placeholder="Lot Size Min." name="lot-min" />
                    </div>
                    <div class="small-6 columns">
                      <input type="text" placeholder="Lot Size Max." name="lot-max" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <input type="text" placeholder="Desired Zip Codes*" name="desired-zip" required />
                      <small class="error">We need to know where you would like to live!</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <select name="price-range" required>
                        <option selected disabled value>Price Range<sup>*</sup></option>
                        <option value="$500,000 - $1,000,000">$500,000 - $1,000,000</option>
                        <option value="$1,000,000 - $3,000,000">$1,000,000 - $3,000,000</option>
                        <option value="$3,000,000 - $10,000,000">$3,000,000 - $10,000,000</option>
                        <option value="$10,000,000+">$10,000,000+</option>
                      </select>
                      <small class="error">We need to know your price range!</small>
                    </div> 
                  </div>
                  <div class="row">
                    <div class="small-12 columns select-prefix">
                      <span>When are you looking to build a home?</span>
                      <select name="building-timeframe" required>
                        <option disabled selected value>Select<sup>*</sup></option>
                        <option value="Right now">Right now</option>
                        <option value="1-2 Months">1-2 Months</option>
                        <option value="3-6 Months">3-6 Months</option>
                        <option value="6+ Months">6+ Months</option>
                      </select>
                      <small class="error">We need to know when you would like to build!</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <textarea rows="7" placeholder="Other details about the home you want to build" name="other-details"></textarea>
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
                    <div class="small-12 columns">
                      <input type="text" placeholder="Phone Number*" name="phone-number" required />
                      <small class="error">A phone number is required.</small>
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
                      <textarea rows="7" placeholder="Optional message" name="optional-message"></textarea>
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
                    __ss_noform.push(['form', 'build-a-home-form', '7abd7997-d750-4a2f-8f0c-0bb56e85dfc4']);
                    __ss_noform.push(['submitType', 'manual']);
                </script>
                <script type="text/javascript" src="https://koi-3QEHIZGEXU.marketingautomation.services/client/noform.js?ver=1.24" ></script>

              <!-- Shows after form submit hides form -->
              <div id="thank-you-message">
                <h3>Thanks for contacting The Alcove Group!</h3>
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
     $('#build-a-home-form').on('invalid.fndtn.abide', function () {
        var invalid_fields = $(this).find('[data-invalid]');
        // console.log("invalid fields: ");
        // console.log(invalid_fields);
      }).on('valid.fndtn.abide', function () {
        console.log('valid!');
        __ss_noform.push(['submit', null, '7abd7997-d750-4a2f-8f0c-0bb56e85dfc4']);
        $('.form-and-blurb').hide();
        $('#thank-you-message').show();
      });
    }
    </script>

<?php get_footer(); ?>