<?php

function WPBC_get_projects_navbar(){

	$general_project_home = WPBC_get_theme_settings('general_project_home');
	$project_home = get_permalink($general_project_home);

	if(is_front_page()){
		$nav_class = 'bg-lighter';
	}else{
		$nav_class = 'bg-body-light';
	}
	?>
<nav id="navbar-projects" class="navbar <?php echo $nav_class; ?> pt-3 pb-3 py-md-3" data-toggle="nav-affix" data-affix-position="top" data-affix-breakpoint="xs" data-affix-target="#ui-projects-gallery" data-affix-simulate="true" data-affix-scrollify="true" >

	<div class="container aside-expand-content">
		
  	<div class="w-100">

  		<?php  
  		$project_navbar = WPBC_get_theme_settings('general_project_navbar');

  		$queried_object = get_queried_object();
			$current_term_id = $queried_object->term_id;
			$current_term_title = $queried_object->name;  
  		if(!empty($project_navbar)){
  			$nav = wp_get_nav_menu_items($project_navbar); 
  		} 

  		//_print_code($tax);
  		?>
    	<ul class="d-none d-md-flex navbar-nav flex-row justify-content-between flex-wrap align-items-center">
    		<?php if(!is_front_page()){?>
    			<li class="menu-item nav-item nav-item-home"><a href="<?php echo $project_home;?>" class="nav-link"><?php echo __('All','nomade');?></a></li>
    		<?php } ?>

    		<?php if(!empty($nav)){ ?>  
	    		<?php foreach($nav as $menu_item){
	    			 
	    			if(!empty($menu_item->post_parent)){
	    				$class = 'has_parent';
	    			}else{
	    				$class = 'has_child';
	    			}
	    			if($current_term_id == $menu_item->object_id){
	    				$class .= ' current';
	    			} 
	    			?> 
						<li class="menu-item nav-item <?php echo $class; ?>"><a href="<?php echo $menu_item->url;?>" class="nav-link"><?php echo $menu_item->title; ?></a></li>
					<?php } ?>  
				<?php } ?> 
			</ul>

			<div class="dropdown dropdown-select dropdown_cats d-md-none ">
				<?php
				if(!empty($current_term_title)){
					$selected = $current_term_title;
				} else {
					$selected = __('Project Categories','nomade');
				}
				 ?>
				
			  <button class="btn btn-block btn-transparent dropdown-toggle" type="button" id="dropdown_cats" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="dropdown-select-value" data-value="0"><?php echo $selected;?></span> <i class="caret pngicon-arrow-down-alt"></i>
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdown_cats">
			  	<?php if(!is_front_page()){?>
	    			<a href="<?php echo $project_home;?>" class="dropdown-item"><?php echo __('All','nomade');?></a>
	    		<?php } ?>
			  	<?php if(!empty($nav)){ ?>  
		    		<?php foreach($nav as $key => $menu_item){?>
							<a class="dropdown-item" href="<?php echo $menu_item->url;?>"><?php echo $menu_item->title;?></a>
						<?php } ?>
					<?php } ?>
			  </div>
			</div>

		</div>
			
	</div>
  
</nav>
	<?php
}
 
function WPBC_get_project($id=null){

	if(!empty($id)){

		$post = get_post($id);
		
		if(!empty($post)){

			$thumb_image = WPBC_get_field('thumb_image', $id); 

			$image_hi_data = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "full" );
			$image_low_data = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "thumbnail" );


			$img_hi = $image_hi_data[0];
			$img_low = $image_low_data[0];
			$img_w = $image_hi_data[1];
			$img_h = $image_hi_data[2];
			if($img_w < $img_h){
				$by = "4by5";
			}else{
				$by = "1by1";
			}

			?>
			<a href="<?php echo get_permalink($id);?>" class="ui-project-item">

				<?php 

				$content = '<div class="h-100 d-flex align-items-end ui-project-item-content">';
				$content .= '<div class="gp-2 w-100 ui-project-item-content-wrap">';
				$content .= '<h2 class="title">'.get_the_title($id).' <i class="icon n-icon-arrow-right"></i></h2>';
				$content .=  '<hr class="separator">';
				$content .=  '<div class="cats">';
				$content .=  WPBC_get_the_terms(array(
										"taxonomy" => 'project_cat', 
										"post_id" => $id,
										"use_links" => false,
										"sep" => ' / ',
									));
				$content .=  '</div>';
				$content .=  '</div>';
				$content .=  '</div>';

				WPBC_build_lazyloader_image(array(
					'embed' => $by,
					'img_hi' => $img_hi,
					'img_low' => $img_low,
					'content' => $content,
				));?>

			</a>
			<?php

		}

	}

}


/*

	Template Layout

*/

add_action('init', function(){

	add_filter('wpbc/filter/layout/locations', function($locations){ 
		
		$post_type = get_post_type(); 

		$locations['archive']['id'] = 'a1';
		$locations['tax']['id'] = 'a1';
		$locations['single']['id'] = 'a1';
		
		return $locations; 
	},10,1); 

	/* for single property */
	
	add_filter('wpbc/filter/layout/start/defaults', function($args){  
		 
		//$args['main_content']['wrap']['class'] = 'bg-success';
		return $args;
	}); 

	add_filter('wpbc/filter/layout/container_type', function($container_type, $template, $using_theme_settings, $using_page_settings){

		$post_type = get_post_type(); 
		if( $post_type  == 'project' ){ 
			$container_type = 'none';
		}
		return $container_type;
	},10,4);


	add_filter('wpbc/body/class', 'projects_body_class',10,1 ); 

	function projects_body_class($class){
		global $post;
		$post_type = get_post_type();
		$general_project_home = WPBC_get_theme_settings('general_project_home');
		if( (!is_singular() && $post_type  == 'project') || is_page($general_project_home)){
			$class .= ' bg-body-light';
		} 
		
		return $class;
	}
}); 

add_action('wpbc/layout/start', function(){

	$post_type = get_post_type();
	$general_project_home = WPBC_get_theme_settings('general_project_home');
	if( is_tax('project_cat') || (!is_singular() && $post_type  == 'project') || is_page($general_project_home)){


		$defaults = WPBC_get_theme_settings('projects_pageheader');

			$projects_title = $defaults['projects_title'];
			$projects_description = $defaults['projects_description'];
 		

		if(is_tax()){
			$current_term_id = get_queried_object_id();
			$current_term = get_term($current_term_id);
			if(!empty($current_term)){
				$projects_title = $current_term->name;
				$projects_description = $current_term->description;
			} 
		}

	?>
<div class="container gpy-2">
	<div class="row">
		<div class="col-md-7 text-center mx-auto">

			<h2 class="section-title text-primary"><?php echo $projects_title; ?></h2>
			<p><?php echo $projects_description; ?></p>

		</div>
	</div>
</div>
	<?php
	}
}, 40 );

add_action('wpbc/layout/inner/content/loop/before', function(){ 
	$post_type = get_post_type(); 
	if(is_tax('project_cat') || !is_singular() && $post_type  == 'project'){
		  $project_navbar = WPBC_get_theme_settings('general_project_navbar');

  		//$queried_object = get_queried_object();
			//$current_term_id = $queried_object->term_id;

		?>
<div id="ui-projects-gallery" class="ui-projects-gallery position-relative gpt-2 ">

	<?php WPBC_get_projects_navbar(); ?>
<div class="container">
	<div class="project-gallery gmb-1" data-mmasonry="products">
		<div class="mmasonry-sizer"></div>
		<?php 
	}
});

add_action('wpbc/layout/inner/content/loop/after', function(){ 
	$post_type = get_post_type(); 
	if(is_tax('project_cat') || !is_singular() && $post_type  == 'project'){
		?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>
		<?php
	}
});


remove_filter( 'wp_get_nav_menu_items', 'qtranxf_wp_get_nav_menu_items', 20 );