<?php
/*
 * フッターの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );


// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );


// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );


// タブの名前
function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

  // フッターの背景色
  $dp_default_options['footer_bg_color'] = '#003042';
  $dp_default_options['footer_bg_color_use_sub'] = 1;

  //フッターロゴ
	$dp_default_options['show_footer_logo'] = '1';
	$dp_default_options['footer_logo_type'] = 'type1';
	$dp_default_options['footer_logo_font_size'] = '32';
	$dp_default_options['footer_logo_font_size_mobile'] = '24';
	$dp_default_options['footer_logo_image'] = false;
	$dp_default_options['footer_logo_retina'] = '';
	$dp_default_options['footer_logo_image_mobile'] = false;
	$dp_default_options['footer_logo_retina_mobile'] = '';

  $dp_default_options['show_footer_message'] = '1';
  $dp_default_options['footer_description'] = __( 'Description will be displayed here.', 'tcd-w' );

  // コピーライト
	$dp_default_options['copyright'] = 'Copyright &copy; 2021';

	// フッターの固定メニュー
	$dp_default_options['footer_bar_display'] = 'type3';
	$dp_default_options['footer_bar_font_color'] = '#ffffff';
	$dp_default_options['footer_bar_bg_color'] = '#000000';
	$dp_default_options['footer_bar_bg_color_hover'] = '#333333';
	$dp_default_options['footer_bar_border_color'] = '#ffffff';
	$dp_default_options['footer_bar_border_color_opacity'] = 0.2;
	$dp_default_options['footer_bar_btns'] = array();

  //フッターボタンの設定
	$dp_default_options['footer_bar_type'] = 'type1';
	$dp_default_options['footer_button_font_size'] = '12';
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['show_footer_button'.$i] = '';
		$dp_default_options['footer_button_label'.$i] = '';
		$dp_default_options['footer_button_url'.$i] = '#';
		$dp_default_options['footer_button_target'.$i] = '';
		$dp_default_options['footer_button_font_color'.$i] = '#ffffff';
		$dp_default_options['footer_button_bg_color'.$i] = '#000000';
		$dp_default_options['footer_button_bg_color_use_main'.$i] = '1';
		$dp_default_options['footer_button_bg_color_hover'.$i] = '#444444';
		$dp_default_options['footer_button_bg_color_hover_use_sub'.$i] = '1';
	}

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $font_type_options, $time_options, $logo_type_options;

?>

<div id="tab-content-footer" class="tab-content">

   <?php // ロゴエリアの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Footer area setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Footer background color', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
        <div class="use_main_color">
          <input type="text" name="dp_options[footer_bg_color]" value="<?php echo esc_attr( $options['footer_bg_color'] ); ?>" data-default-color="#003042" class="c-color-picker">
        </div>
        <div class="use_main_color_checkbox">
          <label>
            <input name="dp_options[footer_bg_color_use_sub]" type="checkbox" value="1" <?php checked( $options['footer_bg_color_use_sub'], 1 ); ?>>
            <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
          </label>
        </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Logo setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_logo]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_logo'] ); ?> /> <?php _e('Display logo', 'tcd-w');  ?></label></p>

     <div style="<?php if($options['show_footer_logo'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-w');  ?></h4>
      <ul class="design_radio_button select_logo_type">
       <?php foreach ( $logo_type_options as $option ) { ?>
       <li>
        <input type="radio" class="logo_type_option_<?php esc_attr_e( $option['value'] ); ?>" id="footer_logo_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[footer_logo_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['footer_logo_type'], $option['value'] ); ?> />
        <label for="footer_logo_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
       </li>
       <?php } ?>
      </ul>
      <div class="logo_text_area" style="<?php if( $options['footer_logo_type'] == 'type1' ) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e('Font setting for logo', 'tcd-w');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_logo_font_size]" value="<?php echo esc_attr( $options['footer_logo_font_size'] ); ?>"><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_logo_font_size_mobile]" value="<?php echo esc_attr( $options['footer_logo_font_size_mobile'] ); ?>"><span>px</span></li>
       </ul>
      </div>
      <div class="logo_image_area" style="<?php if( $options['footer_logo_type'] == 'type2' ) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p>
         <?php echo __('We recommend to use the background transparent PNG image.', 'tcd-w'); ?><br />
         <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
        </p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js footer_logo_image">
         <input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image'] ); ?>" id="footer_logo_image" name="dp_options[footer_logo_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['footer_logo_image']){ echo wp_get_attachment_image($options['footer_logo_image'], 'full'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_logo_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <p><label><input name="dp_options[footer_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['footer_logo_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
       <h4 class="theme_option_headline2"><?php _e('Logo image (mobile)', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p>
         <?php echo __('We recommend to use the background transparent PNG image.', 'tcd-w'); ?><br />
         <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
        </p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js footer_logo_image_mobile">
         <input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image_mobile'] ); ?>" id="footer_logo_image_mobile" name="dp_options[footer_logo_image_mobile]" class="cf_media_id">
         <div class="preview_field"><?php if($options['footer_logo_image_mobile']){ echo wp_get_attachment_image($options['footer_logo_image_mobile'], 'full'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_logo_image_mobile']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <p><label><input name="dp_options[footer_logo_retina_mobile]" type="checkbox" value="1" <?php checked( '1', $options['footer_logo_retina_mobile'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Setting under the footer logo', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('The catchphrase displays the <a href="./options-general.php">site\'s catchphrase</a>.', 'tcd-w'); ?><br /></p>
     </div>
     <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Display catchphrase', 'tcd-w');  ?></span><input name="dp_options[show_footer_message]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_message'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Description', 'tcd-w');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[footer_description]"><?php echo esc_textarea(  $options['footer_description'] ); ?></textarea></li>
     </ul>

     <div class="theme_option_message2">
      <p><?php echo __('Social buttons displayed under the footer logo can be set in the basic settings social button area.', 'tcd-w'); ?><br /></p>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コピーライトの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Copyright setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <input class="regular-text" type="text" name="dp_options[copyright]" value="<?php echo esc_attr($options['copyright']); ?>" />
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Footer bar setting (mobile device only)', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-w' ); ?>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Display type of the footer bar', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $footer_bar_display_options as $option ) { ?>
      <li id="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>_button">
       <input type="radio" id="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[footer_bar_display]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['footer_bar_display'], $option['value'] ); ?> />
       <label for="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>

     <div id="footer_bar_setting_area" style="<?php if($options['footer_bar_display'] != 'type3'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Footer bar type', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <li id="footer_bar_type1_button">
       <input type="radio" id="footer_bar_type1" name="dp_options[footer_bar_type]" value="type1" <?php checked( $options['footer_bar_type'], 'type1' ); ?> />
       <label for="footer_bar_type1"><?php _e('Button with icon', 'tcd-w'); ?></label>
      </li>
      <li id="footer_bar_type2_button">
       <input type="radio" id="footer_bar_type2" name="dp_options[footer_bar_type]" value="type2" <?php checked( $options['footer_bar_type'], 'type2' ); ?> />
       <label for="footer_bar_type2"><?php _e('Normal button', 'tcd-w'); ?></label>
      </li>
     </ul>

     <div id="footer_bar_type1_option" style="<?php if($options['footer_bar_type'] == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Settings for the appearance of the footer bar', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_font_color]" value="<?php echo esc_attr( $options['footer_bar_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg_color]" value="<?php echo esc_attr( $options['footer_bar_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg_color_hover]" value="<?php echo esc_attr( $options['footer_bar_bg_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_border_color]" value="<?php echo esc_attr( $options['footer_bar_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Opacity of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[footer_bar_border_color_opacity]" value="<?php echo esc_attr( $options['footer_bar_border_color_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br><?php _e('Please enter 0 if you don\'t want to display border.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'You can display the button with icon in footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
     </div>
     <table class="table-border">
      <tr>
       <th><?php _e( 'Default', 'tcd-w' ); ?></th>
       <td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
      </tr>
      <tr>
       <th><?php _e( 'Share', 'tcd-w' ); ?></th>
       <td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
      </tr>
      <tr>
       <th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
       <td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
      </tr>
     </table>
     <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[footer_bar_btns]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['footer_bar_btns'] ) :
              foreach ( $options['footer_bar_btns'] as $key => $value ) :  
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf footer-bar-target" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
          <li class="cf footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></li>
          <li class="cf footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>"></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
         </ul>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div>
       </div>
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
              'type' => 'type1',
              'label' => '',
              'url' => '',
              'number' => '',
              'target' => 0,
              'icon' => 'twitter'
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
          <li class="cf footer-bar-url"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value=""></li>
          <li class="cf footer-bar-target"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
          <li class="cf footer-bar-number" style="display:none;"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value=""></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
         </ul>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div>
       </div>
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->

     </div><!-- END #footer_bar_type1_option -->

     <div id="footer_bar_type2_option" style="<?php if($options['footer_bar_type'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_button_font_size]" value="<?php esc_attr_e( $options['footer_button_font_size'] ); ?>" /><span>px</span></li>
      </ul>
      <?php for($i = 1; $i <= 2; $i++) : ?>
      <div class="sub_box cf">
       <h3 class="theme_option_subbox_headline"><?php printf(__('Button%s setting', 'tcd-w'), $i); ?></h3>
       <div class="sub_box_content">
        <p class="displayment_checkbox"><label><input id="dp_options[show_footer_button<?php echo $i; ?>]" name="dp_options[show_footer_button<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_button'.$i] ); ?> /> <?php printf(__('Display button%s', 'tcd-w'), $i); ?></label></p>
        <div style="<?php if($options['show_footer_button'.$i] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[footer_button_label<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_label'.$i] ); ?>" /></li>
          <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_button_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_url'.$i] ); ?>"></li>
          <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[footer_button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_button_target'.$i], 1 ); ?>></li>
          <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_button_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_font_color'.$i] ); ?>" data-default-color="#ffffff"></li>
          <li class="cf">
           <span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
           <div class="use_main_color">
            <input class="c-color-picker" type="text" name="dp_options[footer_button_bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_bg_color'.$i] ); ?>" data-default-color="#000000">
           </div>
           <div class="use_main_color_checkbox">
            <label>
             <input name="dp_options[footer_button_bg_color_use_main<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_button_bg_color_use_main'.$i], 1 ); ?>>
             <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
            </label>
           </div>
          </li>
          <li class="cf">
           <span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span>
           <div class="use_main_color">
            <input class="c-color-picker" type="text" name="dp_options[footer_button_bg_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_bg_color_hover'.$i] ); ?>" data-default-color="#444444">
           </div>
           <div class="use_main_color_checkbox">
            <label>
             <input name="dp_options[footer_button_bg_color_hover_use_sub<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_button_bg_color_hover_use_sub'.$i], 1 ); ?>>
             <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
            </label>
           </div>
          </li>
         </ul>
        </div>
        <ul class="button_list cf">
         <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php endfor; ?>

     </div><!-- END #footer_bar_type2_option -->

     </div><!-- END #footer_bar_setting_area -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $font_type_options, $time_options, $logo_type_options;

  // フッターの背景色
  $input['footer_bg_color'] = sanitize_hex_color( $input['footer_bg_color'] );
  $input['footer_bg_color_use_sub'] = ! empty( $input['footer_bg_color_use_sub'] ) ? 1 : 0;

  // フッターロゴ
  $input['show_footer_logo'] = ! empty( $input['show_footer_logo'] ) ? 1 : 0;
  if ( ! isset( $input['footer_logo_type'] ) )
    $input['footer_logo_type'] = null;
  if ( ! array_key_exists( $input['footer_logo_type'], $logo_type_options ) )
    $input['footer_logo_type'] = null;
  $input['footer_logo_font_size'] = wp_filter_nohtml_kses( $input['footer_logo_font_size'] );
  $input['footer_logo_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_logo_font_size_mobile'] );
  $input['footer_logo_image'] = wp_filter_nohtml_kses( $input['footer_logo_image'] );
  $input['footer_logo_retina'] = ! empty( $input['footer_logo_retina'] ) ? 1 : 0;
  $input['footer_logo_image_mobile'] = wp_filter_nohtml_kses( $input['footer_logo_image_mobile'] );
  $input['footer_logo_retina_mobile'] = ! empty( $input['footer_logo_retina_mobile'] ) ? 1 : 0;

  $input['show_footer_message'] = ! empty( $input['show_footer_message'] ) ? 1 : 0;
  $input['footer_description'] = wp_filter_nohtml_kses( $input['footer_description'] );

  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);


  // スマホ用固定フッターバーの設定
  $input['footer_bar_display'] = wp_kses_post($input['footer_bar_display']);
  $input['footer_bar_font_color'] = wp_kses_post($input['footer_bar_font_color']);
  $input['footer_bar_bg_color'] = wp_kses_post($input['footer_bar_bg_color']);
  $input['footer_bar_bg_color_hover'] = wp_kses_post($input['footer_bar_bg_color_hover']);
  $input['footer_bar_border_color'] = wp_kses_post($input['footer_bar_border_color']);
  $input['footer_bar_border_color_opacity'] = wp_kses_post($input['footer_bar_border_color_opacity']);
  $footer_bar_btns = array();
  if ( isset( $input['footer_bar_btns'] ) && is_array( $input['footer_bar_btns'] ) ) {
    foreach ( $input['footer_bar_btns'] as $key => $value ) {
      $footer_bar_btns[] = array(
        'type' => ( isset( $input['footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['footer_bar_btns'][$key]['type'] : 'type1',
        'label' => isset( $input['footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['label'] ) : '',
        'url' => isset( $input['footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['url'] ) : '',
        'number' => isset( $input['footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['number'] ) : '',
        'target' => ! empty( $input['footer_bar_btns'][$key]['target'] ) ? 1 : 0,
        'icon' => ( isset( $input['footer_bar_btns'][$key]['icon'] ) && array_key_exists( $input['footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['footer_bar_btns'][$key]['icon'] : 'twitter',
      );
    };
  };
  $input['footer_bar_btns'] = $footer_bar_btns;

  // ボタンの設定
  $input['footer_button_font_size'] = wp_filter_nohtml_kses( $input['footer_button_font_size'] );
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['show_footer_button'.$i] = ! empty( $input['show_footer_button'.$i] ) ? 1 : 0;
    $input['footer_button_label'.$i] = $input['footer_button_label'.$i];
    $input['footer_button_url'.$i] = wp_filter_nohtml_kses( $input['footer_button_url'.$i] );
    $input['footer_button_target'.$i] = ! empty( $input['footer_button_target'.$i] ) ? 1 : 0;
    $input['footer_button_font_color'.$i] = wp_filter_nohtml_kses( $input['footer_button_font_color'.$i] );
    $input['footer_button_bg_color'.$i] = wp_filter_nohtml_kses( $input['footer_button_bg_color'.$i] );
    $input['footer_button_bg_color_use_main'.$i] = ! empty( $input['footer_button_bg_color_use_main'.$i] ) ? 1 : 0;
    $input['footer_button_bg_color_hover'.$i] = wp_filter_nohtml_kses( $input['footer_button_bg_color_hover'.$i] );
    $input['footer_button_bg_color_hover_use_sub'.$i] = ! empty( $input['footer_button_bg_color_hover_use_sub'.$i] ) ? 1 : 0;
  }

	return $input;

};


?>