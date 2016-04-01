<?php
/*
Template Name: Tous les articles
*/
?>
<?php get_header(); ?>
<?php
	
	$cat_id = 15;
	$cat_ppp = 12;	
		
	$args_category = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'cat' => $cat_id ,
		'posts_per_page' => $cat_ppp
	);	
	
	$query_category = new WP_Query( $args_category );
?>

	<?php include( TEMPLATEPATH.'/app/inc/inc_projet/get-category.php' ); ?>
<?php get_footer(); ?>
