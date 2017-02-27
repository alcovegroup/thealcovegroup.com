<!-- Results Item -->
<div class="search-result-item">
    <div class="small-12 medium-6 large-4 columns results-featured-image" style="background-image:url('<?=$main_photo;?>');">
        <?=$photo_count_markup;?>
    </div>
    <div class="small-12 medium-6 large-8 columns results-listing">
        <a href="<?=$link;?>">
            <h2><?=$addrFull;?></h2>
        </a>
        <div class="list-price clearfix">
            <h3>List Price</h3>
            <h2 style="margin-bottom: 8px;"><?=$listing_USD;?></h2>
            <h3><?=$yearMarkup;?></h3>
            <h3><?=$mlsidMarkup;?></h3>
        </div>
        <div class="results-details">
            <div class="details-tile clearfix">
                <h5>Bed</h5>
                <h4><?=$bedsMarkup;?></h4>
            </div>
            <div class="details-tile clearfix">
                <h5>Bath</h5>
                <h4><?=$listing_bathsTotal;?></h4>
            </div>
            <div class="details-tile clearfix">
                <h5>Sq. Ft. House</h5>
                <h4><?=$area;?></h4>
            </div>
            <div class="details-tile clearfix">
                <h5>Sq. Ft. Lot</h5>
                <h4><?=$listing_lotSizeArea;?></h4>
            </div>
        </div>
        <a href="<?=$link;?>" class="btn small">View Home</a>
    </div>
</div>
<!-- Results Item -->