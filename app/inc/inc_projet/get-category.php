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