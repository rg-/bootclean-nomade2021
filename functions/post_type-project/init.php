<?php

add_action( 'init', 'WPBC_create_post_type__project' );

function WPBC_create_post_type__project() {

	$icon = 'dashicons-admin-page';

	$labels = array(
		'name' => _x('Projects', 'nomade'),
		'singular_name' => _x('Project', 'nomade'),
		'add_new' => _x('New Project', 'nomade'),
		'add_new_item' => _x('Add Project', 'nomade'),
		'edit_item' => _x('Edit Project', 'nomade'),
		'new_item' => _x('New Project', 'nomade'),
		'all_items' => _x('All Projects', 'nomade'),
		'view_item' => _x('See Project', 'nomade'),
		'search_items' => _x('Search Projects', 'nomade'),
		'not_found' =>  _x('Not found', 'nomade'),
		'not_found_in_trash' => _x('Not found', 'nomade'),
		'parent_item_colon' => '',
		'menu_name' => _x('Projects', 'nomade'),
	);
	$args = array(
		'labels' => $labels,
		//'description' => 'A post type for entering video information.',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'hierarchical' => false,
		//'show_in_rest' => true, // guttemberg
		'supports' => array( 'title','thumbnail' ),
		'rewrite' => array(
			'slug' => 'project',
			'with_front' => true,
		),
		'has_archive' => 'projects',
		'menu_icon' => $icon,  
	);

	register_post_type('project',$args); 
  
  register_taxonomy(
		'project_cat',
		array( 'project' ),
		array(
			'label' => __('Project Category','nomade'),
			'labels' => array(
				'add_new_item' => __('Add Project Category','nomade'),
			),   
			'public' => true, 
			'hierarchical' => true,
			'sort' => true,
			'show_ui' => true,
      'show_in_quick_edit' => true, 
			'show_in_nav_menus' => true,
			'show_admin_column' => true, 
			'rewrite' => array( 'slug' => 'project-category', 'with_front' => true ),
		)
	); 

	register_taxonomy(
		'project_tag',
		array( 'project' ),
		array(
			'label' => __('Project Tag','nomade'),
			'labels' => array(
				'add_new_item' => __('Add Project Tag','nomade'),
			),   
			'public' => true, 
			'hierarchical' => false,
			'sort' => true,
			'show_ui' => true,
      'show_in_quick_edit' => true, 
			'show_in_nav_menus' => true,
			'show_admin_column' => true, 
			'rewrite' => array( 'slug' => 'project-tag', 'with_front' => true ),
		)
	); 

} 