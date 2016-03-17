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
