<div class="featured-home section">
    <div class="featured-home-image">
        <ul class="slickslide">
            <?php
            if( is_array($listingPhotos) && count(listingPhotos) > 0){ ?>

                <?php
                $i=1;
                $limit=4;
                ?>

                <?php foreach( $listingPhotos as $image ): ?>

                    <li style="background-image: url('<?php echo $image ?>');"></li>

                    <?php $i=$i+1; if ($i>$limit) break; ?>

                <?php endforeach; ?>

            <?php } ?>
        </ul>
    </div>
    <div class="featured-overlay"></div>
    <div class="row full-width featured-home-details">
        <div class="small-12 columns v-center">
            <div class="featured-home-details-inner">
                <div class="left-group">

                        <h4><?=$address ;?></h4>

                        <h4><?=$city;?>, <?=$state;?>, <?=$zip;?></h4>

                        <h3><?=$listing_USD;?></h3>

                </div>
                <div class="right-group">
                    <a href="<?=$link.'?hps=1';?>" class="btn">View Home</a>
                </div>
            </div>
        </div>
    </div>
</div>