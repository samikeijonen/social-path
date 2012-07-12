<?php
/**
 * Plugin Name: Social Path
 * Plugin URI: http://foxnet.fi
 * Description: Share your posts on Twitter, Google+ and Facebook.
 * Version: 0.1
 * Author: Sami Keijonen
 * Author URI: http://foxnet.fi
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package SocialPath
 * @version 0.1.0
 * @author Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright Copyright (c) 2012, Sami Keijonen
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
 /* Set up the plugin on the 'plugins_loaded' hook. */
add_action( 'plugins_loaded', 'social_path_shortcode_setup' );

/**
 * Plugin setup function.  Loads actions and filters to their appropriate hook.
 *
 * @since 0.1.0
 */
function social_path_shortcode_setup() {

	/* Load the translation of the plugin. */
	load_plugin_textdomain( 'social-path', false, 'social-path/languages' );

	/* Get the plugin directory URI. */
	define( 'SOCIAL_PATH_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	
	/* Enqueue social media codes. */
	add_action( 'wp_enqueue_scripts', 'social_path_media_codes' );

}

/**
 * Add social media after entry. Twitter tweet, Google+ and Facebook like.
 *
 * @since 0.1.0
 */
function social_path_media() {
	?>
	
	<div id="social-media">
		
		<div class="tweet">
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-text="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>"><?php _e( 'Tweet', 'social-path' ); ?></a>
		</div>
		
		<div class="google">
			<g:plusone size="medium" annotation="none" href="<?php the_permalink(); ?>"></g:plusone>
		</div>
		
		<div class="fb-like" data-layout="button_count" data-send="false" data-width="160" data-show-faces="false"></div>
		
	</div>
	
	<?php
}

/**
 * Add social media codes to single posts.
 * @since 0.1.0
 */
function social_path_media_codes() {
	
	if ( is_single() ) {
	
		/* Enqueue facebook, twitter and Google js code. */	
		wp_enqueue_script( 'social_path_all', SOCIAL_PATH_URI . 'js/facebook-twitter-google.js', '', '20120707', true );
		
	}
	
}

 ?>