<?php
$addrFull = $mls_data->address->full;
$city = $mls_data->address->city;
$state = $mls_data->address->state;
$zip = $mls_data->address->postalCode;
$description = $mls_data->remarks;
?>
<meta property="og:title" content="<?=$addrFull . ', ' . $city . ', ' . $state . ' ' . $zip ;?>" />
<meta property="og:url" content="<?=$listing_url;?>" />
<?php
$images = $mls_data->photos;
if( $images ) { ?>
    <meta property="og:image" content="<?php echo $images[0]; ?>"/>
    <?php
} else {
?>
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/Alcove-FeaturedImageDefault-thumb.jpg" />
<?php
}
?>
<meta property="og:description" content="<?=$description;?>" />
<meta property="og:site_name" content="The Alcove Group" />