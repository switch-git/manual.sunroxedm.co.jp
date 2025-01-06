<?php

function blog_meta_box() {
  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
  add_meta_box(
    'blog_meta_box',//ID of meta box
    sprintf(__('Data of %s', 'tcd-w'), $blog_label),//label
    'show_blog_meta_box',//callback function
    'blog',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'blog_meta_box');

function show_blog_meta_box() {
  global $post;
  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

  $show = false;
  if(($options['index_slider_type'] == 'type2' && $options['show_index_slider']) ||
     ($options['mobile_show_index_slider'] == 'type2' && $options['mobile_index_slider_type'] == 'type2') ||
     ($options['mobile_show_index_slider'] == 'type1' && $options['index_slider_type'] == 'type2'))
     { $show = true; }

  $blog_content_type = get_post_meta($post->ID, 'blog_content_type', true) ?  get_post_meta($post->ID, 'blog_content_type', true) : 'type1';

  $blog_use_overlay = get_post_meta($post->ID, 'blog_use_overlay', true) ? get_post_meta($post->ID, 'blog_overlay_color', true) : 1;
  $blog_overlay_color = get_post_meta($post->ID, 'blog_overlay_color', true) ?  get_post_meta($post->ID, 'blog_overlay_color', true) : '#000000';
  $blog_overlay_opacity = get_post_meta($post->ID, 'blog_overlay_opacity', true) ?  get_post_meta($post->ID, 'blog_overlay_opacity', true) : '0.3';

  $blog_bg_color = get_post_meta($post->ID, 'blog_bg_color', true) ?  get_post_meta($post->ID, 'blog_bg_color', true) : '#000000';

  echo '<input type="hidden" name="blog_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_field_wrap">

  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Article slider setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="theme_option_message2">
     <p><?php _e('Set the image that will be displayed when the article slider is selected in the <a href="./admin.php?page=theme_options">header content settings</a>.', 'tcd-w');  ?></p>
    </div>

    <h4 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h4>

    <div style="<?php if($show) { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <div class="theme_option_message2">
        <p style="font-weight:600;"><?php _e('This option is not available because you are not displaying the header content on the top page or you have not selected the article slider.', 'tcd-w');  ?></br>
           <?php _e('If you want to use this option, go to Theme Options > Top Page > Header Content Settings and select the article slider.', 'tcd-w');  ?></p>
        <p><a href="./admin.php?page=theme_options"><?php _e('TCD Theme Options can be accessed here.', 'tcd-w');  ?></a></p>
      </div>
    </div>

    <div style="<?php if($show) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

    <ul class="design_radio_button blog_content_type_button cf">
      <li>
        <input type="radio" id="blog_content_type1" name="blog_content_type" value="type1" <?php checked( $blog_content_type, 'type1' ); ?> />
        <label for="blog_content_type1"><?php _e('Use featured image', 'tcd-w');  ?></label>
      </li>
      <li>
        <input type="radio" id="blog_content_type2" name="blog_content_type" value="type2" <?php checked( $blog_content_type, 'type2' ); ?> />
        <label for="blog_content_type2"><?php _e('Use layer image', 'tcd-w');  ?></label>
      </li>
    </ul>

    <div id="blog_content_type1_area" style="<?php if($blog_content_type == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <div class="theme_option_message2">
        <p><?php _e('Use the featured image as the background image of the article slider.', 'tcd-w');  ?><br><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '812'); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
      <p><?php _e('Set an overlay for the featured image.', 'tcd-w');  ?></p>
      </div>
      <p class="displayment_checkbox"><label><input name="blog_use_overlay" type="checkbox" value="1" <?php checked( $blog_use_overlay, 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
      <div style="<?php if($blog_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="blog_overlay_color" value="<?php echo esc_attr( $blog_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="blog_overlay_opacity" value="<?php echo esc_attr($blog_overlay_opacity); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
        </li>
      </ul>
      </div>

    </div>


    <div id="blog_content_type2_area" style="<?php if($blog_content_type == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('You can set the layer image and background color to be displayed in the article slider. featured image will not be displayed.', 'tcd-w');  ?></p>
      </div>

      <!-- レイヤー画像 -->
      <h4 class="theme_option_headline2"><?php _e( 'Background color of article slider', 'tcd-w' ); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="blog_bg_color" value="<?php echo esc_attr( $blog_bg_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e( 'Layer image', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '450'); ?></p>
      </div>
      <?php mlcf_media_form('blog_bg_image', __('Image for front page', 'tcd-w')); ?>

      <h4 class="theme_option_headline2"><?php _e( 'Layer image (mobile)', 'tcd-w' ); ?></h4>
      <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '350', '315'); ?></p>
      </div>
      <?php mlcf_media_form('blog_bg_image_mobile', __('Image for front page', 'tcd-w')); ?>

    </div><!-- use slider type2 -->


    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>

    </div>

   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

</div>
<?php
}

function save_blog_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['blog_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['blog_custom_fields_meta_box_nonce'], basename(__FILE__))) {
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
    'blog_content_type',
    'blog_use_overlay','blog_overlay_color','blog_overlay_opacity',
    'blog_bg_color','blog_bg_image','blog_bg_image_mobile'
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

}
add_action('save_post', 'save_blog_meta_box');




?>
