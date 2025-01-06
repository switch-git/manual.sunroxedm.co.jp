<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_post_dp_default_options' );


//  Add label of post tab
add_action( 'tcd_tab_labels', 'add_post_tab_label' );


// Add HTML of post tab
add_action( 'tcd_tab_panel', 'add_post_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_post_theme_options_validate' );


// タブの名前
function add_post_tab_label( $tab_labels ) {
	$tab_labels['post'] = __( 'Post', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_post_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['post_label'] = __( 'Post', 'tcd-w' );

	// アーカイブページの設定
  $dp_default_options['show_post_archive_header'] = 1;
  $dp_default_options['post_header_title_color'] = '#003042';
  $dp_default_options['post_header_title_color_use_sub'] = 1;

  $dp_default_options['show_post_archive_search_form'] = 1;
	$dp_default_options['post_archive_catch'] = __('Catchphrase', 'tcd-w' );
  $dp_default_options['post_archive_desc'] = __( 'Description will be displayed here.<br>Description will be displayed here.', 'tcd-w' );
  $dp_default_options['post_archive_title_font_size'] = '28';
  $dp_default_options['post_archive_title_font_size_mobile'] = '20';

  // カテゴリーアーカイブの設定
  $dp_default_options['show_post_category_header'] = 1;
  $dp_default_options['scroll_post_category_header'] = 1;
  $dp_default_options['show_post_category_search_form'] = 1;
  $dp_default_options['post_category_title_font_size'] = '22';
  $dp_default_options['post_category_title_font_size_mobile'] = '18';
  $dp_default_options['show_post_category_desc'] = 1;

	// 詳細ページ
  $dp_default_options['post_single_sidebar_type'] = 'type2';
  $dp_default_options['show_single_post_category_widget'] = 1;

	$dp_default_options['single_post_title_font_size'] = '30';
	$dp_default_options['single_post_title_font_size_mobile'] = '20';
	$dp_default_options['single_post_show_date'] = 1;
	$dp_default_options['single_post_show_update'] = '';
	$dp_default_options['single_post_show_category'] = 1;

	$dp_default_options['single_post_show_comment'] = 1;
	$dp_default_options['single_post_show_trackback'] = 1;
	$dp_default_options['single_post_show_sns_top'] = 1;
	$dp_default_options['single_post_show_sns_btm'] = 1;
	$dp_default_options['single_post_show_copy_top'] = 1;
	$dp_default_options['single_post_show_meta_box'] = '';
	$dp_default_options['single_post_show_meta_category'] = 1;
	$dp_default_options['single_post_show_meta_tag'] = 1;
	$dp_default_options['single_post_show_meta_author'] = 1;
	$dp_default_options['single_post_show_meta_comment'] = 1;


	// 記事ページのバナー
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_mobile_ad_code'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_post_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $catch_animation_type_options;
  $post_label = $options['post_label'] ? esc_html( $options['post_label'] ) : __( 'Post', 'tcd-w' );

?>

<div id="tab-content-post" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[post_label]" value="<?php echo esc_attr($options['post_label']); ?>" />

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <?php

      $home_page_id = get_option( 'page_for_posts' );
      $home_page_url = get_page_link( $home_page_id );  
     
     ?>

     <div class="theme_option_message2">
      <p><?php _e('Settings for the post archive page. The parent category set for the post will be listed.', 'tcd-w'); ?></p>
      <?php if($home_page_id) { ?>
      <p><?php _e('URL of the post archive page:', 'tcd-w'); ?><a class="e_link" href="<?php echo esc_url($home_page_url) ?>"><?php echo esc_url($home_page_url) ?></a></p>
      <?php } else { ?>
      <p><?php _e('The page for the post archive page is not set.', 'tcd-w'); ?>
         <?php _e('Please refer to the <a href="https://dl.tcd-theme.com/biz001/display-setting/ ">manual</a> to create and configure.', 'tcd-w'); ?></p>
      <?php } ?>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Header title setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_post_archive_header]" type="checkbox" value="1" <?php checked( $options['show_post_archive_header'], 1 ); ?>><?php _e( 'Display header title', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_post_archive_header'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('The header title will reflect the name of the content in the basic settings.', 'tcd-w');  ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
          <div class="use_main_color">
            <input type="text" name="dp_options[post_header_title_color]" value="<?php echo esc_attr( $options['post_header_title_color'] ); ?>" data-default-color="#003042" class="c-color-picker">
          </div>
          <div class="use_main_color_checkbox">
            <label>
              <input name="dp_options[post_header_title_color_use_sub]" type="checkbox" value="1" <?php checked( $options['post_header_title_color_use_sub'], 1 ); ?>>
              <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
            </label>
          </div>
        </li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Header content setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Display the search form', 'tcd-w');  ?></span><input name="dp_options[show_post_archive_search_form]" type="checkbox" value="1" <?php checked( '1', $options['show_post_archive_search_form'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-w');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[post_archive_catch]"><?php echo esc_textarea(  $options['post_archive_catch'] ); ?></textarea></li>
       <li class="cf"><span class="label"><?php _e('Description', 'tcd-w');  ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[post_archive_desc]"><?php echo esc_textarea(  $options['post_archive_desc'] ); ?></textarea></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Category list setting', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[post_archive_title_font_size]" value="<?php esc_attr_e( $options['post_archive_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[post_archive_title_font_size_mobile]" value="<?php esc_attr_e( $options['post_archive_title_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // カテゴリーアーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Category archive setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Header title setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('The header title will reflect the name of the category.', 'tcd-w'); ?></p>
     </div>
     <p class="displayment_checkbox"><label><input name="dp_options[show_post_category_header]" type="checkbox" value="1" <?php checked( $options['show_post_category_header'], 1 ); ?>><?php _e( 'Display header title', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_post_category_header'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
        <li class="cf" style="padding-top:8px; border-top:1px dotted #ddd;"><span class="label"><?php _e('Fixed display on screen when scrolling', 'tcd-w');  ?></span><input name="dp_options[scroll_post_category_header]" type="checkbox" value="1" <?php checked( '1', $options['scroll_post_category_header'] ); ?> /></li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Search form setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Display the search form', 'tcd-w');  ?></span><input name="dp_options[show_post_category_search_form]" type="checkbox" value="1" <?php checked( '1', $options['show_post_category_search_form'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php echo __('Post list setting', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[post_category_title_font_size]" value="<?php esc_attr_e( $options['post_category_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[post_category_title_font_size_mobile]" value="<?php esc_attr_e( $options['post_category_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Show an excerpt from each article.', 'tcd-w');  ?></span><input name="dp_options[show_post_category_desc]" type="checkbox" value="1" <?php checked( '1', $options['show_post_category_desc'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 記事ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Single page setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Side content setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
       <select class="button_type_option" name="dp_options[post_single_sidebar_type]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $options['post_single_sidebar_type'], 'type1' ); ?>><?php _e('Display on left side', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $options['post_single_sidebar_type'], 'type2' ); ?>><?php _e('Display on right side', 'tcd-w');  ?></option>
       </select>
      </li>
      <li class="cf displayment_checkbox">
        <span class="label"><?php _e('Display the category list', 'tcd-w');  ?></span>
        <input class="" name="dp_options[show_single_post_category_widget]" type="checkbox" value="1" <?php checked( '1', $options['show_single_post_category_widget'] ); ?> />
      </li>
      <div class="theme_option_message2" style="<?php if($options['show_single_post_category_widget'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <p><?php _e('The child categories will be displayed in a list. If you have not set any child categories, they will not be displayed.', 'tcd-w');  ?></p>
      </div>
     </ul>
     

     <h4 class="theme_option_headline2"><?php _e('Post title area setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_post_title_font_size]" value="<?php esc_attr_e( $options['single_post_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_post_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_post_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w');  ?></span><input name="dp_options[single_post_show_category]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_category'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input class="display_option" data-option-name="single_post_show_date" name="dp_options[single_post_show_date]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_date'] ); ?> /></li>
      <li class="cf single_post_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w');  ?></span><input name="dp_options[single_post_show_update]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_update'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display comment', 'tcd-w');  ?></span><input name="dp_options[single_post_show_comment]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_comment'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display trackbacks', 'tcd-w');  ?></span><input name="dp_options[single_post_show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_trackback'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button above post content', 'tcd-w');  ?></span><input name="dp_options[single_post_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[single_post_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_post_show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_copy_top'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Meta box setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[single_post_show_meta_box]" type="checkbox" value="1" <?php checked( $options['single_post_show_meta_box'], 1 ); ?>><?php _e( 'Display meta box', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['single_post_show_meta_box'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w');  ?></span><input name="dp_options[single_post_show_meta_author]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_meta_author'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w');  ?></span><input name="dp_options[single_post_show_meta_category]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_meta_category'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display tag', 'tcd-w');  ?></span><input name="dp_options[single_post_show_meta_tag]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_meta_tag'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display comment', 'tcd-w');  ?></span><input name="dp_options[single_post_show_meta_comment]" type="checkbox" value="1" <?php checked( '1', $options['single_post_show_meta_comment'] ); ?> /></li>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_mobile_ad_code]"><?php echo esc_textarea( $options['single_mobile_ad_code'] ); ?></textarea>
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
} // END add_post_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_post_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $catch_animation_type_options;

  // 基本設定
  $input['post_label'] = wp_filter_nohtml_kses( $input['post_label'] );

  //アーカイブページの設定
  $input['show_post_archive_header'] = ! empty( $input['show_post_archive_header'] ) ? 1 : 0;
  $input['post_header_title_color'] = sanitize_hex_color( $input['post_header_title_color'] );
  $input['post_header_title_color_use_sub'] = ! empty( $input['post_header_title_color_use_sub'] ) ? 1 : 0;

  $input['show_post_archive_search_form'] = ! empty( $input['show_post_archive_search_form'] ) ? 1 : 0;
  $input['post_archive_catch'] = wp_filter_nohtml_kses( $input['post_archive_catch'] );
  $input['post_archive_desc'] = wp_filter_nohtml_kses( $input['post_archive_desc'] );
  $input['post_archive_title_font_size'] = wp_filter_nohtml_kses( $input['post_archive_title_font_size'] );
  $input['post_archive_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['post_archive_title_font_size_mobile'] );

    //アーカイブページの設定
  $input['show_post_category_header'] = ! empty( $input['show_post_category_header'] ) ? 1 : 0;
  $input['scroll_post_category_header'] = ! empty( $input['scroll_post_category_header'] ) ? 1 : 0;

  $input['show_post_category_search_form'] = ! empty( $input['show_post_category_search_form'] ) ? 1 : 0;

  $input['post_category_title_font_size'] = wp_filter_nohtml_kses( $input['post_category_title_font_size'] );
  $input['post_category_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['post_category_title_font_size_mobile'] );
  $input['show_post_category_desc'] = ! empty( $input['show_post_category_desc'] ) ? 1 : 0;

  // 記事ページ
  $input['post_single_sidebar_type'] = wp_filter_nohtml_kses( $input['post_single_sidebar_type'] );
  $input['show_single_post_category_widget'] = ! empty( $input['show_single_post_category_widget'] ) ? 1 : 0;

  $input['single_post_title_font_size'] = wp_filter_nohtml_kses( $input['single_post_title_font_size'] );
  $input['single_post_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_post_title_font_size_mobile'] );
  $input['single_post_show_date'] = ! empty( $input['single_post_show_date'] ) ? 1 : 0;
  $input['single_post_show_update'] = ! empty( $input['single_post_show_update'] ) ? 1 : 0;
  $input['single_post_show_category'] = ! empty( $input['single_post_show_category'] ) ? 1 : 0;

  $input['single_post_show_comment'] = ! empty( $input['single_post_show_comment'] ) ? 1 : 0;
  $input['single_post_show_trackback'] = ! empty( $input['single_post_show_trackback'] ) ? 1 : 0;
  $input['single_post_show_sns_top'] = ! empty( $input['single_post_show_sns_top'] ) ? 1 : 0;
  $input['single_post_show_sns_btm'] = ! empty( $input['single_post_show_sns_btm'] ) ? 1 : 0;
  $input['single_post_show_copy_top'] = ! empty( $input['single_post_show_copy_top'] ) ? 1 : 0;
  $input['single_post_show_meta_box'] = ! empty( $input['single_post_show_meta_box'] ) ? 1 : 0;
  $input['single_post_show_meta_category'] = ! empty( $input['single_post_show_meta_category'] ) ? 1 : 0;
  $input['single_post_show_meta_comment'] = ! empty( $input['single_post_show_meta_comment'] ) ? 1 : 0;
  $input['single_post_show_meta_tag'] = ! empty( $input['single_post_show_meta_tag'] ) ? 1 : 0;
  $input['single_post_show_meta_author'] = ! empty( $input['single_post_show_meta_author'] ) ? 1 : 0;


  // 記事ページのバナー広告
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_mobile_ad_code'] = $input['single_mobile_ad_code'];

	return $input;

};


?>