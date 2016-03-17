<?php get_header(); ?>

<section class="wrap-main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  	//Location
	$location = get_field('coordonees_gps');
	if( !empty($location) ){
		$latitude = $location['lat'];
		$longitude = $location['lng'];
	}	
	// Taxo Slug		
	$terms = get_the_terms( $post->ID, 'type_energie' );
	if ( !empty( $terms ) ) {
		$term = array_shift( $terms );
		$taxoslug = $term->slug;
		$taxoname = $term->name;
	}
	
	// Img
	$main_image_obj = get_field( 'main_image' );
	$main_image ='';

	if ( has_post_thumbnail() && empty($main_image_obj)) :
		$post_img_id = get_post_thumbnail_id();
		$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
		$post_img_url = $post_img_array[0];
		$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$post_img_url.'"></div>';
	elseif(!empty($main_image_obj)):
		$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$main_image_obj['url'].'"></div>';
	endif;

  ?>
  <header class="header-bloc"> 
      
    <h1 class="h1 wrap-n">
      <?php the_title(); ?>  
    </h1>
   
  </header>
  	<article class="fluxi-content wrap-n">
    	<?php echo $main_image; ?>
        
        <div class="map-holder">
            <div id="map" data-lat="<?php echo $latitude; ?>" data-lon="<?php echo $longitude; ?>" data-cat="<?php echo $taxoslug; ?>" data-title="<?php the_title(); ?>">
            
            </div>
            <div class="minicard-map">
            	<h5><?php the_title(); ?></h5>
                
            </div>            
        </div>
        
    </article>    
  
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
