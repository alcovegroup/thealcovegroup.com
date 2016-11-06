<?php
/**
 * Template Name: Search Homes.0
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>


<?php get_header(); ?>
    <!-- Expanding content frame -->
    <div id="content-frame" style="padding-top: 0!important">

      <!-- Hero -->
      <div id="hero"
      <?php if (has_post_thumbnail( $post->ID ) ): ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
       style="background-image: url('<?php echo $image[0]; ?>');"
      <?php endif; ?>
      >
        <div class="hero-overlay reverse">

          <div class="row hero-form form-button-right">
            <div class="small-12 medium-10 medium-offset-1 large-6 large-offset-3 columns">
              <h3><?php the_title(); ?></h3>
                <?php
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $actual_link = preg_replace('~(.*)\?(.*)$~', '$1', $actual_link);
                $_GET['minprice'] = str_replace('$', '', $_GET['minprice']);
                $_GET['maxprice'] = str_replace('$', '', $_GET['maxprice']);
                $shortcode_buildout = array(
                    ##############################
                    # PRICE
                    ##############################
                    'minprice' => (is_numeric($_GET['minprice'])) ? htmlspecialchars($_GET['minprice']) : '',
                    'maxprice' => (is_numeric($_GET['maxprice'])) ? htmlspecialchars($_GET['maxprice']) : '',
                    ##############################
                    # BEDS
                    ##############################
                    'minbeds' => (is_numeric($_GET['minbeds'])) ? htmlspecialchars($_GET['minbeds']) : '',
                    'maxbeds' => (is_numeric($_GET['maxbeds'])) ? htmlspecialchars($_GET['maxbeds']) : '',
                    ##############################
                    # BATHS
                    ##############################
                    'minbaths' => (is_numeric($_GET['minbaths'])) ? htmlspecialchars($_GET['minbaths']) : '',
                    'maxbaths' => (is_numeric($_GET['maxbaths'])) ? htmlspecialchars($_GET['maxbaths']) : '',
                    ##############################
                    # SQ FT
                    ##############################
                    'area' => (is_numeric($_GET['area'])) ? htmlspecialchars($_GET['area']) : '',
                    ##############################
                    # CITY
                    ##############################
                    'cities' => (ctype_alnum($_GET['city'])) ? htmlspecialchars($_GET['city']) : '',
                    ##############################
                    # STATE (FORCED)
                    ##############################
                    //'state' => (ctype_alnum($_GET['city'])) ? htmlspecialchars($_GET['city']) : '',
                    ##############################
                    # ZIP
                    ##############################
                    'postalcodes' => (is_numeric($_GET['city'])) ? htmlspecialchars($_GET['zip']) : ''
                );
                ?>

              <form method="get" action="<?=$actual_link;?>">
                <div class="row">
                  <div id="form-page-1" class="row">
                    <div class="small-12 columns">
                      <input type="text" placeholder="Street Address" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 medium-4 columns">
                      <input type="text" placeholder="City" name="cities" />
                    </div>
                    <div class="small-12 medium-4 columns">
                      <select>
                        <option selected disabled>State</option>
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
                    </div>
                    <div class="small-12 medium-4 columns">
                      <input type="text" placeholder="Zip" name="zip" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                          <div id="slider-range" class="slider-bar"></div>
                      </div>
                    </div>
                    <div class="small-6 medium-4 medium-pull-4 columns">
                        <input type="text" placeholder="Price Min." id="minprice" name="minprice" <?php if(!empty($shortcode_buildout['minprice'])) { ?>value="$<?=$shortcode_buildout['minprice'];?>"<?php } ?> class="commanator" />
                    </div>
                    <div class="small-6 medium-4 columns">
                      <input type="text" placeholder="Price Max." id="maxprice" name="maxprice" <?php if(!empty($shortcode_buildout['maxprice'])) { ?>value="$<?=$shortcode_buildout['maxprice'];?>"<?php } ?> class="commanator" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                          <div id="slider-range2" class="slider-bar"></div>
                      </div>
                    </div>
                    <div class="small-6 medium-4 medium-pull-4 columns">
                      <input type="text" placeholder="Bed Min." id="minbeds" name="minbeds" value="<?=$shortcode_buildout['minbeds'];?>" />
                    </div>
                    <div class="small-6 medium-4 columns">
                      <input type="text" placeholder="Bed Max." id="maxbeds" name="maxbeds" value="<?=$shortcode_buildout['maxbeds'];?>" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                          <div id="slider-range3" class="slider-bar"></div>
                      </div>
                    </div>
                    <div class="small-6 medium-4 medium-pull-4 columns">
                      <input type="text" placeholder="Bath Min." id="minbaths" name="minbaths" value="<?=$shortcode_buildout['minbaths'];?>" />
                    </div>
                    <div class="small-6 medium-4 columns">
                      <input type="text" placeholder="Bath Max." id="maxbaths" name="maxbaths" value="<?=$shortcode_buildout['maxbaths'];?>" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 columns">
                      <input type="text" placeholder="Min. Sq. Ft." name="area" value="<?=$shortcode_buildout['area'];?>" class="commanator" />
                    </div>
                  </div>


                  <div class="row">
                    <div class="small-12 columns">
                      <button type="submit">Search Homes</button>
                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
      <!-- Hero -->


      <!-- Search Results -->
      <div id="search-results">
        <div class="row search-results-outer-shadow">
          <?php if (have_posts()) : while (have_posts()) : the_post();?>
            <?php the_content();
              //var_dump($shortcode_buildout);
              $the_shortcode = '[sr_listings';
              foreach($shortcode_buildout as $key => $value) {
                  if(!empty($value)) {
                      $the_shortcode .= ' ' . $key . '="' . $value . '"';
                  }
              }
              $the_shortcode .= ']';
              echo do_shortcode($the_shortcode); ?>
          <?php endwhile; endif; wp_reset_query(); ?>
        </div>
      </div>
      <!-- Search Results -->

      <!-- Pagination -->
      <div id="pagination-row">
          <div id="pagination-left" class="pagination-arrow"><span class="icon-icon-arrow-down"></span></div>
          <div class="pagination-count">
            <input type="text" value="1" />
            <span>of </span><span id="total-pages">5</span>
          </div>
          <div id="pagination-right" class="pagination-arrow"><span class="icon-icon-arrow-down"></span></div>
      </div>
      <!-- End Pagination -->

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

<?php wp_footer(); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<style>
    .ui-draggable, .ui-droppable {
        background-position: top;
    }
    .ui-slider .ui-slider-handle {
        width: .80em;
    }
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
        background: url(<?php echo get_template_directory_uri(); ?>/img/temp-icon-slider-grip.png);
    }
    .ui-widget.ui-widget-content {
        border: none;
        border-bottom: 1px solid #fff;
    }
    .ui-widget-header {
        background: none;
    }
    .ui-slider-horizontal .ui-slider-handle {
        top: -.3em;
        margin-left: -.35em;
    }
</style>
<script>
<?php
    $slider_price_min_set = (!empty($shortcode_buildout['minprice'])) ? $shortcode_buildout['minprice'] : 0;
    $slider_price_max_set = (!empty($shortcode_buildout['maxprice'])) ? $shortcode_buildout['maxprice'] : 10000000;

    $slider_beds_min_set = (!empty($shortcode_buildout['minbeds'])) ? $shortcode_buildout['minbeds'] : 0;
    $slider_beds_max_set = (!empty($shortcode_buildout['maxbeds'])) ? $shortcode_buildout['maxbeds'] : 20;

    $slider_baths_min_set = (!empty($shortcode_buildout['minbaths'])) ? $shortcode_buildout['minbaths'] : 0;
    $slider_baths_max_set = (!empty($shortcode_buildout['maxbaths'])) ? $shortcode_buildout['maxbaths'] : 20;
?>
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 10000000,
            values: [ <?=$slider_price_min_set;?>, <?=$slider_price_max_set;?> ],
            slide: function( event, ui ) {
                $( "#minprice" ).val( "" + ui.values[ 0 ] );
                var x = $("#minprice").val();
                $("#minprice").val(addCommas(x));

                $( "#maxprice" ).val( "" + ui.values[ 1 ] );
                var x = $("#maxprice").val();
                $("#maxprice").val(addCommas(x));
            }
        });
        $( "#slider-range2" ).slider({
            range: true,
            min: 0,
            max: 20,
            values: [ <?=$slider_beds_min_set;?>, <?=$slider_beds_max_set;?> ],
            slide: function( event, ui ) {
                $( "#minbeds" ).val( ui.values[ 0 ] );
                $( "#maxbeds" ).val( ui.values[ 1 ] );
            }
        });
        $( "#slider-range3" ).slider({
            range: true,
            min: 0,
            max: 20,
            values: [ <?=$slider_baths_min_set;?>, <?=$slider_baths_max_set;?> ],
            slide: function( event, ui ) {
                $( "#minbaths" ).val( ui.values[ 0 ] );
                $( "#maxbaths" ).val( ui.values[ 1 ] );
            }
        });
    } );

</script>
</body>
</html>