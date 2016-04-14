<div class="following box">
  <div class="box__social">
    <?php get_socials('news'); ?>
  </div>
  <?php if($value_stade == 'onsuit'): ?>
      <div class="box__btn">
        <button type="button" class="button green cta has-icon"><i class="icon-heart_20"></i> En savoir plus</button>
      </div>
  <?php elseif($value_stade=='collecte'): ?>
      <div class="box__btn">
        <button type="button" class="button green cta has-icon"><i class="icon-heart_20"></i> Soutenir ce projet</button>
      </div>
  <?php elseif($value_stade=='succes' && !empty($url_call_to_action)): ?>
      <div class="box__btn">
        <a href="<?php echo $url_call_to_action;?>" class="button green cta has-icon"><i class="icon-heart_20"></i> En savoir plus</a>
      </div>    
  <?php endif; ?>
</div>

<?php if($value_stade == 'onsuit' || $value_stade=='collecte'): ?>
<aside class="action-projet wrap-bg c-main<?php if($value_stade=='collecte'){echo ' collecte';} ?>">
  <div class="action-projet__box">
    <div class="box-asy__left">
      <?php if($value_stade == 'onsuit'): ?>
        <h4>Écrire au porteur du projet </h4>
        <p>Obtenez plus d’informations et impliquez-vous dans la dynamique locale.</p>  
        <a href="mailto:<?php echo get_field('email');?>" class="button box-asy__clic"><i class="icon-pencil_20"></i> Écrire à <?php echo get_field('prenom');?></a>
      <?php else: ?>
        <h4>Investir à Énergie Partagée</h4>
        <p>Ce projet est financé par Énergie Partagée et ses souscripteurs. Il est ouvert à l’investissement citoyen.</p>
        <a href="<?php echo $url_call_to_action;?>" class="button box-asy__clic"><i class="icon-euro_20"></i> Je souscris !</a>
      <?php endif; ?>
    </div>

    <div class="box-asy__right">
      <?php if($value_stade == 'onsuit'): ?>
        <h4>Rester informé</h4>
        <p>Abonnez-vous et recevez les actualités de ce projet (avancement, ouverture à collecte).</p>
      <?php else: ?>
        <h4>Rester informé</h4>
        <p>Gardez le contact avec le projet et suivez ses actualités.</p>
      <?php endif; ?>  

      <div class="input-n-btn box-asy__clic">
        <form id="mailing_prospect" class="box" method="post">
          <div class="box__solo">
            <input class="input__mailing" name="mail_prospect" id="input_mailing" type="email" value="" placeholder="Votre email" required aria-required="true">
          </div>

          <input name="id_project" type="hidden" value="<?php echo get_the_ID(); ?>">
          <input name="name_project" type="hidden" value="<?php echo get_the_title(); ?>">
          <input name="city_project" type="hidden" value="<?php echo get_field('ville'); ?>">
          <input name="region_project" type="hidden" value="<?php echo get_field('departement'); ?>">
          <input name="thumb_url" type="hidden" value="<?php echo $thumb_url; ?>">
          <input name="toky_toky" type="hidden" value="3948517542">
          <?php wp_nonce_field( 'mailing_prospect', 'mailing_prospect_nonce_field' ); ?>

          <div class="box__fixe">
            <button type="submit" class="button-round"><i class="icon-check_64"></i></button>
          </div>
        </form>

        <div class="notify"></div>
      </div>
    </div>
  </div>
</aside>
<?php endif; ?>
