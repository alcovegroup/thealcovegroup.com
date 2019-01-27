<?php
$listing_url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$backtosearch = (!empty($_SESSION['backtosearch'])) ? $_SESSION['backtosearch'] : '/search-homes/';
$raw_addrFull = $listing->address->full;
$raw_addrFull = str_replace('#', '%23', $raw_addrFull);
$raw_city = $listing->address->city;
$raw_state = $listing->address->state;
$raw_zip = $listing->address->postalCode;
$raw_description = $listing->remarks;
$li_title = $raw_addrFull . ' '  . $raw_state . ' ' . $raw_zip;
$li_title = htmlentities($li_title);
if($_GET['hps'] == '1') {$hide_search = ' style="display:none;"';}
$jumbotron_markup = '';
$jumbotron_thumbs_markup = '';
if(!empty($photos)) {
    $jumbotron_markup .= '<ul class="slickslide">';
    $jumbotron_thumbs_markup .= '<div class="slick-thumbs"><ul>';
    foreach ($photos as $src) {
        $jumbotron_markup .= '<li><img src="'.$src.'" title="img" alt="img" /></li>';
        $jumbotron_thumbs_markup .= '<li style="background-image: url(\''.$src.'\')"></li>';
    }
    $jumbotron_markup .= '</ul>';
    $jumbotron_thumbs_markup .= '</ul></div>';

} else {
    $jumbotron_markup .= '<div class="no-image-gallery"><h3>No images available</h3></div> ';
}
?>
<!-- Subheader row -->
<div id="subheader-row" class="row">
    <div class="small-12 medium-4 columns"<?=$hide_search;?>>
        <a href="<?=$backtosearch;?>" class="btn small">Back to Search</a>
    </div>
    <div class="small-12 medium-8 large-6 columns">
        <div class="subheader-share-2">
            <table class="line-section-table">
                <tr>
                    <td class="table-left-header">
                        <h4>Share this Home</h4>
                        <a href="http://www.facebook.com/sharer.php?u=<?php echo $listing_url; ?>" target="_blank">
                            <span class="social-icon"><span class="icon-icon-facebook"></span></span>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$listing_url;?>&title=<?=$li_title;?>&summary=<?=$lot_description;?>&source=<?=$listing_url;?>" target="_blank">
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
    <?=$jumbotron_markup;?>
    <?=$jumbotron_thumbs_markup;?>
</div>
<!-- Jumbotron -->

<!-- Details content -->
<div id="home-content-row" class="row">
    <div id="home-content-left" class="small-12 large-6 columns">
        <h1><?=$addrFull . ' '  . $state . ' ' . $postal_code;?></h1>
            <div class="listing-price">
                <table class="line-section-table">
                    <tr>
                        <td><h4>List Price</h4></td>
                        <td class="fill-line"></td>
                    </tr>
                </table>
                <h3><?=$price;?></h3>
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
                <h3><?=$bedrooms;?></h3>
            </div>

            <div class="listing-details-tile">
                <h4>Bathrooms</h4>
                <h3><?=$listing_bathsTotal;?></h3>
            </div>

            <div class="listing-details-tile">
                <h4>Sq. Ft. House</h4>
                <h3><?=$areaMarkup;?></h3>
            </div>

            <div class="listing-details-tile">
                <h4>Sq. Ft. Lot</h4>
                <h3><?=$listing_lotSizeArea;?></h3>
            </div>
        </div>

        <div class="listing-description">
            <h4>Description</h4>
            <?=$lot_description;?>
        </div>

        <div class="listing-schools">
            <table class="line-section-table">
                <tr>
                    <td><h4>School Details</h4></td>
                    <td class="fill-line"></td>
                </tr>
            </table>

            <h4>District</h4>
            <h3><?=$school_district;?></h3>

            <h4>Elementary School</h4>
            <h3><?=$school_elementary;?></h3>

                <h4>Middle School</h4>
                <h3><?=$school_middle;?></h3>

                <h4>High School</h4>
                <h3><?=$school_high;?></h3>

        </div>
        <!--ADDITIONAL DETAILS-->
        <?php
        $details_table_markup = '';
        if ( $listing_style || $listing_stories || $listing_interiorFeatures || $listing_exteriorFeatures || $listing_yearBuilt || $listing_heating || $listing_rooms ) {
            $details_table_markup .= '
                <div class="additional-details">
                    <table class="line-section-table">
                        <tr>
                            <td><h4>Additional Property Details</h4></td>
                            <td class="fill-line"></td>
                        </tr>
                    </table>
                    <table class="features-table">';
            ?>
            <?php if ($listing_style):
                $details_table_markup .= '
                      <tr>
                        <td>Property Style</td>
                        <td>' . $listing_style . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing_stories):
                $details_table_markup .= '
                      <tr>
                        <td>Stories</td>
                        <td>' . $listing_stories . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->bathsFull):
                $details_table_markup .= '
                      <tr>
                        <td>Baths Full</td>
                        <td>' . $listing->property->bathsFull . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->bathsHalf):
                $details_table_markup .= '
                      <tr>
                        <td>Baths Half</td>
                        <td>' . $listing->property->bathsHalf . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing_interiorFeatures):
                $details_table_markup .= '
                      <tr>
                        <td>Interior Features</td>
                        <td>' . $listing_interiorFeatures . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing_exteriorFeatures):
                $details_table_markup .= '
                      <tr>
                        <td>Exterior Features</td>
                        <td>' . $listing_exteriorFeatures . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing_yearBuilt):
                $details_table_markup .= '
                      <tr>
                        <td>Year Built</td>
                        <td>' . $listing_yearBuilt . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->fireplaces):
                $details_table_markup .= '
                      <tr>
                        <td>Fireplaces</td>
                        <td>' . $listing->property->fireplaces . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->flooring):
                $details_table_markup .= '
                      <tr>
                        <td>Flooring</td>
                        <td>' . $listing->property->flooring . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->subdivision):
                $details_table_markup .= '
                      <tr>
                        <td>Subdivision</td>
                        <td>' . $listing->property->subdivision . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->roof):
                $details_table_markup .= '
                      <tr>
                        <td>Roof</td>
                        <td>' . $listing->property->roof . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->heating):
                $details_table_markup .= '
                      <tr>
                        <td>Heating</td>
                        <td>' . $listing->property->heating . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->cooling):
                $details_table_markup .= '
                      <tr>
                        <td>Cooling</td>
                        <td>' . $listing->property->cooling . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->lotDescription):
                $details_table_markup .= '
                      <tr>
                        <td>Lot Description</td>
                        <td>' . $listing->property->lotDescription . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->laundryFeatures):
                $details_table_markup .= '
                      <tr>
                        <td>Laundry Features</td>
                        <td>' . $listing->property->laundryFeatures . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing_rooms):
                $details_table_markup .= '
                      <tr>
                        <td>Additional Rooms</td>
                        <td>' . $listing_rooms . '</td>
                      </tr>';
            endif; ?>

            <?php if ($listing->property->pool):
                $details_table_markup .= '
                  <tr>
                    <td>Pool</td>
                    <td>' . $listing->property->pool . '</td>
                  </tr>';
            endif; ?>

            <?php if ($listing->property->subType):
                $details_table_markup .= '
                  <tr>
                    <td>Subtype</td>
                    <td>' . $listing->property->subType . '</td>
                  </tr>';
            endif; ?>

            <?php if ($listing->property->areaSource):
                $details_table_markup .= '
                  <tr>
                    <td>Area Source</td>
                    <td>' . $listing->property->areaSource . '</td>
                  </tr>';
            endif; ?>

            <?php if ($listing->property->water):
                $details_table_markup .= '
                  <tr>
                    <td>Water</td>
                    <td>' . $listing->property->water . '</td>
                  </tr>';
            endif; ?>

            <?php if ($listing->property->construction):
                $details_table_markup .= '
                  <tr>
                    <td>Construction</td>
                    <td>' . $listing->property->construction . '</td>
                  </tr>';
            endif; ?>

            <?php if ($listing->property->garageSpaces):
                $details_table_markup .= '
                  <tr>
                    <td>Garage Spaces</td>
                    <td>' . $listing->property->garageSpaces . '</td>
                  </tr>';
            endif; ?>

            <?php if ($listing->property->acres):
                $details_table_markup .= '
                  <tr>
                    <td>Acres</td>
                    <td>' . $listing->property->acres . '</td>
                  </tr>';
            endif; ?>

            <?php
            $details_table_markup .= '
                    </table>
                  </div>';
        }
        echo $details_table_markup;
        ?>
        <!--/ADDITIONAL DETAILS-->
        <!--PARKING DETAILS-->
        <?php

        $parking_table_markup = '';
        if ( $listing->property->parking->leased || $listing->property->parking->spaces || $listing->property->parking->description) {
            $parking_table_markup .= '
        <div class="additional-details">
            <table class="line-section-table">
                <tr>
                    <td><h4>Parking Details</h4></td>
                    <td class="fill-line"></td>
                </tr>
            </table>
            <table class="features-table">';
            ?>
            <?php if ($listing->property->parking->leased):
                $parking_table_markup .= '
              <tr>
                <td>Leased</td>
                <td>' . $listing->property->parking->leased . '</td>
              </tr>';
            endif; ?>

            <?php if ($listing->property->parking->spaces):
                $parking_table_markup .= '
              <tr>
                <td>Spaces</td>
                <td>' . $listing->property->parking->spaces . '</td>
              </tr>';
            endif; ?>

            <?php if ($listing->property->parking->description):
                $parking_table_markup .= '
              <tr>
                <td>Description</td>
                <td>' . $listing->property->parking->description . '</td>
              </tr>';
            endif; ?>

            <?php
            $parking_table_markup .= '
            </table>
          </div>';
        }
        echo $parking_table_markup;
        ?>
        <!--/PARKING DETAILS-->
    </div>
    <div id="home-content-right" class="small-12 large-6 columns">
        <div id="home-map"></div>
        <!--ADDITIONAL DETAILS 2-->
        <?php
        $additional_details_markup_2 = '<div class="additional-details">';
        /**
        if ( $listing_directions || $listing_county || $listing_market_area ):
            $additional_details_markup_2 .='
		  <table class="line-section-table">
              <tr>
                <td><h4>Geographic Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <table class="features-table">';
            if ( $listing_directions ):
                $additional_details_markup_2 .= '
              <tr>
                <td>Directions</td>
                <td>'.$listing_directions.'</td>
              </tr>';
            endif;
            if ( $listing_county ):
                $additional_details_markup_2 .= '
              <tr>
                <td>County</td>
                <td>'.$listing_county.'</td>
              </tr>';
            endif;
            if ( $listing_market_area ):
                $additional_details_markup_2 .= '
              <tr>
                <td>Market Area</td>
                <td>'.$listing_market_area.'</td>
              </tr>';
            endif;
            $additional_details_markup_2 .= '
            </table>';
        endif;
        $additional_details_markup_2 .= '
            <table class="line-section-table">
              <tr>
                <td><h4>Address Details</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <table class="features-table">';
        if ( $listing_address && $listing_city && $listing_state && $listing_postal_code):
            $additional_details_markup_2 .= '
              <tr>
                <td>Address</td>
                <td>'.$listing_address.'<br />'.$listing_city.', '.$listing_state.' '.$listing_postal_code.'</td>
              </tr>';
        endif;
        if ( $listing_cross_street ):
            $additional_details_markup_2 .= '
              <tr>
                <td>Cross Street</td>
                <td>'.$listing_cross_street.'</td>
              </tr>';
        endif;
        $additional_details_markup_2 .= '</table>';
        **/
            $additional_details_markup_2 .= '
            <table class="line-section-table">
              <tr>
                <td><h4>Listing Information</h4></td>
                <td class="fill-line"></td>
              </tr>
            </table>
            <table class="features-table">';
        ?>

        <?php if ($listing->mlsId):
        $additional_details_markup_2 .= '
		  <tr>
			<td>MLS ID</td>
			<td>' . $listing->mlsId . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->mls->status):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Status</td>
			<td>' . $listing->mls->status . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->mls->daysOnMarket):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Days On Market</td>
			<td>' . $listing->mls->daysOnMarket . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->listDate):
            $additional_details_markup_2 .= '
		  <tr>
			<td>List Date</td>
			<td>' . $listing->listDate . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->agreement):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Agreement</td>
			<td>' . $listing->agreement . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->tax->taxYear):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Tax Year</td>
			<td>' . $listing->tax->taxYear . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->tax->taxAnnualAmount):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Annual Tax Amount</td>
			<td>' . $listing->tax->taxAnnualAmount . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->association->fee):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Association Fee</td>
			<td>' . $listing->association->fee . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->association->name):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Association Name</td>
			<td>' . $listing->association->name . '</td>
		  </tr>';
        endif; ?>

        <?php if ($listing->association->amenities):
            $additional_details_markup_2 .= '
		  <tr>
			<td>Association Amenities</td>
			<td>' . $listing->association->amenities . '</td>
		  </tr>';
        endif; ?>

      <?php
        $additional_details_markup_2 .= '</table>';
        $additional_details_markup_2 .= '</div>';
        ?>
        <!--/ADDITIONAL DETAILS 2-->
        <?=$additional_details_markup_2;?>

        <div id="alcove-contact-box" class="reverse">
            <h4>Contact The Alcove Group</h4>
            <?php if (get_option('global_listing_agent') !== 'Generic' ) {
                $listingAgent = get_page_by_title( get_option('global_listing_agent'), OBJECT, 'bios' );
                $listingAgentID = $listingAgent->ID;
                ?>
                <div class="row">
                    <div class="small-6 medium-4 medium-offset-1 columns">
                        <?php if (has_post_thumbnail( $listingAgentID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $listingAgentID ), 'single-post-thumbnail' ); ?>
                            <div class="alcove-contact-photo" style="background-image: url('<?php echo $image[0]; ?>')"></div>
                        <?php endif; ?>
                    </div>
                    <div class="small-6 medium-7 columns">
                        <h5><?php echo get_post_field( 'post_title', $listingAgentID ); ?></h5>
                        <a class="btn hide-for-medium-up" href="tel:<?php echo preg_replace("/[^0-9,.]/", "", get_option('global_company_phone')); ?>">Call Now</a>
                        <div class="show-for-medium-up">
                            <p>Call Now</p>
                            <a href="tel:<?php echo preg_replace("/[^0-9,.]/", "", get_post_meta( $listingAgentID, 'phone_number', true )); ?>"><?php echo get_post_meta( $listingAgentID, 'phone_number', true ); ?></a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <a class="btn hide-for-medium-up" href="tel:<?php echo preg_replace("/[^0-9,.]/", "", get_option('global_company_phone')); ?>">Call Now</a>
                <div class="show-for-medium-up">
                    <p>Call Now</p>
                    <a href="tel:<?php echo preg_replace("/[^0-9,.]/", "", get_option('global_company_phone')); ?>"><?php echo get_option('global_company_phone'); ?></a>
                </div>
            <?php } ?>
        </div>

        <div class="inquire-form form-button-right">
            <h4>Interested in this home?</h4>
            <form id="inquire-form" action="" method="post" data-abide onsubmit="event.preventDefault(); formSubmission(event);">
                <input type="checkbox" name="Submitted Listing Inquiry" value="Submitted Listing Inquiry" checked style="display: none;" />
                <input type="text" name="MLS-id" value="<?=$listing_mlsid;?>" style="display: none;"/>
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
                    <option selected disabled>Select<sup>*</sup></option>
                    <option value="planning-now">Now</option>
                    <option value="planning-1-3">1-3 months</option>
                    <option value="planning-6-plus">6 months - 1 year</option>
                </select>
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
<script>
    var geocoder, map;
    var homeAddress = "<?=$map_address;?>";

    function initMap() {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'address': homeAddress
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var myOptions = {
                    zoom: 10,
                    center: results[0].geometry.location,
                    scrollwheel: false,
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvOFHf88DsjnHQ0lDbjK7tE-AAgqvNsVc&callback=initMap" async defer></script>
<!-- Details content -->