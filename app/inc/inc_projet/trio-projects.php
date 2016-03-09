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
							if ( has_post_thumbnail() ):
								$project_img_id = get_post_thumbnail_id();
								$project_img_array = wp_get_attachment_image_src($project_img_id, 'medium', true);
								$project_img_url = $project_img_array[0];									
                             $project_img = '<img class="img-reponsive" src="'.$project_img_url.'">';
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
                    <button type="button" class="button-round grey js-more-project"><i class="icon-round-next"></i></button> 
              </div>               
                       
            </div>
        </div>
        <div class="wrap-n al-c">    
            <a href="#" class="button green"><i class="icon-uniE61C"></i> Voir la carte des projets</a>
        </div>       
</section>