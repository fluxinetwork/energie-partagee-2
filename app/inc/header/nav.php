<nav class="nav" role="navigation">
    <ul>
    		<?php 				
				// Main menu WP				
				//wp_nav_menu( array( 'container' => '', 'theme_location' => 'main-menu', 'items_wrap' => '%3$s', 'walker' => new Custom_Walker_Nav_Menu()/*, 'link_after' => '<span class="sep">|</span>'*/ ) ); 
				
				wp_nav_menu( array(
					'theme_location'    => 'main-menu',
					'container'     => '',
					'menu_class'        => 'menu main-menu menu-depth-0 menu-even', 
					'echo'          => true,
					'items_wrap'        => '%3$s',
					'depth'         => 10, 
					'walker'        => new themeslug_walker_nav_menu
				) ); // thanks nick				
								
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