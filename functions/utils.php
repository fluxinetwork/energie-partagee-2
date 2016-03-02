<?php

/* | Utils - V1.0 - 20/01/16 | 
--------------------------------
   | fluxi_register_post_type()
   | get_sanitize_string()
*/

/**
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
	
	if (is_page() && !is_front_page() || is_single() || is_category()) {
		echo '<ul class="tags">';
		echo '<li><a class="tag" href="'.esc_url( home_url( '/' ) ).'">Accueil</a></li>';
	
		if (is_page()) {
			$ancestors = get_post_ancestors($post);
		
			if ($ancestors) {
				$ancestors = array_reverse($ancestors);
			
				foreach ($ancestors as $crumb) {
					echo '<li><a class="tag" href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a></li>';
				}
			}
		}
	
		if (is_single()) {
			$category = get_the_category();
			echo '<li><a class="tag" href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a></li>';
		}
	
		if (is_category()) {
			$category = get_the_category();
			echo '<li class="tag">'.$category[0]->cat_name.'</li>';
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
/*Socials*/
function get_socials(){
	echo'<ul class="social">
				  <li><i class="icon-round-next-arrow"></i></li>
                <li><a href="#" class="social--face"><i class="icon-facebook"></i></a></li>
                <li><a href="#" class="social--twit"><i class="icon-twitter"></i></a></li>
         </ul>';
	
} 