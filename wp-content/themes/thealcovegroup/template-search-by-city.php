<?php
/**
 * Template Name: Search by City
 *
 * @package WordPress
 * @subpackage thealcovegroup
 */
?>
<?php
session_start();
get_header();
$backtosearch = htmlspecialchars($_SERVER[REQUEST_URI]);
$_SESSION['backtosearch'] = $backtosearch;
$GLOBALS['perpage'] = 50;
$perpage = $GLOBALS['perpage'];
?>
<style>
    .debug {background-color: #000; color: #fff; font-family: Arial;}
</style>
    <!-- Expanding content frame -->
    <div id="content-frame" style="padding-top: 0!important">

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
              <button class="small" id="search-ui-toggle">Filter Search<span class="icon-icon-arrow-down"></span></button>
            </div>
          </div>

          <div class="row hero-form form-button-right" style="display: none;">
            <div class="small-12 medium-10 medium-offset-1 large-6 large-offset-3 columns">
                <?php
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $actual_link = preg_replace('~(.*)\?(.*)$~', '$1', $actual_link);
                $_GET['minprice'] = str_replace('$', '', $_GET['minprice']);
                $_GET['minprice'] = str_replace(',', '', $_GET['minprice']);
                $_GET['maxprice'] = str_replace('$', '', $_GET['maxprice']);
                $_GET['maxprice'] = str_replace(',', '', $_GET['maxprice']);
                $numeric_area = str_replace('%2C', '', $_GET['minarea']);
                $numeric_area = str_replace(',', '', $_GET['minarea']);
                $filtered_city = preg_replace("/[^A-Za-z0-9 ]/", '', $_GET['cities']);
                $filtered_q = preg_replace("/[^A-Za-z0-9 ]/", '', $_GET['q']);
                $thepagenumber = (is_numeric($_GET['pageNumber'])) ? (htmlspecialchars($_GET['pageNumber'])) : '';
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
                    'minarea' => (is_numeric($numeric_area)) ? htmlspecialchars($numeric_area) : '',
                    ##############################
                    # CITY
                    ##############################
                    //'cities' => ( !empty($filtered_city)) ? $filtered_city : '',
                    'cities' => 'Paradise Valley',
                    ##############################
                    # STATE (FORCED)
                    ##############################
                    //'state' => (ctype_alnum($_GET['state'])) ? htmlspecialchars($_GET['state']) : '',
                    'state' => 'AZ',
                    ##############################
                    # ZIP
                    ##############################
                    'postalcodes' => (is_numeric($_GET['zip'])) ? htmlspecialchars($_GET['zip']) : '',
                    ##############################
                    # Street Address
                    ##############################
                    'q' => ( !empty($filtered_q)) ? str_replace(' ', '+', $filtered_q) : '',
                    ##############################
                    # TYPE
                    ##############################
                    'type' => 'RES',
                    ##############################
                    # OFFSET
                    ##############################
                    'offset' => (!empty($thepagenumber)) ? (($thepagenumber-1)*$perpage) : '',
                    'sort' => '-listprice'
                );
                //var_dump($shortcode_buildout);
                ?>
              <form method="get" action="<?=$actual_link;?>">
                <div class="row">
                    <div class="row">
                        <div class="small-12 medium-6 columns">
                            <input type="text" value="Paradise Valley" disabled>
                            <input type="hidden" name="cities" value="Paradise Valley">
                        </div>
                        <div class="small-12 medium-6 columns">
                            <input type="text" id="state" value="Arizona" disabled>
                            <input type="hidden" name="state" id="state" value="AZ">
                        </div>
                    </div>

                  <div id="form-page-1" class="row">
                    <div class="small-12 medium-6 columns">
                      <input type="text" name="q" placeholder="Street Address" <?php if(!empty($shortcode_buildout['q'])) { ?>value="<?=str_replace('+', ' ', $shortcode_buildout['q']);?>"<?php } ?> />
                    </div>
                      <div class="small-12 medium-6 columns">
                          <input type="text" placeholder="Zip" name="zip" id="postalcodes" <?php if(!empty($shortcode_buildout['postalcodes'])) { ?>value="<?=$shortcode_buildout['postalcodes'];?>"<?php } ?> />
                      </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                          <div id="price_slider"></div>
                      </div>
                    </div>
                    <div class="small-6 medium-4 medium-pull-4 columns">
                        <input type="text" placeholder="Price Min." id="minprice" name="minprice" <?php if(!empty($shortcode_buildout['minprice'])) { ?>value="$<?=$shortcode_buildout['minprice'];?>"<?php } ?> class="js_money" />
                    </div>
                    <div class="small-6 medium-4 columns">
                      <input type="text" placeholder="Price Max." id="maxprice" name="maxprice" <?php if(!empty($shortcode_buildout['maxprice'])) { ?>value="$<?=$shortcode_buildout['maxprice'];?>"<?php } ?> class="js_money" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                          <div id="bed_slider"></div>
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
                          <div id="bath_slider"></div>
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
                      <input type="text" placeholder="Min. Sq. Ft." name="minarea" value="<?=$shortcode_buildout['minarea'];?>" class="commanator" />
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
          <?php
          ####################################################
          # Forcing the state if it's not Arizona
          # This will cause a crash in the shortcode without
          # disrupting the search form.
          ####################################################
          if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] != 'AZ') {$shortcode_buildout['postalcodes'] = '94086';}
          //
          if (have_posts()) : while (have_posts()) : the_post();?>
            <?php the_content();
              $the_shortcode = '[sr_listings';
              foreach($shortcode_buildout as $key => $value) {
                  if(!empty($value)) {
                      $the_shortcode .= ' ' . $key . '="' . $value . '"';
                  }
              }
              $the_shortcode .= ' limit="' . $perpage .'"';
              $the_shortcode .= ']';
                  //echo '<h1 class="debug">'.$the_shortcode.'</h1>';
                  echo do_shortcode($the_shortcode);
          endwhile; endif; wp_reset_query(); ?>
        </div>
      </div>
      <!-- Search Results -->

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
    <script src="<?php echo get_template_directory_uri(); ?>/js/search.js"></script>

<?php wp_footer(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/nouislider/nouislider.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/nouislider/nouislider.min.js"></script>
<style>
    .noUi-horizontal .noUi-handle {
        width: .80em;
        background: url(<?php echo get_template_directory_uri(); ?>/img/temp-icon-slider-grip.png);
        background-position: top;
        left: -6px;
    }
    .noUi-target {
        border: 0;
        box-shadow: none;
        height: 8px;
        background-color: rgba(226, 226, 226, 0.1);
        border-bottom: 1px solid #FFFFFF;
    }

    .noUi-handle:before, .noUi-handle:after {
        display: none;
    }

    .noUi-connect {
        background: none;
        box-shadow: none;
    }


    .ui-draggable, .ui-droppable {
        background-position: top;
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
    #slider-range {
        z-index: 999;
        display: block;
    }
</style>
<script>
<?php
    //$slider_price_min_set = (!empty($shortcode_buildout['minprice'])) ? $shortcode_buildout['minprice'] : 0;
    //$slider_price_max_set = (!empty($shortcode_buildout['maxprice'])) ? $shortcode_buildout['maxprice'] : 10000000;

    //$slider_beds_min_set = (!empty($shortcode_buildout['minbeds'])) ? $shortcode_buildout['minbeds'] : 0;
    //$slider_beds_max_set = (!empty($shortcode_buildout['maxbeds'])) ? $shortcode_buildout['maxbeds'] : 20;

    //$slider_baths_min_set = (!empty($shortcode_buildout['minbaths'])) ? $shortcode_buildout['minbaths'] : 0;
    //$slider_baths_max_set = (!empty($shortcode_buildout['maxbaths'])) ? $shortcode_buildout['maxbaths'] : 20;

    if(!empty($shortcode_buildout['minprice'])) {$slider_price_min_set = $shortcode_buildout['minprice']; echo "var j_price_min = ".$shortcode_buildout['minprice'].";";} else {$slider_price_min_set = 0; echo "var j_price_min = '';";}
    if(!empty($shortcode_buildout['maxprice'])) {$slider_price_max_set = $shortcode_buildout['maxprice']; echo "var j_price_max = ".$shortcode_buildout['maxprice'].";";} else {$slider_price_max_set = 10000000; echo "var j_price_max = '';";}

    if(!empty($shortcode_buildout['minbeds'])) {$slider_beds_min_set = $shortcode_buildout['minbeds']; echo "var j_beds_min = ".$shortcode_buildout['minbeds'].";";} else {$slider_beds_min_set = 0; echo "var j_beds_min = '';";}
    if(!empty($shortcode_buildout['maxbeds'])) {$slider_beds_max_set = $shortcode_buildout['maxbeds']; echo "var j_beds_max = ".$shortcode_buildout['maxbeds'].";";} else {$slider_beds_max_set = 20; echo "var j_beds_max = '';";}

    if(!empty($shortcode_buildout['minbaths'])) {$slider_baths_min_set = $shortcode_buildout['minbaths']; echo "var j_baths_min = ".$shortcode_buildout['minbaths'].";";} else {$slider_baths_min_set = 0; echo "var j_baths_min = '';";}
    if(!empty($shortcode_buildout['maxbaths'])) {$slider_baths_max_set = $shortcode_buildout['maxbaths']; echo "var j_baths_max = ".$shortcode_buildout['maxbaths'].";";} else {$slider_baths_max_set = 20; echo "var j_baths_max = '';";}
?>
var priceSlider = document.getElementById('price_slider');
var bedSlider = document.getElementById('bed_slider');
var bathSlider = document.getElementById('bath_slider');

noUiSlider.create(priceSlider, {
    connect: true,
    behaviour: 'tap',
    start: [ <?=$slider_price_min_set;?>, <?=$slider_price_max_set;?> ],
    range: {
        // Starting at 500, step the value by 500,
        // until 4000 is reached. From there, step by 1000.
        'min': [ 0 ],
        //'10%': [ 500, 500 ],
        //'50%': [ 4000, 1000 ],
        'max': [ 10000000 ]
    }
});

noUiSlider.create(bedSlider, {
    connect: true,
    behaviour: 'tap',
    start: [ <?=$slider_beds_min_set;?>, <?=$slider_beds_max_set;?> ],
    range: {
        // Starting at 500, step the value by 500,
        // until 4000 is reached. From there, step by 1000.
        'min': [ 0 ],
        'max': [ 20 ]
    }
});

noUiSlider.create(bathSlider, {
    connect: true,
    behaviour: 'tap',
    start: [ <?=$slider_baths_min_set;?>, <?=$slider_baths_max_set;?> ],
    range: {
        // Starting at 500, step the value by 500,
        // until 4000 is reached. From there, step by 1000.
        'min': [ 0 ],
        'max': [ 20 ]
    }
});
</script>
<script>
    var pricenodes = [
        document.getElementById('minprice'), // 0
        document.getElementById('maxprice')  // 1
    ];

    var bednodes = [
        document.getElementById('minbeds'), // 0
        document.getElementById('maxbeds')  // 1
    ];

    var bathnodes = [
        document.getElementById('minbaths'), // 0
        document.getElementById('maxbaths')  // 1
    ];

    // Display the slider value and how far the handle moved
    // from the left edge of the slider.
    priceSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
        pricenodes[handle].value = Math.round(values[handle]);
        var x = $("#minprice").val();
        $("#minprice").val(addMoneySign(x));
        var y = $("#maxprice").val();
        $("#maxprice").val(addMoneySign(y));
    });
    bedSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
        bednodes[handle].value = Math.round(values[handle]);
    });
    bathSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
        bathnodes[handle].value = Math.round(values[handle]);
    });
</script>
<script>
      // $('.hero-form').slideUp('fast');
      $('#search-ui-toggle').click(function(){
        $(this).toggleClass('flip');
        $('.hero-form').slideToggle('fast');
      });
    </script>

</body>
</html>