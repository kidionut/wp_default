<?php 

function myTheme_setup() {
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Menus
	register_nav_menus( array(
		'menu-1'             => esc_html__( 'Primary', 'myTheme' ),
	));

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

};

// Add Body Classes
add_filter( 'body_class', 'myThemebody_classes' );
function myThemebody_classes($classes) {
        $id = get_current_blog_id();
        $slug = strtolower(str_replace(' ', '-', trim(get_bloginfo('name'))));
        $classes[] = $slug;
        return $classes;
}

// For comments, add textarea below the text inputs
function wp34731_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	
	return $fields;
	}
add_filter( 'comment_form_fields', 'wp34731_move_comment_field_to_bottom' );



if ( ! is_admin() ) {

	/*
	 * Remove jQuery Migrate script from the jQuery bundle only in front end.
	 */
	function twf_remove_jquery_migrate( $scripts ) {
		if ( isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			
			if ( $script->deps ) { // Check whether the script has any dependencies
				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}
	add_action( 'wp_default_scripts', 'twf_remove_jquery_migrate' );


	// Remove wp emoji
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	


	
	// Move jQuery to the footer. 
	function myTheme_enqueue_scripts() {
	    wp_scripts()->add_data( 'jquery', 'group', 1 );
	    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
	    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
	}
	add_action( 'wp_enqueue_scripts', 'myTheme_enqueue_scripts' );
}

/*
 * Filter the except length to 20 words.
 */
function get_excerpt($limit, $source = null){

    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    return $excerpt;
}