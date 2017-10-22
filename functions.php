<?php
function my_theme_enqueue_styles() {

	$parent_style = 'parent-style'; // This is 'openstrap-style' for the Openstrap theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function openstrap_child_theme_setup() {
    load_child_theme_textdomain( 'openstrap', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'openstrap_child_theme_setup' );
?>