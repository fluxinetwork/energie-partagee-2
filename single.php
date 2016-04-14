<?php get_header(); ?>

<section class="wrap-main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
  	$cat_post = get_the_category();
	$cat_post = $cat_post[0];
	$cat_post_slug = $cat_post->slug;
	
	if($cat_post_slug == 'evenements'):
		$url_parent_page = get_bloginfo('url').'/nous-suivre/tous-les-evenements/';
	elseif($cat_post_slug == 'formations'):
		$url_parent_page = get_bloginfo('url');
	elseif($cat_post_slug == 'ateliers'):
		$url_parent_page = get_bloginfo('url');
	elseif($cat_post_slug == 'presse'):
		$url_parent_page = get_bloginfo('url');
	else:
		$url_parent_page = get_bloginfo('url');
	endif;

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

	$the_content = get_the_content();
	
	$prev_post = get_adjacent_post( true, '', true ); 
	$next_post = get_adjacent_post( true, '', false );

  ?>
  <header class="header-bloc">    
    <ul class="tags">
    	 <li><a class="tag" href="<?php echo $url_parent_page; ?>"><?php echo $cat_post->cat_name; ?></a></li>
         <?php if($cat_post_slug == 'presse' || $cat_post_slug == 'actualites'): ?>
        	<li class="tag is-inactive"><?php echo get_the_date();?></li>
        <?php endif; ?>
    </ul>    
    <h1 class="h1 wrap-n">
      <?php the_title(); ?>
    </h1>
    <?php if($cat_post_slug=='evenements' || $cat_post_slug=='formations' || $cat_post_slug=='ateliers'): ?>
    			<h4 class="h4"><span class="icon-calendar_20"></span><?php echo date_i18n('d F Y', strtotime(get_field('date_event')));?><span class="icon-pin_20"></span><?php echo get_field('ville_event');?></h4>    
    <?php endif; ?>
  </header>
  
    <?php
       	/////////////////////////////////////
		/////       FLUXI CONTENT       /////
		/////////////////////////////////////
		   
		if( have_rows('elements_page') || $the_content):
			echo '<article class="fluxi-wrap fluxi-content fitvids">';
						
				echo $main_image;	

				if(have_rows('elements_page')):		
					get_description();
				else:
					echo '<h2 class="description">';
						bloginfo('description');
					echo '</h2>';		
				endif;
				
				get_socials();					
				
				require_once locate_template('/app/inc/inc_projet/fluxi-content/builder.php');

				if($the_content):
					echo '<div class="holder-old">'.$the_content.'</div>';
				endif;
				
				// Suggestion d'articles
				if ( !empty( $prev_post ) || !empty( $next_post )):
					echo '<aside class="suggestion-posts">';
						if ( !empty( $prev_post ) ): 
							echo '<a class="f-btn__prev" href="'.get_permalink( $prev_post->ID ).'" title="'.$prev_post->post_title.'"><i class="icon-chevronright_32"></i>'.$prev_post->post_title.'</a>';							
						 endif;
						 
						 if ( !empty( $next_post ) ):
							echo '<a class="f-btn__next" href="'.get_permalink( $next_post->ID ).'" title="'.$next_post->post_title.'">'.$next_post->post_title.'<i class="icon-chevronright_32"></i></a>';
						 endif;
					 echo '</aside>';
				endif; 	 
		   		
		   	echo '</article>';
		endif; 		
	?>
    
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
