<?php

  $options = get_design_plus_option();

  // PC/SP設定
  $device = '';
  if(is_mobile() && $options['mobile_show_index_slider'] == 'type2'){ $device = 'mobile_'; }

  // コンテンツの設定
  $index_header_type1_logo = wp_get_attachment_image_src($options[$device.'index_header_type1_logo'], 'full');
  $index_header_type1_logo_retina = $options[$device.'index_header_type1_logo_retina'];
  $index_header_type1_catch = $options[$device.'index_header_type1_catch'];
  $index_header_type1_desc = $options[$device.'index_header_type1_desc'];
  $index_header_type1_bg_color = $options[$device.'index_header_type1_bg_color'];
  if($options[$device.'index_header_type1_bg_color_use_sub']){ $index_header_type1_bg_color = $options['sub_color']; }
  $index_header_type1_bg_color = implode(",",hex2rgb($index_header_type1_bg_color));
  $index_header_type1_bg_opacity = $options[$device.'index_header_type1_bg_opacity'];

  // 背景の設定
  $index_header_type1_bg_image = wp_get_attachment_image_src($options[$device.'index_header_type1_bg_image'], 'full');
  if( is_mobile() && $options['mobile_show_index_slider'] == 'type1' && !empty($options['index_header_type1_bg_image_mobile'])){
    $index_header_type1_bg_image = wp_get_attachment_image_src($options['index_header_type1_bg_image_mobile'], 'full');
  }
  $show_index_header_type1_search_form = $options[$device.'index_header_type1_use_search_form'];
  $index_header_type1_search_form_bg_color = $options[$device.'index_header_type1_search_form_bg_color'];
  if($options[$device.'index_header_type1_search_form_bg_color_use_main']){ $index_header_type1_search_form_bg_color = $options['main_color']; }
  $index_header_type1_search_form_bg_color = implode(",",hex2rgb($index_header_type1_search_form_bg_color));
  $index_header_type1_search_form_bg_opacity = $options[$device.'index_header_type1_search_form_bg_opacity'];

?>
<div id="index_header_type1" class="is-animate">
  <div class="link">
    <div class="content" id="index_header_type1_content" style="background-color:rgba(<?php echo esc_attr($index_header_type1_bg_color); ?>,<?php echo esc_attr($index_header_type1_bg_opacity); ?>);">
      <?php
        
          if(!empty($index_header_type1_logo)) {

            if(!$index_header_type1_logo_retina){
              $image_width = $index_header_type1_logo[1];
              $image_height = $index_header_type1_logo[2];
            }else{
              $image_width = round($index_header_type1_logo[1] / 2);
              $image_height = round($index_header_type1_logo[2] / 2);
            }
            
      ?>
      <div class="image_wrap animate_item">
        <img class="image" src="<?php echo esc_attr($index_header_type1_logo[0]); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>" alt="">
      </div>
      <?php }; if($index_header_type1_catch){ ?>
      <h2 class="catch animate_item"><span><?php echo esc_html($index_header_type1_catch); ?></span></h2>
      <?php }; if($index_header_type1_desc){ ?>
      <p class="desc animate_item"><span><?php echo wp_kses_post(nl2br($index_header_type1_desc)); ?></span></p>
      <?php }; ?>
    </div><!-- END .content -->
    <?php if(!empty($index_header_type1_bg_image)) { ?>
    <div id="index_header_type1_bg_image" class="bg_image" style="background:url(<?php echo esc_attr($index_header_type1_bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    <?php }; ?>
  </div><!-- END .link -->
  <?php
      if($show_index_header_type1_search_form) {
        echo custom_searchform($options, $index_header_type1_search_form_bg_color, $index_header_type1_search_form_bg_opacity);
      }
  ?>
</div><!-- END #index_header_type1 -->