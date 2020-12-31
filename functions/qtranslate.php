<?php




/*

	WPBC_get_lang_selector

*/
if(!function_exists('WPBC_get_lang_selector')){
	function WPBC_get_lang_selector(){
		
		global $q_config;
		$lang_nav = ''; 

		if ( is_404() ) {
			$url = get_option( 'home' );
		} else {
			$url = '';
		}

		if( function_exists('qtranxf_use') && defined('BC_ACF_QTRANSLATEX_ENABLED') && BC_ACF_QTRANSLATEX_ENABLED == true ){  

			$flag_location = qtranxf_flag_location();

			$lang_nav .= '<div class="lang-menu">'; 
			$lang_nav .= '<ul class="lang-menu-nav">';

  		foreach ( qtranxf_getSortedLanguages() as $language ) {
				$alt = $q_config['language_name'][ $language ];
				if ( $language == $q_config['language'] ) {
					$class = 'active';
				}else{
					$class = '';
				} 
				$flag_src = $flag_location . $q_config['flag'][ $language ];

				$lang_nav .=  '<li class="'.$class.' lang-nav-'.$language.'">'; 
				$lang_nav .=  '<a href="' . qtranxf_convertURL( $url, $language, false, true ) . '"';
				$lang_nav .=  ' class="nav-link qtranxs_short_' . $language . ' qtranxs_short" title="' . $alt . '">';
				//$lang_nav .=  '<img src="' . $flag_src . '" class="flag" alt="' . $alt . '"/>';
				$lang_nav .=  '<span>' . $language . '</span></a></li>' . PHP_EOL;
			}

			$lang_nav .= '</ul>';
			$lang_nav .= '</div>';

		}

		return $lang_nav;

	}

} 

/*

	ACF translate fields by filters as:

	bc_child_defaults_qtranslate_wysiwyg_fx
	bc_child_defaults_qtranslate_text_fx
	bc_child_defaults_qtranslate_textarea_fx

*/

add_filter('acf/load_field/key=key__r_slider_html_code', 'bc_child_defaults_qtranslate_textarea_fx',100,1);

add_filter('acf/load_field/key=field_lead_text', 'bc_child_defaults_qtranslate_textarea_fx',100,1);
add_filter('acf/load_field/key=field_sub_lead_text', 'bc_child_defaults_qtranslate_textarea_fx',100,1);

add_filter('acf/load_field/key=field_description_text', 'bc_child_defaults_qtranslate_wysiwyg_fx',100,1);


add_filter('acf/load_field/key=field_projects_title', 'bc_child_defaults_qtranslate_textarea_fx',100,1);
add_filter('acf/load_field/key=field_projects_description', 'bc_child_defaults_qtranslate_textarea_fx',100,1);