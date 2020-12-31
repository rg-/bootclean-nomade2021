<?php

// Disable option page for this addon
add_filter('wpbc/filter/custom_login/options_page/enable','__return_false',10,1);

// Enable adddon
add_filter('wpbc/filter/custom_login/enable','__return_true',10,1);

// Set arguments by default
add_filter('wpbc/filter/custom_login/default_args', function($args){
	/* EX */

	$args['body'] = array(
		'background-color' => '#f3f1ed',
	);

	$args['login_brand'] = array(
		'background-image' => get_stylesheet_directory_uri().'/images/theme/logo-nomade.svg',
		'background-size' => '163px auto',
		'width' => '163px',
		'height' => '46px',
	);
	
	return $args;

},10,1); 


add_action( 'login_head', function(){
 
?>

<style>
	
	.login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover{

		color: #714d3e;

	}

	.login form .input, .login input[type=password], .login input[type=text]{

		border-radius: 0;

	}

	.wp-core-ui .button-primary{

		background: #714d3e;
    border-color: #714d3e;
    border-radius: 0;

	}

</style>

<?php

} );