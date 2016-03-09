<?php get_header(); ?>
<?php
	$cat = get_the_category();
	$cat_id = $cat[0]->cat_ID;
	
	$args_category = array(
		'post_type' => 'post',
		'cat' => $cat_id ,
		'posts_per_page' => 12
	);
	$query_category = new WP_Query( $args_category );
?>

<section class="wrap-main">
 
  <header class="header-bloc">    
    <h1 class="h1">
			<?php     			
    			if ( $cat_id == 15 ) :
    				echo 'Les actualités';
    			elseif ( $cat_id == 17 ) :
    				echo 'Dans les médias';
    			elseif ( $cat_id == 16 ) :
    				echo 'Les événements';
    			elseif ( $cat_id == 19 ) :				
    				echo 'Les ateliers';
    			elseif ( $cat_id == 20 ) :
    				echo 'Les formations';
    			endif;
    		?>    	
    </h1>
  </header>
  
   
	<article class="fluxi-content wrap-l">
		<div class="box">	
		<?php			
			if ( $query_category->have_posts() ) :
				while ( $query_category->have_posts() ) : $query_category->the_post();
					
					// Thumb
					if ( has_post_thumbnail() ):
						$news_img_id = get_post_thumbnail_id();
						$news_img_array = wp_get_attachment_image_src($news_img_id, 'medium', true);
						$news_img_url = $news_img_array[0];									
                      $news_img = '<img class="img-reponsive" src="'.$news_img_url.'">';
					endif;
							
					$date_news = get_the_time('d').' '.substr(get_the_time('F'),0, 3);                         
							
					?>                            
                          
                  <a class="card card-news" href="<?php echo the_permalink(); ?>">
                  	<div class="card__img">
                      	<?php echo $news_img; ?>
                  	</div>
                      <div class="card__infos">
                      	<span class="tag"><?php echo $date_news; ?></span>
                      	<h1 class="card__title"><?php echo the_title(); ?></h1>
                      </div>
                  </a>
                         
				<?php		
				endwhile;
			endif;
			wp_reset_postdata();
		?>
       </div>
       
       <div class="wrap-l al-c">
       		<button type="button" class="button green js-more" data-cat="<?php echo $cat_id;?>">Charger plus</button>
       </div>
        			
	</article>
	
  
</section>
<?php get_footer(); ?>
