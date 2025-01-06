<?php

  $options = get_design_plus_option();

  // PC/SP設定
  $device = '';
  if(is_mobile() && $options['mobile_show_index_slider'] == 'type2'){ $device = 'mobile_'; }

  $post_type = $options[$device.'index_header_type2_post_type'];
	$post_order = $options[$device.'index_header_type2_post_order'];
	$post_num = $options[$device.'index_header_type2_post_num'];

  $title_font_type = $options[$device.'index_header_type2_title_font_type'];

  $show_category = $options[$device.'index_header_type2_show_date'];
	$show_date = $options[$device.'index_header_type2_show_category'];

?>
<div id="index_header_type2">
  <div class="swiper-container" id="index_blog_slider">
    <div class="swiper-wrapper">
<?php

  if($post_type == 'recent_post') {
    $args = array('post_type' => 'blog', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'ignore_sticky_posts' => 1);
  } else {
    $args = array('post_type' => 'blog', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'ignore_sticky_posts' => 1, 'meta_key' => $post_type, 'meta_value' => 'on');
  };

  $post_list = new wp_query($args);

  if($post_list->have_posts()):

    while( $post_list->have_posts() ) : $post_list->the_post();

      $content_type = get_post_meta($post->ID, 'blog_content_type', true);

      switch (true) :

        case $content_type == 'type1': // アイキャッチ画像を使用する

          // アイキャッチ画像
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
          $use_overlay = get_post_meta($post->ID, 'blog_use_overlay', true);
          $overlay_color = implode(",",hex2rgb(get_post_meta($post->ID, 'blog_overlay_color', true)));
          $overlay_opacity = get_post_meta($post->ID, 'blog_overlay_opacity', true);

          break;

        case $content_type == 'type2': // レイヤー画像を使用する

          $layer_image_id = get_post_meta($post->ID, 'blog_bg_image', true);
          if(is_mobile() && get_post_meta($post->ID, 'blog_bg_image_mobile', true)){
            $layer_image_id = get_post_meta($post->ID, 'blog_bg_image_mobile', true);
          }

          $layer_image = wp_get_attachment_image_src( $layer_image_id, 'full' );
          $layer_image_alt = get_post_meta( $layer_image_id, '_wp_attachment_image_alt', true );
          $layer_bg_color = get_post_meta($post->ID, 'blog_bg_color', true);

          break;

      endswitch;

      // カテゴリー
      $category = wp_get_post_terms( $post->ID, 'blog_category' , array( 'orderby' => 'term_order' ));
      if ( $category && ! is_wp_error($category) ) {
        foreach ( $category as $cat ) :
          $cat_name = $cat->name;
          $cat_id = $cat->term_id;
          $cat_url = get_term_link($cat_id,'blog_category');
          break;
        endforeach;
      };

?>
      <article class="swiper-slide item<?php if($content_type == 'type2'){ ?> layer_content<?php } ?>">
        <a class="link" href="<?php the_permalink(); ?>">
          <div class="inner">

            <?php if(!empty($layer_image) && $content_type == 'type2'){ ?>
            <div class="image_wrap">
              <img class="image" src="<?php echo esc_attr($layer_image[0]); ?>" alt="<?php echo esc_attr($layer_image_alt); ?>" width="<?php echo esc_attr($layer_image[1]); ?>" height="<?php echo esc_attr($layer_image[2]); ?>">
            </div>
            <?php }; ?>

            <div class="content">
              <div class="top">
                <div class="top_wrap">
                  <?php if($show_category || $show_date){ ?>
                  <div class="meta_wrap">
                    <?php if($show_category){ ?>
                    <p class="date"><?php the_time('Y.m.d'); ?></p>
                    <?php } if($show_date){ ?>
                    <p class="category cat_id<?php echo esc_attr($cat_id); ?>"><span class="category_link" data-href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></span></p>
                    <?php } ?>
                  </div>
                  <?php } ?>
                  <div class="catch_wrap">
                    <h2 class="catch lines rich_font_<?php echo esc_attr($title_font_type); ?>"><span class="two"><?php the_title_attribute(); ?></span></h2>
                  </div>
                </div>
              </div><!-- END top -->
            
              <div class="border"><span></span></div>

              <div class="desc_wrap">
                <p class="desc lines"><span class="two"><?php echo trim_excerpt(100); ?></span></p>
              </div>
            
            </div><!-- END content -->

          </div><!-- END .inner -->
          <?php
            if($content_type == 'type1'){
              if($use_overlay){
          ?>
          <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color).','.esc_attr($overlay_opacity); ?>);"></div>
          <?php } ?>
          <div class="bg_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
          <?php }elseif($content_type == 'type2'){ ?>
          <div class="bg_image" style="background:<?php echo esc_attr($layer_bg_color); ?>;"></div>
          <?php } ?>
        </a><!-- END .link -->

      </article><!-- END .swiper-slide -->
<?php

    endwhile; wp_reset_postdata();
  endif;

?>
    </div><!-- END .swiper-wrapper -->
    <?php if($post_num > 1){ ?>
    <div class="swiper-pagination"></div>
    <?php } ?>
  </div><!-- END .swiper-container -->
</div><!-- END #index_header_type2 -->