<?php

    function tcd_head() {
      $options = get_design_plus_option();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1201px)" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1201px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.4.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.min.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/simplebar.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/simplebar.min.js?ver=<?php echo version_num(); ?>"></script>

<?php if(is_mobile()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php }; if( (!is_category() || !$options['scroll_post_category_header']) && !is_404() ){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>
<?php }
      
      // ヘッダーメッセージ
      if($options['show_header_message']) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($.cookie('close_header_message') == 'on') {
    $('#header_message').hide();
  }
  $('#close_header_message').click(function() {
    $('#header_message').hide();
    $.cookie('close_header_message', 'on', {
      path:'/'
    });
  });
});
</script>
<?php };

      /* URLやモバイル等でcssが変わらないものをここで出力 */ ?>
<style type="text/css">
<?php

    // 色の設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

    $main_color  = implode(",",hex2rgb($options['main_color']));
    $sub_color   = implode(",",hex2rgb($options['sub_color']));
    $hover_color = implode(",",hex2rgb($options['hover_color']));
    $link_color  = implode(",",hex2rgb($options['content_link_color']));
    $link_hover_color = ($options['content_link_hover_color_use_hover']) ? $hover_color : implode(",",hex2rgb($options['content_link_hover_color']));

?>
:root {
  --tcd-key1-color:<?php echo esc_html($main_color); ?>;
  --tcd-key2-color:<?php echo esc_html($sub_color); ?>;
  --tcd-hover-color:<?php echo esc_html($hover_color); ?>;
  --tcd-link-color:<?php echo esc_html($link_color); ?>;
  --tcd-link-hover-color:<?php echo esc_html($link_hover_color); ?>;
}
<?php

    // フォントの設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

    // フォントサイズ
?>
body { font-size:<?php echo esc_html($options['content_font_size']); ?>px; }
.common_headline { font-size:<?php echo esc_html($options['headline_font_size']); ?>px !important; }
#archive_header_title .title { font-size:<?php echo esc_html($options['page_header_font_size']); ?>px; }
@media screen and (max-width:750px) {
  body { font-size:<?php echo esc_html($options['content_font_size_mobile']); ?>px; }
  .common_headline { font-size:<?php echo esc_html($options['headline_font_size_mobile']); ?>px !important; }
  #archive_header_title .title { font-size:<?php echo esc_html($options['page_header_font_size_mobile']); ?>px; }
}
<?php
    // フォントタイプ
?>
body, input, textarea { font-family: var(--tcd-font-<?php echo esc_html($options['content_font_type']); ?>); }
.rich_font, .p-vertical { font-family: var(--tcd-font-<?php echo esc_html($options['headline_font_type']); ?>); }
#archive_header_title .title { font-family: var(--tcd-font-<?php echo esc_html($options['page_header_font_type']); ?>); }
<?php

    // デザインボタンの設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    $button_font_color = $options['design_button_font_color'] ? $options['design_button_font_color'] : '#ffffff';
    $button_font_color_hover = $options['design_button_font_color_hover'] ? $options['design_button_font_color_hover'] : '#ffffff';
    $button_bg_color = ($options['design_button_bg_color_use_main'] != 1) ? $options['design_button_bg_color'] : $options['main_color'];
    $button_bg_color_hover = ($options['design_button_bg_color_hover_use_sub'] != 1) ? $options['design_button_bg_color_hover'] : $options['sub_color'];
    if($options['design_button_type'] == 'type1'){
?>
.design_button.type1 a { color:<?php echo esc_attr($button_font_color); ?> !important; background:<?php echo esc_attr($button_bg_color); ?>; }
.design_button.type1 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?> !important; background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php
    } else {
      $button_border_color = $options['design_button_border_color'] ? $options['design_button_border_color'] : '#ffffff';
      $button_border_color_opacity = $options['design_button_border_color_opacity'] ? $options['design_button_border_color_opacity'] : '1';
      $button_border_color = hex2rgb($button_border_color);
      $button_border_color = implode(",",$button_border_color);

      $button_border_color_hover = ($options['design_button_border_color_hover_use_sub'] != 1) ? $options['design_button_border_color_hover'] : $options['sub_color'];
      $button_border_color_opacity_hover = $options['design_button_border_color_hover_opacity'] ? $options['design_button_border_color_hover_opacity'] : '1';
      $button_border_color_hover = hex2rgb($button_border_color_hover);
      $button_border_color_hover = implode(",",$button_border_color_hover);
?>
.design_button.type2 a, .design_button.type3 a { color:<?php echo esc_attr($button_font_color); ?> !important; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($button_border_color_opacity); ?>); }
.design_button.type2 a:hover, .design_button.type3 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?> !important; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_opacity_hover); ?>); }
.design_button.type2 a:before, .design_button.type3 a:before { background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php

    };

    // サムネイルの設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    echo thumbnail_hover_style($options);



    // QUADRA専用ホバーアニメーションの設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    if($options['use_quadra_hover'] && ( $options['quadra_hover_type'] == 'type3' ) && !$options['quadra_hover_type3_color_use_sub']){
?>
#body .hover_animation_type3:before { box-shadow: 0px 0px 0px 0px <?php echo esc_attr($options['quadra_hover_type3_color']); ?> inset; }
#body .hover_animation_type3:hover:before { box-shadow: 0px 0px 0px 4px <?php echo esc_attr($options['quadra_hover_type3_color']); ?> inset; }
<?php

    };

    // クイックタグのスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    echo quicktag_style($options);


    // ヘッダー　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    $header_bg_color = ($options['header_bg_color_use_main']) ? $options['main_color'] : $options['header_bg_color'];
    $header_bg_color = implode(",",hex2rgb($header_bg_color));
    $header_bg_opacity = $options['header_bg_color_opacity'];
    $header_bg_opacity_mobile = $options['mobile_header_bg_color_opacity'];
    // ロゴ
    $header_logo_font_size = $options['header_logo_font_size'];
    $header_logo_font_size_mobile = $options['header_logo_font_size_mobile'];

?>
#header, #global_menu_border { background:rgba(<?php echo esc_attr($header_bg_color); ?>,1); }
#header.active { background:rgba(<?php echo esc_attr($header_bg_color); ?>,<?php echo esc_attr($header_bg_opacity); ?>); }
#header_logo .logo_text { font-size:<?php echo esc_html($header_logo_font_size); ?>px; }
@media screen and (max-width:1201px) {
  #header.active { background:rgba(<?php echo esc_attr($header_bg_color); ?>,<?php echo esc_attr($header_bg_opacity_mobile); ?>); }
  #header_logo .logo_text { font-size:<?php echo esc_html($header_logo_font_size_mobile); ?>px; }
}
<?php

    // グローバルメニュー

?>
#global_menu ul ul a, #global_menu ul ul a:hover, #global_menu ul ul li.menu-item-has-children > a:before
{ color:<?php echo esc_html($options['global_menu_font_color']); ?>; }
<?php if($options['global_menu_child_bg_color_use_main'] != 1){ ?>
#global_menu ul ul a { background:<?php echo esc_html($options['global_menu_child_bg_color']); ?>; }
<?php } if($options['global_menu_child_bg_color_hover_use_hover'] != 1){ ?>
#global_menu ul ul a:hover { background:<?php echo esc_html($options['global_menu_child_bg_color_hover']); ?>; }
<?php }

     // ドロワーメニュー
     $mobile_menu_font_color = hex2rgb($options['mobile_menu_font_color']);
     $mobile_menu_font_color = implode(",",$mobile_menu_font_color);
?>
.mobile #header:after { background:rgba(255,255,255,<?php echo esc_html($options['mobile_header_bg_color_opacity']); ?>); }
#drawer_menu { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; }
#drawer_menu a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; }
#drawer_menu a:hover { color:<?php echo esc_html($options['sub_color']); ?>; }
#mobile_menu a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; border-color:<?php echo esc_html($options['mobile_menu_border_color']); ?>; }
#mobile_menu li li a { background:<?php echo esc_html($options['mobile_menu_sub_menu_bg_color']); ?>; }
#mobile_menu a:hover, #drawer_menu .close_button:hover, #mobile_menu .child_menu_button:hover { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_hover_color']); ?>; }
#mobile_menu .child_menu_button .icon:before, #mobile_menu .child_menu_button:hover .icon:before { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; }
<?php

     // メガメニュー

?>
.megamenu_a .category_list_area .title .main_title { font-size:<?php echo esc_html($options['mega_menu_a_font_size']); ?>px; }
.megamenu_b .post_list .item .title { font-size:<?php echo esc_html($options['mega_menu_b_font_size']); ?>px; }
<?php
     // メッセージ -----------------------------------------------------------------------------------
      if($options['show_header_message'] && $options['header_message']) {
?>
#header_message { background:<?php echo esc_attr($options['header_message_bg_color']); ?>; color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
#close_header_message:before { color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
#header_message a { color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
/* #header_message a:hover { color:<?php echo esc_attr($options['main_color']); ?>; } */
<?php

      };

      // フッター　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
      $footer_logo_font_size = $options['footer_logo_font_size'];
      $footer_logo_font_size_mobile = $options['footer_logo_font_size_mobile'];

?>
#footer_logo .logo_text { font-size:<?php echo esc_html($footer_logo_font_size); ?>px; }
@media screen and (max-width:1201px) { 
  #footer_logo .logo_text { font-size:<?php echo esc_html($footer_logo_font_size_mobile); ?>px; }
}
<?php

      // カスタムCSS --------------------------------------------
      if($options['css_code']) {
        echo $options['css_code'];
      };
      
?>
</style>
<?php

      /* URLやモバイル等でcssが変わるものはここで出力 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ */

      // トップページ -----------------------------------------------------------------------------
      if(is_front_page()) {
        echo front_page_style($options);
      }

?>
<style id="current-page-style" type="text/css">
<?php

      if(is_front_page()){

      // ブログアーカイブ -----------------------------------------------------------------------------
      }elseif(is_post_type_archive('blog') || is_tax('blog_category') ) {
?>
#blog_archive .post_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #blog_archive .post_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size_mobile']); ?>px; }
}
<?php

      // ブログ詳細ページ
      } elseif(is_singular('blog')) {
?>
#blog_title .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size']); ?>px; }
#related_blog .headline { font-size:<?php echo esc_attr($options['related_blog_headline_font_size']); ?>px; }
#related_blog_list .title { font-size:<?php echo esc_attr($options['related_blog_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #blog_title .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size_mobile']); ?>px; }
  #related_blog .headline { font-size:<?php echo esc_attr($options['related_blog_headline_font_size_mobile']); ?>px; }
  #related_blog_list .title { font-size:<?php echo esc_attr($options['related_blog_title_font_size_mobile']); ?>px; }
}
<?php

      // お知らせアーカイブ -----------------------------------------------------------------------------
      } elseif(is_post_type_archive('news')) {
?>
#news_archive_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #news_archive_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size_mobile']); ?>px; }
}
<?php

      // お知らせ詳細ページ -----------------------------------------------------------------------------
      } elseif(is_singular('news')) {
?>
#news_title .title { font-size:<?php echo esc_attr($options['single_news_title_font_size']); ?>px; }
#recent_news .headline { font-size:<?php echo esc_attr($options['recent_news_headline_font_size']); ?>px; }
#recent_news_list .title { font-size:<?php echo esc_attr($options['recent_news_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #news_title .title { font-size:<?php echo esc_attr($options['single_news_title_font_size_mobile']); ?>px; }
  #recent_news .headline { font-size:<?php echo esc_attr($options['recent_news_headline_font_size_mobile']); ?>px; }
  #recent_news_list .title { font-size:<?php echo esc_attr($options['recent_news_title_font_size_mobile']); ?>px; }
}
<?php

      // 投稿アーカイブページ -----------------------------------------------------------------------------
      } elseif(is_home()) {
?>
#post_archive .title { font-size:<?php echo esc_attr($options['post_archive_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #post_archive .title { font-size:<?php echo esc_attr($options['post_archive_title_font_size_mobile']); ?>px; }
}
<?php

      // 投稿カテゴリーページ -----------------------------------------------------------------------------
      } elseif(is_category() || is_archive() || is_search()) {
?>
#post_category_archive .title, #archive .title, #search_archive .title { font-size:<?php echo esc_attr($options['post_category_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #post_category_archive .title, #archive .title, #search_archive .title { font-size:<?php echo esc_attr($options['post_category_title_font_size_mobile']); ?>px; }
}
<?php

      // 投稿詳細ページ -----------------------------------------------------------------------------
      } elseif(is_single()){
?>
#post_title .title { font-size:<?php echo esc_attr($options['single_post_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #post_title .title { font-size:<?php echo esc_attr($options['single_post_title_font_size_mobile']); ?>px; }
}
<?php

     } // 固定ページ無し

     // カスタムCSS --------------------------------------------
     if(is_single() || is_page()) {
       global $post;
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo $custom_css;
       };
     }

     // ロード画面 -----------------------------------------
     get_template_part('functions/loader_css');
     if($options['load_icon'] == 'type4' || $options['load_icon'] == 'type5'){
?>
#site_loader_logo_inner .message { font-size:<?php echo esc_html($options['loading_message_font_size']); ?>px; color:<?php echo esc_html($options['loading_message_color']); ?>; }
#site_loader_logo_inner i { background:<?php echo esc_html($options['loading_message_color']); ?>; }
<?php
     if($options['load_icon'] == 'type5'){
       $load_type5_catch_font_size_middle = ($options['load_type5_catch_font_size'] + $options['load_type5_catch_font_size_sp']) / 2;
?>
#site_loader_logo_inner .catch { font-size:<?php echo esc_html($options['load_type5_catch_font_size']); ?>px; color:<?php echo esc_html($options['load_type5_catch_color']); ?>; }
@media screen and (max-width:1100px) {
  #site_loader_logo_inner .catch { font-size:<?php echo esc_attr(ceil($load_type5_catch_font_size_middle)); ?>px; }
}
<?php }; ?>
@media screen and (max-width:750px) {
  #site_loader_logo_inner .message { font-size:<?php echo esc_html($options['loading_message_font_size_sp']); ?>px; }
  <?php if($options['load_icon'] == 'type5'){ ?>
  #site_loader_logo_inner .catch { font-size:<?php echo esc_html($options['load_type5_catch_font_size_sp']); ?>px; }
  <?php }; ?>
}
<?php
     };

     //フッターバー --------------------------------------------
     if(is_mobile()) {
       if($options['footer_bar_type'] == 'type1' && $options['footer_bar_display'] != 'type3'){
         $footer_bar_border_color = hex2rgb($options['footer_bar_border_color']);
         $footer_bar_border_color = implode(",",$footer_bar_border_color);
?>
#dp-footer-bar { background:<?php echo esc_attr($options['footer_bar_bg_color']); ?>; color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a { border-color:rgba(<?php echo esc_attr($footer_bar_border_color); ?>,<?php echo esc_html($options['footer_bar_border_color_opacity']); ?>); color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a:hover { border-color:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; background:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; }
<?php
       } elseif($options['footer_bar_type'] == 'type2' && $options['footer_bar_display'] != 'type3'){
         for($i = 1; $i <= 2; $i++) {
           if($options['show_footer_button'.$i]) {
             $footer_button_bg_color = ($options['footer_button_bg_color_use_main'.$i] != 1) ? $options['footer_button_bg_color'.$i] : $options['main_color'];
             $footer_button_bg_color_hover = ($options['footer_button_bg_color_hover_use_sub'.$i] != 1) ? $options['footer_button_bg_color_hover'.$i] : $options['sub_color'];
?>
#dp-footer-bar a.footer_button.num<?php echo $i; ?> { font-size:<?php echo esc_attr($options['footer_button_font_size']); ?>px; color:<?php echo esc_attr($options['footer_button_font_color'.$i]); ?>; background:<?php echo esc_attr($footer_button_bg_color); ?>; }
#dp-footer-bar a.footer_button.num<?php echo $i; ?>:hover { background:<?php echo esc_attr($footer_button_bg_color_hover); ?>; }
<?php
           }
         };
       };
     };
?>
</style>
<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

    // トップページ
    if(is_front_page()) {

      $index_slider = '';
      $display_header_content = '';
      $slider_type = '';

      if(!is_mobile() && $options['show_index_slider']) {
        $index_slider = $options['index_slider'];
        $display_header_content = 'show';
        $slider_type = $options['index_slider_type'];
        $device = '';

      } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
        $index_slider = $options['mobile_index_slider'];
        $display_header_content = 'show';
        $slider_type = $options['mobile_index_slider_type'];
        $device = 'mobile_';

      } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
        $index_slider = $options['index_slider'];
        $display_header_content = 'show';
        $slider_type = $options['index_slider_type'];
        $device = '';
      }

      echo front_page_scripts($options, $display_header_content, $slider_type);

    // ブログアーカイブページ ----------------------------------------------------------
    }elseif(is_post_type_archive('blog')) {
?>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(){

  let categories = document.querySelectorAll('#blog_archive .post_list .category');
    if(categories.length > 0){
      categories.forEach(cat => {
        cat.addEventListener('click', function(event){
          event.stopPropagation();
          event.preventDefault();
        window.location.href = this.dataset.href;
      });
    });
  }

});
<?php if($options['archive_blog_animation'] != 'type4'){ ?>
jQuery(document).ready(function($){

  $("#blog_archive .post_list .item").each(function(i){
    $(this).delay(i * 300).queue(function(next) {
      $(this).addClass('animate');
      next();
    });
  });

});
<?php } ?>
</script>
<?php

    // 固定ページ ----------------------------------------------------------
    }elseif(is_page()) {
      global $post;

      // サイドコンテンツの設定
      $hide_sidebar = get_post_meta($post->ID, 'page_hide_sidebar', true);
      $use_custom_side_content = get_post_meta($post->ID, 'use_custom_side_content', true);
      $side_navigation_type = get_post_meta($post->ID, 'side_navigation_type', true);
      if(!$hide_sidebar && $use_custom_side_content && !empty($side_navigation_type) ):

?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('#side_navigation .parent').on('click', function(e) {

    e.preventDefault();
    e.stopPropagation();

    let this_menu = $(this);
    let this_child = $(this).next();
    let child_menu_height = $(this_child).find('.sub-menu').innerHeight();

    if($(this_menu).hasClass('active')){
      $(this_child).css('height', '').removeClass('active');
      $(this_menu).removeClass('active');
    }else{
      $(this_child).css('height', child_menu_height).addClass('active');
      $(this_menu).addClass('active');
    }

  });

  if(document.getElementById('header') == null){
    var header_height = 30;
  }else{
    var header_height = 90;
  }

  $('#side_navigation a[href^="#"]').not('.parent').on('click',function() {
    var toc_href = $(this).attr("href");
    if(toc_href.length > 1){
      var target = $(toc_href).offset().top - header_height;
      $("html,body").animate({scrollTop : target}, 1000, 'easeOutExpo');
      return false;
    }
  });

});
</script>
<?php

      endif;

    }

    // 目次のスクロールアニメーション
    if(is_singular() && $options['use_toc_scroll_animation'] && !is_front_page()){
?>
<script>
jQuery(document).ready(function($){
  $('#tcd_toc a[href^="#"], .toc_widget_wrap a[href^="#"]').on('click',function() {
    var toc_href= $(this).attr("href");
    var target = $(toc_href).offset().top - 90;
    $("html,body").animate({scrollTop : target}, 1000, 'easeOutExpo');
    return false;
  });
});
</script>
<?php
    }// use_toc_scroll_animation


    // タブ記事ウィジェット --------------------
    if ( is_active_widget(false, false, 'tab_post_list_widget', true) ) {

      wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '6.8.1', true );
      wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.css', array(), '6.8.1' );

?>
<script type="text/javascript">
window.addEventListener('DOMContentLoaded', function() {

  let swipers = [];

  let tab_post_list_widgets = document.querySelectorAll('.tab_post_list_widget');
  if(tab_post_list_widgets.length > 0){

    for(let widget of tab_post_list_widgets) {

      let id = '#' + widget.id;
      var swiperSelectors = widget.querySelectorAll('.tab_post_list_carousel');
      if(swiperSelectors.length > 0){

        let index = 0;
        for(let selector of swiperSelectors) {

          index++;

          let sliderIndex = id + '_' + index;
          let navSelector = id + ' .tab_post_list' + index;

          let options = {
            direction: 'vertical',
            effect: 'slide',
            slidesPerView: 3,
            spaceBetween: 20,
            observer: true,
            observeParents: true,
            navigation: {
              nextEl: navSelector + ' .swiper-button-next',
              prevEl: navSelector + ' .swiper-button-prev',
            },
            loop: true,
            speed: 700,
            autoplay: {
              delay: 5000,
            }
          }

          swipers[sliderIndex] = new Swiper(selector, options);

        }

      } // END if swiperSelectors

    }

  } // END if tab_post_list_widgets

});
</script>
<?php
     }

     // 404 --------------------------------------------
     if(is_404()) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  $('#page_404_header').addClass('animate');
  var winH = $(window).innerHeight();
  $('#page_404_header').css('height', winH);
  $(window).on('resize', function(){
    var winH = $(window).innerHeight();
    $('#page_404_header').css('height', winH);
  });
});
</script>
<?php
     };

     // カスタムスクリプト--------------------------------------------
     if($options['script_code']) {
       echo $options['script_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $custom_script = get_post_meta($post->ID, 'custom_script', true);
       if($custom_script) {
         echo $custom_script;
       };
     };
?>

<?php
     }; // END function tcd_head()
     add_action("wp_head", "tcd_head");
?>