<?php
/*
 * お知らせの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $tab_labels['news'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['news_label'] = __( 'News', 'tcd-w' );
	$dp_default_options['news_slug'] = 'news';

  // アーカイブページの設定
  $dp_default_options['news_archive_sidebar_type'] = 'type2';

  $dp_default_options['show_archive_news_header_title'] = 1;
  $dp_default_options['archive_news_header_title_color'] = '#003042';
  $dp_default_options['archive_news_header_title_color_use_sub'] = 1;

  $dp_default_options['hide_archive_news_thumbnail'] = '';
  $dp_default_options['archive_news_num'] = '8';
	$dp_default_options['archive_news_num_mobile'] = '5';
	$dp_default_options['archive_news_title_font_size'] = '16';
	$dp_default_options['archive_news_title_font_size_mobile'] = '14';

	// 詳細ページ
  $dp_default_options['news_single_sidebar_type'] = 'type2';
	$dp_default_options['single_news_title_font_size'] = '24';
	$dp_default_options['single_news_title_font_size_mobile'] = '20';
	$dp_default_options['single_news_show_update'] = 1;

	$dp_default_options['single_news_show_sns_top'] = 1;
	$dp_default_options['single_news_show_sns_btm'] = 1;
	$dp_default_options['single_news_show_copy_top'] = 1;

	// 最新のお知らせ一覧
	$dp_default_options['show_recent_news'] = 1;
	$dp_default_options['recent_news_headline'] = __( 'Latest news', 'tcd-w' );
	$dp_default_options['recent_news_headline_font_size'] = '22';
	$dp_default_options['recent_news_headline_font_size_mobile'] = '18';
	$dp_default_options['recent_news_num'] = '4';
	$dp_default_options['recent_news_num_mobile'] = '3';
	$dp_default_options['recent_news_title_font_size'] = '16';
	$dp_default_options['recent_news_title_font_size_mobile'] = '14';

	// 広告
	$dp_default_options['news_single_top_ad_code'] = '';
	$dp_default_options['news_single_bottom_ad_code'] = '';
	$dp_default_options['news_single_mobile_ad_code'] = '';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $catch_animation_type_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );

?>

<div id="tab-content-news" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input id="dp_options[news_label]" class="regular-text" type="text" name="dp_options[news_label]" value="<?php echo esc_attr( $options['news_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input id="dp_options[news_slug]" class="hankaku regular-text" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Side content setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
       <select class="button_type_option" name="dp_options[news_archive_sidebar_type]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $options['news_archive_sidebar_type'], 'type1' ); ?>><?php _e('Display on left side', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $options['news_archive_sidebar_type'], 'type2' ); ?>><?php _e('Display on right side', 'tcd-w');  ?></option>
       </select>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Header title setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_archive_news_header_title]" type="checkbox" value="1" <?php checked( $options['show_archive_news_header_title'], 1 ); ?>><?php _e( 'Display header title', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_archive_news_header_title'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('The header title will reflect the name of the content in the basic settings.', 'tcd-w');  ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
          <div class="use_main_color">
            <input type="text" name="dp_options[archive_news_header_title_color]" value="<?php echo esc_attr( $options['archive_news_header_title_color'] ); ?>" data-default-color="#003042" class="c-color-picker">
          </div>
          <div class="use_main_color_checkbox">
            <label>
              <input name="dp_options[archive_news_header_title_color_use_sub]" type="checkbox" value="1" <?php checked( $options['archive_news_header_title_color_use_sub'], 1 ); ?>>
              <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
            </label>
          </div>
        </li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php printf(__('%s list setting', 'tcd-w'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Do not display thumbnail images.', 'tcd-w');  ?></span><input name="dp_options[hide_archive_news_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['hide_archive_news_thumbnail'] ); ?> /></li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display', 'tcd-w'); ?></span>
       <select name="dp_options[archive_news_num]">
        <?php for($i=2; $i<= 12; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_news_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w'); ?></span>
       <select name="dp_options[archive_news_num_mobile]">
        <?php for($i=2; $i<= 12; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_news_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_news_title_font_size]" value="<?php esc_attr_e( $options['archive_news_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_news_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_news_title_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Single page setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Side content setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
       <select class="button_type_option" name="dp_options[news_single_sidebar_type]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $options['news_single_sidebar_type'], 'type1' ); ?>><?php _e('Display on left side', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $options['news_single_sidebar_type'], 'type2' ); ?>><?php _e('Display on right side', 'tcd-w');  ?></option>
       </select>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Post title area setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_news_title_font_size]" value="<?php esc_attr_e( $options['single_news_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_news_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_news_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display modified date', 'tcd-w');  ?></span><input name="dp_options[single_news_show_update]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_update'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display social button above post content', 'tcd-w');  ?></span><input name="dp_options[single_news_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[single_news_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_news_show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_copy_top'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php echo __('Recent post setting', 'tcd-w'); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_recent_news]" type="checkbox" value="1" <?php checked( $options['show_recent_news'], 1 ); ?>><?php echo __('Display recent post', 'tcd-w'); ?></label></p>
     <div style="<?php if($options['show_recent_news'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[recent_news_headline]" value="<?php echo esc_textarea(  $options['recent_news_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_news_headline_font_size]" value="<?php esc_attr_e( $options['recent_news_headline_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_news_headline_font_size_mobile]" value="<?php esc_attr_e( $options['recent_news_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf">
        <span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[recent_news_num]">
         <?php for($i=3; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['recent_news_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w');  ?></span>
        <select name="dp_options[recent_news_num_mobile]">
         <?php for($i=3; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['recent_news_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_news_title_font_size]" value="<?php esc_attr_e( $options['recent_news_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[recent_news_title_font_size_mobile]" value="<?php esc_attr_e( $options['recent_news_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Additional content settings', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('You can display banners in HTML, Google calendar, SNS timeline, etc.', 'tcd-w');  ?></p>
     </div>

     <?php // メインコンテンツの上部 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Above main content', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This content will be displayed above main content.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-w');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[news_single_top_ad_code]"><?php echo esc_textarea( $options['news_single_top_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // メインコンテンツの下部 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Below main content', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed after main content.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-w');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[news_single_bottom_ad_code]"><?php echo esc_textarea( $options['news_single_bottom_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // モバイル用 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Mobile device', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This content will be displayed in mobile device only.', 'tcd-w');  ?></p>
        <p><?php _e('This content will be display after main content and will be repleace by additional content for PC device.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-w');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[news_single_mobile_ad_code]"><?php echo esc_textarea( $options['news_single_mobile_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $no_image_options, $font_type_options, $catch_animation_type_options;

  //基本設定
  $input['news_slug'] = sanitize_title( $input['news_slug'] );
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );

  // アーカイブページの設定
  $input['news_archive_sidebar_type'] = wp_filter_nohtml_kses( $input['news_archive_sidebar_type'] );
  $input['archive_news_header_title_color'] = sanitize_hex_color( $input['archive_news_header_title_color'] );
  $input['archive_news_header_title_color_use_sub'] = ! empty( $input['archive_news_header_title_color_use_sub'] ) ? 1 : 0;

  $input['hide_archive_news_thumbnail'] = ! empty( $input['hide_archive_news_thumbnail'] ) ? 1 : 0;
  $input['archive_news_num'] = wp_filter_nohtml_kses( $input['archive_news_num'] );
  $input['archive_news_num_mobile'] = wp_filter_nohtml_kses( $input['archive_news_num_mobile'] );
  $input['archive_news_title_font_size'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size'] );
  $input['archive_news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size_mobile'] );


  //詳細ページ
  $input['news_single_sidebar_type'] = wp_filter_nohtml_kses( $input['news_single_sidebar_type'] );
  $input['single_news_title_font_size'] = wp_filter_nohtml_kses( $input['single_news_title_font_size'] );
  $input['single_news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_news_title_font_size_mobile'] );
  $input['single_news_show_update'] = ! empty( $input['single_news_show_update'] ) ? 1 : 0;

  $input['single_news_show_sns_top'] = ! empty( $input['single_news_show_sns_top'] ) ? 1 : 0;
  $input['single_news_show_sns_btm'] = ! empty( $input['single_news_show_sns_btm'] ) ? 1 : 0;
  $input['single_news_show_copy_top'] = ! empty( $input['single_news_show_copy_top'] ) ? 1 : 0;


  // 最新お知らせ一覧
  $input['show_recent_news'] = ! empty( $input['show_recent_news'] ) ? 1 : 0;
  $input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
  $input['recent_news_headline_font_size'] = wp_filter_nohtml_kses( $input['recent_news_headline_font_size'] );
  $input['recent_news_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['recent_news_headline_font_size_mobile'] );
  $input['recent_news_num'] = wp_filter_nohtml_kses( $input['recent_news_num'] );
  $input['recent_news_num_mobile'] = wp_filter_nohtml_kses( $input['recent_news_num_mobile'] );
  $input['recent_news_title_font_size'] = wp_filter_nohtml_kses( $input['recent_news_title_font_size'] );
  $input['recent_news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['recent_news_title_font_size_mobile'] );

  // 広告
  $input['news_single_top_ad_code'] = $input['news_single_top_ad_code'];
  $input['news_single_bottom_ad_code'] = $input['news_single_bottom_ad_code'];
  $input['news_single_mobile_ad_code'] = $input['news_single_mobile_ad_code'];

	return $input;

};


?>