<?php
// CPT with taxo |  Ex : 'projet'
fluxi_register_post_type('projet', 'Projets', array('supports' => array('title', 'editor')));

// hook into the init action and call create_custom_taxonomies when it fires
add_action( 'init', 'create_projet_taxonomies', 0 );

function create_projet_taxonomies() {	
	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Types' ),
		'all_items'         => __( 'All Types' ),
		'parent_item'       => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Parent Type:' ),
		'edit_item'         => __( 'Edit Type' ),
		'update_item'       => __( 'Update Type' ),
		'add_new_item'      => __( 'Add New Type' ),
		'new_item_name'     => __( 'New Type Name' ),
		'menu_name'         => __( 'Type' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type' ),
	);

	register_taxonomy( 'type', array( 'projet' ), $args );

}

// CPT Devis
fluxi_register_post_type('devis', 'Devis', array('supports' => array('title', 'editor')));

