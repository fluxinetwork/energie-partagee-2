<?php
$nb_projects = 0;
if(is_home()):
	$args_projects = array(
		'post_type' => 'projets',
		'post_status' => 'publish',
		'posts_per_page' => 3,
		'meta_query' => array( 
			array(
				'key' => 'projet_star', 
				'value' => 1, 
				'compare' => '='
			)
		)  
	);

else:
	
	if(get_field('active_related_projects') == 1):
		$ids = get_field('related_projects', false, false);
		
		$args_projects = array(
			'post_status' => 'publish',
			'post_type' => 'projets',
			'posts_per_page' => 2,
			'post__in'	=> $ids
		);
	
	else:

		$args_projects = array(
			'post_type' => 'projets',
			'post_status' => 'publish',
			'posts_per_page' => 2,
			'post__not_in' => array(get_the_ID()),
			'orderby' => rand
		);	
	
	endif;
endif;
$query_projects = new WP_Query( $args_projects );

?>

<section class="section trio-card">
    	<h5 class="s-title"><?php echo (is_home()) ? 'Sélection de projets' : 'Découvrir d\'autres projets';?></h5>
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
							
							// Slug NRJ
							$terms_nrj = get_the_terms( $post->ID, 'type_energie' );
							if ( !empty( $terms_nrj ) ) {
								$term_nrj = array_shift( $terms_nrj );
								$taxo_nrj = $term_nrj->slug;
							}							
							$terms_nrj = ' c-' . substr($taxo_nrj, 0, 5);
							                               
							// Design box class
							if($nb_projects == 0 && is_home()):
								echo '<article class="box__full'.$terms_nrj.'">';
							else:
								echo '<article class="box__half'.$terms_nrj.'">';
							endif; 
							?>
                            
                           <a class="card card-project" href="<?php the_permalink(); ?>">
                            <div class="card__img">
                            	 	<?php echo $project_img; ?>
                                <i class="card__icon"></i>
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
              		<?php if(is_home()): ?>	
                    <button type="button" class="button-round grey js-more-project"><i class="icon-chevronright_64"></i></button>
                  <?php else: ?>     
                    <a href="/projets/" class="button-round grey"><i class="icon-plus_64"></i></a>
                  <?php endif; ?>      
              </div>               
                       
            </div>
        </div>
        <?php if(is_home()): ?>
            <div class="wrap-n al-c">    
                <a href="<?php bloginfo('url'); ?>/projets/" class="button green cta"><i class="icon-pin_20"></i> Voir la carte des projets</a>
            </div>
        <?php endif; ?>       
</section>