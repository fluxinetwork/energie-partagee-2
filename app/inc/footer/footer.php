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

<footer class="footer">
    <div class="wrap-n">
    	<div class="box-flex">
            <div class="box--half">
                <h2>Nous suivre</h2>
                <ul class="social">
                    <li><a href="#" class="social--face"><i class="icon-facebook"></i></a></li>
                   <li><a href="#" class="social--twit"><i class="icon-twitter"></i></a></li>
                   <li><a href="#" class="social--yout"><i class="icon-youtube"></i></a></li>
                </ul>    
            </div>
            <form class="box--half" method="post" action="http://ymlp.com/subscribe.php?id=gbuyheegmgb" target="_blank">
                <h2>Abonnement newsletter</h2>
                <div class="box-flex"> 
                <div class="box--solo"><input class="courtcircuit--input" name="YMP0" id="newsletter_footer" type="email" value="" placeholder="Votre email" required aria-required="true"></div>
                <div class="box--fixe">
                <button type="submit" class="button-round"><i class="icon-round-check"></i></button>
                </div>
                </div>
            </form>            
        </div>
        
        <h2>Nos partenaires</h2>
        <ul class="box-logos box-flex">
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-1.jpg"></a></li>
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-2.jpg"></a></li>
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-3.jpg"></a></li>
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-4.jpg"></a></li>
            <li><a class="button-round" href="#"><i class="icon-round-plus"></i></a></li> 
        </ul>
        
        <h2>Nos labels</h2>
        <ul class="labels box-flex">
            <li class="labels--img">
            	<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-label-1.png"></a>
              <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-label-2.png"></a>
            </li>
            <li class="labels--txt"><p>Energie Partagée a recu les labels Finansol et Agrément “entreprise solidaire” pour son activité engagée bla bla bla et bla bla bla.</p></li>
        </ul>
        
        <nav class="nav-footer">
        	<a href="#">Contact</a>
           <a href="#">Mentions légales </a>
           <a href="#">Crédits</a>
        </nav>
        
    </div>    
</footer>