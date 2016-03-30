<?php
/*
Template Name: Tous les projets
*/
?>
<?php get_header(); ?>

<section class="wrap-main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  
  		  
  ?>
  
  <header class="header-bloc"> 
  
  	<?php custom_breadcrumbs(); ?>
      
    <h1 class="h1 wrap-n">
      <?php the_title(); ?>
    </h1>
   
  </header>
  <div class="fluxi-wrap">
  	<?php 
		if( get_field('google_description') ):							
			echo '<h2 class="description">'.get_field('google_description').'</h2>';
		else:
			echo '<h2 class="description">Attention !! Vous devez remplir le champ description et/où mettre à jour votre page. </h2>';	
		endif;	
				
		get_socials();	
	?>
  
  
  </div>
  <div class="map-projects">
  	<div class="box wrap-n">
    <div class="box__half">
  	<h5 class="h5">Filtres énergies</h5>
  	<ul class="map-filters first">
    	<li class="c-solai"><button data-filter="solaire-photovoltaique" type="button" class="button-round filter-nrj"><i class="icon-filter"></i></button></li>    	
        <li class="c-econo"><button data-filter="economies-energie" type="button" class="button-round filter-nrj"><i class="icon-filter"></i></button></li>
        <li class="c-eolie"><button data-filter="eolien" type="button" class="button-round filter-nrj"><i class="icon-filter"></i></button></li>
        <li class="c-geoth"><button data-filter="geothermie" type="button" class="button-round filter-nrj"><i class="icon-filter"></i></button></li>
        <li class="c-micro"><button data-filter="micro-hydroelectricite" type="button" class="button-round filter-nrj"><i class="icon-filter"></i></button></li>
        <li class="c-bioma"><button data-filter="biomasse" type="button" class="button-round filter-nrj"><i class="icon-filter"></i></button></li>
    </ul>
    </div>
    <div class="box__half">
    <h5 class="h5">Filtres type de projet</h5>
    <ul class="map-filters second">
    	<li><button data-filter="onsuit" type="button" class="tag">A suivre</button></li>
        <li><button data-filter="collecte" type="button" class="tag">En collecte</button></li>
        <li><button data-filter="succes" type="button" class="tag">100% financé</button></li>
    </ul>
   </div> 
   </div>
  	<div class="map-holder">
  		<div id="map">
        
        </div>
        <div class="cards-map">
        
        </div> 
   	</div>      	
  </div>    
  
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
