<?php
// Projects taxonomy

function add_taxonomy_filters() {
	global $typenow;
	$taxonomies = array('type_energie');
	if( $typenow == 'projets' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Tout type d'énergie</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'add_taxonomy_filters' );

/*
 * Add sort column in admin
 */

function my_extra_prospects_columns($columns) {
    $columns['projet'] =__('Projet','energie-partagee-2');
    return $columns;
}
add_filter('manage_edit-prospects_columns', 'my_extra_prospects_columns');

function my_prospects_column_content( $column_name, $post_id ) {
    if ( 'projet' != $column_name )
        return;    
    $id_projet = get_post_meta($post_id, 'projet', true);
    echo get_the_title($id_projet);
}
add_action( 'manage_prospects_posts_custom_column', 'my_prospects_column_content', 10, 2 );

function my_sortable_prospects_column( $columns ) {
    $columns['projet'] = 'projet'; 
 
    return $columns;
}
add_filter( 'manage_edit-prospects_sortable_columns', 'my_sortable_prospects_column' );

function my_prospects_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'projet' == $orderby ) {
        $query->set('meta_key','projet');
        $query->set('orderby','meta_value');
    }
}
add_action( 'pre_get_posts', 'my_prospects_orderby' );
































