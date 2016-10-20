<!--SIMPLY RETS CODE-->
<hr />
<hr />
<hr />
<hr />
<div class="sr-details" style="text-align:left;">
    <p class="sr-details-links" style="clear:both;">
        $mapLink
        $more_photos
        <span id="sr-listing-contact">
                <a href="#sr-contact-form">$contact_text</a>
              </span>
    </p>
    $gallery_markup
    <script>
        if(document.getElementById('sr-fancy-gallery')) {
            Galleria.loadTheme('$galleria_theme');
            Galleria.configure({
                height: 500,
                width:  "90%",
                showinfo: false,
                dummy: "$dummy",
                lightbox: true,
                imageCrop: false,
                imageMargin: 0,
                fullscreenDoubleTap: true
            });
            Galleria.run('.sr-gallery');
        }
    </script>
    <div class="sr-primary-details">
        <div class="sr-detail" id="sr-primary-details-beds">
            <h3>$listing_bedrooms <small>Beds</small></h3>
        </div>
        <div class="sr-detail" id="sr-primary-details-baths">
            <h3>$primary_baths<small> Baths</small></h3>
        </div>
        <div class="sr-detail" id="sr-primary-details-size">
            <h3>$area <small class="sr-listing-area-sqft">SqFt</small></h3>
        </div>
        <div class="sr-detail" id="sr-primary-details-status">
            <h3>$listing_mls_status</h3>
        </div>
    </div>
    $remarks_markup
    <table style="width:100%;">
        <thead>
        <tr>
            <th colspan="3"><h5>Property Details</h5></th></tr></thead>
        <tbody>
        $price
        $bedrooms
        $bathsFull
        $bathsHalf
        $bathsTotal
        $style
        $lotsize_markup

        $lotsizearea_markup
        $lotsizeareaunits_markup
        $acres_markup

        $stories
        $interiorFeatures
        $exteriorFeatures
        $yearBuilt
        $fireplaces
        $subdivision
        $view
        $roof
        $water
        $heating
        $foundation
        $accessibility
        $lot_description
        $laundry_features
        $additional_rooms
        $roomsMarkup
        </tbody>
        $geo_table_header
        $geo_directions
        $geo_county
        $geo_latitude
        $geo_longitude
        $geo_market_area
        </tbody>
        <thead>
        <tr>
            <th colspan="3"><h5>Address Information</h5></th></tr></thead>
        <tbody>
        $address
        $unit
        $postal_code
        $city
        $cross_street
        $state
        $country
        </tbody>
        <thead>
        <tr>
            <th colspan="3"><h5>Listing Information</h5></th></tr></thead>
        <tbody>
        $office
        $officePhone
        $officeEmail
        $agent
        $terms
        </tbody>
        $school_data
        <thead>
        <tr>
            <th colspan="3"><h5>Mls Information</h5></th></tr></thead>
        <tbody>
        $days_on_market
        $mls_status
        $list_date
        $date_modified_markup
        $tax_data
        $mls_area
        $mlsid
        $disclaimer
        </tbody>
    </table>
    $mapMarkup
    <script>$lh_analytics</script>
</div>