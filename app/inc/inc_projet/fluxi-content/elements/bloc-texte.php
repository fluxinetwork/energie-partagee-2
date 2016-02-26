<?php 
	
	$type_de_texte = get_sub_field('type_de_texte');
	$texte = get_sub_field('texte');
	
	if($type_de_texte == 'texte_fond'):
		echo '<div class="text__bg">'.$texte.'</div>';
	else:
		echo ''.$texte.'';
	endif;
				
					 
		
?>
