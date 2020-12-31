<?php

/*

	Add inline head styles

*/

add_filter('WPBC_add_inline_style',function($css){
	/* On old days i use to put this on the project css file, but that will not work till the css is loaded. To prevent similar situations, just put inline styles on the most top of the <head> element, like this one here. */
	$css .= 'body.loading{overflow:hidden!important;}'; 
	$css .= '.no-touchevents ::-webkit-scrollbar { width: 10px; height: 10px; }';
	return $css;
},20,1);

/*

	Add custom js scripts on footer

*/

add_filter('WPBC_enqueue_scripts__footer_scripts', function($scripts){ 

	$scripts['masonry'] = array(
		'src' => CHILD_THEME_URI .'/addons/masonry.pkgd.min.js', 
	);
	$scripts['multipleFilterMasonry'] = array(
		'src' => CHILD_THEME_URI .'/addons/multipleFilterMasonry.js', 
	);
	$scripts['imagesloaded'] = array(
		'src' => CHILD_THEME_URI .'/addons/imagesloaded.pkgd.min.js', 
	);
	
	$scripts['ekko-lightbox'] = array(
		'src' => CHILD_THEME_URI .'/addons/ekko-lightbox/ekko-lightbox.min.js', 
	);

	$scripts['custom'] = array(
		'src'=> CHILD_THEME_URI .'/js/custom.js',
		'dependence' => array('jquery')
	);

	return $scripts;
},10,1);

add_filter('WPBC_enqueue_scripts__head_styles', function($styles){

	$styles['ekko-lightbox'] = array(
		'src' => 'addons/ekko-lightbox/ekko-lightbox.css', 
	);
	
	return $styles;
},10,1);