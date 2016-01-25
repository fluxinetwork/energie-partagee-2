<?php

	$type_lien = get_sub_field('type_lien');
	$target_lien = get_sub_field('cible_lien');
	$texte_lien = get_sub_field('texte_lien');
	$class_lien =  '';
	
	if($type_lien == 'fichier-interne'):
		$url_lien = get_sub_field('url_fichier');
	elseif($type_lien == 'fichier-externe'):
		$url_lien = get_sub_field('url_lien');
		$target_lien = '_blank';
	elseif($type_lien == 'lien-page' || $type_lien == 'bouton-page'):			
		$url_lien = get_sub_field('lien_page');	
	elseif($type_lien == 'lien-mailto' || $type_lien == 'bouton-mailto'):	
		$url_lien = get_sub_field('add_mailto');
		$url_lien = 'mailto:'.$url_lien;
		$target_lien = '_blank';			
	else:
		$url_lien = get_sub_field('url_lien');
	endif;
	
	
	if( $type_lien == 'bouton' || $type_lien == 'bouton-mailto' || $type_lien == 'bouton-page' ):
		$class_lien = ' al-c';
	endif;		
		
	
	if($type_lien):
		echo '<p class="fluxi-link'.$class_lien.'"><a class="'.$type_lien.'" href="'.$url_lien.'" title="'.$texte_lien.'" target="'.$target_lien.'">'.$texte_lien.'</a></p>';
	endif;
?>