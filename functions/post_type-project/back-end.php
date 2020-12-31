<?php

add_action( 'init', 'WPBC_acf_groups_post_type__project' );

function WPBC_acf_groups_post_type__project(){

	if( function_exists('acf_add_local_field_group') ): 

		$fields = array();

			$fields[] = WPBC_acf_make_message_field(array(
				'label' => 'Thumb Image',
				'key' => 'thumb_image',
				'message' => 'Use Featured Image',
				'width' => '25%',
			));
			$fields[] = WPBC_acf_make_gallery_advanced_field(array(
				'label' => 'Header Images',
				'name' => 'header_image',
				'width' => '75%',
				'button_label' => 'Add image',
				'columns' => 2,
				//'class' => 'acf-small-gallery',
				//'preview_size' => 'large'
			));

			$fields[] = WPBC_acf_make_textarea_field(array(
				'label' => 'Lead Text',
				'name' => 'lead_text', 
			));
			$fields[] = WPBC_acf_make_textarea_field(array(
				'label' => 'Sub Lead Text',
				'name' => 'sub_lead_text', 
			));

			$fields[] = WPBC_acf_make_wysiwyg_field(array(
				'label' => 'About the project',
				'name' => 'description_text', 
			));

			$fields[] = WPBC_acf_make_text_field(array(
				'label' => 'Website URL',
				'name' => 'website_url', 
			));

			$colors_palette = array();

				$colors_palette[] = WPBC_acf_make_select_field(array(
					'label' => 'Type',
					'name' => 'colors_palette_type', 
					'width' => '20%',
					'choices' => array(
						'hex' => 'HEX',
						'image' => 'Image'
					),
					'default_value' => 'hex',
				));

				$colors_palette[] = WPBC_acf_make_color_picker_field(array(
					'label' => 'HEX',
					'name' => 'colors_palette_hex',
					'width' => '80%',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_colors_palette_type',
								'operator' => '==',
								'value' => 'hex',
							),
						), 
					), 
				));

				$colors_palette[] = WPBC_acf_make_image_field(array(
					'label' => 'Image',
					'name' => 'colors_palette_image',
					'width' => '80%',
					'return_format' => 'id',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_colors_palette_type',
								'operator' => '==',
								'value' => 'image',
							),
						), 
					), 
				));

			$fields[] = WPBC_acf_make_repeater_field(array(
				'label' => 'Colors Palette',
				'name' => 'colors_palette',
				'sub_fields' => $colors_palette,
			));

			$fields[] = WPBC_acf_make_gallery_advanced_field(array(
				'label' => 'Project Logos',
				'name' => 'project_logos', 
				'button_label' => 'Add Logo',
			));
			$fields[] = WPBC_acf_make_gallery_advanced_field(array(
				'label' => 'Project Gallery',
				'name' => 'project_gallery', 
				'button_label' => 'Add image',
				'columns' => 4,
				'preview_size' => 'wpbc_blured_image'
			));

		acf_add_local_field_group(array(
			'key' => 'group_5fdfbccbdc3e6',
			'title' => 'Project Content',
			'fields' => $fields,
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'project',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

	endif;
	
}


/*

	Admin Columns for Page post type

*/

add_filter( 'manage_project_posts_columns', 'wpbc_manage_project_columns' );
add_action( 'manage_project_posts_custom_column', 'wpbc_manage_project_custom_column', 5, 2 );

function wpbc_manage_project_columns( $defaults ) { 
   $defaults['project-image'] = __('Thumbnail', 'nomade'); 
   $defaults['project-header'] = __('Header', 'nomade'); 
   return $defaults;
}
function wpbc_manage_project_custom_column( $column_name, $id ){

	if ( $column_name === 'project-image' ) {
		$thumb_image =  get_field('thumb_image',$id); 
		$thumb_image =  get_the_post_thumbnail( $id, array( 100, 100)); 
		echo $thumb_image; 
	}
	if ( $column_name === 'project-header' ) {
		$thumb_image =  get_field('header_image',$id); 
		$img_large = $thumb_image['sizes']['medium'];
		echo '<img src="'.$img_large.'" width="100"/>'; 
	}

}