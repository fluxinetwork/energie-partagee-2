<?php
/*
Template Name: Tous les projets
*/
?>
<?php get_header(); ?>

<section class="wrap-main all-projects">
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
		get_description();				
		get_socials();	
	?>  
  
  </div>
  <article class="map-projects">
  	<div class="box wrap-n">
      <div class="filters">
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
    	 <div id="map"></div>
       <div class="cards-map"></div> 
     </div>      	
  </article>
  <?php // FLUXI CONTENT         
    if( have_rows('elements_page') ):
      echo '<article class="fluxi-content fitvids wrap-n">';   
      require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');          
      echo '</article>';
    endif;       
  ?>

  <?php include( TEMPLATEPATH.'/app/inc/inc_projet/trio-projects.php' ); ?>     
  
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
