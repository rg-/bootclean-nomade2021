<div id="contacto"></div>
<footer id="main-footer" class="main-footer gpt-3" data-is-inview="detect"> 

	<div class="wpbc-full-aside-cols content-right break-md bg-light">

		<div class="col-md-5 p-0 col-fullside bg-white z-index-80" data-is-inview-once="true" data-is-inview-fx="fadeInUp" data-transition-delay=".9s">

			<div class="gmt-4 gmr-n-3">
				
				<?php 
					$footer_background = WPBC_get_theme_settings('footer_background'); 
					$img_hi = $footer_background['url'];
					$img_low = $footer_background['sizes']['wpbc_grayscale_image'];
				?>
				<div class="embed-responsive-custom ">
					<div class="embed-responsive-item image-cover lazyload-blured position-absolute" style="background-image: url(<?php echo $img_low; ?>);">
						<div class="w-100 h-100 image-cover " data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-is-inview-lazybackground="<?php echo $img_hi; ?>" style="background-image: none;">
										</div>
					</div>
				</div>

			</div>

		</div>

		<div class="container gmb-4">
		  <div class="row align-items-end">

		  	<div class="col-md-5 z-index-90">
		  		<p class="text-primary gmb-2"><i class="n-icon-logo-nomade"></i></p>

					<div class="font-size-14 text-primary">
						<?php
						$email = WPBC_get_theme_settings('general_social_email');
						$email = str_replace('@', '(at)', $email);
						$email = str_replace('.', '(dot)', $email);
						?>
						<p class="mb-1"><a href="mailto:<?php echo $email; ?>" class="antispam">x</a></p>
						<?php
						$whatsapp_label = WPBC_get_theme_settings('general_social_whatsapp_label');
						$whatsapp_link = WPBC_get_theme_settings('general_social_whatsapp_link');
						?>
						<p class="mb-1"><a href="<?php echo $whatsapp_link; ?>" target="_blank"><i class="n-icon-whatsapp xs"></i> <?php echo $whatsapp_label; ?></a></p>
						<p class="mb-1"><?php echo WPBC_get_theme_settings('general_address'); ?></p>
					</div>
		  	</div>
		    <div class="col-md-7 col-content ">
 
		    	<div class="gpt-5 gpb-4 gpl-6">

		    		<h2 class="section-title"><?php echo WPBC_get_theme_settings('footer_title'); ?></h2>
		    		<p><?php echo WPBC_get_theme_settings('footer_description'); ?></p>

		    		<div class="gpt-3">
		    			<?php
		    			$footer_form = WPBC_get_theme_settings('footer_form');
		    			echo do_shortcode('[contact-form-7 id="'.$footer_form.'" title="Formulario de contacto"]');
		    			?>
			    	</div>

		    	</div>

		    </div>
		  </div>
		</div>

	</div>

	<div class="container gpb-2">

		<div class="row align-items-center">

			<div class="col-md-3">
				<div class="social-icons">
					<?php
						$social_items = WPBC_get_theme_settings('general_social_items');
						foreach ($social_items as $key => $value) { 
							# code...?>
							<a href="<?php echo $value['social_items_url'];?>" class="btn btn-transparent px-2 text-primary"><i class="n-icon-<?php echo $value['social_items_type'];?> sm"></i></a>
							<?php
						}
						?>
				</div>
			</div>

			<div class="col-md-6 text-center">
				<small class="font-size-10 text-primary"><?php echo WPBC_get_theme_settings('footer_copyright'); ?></small>
			</div>

			<div class="col-md-3 text-right">
				<a href="#" class="btn btn-transparent px-0 text-primary scroll-to">Volver al inicio <i class="n-icon-arrow-up"></i></a>
			</div>

		</div>

	</div>

</footer>