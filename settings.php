<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function alobaidi_infinite_scroll_to_tf_text_messages_field(){
	add_settings_section('o_infinite_scroll_section_tf', 'Infinite Scroll Text Messages', false, 'reading');
	
	add_settings_field( "ob_inf_scr_tf_load_text", "Loading Text Message", "alobaidi_infinite_scroll_to_tf_load_text", "reading", "o_infinite_scroll_section_tf", array('label_for' => 'ob_inf_scr_tf_load_text') );
	register_setting( 'reading', 'ob_inf_scr_tf_load_text' );
	
	add_settings_field( "ob_inf_scr_tf_done_text", "Finished Text Message", "alobaidi_infinite_scroll_to_tf_done_text", "reading", "o_infinite_scroll_section_tf", array('label_for' => 'ob_inf_scr_tf_done_text') );
	register_setting( 'reading', 'ob_inf_scr_tf_done_text' );
}
add_action( 'admin_init', 'alobaidi_infinite_scroll_to_tf_text_messages_field' );


function alobaidi_infinite_scroll_to_tf_load_text(){
	if (get_option( 'ob_inf_scr_tf_load_text' )){
		$msgText = get_option( 'ob_inf_scr_tf_load_text' );
	}else{
		$msgText = 'Loading posts ...';
	}
	?>
    <input class="regular-text" id="ob_inf_scr_tf_load_text" name="ob_inf_scr_tf_load_text" type="text" value="<?php echo $msgText; ?>">
    <?php
}


function alobaidi_infinite_scroll_to_tf_done_text(){
	if (get_option( 'ob_inf_scr_tf_done_text' )){
		$finishedMsg = get_option( 'ob_inf_scr_tf_done_text' );
	}else{
		$finishedMsg = 'No more posts!';
	}
	?>
    <input class="regular-text" id="ob_inf_scr_tf_done_text" name="ob_inf_scr_tf_done_text" type="text" value="<?php echo $finishedMsg; ?>">
    <?php
}

?>