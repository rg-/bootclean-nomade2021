<?php
/* ################################################################################## */
/* ################################################################################## */
/**
 * Bootclean child custom functions
 *
 * @package Bootclean
 * @subpackage Child Theme
 * 
 */
/* ################################################################################## */
/* ################################################################################## */

/**
 * @subpackage Enable "theme_settings" options pages
 */

	add_filter('wpbc/filter/theme_settings/installed', '__return_true');
		
		/* Customs for theme settings here */
		
		include('functions/addon-theme_settings.php');

/* ################################################################################## */

/**
 * @subpackage Template Landing
 */
	/* Disable template landing builder */
	add_filter('wpbc/filter/template-landing/installed', '__return_false');

/* ################################################################################## */

/**
 * @subpackage Enable "is_inview" Addon JS/CSS
 */
	 
	add_filter('wpbc/filter/is_inview/installed', '__return_true',0,1);

/* ################################################################################## */

/**
 * @subpackage Enable "swup" addon
 */

	// add_filter('wpbc/filter/swup/installed', '__return_true');
	// include('functions/addon-swup.php');

/* ################################################################################## */

/**
 * @subpackage Enable "private_areas" addon
 */

	// add_filter('wpbc/filter/private_areas/installed', '__return_true');
	// include('functions/addon-private_areas.php');

/* ################################################################################## */

/**
 * @subpackage "theme-*" customs
 */

	include('functions/theme-textdomain.php'); 
	include('functions/theme-login.php'); 
	include('functions/theme-options.php');
	include('functions/theme-under-construction.php'); 
	// include('functions/theme-options-page-settings.php');
	include('functions/theme-scripts.php');
	include('functions/theme-fonts.php');
	include('functions/theme-shortcodes.php');
	include('functions/theme-wpbc_grayscale_image.php');
	// include('functions/theme-widgets.php');

/* ################################################################################## */

/* core */
// include('functions/core-theme_support.php'); 

/* ################################################################################## */

/* front-end layout */ 
include('functions/layout.php');
include('functions/layout-navmenus.php');
include('functions/layout-slick.php');

/* ################################################################################## */

/**
 * @subpackage WooCommerce
 */
if( class_exists( 'WooCommerce' ) ){
	include('functions/plugins-woocommerce.php');
}

/* ################################################################################## */
 
include('functions/post_type-project.php');

/* ################################################################################## */

include('functions/qtranslate.php');
/* ################################################################################## */


/* ################################################################################## */