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
                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/ico-facebook.png"></a></li>
                   <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/ico-twitter.png"></a></li>
                   <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/ico-youtube.png"></a></li>
                </ul>    
            </div>
            <form class="box--half" method="post" action="http://ymlp.com/subscribe.php?id=gbuyheegmgb" target="_blank">
                <h2>Abonnement newsletter</h2> 
                <input class="in-contact" name="YMP0" id="nom_contact" type="email" value="" placeholder="Votre email ici" required aria-required="true">
                <button type="submit" class="button-round"><i>&radic;</i></button>
            </form>            
        </div>
        
        <h2>Nos partenaires</h2>
        <ul class="partenaires box-flex">
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-1.jpg"></a></li>
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-2.jpg"></a></li>
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-3.jpg"></a></li>
            <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-partenaire-4.jpg"></a></li>
            <li><a class="button-round" href="#"><i>+</i></a></li> 
        </ul>
        
        <h2>Nos labels</h2>
        <ul class="labels box-flex">
            <li class="labels--img"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-label-1.png"></a></li>
            <li class="labels--img"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/app/img/proto/logo-label-2.png"></a></li>
            <li class="labels--txt"><p>Energie Partagée a recu les labels Finansol et Agrément “entreprise solidaire” pour son activité engagée bla bla bla et bla bla bla.</p></li>
        </ul>
        
        <nav class="nav-footer">
        	<a href="#">Contact</a>
           <a href="#">Mentions légales </a>
           <a href="#">Crédits</a>
        </nav>
        
    </div>    
</footer>