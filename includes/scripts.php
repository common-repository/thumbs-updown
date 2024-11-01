<?php

function lip_front_end_js() {
	wp_enqueue_script('love-it', LI_BASE_URL . '/includes/js/love-hate.js', array( 'jquery' ) );
	
	wp_enqueue_style('my-custom-style',  LI_BASE_URL . 'includes/love-hate.css','all');
	
	
		wp_enqueue_script( 'jquery-coookies', LI_BASE_URL . '/includes/js/jquery.cookie.js', array( 'jquery' ) );
		wp_localize_script( 'love-it', 'hate_it_vars', 
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('hate-it-nonce'),
			'already_hated_message' => __('You have already hated this item.', 'hate_it'),
			'error_message' => __('Sorry, there was a problem processing your request.', 'hate_it'),
			'logged_in' => is_user_logged_in() ? 'true' : 'false'
		) 
	);
	wp_localize_script( 'love-it', 'love_it_vars', 
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('love-it-nonce'),
			'already_loved_message' => __('You have already loved this item.', 'love_it'),
			'error_message' => __('Sorry, there was a problem processing your request.', 'love_it'),
			'logged_in' => is_user_logged_in() ? 'true' : 'false'
		) 
	);	

	
}
add_action('wp_enqueue_scripts', 'lip_front_end_js');

function lip_custom_css() {
	global $lip_options;
	if(isset($lip_options['custom_css']) && $lip_options['custom_css'] != '') {
		echo '<style type="text/css">
		
		' . 
		
	$lip_options['custom_css'] . '</style>';
	}
}
add_action('wp_head', 'lip_custom_css');


