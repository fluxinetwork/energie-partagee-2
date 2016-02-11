<?php 
/**
 * Add custom body class
 */

$bodyclass = 'no-touch';

// Browser detection using plugin : https://fr.wordpress.org/plugins/php-browser-detection/
if ( function_exists('is_mobile') ) {
	is_mobile() ? $bodyclass .= 'touch is-mobile' : $bodyclass .= ' is-desktop';
}
?>