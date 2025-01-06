<?php
/*
 * トップページの設定（モバイル用）
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_mobile_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_mobile_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_mobile_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_mobile_theme_options_validate' );


// タブの名前
function add_front_page_mobile_tab_label( $tab_labels ) {
	$tab_labels['front_page_mobile'] = __( 'Front page (smartphone)', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_front_page_mobile_dp_default_options( $dp_default_options ) {

	// ヘッダースライダー
	$dp_default_options['mobile_show_index_slider'] = 'type2';
	$dp_default_options['mobile_index_slider_time'] = '5000';
	$dp_default_options['mobile_stop_index_slider_animation'] = '';
  $dp_default_options['mobile_index_slider_type'] = 'type1';

  // フロントカバー
  $dp_default_options['mobile_index_header_type1_logo'] = false;
  $dp_default_options['mobile_index_header_type1_logo_retina'] = '';
  $dp_default_options['mobile_index_header_type1_catch'] = __( 'Catchphrase', 'tcd-w' );
  $dp_default_options['mobile_index_header_type1_desc'] = __( 'Description will be displayed here.<br>Description will be displayed here.', 'tcd-w' );
	$dp_default_options['mobile_index_header_type1_bg_color'] = '#000000';
  $dp_default_options['mobile_index_header_type1_bg_color_use_sub'] = 1;
	$dp_default_options['mobile_index_header_type1_bg_opacity'] = '0.7';

  $dp_default_options['mobile_index_header_type1_bg_image'] = false;
  $dp_default_options['mobile_index_header_type1_use_search_form'] = 1;
  $dp_default_options['mobile_index_header_type1_search_form_bg_color'] = '#000000';
  $dp_default_options['mobile_index_header_type1_search_form_bg_color_use_main'] = 1;
  $dp_default_options['mobile_index_header_type1_search_form_bg_opacity'] = '0.4';

  // 記事スライダー
  $dp_default_options['mobile_index_header_type2_post_type'] = 'recent_post';
	$dp_default_options['mobile_index_header_type2_post_order'] = 'date';
	$dp_default_options['mobile_index_header_type2_post_num'] = '3';
  $dp_default_options['mobile_index_header_type2_title_font_type'] = 'type2';
	$dp_default_options['mobile_index_header_type2_title_font_size'] = '22';
  $dp_default_options['mobile_index_header_type2_show_date'] = '1';
	$dp_default_options['mobile_index_header_type2_show_category'] = '1';

  // タイプ3
	$dp_default_options['mobile_index_slider'] = array();

  // ボックスコンテンツの設定
  $dp_default_options['mobile_show_index_box_content'] = 1;
  $dp_default_options['mobile_index_box_content_font_size'] = '20';
  for ( $i = 1; $i <= 2; $i++ ) {
    $dp_default_options['mobile_index_box_content_headline'.$i] = __( 'Catchphrase', 'tcd-w' );
    $dp_default_options['mobile_index_box_content_desc'.$i] = __( 'Description will be displayed here.<br>Description will be displayed here.', 'tcd-w' );
    $dp_default_options['mobile_index_box_content_icon_type'.$i] = 'type2';
    $dp_default_options['mobile_index_box_content_icon_size'.$i] = '20';
    $dp_default_options['mobile_index_box_content_icon_color'.$i] = '#FFFFFF';
    $dp_default_options['mobile_index_box_content_image'.$i] = false;
    $dp_default_options['mobile_index_box_content_image_retina'.$i] = false;
    $dp_default_options['mobile_index_box_content_url'.$i] = '#';
	}
  $dp_default_options['mobile_index_box_content_icon1'] = 'pencil';
  $dp_default_options['mobile_index_box_content_icon2'] = 'book';

  // ニュースティッカー
  $dp_default_options['mobile_show_index_news'] = 1;
	$dp_default_options['mobile_index_news_post_type'] = 'news';
	$dp_default_options['mobile_index_news_post_order'] = 'date';
  $dp_default_options['mobile_index_news_label'] = __( 'News list', 'tcd-w' );

  // コンテンツビルダー
	$dp_default_options['mobile_index_content_type'] = 'type1';
	$dp_default_options['mobile_contents_builder'] = array();

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_tab_panel( $options ) {

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $slider_animation_options, $box_content_icon_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div id="tab-content-front-page-mobile" class="tab-content">

   <?php // ヘッダーコンテンツの設定 ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button">
      <li id="mobile_show_index_slider_type1_button">
       <input type="radio" id="mobile_show_index_slider_type1" name="dp_options[mobile_show_index_slider]" value="type1" <?php checked( $options['mobile_show_index_slider'], 'type1' ); ?> />
       <label for="mobile_show_index_slider_type1"><?php _e('Display same header content in smartphone', 'tcd-w');  ?></label>
      </li>
      <li id="mobile_show_index_slider_type2_button">
       <input type="radio" id="mobile_show_index_slider_type2" name="dp_options[mobile_show_index_slider]" value="type2" <?php checked( $options['mobile_show_index_slider'], 'type2' ); ?> />
       <label for="mobile_show_index_slider_type2"><?php _e('Display different header content in smartphone', 'tcd-w');  ?></label>
      </li>
      <li id="mobile_show_index_slider_type3_button">
       <input type="radio" id="mobile_show_index_slider_type3" name="dp_options[mobile_show_index_slider]" value="type3" <?php checked( $options['mobile_show_index_slider'], 'type3' ); ?> />
       <label for="mobile_show_index_slider_type3"><?php _e('Don\'t display header content in smartphone', 'tcd-w');  ?></label>
      </li>
     </ul>

     <div id="index_slider_input_area" style="<?php if($options['mobile_show_index_slider'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <!-- スライダーのラジオボタン -->
     <h4 class="theme_option_headline2"><?php _e('Content type', 'tcd-w');  ?></h4>
     <ul class="slider_type_radio_button cf">
      <li class="index_slider_type1_button <?php if($options['mobile_index_slider_type'] == 'type1'){ echo 'active'; }; ?>">
       <label for="mobile_index_slider_type1">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/header_slider_type1.jpg" title="" alt="" />
        <span><?php _e('Front cover', 'tcd-w'); ?></span>
        <input type="radio" id="mobile_index_slider_type1" name="dp_options[mobile_index_slider_type]" value="type1" <?php checked( $options['mobile_index_slider_type'], 'type1' ); ?> />
       </label>
      </li>
      <li class="index_slider_type2_button <?php if($options['mobile_index_slider_type'] == 'type2'){ echo 'active'; }; ?>">
       <label for="mobile_index_slider_type2">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/header_slider_type2.jpg" title="" alt="" />
        <span><?php _e('Article slider', 'tcd-w'); ?></span>
        <input type="radio" id="mobile_index_slider_type2" name="dp_options[mobile_index_slider_type]" value="type2" <?php checked( $options['mobile_index_slider_type'], 'type2' ); ?> />
       </label>
      </li>
      <li class="index_slider_type3_button <?php if($options['mobile_index_slider_type'] == 'type3'){ echo 'active'; }; ?>">
       <label for="mobile_index_slider_type3">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/header_slider_type3.jpg" title="" alt="" />
        <span><?php _e('Content slider', 'tcd-w'); ?></span>
        <input type="radio" id="mobile_index_slider_type3" name="dp_options[mobile_index_slider_type]" value="type3" <?php checked( $options['mobile_index_slider_type'], 'type3' ); ?> />
       </label>
      </li>
     </ul>

     <?php // ヘッダーコンテンツ タイプ１ --------------------------------------- ?>
     <div class="index_slider_type1_option" style="<?php if($options['mobile_index_slider_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <h4 class="theme_option_headline2"><?php _e('Front cover setting', 'tcd-w');  ?></h4>

      <div class="sub_box cf">
	      <h3 class="theme_option_subbox_headline"><?php _e('Content setting', 'tcd-w'); ?></h3>
        <div class="sub_box_content">

          <h4 class="theme_option_headline2"><?php _e( 'Logo image', 'tcd-w' ); ?></h4>

          <div class="image_box cf">
	          <div class="cf cf_media_field hide-if-no-js mobile_index_header_type1_logo">
		          <input type="hidden" value="<?php if($options['mobile_index_header_type1_logo']) { echo esc_attr( $options['mobile_index_header_type1_logo'] ); }; ?>" id="mobile_index_header_type1_logo" name="dp_options[mobile_index_header_type1_logo]" class="cf_media_id">
		          <div class="preview_field"><?php if($options['mobile_index_header_type1_logo']){ echo wp_get_attachment_image($options['mobile_index_header_type1_logo'], 'medium'); }; ?></div>
		          <div class="buttton_area">
		            <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
		            <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['mobile_index_header_type1_logo']){ echo 'hidden'; }; ?>">
		          </div>
	          </div>
          </div>
          <p><label><input name="dp_options[mobile_index_header_type1_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_header_type1_logo_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>

          <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
          <input class="full_width" type="text" name="dp_options[mobile_index_header_type1_catch]" value="<?php echo esc_attr($options['mobile_index_header_type1_catch']); ?>" />

          <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
          <textarea class="full_width" cols="50" rows="2" name="dp_options[mobile_index_header_type1_desc]"><?php echo esc_textarea(  $options['mobile_index_header_type1_desc'] ); ?></textarea>

          <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span>
              <div class="use_main_color">
                <input type="text" name="dp_options[mobile_index_header_type1_bg_color]" value="<?php echo esc_attr( $options['mobile_index_header_type1_bg_color'] ); ?>" data-default-color="#003042" class="c-color-picker">
              </div>
              <div class="use_main_color_checkbox">
                <label>
                  <input name="dp_options[mobile_index_header_type1_bg_color_use_sub]" type="checkbox" value="1" <?php checked( $options['mobile_index_header_type1_bg_color_use_sub'], 1 ); ?>>
                  <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
                </label>
              </div>
            </li>
            <li class="cf">
              <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_header_type1_bg_opacity]" value="<?php echo esc_attr( $options['mobile_index_header_type1_bg_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
                <p><?php _e('Please specify the number of 0 from 1. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
            </li>
          </ul>

      	</div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->


      <div class="sub_box cf">
	      <h3 class="theme_option_subbox_headline"><?php _e('Background setting', 'tcd-w'); ?></h3>
        <div class="sub_box_content">

          <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
          <div class="theme_option_message2">
            <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '550'); ?></p>
          </div>

          <div class="image_box cf">
            <div class="cf cf_media_field hide-if-no-js mobile_index_header_type1_bg_image">
              <input type="hidden" value="<?php if($options['mobile_index_header_type1_bg_image']) { echo esc_attr( $options['mobile_index_header_type1_bg_image'] ); }; ?>" id="mobile_index_header_type1_bg_image" name="dp_options[mobile_index_header_type1_bg_image]" class="cf_media_id">
              <div class="preview_field"><?php if($options['mobile_index_header_type1_bg_image']){ echo wp_get_attachment_image($options['mobile_index_header_type1_bg_image'], 'medium'); }; ?></div>
              <div class="buttton_area">
                <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
                <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['mobile_index_header_type1_bg_image']){ echo 'hidden'; }; ?>">
              </div>
            </div>
          </div>

          <h4 class="theme_option_headline2"><?php _e('Search form setting', 'tcd-w');  ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_header_type1_use_search_form]" type="checkbox" value="1" <?php checked( $options['mobile_index_header_type1_use_search_form'], 1 ); ?>><?php _e( 'Display the search form', 'tcd-w' ); ?></label></p>
          <div style="<?php if($options['mobile_index_header_type1_use_search_form'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

            <ul class="option_list">
              <li class="cf" style="padding-top:8px; border-top:1px dotted #ddd;">
                <span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
                <div class="use_main_color">
                  <input type="text" name="dp_options[mobile_index_header_type1_search_form_bg_color]" value="<?php echo esc_attr( $options['mobile_index_header_type1_search_form_bg_color'] ); ?>" data-default-color="#0093cb" class="c-color-picker">
                </div>
                <div class="use_main_color_checkbox">
                  <label>
                    <input name="dp_options[mobile_index_header_type1_search_form_bg_color_use_main]" type="checkbox" value="1" <?php checked( $options['mobile_index_header_type1_search_form_bg_color_use_main'], 1 ); ?>>
                    <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
                  </label>
                </div>
              </li>
              <li class="cf">
                <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_header_type1_search_form_bg_opacity]" value="<?php echo esc_attr( $options['mobile_index_header_type1_search_form_bg_opacity'] ); ?>" />
                <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
                  <p><?php _e('Please specify the number of 0 from 1. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
                </div>
              </li>
            </ul>

          </div>

        </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
     </div><?php // END ヘッダーコンテンツ タイプ１ --------------------------------------- ?>

     <?php // ヘッダーコンテンツ タイプ２ --------------------------------------- ?>
     <div class="index_slider_type2_option" style="<?php if($options['mobile_index_slider_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?> margin-bottom: -10px;">

      <h4 class="theme_option_headline2"><?php _e('Slider setting', 'tcd-w');  ?></h4>

      <div class="sub_box cf">
          <h3 class="theme_option_subbox_headline"><?php _e('Article slider setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

            <div class="theme_option_message2" style="margin-top:20px;">
              <p><?php printf(__('Display <a href="./edit.php?post_type=blog">%s</a> posts', 'tcd-w'), $blog_label); ?></p>
            </div>

            <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w'); ?></span>
              <select class="index_tab_post_list_type" name="dp_options[mobile_index_header_type2_post_type]">
              <option style="padding-right: 10px;" value="recent_post" <?php selected( $options['mobile_index_header_type2_post_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
              <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['mobile_index_header_type2_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post1', 'tcd-w'); ?></option>
              <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['mobile_index_header_type2_post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post2', 'tcd-w'); ?></option>
              </select>
            </li>
            <li class="cf post_order"><span class="label"><?php _e('Post order', 'tcd-w'); ?></span>
              <select name="dp_options[mobile_index_header_type2_post_order]">
              <option style="padding-right: 10px;" value="date" <?php selected('date', $options['mobile_index_header_type2_post_order']); ?>><?php _e('Post date', 'tcd-w'); ?></option>
              <option style="padding-right: 10px;" value="rand" <?php selected('rand', $options['mobile_index_header_type2_post_order']); ?>><?php _e('Random', 'tcd-w'); ?></option>
              </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_header_type2_post_num]">
              <?php for($i=1; $i<= 5; $i++): ?>
              <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['mobile_index_header_type2_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
              <?php endfor; ?>
              </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_header_type2_title_font_type]">
              <?php foreach ( $font_type_options as $option ) { ?>
              <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['mobile_index_header_type2_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
              <?php } ?>
              </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_header_type2_title_font_size]" value="<?php esc_attr_e( $options['mobile_index_header_type2_title_font_size'] ); ?>" /><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input name="dp_options[mobile_index_header_type2_show_date]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_header_type2_show_date'] ); ?> /></li>
            <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w');  ?></span><input name="dp_options[mobile_index_header_type2_show_category]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_header_type2_show_category'] ); ?> /></li>
          </ul>

        </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

     </div><?php // END ヘッダーコンテンツ タイプ２ --------------------------------------- ?>

     <?php // ヘッダーコンテンツ タイプ３ --------------------------------------- ?>
     <div class="index_slider_type3_option" style="<?php if($options['mobile_index_slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <h4 class="theme_option_headline2"><?php _e('Slider setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message">
      <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
     </div>

     <?php //繰り返しフィールド ----- ?>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[mobile_index_slider]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['mobile_index_slider'] ) :
              foreach ( $options['mobile_index_slider'] as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); echo esc_attr( $key+1 ); ?></h4>
        <div class="sub_box_content">

         <div class="sub_box cf" style="margin-top:20px;">
          <h3 class="theme_option_subbox_headline"><?php echo __('Slider setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <h4 class="theme_option_headline2"><?php _e('Slider type', 'tcd-w');  ?></h4>
           <ul class="design_radio_button">
            <?php foreach ( $item_type_options as $option ) { ?>
            <li class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>">
             <input type="radio" id="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> />
             <label for="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>"><?php echo $option['label']; ?></label>
            </li>
            <?php } ?>
           </ul>
           <?php // video ----------------------- ?>
           <div class="index_slider_video_area" style="<?php if($value['slider_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
             <p><?php _e( 'Register within 10 MB.', 'tcd-w' ); ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video">
             <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
             <div class="preview_field preview_field_video">
              <?php if($value['video']){ ?>
              <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
              <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
              <?php }; ?>
             </div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
              <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
             </div>
            </div>
           </div><!-- END .index_slider_video_area -->
           <?php // youtube ----------------------- ?>
           <div class="index_slider_youtube_area" style="<?php if($value['slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Youtube setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please enter Youtube URL.', 'tcd-w');  ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <input class="regular-text" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
           </div><!-- END .index_slider_youtube_area -->
           <?php // 背景画像 ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
           <div class="theme_option_message2">
            <div class="index_slider_video_image" style="<?php if($value['slider_type'] != 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
             <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
            </div>
            <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '530'); ?></p>
           </div>
           <div class="image_box cf">
            <div class="cf cf_media_field hide-if-no-js mobile_index_slider_image<?php echo esc_attr( $key ); ?>">
             <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="mobile_index_slider_image<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
             <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
              <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
             </div>
            </div>
           </div>
           <?php // オーバーレイ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
           <p class="displayment_checkbox"><label><input class="index_slider_use_overlay<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
           <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf">
              <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku index_slider_overlay_opacity<?php echo esc_attr( $key ); ?>" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
               <p><?php _e('It also has the effect of improving readability when setting text content.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

           <ul class="button_list cf">
            <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
           </ul>
          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         <div class="sub_box cf">
          <h3 class="theme_option_subbox_headline"><?php echo __('Text content setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <?php // コンテンツの設定 ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Content setting', 'tcd-w' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Content placement', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][contents_place]">
                <option style="padding-right: 10px;" value="type1" <?php selected( $value['contents_place'], 'type1' ); ?>><?php _e('Align left', 'tcd-w');  ?></option>
                <option style="padding-right: 10px;" value="type2" <?php selected( $value['contents_place'], 'type2' ); ?>><?php _e('Align center', 'tcd-w');  ?></option>
                <option style="padding-right: 10px;" value="type3" <?php selected( $value['contents_place'], 'type3' ); ?>><?php _e('Align right', 'tcd-w');  ?></option>
              </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][contents_color]" value="<?php echo esc_attr( $value['contents_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
           </ul>

           <?php // キャッチフレーズ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Catchphrase setting', 'tcd-w' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-w');  ?></span>
              <textarea class="full_width" cols="50" rows="2" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
            </li>
            <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
             <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
              <?php
                   foreach ( $font_type_options as $option ) {
                     if(strtoupper(get_locale()) == 'JA'){
                       $label = $option['label'];
                     } else {
                       $label = $option['label_en'];
                     }
              ?>
              <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo esc_html($label); ?></option>
              <?php } ?>
             </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <h4 class="theme_option_headline2"><?php _e( 'Description setting', 'tcd-w' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Description', 'tcd-w');  ?></span>
             <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
            </li>
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <?php // ボタン ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
           <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
           <div class="button_option_area" style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list button_option_area" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
             <li class="cf"><span class="label"><?php _e('Button type', 'tcd-w');  ?></span>
              <select class="button_type_option" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_type]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_type'], 'type1' ); ?>><?php _e('Normal button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_type'], 'type2' ); ?>><?php _e('Swipe animation button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation button', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Button shape', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_shape]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_shape'], 'type1' ); ?>><?php _e('Round corner', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_shape'], 'type2' ); ?>><?php _e('Square corner', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf button_type1_option">
              <span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
              <div class="use_main_color">
               <input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#00729f" class="c-color-picker">
              </div>
              <div class="use_main_color_checkbox">
               <label>
                <input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_use_main]" type="checkbox" value="1" <?php checked( $value['button_bg_color_use_main'], 1 ); ?>>
                <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
               </label>
              </div>
             </li>
             <li class="cf non_button_type1_option"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf">
              <span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span>
              <div class="use_main_color">
               <input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#00466d" class="c-color-picker">
              </div>
              <div class="use_main_color_checkbox">
               <label>
                <input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover_use_sub]" type="checkbox" value="1" <?php checked( $value['button_bg_color_hover_use_sub'], 1 ); ?>>
                <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
               </label>
              </div>
             </li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span>
              <div class="use_main_color">
               <input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#00466d" class="c-color-picker">
              </div>
              <div class="use_main_color_checkbox">
               <label>
                <input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover_use_sub]" type="checkbox" value="1" <?php checked( $value['button_border_color_hover_use_sub'], 1 ); ?>>
                <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
               </label>
              </div>
             </li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover_opacity]" value="<?php echo esc_attr( $value['button_border_color_hover_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

           <ul class="button_list cf">
            <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
           </ul>
          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         <ul class="button_list cf">
          <li class="delete-row" style="float:right; margin:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
             'slider_type' => 'type1',
             'image' => false,
             'video' => '',
             'youtube' => '',
             'contents_place' => 'type1',
             'contents_color' => '#FFFFFF',
             'catch' => '',
             'catch_font_type' => 'type2',
             'catch_font_size' => '20',
             'desc' => '',
             'desc_font_size' => '15',
             'show_button' => '',
             'button_type' => 'type1',
             'button_shape' => 'type2',
             'button_label' => '',
             'button_url' => '',
             'button_target' => '',
             'button_font_color' => '#ffffff',
             'button_font_color_hover' => '#ffffff',
             'button_bg_color' => '#000000',
             'button_bg_color_use_main' => '1',
             'button_bg_color_hover' => '#444444',
             'button_bg_color_hover_use_sub' => '1',
             'button_border_color' => '#ffffff',
             'button_border_color_opacity' => '1',
             'button_border_color_hover' => '#444444',
             'button_border_color_hover_use_sub' => 1,
             'button_border_color_hover_opacity' => '1',
             'use_overlay' => '',
             'overlay_color' => '#000000',
             'overlay_opacity' => '0.3',
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">

         <div class="sub_box cf" style="margin-top:20px;">
          <h3 class="theme_option_subbox_headline"><?php echo __('Slider setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <h4 class="theme_option_headline2"><?php _e('Slider type', 'tcd-w');  ?></h4>
           <ul class="design_radio_button">
            <?php foreach ( $item_type_options as $option ) { ?>
            <li class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>">
             <input type="radio" id="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> />
             <label for="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>"><?php echo $option['label']; ?></label>
            </li>
            <?php } ?>
           </ul>
           <?php // video ----------------------- ?>
           <div class="index_slider_video_area" style="<?php if($value['slider_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
             <p><?php _e( 'Register within 10 MB.', 'tcd-w' ); ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video">
             <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
             <div class="preview_field preview_field_video">
              <?php if($value['video']){ ?>
              <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
              <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
              <?php }; ?>
             </div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
              <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
             </div>
            </div>
           </div><!-- END .index_slider_video_area -->
           <?php // youtube ----------------------- ?>
           <div class="index_slider_youtube_area" style="<?php if($value['slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Youtube setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please enter Youtube URL.', 'tcd-w');  ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <input class="regular-text" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
           </div><!-- END .index_slider_youtube_area -->
           <?php // 背景画像 ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
           <div class="theme_option_message2">
            <div class="index_slider_video_image" style="<?php if($value['slider_type'] != 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
             <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
            </div>
            <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '530'); ?></p>
           </div>
           <div class="image_box cf">
            <div class="cf cf_media_field hide-if-no-js mobile_index_slider_image<?php echo esc_attr( $key ); ?>">
             <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="mobile_index_slider_image<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
             <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
              <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
             </div>
            </div>
              </div>
           <?php // オーバーレイ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
           <p class="displayment_checkbox"><label><input class="index_slider_use_overlay<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
           <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf">
              <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku index_slider_overlay_opacity<?php echo esc_attr( $key ); ?>" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
               <p><?php _e('It also has the effect of improving readability when setting text content.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

           <ul class="button_list cf">
            <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
           </ul>
          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         <div class="sub_box cf">
          <h3 class="theme_option_subbox_headline"><?php echo __('Text content setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <?php // コンテンツの設定 ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Content placement', 'tcd-w' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Content placement', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][contents_place]">
                <option style="padding-right: 10px;" value="type1" <?php selected( $value['contents_place'], 'type1' ); ?>><?php _e('Align left', 'tcd-w');  ?></option>
                <option style="padding-right: 10px;" value="type2" <?php selected( $value['contents_place'], 'type2' ); ?>><?php _e('Align center', 'tcd-w');  ?></option>
                <option style="padding-right: 10px;" value="type3" <?php selected( $value['contents_place'], 'type3' ); ?>><?php _e('Align right', 'tcd-w');  ?></option>
              </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][contents_color]" value="<?php echo esc_attr( $value['contents_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
           </ul>

           <?php // キャッチフレーズ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Catchphrase setting', 'tcd-w' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-w');  ?></span>
              <textarea class="full_width" cols="50" rows="2" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
            </li>
            <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
             <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
              <?php
                   foreach ( $font_type_options as $option ) {
                     if(strtoupper(get_locale()) == 'JA'){
                       $label = $option['label'];
                     } else {
                       $label = $option['label_en'];
                     }
              ?>
              <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo esc_html($label); ?></option>
              <?php } ?>
             </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <h4 class="theme_option_headline2"><?php _e( 'Description setting', 'tcd-w' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Description', 'tcd-w');  ?></span>
             <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
            </li>
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <?php // ボタン ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
           <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
           <div class="button_option_area" style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list button_option_area" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
             <li class="cf"><span class="label"><?php _e('Button type', 'tcd-w');  ?></span>
              <select class="button_type_option" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_type]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_type'], 'type1' ); ?>><?php _e('Normal button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_type'], 'type2' ); ?>><?php _e('Swipe animation button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation button', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Button shape', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_shape]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_shape'], 'type1' ); ?>><?php _e('Round corner', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_shape'], 'type2' ); ?>><?php _e('Square corner', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf button_type1_option">
              <span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
              <div class="use_main_color">
               <input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#00729f" class="c-color-picker">
              </div>
              <div class="use_main_color_checkbox">
               <label>
                <input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_use_main]" type="checkbox" value="1" <?php checked( $value['button_bg_color_use_main'], 1 ); ?>>
                <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
               </label>
              </div>
             </li>
             <li class="cf non_button_type1_option"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf">
              <span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span>
              <div class="use_main_color">
               <input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#00466d" class="c-color-picker">
              </div>
              <div class="use_main_color_checkbox">
               <label>
                <input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover_use_sub]" type="checkbox" value="1" <?php checked( $value['button_bg_color_hover_use_sub'], 1 ); ?>>
                <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
               </label>
              </div>
             </li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span>
              <div class="use_main_color">
               <input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#00466d" class="c-color-picker">
              </div>
              <div class="use_main_color_checkbox">
               <label>
                <input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover_use_sub]" type="checkbox" value="1" <?php checked( $value['button_border_color_hover_use_sub'], 1 ); ?>>
                <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
               </label>
              </div>
             </li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover_opacity]" value="<?php echo esc_attr( $value['button_border_color_hover_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

           <ul class="button_list cf">
            <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
           </ul>
          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         <ul class="button_list cf">
          <li class="delete-row" style="float:right; margin:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo htmlspecialchars( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>

     </div><?php // ヘッダーコンテンツ タイプ３ --------------------------------------- ?>
    
     <?php // ヘッダーコンテンツ 共通設定 --------------------------------------- ?>
     <div class="index_slider_common_option" style="<?php if($options['mobile_index_slider_type'] == 'type1') { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">

     <div class="sub_box cf" style="margin-top:20px;">
      <h3 class="theme_option_subbox_headline"><?php echo __('Slider common setting', 'tcd-w'); ?></h3>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e('Animation setting', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you use this option, the animation of all elements except the background image will be stopped and the text content can be displayed instantly.', 'tcd-w');  ?></p>
       </div>
       <p><label><input class="stop_index_slider_animation" name="dp_options[mobile_stop_index_slider_animation]" type="checkbox" value="1" <?php checked( $options['mobile_stop_index_slider_animation'], 1 ); ?>><?php _e( 'Stop all animation in header content.', 'tcd-w' ); ?></label></p>

       <?php // スピードの設定 ---------- ?>
       <h4 class="theme_option_headline2"><?php _e('Slider speed setting', 'tcd-w');  ?></h4>
       <select class="index_slider_time" name="dp_options[mobile_index_slider_time]">
        <?php
             $i = 1;
             foreach ( $time_options as $option ):
               if( $i >= 3 && $i <= 15 ){
        ?>
        <option <?php if($i < 5){ echo 'class="no_animation"'; }; ?>style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['mobile_index_slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
        <?php
               }
               $i++;
            endforeach;
        ?>
       </select>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     </div><?php // ヘッダーコンテンツ 共通設定 --------------------------------------- ?>

     </div><!-- END #show_index_slider -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // ボックスコンテンツの設定 ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
	  <h3 class="theme_option_headline"><?php _e('Box contents setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <p class="displayment_checkbox"><label><input name="dp_options[mobile_show_index_box_content]" type="checkbox" value="1" <?php checked( $options['mobile_show_index_box_content'], 1 ); ?>><?php _e( 'Display box contents', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['mobile_show_index_box_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e('Common setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_box_content_font_size]" value="<?php esc_attr_e( $options['mobile_index_box_content_font_size'] ); ?>" /><span>px</span></li>
      </ul>

    <?php // ボックスコンテンツの設定 ----------

        for ( $i = 1; $i <= 2; $i++ ) {

    ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf(__('Box content setting%s', 'tcd-w'), $i); ?></h3>
      <div class="sub_box_content">
          
        <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-w'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[mobile_index_box_content_headline<?php echo $i ?>]"><?php echo esc_textarea(  $options['mobile_index_box_content_headline'.$i] ); ?></textarea></li>
          <li class="cf"><span class="label"><?php _e('Description', 'tcd-w'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_index_box_content_desc<?php echo $i ?>]"><?php echo esc_textarea(  $options['mobile_index_box_content_desc'.$i] ); ?></textarea></li>
          <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mobile_index_box_content_url<?php echo $i ?>]" value="<?php esc_attr_e( $options['mobile_index_box_content_url'.$i] ); ?>" style="max-width:25em;" /></li>
        </ul>

        <h4 class="theme_option_headline2"><?php _e( 'Icon type', 'tcd-w' ); ?></h4>
        <ul class="design_radio_button">
          <li class="icon_type1_button">
            <input type="radio" id="mobile_icon_type1_<?php echo $i ?>" name="dp_options[mobile_index_box_content_icon_type<?php echo $i ?>]" value="type1" <?php checked( $options['mobile_index_box_content_icon_type'.$i], 'type1' ); ?> />
            <label class="icon_type1_button<?php echo $i ?>" for="mobile_icon_type1_<?php echo $i ?>"><?php _e( 'Display the image', 'tcd-w' ); ?></label>
          </li>
          <li class="icon_type1_button">
            <input type="radio" id="mobile_icon_type2_<?php echo $i ?>" name="dp_options[mobile_index_box_content_icon_type<?php echo $i ?>]" value="type2" <?php checked( $options['mobile_index_box_content_icon_type'.$i], 'type2' ); ?> />
            <label class="icon_type2_button<?php echo $i ?>" for="mobile_icon_type2_<?php echo $i ?>"><?php _e( 'Use icon fonts', 'tcd-w' ); ?></label>
          </li>
        </ul>

        <div class="icon_type1_wrap<?php echo $i ?>" style="<?php if($options['mobile_index_box_content_icon_type'.$i] == 'type1') { echo 'display:block'; } else { echo 'display:none;'; }; ?>">

          <div class="theme_option_message2">
            <p>
              <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '50', '50'); ?><br />
              <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
            </p>
          </div>
          <div class="image_box cf">
            <div class="cf cf_media_field hide-if-no-js mobile_index_box_content_image<?php echo $i ?>">
              <input type="hidden" value="<?php echo esc_attr( $options['mobile_index_box_content_image'.$i] ); ?>" id="mobile_index_box_content_image<?php echo $i ?>" name="dp_options[mobile_index_box_content_image<?php echo $i ?>]" class="cf_media_id">
              <div class="preview_field"><?php if($options['mobile_index_box_content_image'.$i]){ echo wp_get_attachment_image($options['mobile_index_box_content_image'.$i], 'medium'); }; ?></div>
                <div class="buttton_area">
                  <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
                  <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['mobile_index_box_content_image'.$i]){ echo 'hidden'; }; ?>">
                </div>
              </div>
            </div>
            <p><label><input name="dp_options[mobile_index_box_content_image_retina<?php echo $i ?>]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_box_content_image_retina'.$i] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
          </div>

          <div class="icon_type2_wrap<?php echo $i ?>" style="<?php if($options['mobile_index_box_content_icon_type'.$i] == 'type2') { echo 'display:block'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list">
              <li class="cf" style="padding-top:8px; border-top: 1px dotted #ddd;"><span class="label"><?php _e('Icon color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_box_content_icon_color<?php echo $i ?>]" value="<?php echo esc_attr( $options['mobile_index_box_content_icon_color'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
              <li class="cf"><span class="label"><?php _e('Icon size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_box_content_icon_size<?php echo $i ?>]" value="<?php esc_attr_e( $options['mobile_index_box_content_icon_size'.$i] ); ?>" /><span>px</span></li>
              <li class="cf"><span class="label"><?php _e('Icon', 'tcd-w'); ?></span>
                <ul class="box_content_icon_type cf">
                <?php foreach( $box_content_icon_options as $option ) : ?>
                <li><label><input type="radio" name="dp_options[mobile_index_box_content_icon<?php echo $i ?>]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $options['mobile_index_box_content_icon'.$i], $option['value'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
                <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </div>

          <ul class="button_list cf">
            <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
          </ul>
        </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php

          } // END box content
      
      ?>
      </div><!-- END .displayment_checkbox -->

	    <ul class="button_list cf">
	      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // ニュースティッカーの設定 ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
	  <h3 class="theme_option_headline"><?php _e('News ticker setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

      <p class="displayment_checkbox"><label><input name="dp_options[mobile_show_index_news]" type="checkbox" value="1" <?php checked( $options['mobile_show_index_news'], 1 ); ?>><?php _e( 'Display news ticker', 'tcd-w' ); ?></label></p>
      <div style="<?php if($options['mobile_show_index_news'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w'); ?></span>
            <select name="dp_options[mobile_index_news_post_type]">
              <option style="padding-right: 10px;" value="news" <?php selected( $options['mobile_index_news_post_type'], 'news' ); ?>><?php echo esc_html($news_label); ?></option>
              <option style="padding-right: 10px;" value="blog" <?php selected( $options['mobile_index_news_post_type'], 'blog' ); ?>><?php echo esc_html($blog_label); ?></option>
            </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Display order of articles', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_news_post_order]">
              <option value="date" <?php selected($options['mobile_index_news_post_order'], 'date'); ?>><?php _e('Date', 'tcd-w'); ?></option>
              <option value="rand" <?php selected($options['mobile_index_news_post_order'], 'rand'); ?>><?php _e('Random', 'tcd-w'); ?></option>
            </select>
          </li>
          <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span>
            <input class="regular-text" type="text" name="dp_options[mobile_index_news_label]" value="<?php echo esc_attr($options['mobile_index_news_label']); ?>" />
          </li>
        </ul>
      </div><!-- END .displayment_checkbox -->

      <ul class="button_list cf">
	      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active <?php if($options['mobile_index_content_type'] == 'type2') { echo 'show_arrow'; }; ?>">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button" style="margin-bottom:25px;">
      <li class="mobile_index_content_type1_button">
       <input type="radio" id="mobile_index_content_type1" name="dp_options[mobile_index_content_type]" value="type1" <?php checked( $options['mobile_index_content_type'], 'type1' ); ?> />
       <label for="mobile_index_content_type1"><?php _e('Display same content builder in smartphone', 'tcd-w');  ?></label>
      </li>
      <li class="mobile_index_content_type2_button">
       <input type="radio" id="mobile_index_content_type2" name="dp_options[mobile_index_content_type]" value="type2" <?php checked( $options['mobile_index_content_type'], 'type2' ); ?> />
       <label for="mobile_index_content_type2"><?php _e('Display diffrent content builder in smartphone', 'tcd-w');  ?></label>
      </li>
      <li class="mobile_index_content_type3_button">
       <input type="radio" id="mobile_index_content_type3" name="dp_options[mobile_index_content_type]" value="type3" <?php checked( $options['mobile_index_content_type'], 'type3' ); ?> />
       <label for="mobile_index_content_type3"><?php _e('Use page content instead of content builder', 'tcd-w');  ?></label>
      </li>
     </ul>

     <ul class="button_list cf mobile_index_content_type1_option" style="<?php if($options['mobile_index_content_type'] == 'type2') { echo 'display:none'; }else{ echo 'display:block'; }; ?>">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
     </ul>

     <?php
          $front_page_id = get_option('page_on_front');
     ?>
     <div class="mobile_index_content_type3_option" style="<?php if($options['mobile_index_content_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <?php if($front_page_id){ ?>
       <p><?php printf(__('Please set content from <a href="post.php?post=%s&action=edit" target="_blank">Front page edit screen</a>.', 'tcd-w'), $front_page_id); ?></p>
       <?php }else{; ?>
       <p><?php _e('It seems that the fixed page for the top page has not been set yet.', 'tcd-w'); ?>
          <?php _e('Please refer to the <a href="https://dl.tcd-theme.com/biz001/display-setting/ ">manual</a> to create and configure.', 'tcd-w'); ?></p>
       <?php }; ?>
      </div>
      <ul class="button_list cf">
       <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      </ul>
     </div>

     <div class="mobile_index_content_type2_option" style="<?php if($options['mobile_index_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <div class="theme_option_message no_arrow">
      <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
      <br>
      <p><?php _e('For headline and description that do not have font type or font size options, please adjust all at once from the font setting section of the basic settings ', 'tcd-w');  ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'Content image', 'tcd-w' ); ?></h4>
     <ul class="design_button_list cf">
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_category_list.jpg" title="<?php _e( 'Category list', 'tcd-w' ); ?>"><?php _e( 'Category list', 'tcd-w' ); ?></a></li>
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_blog_carousel.jpg" title="<?php printf(__('%s carousel', 'tcd-w'), $blog_label); ?>"><?php printf(__('%s carousel', 'tcd-w'), $blog_label); ?></a></li>
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_tag_cloud.jpg" title="<?php _e('Tag cloud', 'tcd-w'); ?>"><?php _e('Tag cloud', 'tcd-w'); ?></a></li>
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_column_content.jpg" title="<?php _e('2 column content', 'tcd-w'); ?>"><?php _e('2 column content', 'tcd-w'); ?></a></li>
     </ul>

     </div>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <div class="contents_builder_wrap mobile_index_content_type2_option" style="<?php if($options['mobile_index_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

    <div class="contents_builder">
     <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
     <?php
          if (!empty($options['mobile_contents_builder'])) {
            foreach($options['mobile_contents_builder'] as $key => $content) :
              $cb_index = 'cb_'.$key.'_'.mt_rand(0,999999);
     ?>
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>" />
        <?php mobile_the_cb_content_select($cb_index, $content['cb_content_select']); ?>
        <?php if (!empty($content['cb_content_select'])) mobile_the_cb_content_setting($cb_index, $content['cb_content_select'], $content); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          endforeach;
         };
     ?>
    </div><!-- END .contents_builder -->
    <ul class="button_list cf cb_add_row_buttton_area">
     <li><input type="button" value="<?php echo __( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
     <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    </ul>

    <?php // コンテンツビルダー追加用 非表示 ?>
    <div class="contents_builder-clone hidden">
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="cb_cloneindex" />
        <?php mobile_the_cb_content_select('cb_cloneindex'); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          mobile_the_cb_content_setting('cb_cloneindex', 'column_content');
          mobile_the_cb_content_setting('cb_cloneindex', 'tag_cloud');
          mobile_the_cb_content_setting('cb_cloneindex', 'blog_carousel');
          mobile_the_cb_content_setting('cb_cloneindex', 'category_list');
          mobile_the_cb_content_setting('cb_cloneindex', 'free_space');
     ?>
    </div><!-- END .contents_builder-clone -->

   </div><!-- END .contents_builder_wrap -->
   <?php // コンテンツビルダーここまで ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>


</div><!-- END .tab-content -->

<?php
} // END add_front_page_mobile_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_theme_options_validate( $input ) {

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $slider_animation_options, $box_content_icon_options;

  // ニュースティッカー
  $input['mobile_show_index_news'] = ! empty( $input['mobile_show_index_news'] ) ? 1 : 0;
  $input['mobile_index_news_post_type'] = wp_kses_post( $input['mobile_index_news_post_type'] );
  $input['mobile_index_news_post_order'] = wp_filter_nohtml_kses( $input['mobile_index_news_post_order'] );
  $input['mobile_index_news_label'] = wp_filter_nohtml_kses( $input['mobile_index_news_label'] );

  // ボックスコンテンツ
  $input['mobile_show_index_box_content'] = ! empty( $input['mobile_show_index_box_content'] ) ? 1 : 0;
  $input['mobile_index_box_content_font_size'] = wp_filter_nohtml_kses( $input['mobile_index_box_content_font_size'] );
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['mobile_index_box_content_headline'.$i] = wp_filter_nohtml_kses( $input['mobile_index_box_content_headline'.$i] );
    $input['mobile_index_box_content_icon_type'.$i] = wp_filter_nohtml_kses( $input['mobile_index_box_content_icon_type'.$i] );
    $input['mobile_index_box_content_image'.$i] = wp_filter_nohtml_kses( $input['mobile_index_box_content_image'.$i] );
    $input['mobile_index_box_content_desc'.$i] = wp_filter_nohtml_kses( $input['mobile_index_box_content_desc'.$i] );
    $input['mobile_index_box_content_url'.$i] = wp_filter_nohtml_kses( $input['mobile_index_box_content_url'.$i] );
    $input['mobile_index_box_content_image_retina'.$i] = ! empty( $input['mobile_index_box_content_image_retina'.$i] ) ? 1 : 0;
    if ( ! isset( $input['mobile_index_box_content_icon'.$i] ) )
    $input['mobile_index_box_content_icon'.$i] = null;
    if ( ! array_key_exists( $input['mobile_index_box_content_icon'.$i], $box_content_icon_options ) )
    $input['mobile_index_box_content_icon'.$i] = null;
    $input['mobile_index_box_content_icon_color'.$i] = sanitize_hex_color( $input['mobile_index_box_content_icon_color'.$i] );
    $input['mobile_index_box_content_icon_size'.$i] = wp_filter_nohtml_kses( $input['mobile_index_box_content_icon_size'.$i] );
  }

  // スライダーの基本設定
  $input['mobile_show_index_slider'] = wp_filter_nohtml_kses( $input['mobile_show_index_slider'] );
  if ( ! isset( $value['mobile_index_slider_time'] ) )
    $value['mobile_index_slider_time'] = null;
  if ( ! array_key_exists( $value['mobile_index_slider_time'], $time_options ) )
    $value['mobile_index_slider_time'] = null;
  $input['mobile_stop_index_slider_animation'] = ! empty( $input['mobile_stop_index_slider_animation'] ) ? 1 : 0;

  $input['mobile_index_slider_type'] = wp_filter_nohtml_kses( $input['mobile_index_slider_type'] );

    // タイプ 1
  $input['mobile_index_header_type1_logo'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_logo'] );
  $input['mobile_index_header_type1_catch'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_catch'] );
  $input['mobile_index_header_type1_desc'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_desc'] );
  $input['mobile_index_header_type1_bg_color'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_bg_color'] );
  $input['mobile_index_header_type1_bg_color_use_sub'] = ! empty( $input['mobile_index_header_type1_bg_color_use_sub'] ) ? 1 : 0;
  $input['mobile_index_header_type1_bg_opacity'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_bg_opacity'] );

  $input['mobile_index_header_type1_use_search_form'] = ! empty( $input['mobile_index_header_type1_use_search_form'] ) ? 1 : 0;
  $input['mobile_index_header_type1_search_form_bg_color'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_search_form_bg_color'] );
  $input['mobile_index_header_type1_search_form_bg_color_use_main'] = ! empty( $input['mobile_index_header_type1_search_form_bg_color_use_main'] ) ? 1 : 0;
  $input['mobile_index_header_type1_search_form_bg_opacity'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_search_form_bg_opacity'] );

  $input['mobile_index_header_type1_bg_image'] = wp_filter_nohtml_kses( $input['mobile_index_header_type1_bg_image'] );


   // タイプ2
  $input['mobile_index_header_type2_post_type'] = wp_filter_nohtml_kses( $input['mobile_index_header_type2_post_type'] );
  $input['mobile_index_header_type2_post_order'] = wp_filter_nohtml_kses( $input['mobile_index_header_type2_post_order'] );
  $input['mobile_index_header_type2_post_num'] = wp_filter_nohtml_kses( $input['mobile_index_header_type2_post_num'] );
  $input['mobile_index_header_type2_show_date'] = ! empty( $input['mobile_index_header_type2_show_date'] ) ? 1 : 0;
  $input['mobile_index_header_type2_show_category'] = ! empty( $input['mobile_index_header_type2_show_category'] ) ? 1 : 0;
  $input['mobile_index_header_type2_title_font_size'] = wp_filter_nohtml_kses( $input['mobile_index_header_type2_title_font_size'] );
  if ( ! isset( $value['mobile_index_header_type2_title_font_type'] ) )
    $value['mobile_index_header_type2_title_font_type'] = null;
  if ( ! array_key_exists( $value['mobile_index_header_type2_title_font_type'], $font_type_options ) )
    $value['mobile_index_header_type2_title_font_type'] = null;

  //スライダーの設定
  $index_slider = array();
  if ( isset( $input['mobile_index_slider'] ) && is_array( $input['mobile_index_slider'] ) ) {
    foreach ( $input['mobile_index_slider'] as $key => $value ) {
      $index_slider[] = array(
        'slider_type' => ( isset( $input['mobile_index_slider'][$key]['slider_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['slider_type'], $item_type_options ) ) ? $input['mobile_index_slider'][$key]['slider_type'] : 'type1',
        'image' => isset( $input['mobile_index_slider'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['image'] ) : '',
        'video' => isset( $input['mobile_index_slider'][$key]['video'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['video'] ) : '',
        'youtube' => isset( $input['mobile_index_slider'][$key]['youtube'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['youtube'] ) : '',
        'contents_place' => isset( $input['mobile_index_slider'][$key]['contents_place'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['contents_place'] ) : 'type1',
        'contents_color' => isset( $input['mobile_index_slider'][$key]['contents_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['contents_color'] ) : '#FFFFFF',
        'catch' => isset( $input['mobile_index_slider'][$key]['catch'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch'] ) : '',
        'catch_font_type' => ( isset( $input['mobile_index_slider'][$key]['catch_font_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['catch_font_type'], $font_type_options ) ) ? $input['mobile_index_slider'][$key]['catch_font_type'] : 'type1',
        'catch_font_size' => isset( $input['mobile_index_slider'][$key]['catch_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_font_size'] ) : '30',
        'desc' => isset( $input['mobile_index_slider'][$key]['desc'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc'] ) : '',
        'desc_font_size' => isset( $input['mobile_index_slider'][$key]['desc_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc_font_size'] ) : '20',
        'show_button' => ! empty( $input['mobile_index_slider'][$key]['show_button'] ) ? 1 : 0,
        'button_label' => isset( $input['mobile_index_slider'][$key]['button_label'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_label'] ) : '',
        'button_type' => isset( $input['mobile_index_slider'][$key]['button_type'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_type'] ) : 'type1',
        'button_shape' => isset( $input['mobile_index_slider'][$key]['button_shape'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_shape'] ) : 'type1',
        'button_url' => isset( $input['mobile_index_slider'][$key]['button_url'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_url'] ) : '',
        'button_target' => ! empty( $input['mobile_index_slider'][$key]['button_target'] ) ? 1 : 0,
        'button_font_color' => isset( $input['mobile_index_slider'][$key]['button_font_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_font_color'] ) : '#ffffff',
        'button_font_color_hover' => isset( $input['mobile_index_slider'][$key]['button_font_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_font_color_hover'] ) : '#ffffff',
        'button_bg_color' => isset( $input['mobile_index_slider'][$key]['button_bg_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_bg_color'] ) : '#00729f',
        'button_bg_color_use_main' => ! empty( $input['mobile_index_slider'][$key]['button_bg_color_use_main'] ) ? 1 : 0,
        'button_bg_color_hover' => isset( $input['mobile_index_slider'][$key]['button_bg_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_bg_color_hover'] ) : '#00466d',
        'button_bg_color_hover_use_sub' => ! empty( $input['mobile_index_slider'][$key]['button_bg_color_hover_use_sub'] ) ? 1 : 0,
        'button_border_color' => isset( $input['mobile_index_slider'][$key]['button_border_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color'] ) : '#ffffff',
        'button_border_color_opacity' => isset( $input['mobile_index_slider'][$key]['button_border_color_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_opacity'] ) : '1',
        'button_border_color_hover' => isset( $input['mobile_index_slider'][$key]['button_border_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_hover'] ) : '#00466d',
        'button_border_color_hover_opacity' => isset( $input['mobile_index_slider'][$key]['button_border_color_hover_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_hover_opacity'] ) : '1',
        'button_border_color_hover_use_sub' => ! empty( $input['mobile_index_slider'][$key]['button_border_color_hover_use_sub'] ) ? 1 : 0,
        'use_overlay' => ! empty( $input['mobile_index_slider'][$key]['use_overlay'] ) ? 1 : 0,
        'overlay_color' => isset( $input['mobile_index_slider'][$key]['overlay_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_color'] ) : '#000000',
        'overlay_opacity' => isset( $input['mobile_index_slider'][$key]['overlay_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_opacity'] ) : '0.3',
      );
    }
  };
  $input['mobile_index_slider'] = $index_slider;


  // コンテンツビルダーの代わりに、固定ページのコンテンツを使う
  $input['mobile_index_content_type'] = wp_filter_nohtml_kses( $input['mobile_index_content_type'] );


  // コンテンツビルダー -----------------------------------------------------------------------------
  if (!empty($input['mobile_contents_builder'])) {

    $input_cb = $input['mobile_contents_builder'];
    $input['mobile_contents_builder'] = array();

    foreach($input_cb as $key => $value) {

      // クローン用はスルー
      //if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'))) continue;
      if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'), true)) continue;

       // カテゴリー一覧 -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'category_list') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $cat_args = array( 'child_of' => 0, 'parent' => 0, 'orderby' => 'term_order', 'taxonomy' => 'category' );
        $cats = get_categories( $cat_args );
        foreach( $cats as $cat ){
          $cat_id = $cat->term_id;
          $value['category'.$cat_id] = ! empty( $value['category'.$cat_id] ) ? 1 : 0;
        }

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );

        $value['show_button'] = ! empty( $value['show_button'] ) ? 1 : 0;
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_target'] = ! empty( $value['button_target'] ) ? 1 : 0;


      // ブログカルーセル -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'blog_carousel') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['post_type'] = wp_filter_nohtml_kses( $value['post_type'] );
        $value['post_num_mobile'] = wp_filter_nohtml_kses( $value['post_num_mobile'] );

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );
        $value['show_category'] = ! empty( $value['show_category'] ) ? 1 : 0;
        $value['show_date'] = ! empty( $value['show_date'] ) ? 1 : 0;

        $value['show_button'] = ! empty( $value['show_button'] ) ? 1 : 0;
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_target'] = ! empty( $value['button_target'] ) ? 1 : 0;

      // タグクラウド -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'tag_cloud') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
        $post_tags = get_tags($tag_args);
        foreach( $post_tags as $tag ){
          $tag_id = $tag->term_id;
          $value['tag'.$tag_id] = ! empty( $value['tag'.$tag_id] ) ? 1 : 0;
        }

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );

        $value['bg_color'] = wp_filter_nohtml_kses( $value['bg_color'] );
        $value['bg_color_use_sub'] = ! empty( $value['bg_color_use_sub'] ) ? 1 : 0;
        $value['hover_bg_color'] = wp_filter_nohtml_kses( $value['hover_bg_color'] );
        $value['hover_bg_color_use_main'] = ! empty( $value['hover_bg_color_use_main'] ) ? 1 : 0;


      // 2カラムコンテンツ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'column_content') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['item_title_font_size'] = wp_filter_nohtml_kses( $value['item_title_font_size'] );

        $value['item_list'] = $value['item_list'];



      // フリースペース -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'free_space') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        if ( ! isset( $value['free_space'] )) {
          $value['free_space'] = null;
        } else {
          $value['free_space'] = $value['free_space'];
        }

        $value['content_width'] = wp_filter_nohtml_kses( $value['content_width'] );
        $value['content_bg_color'] = wp_filter_nohtml_kses( $value['content_bg_color'] );
        $value['margin_top'] = wp_filter_nohtml_kses( $value['margin_top'] );
        $value['margin_bottom'] = wp_filter_nohtml_kses( $value['margin_bottom'] );

      }

      $input['mobile_contents_builder'][] = $value;

    }

  } //コンテンツビルダーここまで -----------------------------------------------------------------------

  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ選択プルダウン　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_select($cb_index = 'cb_cloneindex', $selected = null) {

  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

  $cb_content_select = array(
    'category_list' => __('Category list', 'tcd-w'),
    'blog_carousel' => sprintf(__('%s carousel', 'tcd-w'), $blog_label),
    'tag_cloud' => __('Tag cloud', 'tcd-w'),
    'column_content' => __('2 column content', 'tcd-w'),
    'free_space' => __('Free space', 'tcd-w')
  );

  if ($selected && isset($cb_content_select[$selected])) {
    $add_class = ' hidden';
  } else {
    $add_class = '';
  }

  $out = '<select name="dp_options[mobile_contents_builder]['.esc_attr($cb_index).'][cb_content_select]" class="cb_content_select'.$add_class.'">';
  $out .= '<option value="" style="padding-right: 10px;">'.__("Choose the content", "tcd-w").'</option>';

  foreach($cb_content_select as $key => $value) {
    $attr = '';
    if ($key == $selected) {
      $attr = ' selected="selected"';
    }
    $out .= '<option value="'.esc_attr($key).'"'.$attr.' style="padding-right: 10px;">'.esc_html($value).'</option>';
  }

  $out .= '</select>';

  echo $out; 

}


/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_setting($cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array()) {

  global $content_direction_options, $font_type_options, $content_width_options;
  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div class="cb_content_wrap cf <?php echo esc_attr($cb_content_select); ?>">

<?php
     // カテゴリー一覧　-------------------------------------------------------------
     if ($cb_content_select == 'category_list') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['content_bg_color'])) { $value['content_bg_color'] = '#FFFFFF'; }
       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       $cat_args = array( 'child_of' => 0, 'parent' => 0, 'orderby' => 'term_order', 'taxonomy' => 'category' );
       $cats = get_categories( $cat_args );
       foreach( $cats as $cat ){
         $cat_id = $cat->term_id;
         if (!isset($value['category'.$cat_id])) { $value['category'.$cat_id] = 1; }
       }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '20'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_target'])) { $value['button_target'] = ''; }
?>

  <h3 class="cb_content_headline">
    <?php _e('Category list', 'tcd-w'); ?>
    <span><?php echo $value['catch']; ?></span>
  </h3>
  <div class="cb_content">

   <p><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display category list', 'tcd-w'); ?></label></p>
   <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w');  ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_bg_color]" value="<?php echo esc_attr( $value['content_bg_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
   </ul>

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php echo __('Header content setting', 'tcd-w'); ?></h3>
    <div class="sub_box_content">

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php _e('Category list setting', 'tcd-w'); ?></h3>
    <div class="sub_box_content">

     <h4 class="theme_option_headline2"><?php _e('Categories to display', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('The categories you set will be reflected here.</br>Click on the category you want to hide and change it to gray.</br>The blue categories will appear on your site.', 'tcd-w'); ?></p>
     </div>
     <?php
        $cat_args = array( 'type' => 'post','child_of' => 0,'parent' => 0,'orderby' => 'term_order','taxonomy' => 'category' );
        $cats = get_categories( $cat_args );
        if ( $cats && ! is_wp_error( $cats ) ) {
     ?>
     <ul class="category_check_list">
      <?php 
        foreach( $cats as $cat ):
          $cat_id   = $cat->term_id;
          $cat_name = $cat->cat_name;
      ?>
      <li>
        <label>
          <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][category<?php echo $cat_id; ?>]" type="checkbox" value="1" <?php checked( $value['category'.$cat_id], 1 ); ?> />
          <span><?php echo $cat_name ?></span>
        </label>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php } ?>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('This button is for archive page.', 'tcd-w');  ?></p>
    <p><?php _e('You can set design of button from basic setting menu button option section.', 'tcd-w');  ?></p>
   </div>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div class="button_option_area" style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
    </ul>
   </div>


    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->


<?php
     // ブログカルーセル　-------------------------------------------------------------
     } elseif ($cb_content_select == 'blog_carousel') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }
       if (!isset($value['content_bg_color'])) { $value['content_bg_color'] = '#F4F4F4'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }
      
       if (!isset($value['post_type'])) { $value['post_type'] = 'recent_post'; }
       if (!isset($value['post_num_mobile'])) { $value['post_num_mobile'] = '3'; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '18'; }

       if (!isset($value['show_category'])) { $value['show_category'] = 1; }
       if (!isset($value['show_date'])) { $value['show_date'] = 1; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_target'])) { $value['button_target'] = ''; }
?>

  <h3 class="cb_content_headline">
    <?php printf(__('%s carousel', 'tcd-w'), $blog_label); ?>
    <span><?php echo $value['catch']; ?></span>
  </h3>
  <div class="cb_content">

   <p><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php printf(__('Display %s carousel', 'tcd-w'), $blog_label); ?></label></p>
   <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w');  ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_bg_color]" value="<?php echo esc_attr( $value['content_bg_color'] ); ?>" data-default-color="#F4F4F4" class="c-color-picker"></li>
   </ul>

   <div class="theme_option_message2">
    <p><?php printf(__('Displays the content created with the custom post type <a target="_blank" href="./edit.php?post_type=%s">%s</a>. ', 'tcd-w'), 'blog', $blog_label); ?></br>
       <?php _e('On smartphones, the articles will be displayed in a vertical line with the specified number of articles.', 'tcd-w'); ?></p>
   </div>

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php echo __('Header content setting', 'tcd-w'); ?></h3>
    <div class="sub_box_content">

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php printf(__('%s carousel setting', 'tcd-w'), $blog_label); ?></h3>
    <div class="sub_box_content">

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w'); ?></span>
      <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type]">
        <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post1', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $value['post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post2', 'tcd-w'); ?></option>
      </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num_mobile]">
      <?php for($post_num=2; $post_num<= 5; $post_num++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($post_num); ?>" <?php selected( $value['post_num_mobile'], $post_num ); ?>><?php echo esc_html($post_num); ?></option>
      <?php endfor; ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w');  ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_category]" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?> /></li>
    <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?> /></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('This button is for archive page.', 'tcd-w');  ?></p>
    <p><?php _e('You can set design of button from basic setting menu button option section.', 'tcd-w');  ?></p>
   </div>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div class="button_option_area" style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
    </ul>
   </div>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->


<?php
     // タグクラウド　-------------------------------------------------------------
     } elseif ($cb_content_select == 'tag_cloud') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }
       if (!isset($value['content_bg_color'])) { $value['content_bg_color'] = '#FFFFFF'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
       $post_tags = get_tags($tag_args);
       foreach( $post_tags as $tag ){
         $tag_id = $tag->term_id;
         if (!isset($value['tag'.$tag_id])) { $value['tag'.$tag_id] = 1; }
       }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '12'; }

       if (!isset($value['bg_color'])) { $value['bg_color'] = '#000000'; }
       if (!isset($value['bg_color_use_sub'])) { $value['bg_color_use_sub'] = 1; }
       if (!isset($value['hover_bg_color'])) { $value['hover_bg_color'] = '#444444'; }
       if (!isset($value['hover_bg_color_use_main'])) { $value['hover_bg_color_use_main'] = 1; }

?>

  <h3 class="cb_content_headline">
    <?php _e('Tag cloud', 'tcd-w'); ?>
    <span><?php echo $value['catch']; ?></span>
  </h3>
  <div class="cb_content">

   <p><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display tag cloud', 'tcd-w'); ?></label></p>
   <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w');  ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_bg_color]" value="<?php echo esc_attr( $value['content_bg_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
   </ul>

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php echo __('Header content setting', 'tcd-w'); ?></h3>
    <div class="sub_box_content">

    <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
    <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>

    <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
    <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php _e('Tag cloud setting', 'tcd-w'); ?></h3>
    <div class="sub_box_content">

    <h4 class="theme_option_headline2"><?php _e('Tags to display', 'tcd-w');  ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('The tags you set will be reflected here.</br>Click on the tag you want to hide and change it to gray.</br>The blue tags will appear on your site.', 'tcd-w'); ?></p>
    </div>
    <?php
      $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
      $post_tags = get_tags($tag_args);
      if ( $post_tags && ! is_wp_error( $post_tags ) ) {
    ?>
    <ul class="tag_check_list">
      <?php 
        foreach( $post_tags as $tag ):
          $tag_id = $tag->term_id;
          $tag_name = $tag->name;
      ?>
      <li>
        <label>
          <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][tag<?php echo $tag_id; ?>]" type="checkbox" value="1" <?php checked( $value['tag'.$tag_id], 1 ); ?> />
          <span><?php echo $tag_name ?></span>
        </label>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php } ?>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size of tags', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span>
      <div class="use_main_color">
	      <input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_color]" value="<?php echo esc_attr( $value['bg_color'] ); ?>" data-default-color="#003046" class="c-color-picker">
      </div>
      <div class="use_main_color_checkbox">
	      <label>
	          <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_color_use_sub]" type="checkbox" value="1" <?php checked( $value['bg_color_use_sub'], 1 ); ?>>
	        <span><?php _e('Apply key color2', 'tcd-w'); ?></span>
        </label>
      </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Background color on hover', 'tcd-w'); ?></span>
      <div class="use_main_color">
	      <input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][hover_bg_color]" value="<?php echo esc_attr( $value['hover_bg_color'] ); ?>" data-default-color="#0093cb" class="c-color-picker">
      </div>
      <div class="use_main_color_checkbox">
	      <label>
	          <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][hover_bg_color_use_main]" type="checkbox" value="1" <?php checked( $value['hover_bg_color_use_main'], 1 ); ?>>
	        <span><?php _e('Apply key color1', 'tcd-w'); ?></span>
        </label>
      </div>
    </li>
   </ul>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->


<?php
     // 2カラムコンテンツ　-------------------------------------------------------------
     } elseif ($cb_content_select == 'column_content') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }
       if (!isset($value['content_bg_color'])) { $value['content_bg_color'] = '#F4F4F4'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       if (!isset($value['item_title_font_size'])) { $value['item_title_font_size'] = '20'; }

       if (!isset($value['item_list'])) { $value['item_list'] = array(); }
?>

  <h3 class="cb_content_headline">
    <?php _e('2 column content', 'tcd-w');  ?>
    <span><?php echo $value['catch']; ?></span>
  </h3>
  <div class="cb_content">

   <p><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display 2 column content', 'tcd-w'); ?></label></p>
   <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w');  ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_bg_color]" value="<?php echo esc_attr( $value['content_bg_color'] ); ?>" data-default-color="#F4F4F4" class="c-color-picker"></li>
   </ul>

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php echo __('Header content setting', 'tcd-w'); ?></h3>
   <div class="sub_box_content">

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php _e('2 column content setting', 'tcd-w'); ?></h3>
    <div class="sub_box_content">

   <?php // リピーターここから -------------------------- ?>
   <div class="theme_option_message2" style="margin-top:20px;">
    <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-w' ); ?></h4>
       <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Title', 'tcd-w'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php echo esc_attr($repeater_value['title']); ?>" /></li>
         <li class="cf"><span class="label"><?php _e('Description', 'tcd-w'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea></li>
         <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" value="<?php esc_attr_e( $repeater_value['url'] ); ?>" style="max-width:25em;" /></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '110', '110'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js tab_content_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>">
         <input type="hidden" value="<?php if ( $repeater_value['image'] ) echo esc_attr( $repeater_value['image'] ); ?>" id="tab_content_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium'); ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $repeater_value['image'] ) echo 'hidden'; ?>">
         </div>
        </div>
       </div>

       <ul class="button_list cf">
        <!-- <li><a class="close_sub_box button-ml" href="#"><?php //echo __( 'Close', 'tcd-w' ); ?></a></li> -->
        <li class="delete-row" style="float:right; margin:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = array(
            'title' => '',
            'desc' => '',
            'url' => '',
            'image' => ''
          );
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-w' ); ?></h4>
       <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Title', 'tcd-w'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="" /></li>
         <li class="cf"><span class="label"><?php _e('Description', 'tcd-w'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea></li>
         <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" value="" style="max-width:25em;" /></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If regsitered image is more than 1, image area will automatically become slider.', 'tcd-w');  ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '500'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js tab_content_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>">
         <input type="hidden" value="" id="tab_content_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
         <div class="preview_field"></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
         </div>
        </div>
       </div>

       <ul class="button_list cf">
        <!-- <li><a class="close_sub_box button-ml" href="#"><?php //echo __( 'Close', 'tcd-w' ); ?></a></li> -->
        <li class="delete-row" style="float:right; margin:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>
   <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][item_title_font_size]" value="<?php esc_attr_e( $value['item_title_font_size'] ); ?>" /><span>px</span></li>
   </ul>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->



<?php
     // フリースペース　-------------------------------------------------------------
     } elseif ($cb_content_select == 'free_space') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['free_space'])) {
         $value['free_space'] = '';
       }

       if (!isset($value['content_width'])) { $value['content_width'] = 'type1'; }

       if (!isset($value['content_bg_color'])) { $value['content_bg_color'] = '#FFFFFF'; }
       if (!isset($value['margin_top'])) { $value['margin_top'] = '0'; }
       if (!isset($value['margin_bottom'])) { $value['margin_bottom'] = '0'; }
?>
  <h3 class="cb_content_headline"><?php _e('Free space', 'tcd-w');  ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display free space', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
   <ul class="design_radio_button">
    <?php foreach ( $content_width_options as $option ) { ?>
    <li>
     <input type="radio" id="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_width]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['content_width'], $option['value'] ); ?> />
     <label for="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
    </li>
    <?php } ?>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
   <?php
        wp_editor(
          $value['free_space'],
          'cb_wysiwyg_editor-' . $cb_index,
          array (
            'textarea_name' => 'dp_options[mobile_contents_builder][' . $cb_index . '][free_space]'
          )
       );
   ?>

   <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w');  ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_bg_color]" value="<?php echo esc_attr( $value['content_bg_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Top space of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][margin_top]" value="<?php esc_attr_e( $value['margin_top'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Bottom space of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][margin_bottom]" value="<?php esc_attr_e( $value['margin_bottom'] ); ?>" /><span>px</span></li>
   </ul>

<?php
     // ボタンの表示　-------------------------------------------------------------
     } else {
?>
  <h3 class="cb_content_headline"><?php echo esc_html($cb_content_select); ?></h3>
  <div class="cb_content">

<?php
     }
?>

   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>

  </div><!-- END .cb_content -->

</div><!-- END .cb_content_wrap -->

<?php

} // END mobile_the_cb_content_setting()

?>