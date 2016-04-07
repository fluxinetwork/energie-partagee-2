<div class="following box">
  <div class="box__social">
    <?php get_socials(); ?>
  </div>
  <?php if($value_stade == 'onsuit'): ?>
      <div class="box__btn">
        <button type="button" class="button green cta"><i class="icon-heart_20"></i> Soutenir ce projet</button>
      </div>
  <?php elseif($value_stade=='collecte'): ?>
      <div class="box__btn">
        <button type="button" class="button green cta"><i class="icon-heart_20"></i> Soutenir ce projet</button>
      </div>
  <?php elseif($value_stade=='succes' && !empty($url_call_to_action)): ?>
      <div class="box__btn">
        <a href="<?php echo $url_call_to_action;?>" class="button green cta"><i class="icon-heart_20"></i> En savoir plus</a>
      </div>    
  <?php endif; ?>
</div>
<?php if($value_stade == 'onsuit' || $value_stade=='collecte'): ?>
<aside class="wrap-bg c-main">
  <div class="box">
    <div class="box__half">
      <h4 class="card__title">En investissant à son capital</h4>
      <p class="highlight-txt p-ss">La meilleure façon de soutenir ce projet est d’investir dans son capital (et toucher des interêts en retour).</p>
      <a href="<?php echo $url_call_to_action;?>" class="button"><i class="icon-euro_20"></i> Je souscris !</a>
    </div>
    <div class="box__half">
      <h4 class="card__title">En restant informé</h4>
      <p class="highlight-txt p-ss">Abonnez-vous à la newsletter de ce projet pour suivre son actualité et qui sait, un jour peut être, investir dans son capital !</p>
      <div class="input-n-btn">
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
