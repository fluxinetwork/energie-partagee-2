<?php

/**
 * Set config vars
 */

// DEV
define('THEME_DIRECTORY_NAME', 'energie-partagee-2'); // Theme directory name
define('DEV', true); // Dev environment
define('CSS_COMPONENTS', true); // Work with CSS coponents ( DEV must be true )

// VALUES
define('GOOGLE_ANALYTICS_ID', ''); // UA-XXXXX-Y (Note: Universal Analytics only, not Classic Analytics)
define('POST_EXCERPT_LENGTH', 40); // Excerpt length in words

// ACTIVATE
define('PAGE_EXCERPT', true); // Add excerpt to pages
define('ADD_THUMBNAILS', 'post'); // Post types which get thumbnails
define('ACF_OPTION_PAGE', true); // Activate ACF option page


/**
 * Functions using config ACTIVATE vars
 */

// Add excerpt to pages
if ( PAGE_EXCERPT ) {	
	function add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'add_excerpts_to_pages' );
}

// Add post thumbnail
if ( sizeof(ADD_THUMBNAILS) > 0 ) {	
	function add_post_thumb() {
	  	add_theme_support( 'post-thumbnails', ADD_THUMBNAILS );
	}
	add_action('after_setup_theme', 'add_post_thumb');
}

// Activate ACF option page
if ( ACF_OPTION_PAGE && function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}