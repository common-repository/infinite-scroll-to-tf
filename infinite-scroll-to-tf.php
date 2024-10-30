<?php
/*
Plugin Name: Infinite Scroll To TF
Plugin URI: http://wp-plugins.in/infinite-scroll-to-tf
Description: Add Infinite Scroll to Twenty Fifteen theme easily, animation effect and custom text messages, easy to use, just activate plugin.
Version: 1.0.0
Author: Alobaidi
Author URI: http://wp-plugins.in
License: GPLv2 or later
*/

/*  Copyright 2015 Alobaidi (email: wp-plugins@outlook.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function alobaidi_infinite_scroll_to_tf_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'infinite-scroll-to-tf.php' ) !== false ) {
		
		$new_links = array(
						'<a href="http://wp-plugins.in/infinite-scroll-to-tf" target="_blank">Explanation of Use</a>',
						'<a href="https://profiles.wordpress.org/alobaidi#content-plugins" target="_blank">More Plugins</a>',
						'<a href="http://j.mp/ET_WPTime_ref_pl" target="_blank">Elegant Themes</a>'
					);
		
		$links = array_merge( $links, $new_links );
		
	}
	
	return $links;
	
}
add_filter( 'plugin_row_meta', 'alobaidi_infinite_scroll_to_tf_plugin_row_meta', 10, 2 );


include( plugin_dir_path( __FILE__ ) . '/settings.php' );


function alobaidi_infinite_scroll_to_tf_include_js_and_css(){
	if( !is_singular() ){
		wp_enqueue_style( 'alobaidi-infinite-scroll-to-tf-css', plugins_url( '/css/animation-effect.css', __FILE__ ), false, null );
		wp_enqueue_script( 'alobaidi-infinite-scroll-to-tf-js', plugins_url('/js/jquery.infinitescroll.min.js', __FILE__ ), array('jquery'), null );
	}
}
add_action('wp_enqueue_scripts', 'alobaidi_infinite_scroll_to_tf_include_js_and_css');


function alobaidi_infinite_scroll_to_tf_head(){
	if( !is_singular() ){
		?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('nav.navigation').remove(); // remove navigation
				});
			</script>
		<?php
	}
}
add_action('wp_head', 'alobaidi_infinite_scroll_to_tf_head');


function alobaidi_infinite_scroll_to_tf_footer(){
	if( !is_singular() ){

		if (get_option( 'ob_inf_scr_tf_load_text' )){
			$msgText = get_option( 'ob_inf_scr_tf_load_text' );
		}else{
			$msgText = 'Loading posts ...';
		}

		if (get_option( 'ob_inf_scr_tf_done_text' )){
			$finishedMsg = get_option( 'ob_inf_scr_tf_done_text' );
		}else{
			$finishedMsg = 'No more posts!';
		}

		$loading = '<p style="text-align:center;">'.$msgText.'</p>';
	
		$done = '<p style="text-align:center;">'.$finishedMsg.'</p>';

	?>
		?>
    		<div id="alobaidi-infinite-scroll-to-tf">
				<?php next_posts_link('Next page'); ?>
			</div>
    
			<script type="text/javascript">
				jQuery(document).ready(function() {
  					jQuery('#main').infinitescroll({
    					navSelector  : "#alobaidi-infinite-scroll-to-tf",  // selector for the paged navigation (it will be hidden)
    					nextSelector : "#alobaidi-infinite-scroll-to-tf a:first",  // selector for the NEXT link (to page number 2)
    					itemSelector : "#main .hentry",  // selector for all items you'll retrieve
						debug        : false,  // disable debug messaging ( to console.log )
						loading: {
							img    		 : "data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==", // loading image
							msgText  	 : '<?php echo $loading; ?>',  // loading message
							finishedMsg  : '<?php echo $done; ?>' // finished message
						},
						animate    : false, // if the page will do an animated scroll when new content loads
						dataType   : 'html'  // data type is html
  					});
				});
			</script>
		<?php
	}
}
add_action('wp_footer', 'alobaidi_infinite_scroll_to_tf_footer');


function alobaidi_infinite_scroll_to_tf_animation_classes($classes){
	if( !is_singular() ){
		$classes[] = 'animated-ob-inf-scr-tf fadeInUp-ob-inf-scr-tf alobaidi-infinite-scroll-to-tf';
	}
	return $classes;
}
add_filter( 'post_class', 'alobaidi_infinite_scroll_to_tf_animation_classes' );


?>