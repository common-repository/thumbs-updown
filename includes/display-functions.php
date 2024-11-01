<?php

// checks to see if Love It links should be shown automatically
function lip_show_links() {
	global $lip_options, $post;
	if(isset($lip_options['show_links']) && is_array($lip_options['post_types'])) {
		if(in_array(get_post_type($post), $lip_options['post_types'])) {
			add_filter('the_content', 'lip_display_love_link');
		}
	}
}
add_action('template_redirect', 'lip_show_links');

// adds the Love It link and count to post/page content
function lip_display_love_link($content) {

	global $lip_options, $post;

	// takes functions of like and dislike buttons to output
	if( is_singular()) {

		$link = liph_hate_it_link($post->ID, $link_text, $already_hated, false);
		
	
			$content = $content . $link;
	
		$link = lip_love_it_link($post->ID, $link_text, $already_loved, false);
		
	
			$content = $content . $link;
		
	}
	return $content;
}


function liph_hate_it_link($post_id = null, $link_text, $already_hated, $echo = true) {

	global $user_ID, $post, $lip_options;

	if(is_null($post_id)) {
		$post_id = $post->ID;
	};
	//if settings not configured in admin-page
	if(!isset($lip_options['panel_heading'])){$lip_options['panel_heading']='Rate it';};
	if(!isset($lip_options['love_but_text'])){$lip_options['love_but_text']='Nice';};
	if(!isset($lip_options['hate_but_text'])){$lip_options['hate_but_text']='Dislike it';};
	
	// retrieve the total hate count for this item
	$hate_count = liph_get_hate_count($post_id);
	
	$exept_pages = explode(',', $lip_options['except']);
	$exept_posts = explode(',', $lip_options['except-p']);
	ob_start();
		
	if(!(is_page($exept_pages) or is_single($exept_posts)) ){
	// our wrapper DIV
	echo '<div class="area-rate"><h3 class="additional_posts_title">'.$lip_options['panel_heading'].'</h3>
	<div class="rate-line">	</div>
	<div class="love-counter"></div><div class="hate-counter"></div>
	<div style="clear:both"></div>
	<div class="hate-it-wrapper">';		
			echo '<a href="" class="hate-it hatebut button" data-post-id="' . $post_id . '" data-user-id="' .  $user_ID . '">'.$lip_options['hate_but_text'].' <span class="hate-count">' . $hate_count . '</span></a>
';	
	echo '</div>';};
	
	// I dont know what is that doing here :[
	if($echo)
		echo ob_get_clean();
	else
		return ob_get_clean();
}

function lip_love_it_link($post_id = null, $link_text, $already_loved, $echo = true) {

	global $user_ID, $post, $lip_options;

	if(is_null($post_id)) {
		$post_id = $post->ID;
	};	
	
	// retrieve the total love count for this item
	$love_count = lip_get_love_count($post_id);
	
	$exept_pages = explode(',', $lip_options['except']);
	$exept_posts = explode(',', $lip_options['except-p']);
	ob_start();

	if(!(is_page($exept_pages) or is_single($exept_posts)) ){
	// our wrapper DIV
	echo '

	<div class="love-it-wrapper">
	<a href="" class="love-it lovebut button" data-post-id="' . $post_id . '" data-user-id="' .  $user_ID . '">'.$lip_options['love_but_text'].'<span class="love-count">' . $love_count . '</span></a></div>
			
	<div class="block-hated" style="display: none; "><h3>Your opinion is important for us</h3>';if ( !function_exists('dynamic_sidebar') || 
!dynamic_sidebar('Dislike widget') ) : 	endif;
echo '</div>
<div class="block-loved" style="display: none; "><h3>Thanks!</h3>';if ( !function_exists('dynamic_sidebar') || 
!dynamic_sidebar('Like widget') ) : 	endif;

	// close our wrapper DIV
	echo '</div><div style="clear:both; height:20px"></div></div>';};
	
	
	if($echo)
		echo ob_get_clean();
	else
		return ob_get_clean();
}