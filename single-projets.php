<?php get_header(); ?>

<section class="wrap-main">
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
	// stade
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
       <div class="box">
        <div class="box__half">
		<?php get_socials(); ?>
        </div>
        <div class="box__half">
        <button type="button" class="button green"><i class="icon-heart_20"></i> Soutenir ce projet</button>
        </div></div>
        
        <aside class="wrap-bg c-main">
        <div class="box">
        <div class="box__half">
        	<h4>En investissant à son capital</h4>            
            <p class="highlight-txt p-ss">La meilleure façon de soutenir ce projet est d’investir dans son capital (et toucher des interêts en retour).  </p>
            <button type="button" class="button"><i class="icon-euro_20"></i> Je souscris !</button>
        </div>
        <div class="box__half">
            <h4>En restant informé</h4>
            <p class="highlight-txt p-ss">Abonnez-vous à la newsletter de ce projet pour suivre son actualité et qui sait, un jour peut être, investir dans son capital !</p>
            <form class="box" method="post" action="" target="_blank">
            	<div class="box__solo"><input class="courtcircuit__input" name="input_mailing" id="input_mailing" type="email" value="" placeholder="Votre email" required aria-required="true"></div>
            	<div class="box__fixe"><button type="submit" class="button-round"><i class="icon-check_64"></i></button></div>                
            </form>
        </div>     
        </div>    
        </aside>
        
        <h3 class="h3">Répartition du capital</h3>
        
        <div class="map-holder wrap-extend">
            <div id="map" data-lat="<?php echo $latitude; ?>" data-lon="<?php echo $longitude; ?>" data-cat="<?php echo $taxoslug; ?>" data-title="<?php the_title(); ?>">
            
            </div>
            <div class="holder-card">
            	
              <div class="p-details">
              		<div class="p-details__nrg"><i class="icon-<?php echo $taxoslug;?>_100"></i></div>
                  	  
                              
                  <ul class="p-details__infos">
                      <li>
                        	<i class="icon-pin_20"></i>
							<span><strong><?php echo get_field('ville'); ?></strong> <?php echo get_field('departement'); ?></span>
                      </li>
                      <li>
                          <i class="icon-lightbolt_20"></i>
                          <span><strong><?php echo get_field('equivalent_unites_puissance') . ' ' . get_field('type_unite_de_puissance'); ?></strong><?php echo get_field('production') . ' ' . get_field('unite_production'); ?></span>
                       </li>                    
                   </ul> 
                    
                   <p class="p-details__equi p-ss">Produit la consommation annuelle de <?php echo get_field('equivalent_production'); ?> foyers.</p>
              </div>  
				              
            </div>            
        </div>
        
        <h3 class="h3">Avancée du projet</h3>
        
        
        <h3 class="h3">Message du porteur de projet</h3>
        
        <div class="testimony box wrap-extend">
			<div class="box__half">															
				<div class="holder-round" style="background-image:url('<?php echo $portrait_pdp['url']; ?>')"></div>
			</div>
			<div class="box__half">					
				<p class="p-ss"><span>"</span><?php echo get_field('temoignage'); ?><span>"</span></p>
              <h4><?php echo get_field('prenom') . ' ' . get_field('nom'); ?></h4>
			</div>									
		</div>
        
        
        
    </article>    
  
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
