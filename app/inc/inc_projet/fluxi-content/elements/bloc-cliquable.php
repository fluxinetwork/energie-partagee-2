<?php

	$type_de_cliquable = get_sub_field('type_de_cliquable');
	
 	if($type_de_cliquable):
		echo '<ul class="clikable '.$type_de_cliquable.'">';
		while( have_rows('module_cliquable') ): the_row(); 
			$image_du_cliquable = get_sub_field('image_du_cliquable');
			$titre_du_cliquable = get_sub_field('titre_du_cliquable');
			$texte_du_cliquable = get_sub_field('texte_du_cliquable');
			$url_du_cliquable = get_sub_field('url_du_cliquable');				
			$texte_bouton = get_sub_field('texte_bouton');
			$info_suppl = get_sub_field('info_suppl');
			$open_new_page = get_sub_field('open_new_page');			
			
			
			
			echo '<li>';
				echo '<a href="'.$url_du_cliquable.'" target="'.$open_new_page.'">';
				
					if($type_de_cliquable=='menu_btns'):
						// Mini menu
						if($texte_bouton):
							echo $texte_bouton;
						endif;
					
					else:
						// Box + Txt | Box + img + Txt					
						if($type_de_cliquable=='img_n_txt'):								
							echo '<img src="'.$image_du_cliquable['sizes']['medium'].'" alt="'.$image_du_cliquable['alt'].'" />';		
						endif;
						if($titre_du_cliquable):
							echo '<h4>'.$titre_du_cliquable.'</h4>';		
						endif;
						echo '<p>'.$texte_du_cliquable;
							if($texte_bouton && $type_de_cliquable == 'btn_n_txt'):
								echo '<span class="btn"><i>'.$texte_bouton.'</i></span>';
							endif;
							if($info_suppl && $type_de_cliquable == 'img_n_txt'):
								echo '<span class="txt-btn">'.$info_suppl.'</span>';
							endif;
						echo '</p>';
					endif;		
			
				echo '</a>';
			echo '</li>';		
			
						 
		endwhile; 
		echo '</ul>';
	endif;
?>
   


