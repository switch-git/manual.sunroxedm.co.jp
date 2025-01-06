<?php

$options = get_design_plus_option();

  // PC/SP設定
  $device = '';
  if(is_mobile() && $options['mobile_show_index_slider'] == 'type2'){ $device = 'mobile_'; }

  $index_slider = $options[$device.'index_slider'];
  $index_slider_time = $options[$device.'index_slider_time'];

?>
<div id="header_slider_wrap">
  <div id="header_slider" class="swiper-container">
   <div class="swiper-wrapper">
   <?php

        $i = 1;
        $slider_item_total = count($index_slider);
        foreach ( $index_slider as $key => $value ) :
          $item_type = $value['slider_type'];
          if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
            $image = wp_get_attachment_image_src( $value['image'], 'full');
            $image_mobile = '';
            $desc_mobile = '';
          } else {
            $image = wp_get_attachment_image_src( $value['image'], 'full');
            $image_mobile = wp_get_attachment_image_src( $value['image_mobile'], 'full');
            $desc_mobile = $value['desc_mobile'];
          }
          $video = $value['video'];
          $youtube_url = $value['youtube'];
          $contents_place = $value['contents_place'];
          $contents_color = $value['contents_color'];

   ?>
   <div class="swiper-slide item <?php if( ($item_type == 'type2') && $video && auto_play_movie() ) { echo 'video'; } elseif( ($item_type == 'type3') && $youtube_url && auto_play_movie() ) { echo 'youtube'; } else { echo 'image_item'; }; ?> item<?php echo $i; ?> <?php if($i == 1){ echo 'first_item'; }; ?>">

    <div class="caption <?php echo esc_attr($contents_place); ?>" style="color:<?php echo esc_attr($contents_color); ?>;">

    <div class="inner">

     <?php if(!empty($value['catch'])){ ?>
     <h2 class="animate_item catch rich_font_<?php echo esc_attr($value['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($value['catch'])); ?></h2>
     <?php }; ?>

     <?php if(!empty($value['desc'])){ ?>
     <div class="animate_item desc">
      <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($value['desc'])); ?></p>
      <?php if($desc_mobile) { ?><p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p><?php }; ?>
     </div>
     <?php }; ?>

     <?php if($value['show_button']){ ?>
     <div class="design_button <?php echo esc_attr($value['button_type']); ?> shape_<?php echo esc_attr($value['button_shape']); ?> animate_item <?php if($i == 1){ echo 'first_animate_item'; }; ?>">
      <a href="<?php echo esc_attr($value['button_url']); ?>" <?php if($value['button_target']){ echo 'target="_blank" rel="nofollow noopener"'; }; ?>><span><?php echo esc_html($value['button_label']); ?></span></a>
     </div>
     <?php }; ?>

    </div>

    </div><!-- END .caption -->

    <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>

    <?php if( ($item_type == 'type2') && $video && auto_play_movie() ) { ?>
    <video class="video_wrap" preload="auto" muted playsinline <?php if($slider_item_total == 1) { echo "loop"; }; ?>>
     <source src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" type="video/mp4" />
    </video>
    <?php
         } elseif( ($item_type == 'type3') && $youtube_url && auto_play_movie() ) {
           if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube_url, $matches)) {
    ?>
    <div class="video_wrap">
     <div class="inner">
     <div class="youtube_inner">
      <iframe id="youtube-player-<?php echo $i; ?>" class="youtube-player slide-youtube" src="https://www.youtube.com/embed/<?php echo esc_attr($matches[1]); ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&<?php if($slider_item_total > 1) { echo "loop=0"; } else { echo "playlist=" . esc_attr($matches[1]); }; ?>&playsinline=1&loop=1" frameborder="0"></iframe>
     </div>
     </div>
    </div>
    <?php
           };
         } else {
    ?>
    <?php if($image) { ?><div class="bg_image <?php if($image_mobile) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
    <?php if($image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($image_mobile[0]); ?>) no-repeat center; background-size:cover;"></div><?php }; ?>
    <?php }; ?>

   </div><!-- END .item -->
   <?php
        $i++;
        endforeach;
   ?>
   </div><!-- END swiper-wrapper -->
  </div><!-- END #header_slider -->

  <?php if($slider_item_total > 1) { ?>
  <div class="swiper-pagination"></div>
  <?php } ?>

 </div><!-- END #header_slider_wrap -->