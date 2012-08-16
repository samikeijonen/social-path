<?php
/**
 * Plugin Name: Social Path
 * Plugin URI: http://foxnet.fi
 * Description: Share your posts on Twitter, Google+ and Facebook.
 * Version: 0.1.1
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
 * @version 0.1.1
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
		wp_enqueue_script( 'social_path_all', SOCIAL_PATH_URI . 'js/facebook-twitter-google.js', '', '20120816', true );
		
		/* 'Localize' language. @link: http://pippinsplugins.com/use-wp_localize_script-it-is-awesome */
		wp_localize_script( 'social_path_all', 'social_path_settings_vars', array( 'language' => social_path_get_locale() ) );
		
	}
	
}

/**
 * Get the locale and set it for the Facebook SDK
 * Credit: Code is from facebook plugin. http://wordpress.org/extend/plugins/facebook/
 * @since 0.1.1
 */
function social_path_get_locale() {
	$social_path_valid_fb_locales = array(
		'ca_ES', 'cs_CZ', 'cy_GB', 'da_DK', 'de_DE', 'eu_ES', 'en_PI', 'en_UD', 'ck_US', 'en_US', 'es_LA', 'es_CL', 'es_CO', 'es_ES', 'es_MX',
		'es_VE', 'fb_FI', 'fi_FI', 'fr_FR', 'gl_ES', 'hu_HU', 'it_IT', 'ja_JP', 'ko_KR', 'nb_NO', 'nn_NO', 'nl_NL', 'pl_PL', 'pt_BR', 'pt_PT',
		'ro_RO', 'ru_RU', 'sk_SK', 'sl_SI', 'sv_SE', 'th_TH', 'tr_TR', 'ku_TR', 'zh_CN', 'zh_HK', 'zh_TW', 'fb_LT', 'af_ZA', 'sq_AL', 'hy_AM',
		'az_AZ', 'be_BY', 'bn_IN', 'bs_BA', 'bg_BG', 'hr_HR', 'nl_BE', 'en_GB', 'eo_EO', 'et_EE', 'fo_FO', 'fr_CA', 'ka_GE', 'el_GR', 'gu_IN',
		'hi_IN', 'is_IS', 'id_ID', 'ga_IE', 'jv_ID', 'kn_IN', 'kk_KZ', 'la_VA', 'lv_LV', 'li_NL', 'lt_LT', 'mk_MK', 'mg_MG', 'ms_MY', 'mt_MT',
		'mr_IN', 'mn_MN', 'ne_NP', 'pa_IN', 'rm_CH', 'sa_IN', 'sr_RS', 'so_SO', 'sw_KE', 'tl_PH', 'ta_IN', 'tt_RU', 'te_IN', 'ml_IN', 'uk_UA',
		'uz_UZ', 'vi_VN', 'xh_ZA', 'zu_ZA', 'km_KH', 'tg_TJ', 'ar_AR', 'he_IL', 'ur_PK', 'fa_IR', 'sy_SY', 'yi_DE', 'gn_PY', 'qu_PE', 'ay_BO',
		'se_NO', 'ps_AF', 'tl_ST'
	);

	$locale = get_locale();

	// convert locales like "fi" to "fi_FI", in case that works for the given locale (sometimes it does)
	if ( strlen($locale) == 2 ) {
		$locale = strtolower( $locale ).'_'.strtoupper( $locale );
	}

	// convert things like de-DE to de_DE
	$locale = str_replace( '-', '_', $locale );

	// check to see if the locale is a valid FB one, if not, use en_US as a fallback
	if ( !in_array($locale, $social_path_valid_fb_locales ) ) {
		$locale = 'en_US';
	}

	return apply_filters( 'social_path_locale', $locale ); // filter the locale in case somebody has a weird case and needs to change it
}

 ?>