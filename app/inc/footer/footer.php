<?php 
/**
 * Add custom body class
 */

$bodyclass = '';

// Browser detection using plugin : https://fr.wordpress.org/plugins/php-browser-detection/
if ( function_exists('is_mobile') ) {
	is_mobile() ? $bodyclass .= ' is-mobile' : $bodyclass .= ' is-desktop';
}
?>

<footer class="footer section">
    <div class="wrap-n">
    	<div class="box">
            <div class="box__half">
                <h5 class="s-title">Nous suivre</h5>
                <ul class="social">
                   <li><a href="#" class="social--face"><i class="icon-facebook_40"></i></a></li>
                    <li><a href="#" class="social--twit"><i class="icon-twitter_40"></i></a></li>
                    <li><a href="#" class="social--yout"><i class="icon-youtube_40"></i></a></li>
                </ul>    
            </div>
            <form class="box__half" method="post" action="http://ymlp.com/subscribe.php?id=gbuyheegmgb" target="_blank">
                <h5 class="s-title">Abonnement newsletter</h5>
                <div class="box"> 
                    <div class="box__solo"><input class="courtcircuit__input" name="YMP0" id="newsletter_footer" type="email" value="" placeholder="Votre email" required aria-required="true"></div>
                    <div class="box__fixe"><button type="submit" class="button-round"><i class="icon-check_64"></i></button></div>
                </div>
            </form>            
        </div>
        
        <h5 class="s-title">Nos partenaires</h5>
        <ul class="box-logos box">
            <li class="box-logos__item"><a class="box-logos__logo" href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-1.jpg"></a></li>
            <li class="box-logos__item"><a class="box-logos__logo" href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-2.jpg"></a></li>
            <li class="box-logos__item"><a class="box-logos__logo" href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-3.jpg"></a></li>
            <li class="box-logos__item"><a class="box-logos__logo" href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-4.jpg"></a></li>
            <li class="box-logos__btn"><a class="button-round" href="#"><i class="icon-plus_64"></i></a></li> 
        </ul>
        
        <h5 class="s-title">Nos labels</h5>
        <ul class="labels box">
            <li class="labels__img">
            	<a class="labels__label" href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-label-1.png"></a>
              <a class="labels__label" href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-label-2.png"></a>
            </li>
            <li class="labels__txt"><p class="p-ss">Energie Partagée a recu les labels Finansol et Agrément “entreprise solidaire” pour son activité engagée bla bla bla et bla bla bla.</p></li>
        </ul>
        
        <nav class="footer__nav">
        	<a class="link" href="#">Contact</a>
           <a class="link" href="#">Mentions légales </a>
           <a class="link" href="#">Crédits</a>
        </nav>
        
    </div>    
</footer>