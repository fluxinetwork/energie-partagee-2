<?php
	$loop = 0;	
?>

<section class="wrap-main actualites">
 
  <header class="header-bloc">    
    <h1 class="h1">
		<?php the_title(); ?>    	
    </h1>
  </header>  
   
	<article class="fluxi-content" <?php echo ' data-totalposts="'.$total_post_count.'"'; ?>>
		<div class="fluxi-wrap">	
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
					
					if($cat_id == 16):		
						$date_news = date_i18n('d M', strtotime(get_field('date_event'))); 
					else: 
						$date_news = get_the_time('d M');                       
					endif;	

					$newsClass = 'card-news inverse-m';

					if ($loop==0) {
						$newsClass = 'card-news--expand';
					} else if ($loop ==1) {
						echo '<div class="wrap-pad js-inject-news">';
					} else if ($loop==5) {
						$newsClass = 'card-news--big';
						//include( TEMPLATEPATH.'/app/inc/category-more.php' );
					} else if ($loop > 5) {
						$newsClass = 'card-news';
					} 
					?>                            
                          
                  <a class="<?php echo $newsClass; ?>" href="<?php echo the_permalink(); ?>">
                  	<div class="card__img">
                      	<?php echo $news_img; ?>
                  	</div>
                      <div class="card__infos">
                      	<span class="tag is-inactive"><?php echo $date_news; ?></span>
                      	<h1 class="card__title"><?php echo the_title(); ?></h1>
                      </div>
                  </a>
                         
				<?php	
				$loop++;	
				endwhile;
				echo '</div>';
			else:
				if($cat_id == 16):	
					echo '<h2 class="description">Il n\'y a pas d\'événements à venir pour le moment.</h2>';
				elseif($cat_id == 19):
					echo '<h2 class="description">Il n\'y a pas d\'ateliers à venir pour le moment.</h2>';
				elseif($cat_id == 20):
					echo '<h2 class="description">Il n\'y a pas de formations à venir pour le moment.</h2>';
				else:
					echo '<h2 class="description">Il n\'y a pas d\'articles pour le moment.</h2>';
				endif;
			endif;
			wp_reset_postdata();
			?>
       </div>
       
       <?php if($total_post_count > $cat_ppp): ?>
	       <div class="wrap-l al-c">
	       		<button type="button" class="button green js-more" data-cat="<?php echo $cat_id;?>">Charger plus</button>
	       </div>
       <?php endif; ?> 			
	</article>
	
  
</section>