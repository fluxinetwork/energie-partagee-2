<?php get_header(); ?>

<section>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="header-bloc">
    <div class="breadcrumb">
      <?php custom_breadcrumbs(); ?>
    </div>
    <h1 class="h1">
      <?php the_title(); ?>
    </h1>
  </header>
  <article>
    <?php
           /////////////////////////////////////
		   /////       FLUXI CONTENT       /////
		   /////////////////////////////////////
		   
		   if( have_rows('elements_page') ):
				echo '<div class="fluxi-content fitvids">';
					require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');
		   		echo '</div>';
			endif; 
		   
		?>
  </article>
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
