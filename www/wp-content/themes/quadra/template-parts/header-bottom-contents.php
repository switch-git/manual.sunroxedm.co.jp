 <?php

    // ボックスコンテンツ
    // ニュースティッカー

    $options = get_design_plus_option();

    // PC/SP設定
    $device = '';
    if(is_mobile()){
      $device = 'mobile_';
    }

    // ボックスコンテンツの設定
    $show_box_content = $options[$device.'show_index_box_content'];
    if($show_box_content) {

?>
<div class="index_box_content">
  <?php

      for ( $i = 1; $i <= 2; $i++ ) :

        $box_content_headline = $options[$device.'index_box_content_headline'.$i];
        $box_content_desc = $options[$device.'index_box_content_desc'.$i];
        $box_content_url = $options[$device.'index_box_content_url'.$i];

        $box_content_icon_type = $options[$device.'index_box_content_icon_type'.$i];

        if ($box_content_icon_type == 'type1'){
          $box_content_icon = wp_get_attachment_image_src($options[$device.'index_box_content_image'.$i], 'full');
          $box_content_icon_retina = $options[$device.'index_box_content_image_retina'.$i];

          $image_url = $box_content_icon[0] ?? '';
          $image_width = $box_content_icon[1] ?? 0;
          $image_height = $box_content_icon[2] ?? 0;

          if($box_content_icon_retina){
            $image_width = round($image_width / 2);
            $image_height = round($image_height / 2);
          }

          $icon = '<img class="image" src="'.esc_attr($image_url).'" alt="'.esc_html($title).'" width="'.esc_attr($image_width).'" height="'.esc_attr($image_height).'">';
          
        }elseif($box_content_icon_type == 'type2'){
          $box_content_icon = $options[$device.'index_box_content_icon'.$i];
          $icon_size = $options[$device.'index_box_content_icon_size'.$i];
          $icon_color = $options[$device.'index_box_content_icon_color'.$i];

          $icon = '<div class="image box_icon '.esc_attr($box_content_icon).'" style="color:'.esc_attr($icon_color).';font-size:'.esc_attr($icon_size).'px;"></div>';
        }

    
  ?>
  <div class="item">
    <a class="link" href="<?php echo esc_url($box_content_url); ?>">
      <div class="title_wrap">
        <div class="image_wrap">
          <?php if($box_content_icon){ echo $icon; } ?>
        </div>
        <?php if(!empty($box_content_headline)) { ?>
        <h2 class="title rich_font"><?php echo wp_kses_post(nl2br($box_content_headline)); ?></h2>
        <?php }; ?>
      </div>
      <?php if(!empty($box_content_desc)) { ?>
      <div class="content_wrap">
        <p class="desc"><?php echo esc_html($box_content_desc); ?></p>
      </div>
      <?php }; ?>
    </a>
  </div>
  <?php

      endfor;
    
  ?>
</div><!-- END index_box_content -->
<?php

      } // show_box_content


      // ニュースティッカー
      $show_index_news = $options[$device.'show_index_news'];
      $post_type = $options[$device.'index_news_post_type'];
      $post_order = $options[$device.'index_news_post_order'];
      $news_label = $options[$device.'index_news_label'];

      if($show_index_news) {

        $post_num = '5';
        if($post_order == 'rand'){
          $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num, 'orderby' => 'rand' );
        } else {
          $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
        }

        // ニュースティッカーの背景色（SP時は#FFFFFF）
        $post_list_query = new wp_query($args);
        if($post_list_query->have_posts()) {

          $contents_builder = $options['contents_builder'];
          $first_bg_color = '#FFFFFF';

          if($options['index_content_type'] == 'type1'){
            foreach($contents_builder as $content):
              if($content['show_content']){
                $first_bg_color = $content['content_bg_color'];
                break;
              }
            endforeach;
          }

?>
<div id="index_news_ticker" style="background-color:<?php echo esc_html($first_bg_color); ?>;">
  <div class="inner">
    <div class="list swiper-container" id="news_ticker_slider">
      <div class="swiper-wrapper">
        <?php while($post_list_query->have_posts()): $post_list_query->the_post(); ?>
        <article class="swiper-slide item">
          <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
          <p class="title"><a class="line" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
        </article>
        <?php endwhile; ?>
      </div><!-- END .swiper-wrapper -->
    </div><!-- END .swiper-container -->
    <div class="news_ticker_button">
      <a class="link" href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html($news_label); ?></a>
    </div>
    <div class="design_button <?php echo esc_attr($options['design_button_type']); ?> shape_<?php echo esc_attr($options['design_button_shape']); ?>">
      <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span><?php echo esc_html($news_label); ?></span></a>
    </div>
  </div><!-- END #index_news_ticker -->
</div><!-- END #index_news_ticker_wrap -->
<?php 

        } // post_list_query

      } // show_index_news 

?>