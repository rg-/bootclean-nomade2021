<?php 
	$id = get_the_ID();
	$title = get_the_title();
	$header_image = WPBC_get_field('header_image', $id); 
	$lead_text = WPBC_get_field('lead_text', $id); 
	$sub_lead_text = WPBC_get_field('sub_lead_text', $id); 
	$description_text = WPBC_get_field('description_text', $id); 
	$website_url = WPBC_get_field('website_url', $id); 
	$colors_palette = WPBC_get_field('colors_palette', $id); 
	$project_logos = WPBC_get_field('project_logos', $id); 
	$project_gallery = WPBC_get_field('project_gallery', $id);  

?>
<article id="post-<?php echo $id; ?>" <?php post_class('single-project'); ?>>

	<div class="project-header">

		<?php
		$slick = array(
			'dots' => true,
			'arrows' => false, 
			'infinite' => true,
			'speed' => 600,
			'fade' => true,
			'autoplay' => true,
			'speed' => 2000,
			'autoplaySpeed' => 4200, 
		);
		$slick = json_encode($slick); 

		$slick_heights = array(
			'xs' => array(
				'default' => '100wh',
				'min' => '667px',
				'max' => '784px'
			), 
		);
		$slick_heights = json_encode($slick_heights);
		?>

		<?php if(!empty($header_image)) {?>
			<div class="theme-slick-slider" data-slick='<?php echo $slick; ?>' data-breakpoint-height='<?php echo $slick_heights; ?>' data-disable-affix-offset="true" >
				<?php foreach($header_image as $k=>$v){  
					
					$attachment_id = $v['id']; 
						$img_hi = "[WPBC_get_attachment_image_src id='".$attachment_id."']";
						$img_low = "[WPBC_get_attachment_image_src id='".$attachment_id."' size='medium']";
						WPBC_build_lazyloader_image(array(
							'type' => 'slick-embed',
							'img_hi' => $img_hi,
							'img_low' => $img_low, 
						));

					} ?>
			</div>
		<?php } ?>

	</div>

	<div class="project-info bg-light gpt-6 gpb-6">

		<div class="container">

			<div class="row">

				<div class="col-md-9">

					<div class="gpr-md-3">
						<h2 class="section-title text-secondary"><?php echo $title; ?></h2> 
						<p class="lead text"><?php echo $lead_text; ?></p>
						<p><?php echo $sub_lead_text; ?></p> 
						<h3 class="gmt-3 gmb-2 section-sub-title">SOBRE EL PROYECTO</h3> 
						<?php echo $description_text; ?>

						<?php if(!empty($website_url)){ ?>
							<p class="gmt-3"><a class="btn btn-outline-secondary" href="<?php echo $website_url; ?>"><?php echo $website_url; ?></a></p>
						<?php } ?>
					</div>

				</div>

				<div class="col-md-3">

					<div class="aside gmb-3">
						<h3 class="gmt-1 gmb-2 section-sub-title">SERVICIOS</h3> 
						<?php
						echo WPBC_get_the_terms(array(
											"taxonomy" => 'project_cat', 
											"post_id" => $id,
											"use_links" => true,
											"before_item" => '<p class="mb-2">',
											"after_item" => '</p>',
											"sep" => '',
										));
						?>
					</div>

					<div class="aside gmb-3">
						<h3 class="gmt-1 gmb-2 section-sub-title">PALETA DE COLOR</h3> 
						<?php if(!empty($colors_palette)){ ?> 
							<div>
							<?php  foreach ($colors_palette as $key => $value) {
								$type = $value['colors_palette_type'];
								 
								if($type=='hex'){
									$return_val = $value['colors_palette_hex'];
									?><span class="ui-palette gmr-1 gmb-1" style="background-color:<?php echo $return_val; ?>;">&nbsp;</span><?php
								}
								if($type=='image'){
									$return_val = $value['colors_palette_image'];
									$return_val = "[WPBC_get_attachment_image_src id='".$return_val."']";
									?><span class="ui-palette image-cover gmr-1 gmb-1" style="background-image:url(<?php echo $return_val; ?>);">&nbsp;</span><?php
								}

							} ?>
						</div>
						<?php } ?>
					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="bg-body-light gpy-2">

		<div class="container">

			<div class="project-logos-title">
				<h3 class="gmt-1 gmb-2 section-sub-title alt">LOGOS</h3> 
				<span class="text-overlay">versiones</span>
			</div>
			<div class="project-logos">
				<?php

				$slick = array(
					'dots' => false,
					'arrows' => true, 
					'infinite' => true,
					'speed' => 600, 
					'slidesToShow' => 3,
					'slidesToScroll' => 3,
					'responsive' => array(
						array(
							'breakpoint' => 992,
							'settings' => array(
								'slidesToShow' => 2,
								'slidesToScroll' => 2,
							)
						),
					),
				);
				$slick = json_encode($slick); 

				if(!empty($project_logos)){ ?>
					<div class="theme-slick-slider" data-slick='<?php echo $slick; ?>' data-disable-affix-offset="true" >
					<?php foreach ($project_logos as $key => $value) {
						$img_hi = $value['url'];
						$img_low = $value['sizes']['wpbc_grayscale_image'];

						?>
						<img src="<?php echo $img_hi; ?>" alt=" " />
						<?php
					} 
					?>
					</div>
					<?php
				} ?>
			</div>

		</div>

	</div>

	<div class="bg-white">

		<div class="container">

			<div class="project-gallery gmy-2" data-mmasonry="products">

				<div class="mmasonry-sizer col-by-6"></div>

				<?php
				if(!empty($project_gallery)){
					foreach ($project_gallery as $key => $value) {
						$img_hi = $value['url'];
						$img_low = $value['sizes']['wpbc_grayscale_image'];
						$img_w = $value['width'];
						$img_h = $value['height'];
						if($img_w < $img_h){
							$by = '4by5';
							$class = "col-by-6";
						} 
						if($img_w > $img_h){
							$by = '16by9';
							$class = "col-by-12";
						} 
						if($img_w == $img_h){
							$by = '1by1';
							$class = "col-by-6";
						}
						?>
						<div class="mmasonry-item gp-1  <?php echo $class; ?>">
							<div class="ui-mmasonry" data-is-inview="detect">
							<?php WPBC_build_lazyloader_image(array(
								'embed' => $by,
								'img_hi' => $img_hi,
								'img_low' => $img_low, 
							));?>
							</div>
						</div>
						<?php 
					}
				}
				?>

			</div>

			<div class="project_tags">

				<?php
						echo WPBC_get_the_terms(array(
									"taxonomy" => 'project_tag', 
									"post_id" => $id,
									"use_links" => true,
									"before_item" => '',
									"after_item" => '',
									"term_class" => 'btn btn-outline-secondary',
									"sep" => '',
								));
				?>

			</div>

		</div>

	</div>
	
</article><!-- article#post-## --> 