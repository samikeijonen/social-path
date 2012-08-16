=== Social Path ===
Contributors: samikeijonen
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=E65RCFVD3QGYU
Tags: social, facebook, twitter, google, media
Requires at least: 3.3
Tested up to: 3.4.1
Stable tag: 0.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Share your posts on Twitter, Google+ and Facebook.

== Description ==

This mini plugin integrates automatically with Path Theme. Just activate this plugin and you can share your posts on Twitter, Google+ and Facebook.
Plugin adds these buttons after singular post.

If you want to use this plugin with another theme add this in your template file.

`
if ( function_exists( 'social_path_media' ) )
	social_path_media();
`

== Installation ==

1. Upload `social-path` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. That's it, if you're using Path theme.

== Frequently Asked Questions ==

= Why was this plugin created? =

I needed this feature to be in a plugin because I changed theme a lot and I felt this was a plugin territory.

= But there are many good social plugins already? =

Yes but I wanted to keep it as simple as possible.

= Where is options page? =

There isn't one. There is zero option in this plugin.

== Screenshots ==

1. Social button after singular post


== Changelog ==

= 0.1.1 =

* Like button was in finnish. Now it should be your own language, fallback is en_US.

= 0.1 =
* Everything's brand new.