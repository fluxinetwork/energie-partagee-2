<?php
$nb_projects = 0;
$args_projects = array(
	'post_type' => 'projets',
	'posts_per_page' => 3
);
$query_projects = new WP_Query( $args_projects );
?>

<section class="section trio-card">
    	<h5 class="s-title">Sélection de projets</h5>
        <div class="wrap-n">        
            <div class="box">
            	<?php					
					if ( $query_projects->have_posts() ) :
						while ( $query_projects->have_posts() ) : $query_projects->the_post();						
							// Thumb	
							$main_image_obj = get_field( 'main_image' );
							$project_img ='';
						
							if ( has_post_thumbnail() && empty($main_image_obj)) :
								$post_img_id = get_post_thumbnail_id();
								$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
								$post_img_url = $post_img_array[0];
						
								$project_img = '<img class="img-reponsive" src="'.$post_img_url.'">';
							elseif(!empty($main_image_obj)):
						
								$project_img = '<img class="img-reponsive" src="'.$main_image_obj['url'].'">';
							endif;					
							                               
							// Design box class
							if($nb_projects == 0):
								echo '<article class="box__full">';
							else:
								echo '<article class="box__half">';
							endif; 
							?>
                            
                           <a class="card card-project" href="<?php the_permalink(); ?>">
                            <div class="card__img">
                            	 	<?php echo $project_img; ?>
                                <i class="card__icon icon-uniE60F"></i>
                            </div>
                            <div class="card__infos">
                                 <h1 class="card__title"><?php the_title(); ?></h1>
                                <p class="p-ss"><?php echo get_field('departement'); ?></p>
                            </div>
                          </a>
                          
                      </article>     
                            
                  	<?php
				  
				  		$nb_projects++;
				            
						endwhile;
					endif;
					wp_reset_postdata();
				?>
              
              <div class="box__fixe">
                    <button type="button" class="button-round grey js-more-project"><i class="icon-chevronright_64"></i></button> 
              </div>               
                       
            </div>
        </div>
        <div class="wrap-n al-c">    
            <a href="<?php bloginfo('url'); ?>/projets/" class="button green"><i class="icon-pin_20"></i> Voir la carte des projets</a>
        </div>       
</section>