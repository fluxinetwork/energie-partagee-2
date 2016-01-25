<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div class="breadcrumb">
			<?php //include (TEMPLATEPATH."/assets/inc/breadcrumb.php"); ?>
		</div>	
        
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
		
<?php endwhile; endif; ?>

<?php get_footer(); ?>

