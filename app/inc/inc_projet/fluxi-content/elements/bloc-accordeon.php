<div class="accordion">
    <h4 class="accordion__head"><span class="accordion__head__icon"><i class="icon-round-next"></i></span> <?php echo the_sub_field('entete_accordeon'); ?></h4>
    <div class="accordion__content">    
    <?php 
		while( have_rows('corps_accordeon') ): the_row(); 
		
			$sous_titre_accordeon = get_sub_field('sous_titre_accordeon');
			$contenu_accordeon = get_sub_field('contenu_accordeon');
			$image_accordeon = get_sub_field('image_accordeon');
			$image_size = 'medium';			
			
				if( $sous_titre_accordeon ):	
					echo '<h6 class="h6">'.$sous_titre_accordeon.'</h6>';
				endif;
				if( $image_accordeon ):				
					$image_accordeon = get_sub_field('image_accordeon'); 					
					echo '<img class="img_mini" src="'.$image_accordeon['sizes'][$image_size].'" alt="'.$image_accordeon['alt'].'" />';				
				endif;
				if( $contenu_accordeon ):	 
					echo $contenu_accordeon; 			
				endif;			
					 
		endwhile; 
	?>
    </div>
</div>


