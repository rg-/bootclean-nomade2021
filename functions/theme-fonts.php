<?php


add_filter('WPBC_enqueue_scripts__head_styles', function($styles){

	$styles['nomade'] = array(
		'src' => 'fonts/theme/nomade.css', 
	);
	
	return $styles;
},10,1);

/* Adding custom google fonts 

	
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&display=swap" rel="stylesheet">


*/

add_filter('WPBC_enqueue_google_fonts', 'wpbc_child_enqueue_google_fonts', 10, 1);

function wpbc_child_enqueue_google_fonts($fonts){ 

	$fonts = array(
		array(
			'base' => 'Raleway', // css class base name .font-[base]{}
			'href' => 'https://fonts.googleapis.com/css?family=Raleway:wght@300;400;500;700&display=swap',
			'font-family' => "'Raleway', serif;",
			'primary' => true // will be "body" font on inline style
		), 
	);

	return $fonts; 

}



/*

	- Custom font used, see https://transfonter.org/ to transform any font file into web font-family one

	- Use priority 0 to put code on very top position (load first of any other css used)
	- Notice the "body.using-theme-fonts" definition
	- Add body class
	- You could include here any kind of code in fact, but keep for fonts.

 */

add_filter('wpbc/body/class', 'wpbc_child_body_class__fonts',		0,	1);
add_action('wp_head', 				'wpbc_child_wp_head__fonts', 			0); 

function wpbc_child_body_class__fonts($body_class){
	$body_class .= ' using-theme-fonts';
	return $body_class;
}

function wpbc_child_wp_head__fonts() {
	$theme_uri = CHILD_THEME_URI.'/fonts/theme/';
 	echo "<style>

 		@font-face {
		    font-family: 'Stoner';
		    src: url('".$theme_uri."stoner.eot');
		    src: url('".$theme_uri."stoner.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."stoner.woff2') format('woff2'),
		         url('".$theme_uri."stoner.woff') format('woff'),
		         url('".$theme_uri."stoner.ttf')  format('truetype'),
		         url('".$theme_uri."stoner.svg#stoner') format('svg');
		    font-weight: normal;
		    font-style: normal;
		    font-display: swap;
		}

		.font-Stoner{
			font-family: 'Stoner', serif; 
		}

		@font-face {
		    font-family: 'Wulkandisplay Regular';
		    src: url('".$theme_uri."Wulkandisplay-Regular.eot');
		    src: url('".$theme_uri."Wulkandisplay-Regular.eot?#iefix') format('embedded-opentype'), 
		         url('".$theme_uri."Wulkandisplay-Regular.woff') format('woff'),
		         url('".$theme_uri."Wulkandisplay-Regular.ttf') format('truetype'),
		         url('".$theme_uri."Wulkandisplay-Regular.svg#Wulkandisplay-Regular') format('svg');
		    font-weight: normal;
		    font-style: normal;
		    font-display: swap;
		}
		.font-Wulkandisplay{
			font-family: 'Wulkandisplay Regular';
		}

		</style>";
}  

/* Embed Font Awesome */

// add_filter('BC_enqueue_scripts__fonts', 'wpbc_child_enqueue_custom_font_awesome'); 

function wpbc_child_enqueue_custom_font_awesome($fonts){ 
	$fonts['fontawesome-all'] = array( 
		'src'=>'css/fontawesome/all.min.css'
	); 
	return $fonts; 
}