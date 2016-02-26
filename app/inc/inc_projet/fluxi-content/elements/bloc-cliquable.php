<?php

	$type_de_cliquable = get_sub_field('type_de_cliquable');
	
 	if($type_de_cliquable):
		
		if($type_de_cliquable!='img_n_txt'):
	
			echo '<aside class="clikarde '.$type_de_cliquable.'">';
		
		endif;
		
		while( have_rows('module_cliquable') ): the_row(); 
			$image_du_cliquable = get_sub_field('image_du_cliquable');
			$titre_du_cliquable = get_sub_field('titre_du_cliquable');
			$texte_du_cliquable = get_sub_field('texte_du_cliquable');
			$url_du_cliquable = get_sub_field('url_du_cliquable');				
			$texte_bouton = get_sub_field('texte_bouton');
			$info_suppl = get_sub_field('info_suppl');
			$open_new_page = get_sub_field('open_new_page');			
			
			
			if($type_de_cliquable!='img_n_txt'):
			
				echo '<article class="clikarde__item">';
					echo '<a class="minicard" href="'.$url_du_cliquable.'" target="'.$open_new_page.'">';
					
						if($type_de_cliquable=='menu_btns'):
							// Mini menu
							if($texte_bouton):
								echo $texte_bouton;
							endif;
						
						else:
							
							if($titre_du_cliquable):
								echo '<h4 class="clikable__title">'.$titre_du_cliquable.'</h4>';		
							endif;
							
							echo '<p class="p-ss">'.$texte_du_cliquable.'</p>';
							
							if($type_de_cliquable == 'btn_n_txt'):
								echo '<span class="link"><i class="icon-round-next"></i>'.$texte_bouton.'</span>';
							endif;	
													
						endif;		
				
					echo '</a>';
				echo '</article>';	
			
			else:
			
				echo '<aside class="clikable wide">
							<article class="wrap-space box">
								<div class="box__half">															
									<div class="holder-round" style="background-image:url('.$image_du_cliquable['sizes']['medium'].')"></div>
								</div>
								<div class="box__half">
									<h4 class="clikable__title">'.$titre_du_cliquable.'</h4>
									<p class="p-ss">'.$texte_du_cliquable.'</p>
									<a class="button green"><i></i>'.$texte_bouton.'</a>
								</div>									
							</article>
						</aside>';
			endif;
						 
		endwhile; 
		
		
		if($type_de_cliquable!='img_n_txt'):
	
			echo '</aside>';
		
		endif;
		
	endif;
?>
   


