<?php

  function front_page_style($options){


?>
<style id="front-page-style" type="text/css">
<?php

    // ボックスコンテンツの設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    if($options['show_index_box_content'] || $options['mobile_show_index_box_content']) {
?>
.index_box_content .title { font-size:<?php echo esc_attr($options['index_box_content_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .index_box_content .title { font-size:<?php echo esc_attr($options['mobile_index_box_content_font_size']); ?>px; }
}
<?php

    } // END ボックスコンテンツ


    // ヘッダーコンテンツの設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    $index_slider = '';
    $display_header_content = '';

    if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')){
      $device = 'mobile_';
    } else {
      $device = '';
    }

    if(!is_mobile() && $options['show_index_slider']) {
      $index_slider = $options['index_slider'];
      $display_header_content = 'show';
      $slider_type = $options['index_slider_type'];
    } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
      $index_slider = $options['mobile_index_slider'];
      $display_header_content = 'show';
      $slider_type = $options['mobile_index_slider_type'];
    } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
      $index_slider = $options['index_slider'];
      $display_header_content = 'show';
      $slider_type = $options['index_slider_type'];
    }

    // スライダータイプ 2
    if($slider_type == 'type2'){

      $title_font_size = $options['index_header_type2_title_font_size'];
      $title_font_size_mobile = $options['index_header_type2_title_font_size_mobile'];
      if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')) {
        $title_font_size_mobile = $options['mobile_index_header_type2_title_font_size'];
      }

?>
#index_header_type2 .catch { font-size:<?php echo esc_attr($title_font_size); ?>px; }
@media screen and (max-width:750px) {
  #index_header_type2 .catch { font-size:<?php echo esc_attr($title_font_size_mobile); ?>px; }
}
<?php

    // スライダータイプ 3
    }elseif($slider_type == 'type3'){

      $i = 1;
      foreach ( $index_slider as $key => $value ) :

        if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')) {
          $catch_font_size_mobile = $value['catch_font_size'];
          $desc_font_size_mobile = $value['desc_font_size'];
        } else {
          $catch_font_size_mobile = $value['catch_font_size_mobile'];
          $desc_font_size_mobile = $value['desc_font_size_mobile'];
        }

?>
#header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($value['catch_font_size']); ?>px; }
#header_slider .item<?php echo $i; ?> .desc { font-size:<?php echo esc_attr($value['desc_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #header_slider .item<?php echo $i; ?> .caption { color:<?php echo esc_attr($value['mobile_contents_color']); ?>!important; }
  #header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  #header_slider .item<?php echo $i; ?> .desc { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
        
        // ボタンのスタイル ---------------------------------------------------------
        if($value['show_button']){
          $button_font_color = $value['button_font_color'] ? $value['button_font_color'] : '#ffffff';
          $button_font_color_hover = $value['button_font_color_hover'] ? $value['button_font_color_hover'] : '#ffffff';
          $button_bg_color = ($value['button_bg_color_use_main'] != 1) ? $value['button_bg_color'] : $options['main_color'];
          $button_bg_color_hover = ($value['button_bg_color_hover_use_sub'] != 1) ? $value['button_bg_color_hover'] : $options['sub_color'];
          if($value['button_type'] == 'type1'){
?>
#header_slider .item<?php echo $i; ?> .design_button.type1 a { color:<?php echo esc_attr($button_font_color); ?> !important; background:<?php echo esc_attr($button_bg_color); ?>; }
#header_slider .item<?php echo $i; ?> .design_button.type1 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?> !important; background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php
          } else {
            $button_border_color = $value['button_border_color'] ? $value['button_border_color'] : '#ffffff';
            $button_border_color_opacity = $value['button_border_color_opacity'] ? $value['button_border_color_opacity'] : '1';
            $button_border_color = hex2rgb($button_border_color);
            $button_border_color = implode(",",$button_border_color);
            $button_border_color_hover = ($value['button_border_color_hover_use_sub'] != 1) ? $value['button_border_color_hover'] : $options['sub_color'];
            $button_border_color_opacity_hover = $value['button_border_color_hover_opacity'] ? $value['button_border_color_hover_opacity'] : '1';
            $button_border_color_hover = hex2rgb($button_border_color_hover);
            $button_border_color_hover = implode(",",$button_border_color_hover);
?>
#header_slider .item<?php echo $i; ?> .design_button.type2 a, #header_slider .item<?php echo $i; ?> .design_button.type3 a { color:<?php echo esc_attr($button_font_color); ?> !important; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($button_border_color_opacity); ?>); }
#header_slider .item<?php echo $i; ?> .design_button.type2 a:hover, #header_slider .item<?php echo $i; ?> .design_button.type3 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?> !important; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_opacity_hover); ?>); }
#header_slider .item<?php echo $i; ?> .design_button.type2 a:before, #header_slider .item<?php echo $i; ?> .design_button.type3 a:before { background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php
          };
        }; // END button setting

        $use_overlay = $value['use_overlay'];
        $overlay_color = hex2rgb($value['overlay_color']);
        $overlay_opacity = $value['overlay_opacity'];
        $overlay_color = implode(",",$overlay_color);
        if($use_overlay) {
?>
#header_slider .item<?php echo $i; ?> .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
        }; // END overlay

      $i++;
      endforeach;
    };


    // コンテンツビルダー　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

    if ($options['contents_builder'] || $options['mobile_contents_builder']) :
      $content_count = 1;
      if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
        $contents_builder = $options['mobile_contents_builder'];
      } else {
        $contents_builder = $options['contents_builder'];
      }
      foreach($contents_builder as $content) :

        // 2カラムコンテンツ ---------------------------------------------------------
        if ( $content['cb_content_select'] == 'column_content' && $content['show_content'] ) {

          if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
            $item_title_font_size_mobile = $content['item_title_font_size'];
          } else {
            $item_title_font_size_mobile = $content['item_title_font_size_mobile'];
          }

?>
.cb_column_content.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($content['item_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_column_content.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($item_title_font_size_mobile); ?>px; }
}
<?php

        // タグクラウド ---------------------------------------------------------
        } elseif ( $content['cb_content_select'] == 'tag_cloud' && $content['show_content'] ) {

          if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
            $title_font_size_mobile = $content['title_font_size'];
          } else {
            $title_font_size_mobile = $content['title_font_size_mobile'];
          }

          $bg_color = ($content['bg_color_use_sub']) ? $options['sub_color'] : $content['bg_color'];
          $bg_hover_color = ($content['hover_bg_color_use_main']) ? $options['main_color'] : $content['hover_bg_color'];

?>
.cb_tag_cloud.num<?php echo $content_count; ?> .link { 
  font-size:<?php echo esc_html($content['title_font_size']); ?>px;
  background:<?php echo esc_html($bg_color); ?>;
}
.cb_tag_cloud.num<?php echo $content_count; ?> .link:hover { 
  background:<?php echo esc_html($bg_hover_color); ?>;
}
@media screen and (max-width:750px) {
  .cb_tag_cloud.num<?php echo $content_count; ?> .link { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
        // ブログカルーセル ---------------------------------------------------------
        } elseif ( $content['cb_content_select'] == 'blog_carousel' && $content['show_content'] ) {

          if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
            $title_font_size_mobile = $content['title_font_size'];
          } else {
            $title_font_size_mobile = $content['title_font_size_mobile'];
          }
?>
.cb_blog_carousel.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_blog_carousel.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php

        // カテゴリー一覧 ---------------------------------------------------------
        } elseif ( $content['cb_content_select'] == 'category_list' && $content['show_content'] ) {

          if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
            $title_font_size_mobile = $content['title_font_size'];
          } else {
            $title_font_size_mobile = $content['title_font_size_mobile'];
          }
?>
.cb_category_list.num<?php echo $content_count; ?> .category_list .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_category_list.num<?php echo $content_count; ?> .category_list .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
        // フリースペース ----------------------------------------------------
        } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
          if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
            $margin_top_mobile = $content['margin_top'];
            $margin_bottom_mobile = $content['margin_bottom'];
          } else {
            $margin_top_mobile = $content['margin_top_mobile'];
            $margin_bottom_mobile = $content['margin_bottom_mobile'];
          }
?>
.cb_free_space.num<?php echo $content_count; ?> .post_content { padding-top:<?php echo esc_html($content['margin_top']); ?>px; padding-bottom:<?php echo esc_html($content['margin_bottom']); ?>px; }
@media screen and (max-width:750px) {
  .cb_free_space.num<?php echo $content_count; ?> .post_content { padding-top:<?php echo esc_html($margin_top_mobile); ?>px; padding-bottom:<?php echo esc_html($margin_bottom_mobile); ?>px; }
}
<?php
        };
      $content_count++;
      endforeach;
    endif; // END コンテンツビルダーここまで

?>
</style>
<?php

  }