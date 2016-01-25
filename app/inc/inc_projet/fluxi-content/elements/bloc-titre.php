<?php
		
	$taille_titre = get_sub_field('taille_titre');
	$texte_titre = get_sub_field('texte_titre');
	$align_titre = get_sub_field('align_titre');
	
	echo '<h'.$taille_titre.' class="'.$align_titre.'">'.$texte_titre.'</h'.$taille_titre.'>';
	
?>