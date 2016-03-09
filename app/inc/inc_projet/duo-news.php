<?php
$args_news = array(
	'post_type' => 'post',
	'posts_per_page' => 2,
	'cat' => 15,
	'ignore_sticky_posts' => 1
);
$query_news = new WP_Query( $args_news );
?>

	<section class="section duo-card">
    	<div class="wrap-n">
        	<div class="box head__flex">
            	<div class="box__half">
            		<h5 class="s-title">Nos actualités</h5>
            	</div>
            	<div class="box__half">
                    <span class="lighter">Suivez-nous sur</span> 
                    <ul class="social">
                        <li><a href="#" class="social--face"><i class="icon-facebook"></i></a></li>
                       <li><a href="#" class="social--twit"><i class="icon-twitter"></i></a></li>
                    </ul>  
           	  </div>
             	<div class="box__fixe"></div>
        	</div>
       
           <div class="box">
           <?php					
					if ( $query_news->have_posts() ) :
						while ( $query_news->have_posts() ) : $query_news->the_post();						
							// Thumb
							if ( has_post_thumbnail() ):
								$news_img_id = get_post_thumbnail_id();
								$news_img_array = wp_get_attachment_image_src($news_img_id, 'medium', true);
								$news_img_url = $news_img_array[0];									
                             $news_img = '<img class="img-reponsive" src="'.$news_img_url.'">';
							endif;
							
							$date_news = get_the_time('d').' '.substr(get_the_time('F'),0, 3);                         
							
							?>
                            
                          <article class="box__half">
                              <a class="card card-news" href="<?php echo the_permalink(); ?>">
                                	 <div class="card__img">
                                   	<?php echo $news_img; ?>
                                  </div>
                                  <div class="card__infos">
                                   	<span class="tag"><?php echo $date_news; ?></span>
                                   	<h1 class="card__title"><?php echo the_title(); ?></h1>
                                  </div>
                               </a>
                          </article>
                            
                  	<?php
				  
				            
						endwhile;
					endif;
					wp_reset_postdata();
				?>
                
                <div class="box__fixe"> 
                    <a class="button-round grey" href="<?php echo esc_url(get_category_link( 15 )); ?>"><i class="icon-round-plus"></i></a> 
                </div>
           </div>
       </div>
    </section>    