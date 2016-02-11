<nav class="nav" role="navigation">
  <ul class="main-nav">
    <?php 				
				// Main menu		
				
				wp_nav_menu( array(
					'theme_location'    => 'main-menu',
					'container'     => '',
					'menu_class'        => 'menu main-menu menu-depth-0 menu-even', 
					'echo'          => true,
					'items_wrap'        => '%3$s',
					'depth'         => 10, 
					'walker'        => new themeslug_walker_nav_menu
				) ); 
			?>
  </ul>
  <ul class="nav-patern">
    <?php			
				// Main menu patern				
					
				wp_nav_menu( array(
					'theme_location'    => 'main-menu-patern',
					'container'     => '',
					'menu_class'        => 'menu main-menu-patern menu-depth-0 menu-even', 
					'echo'          => true,
					'items_wrap'        => '%3$s',
					'depth'         => 10, 
					'walker'        => new themeslug_walker_nav_menu
				) ); 			
			?>
    <li class="mini-btn"> <a href="<?php echo wp_logout_url( home_url() ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/ico-contact.png"></a> </li>
    <li class="mini-btn"> <a href="<?php echo wp_logout_url( home_url() ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/ico-search.png"></a> </li>
    <li class="mini-btn">
      <?php if ( is_user_logged_in() ) {  ?>
      <a href="<?php echo wp_logout_url( home_url() ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/ico-deco-adherent.png"></a>
      <?php } else{ ?>
      <a href="<?php echo get_bloginfo('url'); ?>/wp-login.php"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/ico-adherent.png"></a>
      <?php } ?>
    </li>
  </ul>
</nav>
