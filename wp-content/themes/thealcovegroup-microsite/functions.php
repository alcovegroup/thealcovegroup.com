<?php

/******************************************************************
 * Child theme functions
 ******************************************************************/

function my_theme_enqueue_styles() {

    $parent_style = 'thealcovegroup';

    wp_dequeue_style( 'fullpage_js', get_template_directory_uri() . '/bower_components/fullpage.js/jquery.fullPage.css' );
	wp_dequeue_style( 'app_css', get_template_directory_uri() . '/stylesheets/app.css' );
	wp_dequeue_style( 'base_styles', get_template_directory_uri() . '/stylesheets/base-styles.css' );
	wp_dequeue_style( 'modules', get_template_directory_uri() . '/stylesheets/modules.css' );
	wp_dequeue_style( 'no_touch', get_template_directory_uri() . '/stylesheets/no-touch.css' );
	wp_dequeue_style( 'slick', get_template_directory_uri() . '/bower_components/slick-carousel/slick/slick.css' );

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'fullpage_js', get_template_directory_uri() . '/bower_components/fullpage.js/jquery.fullPage.css' );
	wp_enqueue_style( 'app_css', get_template_directory_uri() . '/stylesheets/app.css' );
	wp_enqueue_style( 'base_styles', get_template_directory_uri() . '/stylesheets/base-styles.css' );
	wp_enqueue_style( 'modules', get_template_directory_uri() . '/stylesheets/modules.css' );
	wp_enqueue_style( 'no_touch', get_template_directory_uri() . '/stylesheets/no-touch.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/bower_components/slick-carousel/slick/slick.css' );

	wp_enqueue_style( 'microsite_css', get_stylesheet_directory_uri() . '/stylesheets/microsite.css', array($parent_style) );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles');
?>