<?php get_header(); ?>

<section class="wrap-main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="header-bloc">
    <div class="breadcrumb">
      <?php custom_breadcrumbs(); ?>
    </div>
    <h1 class="h1">
      <?php the_title(); ?>
    </h1>
  </header>
  
    <?php
           /////////////////////////////////////
		   /////       FLUXI CONTENT       /////
		   /////////////////////////////////////
		   
		   if( have_rows('elements_page') ):
				echo '<article class="fluxi-content fitvids wrap-n">';
				
					if(is_page() || is_single()){
						if( get_field('google_description') ):
							
							echo '<h2 class="description">'.get_field('google_description').'</h2>';
							get_socials();
						endif;
					}
				
					require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');
		   		echo '</article>';
			endif; 
		   
		?>
  
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
