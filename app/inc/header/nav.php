<nav class="nav is-hidden">

  <ul class="nav__primary no-pp">
  
    <?php if ( is_user_logged_in() ) :  ?>
      <li class="nav__item"><span class="nav__item__title">Espace adhérent</span>
        <ul class="nav__dropdown">
          <span class="container">              
            <?php 
              wp_list_pages( array(
                'title_li' => '',
                'depth'    => 1,
                'child_of' => get_id_by_slug('espace-adherent')
              ));
            ?>
          </span>
        </ul>
      </li>
    <?php endif; ?>

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
    <button type="button" class="hamburger js-toggle-pp icon-hamburger_32"></button>
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
    <li><a href="https://www.facebook.com/pages/Energie-Partag%C3%A9e/376460652377147" class="social--face" target="_blank"><i class="icon-facebook_26"></i></a></li>
    <li><a href="https://twitter.com/EnergiePartagee" class="social--twit" target="_blank"><i class="icon-twitter_26"></i></a></li>
    <li><a href="https://www.youtube.com/channel/UC0MX3OTOOwM5V20L3FZ5wwg" class="social--yout" target="_blank"><i class="icon-youtube_26"></i></a></li>
  </ul>  
</div>
<form method="get" id="nav__search" class="nav__search" action="<?php bloginfo('url'); ?>/">
	<label class="is-hidden" for="s"><?php _e('Recherche :'); ?></label>
  	<input type="text" class="nav__search__input js-search-input" value="" name="s" id="s" placeholder="<?php if (is_search()) : the_search_query(); else : echo 'Rechercher'; endif; ?>">
  	<button type="submit" class="nav__search__submit icon-check_32 nav-bt" value="" id="nav__search__submit"></button>
  	<button type="button" class="nav-bt nav__search__close js-toggle-search icon-close_32"></button>
</form>
<div class="navbar__buttons">
  <?php
  $icon;
  $url;
  if (is_user_logged_in()) {
    $icon = 'icon-logout_32';
    $url = wp_logout_url(home_url());
    $txt = 'Déconnexion';
  } else {
    $icon = 'icon-adherents_32';
    $url = get_bloginfo('url');
    $txt = 'Adhérents';
  }
  ?>
  <button type="button" class="nav-bt js-toggle-search icon-search_32"></button>
  <a href="<?php echo $url; ?>/wp-login.php" class="nav-bt--txt <?php echo $icon; ?>"><span><?php echo $txt; ?></span></a>
</div>
