<?php get_header(); ?>

<section class="wrap-main page-contenu">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	  	
	  	$main_img_add = get_field( 'add_image' );
		$main_image ='';

		if ( has_post_thumbnail() && $main_img_add == 0) :
			$post_img_id = get_post_thumbnail_id();
			$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
			$post_img_url = $post_img_array[0];

			$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$post_img_url.'"></div>';
		elseif($main_img_add == 1):
			$main_image_obj = get_field( 'main_image' );
			$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$main_image_obj['url'].'"></div>';
		endif;


  ?>
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

				echo $main_image;
						
				get_description();

				get_socials();					
				
				require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');
		   		
		   	echo '</article>';
		else :
			echo '<article class="fluxi-wrap fluxi-content fitvids">';

				echo $main_image;
						
				get_description();

				get_socials();					
				
				echo '<p>Cette page est vide...<p>';
		   		
		   	echo '</article>';
		endif; 
	?>


  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
