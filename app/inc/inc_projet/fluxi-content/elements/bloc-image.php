<?php 
	
	$type_dimage = get_sub_field('type_dimage');
	$image_only = get_sub_field('image');
	
	echo '<a href="'.$image_only['sizes']['large'].'" class="lightbox"><img class="img-responsive" src="'.$image_only['sizes']['large'].'" alt="'.$image_only['alt'].'" /></a>';
			
	if($type_dimage == 'image_legende'):
		$legende = get_sub_field('legende');					
		echo '<p class="legend">'.$legende.'</p>';
	endif;			 
		
?>
