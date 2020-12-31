<?php

add_filter('wpbc/slick/args', function($slider_args, $post_id){

	$slider_args['lazytype'] = 'lazybackground_inner';
	$slider_args['lazytype_fx'] = 'blured';
	$slider_args['slick_args']['appendDots'] = '#page-header-container';

	return $slider_args;

},10,2);

add_action('wpbc/layout/page-header/after', function(){
	global $post;
	if(WPBC_if_has_page_header($post->ID)){
		?>
<div class="container position-relative" id="page-header-container">
	
	<div class="social-icons">
		<?php
			$social_items = WPBC_get_theme_settings('general_social_items');
			foreach ($social_items as $key => $value) { 
				# code...?>
				<a href="<?php echo $value['social_items_url'];?>" class="btn btn-transparent px-3 text-white"><i class="n-icon-<?php echo $value['social_items_type'];?>"></i></a>
				<?php
			}
			?>
	</div>

</div>
		<?php
	}
},10);


add_action('wpbc/slick/item/content/before', function($item, $params){
 
	?>
<div class="h-100 container">
	<div class="d-flex justify-content-start align-items-end h-100 gpb-4 gpt-6">
		<div class="gpy-3">
	<?php

},10,2);

add_action('wpbc/slick/item/content/after', function($item, $params){
 
	?>
		</div>
	</div>
</div>
	<?php

},10,2);