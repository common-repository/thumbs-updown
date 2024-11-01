<?php


// increments a hate count
function liph_mark_post_as_hated($post_id, $user_id) {

	$hate_count = get_post_meta($post_id, '_li_hate_count', true);
	if($hate_count)
		$hate_count = $hate_count + 1;
	else
		$hate_count = 1;
	
	if(update_post_meta($post_id, '_li_hate_count', $hate_count)) {
		if(is_user_logged_in()) {
			liph_store_hated_id_for_user($user_id, $post_id);
		}
		return true;
	}

	return false;
}



// returns a hate count for a post
function liph_get_hate_count($post_id) {
	$hate_count = get_post_meta($post_id, '_li_hate_count', true);
	if($hate_count)
		return $hate_count;
	return 0;
}

// processes the ajax request
function liph_process_hate() {
	if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['hate_it_nonce'], 'hate-it-nonce') ) {
		if(liph_mark_post_as_hated($_POST['item_id'], $_POST['user_id'])) {
			echo 'hated';
		} else {
			echo 'failed';
		}
	}
	die();
}
add_action('wp_ajax_hate_it', 'liph_process_hate');
add_action('wp_ajax_nopriv_hate_it', 'liph_process_hate');



// increments a love count
function lip_mark_post_as_loved($post_id, $user_id) {

	$love_count = get_post_meta($post_id, '_li_love_count', true);
	if($love_count)
		$love_count = $love_count + 1;
	else
		$love_count = 1;
	
	if(update_post_meta($post_id, '_li_love_count', $love_count)) {
		if(is_user_logged_in()) {
			lip_store_loved_id_for_user($user_id, $post_id);
		}
		return true;
	}

	return false;
}


// returns a love count for a post
function lip_get_love_count($post_id) {
	$love_count = get_post_meta($post_id, '_li_love_count', true);
	if($love_count)
		return $love_count;
	return 0;
}

// processes the ajax request
function lip_process_love() {
	if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['love_it_nonce'], 'love-it-nonce') ) {
		if(lip_mark_post_as_loved($_POST['item_id'], $_POST['user_id'])) {
			echo 'loved';
		} else {
			echo 'failed';
		}
	}
	die();
}
add_action('wp_ajax_love_it', 'lip_process_love');
add_action('wp_ajax_nopriv_love_it', 'lip_process_love');

register_sidebar(array(
  'name' => __( 'Dislike widget' ),
  'id' => 'dislike-widget',
  'description' => __( 'Widget appear when dislike rating button clicked.' ),
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));
register_sidebar(array(
  'name' => __( 'Like widget' ),
  'id' => 'like widget',
  'description' => __( 'Widget appear when like rating button clicked.' ),
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));