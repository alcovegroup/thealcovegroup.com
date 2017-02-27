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
        <?=$details_table_markup;?>
    </div>
    <div id="home-content-right" class="small-12 large-6 columns">
        <div id="home-map"></div>
        <?=$additional_details_markup_2;?>
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