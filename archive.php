<?php
/*
Template Name: Archives
*/
?>


<?php get_header(); ?>

<section class="wrap-main">
 
  <header class="header-bloc">
    
    <?php custom_breadcrumbs(); ?>
    
    <h1 class="h1 wrap-l">
      <?php the_title(); ?>
    </h1>
  </header>
  
   
	<article class="fluxi-content fitvids wrap-n">
		<?php wp_get_archives('type=monthly'); ?>				
	</article>
	
  
</section>
<?php get_footer(); ?>
