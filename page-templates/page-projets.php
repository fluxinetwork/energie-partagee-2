<?php
/*
Template Name: Tous les projets
*/
?>
<?php get_header(); ?>

<section class="wrap-main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  
  <header class="header-bloc"> 
      
    <h1 class="h1 wrap-n">
      <?php the_title(); ?>
    </h1>
   
  </header>
  <div class="fluxi-content">
  	<ul class="map-filters first">
    	<li><button data-filter="biomasse" type="button" class="button-round grey"><i class="icon-biomasse_64"></i></button></li>
        <li><button data-filter="economies-energie" type="button" class="button-round grey"><i class="icon-eco_64"></i></button></li>
        <li><button data-filter="eolien" type="button" class="button-round grey"><i class="icon-eolien_64"></i></button></li>
        <li><button data-filter="geothermie" type="button" class="button-round grey"><i class="icon-geo_64"></i></button></li>
        <li><button data-filter="micro-hydroelectricite" type="button" class="button-round grey"><i class="icon-hydro_64"></i></button></li>
        <li><button data-filter="solaire-photovoltaique" type="button" class="button-round grey"><i class="icon-solaire_64"></i></button></li>
    </ul>
    <ul class="map-filters second">
    	<li><button data-filter="onsuit" type="button" class="button-round grey"><i class="icon-plus_64"></i></button></li>
        <li><button data-filter="collecte" type="button" class="button-round grey"><i class="icon-plus_64"></i></button></li>
        <li><button data-filter="succes" type="button" class="button-round grey"><i class="icon-plus_64"></i></button></li>
    </ul>
    
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
