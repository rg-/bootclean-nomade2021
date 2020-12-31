<?php 
	$post_class = apply_filters('wpbc/filter/post/404/class',''); 
?>
<article id="post-no-posts" <?php post_class($post_class); ?>>
	
	<header class="entry-header text-center">
		<h2 class="gmb-2"><?php echo esc_html( __('There are no publications yet.', 'bootclean') ); ?></h2>
		<?php

		$post_type = get_post_type();
		if(is_tax('project_cat') || !is_singular() && $post_type  == 'project'){
			?>
			<p><?php echo do_shortcode('[btn-projects class="btn-outline-primary"]'._x('Back to Projects','nomade').'[/btn-projects]');?></p>
			<?php
		}
		?>
	</header>
	
</article><!-- article#post-## --> 