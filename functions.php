<?php 


// Includes
include( get_template_directory() . '/inc/config/setup.php' );

include( get_template_directory() . '/inc/front/enqueue.php' );

include( get_template_directory() . '/inc/front/sidebar.php' );

include( get_template_directory() . '/inc/back/navwalker.php' );

include( get_template_directory() . '/inc/back/jetpack.php' );

include( get_template_directory() . '/inc/back/ajax-posts.php' );

include( get_template_directory() . '/inc/back/ajax-video-post.php' );

include( get_template_directory() . '/inc/back/redirect.php' );



// Hooks
add_action( 'wp_enqueue_scripts', 'myTheme_enqueue' );

add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );

add_action( 'after_setup_theme', 'myTheme_setup' );

add_action( 'widgets_init', 'myTheme_sidebar_init' );

add_action( 'customize_register', 'myTheme_setting' );

// Ajax Call
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');

add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

add_action('wp_ajax_load_video_posts_by_ajax', 'load_video_posts_by_ajax_callback');

add_action('wp_ajax_nopriv_load_video_posts_by_ajax', 'load_video_posts_by_ajax_callback');