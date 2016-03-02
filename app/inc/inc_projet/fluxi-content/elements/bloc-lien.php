<?php

	$legende = '';
	$description = '';
	$icon = '';	
	$class_link =  '';
	
	$type_link = get_sub_field('type_lien');
	$target_link = get_sub_field('cible_lien');
	$texte_link = get_sub_field('texte_lien');		
	
	if($type_link == 'fichier-interne'):
		$file = get_sub_field('url_fichier');
		$url_link = $file['url'];
		$legende = '<br><span class="legend">'.$file['caption'].'</span>';
		$description = $file['description'];
		$icon = '<i class="icon-round-next"></i>';
		
	elseif($type_link == 'fichier-externe'):
		$url_link = get_sub_field('url_lien');
		$target_link = '_blank';
		$icon = '<i class="icon-round-next"></i>';
		
	elseif($type_link == 'lien-page' || $type_link == 'bouton-page'):			
		$url_link = get_sub_field('lien_page');
		$icon = '<i class="icon-round-next"></i>';	
		
	elseif($type_link == 'lien-mailto' || $type_link == 'bouton-mailto'):	
		$url_link = get_sub_field('add_mailto');
		$url_link = 'mailto:'.$url_link;
		$target_link = '_blank';
		$icon = '<i class="icon-round-next"></i>';	
				
	else:
		$url_link = get_sub_field('url_lien');
		
	endif;
	
	
	if( $type_link == 'bouton' || $type_link == 'bouton-mailto' || $type_link == 'bouton-page' ):
		$class_link = 'link link-picto';	
		
	else:
		$class_link = 'link';	
	endif;	
	
		
	if($type_link):	
	
		echo '<div class="fluxi-link">';
			echo $icon;
			echo '<a class="'.$class_link.'" href="'.$url_link.'" title="'.$texte_link.'" target="'.$target_link.'">'.$texte_link.$legende.'</a>';
			
		echo '</div>';		
		
	endif;
?>