<?php


// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function edit_category_custom_fields( $term ) {
  global $box_content_icon_options, $pagenow;
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'color2' => '#003042',
		'color2_use_sub' => '1',
    'icon_type' => 'type1',
    'icon_image' => null,
    'icon_image_retina' => null,
    'icon_font' => 'pencil',
    'icon_font_size' => '60',
    'icon_font_color' => '#FFFFFF',
	), $term_meta );
?>
<tr class="form-field">
	<th colspan="2">

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Basic setting', 'tcd-w' ); ?></h3>

 <div class="ccm_content clearfix">

  <?php if($term->parent == 0){ // 親カテゴリー ?>

  <h4 class="headline"><?php _e( 'Category color setting', 'tcd-w' ); ?></h4>
  <div class="theme_option_message2">
    <p><?php _e("This will be applied to the background color of each category's icon, header title, and parent category on the single page.", 'tcd-w'); ?>
  </div>
  <ul class="option_list button_option_area">
   <li class="cf">
    <span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
    <div class="use_main_color">
     <input type="text" name="term_meta[color2]" value="<?php echo esc_attr( $term_meta['color2'] ); ?>" data-default-color="#003042" class="c-color-picker">
    </div>
    <p class="hidden"><input name="term_meta[color2_use_sub]" type="hidden" value="0"></p>
    <div class="use_main_color_checkbox">
     <label>
      <input name="term_meta[color2_use_sub]" type="checkbox" value="1" <?php checked( $term_meta['color2_use_sub'], 1 ); ?>>
      <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
     </label>
    </div>
   </li>
  </ul>

  <h4 class="headline"><?php _e( 'Icon type', 'tcd-w' ); ?></h4>
  <ul class="design_radio_button">
    <li class="icon_type1_button">
      <input type="radio" id="icon_type1" name="term_meta[icon_type]" value="type1" <?php checked( $term_meta['icon_type'], 'type1' ); ?> />
      <label id="icon_type1_button" for="icon_type1"><?php _e( 'Display the image', 'tcd-w' ); ?></label>
    </li>
    <li class="icon_type1_button">
      <input type="radio" id="icon_type2" name="term_meta[icon_type]" value="type2" <?php checked( $term_meta['icon_type'], 'type2' ); ?> />
      <label id="icon_type2_button" for="icon_type2"><?php _e( 'Use icon fonts', 'tcd-w' ); ?></label>
    </li>
  </ul>

  <!-- 画像の場合 -->
  <div id="icon_type1_wrap" style="<?php if($term_meta['icon_type'] == 'type1') { echo 'display:block'; } else { echo 'display:none;'; }; ?>">

  <h4 class="headline"><?php _e( 'Icon image setting', 'tcd-w' ); ?></h4>
  <div class="theme_option_message2">
   <p>
    <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '50', '50'); ?><br />
    <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
   </p>
  </div>
  <div class="input_field">
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js icon_image">
				<input type="hidden" value="<?php if ( $term_meta['icon_image'] ) echo esc_attr( $term_meta['icon_image'] ); ?>" id="icon_image" name="term_meta[icon_image]" class="cf_media_id">
				<div class="preview_field"><?php if ( $term_meta['icon_image'] ) echo wp_get_attachment_image( $term_meta['icon_image'], 'medium'); ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['icon_image'] ) echo 'hidden'; ?>">
				</div>
			</div>
		</div>
  </div><!-- END input_field -->
  <p><label><input name="term_meta[icon_image_retina]" type="checkbox" value="1" <?php checked( '1', $term_meta['icon_image_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>

  </div><!-- 画像の場合 -->

  <div id="icon_type2_wrap" style="<?php if($term_meta['icon_type'] == 'type2') { echo 'display:block'; } else { echo 'display:none;'; }; ?>"><!-- フォントの場合 -->

  <h4 class="headline"><?php _e( 'Icon font type', 'tcd-w' ); ?></h4>
  <ul class="box_content_icon_type cf">
    <?php foreach( $box_content_icon_options as $option ) : ?>
    <li><label><input type="radio" name="term_meta[icon_font]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $term_meta['icon_font'], $option['value'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
    <?php endforeach; ?>
  </ul>
  <h4 class="headline"><?php _e( 'Icon font setting', 'tcd-w' ); ?></h4>
  <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-w'); ?></span><input type="text" name="term_meta[icon_font_color]" value="<?php echo esc_attr( $term_meta['icon_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Icon size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="term_meta[icon_font_size]" value="<?php esc_attr_e( $term_meta['icon_font_size'] ); ?>" /><span>px</span></li>
  </ul>

  </div><!-- フォントの場合 -->

 <?php }else{ // 子カテゴリー ?>

  <div class="theme_option_message2">
    <p><?php _e( 'This option is not available for child categories.', 'tcd-w' ); ?></p>
  </div>

 <?php } ?>


 </div><!-- END ccm_content -->
</div><!-- END .custom_category_meta -->

 </th>
</tr><!-- END .form-field -->
<?php
}
add_action( 'category_edit_form_fields', 'edit_category_custom_fields' );



// データを保存 -------------------------------------------------------
function save_category_custom_fields( $term_id ) {
  $new_meta = array();
  if ( isset( $_POST['term_meta'] ) ) {
		$current_term_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$new_meta[$key] = $_POST['term_meta'][$key];
			}
		}
	}
  update_option( "taxonomy_$current_term_id", $new_meta );
}
add_action( 'edited_category', 'save_category_custom_fields' );




?>