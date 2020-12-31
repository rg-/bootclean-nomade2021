<?php

$_WP_Query_args = array(
	'post_status' => 'publish',
	'post_type' => 'project',
	'orderby' => isset($_GET['orderby']) ? $_GET['orderby'] : 'date', 
	'posts_per_page' => isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 6, 
	'paged' => isset($_GET['paged']) ? $_GET['paged'] : 1, 
); 
if(isset($_GET['post_in'])){
	
	$post__in = explode(',',$_GET['post_in']);
	$_WP_Query_args = array(
	'post_status' => 'publish',
	'post_type' => 'project',
	'post__in' => $post__in,
	);
}
$loop = new WP_Query( $_WP_Query_args );
$_total = $loop->max_num_pages; 
?>
<div class="d-none paged" data-total="<?php echo $_total; ?>" data-paged="<?php echo $_WP_Query_args['paged']; ?>"></div>
<?php if ( $loop->have_posts() ) { ?>
	<?php while ( $loop->have_posts() ) {
		$loop->the_post();  

		?>
		<div class="mmasonry-item gpx-1 gpb-1">
			<div class="ui-mmasonry" data-is-inview="detect">

				<?php WPBC_get_project( get_the_ID() ); ?>

			</div>
		</div>
	<?php } ?>
<?php }
wp_reset_postdata();
?>