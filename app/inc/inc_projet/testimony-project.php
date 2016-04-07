<h3 class="h3">Message du porteur de projet</h3>
        
	<div class="testimony box wrap-extend">
		<div class="box__half">															
			<div class="holder-round">
				<img src="<?php echo $portrait_pdp['sizes']['thumbnail']; ?>" alt="<?php echo get_field('prenom') . ' ' . get_field('nom'); ?>">
			</div>
		</div>
		<div class="box__half">
            <?php if(!empty(get_field('temoignage'))):?> 				
				<p class="p-ss"><?php echo get_field('temoignage'); ?></p>
            <?php endif; ?>  
            <h4><?php echo get_field('prenom') . ' ' . get_field('nom'); ?></h4>
		</div>									
	</div>