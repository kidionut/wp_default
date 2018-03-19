<?php 


// Includes
include( get_template_directory() . '/inc/config/setup.php' );

include( get_template_directory() . '/inc/front/enqueue.php' );

include( get_template_directory() . '/inc/front/sidebar.php' );

include( get_template_directory() . '/inc/back/navwalker.php' );



// Hooks
add_action( 'wp_enqueue_scripts', 'myTheme_enqueue' );

add_action( 'after_setup_theme', 'myTheme_setup' );

add_action( 'widgets_init', 'myTheme_sidebar_init' );

add_action( 'customize_register', 'myTheme_setting' );