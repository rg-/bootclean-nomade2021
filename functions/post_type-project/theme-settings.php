<?php


/* CUSTOM TAB FIELDS SECTION */


add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__projects_tab', 0, 1);  

function wpbc_theme_settings__projects_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__projects_tab',
			'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg> '._x('Projects','nomade'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/projects',$fields);
	return $fields;
}   

/**
 * Populate the ACF field with terms from the custom taxonomy Article type.
 */
 

 

add_filter('wpbc/filter/theme_settings/fields/projects', 'wpbc_theme_settings__projects_fields', 10, 1);
function wpbc_theme_settings__projects_fields($fields){

	$fields[] = WPBC_acf_make_post_object_field(array(
		'name' => 'general_project_home',
		'label' => 'Página principal de Proyectos', 
		'multiple' => 0,
	)); 

	$project_navbar = array();
	$project_navbar[0] = 'None';
		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
					foreach ( $menus as $choice ) { 
						$project_navbar[$choice->term_id] = $choice->name;
					}
				}

	$fields[] = WPBC_acf_make_select_field(array(
		'name' => 'general_project_navbar',
		'label' => 'Menú principal de Proyectos', 
		'multiple' => 0,
		'choices' => $project_navbar,
		 
	));
	
	$subfields_pageheader = array();

		$subfields_pageheader[] =  WPBC_acf_make_textarea_field(
			array( 
				'name' => 'projects_title',
				'label' => _x('Projects default Page Title','nomade'),  
			)
		); 
		$subfields_pageheader[] =  WPBC_acf_make_textarea_field(
			array( 
				'name' => 'projects_description',
				'label' => _x('Projects default Page Description','nomade'),  
			)
		); 
		$subfields_pageheader[] = WPBC_acf_make_message_field(array(
			'key' => 'projects_message',
			'label' => '',
			'message' => 'Estos textos se mostrará en la portada de Proyectos. El resto de contenido se puede administrar en el campo descripción de las categorias.',
		));

	$fields[] =  WPBC_acf_make_group_field(
		array( 
			'name' => 'projects_pageheader',
			'label' => _x('Projects default Page Header Content','nomade'),  
			'sub_fields' => $subfields_pageheader,
		)
	); 

	return $fields;
}