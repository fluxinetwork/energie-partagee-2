<nav class="nav" role="navigation">
    <ul>
    		<?php 				
				// Main menu WP		
				
				wp_nav_menu( array(
					'theme_location'    => 'main-menu',
					'container'     => '',
					'menu_class'        => 'menu main-menu menu-depth-0 menu-even', 
					'echo'          => true,
					'items_wrap'        => '%3$s',
					'depth'         => 10, 
					'walker'        => new themeslug_walker_nav_menu
				) ); 
				
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
            
            
            <li>
				<?php if ( is_user_logged_in() ) {  ?>
                	<a href="<?php echo wp_logout_url( home_url() ); ?>">Déconnexion</a>
                <?php } else{ ?>
                	<a href="<?php echo get_bloginfo('url'); ?>/wp-login.php">Se connecter</a>
                <?php } ?>
            </li>
            
	</ul>	
</nav>