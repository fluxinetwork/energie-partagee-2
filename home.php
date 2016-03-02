<?php get_header(); ?>

	<section class="section header-bloc">
    	<article class="wrap-l">
            <h1 class="h1">Investissons les énergies renouvelables</h1>
            <ul class="key-nums">
              <li class="key-nums__item"><span class="key-nums__item__num">5000</span> actionnaires<br>citoyens</li>
              <li class="key-nums__item"><span class="key-nums__item__num">25</span> projets locaux<br>financés</li>
              <li class="key-nums__item"><span class="key-nums__item__num">+10</span> millions d’euros<br>collectés</li>      
            </ul>
            <a href="#" class="button">Comprendre notre action</a>
        </article>
	</section>
    
    <?php include( TEMPLATEPATH.'/app/inc/inc_projet/sticky-post.php' ); ?>
    
    <section class="section wrap-l steps-intro">
        <h5 class="s-title">Énergie partagée en 3 étapes</h5>
        <ul class="box box-flex">
            <li class="box__item">
                <div class="box__item__img"><img src="<?php echo get_template_directory_uri(); ?>/app/img/voir-les-projets.png"></div>         		
                <p class="p-ss">Des projets citoyens d'énergie renouvelable émergent partout en France.</p>        
                <a class="link" href="#">Voir les projets</a>
            </li>
            <li class="box__item">
                <div class="box__item__img"><img src="<?php echo get_template_directory_uri(); ?>/app/img/devenir-actionnaire.png"></div>	
                <p class="p-ss">Énergie Partagée les accompagne et vous propose d'investir dans ces projets.</p>
                <a class="link" href="#">Devenir actionnaire</a>
            </li>   
            <li class="box__item">
                <div class="box__item__img"><img src="<?php echo get_template_directory_uri(); ?>/app/img/comment-ca-marche.png"></div>
                <p class="p-ss">Energie verte, lutte contre l’effet de serre et revenus pour les actionnaires à la clé.</p>
                <a class="link" href="#">Comment ça marche ?</a>
            </li>
        </ul>
    </section>
    
    <?php include( TEMPLATEPATH.'/app/inc/inc_projet/trio-projects.php' ); ?>
    
    <?php include( TEMPLATEPATH.'/app/inc/inc_projet/duo-news.php' ); ?>
    
    <?php include( TEMPLATEPATH.'/app/inc/inc_projet/court-circuit.php' ); ?>
    
    <?php include( TEMPLATEPATH.'/app/inc/inc_projet/top-credibility.php' ); ?>        

<?php get_footer(); ?>