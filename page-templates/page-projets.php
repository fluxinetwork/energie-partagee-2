<?php
/*
Template Name: Tous les projets
*/
?>
<?php get_header(); ?>

<section class="wrap-main all-projects">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  
  <header class="header-bloc--page"> 
    <div class="header-bloc__content">
    	<?php custom_breadcrumbs(); ?>
      
      <h1 class="h1 wrap-n">
        <?php the_title(); ?>
      </h1>
    </div>
  </header>

  <div class="fluxi-wrap has-bg">
  	<?php 
		get_description();				
		get_socials('news');	
	?>  
  
  </div>
  <div class="map-projects" <?php echo ' data-nbcards="'.wp_count_posts( 'projets' )->publish.'"'; ?>>
  	<div class="box wrap-n">
      <div class="filters">
      	<h5 class="h5">Filtres énergies</h5>
        <?php
          $cat_filter_terms = get_terms( 'type_energie', 'orderby=name&hide_empty=1' );
            if ( ! empty( $cat_filter_terms ) && ! is_wp_error( $cat_filter_terms ) ): 
              echo '<ul class="map-filters first">';
                foreach ( $cat_filter_terms as $term ) {
                  echo '<li class="c-'.substr($term->slug, 0, 5).'"><button data-filter="' . $term->slug . '" type="button" class="button-round filter-nrj"><i class="icon-filter"></i></button></li>'; 
                }  
              echo '</ul>';                     
            endif;
        ?>        
      </div>
      <div class="filters">
        <h5 class="h5">Filtres type de projet</h5>
        <ul class="map-filters second">
        	<li><button data-filter="onsuit" type="button" class="tag">A suivre</button></li>
            <li><button data-filter="collecte" type="button" class="tag">En collecte</button></li>
            <li><button data-filter="succes" type="button" class="tag">100% financé</button></li>
        </ul>
      </div> 
    </div>
    <div class="map-holder">
        <div class="spinner bg-spin"></div>
    	  <div id="map"></div>
        <div class="cards-map"></div>
        <div class="wrap-n al-c anim-out"><button type="button" class="button green js-more-procards">Charger plus</button> </div>
     </div>      	
  </div>
  <?php // FLUXI CONTENT         
    if( have_rows('elements_page') ):
      echo '<article class="fluxi-content fitvids wrap-n">';   
        //require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');
        the_content();         
      echo '</article>';
    endif;       
  ?>    
  
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
