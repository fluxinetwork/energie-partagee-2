<?php get_header(); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  
  	// Vidéo
	$video = get_field('video');	
  
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
	
	$type_power = 'c-' . substr($taxoslug, 0, 5);
	
	// Status
	$field_stade = get_field_object('status_projet');
	
	// Imgs
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
	// Img porteur de projet
	$portrait_pdp = get_field('portrait');
	

  ?>
<section class="wrap-main<?php echo ' ' . $type_power; ?>">
  <header class="header-bloc"> 
    <ul class="tags">   	
    	<li class="tag"><?php echo $taxoname;?></li>
        <li class="tag"><?php echo $field_stade['label'] . '/' . get_field( 'status_projet' );?></li>     
    </ul>     
    <h1 class="h1 wrap-n">
      <?php the_title(); ?>  
    </h1>
   	
    <?php if( !empty($video) ){ ?>
    	<a href="#" class="lightvideo button"><i class="icon-video_20"></i> Voir la vidéo</a>		
	<?php } ?>
    
  </header>
  	<article class="fluxi-wrap a-project">
    
    	<?php echo $main_image; ?>
        
       <?php get_description(); ?>
       
        <?php include( TEMPLATEPATH.'/app/inc/inc_projet/following-project.php' ); ?>
        
        <?php include( TEMPLATEPATH.'/app/inc/inc_projet/map-project.php' ); ?>  
        
        <?php include( TEMPLATEPATH.'/app/inc/inc_projet/steps-project.php' ); ?>
        
        <?php include( TEMPLATEPATH.'/app/inc/inc_projet/testimony-project.php' ); ?>      
        
        <?php include( TEMPLATEPATH.'/app/inc/inc_projet/capital-project.php' ); ?> 
        
        
    </article>    
</section>  
  <?php endwhile; ?>
  
  <?php else: ?>
    <section class="wrap-main">
      <header class="header-bloc">        
        <h1 class="h1 wrap-n">Le projet n'existe pas </h1>      
      </header>  
      <article class="fluxi-wrap a-project">
        <p>Le projet n'existe pas</p>
      </article>    
    </section>  
  <?php endif; ?>

<?php get_footer(); ?>
