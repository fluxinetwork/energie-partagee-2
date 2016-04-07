<?php get_header(); ?>

<section class="wrap-main template-page">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="header-bloc">
    
    <?php custom_breadcrumbs(); ?>
    
    <h1 class="h1 wrap-l">
      <?php the_title(); ?>
    </h1>
  </header>
  
    <?php
       	/////////////////////////////////////
		/////       FLUXI CONTENT       /////
		/////////////////////////////////////
		   
		if( have_rows('elements_page') ):
			echo '<article class="fluxi-wrap fluxi-content fitvids">';
						
				get_description();

				get_socials();					
				
				require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');
		   		
		   	echo '</article>';
		else :
			echo 'RIEN';
		endif; 
		   
	?>
  
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
