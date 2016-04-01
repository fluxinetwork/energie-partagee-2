<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<section class="wrap-main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

	$main_image_obj = get_field( 'main_image' );
	$main_image ='';

	if ( has_post_thumbnail() && empty($main_image_obj)) :
		$post_img_id = get_post_thumbnail_id();
		$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
		$post_img_url = $post_img_array[0];

		$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$post_img_url.'"></div>';
	elseif(!empty($main_image_obj)):

		$main_image = '<div class="wrap-extend"><img class="img-responsive" src="'.$main_image_obj['url'].'"></div>';
	endif;

  ?>
  <header class="header-bloc">
    
    <?php custom_breadcrumbs(); ?>
    
    <h1 class="h1 wrap-n">
      <?php the_title(); ?>
    </h1>
  </header>
  <article class="fluxi-content fitvids wrap-n">
		<form class="cmxform" action="" method="post" id="contact_ep" name="contact_ep">
        <fieldset>      
          <legend class="section-title h3">Ou envoyer un message par ce formulaire</legend>  

          <p>
            <label for="prenom">Prénom:<abbr class="require-form" title="obligatoire">*</abbr></label>
            <input name="prenom" id="prenom" type="text" value="<?php if(!empty($_SESSION['prenom'])) echo $_SESSION['prenom']; ?>">
          </p>
          <p>
            <label for="nom">Nom:<abbr class="require-form" title="obligatoire">*</abbr></label>
            <input name="nom" id="nom" type="text" value="<?php if(!empty($_SESSION['nom'])) echo $_SESSION['nom']; ?>">
          </p>
          <p>
            <label for="email">Email:</label>
            <input name="email" id="email" type="email" value="<?php if(!empty($_SESSION['email'])) echo $_SESSION['email']; ?>">
          </p>
          <p>
            <label for="sujet">Sujet:<abbr class="require-form" title="obligatoire">*</abbr></label>
            <span class="wrap-input-select--left">
                <input type="text" class="ghost"></input>
              <select name="sujet" id="sujet">
                <option value="">Sélectionnez</option>
                <option value="Signaler un projet citoyen">Signaler un projet citoyen</option>
                <option value="Informations sur la souscription">Informations sur la souscription</option>
                <option value="Devenir relais">Devenir relais</option>
                <option value="Autres">Autre</option>
              </select>     
            </span>      
            <label for="sujet" class="error"></label>
          </p>
          <p>
            <label for="autres_sujet">Si "Autres", veuillez préciser:</label>
            <input name="autres_sujet" id="autres_sujet" type="text" value="<?php if(!empty($_SESSION['autres_sujet'])) echo $_SESSION['autres_sujet']; ?>">
          </p>
          <p>
            <label for="message">Message:<abbr class="require-form" title="obligatoire">*</abbr></label>
            <textarea name="message" id="message"><?php if(!empty($_SESSION['message'])) echo $_SESSION['message']; ?></textarea>
          </p>
          <input name="nom_token" type="hidden" value="5468472">
        </fieldset>
        <div class="btns-form">
        	<div class="notification"></div>
          <button type="submit" id="submit" class="button green">Envoyer</button>
        </div>
      </form>

	</article>
  <?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>