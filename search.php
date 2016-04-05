<?php
/**
 * Search Results Template File
 *
 */
?>
<?php get_header(); ?>

<section class="wrap-main">
	<header class="header-bloc">
        <ul class="tags">     
            <li class="tag has-pointer js-toggle-search">Recherche</li>
            <li class="tag is-inactive"><?php echo get_search_query(); ?></li>     
        </ul>    
        <h1 class="h1">
           <?php 
               $count = $wp_query->found_posts;
               $post_id = $wp_query->ID;
               $several = ($count<=1) ? '' : 's'; //pluriel
            
               if ($count>0) : $output =  $count.' résultat'.$several;
               else : $output = 'Aucun résultat';
               endif;

               echo $output;
             ?>        
        </h1>
	</header>
  

     
	<article class="fluxi-content wrap-search fluxi-wrap">  
	<?php if ( have_posts() ) : ?>      
      
        <h2 class="h3">Votre recherche :</h2>
        
        <form method="get" id="searchform" class="searchform" action="<?php bloginfo('url'); ?>/">
          <p>    
            <label for="s"><?php _e('Recherche :'); ?></label>       
            <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
            <input type="submit" id="searchsubmit" class="searchsubmit" value="Rechercher" />
          </p>
          <p>  
            <label class="filter-lm" for="cat"><?php _e('Filtrer par : '); ?></label> 
          <?php wp_dropdown_categories('show_option_none=Ne pas filtrer&hide_empty=1&exclude=1&orderby=name'); ?>
          </p>
        </form>

      	<ul class="searchresults">
        	<?php while ( have_posts() ) : the_post(); 
    				$the_post_type = get_post_type( $post_id );	
    				$category_detail=get_the_category($post_id);
    				$cat_count=0;		
    			?>
            	<li class="searchresults__item">
                    <ul class="tags">
                      <?php   
                          // Post type
                          if($the_post_type == 'page'):
                            echo '<li class="tag"><a href="'.get_the_permalink().'">Page</a></li>';                          
                          elseif($the_post_type == 'projets'):
                            echo '<li class="tag"><a href="'.get_the_permalink(5560).'">Projet</a></li>';                              
                          endif;  
            
                          // Show category and link it                            
                          foreach($category_detail as $cd){
                              $cat_count++;               
                              $cat_name = $cd->cat_name;
                              $cat_link = get_category_link( $cd->term_id );
              
                              //($cat_count > 1) ? print ', '  : '';
              
                              echo '<li class="tag"><a href="'.esc_url( $cat_link ).'" title="'.$cat_name.'">';           
                                  echo $cat_name;           
                              echo '</a></li>';                
                          }
                      ?>           
                      <li class="tag is-inactive"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('l d F'); ?></time></li>
                    </ul>  
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
                      // Description       
            						if( get_field('google_description') ) : 
            							echo '<p>'.get_field('google_description').'</p>';
            						endif;
						
                    ?>
                </li>       
            
        	<?php endwhile; ?>   
        </ul>
        <?php
            $big = 999999999;
            echo '<div class="s-pagination">';
    				echo paginate_links( array(
    					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    					'format' => '?paged=%#%',
    					'current' => max( 1, get_query_var('paged') ),
    					'total' => $wp_query->max_num_pages,
              'prev_next'=> false
    				) );
            echo '</div>';
			?>
        	
        <?php else :  // pas de résultats?>
        
            <h2 class="extrait-page">Votre recherche ne renvoie aucun résultat.</h2>
            <h3>Vous pouvez toujours retenter votre chance avec de nouveaux termes.</h3>
            <?php get_search_form(); ?>
        
      	<?php endif; ?>
    
    	</article>    
    </section>
<?php get_footer(); ?>
