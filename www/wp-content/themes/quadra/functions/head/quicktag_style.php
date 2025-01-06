<?php

function quicktag_style($options){

  if ( $options['use_quicktags'] ) :

  // 見出し
  for ( $i = 2; $i <= 5; $i++ ) :
    $selector = '.styled_h'.$i;
?>
<?php echo $selector; ?>{
  font-size:<?php echo esc_attr($options['qt_h'.$i.'_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h'.$i.'_text_align']); ?>; color:<?php echo esc_attr($options['qt_h'.$i.'_font_color']); ?>; <?php if($options['show_qt_h'.$i.'_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h'.$i.'_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h'.$i.'_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h'.$i.'_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h'.$i.'_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h'.$i.'_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h'.$i.'_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h'.$i.'_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h'.$i.'_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h'.$i.'_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h'.$i.'_padding_top']); ?>px <?php echo esc_attr($options['qt_h'.$i.'_padding_right']); ?>px <?php echo esc_attr($options['qt_h'.$i.'_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h'.$i.'_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h'.$i.'_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h'.$i.'_margin_bottom']); ?>px !important;
}
@media screen and (max-width:750px) { <?php echo $selector; ?>{ font-size:<?php echo esc_attr($options['qt_h'.$i.'_font_size_mobile']); ?>px!important; } }
<?php
  
  endfor;

  // ボタン
  for ( $i = 1; $i <= 2; $i++ ) :
    $qt_custom_button_border_color = hex2rgb($options['qt_custom_button_border_color' . $i]);
    $qt_custom_button_border_color = implode(",",$qt_custom_button_border_color);
    $qt_custom_button_border_color_hover = hex2rgb($options['qt_custom_button_border_color_hover' . $i]);
    $qt_custom_button_border_color_hover = implode(",",$qt_custom_button_border_color_hover);
    $button_selector = '.q_custom_button'.$i;

?>
<?php echo $button_selector; ?> {
  color:<?php echo esc_attr($options['qt_custom_button_font_color' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color); ?>,<?php echo esc_attr($options['qt_custom_button_border_color_opacity' . $i]); ?>);
}
<?php echo $button_selector; ?>.animation_type1 { background:<?php echo esc_attr($options['qt_custom_button_bg_color' . $i]); ?>; }
<?php echo $button_selector; ?>:hover, <?php echo $button_selector; ?>:focus {
  color:<?php echo esc_attr($options['qt_custom_button_font_color_hover' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color_hover); ?>,<?php echo esc_attr($options['qt_custom_button_border_color_hover_opacity' . $i]); ?>);
}
<?php echo $button_selector; ?>.animation_type1:hover { background:<?php echo esc_attr($options['qt_custom_button_bg_color_hover' . $i]); ?>; }
<?php echo $button_selector; ?>:before { background:<?php echo esc_attr($options['qt_custom_button_bg_color_hover' . $i]); ?>; }
<?php 
  
  endfor;
  
  // 吹き出し

?>
.speech_balloon_left1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?> }
.speech_balloon_left2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?> }
.speech_balloon_right1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?> }
.speech_balloon_right2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?> }

<?php
     // Google map
     $qt_gmap_marker_bg = ($options['qt_gmap_marker_bg_use_main'] != 1) ? $options['qt_gmap_marker_bg'] : $options['main_color'];
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($qt_gmap_marker_bg); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($qt_gmap_marker_bg); ?> transparent transparent transparent; }
<?php

  endif;

}