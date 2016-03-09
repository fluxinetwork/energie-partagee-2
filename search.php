<?php
/**
 * Search Results Template File
 *
 */
?>
<?php get_header(); ?>

<section class="wrap-main">
	<header class="header-bloc">
        <h1 class="h1">
           <?php 
               $count = $wp_query->found_posts;
               $post_id = $wp_query->ID;
               $several = ($count<=1) ? '' : 's'; //pluriel
            
               if ($count>0) : $output =  $count.' résultat'.$several.' pour la recherche';
               else : $output = 'Aucun résultat pour la recherche';
               endif;
               
               $output .= ' "<span class="terms_search">'. get_search_query() .'</span>"';
               
               echo $output;
               
             ?>        
        </h1>
	</header>
  

     
	<article class="fluxi-content wrap-search wrap-n">  
	<?php if ( have_posts() ) : ?>      
      
        <h2 class="h3">Votre recherche :</h2>
        <?php get_search_form(); ?>
      	<ul class="searchresults">
        	<?php while ( have_posts() ) : the_post(); 
				$the_post_type = get_post_type( $post_id );	
				$category_detail=get_the_category($post_id);
				$cat_count=0;		
			?>
            	<li class="searchresults__item">
                    <a class="searchresults__link" href="<?php the_permalink(); ?>">            
                        <h3 class="searchresults__title"><?php the_title(); ?></h3>
                    </a>                                           
                    <?php 
						// Img               
                        if ( has_post_thumbnail() ) {
                            echo '<a class="searchresults__img" href="'.get_the_permalink().'">';
                                the_post_thumbnail('medium');
                            echo '</a>';
                        }                    
                       /* // si on utilise le résumé alors on l'affiche
                        if( get_the_excerpt() != '' ) : 					
                            the_excerpt();        
                        // sinon on le crée à partir du contenu de l'article
                        else : 					
                            echo mb_substr( strip_tags( get_the_content() ), 0, 300, "UTF-8" ).'[&hellip;]';        
                        endif;*/
						if( get_field('google_description') ) : 
							echo '<p class="p-ss">'.get_field('google_description').'</p>';
						endif;
						
                    ?>
                    <span class="s-footer">
						<?php 	
							// Post type
							if($the_post_type == 'page'):
								echo '<a href="'.get_the_permalink().'">Page</a>';													
							elseif($the_post_type == 'projets'):
								echo '<a href="'.get_the_permalink(5560).'">Projet</a>';															
							endif;  
							
                            // Show category and link it                            
                            foreach($category_detail as $cd){
								$cat_count++;								
                                $cat_name = $cd->cat_name;
                                $cat_link = get_category_link( $cd->term_id );
								
                                ($cat_count > 1) ? print ', '  : '';
								
                                echo '<a href="'.esc_url( $cat_link ).'" title="'.$cat_name.'">';						
                                    echo $cat_name;						
                                echo '</a>';								
                            }
                        ?>           
                        <time datetime="<?php the_time('Y-m-d'); ?>"> - <?php the_time('l d F'); ?></time>   
                    </span>  
                </li>       
            
        	<?php endwhile; ?>   
        </ul>
        <?php
            $big = 999999999;
            echo '<div class="s-pagination">';
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'prev_text' => __('«'),
					'next_text' => __('»'),
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages
				) );
            echo '</div>';
			?>
        	
        <?php else :  // pas de résultats?>
        
            <h2 class="extrait-page">Navré mais votre recherche ne renvoie aucun résultat.</h2>
            <h3>Vous pouvez toujours retenter votre chance avec de nouveaux termes.</h3>
            <?php get_search_form(); ?>
        
      	<?php endif; ?>
    
    	</article>    
    </section>
<?php get_footer(); ?>
