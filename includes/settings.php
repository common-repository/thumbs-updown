<?php

// this file contains all settings pages and options

function lip_settings_page()
{
	global $lip_options;
		
	?>
	<div class="wrap">
		<div id="upb-wrap" class="upb-help">
			<h2><?php _e('Thumbs up\down settings', 'love_hate'); ?></h2>
			<?php
			if ( ! isset( $_REQUEST['updated'] ) )
				$_REQUEST['updated'] = false;
			?>
			<?php if ( false !== $_REQUEST['updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
			<?php endif; ?>
			<form method="post" action="options.php">

				<?php settings_fields( 'lip_settings_group' ); ?>
				
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">
								<?php _e('Show on Post Types', 'love_hate'); ?>
							</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Show on Post Types', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[post_types][]">
										<?php
										$post_types = get_post_types(array('public' => true), 'objects');
										$saved_post_types = isset($lip_options['post_types']) ? $lip_options['post_types'] : array();
										foreach($post_types as $post_type) { ?>
											<input id="lip_settings[post_types][<?php echo $post_type->name; ?>]" name="lip_settings[post_types][<?php echo $post_type->name; ?>]" type="checkbox" value="<?php echo $post_type->name; ?>" <?php checked(true, in_array($post_type->name, $saved_post_types) ); ?>/> <span> <?php echo $post_type->labels->name; ?></span><br/>
										<?php } ?>
										
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">
								<?php _e('Exceptions for pages <br />(enter IDs sep. by comma)', 'love_hate'); ?>
							</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Love It Links', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[except]">
										<input id="lip_settings[except]" name="lip_settings[except]" type="text" value="<?php echo $lip_options['except'];?>" />
										
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">
								<?php _e('Exceptions for posts <br />(enter IDs sep. by comma)', 'love_hate'); ?>
							</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Love It Links', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[except-p]">
										<input id="lip_settings[except-p]" name="lip_settings[except-p]" type="text" value="<?php echo $lip_options['except-p'];?>" />
										
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">
								<?php _e('Love It Links', 'love_hate'); ?>
							</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Love It Links', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[show_links]">
										<input id="lip_settings[show_links]" name="lip_settings[show_links]" type="checkbox" value="1" <?php checked( '1', $lip_options['show_links'] ); ?>/>
										<?php _e( 'Display raiting panel below the content automatically ?', 'love_hate' ); ?>
									</label>
								</fieldset>
							</td>
						</tr>
				<tr valign="top">
							<th scope="row">
								<?php _e('Panel heading', 'love_hate'); ?>
							</th>
							
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Panel heading', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[panel_heading]">
										<input id="lip_settings[panel_heading]" name="lip_settings[panel_heading]" type="text" value="<?php echo $lip_options['panel_heading'];?>" />
										<p class="description"><?php _e( 'Enter "space" to delete heading.', 'love_hate' ); ?></p>
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">
								<?php _e('Like-button text', 'love_hate'); ?>
							</th>
							
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Like-button text', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[love_but_text]">
										<input id="lip_settings[love_but_text]" name="lip_settings[love_but_text]" type="text" value="<?php echo $lip_options['love_but_text'];?>" />
										
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">
							<?php _e('Dislike-button text', 'love_hate'); ?>
							</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Dislike-button text', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[hate_but_text]">
										<input id="lip_settings[hate_but_text]" name="lip_settings[hate_but_text]" type="text" value="<?php echo $lip_options['hate_but_text'];?>" />
										
									</label>
								</fieldset>
							</td>
						</tr>
						
							
						<tr valign="top">
							<th scope="row">
								<?php _e('Custom CSS', 'love_hate'); ?>
							</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span><?php _e('Custom CSS', 'love_hate'); ?></span>
									</legend>
									<label for="lip_settings[custom_css]">
										<textarea id="lip_settings[custom_css]" style="width: 400px; height: 150px;" name="lip_settings[custom_css]" type="text"><?php echo $lip_options['custom_css'];?></textarea><br/>
										<p class="description"><?php _e( 'Enter custom CSS here to customize the appearance of this plugin.', 'love_hate' ); ?></p>
									</label>
								</fieldset>
							</td>
						</tr>
					</tbody>
				</table>
				
				<!-- save the options -->
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'love_hate' ); ?>" />
				</p>
										
			</form>
		</div><!--end sf-wrap-->
	</div><!--end wrap-->		
	<?php
}

// register the plugin settings
function lip_register_settings() {

	// create whitelist of options
	register_setting( 'lip_settings_group', 'lip_settings' );
}
//call register settings function
add_action( 'admin_init', 'lip_register_settings' );


function lip_settings_menu() {
	global $love_hate_page;
	// add settings page
	$love_hate_page = add_submenu_page('options-general.php', __('Thumbs up\down', 'love_hate'), __('Thumbs up\down', 'love_hate'),'manage_options', 'love-it-settings', 'lip_settings_page');
	
	
}
add_action('admin_menu', 'lip_settings_menu');



