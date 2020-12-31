<?php

/*

	ACF Builder layouts

*/

add_filter('WPBC_acf_builder_layouts', 'build_ui_projects_gallery',10,1); 

function build_ui_projects_gallery($layouts){

	$content_sub_fields = array();

	$content_sub_fields[] = WPBC_acf_make_textarea_field(array(
		'name' => 'ui-projects-gallery__section_title',
		'label'=> 'Contenido arriba resultados (opcional)',
	));

	$content_sub_fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'ui-projects-gallery__navbar',
		'label'=> 'Mostrar menú Categorias',
		'width' => '30%'  
	));

	$content_sub_fields[] = WPBC_acf_make_select_field(
				array(
					'name' => 'ui-projects-gallery__pager',
					'label'=> 'Paginado',  
					'choices' => array(
						'none' => 'Ninguno',
						'pager' => 'Paginador',
						'ajax' => 'Ajax', 
					),
					'default_value' => 'pager',
					'width' => '20%' 
				)
			);

	$content_sub_fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'ui-projects-gallery__loadmore',
		'label'=> 'Mostrar "Load More"',
		'width' => '30%',
		'conditional_logic' => array (
							array (
								array (
									'field' => 'field_ui-projects-gallery__pager',
									'operator' => '==',
									'value' => 'ajax',
								),
							), 
						),
	));

	$sub_fields_query = array();

		$sub_fields_query[] = WPBC_acf_make_select_field(
				array(
					'name' => 'ui-projects-gallery__type',
					'label'=> 'Tipo',  
					'choices' => array(
						'auto' => 'Automatico',
						'select' => 'Seleccionar', 
					),
					'default_value' => 'auto',
					'width' => '20%',  
				)
			);

		$sub_fields_query[] = WPBC_acf_make_number_field(
				array(
					'name' => 'max_posts',
					'label'=>'Cantidad máxima', 
					'default_value' => 9,
					'width'=>'20%', 
				)
			);

		$sub_fields_query[] = WPBC_acf_make_select_field(
				array(
					'name' => 'orderby',
					'label'=> 'Ordenar por',  
					'choices' => array(
						'title' => 'Título',
						'data' => 'Fecha',
						'rand' => 'Randómico'
					),
					'default_value' => 'data',
					'width' => '20%', 
				)
			);

		$sub_fields_query[] = WPBC_acf_make_relationship_field(array(
			'name' => 'selection',
			'label'=> 'Seleccionar los projects a mostrar',  
			'post_type' => array('project'),
			'return_format' => 'id', 
			'filters' => array(
				0 => 'search',
			), 
			'conditional_logic' => array (
							array (
								array (
									'field' => 'field_ui-projects-gallery__type',
									'operator' => '==',
									'value' => 'select',
								),
							), 
						),
		));

	$content_sub_fields[] = WPBC_acf_make_group_field(array(
		'name' => 'ui-projects-gallery__query',
		'label'=> 'Opciones',  
		'sub_fields' => $sub_fields_query,
		'conditional_logic' => array (
							array (
								array (
									'field' => 'field_ui-projects-gallery__pager',
									'operator' => '!=',
									'value' => 'none',
								),
							), 
						),
	));
 

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => 'ui-projects-gallery',
		'layout_label' => '<i class="dot-badge"></i> Projects Gallery',
		'content_sub_fields' => $content_sub_fields,
		'hide_section_title' => true,
		'hide_call_to_action' => true, 
		'hide_options_all' => true,
	), $layouts);

	return $layouts;

}

add_action('admin_head',function(){
	$check = array(
		'ui-projects-gallery',
	);
	?>
<style>
<?php foreach ($check as $value) { ?>
	.acf-tooltip [data-layout="<?php echo $value; ?>"] .dot-badge{
		background-color:#222;
		width: 10px;
		height: 10px;
		display: inline-block;
		border-radius: 100%;
		margin-right: 4px;
		border: 1px solid #fff;
		vertical-align: -1px;
	}  
<?php } ?>
[data-layout="template_row"].-collapsed .acf-fc-layout-handle svg path{
		fill:#333333 !important;
	}
</style>
	<?php
}); 