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
  <article class="fluxi-content">
  		<div id="map">
        
        </div>  	
  </article>    
  
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
