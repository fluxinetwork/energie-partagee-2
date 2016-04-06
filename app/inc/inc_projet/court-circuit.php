
<?php if(is_home()){ echo '<article class="courtcircuit">'; }else{ echo '<aside class="courtcircuit wrap-extend">';}?>
  <div class="courtcircuit__title"> <span class="courtcircuit__decoleft"><img class="img-svg" src="<?php echo get_template_directory_uri(); ?>/app/img/deco-left.svg"></span> <span class="courtcircuit__logo"><img class="img-svg" src="<?php echo get_template_directory_uri(); ?>/app/img/court-circuit.svg"></span> <span class="courtcircuit__decoright"><img class="img-svg" src="<?php echo get_template_directory_uri(); ?>/app/img/deco-right.svg"></span> </div>
  <form class="wrap-n" method="post" action="http://ymlp.com/subscribe.php?id=gbuyheegmgb" target="_blank">
    <div class="box">
      <div class="box__half">
        <h6 class="courtcircuit__text">Abonnez-vous a Court-Circuit, la newsletter d’Energie Partagée.</h6>
      </div>
      <div class="box__half input__fixe">
        <input class="courtcircuit__input" name="YMP0" id="courtcircuit_contact" type="email" value="" placeholder="Votre email" required aria-required="true">
      </div>
      <div class="box__fixe">
        <button type="submit" class="button-round"><i class="icon-check_64"></i></button>
      </div>
    </div>
  </form>
</<?php if(is_home()){ echo 'article'; }else{ echo 'aside';}?>>
