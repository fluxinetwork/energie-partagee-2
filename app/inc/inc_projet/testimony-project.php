<h3 class="h3">Message du porteur de projet</h3>
        
        <div class="testimony box wrap-extend">
			<div class="box__half">															
				<div class="holder-round" style="background-image:url('<?php echo $portrait_pdp['url']; ?>')"></div>
			</div>
			<div class="box__half">
            	<?php if(!empty(get_field('temoignage'))):?> 				
				<p class="p-ss"><span>"</span><?php echo get_field('temoignage'); ?><span>"</span></p>
              <?php endif; ?>  
              <h4><?php echo get_field('prenom') . ' ' . get_field('nom'); ?></h4>
			</div>									
		</div>