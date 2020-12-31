<?php

	$prefix = 'field_ui-projects-gallery__';
	$row = get_row();


	$pager = $row[$prefix.'pager'];
	$loadmore = $row[$prefix.'loadmore'];
	$section_title = $row[$prefix.'section_title'];

	$navbar = $row[$prefix.'navbar'];

	$query = $row[$prefix.'query'];

	$type = $query[$prefix.'type'];
	$max_posts = $query['field_max_posts'];
	$orderby = $query['field_orderby'];
	$selection = $query['field_selection'];
	
	if(!empty($selection)){ 
		$selection = implode( ',', $selection );
	} 

	$passed = array(
		'type' => $type,
		'max_posts' => $max_posts,
		'orderby' => $orderby,
		'selection' => $selection, 
	);
?>

<div id="ui-projects-gallery" class="ui-projects-gallery position-relative gpt-2 gmb-2">
	<?php
	if(!empty($navbar)){
		WPBC_get_projects_navbar(); 
	}
	?>
	<?php if(!empty($section_title)){ 
		echo $section_title;
  } ?>

	<?php if($pager == 'ajax'){ ?>
	<div class="container gmy-1">
		<div id="ajax-products-loader" data-mmasonry="products" class="ajax-load-holder ajax-loading d-block">
			<div class="mmasonry-sizer"></div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="container">
		<div class="clearfix"></div> 
		<?php   
		
		if($type=='auto'){
			$url = '&posts_per_page='.$max_posts.'&orderby='.$orderby.'';
			$class = '';
		}
		if($type=='select'){
			$url = '&post_in='.$selection;
			$class = 'd-none';
		}

		$ajax_url = admin_url( 'admin-ajax.php' ) . '?action=get_template&name=ajax/get_projects'.$url;
		if(!empty($loadmore)){ 
		?>
		<p class="text-center <?php echo $class; ?>"><button data-paged="1" data-ajax-load="<?php echo $ajax_url; ?>" data-ajax-target="#ajax-products-loader" data-ajax-load-method="append" class="btn btn-view-more alt gmt-1">View more</button><span class="d-none ajax-no-products gpy-1"></span></p>
	</div>
	<?php }else{  ?>
		<button data-paged="1" data-ajax-load="<?php echo $ajax_url; ?>" data-ajax-target="#ajax-products-loader" data-ajax-load-method="append" class="btn btn-view-more alt gmt-1 d-none">&nabsp;</button>
	<?php }  
		} ?>

	<?php if($pager == 'pager'){ ?>
		
				<?php 
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$_WP_Query_args = array(
					'post_status' => 'publish',
					'post_type' => 'project',
					'orderby' => $orderby, 
					'posts_per_page' => $max_posts, 
					'paged' => $paged, 
				); 
				$loop = new WP_Query( $_WP_Query_args );
				?>
				<?php if ( $loop->have_posts() ) { ?>
					<div class="container ">
						<div class="project-gallery gmb-2" data-mmasonry="products" class="d-block">
							<div class="mmasonry-sizer"></div>
					<?php while ( $loop->have_posts() ) {
						$loop->the_post();  

						?>
						<div class="mmasonry-item gpx-1 gpb-1">
							<div class="ui-mmasonry" data-is-inview="detect">

								<?php WPBC_get_project( get_the_ID() ); ?>

							</div>
						</div>
					<?php } ?>
					</div>
				<div class="clearfix"></div>
			</div>

			<div class="container">

				<div class="projects-pagination">
				     <?php
				     $big = 999999999;
				     echo paginate_links( array(
				          'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				          'format' => '?paged=%#%',
				          'current' => max( 1, get_query_var('paged') ),
				          'total' => $loop->max_num_pages,
				          'prev_text' => '<i class="n-icon-arrow-left"></i>',
				          'next_text' => '<i class="n-icon-arrow-right"></i>'
				     ) );
				?>
				</div>
			</div>
				<?php }
				wp_reset_postdata();
				?>
			
	<?php } ?>

</div>