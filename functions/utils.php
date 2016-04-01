<?php

/* | Utils - V1.0 - 20/01/16 | 
--------------------------------
	| notify_by_mail()
   | fluxi_register_post_type()
   | get_sanitize_string()
*/

/* SIMPLE MAIL */

// ********************************
// Envoie du mail de notification 
// notify_by_mail ();
//  - destinataires : array('mail@destinataire.com', 'mail@destinataire.com')
//  - from : (string) : Ex : Energie Partagée <contact@energie-partagee.org>
//	- sujet : (string)
//	- contenu html externe : false ou true
//	- True : url vers le template mail / False : contenu (string)
//  - variables

function notify_by_mail ( $mail_to, $mail_from, $subject, $mode_content, $content_html, $vars ) {

	$multiple_to_recipients = $mail_to;				
	$headers = 'From: '. $mail_from . "\r\n";
	$sujet_mail = $subject;  
	
	$contenu_mail;
	
	if($mode_content==true):
	
		// contenu du mail dans page externe
		// le contenu du mail doit être définit par la var $contenu_mail dans la page externe.
		include ($content_html);
		
	else : $contenu_mail = $content_html;
	endif;		
																	
	add_filter( 'wp_mail_content_type', 'set_html_content_type_mail' );							
	wp_mail( $multiple_to_recipients, $sujet_mail, $contenu_mail, $headers);
	remove_filter( 'wp_mail_content_type', 'set_html_content_type_mail' );		
}

function set_html_content_type_mail() {							
	return 'text/html';
}

/**********************************
 * Create a custom post type
 */
function fluxi_register_post_type($post_type, $label_plural, $args, $feminin=false, $labels=array())
{
	// Verify if the post_type exist
	if (post_type_exists($post_type) === true) {
		return false;
	}

	// Singular post_type label
	$label = (isset($labels['singular_name'])) ? $labels['singular_name'] : substr($label_plural, 0, -1);

	// Default parameters
	$default_labels = array(
		'name' => $label_plural,
		'singular_name' => $label,
		'menu_name' => $label_plural,
		'all_items' => 'Liste',
		'add_new' => __('Add'),
		'add_new_item' => 'Ajouter un nouveau '.strtolower($label),
		'edit_item' => 'Modifier un '.strtolower($label), // the edit item text. Default is Edit Post/Edit Page
		'new_item' => 'Nouveau '.strtolower($label),
		'view_item' => 'Voir',
		'search_items' => 'Chercher un '.strtolower($label),
		'not_found' => 'Aucun '.strtolower($label).' trouvé.',
		'not_found_in_trash' => 'Aucun '.strtolower($label).' trouvé dans la corbeille.', // the not found in trash text. Default is No posts found in Trash/No pages found in Trash
		//'parent_item_colon' => '', // the parent text. This string isn't used on non-hierarchical types. In hierarchical ones the default is Parent Page
	);

	// Feminin
	if($feminin !== false)
	{
		foreach($default_labels as $key => $val) {
			$default_labels[$key] = str_replace(array(' un ', ' nouveau', 'Nouveau ', 'Aucun ', ' trouvé'), array(' une ', ' nouvelle', 'Nouvelle ', 'Aucune ', ' trouvée'), $val);
		}
	}

	// Overwrite default label parameters
	foreach ($labels as $key => $val) {
		$default_labels[$key] = $val;
	}
	
	$default_args = array(
		'labels' => $default_labels,
		'public' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'rewrite' => true,
		'query_var' => false,/*
		'capability_type' => 'post',
		'has_archive ' => true,*/
		'supports' => array('title', 'editor', /*'author', */'thumbnail'),
	);

	// Overwrite default parameters
	foreach ($args as $key => $val) {
		$default_args[$key] = $val;
	}

	// Register the post type
	return register_post_type($post_type, $default_args);
}

/**
 * Sanitize string
 */
function get_sanitize_string($string)
{
  	$string = strtolower($string);
  	$string = remove_accents($string);

  	$a = array('1°',  '°', '€', '@', '&', 'œ', '', '', '');
  	$b = array('1er', 'eme', 'euros', '-at-', '-and-', 'oe', '', '', '');
	$string = str_replace($a, $b, $string);

	// Remove accents 
	$string = strtr($string, '\'_/\;:,"#£§<>+.!?µ%*¨$^()[]{}`’=~²|«»¾–', '---------------------------------------');

	// Remove successive '-' 
  	$string = preg_replace('#\-+#', '-', $string);

  	// removes spaces at the beginning and end of string
  	$string = str_replace('-', ' ', $string);
  	$string = trim($string);
  	$string = str_replace(' ', '-', $string);

  return $string;
}

/**
 * Breadcrumb
 */
function custom_breadcrumbs() {
	global $post;
	
	if (is_page() && !is_front_page() || is_single() || is_category()) {
		echo '<ul class="tags">';
		echo '<li><a class="tag" href="'.esc_url( home_url( '/' ) ).'">Accueil</a></li>';
	
		if (is_page() || is_single()) {
			$ancestors = get_post_ancestors($post);
		
			if ($ancestors) {
				$ancestors = array_reverse($ancestors);
			
				foreach ($ancestors as $crumb) {
					echo '<li><a class="tag" href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a></li>';
				}
			}
		}
	
		// Page courante
		if (is_page() || is_single()) {
			echo '<li class="tag">'.get_the_title().'</li>';
		}
			echo '</ul>';
		} elseif (is_front_page()) {
			// Page d'accueil
			echo '<ul>';
			echo '<li><a class="tag" title="Accueil" rel="nofollow" href="'.esc_url( home_url( '/' ) ).'">Accueil</a></li>';
			echo '</ul>';
		}
       
}
/**
 * Social
 */
function get_socials(){
	echo'<ul class="social">			
           <li><a href="#" class="social--face"><i class="icon-facebook_40"></i></a></li>
           <li><a href="#" class="social--twit"><i class="icon-twitter_40"></i></a></li>
         </ul>';	
} 
function get_description(){
	if( get_field('google_description') ):							
		echo '<h2 class="description">'.get_field('google_description').'</h2>';
	else:
		echo '<h2 class="description">Attention !! Vous devez remplir le champ description et/où mettre à jour votre page. </h2>';	
	endif;
}
/**
 * get_top_parent_page_id
 */
function get_top_parent_page_id() { 
	global $post; 

	if ($post->ancestors) { 
		return end($post->ancestors); 
	} else { 
		return $post->ID; 
	} 
}

/**
 * Load more posts
 * Must active admin-ajax.php in scripts.php
 */
function more_post_ajax(){

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 12;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	$cat = (isset($_POST["cat"])) ? $_POST["cat"] : 15;

    header("Content-Type: text/html");
	
	if($cat == 16 || $cat == 19):
		$args = array(
			'post_status' => 'publish',
			'post_type' => 'post',
			'cat' => $cat,
			'posts_per_page' => $ppp,
			'paged' => $page,
			'orderby' => 'meta_value',
			'meta_key' => 'date_event',
			'order' => 'ASC',
			'meta_query' => array( 
				array(
					'key' => 'date_event', 
					'value' => date('y-m-d'), 
					'compare' => '>=',
					'type' => 'DATE'
				)
		));
	else :
		$args = array(
			'suppress_filters' => true,
			'post_status' => 'publish',
			'post_type' => 'post',
			'posts_per_page' => $ppp,
			'cat' => $cat,
			'paged' => $page,
		);
		  
	endif;
	
    $loop = new WP_Query($args);

    $out = '';

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
	
		// Thumb
		if ( has_post_thumbnail() ):
			$news_img_id = get_post_thumbnail_id();
			$news_img_array = wp_get_attachment_image_src($news_img_id, 'medium', true);
			$news_img_url = $news_img_array[0];									
           $news_img = '<img class="img-reponsive" src="'.$news_img_url.'">';
		endif;
							
		if($cat == 16 || $cat == 19):		
			$date_news = date_i18n('d M', strtotime(get_field('date_event'))); 
		else: 
			 $date_news = get_the_time('d M');                      
		endif;		 					                            
                          
       $out .= '<a class="card-news" href="'.get_the_permalink().'">
                  	<div class="card__img">'.$news_img.'</div>
                      <div class="card__infos">
                      	<span class="tag">'.$date_news.'</span>
                      	<h1 class="card__title">'.get_the_title().'</h1>
                      </div>
                  </a>';

    endwhile; endif;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

/**
 * Load more projects
 * Must active admin-ajax.php in scripts.php
 */
function more_project_ajax(){	
	
	$offset = (isset($_POST["offset"])) ? $_POST["offset"] : 3;
	
    $results = array();

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'projets',
        'posts_per_page' => 2,
		 'post_status' => 'publish',
		 'offset'  => $offset      
    );

    $loop = new WP_Query($args);

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
		
		// Thumb		
		$project_img_id = get_post_thumbnail_id();
		$project_img_array = wp_get_attachment_image_src($project_img_id, 'medium', true);		
		$project_img_url = $project_img_array[0];		   
		
		$data = array(            
       		'title' => get_the_title(),
           'image'  => $project_img_url,
           'region' => get_field('departement'),
           'permalink'   => get_the_permalink()
        );
		$results[] = $data; 
	
    endwhile; endif;

	wp_send_json($results);

    wp_reset_postdata();   
}

add_action('wp_ajax_nopriv_more_project_ajax', 'more_project_ajax');
add_action('wp_ajax_more_project_ajax', 'more_project_ajax');


/**
 * Load JSON for Google map
 * Must active admin-ajax.php in scripts.php
 */ 
function get_json_map(){	

	// Global array	
    $results = array();
	
	// Query parameters 
	$suppress_filters = (isset($_POST["suppress_filters"])) ? $_POST["suppress_filters"] : true;
    $post_type = (isset($_POST['post_type'])) ? $_POST['post_type'] : 'projets';
	$posts_per_page = (isset($_POST["posts_per_page"])) ? $_POST["posts_per_page"] : -1;
	$post_status = (isset($_POST["posts_per_page"])) ? $_POST["posts_per_page"] : 'publish';	
	
	$category = (isset($_POST["category"])) ? $_POST["category"] : 'all_cat';	
	
	// Query params for projects
	if($post_type == 'projets'):
	
		if($category=='all_cat'):
			$category = get_terms( 'type_energie', array(
				'hide_empty' => 0,
				'fields' => 'id=>slug'
			) );
		endif;
	
		$args = array(
			'suppress_filters' => $suppress_filters,
			'post_type' => $post_type,
			'posts_per_page' => $posts_per_page,
			 'post_status' => $post_status,
			 'tax_query' => array(
					array(
						'taxonomy' => 'type_energie',
						'field'    => 'slug',
						'terms'    => $category,
					)
				)
		);
	endif; // End query params for projects
		
    $loop = new WP_Query($args);

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
	
		// Excerpt
		if( get_field('google_description') ):							
			$excerpt = get_field('google_description');
		else:
			$excerpt = '';
		endif;
		
		// Thumb		
		$post_img_id = get_post_thumbnail_id();
		$post_img_array = wp_get_attachment_image_src($post_img_id, 'medium', true);		
		$post_img_url = $post_img_array[0];
				
		// Query respons for projects
		if($post_type == 'projets'):		
			
			// Taxo Slug		
			$terms = get_the_terms( $loop->ID, 'type_energie' );
			if ( !empty( $terms ) ) {
				$term = array_shift( $terms );
				$taxoslug = $term->slug;
				$taxoname = $term->name;
			}
			// Stade		
			$field_stade = get_field_object('status_projet');
			$value_stade = get_field('status_projet');
			$label_stade = $field_stade['choices'][ $value_stade ];			
			
			// Location		   
			$location = get_field('coordonees_gps');
			if( !empty($location) ){
				$latitude = $location['lat'];
				$longitude = $location['lng'];
			}
			
			$data = array(
				'postType' => $post_type,            
				'title' => get_the_title(),
			   'image'  => $post_img_url,
			   'region' => get_field('departement'),
			   'city' => get_field('ville'),
			   'permalink' => get_the_permalink(),
			   'equiPui' => get_field('equivalent_unites_puissance'),
			   'typeUnit' => get_field('type_unite_de_puissance'),
			   'prod' => get_field('production'),
			   'prodUnit' => get_field('unite_production'),
			   'equiPro' => get_field('equivalent_production'),
			   'latitude' => $latitude, 
			   'longitude' => $longitude,
			   'catSlug' => $taxoslug,
			   'catName' => $taxoname,
			   'stadeName' => $label_stade,
			   'stadeSlug' => $field_stade['value'],
			   'excerpt' => $excerpt
			);
		endif; // End query respons for projects
		
		// Push data to global array
		$results[] = $data; 
	
    endwhile; endif;
	
	// Output JSON
	wp_send_json($results);

    wp_reset_postdata();   
}

add_action('wp_ajax_nopriv_get_json_map', 'get_json_map');
add_action('wp_ajax_get_json_map', 'get_json_map');

/**
 * Load JSON for Google map
 * Must active admin-ajax.php in scripts.php
 */ 
function send_mail_prospect(){	
	
	$mail_prospect = $_POST['mail_prospect'];
	$toky_toky = $_POST['toky_toky'];
	// Global array	
    $results = array();	
	// Verify nonce
	if ( isset( $_POST['mailing_prospect_nonce_field'] ) && wp_verify_nonce( $_POST['mailing_prospect_nonce_field'], 'mailing_prospect' )) :
		// Verify email & token
		if (filter_var($mail_prospect, FILTER_VALIDATE_EMAIL) && !filter_var($toky_toky, FILTER_VALIDATE_INT) === false && $toky_toky == 3948517542):	
					
			// Projects infos 
			$id_project = filter_var($_POST['id_project'], FILTER_SANITIZE_NUMBER_INT);
			$name_project = filter_var($_POST['name_project'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$city_project = filter_var($_POST['city_project'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$region_project = filter_var($_POST['region_project'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$thumb_url = filter_var($_POST['thumb_url'], FILTER_SANITIZE_URL);
			$url_page_projet = get_the_permalink($id_project);			
			
			$datas_mail = array(
				'validation' => 'success',
				'message' => 'Un email vient de vous être envoyé.'					  
			);
			
			$meta_data = array(
				'email_contact' => $mail_prospect,
				'projet' => $id_project				
			);
				
			$insert_prospect = array(
				'post_title' => $mail_prospect,
				'post_content' => 'Nouveau prospect',
				'post_status' => 'publish',
				'post_type' => 'prospects'
			);				
				
			$the_post_id = wp_insert_post( $insert_prospect );	
				
			foreach( $meta_data as $key => $value ){  		
				add_post_meta($the_post_id, $key, $value, true);
			}
			
			// ********************************	
			// Envoie du mail au prospect			
			$mail_vars_prospect = array($mail_prospect, $id_project, $name_project, $city_project, $region_project, $thumb_url, $url_page_projet);
			notify_by_mail (array($mail_prospect), 'Energie Partagée <contact@energie-partagee.org>', 'Guide pour investir dans le projet '.$name_project, true, TEMPLATEPATH . '/app/inc/inc_projet/content-mail-prospect.php', $mail_vars_prospect );	
			
			// ********************************
			// Envoie du mail de notification 
			$mail_vars_notif = array($mail_prospect, $id_project, $name_project, $city_project, $region_project, $thumb_url, $url_page_projet);
			notify_by_mail (array('marc.mossalgue@energie-partagee.org'), 'Energie Partagée <contact@energie-partagee.org>', 'Nouveau prospect publié !', false, 'Le contact ' . $mail_prospect . ' vient de faire une demande d\'informations pour le projet <strong>' . $name_project . '<strong>.', $mail_vars_notif );	
			
			// Output response json	
			$results[] = $datas_mail; 			
		
		else: 
			// If invalid mail
			$data = array(
				'validation' => 'error',
				'mail' => $mail_prospect,
				'message' => 'Vous devez renseigner une adresse email valide.'			
			);
			$results[] = $data; 		
		
		endif;	

	else :
		// If invalid nonce
	  	$data = array(
			'validation' => 'error',
			'mail' => $mail_prospect,
			'message' => 'Erreur dans l\'envoie du formulaire.'			
		);
		$results[] = $data; 
	endif;
	
	// Output JSON
	wp_send_json($results);
}

add_action('wp_ajax_nopriv_send_mail_prospect', 'send_mail_prospect');
add_action('wp_ajax_send_mail_prospect', 'send_mail_prospect');

