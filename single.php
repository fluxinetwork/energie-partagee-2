<?php get_header(); ?>

<section class="wrap-main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  	$cat_post = get_the_category();
	$cat_post = $cat_post[0];
	$cat_post_slug = $cat_post->slug;

	$main_image_obj = get_field( 'main_image' );
	$main_image ='';

	if ( has_post_thumbnail() && empty($main_image_obj)) :
		$post_img_id = get_post_thumbnail_id();
		$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
		$post_img_url = $post_img_array[0];

		$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$post_img_url.'"></div>';
	elseif(!empty($main_image_obj)):

		$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$main_image_obj['url'].'"></div>';
	endif;

  ?>
  <header class="header-bloc">    
    <ul class="tags">
    	 <li><a class="tag" href="<?php echo get_category_link( $cat_post->cat_ID ); ?>"><?php echo $cat_post->cat_name; ?></a></li>        <?php if($cat_post_slug!='evenements'): ?>
        	<li class="tag"><?php echo get_the_date();?></li>
        <?php endif; ?>
    </ul>    
    <h1 class="h1 wrap-n">
      <?php the_title(); ?>
    </h1>
    <?php if($cat_post_slug=='evenements'): ?>
    	<h4 class="h4"><span class="icon-uniE605"></span><?php echo get_the_date();?><span class="icon-uniE61C"></span><?php echo get_field('ville_event');?></h4>    
    <?php endif; ?>
  </header>
  
    <?php
       	/////////////////////////////////////
		/////       FLUXI CONTENT       /////
		/////////////////////////////////////
		   
		if( have_rows('elements_page') ):
			echo '<article class="fluxi-content fitvids wrap-n">';
						
				echo $main_image;						
						
				if( get_field('google_description') ):							
					echo '<h2 class="description">'.get_field('google_description').'</h2>';
				else:
					echo '<h2 class="description">Attention !! Vous devez remplir le champ description et/où mettre à jour votre page. </h2>';	
				endif;	

				get_socials();					
				
				require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');
		   		
		   	echo '</article>';
		endif; 
		   
	?>
  
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
