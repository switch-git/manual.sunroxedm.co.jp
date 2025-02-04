<?php

function tcd_quicktag_admin_init() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	if ( $dp_options['use_quicktags'] && ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) ) {
		add_filter( 'mce_external_plugins', 'tcd_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'tcd_register_mce_button' );
		add_action( 'admin_print_footer_scripts', 'tcd_add_quicktags' );

		// Dynamic css for classic visual editor
		add_filter( 'editor_stylesheets', 'editor_stylesheets_tcd_visual_editor_dynamic_css' );

		// Dymamic css for visual editor on block editor
		wp_enqueue_style( 'tcd-quicktags', get_tcd_quicktags_dynamic_css_url(), false, version_num() );
	}
}
add_action( 'admin_init', 'tcd_quicktag_admin_init' );

// Declare script for new button
function tcd_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tcd_mce_button'] = get_template_directory_uri() . '/admin/js/mce-button.js?ver=' . version_num();
	return $plugin_array;
}

// Register new button in the editor
function tcd_register_mce_button( $buttons ) {
	array_push( $buttons, 'tcd_mce_button' );
	return $buttons;
}

function tcd_add_quicktags() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$custom_buttons = array();
	for ( $i = 1; $i <= 2; $i++ ) {
		$custom_button_class = 'q_custom_button' . $i;
		$custom_button_class .= ' animation_' . $dp_options['qt_custom_button_animation_type' . $i];

		if ( 'type2' === $dp_options['qt_custom_button_type' . $i] ) {
			$custom_button_class .= ' rounded';
		} elseif ( 'type3' === $dp_options['qt_custom_button_type' . $i] ) {
			$custom_button_class .= ' pill';
		}
		if ( 'type1' === $dp_options['qt_custom_button_size' . $i] ) {
			$custom_button_size = 'width:130px; height:40px;';
		} elseif ( 'type2' === $dp_options['qt_custom_button_size' . $i] ) {
			$custom_button_size = 'width:240px; height:60px;';
		} elseif ( 'type3' === $dp_options['qt_custom_button_size' . $i] ) {
			$custom_button_size = 'width:400px; height:70px;';
		}

		$custom_buttons[$i] = '<div class="q_button_wrap"><a href="#" class="q_custom_button ' . $custom_button_class . '" style="' . $custom_button_size . '">' . sprintf( __( 'Button %d', 'tcd-w' ), $i ) . '</a></div>';
	}

	$speech_balloons = array();
	for ( $i = 1; $i <= 4; $i++ ) {
		$user_image = null;
		if ( $dp_options['qt_speech_balloon_user_image' . $i] ) {
			$user_image = wp_get_attachment_url( $dp_options['qt_speech_balloon_user_image' . $i] );
		}

		if ( $user_image ) {
			$user_image_url = $user_image;
		} else {
			$user_image_url = get_template_directory_uri() . '/img/common/no_avatar.png';
		}

		if ( 2 === $i ) {
			$tag = 'speech_balloon_left2';
		} elseif ( 3 === $i ) {
			$tag = 'speech_balloon_right1';
		} elseif ( 4 === $i ) {
			$tag = 'speech_balloon_right2';
		} elseif ( 1 === $i ) {
			$tag = 'speech_balloon_left1';
		}

		$speech_balloons[$i][0] = esc_attr( $user_image_url );
		$speech_balloons[$i][1] = esc_attr( $dp_options['qt_speech_balloon_user_name' . $i] );
	}

	$tcdQuicktagsL10n = array(
		'pulldown_title' => array(
			'display' => __( 'quicktags', 'tcd-w' ),
		),
		'ytube' => array(
			'display' => __( 'Youtube', 'tcd-w' ),
			'tag' => __( '<div class="ytube">Youtube code here</div>', 'tcd-w' )
		),
		'relatedcardlink' => array(
			'display' => __( 'Cardlink', 'tcd-w' ),
			'tag' => __( '[clink url="Post URL to display"]', 'tcd-w' )
		),
		'post_col-2' => array(
			'display' => __( '2 column', 'tcd-w' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-2">Text and image tags to display in the left column</div><div class="post_col post_col-2">Text and image tags to display in the right column</div></div>', 'tcd-w' )
		),
		'post_col-3' => array(
			'display' => __( '3 column', 'tcd-w' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-3">Text and image tags to display in the left column</div><div class="post_col post_col-3">Text and image tags to display in the center column</div><div class="post_col post_col-3">Text and image tags to display in the right column</div></div>', 'tcd-w' )
		),
		'q_comment_out' => array(
			'display' => __( 'Comment out', 'tcd-w' ),
			'tagStart' => '<div class="hidden"><!-- ',
			'tagEnd' => ' --></div>'
		),
		'q_h2' => array(
			'display' => __( 'Styled h2 tag', 'tcd-w' ),
			'tagStart' => '<h2 class="styled_h2">',
			'tagEnd' => '</h2>'
		),
		'q_h3' => array(
			'display' => __( 'Styled h3 tag', 'tcd-w' ),
			'tagStart' => '<h3 class="styled_h3">',
			'tagEnd' => '</h3>'
		),
		'q_h4' => array(
			'display' => __( 'Styled h4 tag', 'tcd-w' ),
			'tagStart' => '<h4 class="styled_h4">',
			'tagEnd' => '</h4>'
		),
		'q_h5' => array(
			'display' => __( 'Styled h5 tag', 'tcd-w' ),
			'tagStart' => '<h5 class="styled_h5">',
			'tagEnd' => '</h5>'
		),
		'well2' => array(
			'display' => __( 'Frame style', 'tcd-w' ),
			'tagStart' => '<div class="well2">',
			'tagEnd' => '</div>'
		),
		'basic_button' => array(
			'display' => __( 'Basic button', 'tcd-w' ),
			'tag' => '<div class="design_button ' . esc_attr($dp_options['design_button_type']) . ' shape_' . esc_attr($dp_options['design_button_shape']) .  ' quick_tag_ver"><a href="#"><span class="label">' . __( 'basic button', 'tcd-w' ) . '</span></a></div>'
		),
		'q_custom_button1' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-w' ), 1 ),
			'tag' => $custom_buttons[1]
		),
		'q_custom_button2' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-w' ), 2 ),
			'tag' => $custom_buttons[2]
		),
		'q_underline1' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-w' ), 1 ),
			'tagStart' => '<span class="q_underline q_underline1" style="border-bottom-color: ' . esc_attr( $dp_options['qt_underline_color1'] ) . ';">',
			'tagEnd' => '</span>'
		),
		'q_underline2' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-w' ), 2 ),
			'tagStart' => '<span class="q_underline q_underline2" style="border-bottom-color: ' . esc_attr( $dp_options['qt_underline_color2'] ) . ';">',
			'tagEnd' => '</span>'
		),
		'q_underline3' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-w' ), 3 ),
			'tagStart' => '<span class="q_underline q_underline3" style="border-bottom-color: ' . esc_attr( $dp_options['qt_underline_color3'] ) . ';">',
			'tagEnd' => '</span>'
		),
		'speech_balloon_left1' => array(
			'display' => __( 'Speech balloon left 1', 'tcd-w' ),
			'tagStart' => '[speech_balloon_left1 user_image_url="'. $speech_balloons[1][0] .'" user_name="'. $speech_balloons[1][1] .'"]',
			'tagEnd' => '[/speech_balloon_left1]'
		),
		'speech_balloon_left2' => array(
			'display' => __( 'Speech balloon left 2', 'tcd-w' ),
			'tagStart' => '[speech_balloon_left2 user_image_url="'. $speech_balloons[2][0] .'" user_name="'. $speech_balloons[2][1] .'"]',
			'tagEnd' => '[/speech_balloon_left2]'
		),
		'speech_balloon_right1' => array(
			'display' => __( 'Speech balloon right 1', 'tcd-w' ),
			'tagStart' => '[speech_balloon_right1 user_image_url="'. $speech_balloons[3][0] .'" user_name="'. $speech_balloons[3][1] .'"]',
			'tagEnd' => '[/speech_balloon_right1]'
		),
		'speech_balloon_right2' => array(
			'display' => __( 'Speech balloon right 2', 'tcd-w' ),
			'tagStart' => '[speech_balloon_right2 user_image_url="'. $speech_balloons[4][0] .'" user_name="'. $speech_balloons[4][1] .'"]',
			'tagEnd' => '[/speech_balloon_right2]'
		),
		'google_map' => array(
			'display' => __( 'Google map' ),
			'tag' => '[qt_google_map address="'. __( 'Enter address here', 'tcd-w' ) . '"]'
		),
		'accordion_type1' => array(
			'display' => __( 'FAQ1' ),
			'tag' => '[faq1 q="'. __( 'Enter question here', 'tcd-w' ) . '" a="'. __( 'Enter answer here', 'tcd-w' ) . '"]'
		),
		'accordion_type2' => array(
			'display' => __( 'FAQ2' ),
			'tag' => '[faq2 q="'. __( 'Enter question here', 'tcd-w' ) . '" a="'. __( 'Enter answer here', 'tcd-w' ) . '"]'
		),
		'tcd_tab2' => array(
			'display' => __( 'Tab2', 'tcd-w' ),
			'tag' => '[tcd_tab tab1="'.__( 'Tab name', 'tcd-w' ).'1" desc1="'.__( 'Enter description here', 'tcd-w' ).'" img1="'.__( 'Enter image URL here', 'tcd-w' ).'" tab2="'.__( 'Tab name', 'tcd-w' ).'2" desc2="'.__( 'Enter description here', 'tcd-w' ).'" img2="'.__( 'Enter image URL here', 'tcd-w' ).'"]'
		),
		'tcd_tab3' => array(
			'display' => __( 'Tab3', 'tcd-w' ),
			'tag' => '[tcd_tab tab1="'.__( 'Tab name', 'tcd-w' ).'1" img1="'.__( 'Enter image URL here', 'tcd-w' ).'" desc1="'.__( 'Enter description here', 'tcd-w' ).'" tab2="'.__( 'Tab name', 'tcd-w' ).'2" desc2="'.__( 'Enter description here', 'tcd-w' ).'" img2="'.__( 'Enter image URL here', 'tcd-w' ).'" tab3="'.__( 'Tab name', 'tcd-w' ).'3" desc3="'.__( 'Enter description here', 'tcd-w' ).'" img3="'.__( 'Enter image URL here', 'tcd-w' ).'"]'
		)
	);
?>
<script type="text/javascript">
<?php
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		echo "var tcdQuicktagsL10n = " . json_encode( $tcdQuicktagsL10n ) . ";\n";
	}
	if ( wp_script_is( 'quicktags' ) ) {
		foreach ( $tcdQuicktagsL10n as $key => $value ) {
			if ( is_numeric( $key ) || empty( $value['display'] ) ) continue;
			if ( empty( $value['tag'] ) && empty( $value['tagStart'] ) ) continue;

			if ( isset( $value['tag'] ) && ! isset( $value['tagStart'] ) ) {
				$value['tagStart'] = $value['tag'] . "\n\n";
			}
			if ( ! isset( $value['tagEnd'] ) ) {
				$value['tagEnd'] = '';
			}

			$key = json_encode( $key );
			$display = json_encode( $value['display'] );
			$tagStart = json_encode( $value['tagStart'] );
			$tagEnd = json_encode( $value['tagEnd'] );
			echo "QTags.addButton($key, $display, $tagStart, $tagEnd);\n";
		}
	}
?>
</script>
<?php
}

// Get dymamic css url
function get_tcd_quicktags_dynamic_css_url() {
	return admin_url( 'admin-ajax.php?action=tcd_quicktags_dynamic_css' );
}

// Dymamic css for visual editor
function tcd_ajax_quicktags_dynamic_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	header( 'Content-Type: text/css; charset=UTF-8' );

?>
.styled_h2, .editor-styles-wrapper .styled_h2 {
  font-size:<?php echo esc_attr($dp_options['qt_h2_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h2_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h2_font_color']); ?>; <?php if($dp_options['show_qt_h2_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h2_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h2_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h2_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h2_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h2_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h2_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h2_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h2_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h2_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h2_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h2_margin_bottom']); ?>px;
}
.styled_h3, .editor-styles-wrapper .styled_h3 {
  font-size:<?php echo esc_attr($dp_options['qt_h3_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h3_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h3_font_color']); ?>; <?php if($dp_options['show_qt_h3_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h3_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h3_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h3_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h3_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h3_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h3_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h3_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h3_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h3_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h3_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h3_margin_bottom']); ?>px;
}
.styled_h4, .editor-styles-wrapper .styled_h4 {
  font-size:<?php echo esc_attr($dp_options['qt_h4_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h4_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h4_font_color']); ?>; <?php if($dp_options['show_qt_h4_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h4_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h4_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h4_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h4_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h4_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h4_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h4_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h4_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h4_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h4_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h4_margin_bottom']); ?>px;
}
.styled_h5, .editor-styles-wrapper .styled_h5 {
  font-size:<?php echo esc_attr($dp_options['qt_h5_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h5_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h5_font_color']); ?>; <?php if($dp_options['show_qt_h5_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h5_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h5_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h5_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h5_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h5_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h5_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h5_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h5_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h5_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h5_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h5_margin_bottom']); ?>px;
}
@media screen and (max-width:750px) {
<?php for ( $i = 2; $i <= 5; $i++ ) { ?>
.styled_h<?php echo $i; ?>, .editor-styles-wrapper .styled_h<?php echo $i; ?> { font-size:<?php echo esc_attr($dp_options['qt_h'.$i.'_font_size_mobile']); ?>px; }
<?php } ?>
}
<?php
     for ( $i = 1; $i <= 2; $i++ ) {
       $qt_custom_button_border_color = hex2rgb($dp_options['qt_custom_button_border_color' . $i]);
       $qt_custom_button_border_color = implode(",",$qt_custom_button_border_color);
       $qt_custom_button_border_color_hover = hex2rgb($dp_options['qt_custom_button_border_color_hover' . $i]);
       $qt_custom_button_border_color_hover = implode(",",$qt_custom_button_border_color_hover);
?>
.q_custom_button<?php echo $i; ?> {
  color:<?php echo esc_attr($dp_options['qt_custom_button_font_color' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color); ?>,<?php echo esc_attr($dp_options['qt_custom_button_border_color_opacity' . $i]); ?>);
}
.q_custom_button<?php echo $i; ?>.animation_type1 { background:<?php echo esc_attr($dp_options['qt_custom_button_bg_color' . $i]); ?>; }
.q_custom_button<?php echo $i; ?>:hover, .q_custom_button<?php echo $i; ?>:focus {
  color:<?php echo esc_attr($dp_options['qt_custom_button_font_color_hover' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color_hover); ?>,<?php echo esc_attr($dp_options['qt_custom_button_border_color_hover_opacity' . $i]); ?>);
}
.q_custom_button<?php echo $i; ?>.animation_type1:hover { background:<?php echo esc_attr($dp_options['qt_custom_button_bg_color_hover' . $i]); ?>; }
.q_custom_button<?php echo $i; ?>:before { background:<?php echo esc_attr($dp_options['qt_custom_button_bg_color_hover' . $i]); ?>; }
<?php }; ?>
<?php
     // デザインボタンの設定 ----------------------------------
     $button_font_color = $dp_options['design_button_font_color'] ? $dp_options['design_button_font_color'] : '#ffffff';
     $button_font_color_hover = $dp_options['design_button_font_color_hover'] ? $dp_options['design_button_font_color_hover'] : '#ffffff';
     $button_bg_color = ($dp_options['design_button_bg_color_use_main'] != 1) ? $dp_options['design_button_bg_color'] : $dp_options['main_color'];
     $button_bg_color_hover = ($dp_options['design_button_bg_color_hover_use_sub'] != 1) ? $dp_options['design_button_bg_color_hover'] : $dp_options['sub_color'];
?>
.design_button { text-align:center; z-index:10; position:relative; }
.design_button a {
  display:inline-block; min-width:300px; height:60px; line-height:60px; font-size:16px; padding:0 20px; position:relative; overflow:hidden; z-index:3; text-decoration:none;
  -webkit-box-sizing:border-box; box-sizing:border-box;
  -webkit-transition: all 0.35s ease; transition: all 0.35s ease;
}
.design_button.shape_type1 a { border-radius:60px; font-weight:600; }
.design_button.type2 a, .design_button.type3 a { border:1px solid #fff; }
.design_button.type2 a:before, .design_button.type3 a:before {
  content:''; display:block; width:100%; height:calc(100% + 2px);
  position:absolute; top:-1px; left:-100%; z-index:-1;
  -webkit-transition: all 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0s;
  transition: all 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0s;
}
.design_button.type3 a:before { transform: skewX(45deg); width:calc(100% + 70px); left:calc(-100% - 70px); transform-origin: bottom left; }
.design_button.type2 a:hover:before { left:0; }
.design_button.type3 a:hover:before { left:0; }
.design_button.quick_tag_ver { margin:0 0 40px 0; }
<?php
     if($dp_options['design_button_type'] == 'type1'){
?>
.design_button.type1 a { color:<?php echo esc_attr($button_font_color); ?>; background:<?php echo esc_attr($button_bg_color); ?>; }
.design_button.type1 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php
     } else {
       $button_border_color = $dp_options['design_button_border_color'] ? $dp_options['design_button_border_color'] : '#ffffff';
       $button_border_color_opacity = $dp_options['design_button_border_color_opacity'] ? $dp_options['design_button_border_color_opacity'] : '1';
       $button_border_color = hex2rgb($button_border_color);
       $button_border_color = implode(",",$button_border_color);

       $button_border_color_hover = ($dp_options['design_button_border_color_hover_use_sub'] != 1) ? $dp_options['design_button_border_color_hover'] : $dp_options['sub_color'];
       $button_border_color_opacity_hover = $dp_options['design_button_border_color_hover_opacity'] ? $dp_options['design_button_border_color_hover_opacity'] : '1';
       $button_border_color_hover = hex2rgb($button_border_color_hover);
       $button_border_color_hover = implode(",",$button_border_color_hover);
?>
.design_button.type2 a, .design_button.type3 a { color:<?php echo esc_attr($button_font_color); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($button_border_color_opacity); ?>); }
.design_button.type2 a:hover, .design_button.type3 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_opacity_hover); ?>); }
.design_button.type2 a:before, .design_button.type3 a:before { background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php
     }; // デザインボタンここまで

     // デザイン見出し ----------------------------------
     $main_color = $dp_options['main_color'] ? $dp_options['main_color'] : '#00729f';
?>
.design_headline1 { border-color:<?php echo esc_attr($main_color); ?>; }
<?php
	exit;
}
add_action( 'wp_ajax_tcd_quicktags_dynamic_css', 'tcd_ajax_quicktags_dynamic_css' );

// add_editor_style()だとテーマ内のcssが最後になるためここで最後尾にcss追加
function editor_stylesheets_tcd_visual_editor_dynamic_css( $stylesheets ) {
	$stylesheets[] = get_tcd_quicktags_dynamic_css_url();
	$stylesheets = array_unique( $stylesheets );
	return $stylesheets;
}
