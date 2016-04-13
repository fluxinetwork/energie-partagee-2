<?php
	if(have_rows('bloc_publication')):	
		while( have_rows('bloc_publication') ): the_row(); 
			$image_publication = get_sub_field('image_publication');
			$titre_publication = get_sub_field('titre_publication');
			$descriptif_publication = get_sub_field('descriptif_publication');
			$url_publication = get_sub_field('url_publication');
			?>
			
			<h3 class="h3"><?php echo $titre_publication; ?></h3>
			<div class="img__left">
				<a target="_blank" title="Consulter la publication" href="<?php echo $url_publication; ?>"><img alt="<?php echo $titre_publication; ?>" src="<?php echo $image_publication['sizes']['medium']; ?>" class="img_med">
				</a>
				<p><?php echo $descriptif_publication; ?></p>
			</div>
			<a target="_blank" title="Consulter la publication" href="<?php echo $url_publication; ?>" class="f-btn __big">
				<i class="icon-download_64"></i>
				<div>
					<span class="txt">Consulter la publication</span>
				</div>
			</a>

			<?php							 
		endwhile; 
	endif;	
?>
   


