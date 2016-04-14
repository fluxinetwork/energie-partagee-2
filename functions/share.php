<?php

/** 
 * SHARING TOOLS
 *
 * 01. Open Graph meta
 * 02. Share buttons
 */


/** 
 * 01. Open Graph meta
 * WARNING !!! Default image to share and facebook profile id must be yours
 */

// Add Open Graph in the language attributes
function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

// Add Open Graph meta in head
function insert_fb_in_head() {
	global $post;
	$default_image = "/app/img/default_fb.jpg";// WARNING !!!
	if ( !is_singular())
		return;
        echo '<meta property="fb:admins" content="1568569473365817"/>'; // WARNING !!!
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'.get_bloginfo('name').'"/>';
		if( !has_post_thumbnail( $post->ID )  || is_home() ) {
			echo '<meta property="og:image" content="'.get_bloginfo('template_url').$default_image.'"/>';
		}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="'.esc_attr( $thumbnail_src[0] ).'"/>';
	}
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );


/** 
 * 02. Share buttons
 */

function get_socials($param = false) {
	global $post;
	$class;
	if ($param) {
		$class = $param;
	}
	echo'<ul class="social '.$param.'">			
           <li><button class="js-share social--fb" data-network="facebook" data-url="' . get_permalink() . '"><i class="icon-facebook_40"></i></button></li>
           <li><button class="js-share social--tw" data-network="twitter" data-url="' . get_permalink() . '"><i class="icon-twitter_40"></i></button></li>
         </ul>';	
} 