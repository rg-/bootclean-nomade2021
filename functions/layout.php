<?php

add_filter('wpbc/body/data', 'custom_body_data',10,1 ); 

function custom_body_data($out){
	global $post;
	$out = ' data-scroll-offset="70" data-scroll-time-1="1000" data-scroll-ease-1="easeOutBack" data-loader-delay="1000"'.$out;
	
	return $out;
}

/* 
	This will run if no Theme Settings or custom used. 
	Use it if no Theme Settings used, and to set defaults
*/
add_filter('wpbc/filter/layout/locations', function($locations){ 
	// $locations['page']['id'] = 'a1';
	return $locations;  
}, 20, 1 );


/* 
	This will run at the last, last, last 
*/
add_filter('wpbc/filter/layout/location', function($layout, $template, $using_theme_settings, $using_page_settings){
	if($template == 'project'){
		//$layout = 'a2-ml';
	}
	return $layout;
},10,4);
/* 
	And same thing for the container type
*/
add_filter('wpbc/filter/layout/container_type', function($container_type, $template, $using_theme_settings, $using_page_settings){
	if($template == 'page'){
		//$container_type = 'fixed-left';
	}
	return $container_type;
},10,4);


add_action('wpbc/layout/start', function(){?><?php
}, 40 );

add_filter('wpbc/filter/layout/start/defaults', function($args){  
	//$args['main_content']['wrap']['class'] = 'gpy-1';
	return $args;
}); 

add_filter('WPBC_post_header_title_class', function($title_class){ 
	/*
	default
	$title_class = 'entry-title';
	*/
	//$title_class .= ' gmb-2';
	return $title_class;  
}, 20, 1 ); 



add_filter('wpbc/filter/layout/go-up', 'custom_goUp',10,1);
function custom_goUp($html){
	// $html = '<a href="#" class="btn btn-transparent"><i class="fa fa-angle-up"></i></a>'
	return $html; 
} 



/*

	Wrap content into <div class="row"....

*/ 


add_action('wpbc/template/content/search/loop/before', function(){
	echo '<div class="row row-posts">';
});
add_action('wpbc/template/content/search/loop/after', function(){ 
	echo '</div>';
});
