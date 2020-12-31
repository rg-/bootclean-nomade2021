<?php 

function _get_btn_FX($args, $content=NULL, $tag){

	$defs = array();  
	if(empty($args)){
		$args = array();
	} 
  $args = array_merge($defs, $args);
  $class = $tag;
  $attrs = '';
  $divtag = 'a';
  if(!empty($args['icon'])){
  	$class .= ' btn-icon'; 
    $content = '['.$args['icon'].']';
  }  
  if(!empty($args['label'])){
  	$content = $args['label'];
  }
  if(!empty($args['divtag'])){
  	$divtag = $args['divtag'];
  }

	if(!empty($args['attrs'])){
  	$attrs = $args['attrs'];
  }
  
  if($divtag=='button'){
  	$return = '<button data-btn="fx" '.$attrs.' class="btn '.$class.'">'.$content.'</button>';
  }
  if($divtag=='a'){
  	$return = '<a data-btn="fx" href="'.$args['href'].'" '.$attrs.' class="btn '.$class.'">'.$content.'</a>';
  }

  return $return;

}
add_shortcode('btn-outline-white','_get_btn_FX');

function _get_btn_projects_FX($args, $content=NULL, $tag){
  $defs = array();  
  if(empty($args)){
    $args = array(
      'class' => 'btn-outline-white'
    );
  } 
  $args = array_merge($defs, $args);

  $general_project_home = WPBC_get_theme_settings('general_project_home');
  $content = !empty($content) ? $content : _x('MORE PROJECTS','nomade');
  $return = '<a data-btn="fx" href="'.get_permalink($general_project_home).'" class="btn '.$args['class'].'">'.$content.'</a>';

  return '<div data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOutDown" data-animation-duration=".8s" data-animation-delay=".8s">'.$return.'</div>';
}
add_shortcode('btn-projects','_get_btn_projects_FX');

function _get_slider_legend_FX($args, $content=NULL, $tag){ 
	return '<h3 data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOutDown" data-animation-duration=".8s" data-animation-delay=".1s">'.$content.'</h3>';
}
add_shortcode('slider-legend','_get_slider_legend_FX');

function _get_slider_title_FX($args, $content=NULL, $tag){ 
	return '<h2 data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOutDown" data-animation-duration=".8s" data-animation-delay=".5s">'.$content.'</h2>';
}
add_shortcode('slider-title','_get_slider_title_FX');

function _get_slider_action_FX($args, $content=NULL, $tag){ 
	return '<div data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOutDown" data-animation-duration=".8s" data-animation-delay=".8s">'.$content.'</div>';
}
add_shortcode('slider-action','_get_slider_action_FX');