<?php  
global $current_user;
get_currentuserinfo();		
		
if ( is_user_logged_in() ) :
	if (is_page()||is_single()) :
		if($current_user->user_login=='Adherent') :
			else : echo '<div class="edit"><a class="link" href="'.get_edit_post_link().'">Editer</a></div>';
		endif;				
	endif;
endif;
		