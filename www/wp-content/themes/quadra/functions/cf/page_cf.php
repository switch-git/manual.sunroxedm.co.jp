<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
 <div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-w'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-w'); ?>" />
    </div>
  </div>
 </div>
<?php
}

/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'page_header_meta_box',//ID of meta box
    __('Page setting', 'tcd-w'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $layout_options, $font_type_options, $catch_animation_type_options;

  // 表示設定
  $page_hide_header_message = get_post_meta($post->ID, 'page_hide_header_message', true);
  $page_hide_header = get_post_meta($post->ID, 'page_hide_header', true);
  $page_hide_sidebar = get_post_meta($post->ID, 'page_hide_sidebar', true);
  $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);

  $change_content_width = get_post_meta($post->ID, 'change_content_width', true);
  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '850';

  // サイドコンテンツ
  $page_sidebar_type = get_post_meta($post->ID, 'page_sidebar_type', true) ?  get_post_meta($post->ID, 'page_sidebar_type', true) : 'type2';
  $use_custom_side_content = get_post_meta($post->ID, 'use_custom_side_content', true);
  $word_balloon_desc = get_post_meta($post->ID, 'word_balloon_desc', true);
  $word_balloon_bg_color = get_post_meta($post->ID, 'word_balloon_bg_color', true) ?  get_post_meta($post->ID, 'word_balloon_bg_color', true) : '#003041';
  $word_balloon_bg_color_use_sub = get_post_meta($post->ID, 'word_balloon_bg_color_use_sub', true);

  $side_navigation_type = get_post_meta($post->ID, 'side_navigation_type', true) ?  get_post_meta($post->ID, 'side_navigation_type', true) : '';
  $side_navigation_color = get_post_meta($post->ID, 'side_navigation_color', true) ?  get_post_meta($post->ID, 'side_navigation_color', true) : '#0094c9';
  $side_navigation_color_use_main = get_post_meta($post->ID, 'side_navigation_color_use_main', true);
  $use_fix_side_navigation = get_post_meta($post->ID, 'use_fix_side_navigation', true);


  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // WP5.0対策として隠しフィールドを用意　選択されているページテンプレートによってABOUT入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="default">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>

<div class="tcd_custom_field_wrap">

  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Basic setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('Please use the option below if you want to make this page like Landing page.', 'tcd-w'); ?></p>
    </div>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Hide header message', 'tcd-w'); ?></span><input name="page_hide_header_message" type="checkbox" value="1" <?php checked( $page_hide_header_message, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide header bar', 'tcd-w'); ?></span><input name="page_hide_header" type="checkbox" value="1" <?php checked( $page_hide_header, 1 ); ?>></li>
     <li class="cf" id="hide_side_content"><span class="label"><?php _e('Hide side content', 'tcd-w'); ?></span><input class="display_option" data-option-name="page_hide_sidebar" name="page_hide_sidebar" type="checkbox" value="1" <?php checked( $page_hide_sidebar, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide footer', 'tcd-w'); ?></span><input name="page_hide_footer" type="checkbox" value="1" <?php checked( $page_hide_footer, 1 ); ?>></li>
     <li class="cf page_hide_sidebar"><span class="label"><?php _e('Change content width', 'tcd-w'); ?></span><input class="display_option" data-option-name="change_content_width" name="change_content_width" type="checkbox" value="1" <?php checked( $change_content_width, 1 ); ?>></li>
    </ul>

    <div class="change_content_width" style="<?php if($page_hide_sidebar && $change_content_width){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
     <h4 class="theme_option_headline2"><?php _e( 'Content width', 'tcd-w' ); ?></h4>
     <p><input class="hankaku page_content_width_input" style="width:100px;" type="number" max="1130" name="page_content_width" value="<?php echo esc_attr($page_content_width); ?>" /><span>px</span></p>
    </div>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // サイドコンテンツの設定 --------------------------------------------------- ?>
  <div id="hide_side_content_area" class="theme_option_field cf theme_option_field_ac" style="<?php if($page_hide_sidebar){ echo "display:none;"; }else{ echo "display:block;"; } ?>">
   <h3 class="theme_option_headline"><?php _e( 'Side content setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
      <select name="page_sidebar_type">
       <option style="padding-right: 10px;" value="type1" <?php selected( $page_sidebar_type, 'type1' ); ?>><?php _e( 'Display on left side', 'tcd-w' ); ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $page_sidebar_type, 'type2' ); ?>><?php _e( 'Display on right side', 'tcd-w' ); ?></option>
      </select>
     </li>
     <li class="cf" id="custom_side_widget"><span class="label"><?php _e('Display custom menu', 'tcd-w'); ?></span><input name="use_custom_side_content" type="checkbox" value="1" <?php checked( $use_custom_side_content, 1 ); ?>></li>
    </ul>

    <div id="custom_side_widget_area" style="<?php if(!$use_custom_side_content){ echo "display:none;"; }else{ echo "display:block;"; } ?>">

    <div class="theme_option_message2">
     <p><?php _e('You can display a speech bubble widget and a custom menu. When displaying a custom menu, the widgets set in Appearance > Widgets will not be displayed.', 'tcd-w'); ?></br>
        <a href="./nav-menus.php"><?php _e('Click here for the custom menu settings.', 'tcd-w'); ?></a></p>
    </div>

    <h3 class="theme_option_headline2"><?php _e('Speech bubble widget', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Description', 'tcd-w');  ?></span>
       <textarea class="full_width" cols="50" rows="3" name="word_balloon_desc"><?php echo esc_textarea(  $word_balloon_desc ); ?></textarea>
     </li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
      <div class="use_main_color">
        <input type="text" name="word_balloon_bg_color" value="<?php echo esc_attr( $word_balloon_bg_color ); ?>" data-default-color="#003041" class="c-color-picker">
      </div>
      <div class="use_main_color_checkbox">
        <label>
          <input name="word_balloon_bg_color_use_sub" type="checkbox" value="1" <?php checked( $word_balloon_bg_color_use_sub, 1 ); ?>>
          <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
        </label>
      </div>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Detailed setting', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Menu to display', 'tcd-w');  ?></span>
       <select name="side_navigation_type">
        <option style="padding-right: 10px;" value="" <?php selected( $side_navigation_type, '' ); ?>><?php _e('- Select -', 'tcd-w'); ?></option>
       <?php

        $nav_menus = wp_get_nav_menus();
        foreach ($nav_menus as $nav_menu):
          $menu_id = $nav_menu->term_id;
          $menu_label = $nav_menu->name;

       ?>
       <option style="padding-right: 10px;" value="<?php echo esc_attr($menu_id); ?>" <?php selected( $side_navigation_type, esc_attr($menu_id) ); ?>><?php echo esc_html($menu_label); ?></option>
       <?php endforeach; ?>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Custom menu color scheme', 'tcd-w'); ?></span>
      <div class="use_main_color">
        <input type="text" name="side_navigation_color" value="<?php echo esc_attr( $side_navigation_color ); ?>" data-default-color="#0094c9" class="c-color-picker">
      </div>
      <div class="use_main_color_checkbox">
        <label>
          <input name="side_navigation_color_use_main" type="checkbox" value="1" <?php checked( $side_navigation_color_use_main, 1 ); ?>>
          <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
        </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Fixed display on screen when scrolling', 'tcd-w'); ?></span><input name="use_fix_side_navigation" type="checkbox" value="1" <?php checked( $use_fix_side_navigation, 1 ); ?>></li>
    </ul>

    </div>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'page_hide_header_message','page_hide_header','page_hide_footer','page_hide_sidebar','change_content_width','page_content_width',
    'page_sidebar_type', 'use_custom_side_content', 'word_balloon_desc', 'word_balloon_bg_color', 'word_balloon_bg_color_use_sub',
    'side_navigation_type', 'side_navigation_color', 'side_navigation_color_use_main', 'use_fix_side_navigation'
  );
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

  // repeater save or delete
  // $cf_keys = array('faq_list');
  // foreach ( $cf_keys as $cf_key ) {
  //   $old = get_post_meta( $post_id, $cf_key, true );

  //   if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
  //     $new = array_values( $_POST[$cf_key] );
  //   } else {
  //     $new = false;
  //   }

  //   if ( $new && $new != $old ) {
  //     update_post_meta( $post_id, $cf_key, $new );
  //   } elseif ( ! $new && $old ) {
  //     delete_post_meta( $post_id, $cf_key, $old );
  //   }
  // }

}
add_action('save_post', 'save_page_header_meta_box');



?>