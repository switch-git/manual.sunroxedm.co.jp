<?php
/*
 * プロジェクトの設定 カスタム投稿「ブログ」
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
  $tab_labels['blog'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_label'] = __( 'Blog', 'tcd-w' );
	$dp_default_options['blog_slug'] = 'blog';
	$dp_default_options['blog_category_label'] = __( 'Blog category', 'tcd-w' );
	$dp_default_options['blog_category_slug'] = 'blog_category';

  // アーカイブページの設定
  $dp_default_options['show_archive_blog_header_title'] = 1;
  $dp_default_options['archive_blog_header_title_color'] = '#003042';
  $dp_default_options['archive_blog_header_title_color_use_sub'] = 1;

  $dp_default_options['archive_blog_show_category_list'] = '1';
	$dp_default_options['archive_blog_category_list_label'] = __('Latest info', 'tcd-w' );

  $dp_default_options['archive_blog_animation'] = 'type3';
	$dp_default_options['archive_blog_num'] = '9';
	$dp_default_options['archive_blog_num_mobile'] = '10';
	$dp_default_options['archive_blog_title_font_size'] = '18';
	$dp_default_options['archive_blog_title_font_size_mobile'] = '18';

  $dp_default_options['pager_range'] = '1';
  $dp_default_options['pager_show_arrow'] = 1;
  $dp_default_options['pager_range_mobile'] = '1';
  $dp_default_options['pager_show_arrow_mobile'] = 1;


	// 詳細ページ
  $dp_default_options['blog_single_sidebar_type'] = 'type2';
	$dp_default_options['single_blog_title_font_size'] = '26';
	$dp_default_options['single_blog_title_font_size_mobile'] = '20';
  $dp_default_options['single_blog_show_date'] = 1;
  $dp_default_options['single_blog_show_update'] = 1;

  $dp_default_options['single_blog_show_sns_top'] = 1;
	$dp_default_options['single_blog_show_sns_btm'] = 1;
	$dp_default_options['single_blog_show_copy_top'] = 1;

  // 関連記事
	$dp_default_options['show_related_blog'] = 1;
	$dp_default_options['related_blog_headline'] = __( 'Related post', 'tcd-w' );
	$dp_default_options['related_blog_headline_font_size'] = '22';
	$dp_default_options['related_blog_headline_font_size_mobile'] = '18';
	$dp_default_options['related_blog_num'] = '3';
	$dp_default_options['related_blog_num_mobile'] = '3';
	$dp_default_options['related_blog_title_font_size'] = '18';
	$dp_default_options['related_blog_title_font_size_mobile'] = '14';

  // 広告
	$dp_default_options['blog_single_top_ad_code'] = '';
	$dp_default_options['blog_single_bottom_ad_code'] = '';
	$dp_default_options['blog_single_mobile_ad_code'] = '';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $catch_animation_type_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div id="tab-content-blog" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input class="regular-text" type="text" name="dp_options[blog_label]" value="<?php echo esc_attr( $options['blog_label'] ); ?>" />
     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku regular-text" type="text" name="dp_options[blog_slug]" value="<?php echo sanitize_title( $options['blog_slug'] ); ?>" /></p>
     <h4 class="theme_option_headline2"><?php printf(__('Name of %s category', 'tcd-w'), $blog_label); ?></h4>
     <input class="regular-text" type="text" name="dp_options[blog_category_label]" value="<?php echo esc_attr( $options['blog_category_label'] ); ?>" />
     <h4 class="theme_option_headline2"><?php printf(__('%s category slug setting', 'tcd-w'), $blog_label); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku regular-text" type="text" name="dp_options[blog_category_slug]" value="<?php echo sanitize_title( $options['blog_category_slug'] ); ?>" /></p>

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

     <h4 class="theme_option_headline2"><?php _e('Header title setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_archive_blog_header_title]" type="checkbox" value="1" <?php checked( $options['show_archive_blog_header_title'], 1 ); ?>><?php _e( 'Display header title', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_archive_blog_header_title'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('The header title will reflect the name of the content in the basic settings.', 'tcd-w');  ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
          <div class="use_main_color">
            <input type="text" name="dp_options[archive_blog_header_title_color]" value="<?php echo esc_attr( $options['archive_blog_header_title_color'] ); ?>" data-default-color="#003042" class="c-color-picker">
          </div>
          <div class="use_main_color_checkbox">
            <label>
              <input name="dp_options[archive_blog_header_title_color_use_sub]" type="checkbox" value="1" <?php checked( $options['archive_blog_header_title_color_use_sub'], 1 ); ?>>
              <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
            </label>
          </div>
        </li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Category list setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[archive_blog_show_category_list]" type="checkbox" value="1" <?php checked( $options['archive_blog_show_category_list'], 1 ); ?>><?php _e( 'Display category list', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['archive_blog_show_category_list'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php printf(__('Labels to be displayed in the list of new articles', 'tcd-w'), $blog_label); ?></span><input class="full_width" type="text" name="dp_options[archive_blog_category_list_label]" value="<?php esc_attr_e( $options['archive_blog_category_list_label'] ); ?>" /></li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php printf(__('%s list setting', 'tcd-w'), $blog_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Animation type', 'tcd-w'); ?></span>
       <select name="dp_options[archive_blog_animation]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $options['archive_blog_animation'], 'type1' ); ?>><?php _e('Fade in', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $options['archive_blog_animation'], 'type2' ); ?>><?php _e('Pop-up', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="type3" <?php selected( $options['archive_blog_animation'], 'type3' ); ?>><?php _e('Slide up', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="type4" <?php selected( $options['archive_blog_animation'], 'type4' ); ?>><?php _e('No animation', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display', 'tcd-w'); ?></span>
       <select name="dp_options[archive_blog_num]">
        <?php for($i=3; $i<= 15; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_blog_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w'); ?></span>
       <select name="dp_options[archive_blog_num_mobile]">
        <?php for($i=3; $i<= 15; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_blog_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_title_font_size]" value="<?php esc_attr_e( $options['archive_blog_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Pager settings', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display links to the first and last page', 'tcd-w');  ?></span><input id="dp_options[pager_show_arrow]" name="dp_options[pager_show_arrow]" type="checkbox" value="1" <?php checked( '1', $options['pager_show_arrow'] ); ?> /></li>
      <li class="cf">
       <span class="label"><?php _e('Number of pagers to display', 'tcd-w'); ?></span>
       <select name="dp_options[pager_range]">
        <?php 
          $count_posts = wp_count_posts();
          $total_post_num = $count_posts -> publish;
          $default_post_on_page = $options['archive_blog_num'];
          $temp1 = floor($total_post_num/$default_post_on_page);
          $temp2 = $total_post_num%$default_post_on_page;
          $selected_flag = false;
          if($temp2>0):
            $total_page = $temp1 + 1;
          else:
            $total_page = $temp1;
          endif;
          for($i=1; $i<=$total_page; $i++){
            if($i%2==1 && $i<$total_page){
              echo '<option value="'.$i.'" '.selected( $options['pager_range'], $i, false).'>'.$i.'</option>';
              if(!empty(selected( $options['pager_range'], $i, false))){ $selected_flag = true; };
            }elseif($i==$total_page){
              if($selected_flag){
                echo '<option value="'.$i.'" '.selected( $options['pager_range'], $i, false).'>'.__('All pages', 'tcd-w').'</option>';
              }else{
                echo '<option value="'.$i.'" selected>'.__('All pages', 'tcd-w').'</option>';
              }
            }
          }
        ?>
     </select>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Pager settings for mobile', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display links to the first and last page', 'tcd-w');  ?></span><input id="dp_options[pager_show_arrow_mobile]" name="dp_options[pager_show_arrow_mobile]" type="checkbox" value="1" <?php checked( '1', $options['pager_show_arrow_mobile'] ); ?> /></li>
      <li class="cf">
       <span class="label"><?php _e('Number of pagers to display', 'tcd-w'); ?></span>
       <select name="dp_options[pager_range_mobile]">
        <?php 
          $count_posts = wp_count_posts();
          $total_post_num = $count_posts -> publish;
          $default_post_on_page = $options['archive_blog_num_mobile'];
          $temp1 = floor($total_post_num/$default_post_on_page);
          $temp2 = $total_post_num%$default_post_on_page;
          $selected_flag = false;
          if($temp2>0):
            $total_page = $temp1 + 1;
          else:
            $total_page = $temp1;
          endif;
          for($i=1; $i<=$total_page; $i++){
            if($i%2==1 && $i<$total_page){
              echo '<option value="'.$i.'" '.selected( $options['pager_range_mobile'], $i, false).'>'.$i.'</option>';
              if(!empty(selected( $options['pager_range_mobile'], $i, false))){ $selected_flag = true; };
            }elseif($i==$total_page){
              if($selected_flag){
                echo '<option value="'.$i.'" '.selected( $options['pager_range_mobile'], $i, false).'>'.__('All pages', 'tcd-w').'</option>';
              }else{
                echo '<option value="'.$i.'" selected>'.__('All pages', 'tcd-w').'</option>';
              }
            }
          }
        ?>
       </select>
      </li>
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
       <select class="button_type_option" name="dp_options[blog_single_sidebar_type]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $options['blog_single_sidebar_type'], 'type1' ); ?>><?php _e('Display on left side', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $options['blog_single_sidebar_type'], 'type2' ); ?>><?php _e('Display on right side', 'tcd-w');  ?></option>
       </select>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Title area setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_title_font_size]" value="<?php esc_attr_e( $options['single_blog_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input class="display_option" data-option-name="single_blog_show_date" name="dp_options[single_blog_show_date]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_date'] ); ?> /></li>
      <li class="cf single_blog_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_update]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_update'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display social button above post content', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_copy_top'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php echo __('Related post setting', 'tcd-w'); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_related_blog]" type="checkbox" value="1" <?php checked( $options['show_related_blog'], 1 ); ?>><?php echo __('Display related post', 'tcd-w'); ?></label></p>
     <div style="<?php if($options['show_related_blog'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php _e('If there are no post in the same category, related post will not be displayed.', 'tcd-w');  ?></p>
      </div>
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[related_blog_headline]" value="<?php echo esc_textarea(  $options['related_blog_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_blog_headline_font_size]" value="<?php esc_attr_e( $options['related_blog_headline_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_blog_headline_font_size_mobile]" value="<?php esc_attr_e( $options['related_blog_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf">
        <span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[related_blog_num]">
         <?php for($i=3; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_blog_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w');  ?></span>
        <select name="dp_options[related_blog_num_mobile]">
         <?php for($i=3; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_blog_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_blog_title_font_size]" value="<?php esc_attr_e( $options['related_blog_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['related_blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[blog_single_top_ad_code]"><?php echo esc_textarea( $options['blog_single_top_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[blog_single_bottom_ad_code]"><?php echo esc_textarea( $options['blog_single_bottom_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[blog_single_mobile_ad_code]"><?php echo esc_textarea( $options['blog_single_mobile_ad_code'] ); ?></textarea>
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
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $catch_animation_type_options;

  //基本設定
  $input['blog_slug'] = sanitize_title( $input['blog_slug'] );
  $input['blog_label'] = wp_filter_nohtml_kses( $input['blog_label'] );
  $input['blog_category_label'] = wp_filter_nohtml_kses( $input['blog_category_label'] );
  $input['blog_category_slug'] = sanitize_title( $input['blog_category_slug'] );


  //ヘッダーの設定
  $input['show_archive_blog_header_title'] = ! empty( $input['show_archive_blog_header_title'] ) ? 1 : 0;
  $input['archive_blog_header_title_color'] = sanitize_hex_color( $input['archive_blog_header_title_color'] );
  $input['archive_blog_header_title_color_use_sub'] = ! empty( $input['archive_blog_header_title_color_use_sub'] ) ? 1 : 0;


  // アーカイブ
  $input['archive_blog_show_category_list'] = ! empty( $input['archive_blog_show_category_list'] ) ? 1 : 0;
  $input['archive_blog_category_list_label'] = wp_filter_nohtml_kses( $input['archive_blog_category_list_label'] );

  $input['archive_blog_animation'] = wp_filter_nohtml_kses( $input['archive_blog_animation'] );
  $input['archive_blog_num'] = wp_filter_nohtml_kses( $input['archive_blog_num'] );
  $input['archive_blog_num_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_num_mobile'] );
  $input['archive_blog_title_font_size'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size'] );
  $input['archive_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size_mobile'] );

  $input['pager_range'] = absint( $input['pager_range'] );
  if ( ! isset( $input['pager_show_arrow'] ) )
    $input['pager_show_arrow'] = null;
    $input['pager_show_arrow'] = ( $input['pager_show_arrow'] == 1 ? 1 : 0 );

  $input['pager_range_mobile'] = absint( $input['pager_range_mobile'] );
  if ( ! isset( $input['pager_show_arrow_mobile'] ) )
    $input['pager_show_arrow_mobile'] = null;
    $input['pager_show_arrow_mobile'] = ( $input['pager_show_arrow_mobile'] == 1 ? 1 : 0 );

  //詳細ページ
  $input['blog_single_sidebar_type'] = wp_filter_nohtml_kses( $input['blog_single_sidebar_type'] );
  $input['single_blog_title_font_size'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size'] );
  $input['single_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size_mobile'] );
  $input['single_blog_show_date'] = ! empty( $input['single_blog_show_date'] ) ? 1 : 0;
  $input['single_blog_show_update'] = ! empty( $input['single_blog_show_update'] ) ? 1 : 0;

  $input['single_blog_show_sns_top'] = ! empty( $input['single_blog_show_sns_top'] ) ? 1 : 0;
  $input['single_blog_show_sns_btm'] = ! empty( $input['single_blog_show_sns_btm'] ) ? 1 : 0;
  $input['single_blog_show_copy_top'] = ! empty( $input['single_blog_show_copy_top'] ) ? 1 : 0;


  // 最新お知らせ一覧
  $input['show_related_blog'] = ! empty( $input['show_related_blog'] ) ? 1 : 0;
  $input['related_blog_headline'] = wp_filter_nohtml_kses( $input['related_blog_headline'] );
  $input['related_blog_headline_font_size'] = wp_filter_nohtml_kses( $input['related_blog_headline_font_size'] );
  $input['related_blog_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_blog_headline_font_size_mobile'] );
  $input['related_blog_num'] = wp_filter_nohtml_kses( $input['related_blog_num'] );
  $input['related_blog_num_mobile'] = wp_filter_nohtml_kses( $input['related_blog_num_mobile'] );
  $input['related_blog_title_font_size'] = wp_filter_nohtml_kses( $input['related_blog_title_font_size'] );
  $input['related_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_blog_title_font_size_mobile'] );


  // 広告
  $input['blog_single_top_ad_code'] = $input['blog_single_top_ad_code'];
  $input['blog_single_bottom_ad_code'] = $input['blog_single_bottom_ad_code'];
  $input['blog_single_mobile_ad_code'] = $input['blog_single_mobile_ad_code'];


	return $input;

};


?>