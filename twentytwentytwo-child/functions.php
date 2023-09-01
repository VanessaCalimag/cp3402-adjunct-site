<?php
/* enqueue scripts and style from parent theme */
function twentytwenttwo_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
    array( 'twenty-twenty-two-style' ), wp_get_theme()->get('Version') );
}

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles');
// get_template_part('/Parts/navbar.html', 'navbar');
?>