<?php 

$type_galerie = get_sub_field('type_galerie');
$galerie = get_sub_field('galerie');

if( $galerie ): 

	if($type_galerie=='galerie_damier'):    
        echo '<div class="galerie '.$type_galerie.'">';
			foreach( $galerie as $image ):			
				  echo '<a href="'.$image['sizes']['large'].'" data-sub-html="'.$image['caption'].'">';
				   echo '<img src="'.$image['sizes']['thumbnail'].'" alt="'.$image['alt'].'" />';			   
				  echo '</a>';
            endforeach;
        echo '</div>';   
	
	elseif($type_galerie=='galerie_vignettes'):
		echo '<div class="galerie '.$type_galerie.'">';
			echo '<ul class="'.$type_galerie.'">';
				foreach( $galerie as $image ):         
					echo '<li data-thumb="'.$image['sizes']['thumbnail'].'" data-src="'.$image['sizes']['large'].'" data-sub-html="'.$image['caption'].'">';
						echo '<img src="'.$image['sizes']['medium'].'" alt="'.$image['alt'].'" />';
					echo '</li>';         
				endforeach;       
			echo '</ul>';
		echo '</div>';
	else:
		echo '<div class="galerie '.$type_galerie.'">';
			echo '<ul class="'.$type_galerie.'">';
				foreach( $galerie as $image ):         
					echo '<li data-thumb="'.$image['sizes']['thumbnail'].'" data-src="'.$image['sizes']['large'].'" data-sub-html="'.$image['caption'].'">';
						echo '<img src="'.$image['sizes']['medium'].'" alt="'.$image['alt'].'" />';
					echo '</li>';         
				endforeach;       
			echo '</ul>';
		echo '</div>';
	endif;



endif; 
?>