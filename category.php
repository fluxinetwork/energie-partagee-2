<?php get_header(); ?>
<?php
	$cat = get_the_category();
	$cat_id = $cat[0]->cat_ID;
	
	if ( $cat_id == 15 ) :
    	$title = 'Actualités';
    elseif ( $cat_id == 17 ) :
    	$title = 'Dans la presse';
    elseif ( $cat_id == 16 ) :
    	$title = 'Événements';
    elseif ( $cat_id == 19 ) :				
    	$title = 'Ateliers';
    elseif ( $cat_id == 20 ) :
    	$title = 'Formations';
	else : 
		$title = 'Actualités';
    endif;
	
	if ( $cat_id == 16 || $cat_id == 20 || $cat_id == 19 ) :
		$cat_ppp = 12;
		$meta_label = 'date_event';	
		
		$args_category = array(
			'post_status' => 'publish',
			'post_type' => 'post',
			'cat' => $cat_id ,
			'posts_per_page' => $cat_ppp,
			'orderby' => 'meta_value',
			'meta_key' => $meta_label,
			'order' => 'ASC',
			'meta_query' => array( 
				array(
					'key' => $meta_label, 
					'value' => date('y-m-d'), 
					'compare' => '>=',
					'type' => 'DATE'
				)
			)  
		);		
	else :	
		$args_category = array(
			'post_status' => 'publish',
			'post_type' => 'post',
			'cat' => $cat_id ,
			'posts_per_page' => 12
		);	
	endif;
	
	$query_category = new WP_Query( $args_category );
?>

<section class="wrap-main actualites">
 
  <header class="header-bloc">    
    <h1 class="h1">
		<?php echo $title; ?>    	
    </h1>
  </header>
  
   
	<article class="fluxi-content">
		<div class="fluxi-wrap">	
			<?php
			$loop = 0;
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
                      	<span class="tag"><?php echo $date_news; ?></span>
                      	<h1 class="card__title"><?php echo the_title(); ?></h1>
                      </div>
                  </a>
                         
				<?php	
				$loop++;	
				endwhile;
				echo '</div>';
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