<?php
function my_theme_enqueue_styles() {

	$parent_style = 'parent-style'; // This is 'openstrap-style' for the Openstrap theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
	
	wp_enqueue_style(
    	'custom-jqueryui-style',
    	get_stylesheet_directory_uri() . '/css/jquery-ui.min.css',
	array(),
	'1.0',
	'all'
    );

	wp_enqueue_style(
    	'tour-style',
    	get_stylesheet_directory_uri() . '/css/tour.css',
	array(),
	'1.0',
	'all'
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function openstrap_child_theme_setup() {
    load_child_theme_textdomain( 'openstrap', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'openstrap_child_theme_setup' );

function theme_js() {
    //load Google Maps API library
	wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDpGoWzDDmQ-a6geOEVZ32VQXWZ2jmLoSs', array(), null, null);
	
	//If necessary - forece required jQuery version
    //wp_deregister_script('jquery');
    //wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), null, null);

    //load LOCAL COPY of jQuiry-UI
	wp_enqueue_script('custom-jqueryui', get_stylesheet_directory_uri() . '/js/jquery-ui.min.js', array(), null, null);
	
	//load custom interface
    wp_enqueue_script( 'tour_js', get_stylesheet_directory_uri() . '/js/tour.js', array( 'jquery','custom-jqueryui','google-maps' ), '1.0', null );
	//provide link to resources (img/css) that being used in JS
    $translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
    wp_localize_script( 'tour_js', 'theme_path', $translation_array );
}
add_action('wp_enqueue_scripts', 'theme_js');
?>