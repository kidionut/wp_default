<?php


// Admin CSS & JS
function wpdocs_enqueue_custom_admin_style() {
		// CSS
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/assets/dist/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}

// Client CSS & JS
function myTheme_enqueue() {
	
	if( WP_DEBUG === true ) { 
		wp_register_style( 'myTheme_style', get_template_directory_uri() . '/assets/dist/css/style.css' );
		wp_register_script( 'myTheme_script', get_template_directory_uri() . '/assets/dist/js/scripts.js', array('jquery'), null, true );
	} else {
		wp_register_style( 'myTheme_style', get_template_directory_uri() . '/assets/dist/css/style.min.css' );
		wp_register_script( 'myTheme_script', get_template_directory_uri() . '/assets/dist/js/scripts.min.js', array('jquery'), null, true );
	}

	wp_enqueue_style( 'myTheme_style' );
	wp_enqueue_script( 'myTheme_script' );

}