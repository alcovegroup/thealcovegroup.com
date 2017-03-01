<?php

/******************************************************************
 * setup the admin
 ******************************************************************/

function alcove_theme_styles() {
	wp_enqueue_style( 'fullpage_js', get_template_directory_uri() . '/bower_components/fullpage.js/jquery.fullPage.css' );
	wp_enqueue_style( 'app_css', get_template_directory_uri() . '/stylesheets/app.css' );
	wp_enqueue_style( 'base_styles', get_template_directory_uri() . '/stylesheets/base-styles.css' );
	wp_enqueue_style( 'modules', get_template_directory_uri() . '/stylesheets/modules.css' );
	wp_enqueue_style( 'no_touch', get_template_directory_uri() . '/stylesheets/no-touch.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/bower_components/slick-carousel/slick/slick.css' );
}

add_action( 'wp_enqueue_scripts', 'alcove_theme_styles' );

function alcove_theme_js() {
	wp_register_script( 'modernizr', get_template_directory_uri() .'/bower_components/modernizr/modernizr.js');
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'fullpage_js', get_template_directory_uri() .'/bower_components/fullpage.js/jquery.fullPage.js');
	wp_enqueue_script( 'fullpage_js' );
}

add_action( 'wp_enqueue_scripts', 'alcove_theme_js' );

register_nav_menus( array(
	'header'   => __( 'Header menu', 'thealcovegroup' ),
	'footer' => __( 'Footer menu', 'thealcovegroup' ),
) );


function comicpress_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
		SELECT
		YEAR(min(post_date_gmt)) AS firstdate,
		YEAR(max(post_date_gmt)) AS lastdate
		FROM
		$wpdb->posts
		WHERE
		post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
		$copyright = "Copyright© The Alcove Group ";
		$copyright .= $copyright_dates[0]->firstdate;
		if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
			$copyright .= '-' . $copyright_dates[0]->lastdate;
		}
			$output = $copyright;
		}
		return $output;
}

add_theme_support( 'post-thumbnails' );

//Custom Theme Settings
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_menu_page('Global Fields', 'Global Fields', 'moderate_comments', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
	?>
	<style>
	.wrap input[type="text"] {
		width: 400px;
		height: 44px;
	}
	.wrap input[type="submit"] {
		padding: 2rem;
	}
	</style>
	<div class='wrap'>
	<h2>Global Fields</h2>
	<p>Edit the values in the header &amp; footer of the site globally (not specific to a single page). <br>If left blank, these will not show up in header or footer.</p>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Company Email</strong><br />
	<input type="text" name="global_company_email" value="<?php echo get_option('global_company_email'); ?>" /></p>
	
	<p><strong>Company Phone</strong><br />
	<input type="text" name="global_company_phone" value="<?php echo get_option('global_company_phone'); ?>" /></p>

	<p><strong>Company Facebook Page</strong><br />
	<input type="text" name="global_company_facebook" value="<?php echo get_option('global_company_facebook'); ?>" /></p>

	<p><strong>Company LinkedIn Page</strong><br />
	<input type="text" name="global_company_linkedin" value="<?php echo get_option('global_company_linkedin'); ?>" /></p>

	<p><strong>Footer Subscribe Message</strong><br />
	<input type="text" name="global_footer_message" value="<?php echo get_option('global_footer_message'); ?>" /></p>

	<p><strong>Alcove Listing Agent</strong><br />
	<small>This is the contact info which shows up on a listing details page</small><br />
	<select name="global_listing_agent">
	<?php
		foreach ( get_post_types( '', 'names' ) as $post_type ) {
		   echo '<option>' . $post_type . '</option>';
		}
	?>
	</select>
	</p>

	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="global_company_email,global_company_phone,global_company_facebook,global_company_linkedin,global_footer_message,global_listing_agent" />

	</form>
	</div>
	<?php
}


?>