<?php
/*
Plugin Name: Thumbs up\down
Plugin URI: https://github.com/DreaMinder/Love-or-Hate-wordpress-plugin.git
Description: Youtube-like rating system with thumbs up and thumbs down buttons. 
Version: 0.1
Author: Anatoliy Osypenko 
Made using functions of 'Love It' (Pippin Williamson) plugin. It's temporary, I am going to rewrite it in the next version.
This is my very first plugin. So if you want to give a piece of advice - I would be very happy. Email: DreaMinder@DreaMinder.pro 
*/

/***************************
* constants
***************************/

if(!defined('LI_BASE_DIR')) {
	define('LI_BASE_DIR', dirname(__FILE__));
}
if(!defined('LI_BASE_URL')) {
	define('LI_BASE_URL', plugin_dir_url(__FILE__));
}
if(!defined('LI_BASE_FILE')) {
	define('LI_BASE_FILE', __FILE__);
}

$lip_options = get_option('lip_settings');

/***************************
* includes
***************************/
include(LI_BASE_DIR . '/includes/display-functions.php');
include(LI_BASE_DIR . '/includes/love-functions.php');
include(LI_BASE_DIR . '/includes/scripts.php');
if(is_admin()) {
	include(LI_BASE_DIR . '/includes/settings.php');};