<?php
/*
Template Name: Toutes les formations
*/
?>
<?php get_header(); ?>
<?php	
	$cat_id = 20;
	$cat_ppp = 12;
	$meta_label = 'date_event';	
	
	$args_category = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'cat' => $cat_id ,
		'posts_per_page' => $cat_ppp,
		'orderby' => 'meta_value',
		'meta_key' => $meta_label,
		'order' => 'ASC',
		'meta_query' => array( 
			array(
				'key' => $meta_label, 
				'value' => date('y-m-d'), 
				'compare' => '>=',
				'type' => 'DATE'
			)
		)  
	);			
	
	$query_category = new WP_Query( $args_category );
?>

<section class="wrap-main">
 
  <header class="header-bloc">    
    <h1 class="h1">
		<?php the_title(); ?>    	
    </h1>
  </header>
  
   
	<article class="fluxi-content wrap-l">
		<div class="box">	
			<?php include( TEMPLATEPATH.'/app/inc/inc_projet/get-category.php' ); ?>
       </div>
       
       <div class="wrap-l al-c">
       		<button type="button" class="button green js-more" data-cat="<?php echo $cat_id;?>">Charger plus</button>
       </div>
        			
	</article>
	
  
</section>
<?php get_footer(); ?>
