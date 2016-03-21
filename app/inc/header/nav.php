<nav class="nav">

  <ul class="nav__primary no-pp">
    <?php
    $main_menus = get_field('main_menu', 'option');
    if( $main_menus ): 
      foreach( $main_menus as $post_object):    
        $main_page_id = $post_object['main_page'];
        ?>
        <li class="nav__item"><span class="nav__item__title"><?php echo get_the_title($main_page_id); ?></span>
          <ul class="nav__dropdown">
            <span class="container">
              
              <?php 
                 wp_list_pages( array(
                    'title_li'    => '',
                    'depth'    => 1,
                    'child_of'    => $main_page_id
                ) );
              ?>

            </span>
          </ul>
        </li>      
      <?php 
      endforeach;    
    endif;
    ?>
  </ul>

  
    <?php    
    $secondary_menus = get_field('secondary_menu', 'option');
    if( $secondary_menus ):
      echo '<ul class="nav__secondary no-pp"> ';
        foreach( $secondary_menus as $post_object):    
          $main_page_id = $post_object['main_page'];
          ?>
          <li class="nav__item"><span class="nav__item__title"><?php echo get_the_title($main_page_id); ?></span>
            <ul class="nav__dropdown">
              <span class="container">
                <?php 
                   wp_list_pages( array(
                      'title_li'    => '',
                      'depth'    => 1,
                      'child_of'    => $main_page_id
                  ) );
                ?>
              </span>
            </ul>
          </li>      
        <?php 
        endforeach; 
      echo '</ul>';  
    endif;
    ?>
 

  <div class="nav__pp">
    <button type="button" class="hamburger js-toggle-pp"></button>
    <ul class="pp">
    </ul>
  </div>
</nav>
<div class="navbar__id">
  <a class="logo" href="<?php echo get_site_url(); ?>">
    <div class="logo__img">
    	<img src="<?php echo get_template_directory_uri(); ?>/app/img/logo-illu-energie-partagee.png">
    </div>
    <div class="logo__title">
    	<img src="<?php echo get_template_directory_uri(); ?>/app/img/logo-energie-partage.svg">    
    </div>
  </a>
  <ul class="navbar__id__social">
    <li><a href="#" class="social--face"><i class="icon-facebook_26"></i></a></li>
    <li><a href="#" class="social--twit"><i class="icon-twitter_26"></i></a></li>
    <li><a href="#" class="social--yout"><i class="icon-youtube_26"></i></a></li>
  </ul>  
</div>
<form method="get" id="nav__search" class="nav__search" action="<?php bloginfo('url'); ?>/">
	<label class="is-hidden" for="s"><?php _e('Recherche :'); ?></label>
  	<input type="text" class="nav__search__input js-search-input" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Recherche">
  	<input type="submit" class="nav__search__submit" value="" id="nav__search__submit">
  	<button type="button" class="nav__search__close js-toggle-search"></button>
</form>
<div class="navbar__buttons"> <a href="#" class="round-bt nav-bt"></a>
  <button type="button" class="round-bt nav-bt js-toggle-search"></button>
  <a href="#" class="round-bt nav-bt"></a>
</div>
