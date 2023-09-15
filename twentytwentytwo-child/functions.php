<?php
add_action( 'wp_enqueue_scripts', 'twentytwentytwo_child_styles' );
function twentytwentytwo_child_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
    array( 'twentytwentytwo-style' ), wp_get_theme()->get( 'Version' ) );
}
?>