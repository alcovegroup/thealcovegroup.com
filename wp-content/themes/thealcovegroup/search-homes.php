<?php
/**
 * Template Name: Search Homes
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
              <span>xxx</span>
              <?php if (have_posts()) : while (have_posts()) : the_post();?>
              <?php the_content(); ?>
              <?php endwhile; endif; wp_reset_query(); ?>
            </div>
          </div>

          <div class="row hero-form form-button-right">
            <div class="small-12 small-centered medium-10 large-6 columns"> <!-- Start form column -->
              <!-- The form itself -->
              <form>
                <div class="row">
                  <div id="form-page-1" class="row">
                    <div class="small-12 columns">
                      <input type="text" placeholder="Street Address" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 medium-4 columns">
                      <input type="text" placeholder="City" />
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
                      <input type="text" placeholder="Zip" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                        <div class="slider-bar"></div>
                        <div class="slider-grip" id="price-range-min"></div>
                        <div class="slider-grip" id="price-range-max"></div>
                      </div>
                    </div>
                    <div class="small-6 medium-4 medium-pull-4 columns">
                      <input type="text" placeholder="Price Min." />
                    </div>
                    <div class="small-6 medium-4 columns">
                      <input type="text" placeholder="Price Max." />
                    </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                        <div class="slider-bar"></div>
                        <div class="slider-grip" id="price-range-min"></div>
                        <div class="slider-grip" id="price-range-max"></div>
                      </div>
                    </div>
                    <div class="small-6 medium-4 medium-pull-4 columns">
                      <input type="text" placeholder="Bed Min." />
                    </div>
                    <div class="small-6 medium-4 columns">
                      <input type="text" placeholder="Bed Max." />
                    </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 medium-push-4 columns">
                      <div class="slider-holder">
                        <div class="slider-bar"></div>
                        <div class="slider-grip" id="price-range-min"></div>
                        <div class="slider-grip" id="price-range-max"></div>
                      </div>
                    </div>
                    <div class="small-6 medium-4 medium-pull-4 columns">
                      <input type="text" placeholder="Bath Min." />
                    </div>
                    <div class="small-6 medium-4 columns">
                      <input type="text" placeholder="Bath Max." />
                    </div>
                  </div>

                  <div class="row">
                    <div class="small-12 medium-4 columns">
                      <input type="text" placeholder="Min. Sq. Ft." />
                    </div>
                  </div>


                  <div class="row">
                    <div class="small-12 columns">
                      <button>Search Homes</button>
                    </div>
                  </div>

                </div>
              </form>

            </div> <!-- End form column -->

          </div>
        </div>
      </div>
      <!-- Hero -->


      <!-- Search Results -->
      <div id="search-results">
        <div class="row search-results-outer-shadow">

          <!-- Results Item -->
          <div class="search-result-item">
            <div class="small-12 medium-6 large-4 columns results-featured-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');">
              <h3>+5 Photos</h3>
            </div>
            <div class="small-12 medium-6 large-8 columns results-listing">
              <h2>6336 E Via Estrella Ave </h2>
              <h2>Paradise Valley, AZ 85253</h2>
              <div class="list-price clearfix">
                <h3>List Price</h3>
                <h2>$1,774,950</h2>
              </div>
              <div class="results-details">
                <div class="details-tile clearfix">
                  <h5>Bed</h5>
                  <h4>4</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Bath</h5>
                  <h4>2.5</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. House</h5>
                  <h4>2,125</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. Lot</h5>
                  <h4>12,244</h4>
                </div>
              </div>
              <a class="btn small" href="#">View Home</a>
            </div>
          </div>
          <!-- Results Item -->

          <!-- Results Item -->
          <div class="search-result-item">
            <div class="small-12 medium-6 large-4 columns results-featured-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');">
              <h3>+5 Photos</h3>
            </div>
            <div class="small-12 medium-6 large-8 columns results-listing">
              <h2>6336 E Via Estrella Ave </h2>
              <h2>Paradise Valley, AZ 85253</h2>
              <div class="list-price clearfix">
                <h3>List Price</h3>
                <h2>$1,774,950</h2>
              </div>
              <div class="results-details">
                <div class="details-tile clearfix">
                  <h5>Bed</h5>
                  <h4>4</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Bath</h5>
                  <h4>2.5</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. House</h5>
                  <h4>2,125</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. Lot</h5>
                  <h4>12,244</h4>
                </div>
              </div>
              <a class="btn small" href="#">View Home</a>
            </div>
          </div>
          <!-- Results Item -->

          <!-- Results Item -->
          <div class="search-result-item">
            <div class="small-12 medium-6 large-4 columns results-featured-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');">
              <h3>+5 Photos</h3>
            </div>
            <div class="small-12 medium-6 large-8 columns results-listing">
              <h2>6336 E Via Estrella Ave </h2>
              <h2>Paradise Valley, AZ 85253</h2>
              <div class="list-price clearfix">
                <h3>List Price</h3>
                <h2>$1,774,950</h2>
              </div>
              <div class="results-details">
                <div class="details-tile clearfix">
                  <h5>Bed</h5>
                  <h4>4</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Bath</h5>
                  <h4>2.5</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. House</h5>
                  <h4>2,125</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. Lot</h5>
                  <h4>12,244</h4>
                </div>
              </div>
              <a class="btn small" href="#">View Home</a>
            </div>
          </div>
          <!-- Results Item -->

          <!-- Results Item -->
          <div class="search-result-item">
            <div class="small-12 medium-6 large-4 columns results-featured-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');">
              <h3>+5 Photos</h3>
            </div>
            <div class="small-12 medium-6 large-8 columns results-listing">
              <h2>6336 E Via Estrella Ave </h2>
              <h2>Paradise Valley, AZ 85253</h2>
              <div class="list-price clearfix">
                <h3>List Price</h3>
                <h2>$1,774,950</h2>
              </div>
              <div class="results-details">
                <div class="details-tile clearfix">
                  <h5>Bed</h5>
                  <h4>4</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Bath</h5>
                  <h4>2.5</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. House</h5>
                  <h4>2,125</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. Lot</h5>
                  <h4>12,244</h4>
                </div>
              </div>
              <a class="btn small" href="#">View Home</a>
            </div>
          </div>
          <!-- Results Item -->

          <!-- Results Item -->
          <div class="search-result-item">
            <div class="small-12 medium-6 large-4 columns results-featured-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-01.jpg');">
              <h3>+5 Photos</h3>
            </div>
            <div class="small-12 medium-6 large-8 columns results-listing">
              <h2>6336 E Via Estrella Ave </h2>
              <h2>Paradise Valley, AZ 85253</h2>
              <div class="list-price clearfix">
                <h3>List Price</h3>
                <h2>$1,774,950</h2>
              </div>
              <div class="results-details">
                <div class="details-tile clearfix">
                  <h5>Bed</h5>
                  <h4>4</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Bath</h5>
                  <h4>2.5</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. House</h5>
                  <h4>2,125</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. Lot</h5>
                  <h4>12,244</h4>
                </div>
              </div>
              <a class="btn small" href="#">View Home</a>
            </div>
          </div>
          <!-- Results Item -->

          <!-- Results Item -->
          <div class="search-result-item">
            <div class="small-12 medium-6 large-4 columns results-featured-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/temp-featured-home-02.jpg');">
              <h3>+5 Photos</h3>
            </div>
            <div class="small-12 medium-6 large-8 columns results-listing">
              <h2>6336 E Via Estrella Ave </h2>
              <h2>Paradise Valley, AZ 85253</h2>
              <div class="list-price clearfix">
                <h3>List Price</h3>
                <h2>$1,774,950</h2>
              </div>
              <div class="results-details">
                <div class="details-tile clearfix">
                  <h5>Bed</h5>
                  <h4>4</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Bath</h5>
                  <h4>2.5</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. House</h5>
                  <h4>2,125</h4>
                </div>
                <div class="details-tile clearfix">
                  <h5>Sq. Ft. Lot</h5>
                  <h4>12,244</h4>
                </div>
              </div>
              <a class="btn small" href="#">View Home</a>
            </div>
          </div>
          <!-- Results Item -->

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


      <div id="darken-overlay"></div>

    </div>
    <!-- Expanding content frame -->

    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/bower_components/foundation/js/foundation.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>

<?php get_footer(); ?>