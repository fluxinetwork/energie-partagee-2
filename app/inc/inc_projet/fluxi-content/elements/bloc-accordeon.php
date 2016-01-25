<div class="accord">
    <h3 class="head-accord"><span>+</span> <?php echo the_sub_field('entete_accordeon'); ?></h3>
    <div class="content-accord hide-item">    
    <?php 
		while( have_rows('corps_accordeon') ): the_row(); 
		
			$sous_titre_accordeon = get_sub_field('sous_titre_accordeon');
			$contenu_accordeon = get_sub_field('contenu_accordeon');
			$image_accordeon = get_sub_field('image_accordeon');
			$image_size = 'medium';
			
			if( $image_accordeon ):
				echo '<div class="blocs-contenu bloc-img">';
			else:
				echo '<div class="blocs-contenu">';
			endif;	
			
				if( $sous_titre_accordeon ):	
					echo '<h4>'.$sous_titre_accordeon.'</h4>';
				endif;
				if( $image_accordeon ):				
					$image_accordeon = get_sub_field('image_accordeon'); 					
					echo '<img src="'.$image_accordeon['sizes'][$image_size].'" alt="'.$image_accordeon['alt'].'" />';				
				endif;
				if( $contenu_accordeon ):	 
					echo $contenu_accordeon; 			
				endif;	
			echo '</div>';				
					 
		endwhile; 
	?>
    </div>
</div>


