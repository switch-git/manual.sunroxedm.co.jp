<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

  //ヘッダーロゴ
	$dp_default_options['header_logo_type'] = 'type1';
	$dp_default_options['header_logo_font_size'] = '32';
	$dp_default_options['header_logo_font_size_mobile'] = '24';
	$dp_default_options['header_logo_font_color'] = '#ffffff';
	$dp_default_options['header_logo_image'] = false;
	$dp_default_options['header_logo_retina'] = '';
	$dp_default_options['header_logo_image_mobile'] = false;
	$dp_default_options['header_logo_retina_mobile'] = '';

	// グローバルメニューの設定
  $dp_default_options['header_bg_color'] = '#0093cb';
  $dp_default_options['header_bg_color_use_main'] = '1';
	$dp_default_options['header_bg_color_opacity'] = '1';
	$dp_default_options['global_menu_font_color'] = '#ffffff';
	$dp_default_options['global_menu_child_bg_color'] = '#0093cb';
	$dp_default_options['global_menu_child_bg_color_use_main'] = '1';
	$dp_default_options['global_menu_child_bg_color_hover'] = '#0078ab';
	$dp_default_options['global_menu_child_bg_color_hover_use_hover'] = 1;
  $dp_default_options['show_header_search'] = 1;

	// モバイル用メニューの設定
	$dp_default_options['mobile_header_bg_color_opacity'] = '0.7';
	$dp_default_options['mobile_menu_font_color'] = '#ffffff';
	$dp_default_options['mobile_menu_bg_color'] = '#000000';
	$dp_default_options['mobile_menu_sub_menu_bg_color'] = '#333333';
	$dp_default_options['mobile_menu_bg_hover_color'] = '#444444';
	$dp_default_options['mobile_menu_border_color'] = '#444444';
  $dp_default_options['show_header_search_mobile'] = 1;
	$dp_default_options['mobile_menu_ad_code'] = '';

  // メガメニュー
  $dp_default_options['mega_menu_a_font_size'] = '16';
  $dp_default_options['mega_menu_b_font_size'] = '16';
  $dp_default_options['mega_menu_b_post_order'] = 'date';
  $dp_default_options['show_mega_menu_b_date'] = '1';

  $dp_default_options['megamenu'] = array();

  // メッセージ
	$dp_default_options['show_header_message'] = '';
	$dp_default_options['header_message'] = '';
  $dp_default_options['header_message_url'] = '#';
  $dp_default_options['header_message_target'] = 0;
  $dp_default_options['show_header_message_top'] = '1';
	$dp_default_options['show_header_message_sub'] = '';
  $dp_default_options['header_message_width'] = 'type1';
	$dp_default_options['header_message_font_color'] = '#ffffff';
	$dp_default_options['header_message_bg_color'] = '#00aa77';
	$dp_default_options['header_message_link_font_color'] = '#ededed';
	
	

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $megamenu_options, $content_width_options, $font_type_options, $logo_type_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div id="tab-content-header" class="tab-content">


   <?php // ヘッダーのロゴの設定 ----------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header logo setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-w');  ?></h4>
     <ul class="design_radio_button select_logo_type">
      <?php foreach ( $logo_type_options as $option ) { ?>
      <li>
       <input type="radio" class="logo_type_option_<?php esc_attr_e( $option['value'] ); ?>" id="header_logo_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[header_logo_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['header_logo_type'], $option['value'] ); ?> />
       <label for="header_logo_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <div class="logo_text_area" style="<?php if( $options['header_logo_type'] == 'type1' ) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Font size setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_logo_font_size]" value="<?php echo esc_attr( $options['header_logo_font_size'] ); ?>"><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_logo_font_size_mobile]" value="<?php echo esc_attr( $options['header_logo_font_size_mobile'] ); ?>"><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_logo_font_color]" value="<?php echo esc_attr( $options['header_logo_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      </ul>
     </div>
     <div class="logo_image_area" style="<?php if( $options['header_logo_type'] == 'type2' ) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p>
        <?php printf(__('Maximum height is %s. We recommend to use the background transparent PNG image.', 'tcd-w'), '150'); ?><br />
        <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
       </p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js header_logo_image">
        <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['header_logo_image']){ echo wp_get_attachment_image($options['header_logo_image'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[header_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
      <h4 class="theme_option_headline2"><?php _e('Logo image (mobile)', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p>
        <?php printf(__('Maximum height is %s. We recommend to use the background transparent PNG image.', 'tcd-w'), '50'); ?><br />
        <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
       </p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js header_logo_image_mobile">
        <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_mobile'] ); ?>" id="header_logo_image_mobile" name="dp_options[header_logo_image_mobile]" class="cf_media_id">
        <div class="preview_field"><?php if($options['header_logo_image_mobile']){ echo wp_get_attachment_image($options['header_logo_image_mobile'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_mobile']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[header_logo_retina_mobile]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina_mobile'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ヘッダーの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Header background color', 'tcd-w'); ?></span>
       <div class="use_main_color">
        <input type="text" name="dp_options[header_bg_color]" value="<?php echo esc_attr( $options['header_bg_color'] ); ?>" data-default-color="#0093cb" class="c-color-picker">
       </div>
       <div class="use_main_color_checkbox">
        <label>
         <input name="dp_options[header_bg_color_use_main]" type="checkbox" value="1" <?php checked( $options['header_bg_color_use_main'], 1 ); ?>>
         <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
        </label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of fixed header background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[header_bg_color_opacity]" value="<?php echo esc_attr( $options['header_bg_color_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 1. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_font_color]" value="<?php echo esc_attr( $options['global_menu_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Background color of child menu', 'tcd-w'); ?></span>
       <div class="use_main_color">
        <input type="text" name="dp_options[global_menu_child_bg_color]" value="<?php echo esc_attr( $options['global_menu_child_bg_color'] ); ?>" data-default-color="#00729f" class="c-color-picker">
       </div>
       <div class="use_main_color_checkbox">
        <label>
         <input name="dp_options[global_menu_child_bg_color_use_main]" type="checkbox" value="1" <?php checked( $options['global_menu_child_bg_color_use_main'], 1 ); ?>>
         <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
        </label>
       </div>
      </li>
      <li class="cf color_picker_bottom">
       <span class="label"><?php _e('Background color of child menu on mouseover', 'tcd-w'); ?></span>
       <div class="use_main_color">
        <input type="text" name="dp_options[global_menu_child_bg_color_hover]" value="<?php echo esc_attr( $options['global_menu_child_bg_color_hover'] ); ?>" data-default-color="#00466d" class="c-color-picker">
       </div>
       <div class="use_main_color_checkbox">
        <label>
         <input name="dp_options[global_menu_child_bg_color_hover_use_hover]" type="checkbox" value="1" <?php checked( $options['global_menu_child_bg_color_hover_use_hover'], 1 ); ?>>
         <span><?php _e('Apply hover color', 'tcd-w'); ?></span>
        </label>
       </div>
      </li>
     </ul>

     <?php // 検索フォームの設定 ---------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Search form setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display search form on header', 'tcd-w');  ?></span><input name="dp_options[show_header_search]" type="checkbox" value="1" <?php checked( '1', $options['show_header_search'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // モバイル用メニュー ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mobile menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Transparency of fixed header background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_header_bg_color_opacity]" value="<?php echo esc_attr( $options['mobile_header_bg_color_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 1. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_font_color]" value="<?php echo esc_attr( $options['mobile_menu_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_border_color]" value="<?php echo esc_attr( $options['mobile_menu_border_color'] ); ?>" data-default-color="#444444" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of menu on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_hover_color'] ); ?>" data-default-color="#444444" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_sub_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_sub_menu_bg_color'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
     </ul>

     <?php // 検索フォームの設定 ---------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Search form setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display search form inside mobile menu', 'tcd-w');  ?></span><input name="dp_options[show_header_search_mobile]" type="checkbox" value="1" <?php checked( '1', $options['show_header_search_mobile'] ); ?> /></li>
     </ul>

     <?php // バナーの設定 ---------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Additional content settings for mobile menu bottom area', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can display banners in HTML, Google calendar, SNS timeline, etc.', 'tcd-w');  ?></p>
     </div>
     <textarea class="full_width" cols="50" rows="10" name="dp_options[mobile_menu_ad_code]"><?php echo esc_textarea( $options['mobile_menu_ad_code'] ); ?></textarea>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メガメニュー ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mega menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p><?php _e( 'Set the display format of the sub menu of the global menu', 'tcd-w' ); ?></p>
     <div class="theme_option_message2">
      <p><?php _e( 'Dropdown menu - Display submenu in drop down.', 'tcd-w'); ?></p>
      <p><?php _e('Mega menu A - Display post category list. Please set post categories under parent menu.', 'tcd-w'); ?></p>
      <p><?php printf(__('Mega menu B - Display articles by %s category. Please set %s categories under parent menu.', 'tcd-w'), $blog_label, $blog_label); ?></p>
     </div>
     <ul class="megamenu_image clearfix">
      <?php
           foreach ( $megamenu_options as $option ) :
             if(isset($option['img'])){
      ?>
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="<?php echo esc_attr( $option['title'] ); ?>" title="" />
       <p><?php echo esc_html($option['title']); ?></p>
      </li>
      <?php }; endforeach; ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Menu type setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please create custom menu from <a href="./nav-menus.php">menu page</a> and set the position as <strong>"Global menu"</strong> before you use this option.', 'tcd-w');  ?></p>
     </div>
     <?php
          $menu_locations = get_nav_menu_locations();
          $nav_menus = wp_get_nav_menus();
          $global_nav_items = array();
          if ( isset( $menu_locations['global-menu'] ) ) {
            foreach ( (array) $nav_menus as $menu ) {
              if ( $menu_locations['global-menu'] === $menu->term_id ) {
                $global_nav_items = wp_get_nav_menu_items( $menu );
                break;
              }
            }
          }
          echo '<ul class="option_list">';
          foreach ( $global_nav_items as $item ) {
            if ( $item->menu_item_parent ) continue;
            $value = isset( $options['megamenu'][$item->ID] ) ? $options['megamenu'][$item->ID] : '';
            echo '<li class="cf"><span class="label">' . esc_html( $item->title ) . '</span>';
            echo '<select name="dp_options[megamenu][' . esc_attr( $item->ID ) . ']">';
            foreach ( $megamenu_options as $option ) {
              echo '<option value="' . esc_attr( $option['value'] ) . '" ' . selected( $option['value'], $value, false ) . '>' . esc_html( $option['label'] ) . '</option>';
            }
            echo '</select>';
            echo '</li>';
          }
          echo '</ul>' . "\n";
     ?>

     <?php // メガメニューA ------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Mega menu A setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_menu_a_font_size]" value="<?php esc_attr_e( $options['mega_menu_a_font_size'] ); ?>" /><span>px</span></li>
     </ul>

     <?php // メガメニューB　------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Mega menu B setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_menu_b_font_size]" value="<?php esc_attr_e( $options['mega_menu_b_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="dp_options[mega_menu_b_post_order]">
        <option value="date" <?php selected($options['mega_menu_b_post_order'], 'date'); ?>><?php _e('Date', 'tcd-w'); ?></option>
        <option value="rand" <?php selected($options['mega_menu_b_post_order'], 'rand'); ?>><?php _e('Random', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input name="dp_options[show_mega_menu_b_date]" type="checkbox" value="1" <?php checked( '1', $options['show_mega_menu_b_date'] ); ?> /></li>
     </ul>


     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メッセージ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

    <div class="theme_option_message2">
      <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-w'); ?></p>
    </div>

    <p class="displayment_checkbox"><label><input name="dp_options[show_header_message]" type="checkbox" value="1" <?php checked( '1', $options['show_header_message'] ); ?> /> <?php _e('Display header message', 'tcd-w');  ?></label></p>
    <div style="<?php if($options['show_header_message'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e('Message', 'tcd-w');  ?></h4>
      <ul class="option_list">
        <li class="cf">
          <span class="label"><?php _e('Message', 'tcd-w');  ?></span>
          <textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea>
        </li>
        <li class="cf">
          <span class="label"><?php _e('URL', 'tcd-w');  ?></span>
          <div class="admin_link_option">
            <input id="dp_options[header_message_url]" class="full_width" type="text" name="dp_options[header_message_url]" value="<?php echo esc_attr( $options['header_message_url'] ); ?>" />
            <input type="hidden" name="dp_options[header_message_target]" value="" data-current-value=""><input id="header_message_target" class="admin_link_option_target" name="dp_options[header_message_target]" type="checkbox" value="1" <?php checked( $options['header_message_target'], 1 ); ?>>
            <label for="header_message_target">&#xe92a;</label>
          </div>
        </li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Display on front page', 'tcd-w'); ?></span><input name="dp_options[show_header_message_top]" type="checkbox" value="1" <?php checked( $options['show_header_message_top'], 1 ); ?>></li>
        <li class="cf"><span class="label"><?php _e('Display on sub pages', 'tcd-w'); ?></span><input name="dp_options[show_header_message_sub]" type="checkbox" value="1" <?php checked( $options['show_header_message_sub'], 1 ); ?>></li>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
      <ul class="design_radio_button">
        <?php foreach ( $content_width_options as $option ) { ?>
        <li>
          <input type="radio" id="header_message_width_<?php echo esc_attr($option['value']); ?>" name="dp_options[header_message_width]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['header_message_width'], $option['value'] ); ?> />
          <label for="header_message_width_<?php echo esc_attr($option['value']); ?>"><?php echo esc_html( $option['label'] ); ?></label>
        </li>
        <?php } ?>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
        <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#ffff66" class="c-color-picker"></li>
        <!-- <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of text link', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_link_font_color]" value="<?php echo esc_attr( $options['header_message_link_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li> -->
      </ul>
    </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $megamenu_options, $content_width_options, $font_type_options, $logo_type_options;

  // ヘッダーロゴ
  if ( ! isset( $input['header_logo_type'] ) )
    $input['header_logo_type'] = null;
  if ( ! array_key_exists( $input['header_logo_type'], $logo_type_options ) )
    $input['header_logo_type'] = null;
  $input['header_logo_font_size'] = wp_filter_nohtml_kses( $input['header_logo_font_size'] );
  $input['header_logo_font_size_mobile'] = wp_filter_nohtml_kses( $input['header_logo_font_size_mobile'] );
  $input['header_logo_font_color'] = wp_filter_nohtml_kses( $input['header_logo_font_color'] );
  $input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
  $input['header_logo_retina'] = ! empty( $input['header_logo_retina'] ) ? 1 : 0;
  $input['header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile'] );
  $input['header_logo_retina_mobile'] = ! empty( $input['header_logo_retina_mobile'] ) ? 1 : 0;


  // 検索フォームの設定
  $input['show_header_search'] = ! empty( $input['show_header_search'] ) ? 1 : 0;
  $input['show_header_search_mobile'] = ! empty( $input['show_header_search_mobile'] ) ? 1 : 0;


  // グローバルメニューの設定
  $input['header_bg_color'] = wp_filter_nohtml_kses( $input['header_bg_color'] );
  $input['header_bg_color_use_main'] = ! empty( $input['header_bg_color_use_main'] ) ? 1 : 0;
  $input['header_bg_color_opacity'] = wp_filter_nohtml_kses( $input['header_bg_color_opacity'] );
  $input['global_menu_font_color'] = wp_filter_nohtml_kses( $input['global_menu_font_color'] );
  $input['global_menu_child_bg_color'] = wp_filter_nohtml_kses( $input['global_menu_child_bg_color'] );
  $input['global_menu_child_bg_color_use_main'] = ! empty( $input['global_menu_child_bg_color_use_main'] ) ? 1 : 0;
  $input['global_menu_child_bg_color_hover'] = wp_filter_nohtml_kses( $input['global_menu_child_bg_color_hover'] );
  $input['global_menu_child_bg_color_hover_use_hover'] = ! empty( $input['global_menu_child_bg_color_hover_use_hover'] ) ? 1 : 0;


  // モバイルメニューの設定
  $input['mobile_header_bg_color_opacity'] = wp_filter_nohtml_kses( $input['mobile_header_bg_color_opacity'] );
  $input['mobile_menu_font_color'] = wp_filter_nohtml_kses( $input['mobile_menu_font_color'] );
  $input['mobile_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_color'] );
  $input['mobile_menu_sub_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_sub_menu_bg_color'] );
  $input['mobile_menu_bg_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_hover_color'] );
  $input['mobile_menu_border_color'] = wp_filter_nohtml_kses( $input['mobile_menu_border_color'] );
  $input['mobile_menu_ad_code'] = $input['mobile_menu_ad_code'];


  // メガメニュー
  $input['mega_menu_a_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_a_font_size'] );
  $input['mega_menu_b_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_b_font_size'] );
  $input['mega_menu_b_post_order'] = wp_filter_nohtml_kses( $input['mega_menu_b_post_order'] );
  $input['show_mega_menu_b_date'] = ! empty( $input['show_mega_menu_b_date'] ) ? 1 : 0;

  foreach ( array_keys( $input['megamenu'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu'][$index], $megamenu_options ) ) {
      $input['megamenu'][$index] = null;
    }
  }


  // メッセージ
  $input['show_header_message'] = ! empty( $input['show_header_message'] ) ? 1 : 0;
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_target'] = !empty( $input['header_message_target'] ) ? 1 : 0;
  $input['header_message_font_color'] = wp_filter_nohtml_kses( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = wp_filter_nohtml_kses( $input['header_message_bg_color'] );
  $input['header_message_link_font_color'] = wp_filter_nohtml_kses( $input['header_message_link_font_color'] );
  $input['show_header_message_top'] = ! empty( $input['show_header_message_top'] ) ? 1 : 0;
  $input['show_header_message_sub'] = ! empty( $input['show_header_message_sub'] ) ? 1 : 0;
  $input['header_message_width'] = wp_filter_nohtml_kses( $input['header_message_width'] );

  return $input;

};


?>