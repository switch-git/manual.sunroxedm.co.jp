<?php
     $options = get_design_plus_option();
?>
<div id="index_content_builder">
 <?php

     // コンテンツビルダー
     if ($options['contents_builder'] || $options['mobile_contents_builder']) :
       $content_count = 1;
       $blog_counter = 0;
       if(is_mobile() && $options['mobile_index_content_type'] == 'type2') {
         $contents_builder = $options['mobile_contents_builder'];
       } else {
         $contents_builder = $options['contents_builder'];
       }
       foreach($contents_builder as $content) :

         // カラムコンテンツ【旧タブコンテンツ】 --------------------------------------------------------------------------------
         if ( $content['cb_content_select'] == 'column_content' && $content['show_content'] ) {

?>
<div class="cb_content cb_column_content num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>" style="background-color:<?php echo esc_html($content['content_bg_color']); ?>;">
 <div class="inner">

  <?php // ヘッダーコンテンツ -------------------------------------------------
  if($content['catch'] || $content['desc']){
  ?>
  <div class="cb_header">
   <?php if(!empty($content['catch'])) { ?>
   <h2 class="headline rich_font common_headline"><span><?php echo wp_kses_post(nl2br($content['catch'])); ?></span></h2>
   <?php }; ?>
   <?php if(!empty($content['desc'])) { ?>
   <p class="description"><span><?php echo wp_kses_post(nl2br($content['desc'])); ?></span></p>
   <?php }; ?>
  </div><!-- END cb_header -->
  <?php }; ?>

  <?php
    // カラムコンテンツ -------------------------------------------------
    $data_list = isset($content['item_list']) ?  $content['item_list'] : '';
    if (!empty($data_list)) {
  ?>
  <div class="list">
    <?php
      $i = 1;
      foreach ( $data_list as $key => $value ) :
        $image1 = isset($value['image']) ? wp_get_attachment_image_src( $value['image'], 'size5' ) : '';
        if($value['url']) {
          $tag = 'a';
          $url = 'href="'.esc_attr($value['url']).'"';
        } else {
          $tag = 'div';
          $url = '';
        }
    ?>
    <div class="item">
      <<?php echo $tag ?> class="link <?php echo quadra_hover_type() ?> animate_background" <?php echo $url; ?>>
        <?php if($image1) { ?>
        <div class="image_wrap">
          <div class="image" style="background:url(<?php echo esc_attr($image1[0]); ?>) no-repeat center top; background-size:cover; height:100%;"></div>
        </div>
        <?php }; ?>
        <div class="content_wrap <?php if(!$image1) echo 'wide'; ?>">
          <?php if($value['title']) { ?>
          <h3 class="title rich_font"><?php echo wp_kses_post(nl2br($value['title'])); ?></h3>
          <?php }; ?>
          <?php if($value['desc']) { ?>
          <p class="desc lines pc"><span class="three"><?php echo wp_kses_post(nl2br($value['desc'])); ?></span></p>
          <?php }; ?>
        </div>
        <?php if($value['desc']) { ?>
          <p class="desc lines sp"><span class="three"><?php echo wp_kses_post(nl2br($value['desc'])); ?></span></p>
        <?php }; ?>
      </<?php echo $tag ?>>
    </div><!-- END .item -->
    <?php
      $i++;
      endforeach;
    ?>
  </div><!-- END .list -->
  <?php }; ?>
 </div><!-- END inner -->
</div><!-- END .cb_content -->
<?php

         // タグクラウド --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'tag_cloud' && $content['show_content'] ) {
?>
<div class="cb_content cb_tag_cloud num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>" style="background-color:<?php echo esc_html($content['content_bg_color']); ?>;">
 <div class="inner">

  <?php if($content['catch'] || $content['desc']){ ?>
  <div class="cb_header">
    <?php if($content['catch']){ ?>
    <h2 class="headline rich_font common_headline"><span><?php echo wp_kses_post(nl2br($content['catch'])); ?></span></h2>
    <?php }; ?>
    <?php if($content['desc']) { ?>
    <p class="description"><span><?php echo wp_kses_post(nl2br($content['desc'])); ?></span></p>
    <?php }; ?>
  </div><!-- END cb_header -->
  <?php };

  $tag_args = array(
    'orderby' => 'name',
    'order' => 'ASC',
  );

  $post_tags = get_tags($tag_args);
  if ( $post_tags && ! is_wp_error( $post_tags ) ) {

  ?>
  <ul class="list">
    <?php

      foreach ( $post_tags as $tag ):

        $tag_id = $tag->term_id;
        $tag_name = $tag->name;
        $tag_url = get_tag_link($tag_id);

        if($content['tag'.$tag_id]){

    ?>
    <li class="item tag_id_<?php echo esc_attr($tag_id); ?>">
      <a class="link" href="<?php echo esc_url($tag_url); ?>"><?php echo esc_html($tag_name); ?></a>
    </li>
    <?php
        };
      endforeach;
    ?>
  </ul><!-- END .list -->
  <?php }; ?>

 </div><!-- END .inner -->
</div><!-- END .cb_content -->

<?php
         // ブログカルーセル --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'blog_carousel' && $content['show_content'] ) { $blog_counter++;
?>
<div class="cb_content cb_blog_carousel num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>" style="background-color:<?php echo esc_html($content['content_bg_color']); ?>;">
 <div class="inner">

  <?php if($content['catch'] || $content['desc']){ ?>
  <div class="cb_header">
    <?php if($content['catch']){ ?>
    <h2 class="headline rich_font common_headline"><span><?php echo wp_kses_post(nl2br($content['catch'])); ?></span></h2>
    <?php }; ?>
    <?php if($content['desc']) { ?>
    <p class="description"><span><?php echo wp_kses_post(nl2br($content['desc'])); ?></span></p>
    <?php }; ?>
  </div>
  <?php }; ?>
  <?php

    $post_type = $content['post_type'];

    if(is_mobile()){
      $post_num = $content['post_num_mobile'];
    } else {
      $post_num = $content['post_num'];
    }

    if($post_type == 'recommend_post' || $post_type == 'recommend_post2') {
      $blog_args = array( 'post_type' => 'blog', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'meta_key' => $post_type, 'meta_value' => 'on' );
    } else {
      $blog_args = array( 'post_type' => 'blog', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
    };

    $blog_list_query = new wp_query($blog_args);
    if($blog_list_query->have_posts()) {

  ?>
  <div class="slider_wrap" id="cb_blog_slider_wrap<?php echo $blog_counter ?>">
   <div id="cb_blog_slider<?php echo $blog_counter ?>" class="swiper-container post_list blog_carousel_slider">
    <div class="swiper-wrapper">
    <?php

        while($blog_list_query->have_posts()): $blog_list_query->the_post();

          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }

          $blog_category = wp_get_post_terms( $post->ID, 'blog_category' , array( 'orderby' => 'term_order' ));
          if ( $blog_category && ! is_wp_error($blog_category) && $content['show_category'] ) {
            foreach ( $blog_category as $blog_cat ) :
              $blog_cat_name = $blog_cat->name;
              $blog_cat_id = $blog_cat->term_id;
              $blog_cat_url = get_category_link( $blog_cat_id );
              break;
            endforeach;
          }

    ?>
    <article class="swiper-slide item">
      <a href="<?php the_permalink(); ?>" class="link animate_background">
        <div class="title_wrap">
          <h3 class="title rich_font lines"><span class="two"><?php the_title(); ?><span></h3>
        </div>
        <div class="image_wrap">
          <?php if($content['show_category'] && $blog_category && ! is_wp_error($blog_category)){ ?>
          <span class="category" data-href="<?php echo esc_attr($blog_cat_url); ?>"><?php echo esc_attr($blog_cat_name); ?></span>
          <?php } ?>
          <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:cover; height:100%;"></div>
        </div>
        <div class="content_wrap">
          <p class="desc lines"><span class="two"><?php echo trim_excerpt(100); ?></span></p>
          <?php if($content['show_date']){ ?>
          <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
          <?php } ?>
        </div>
      </a>
    </article><!-- END .item -->
    <?php
        endwhile;
        wp_reset_postdata();
    ?>
    </div><!-- END swiper-wrapper -->
   </div><!-- END swiper-container -->
   <div class="swiper-button-prev arrow_prev_num<?php echo $blog_counter; ?> swiper_arrow"></div>
   <div class="swiper-button-next arrow_next_num<?php echo $blog_counter; ?> swiper_arrow"></div>
  </div><!-- END .slider_wrap -->
  <?php } ?>
  <?php if($content['show_button']){ ?>
  <div class="design_button <?php echo esc_attr($options['design_button_type']); ?> shape_<?php echo esc_attr($options['design_button_shape']); ?>">
   <a href="<?php echo esc_url(get_post_type_archive_link('blog')); ?>" <?php if($content['button_target']){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($content['button_label']); ?></span></a>
  </div>
  <?php }; ?>

 </div><!-- END .inner -->
</div><!-- END .cb_content -->

<?php
         // カテゴリーリスト  --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'category_list' && $content['show_content'] ) {

            $class = '';
            if(!$content['catch'] && !$content['desc'] && !$content['show_button']){
              $class = 'no_padding';
            }elseif(!$content['catch'] && !$content['desc'] && $content['show_button']){
              $class = 'no_header';
            }elseif(($content['catch'] || $content['desc']) && !$content['show_button']){
              $class = 'no_bottom';
            }
?>
<div class="cb_content cb_category_list num<?php echo $content_count; ?> <?php echo $class; ?>" id="<?php echo 'cb_content_' . $content_count; ?>" style="background-color:<?php echo esc_html($content['content_bg_color']); ?>;">
 <div class="inner">

 <?php if($content['catch'] || $content['desc']){ ?>
  <div class="cb_header">
  <?php if($content['catch']){ ?>
   <h2 class="headline line rich_font common_headline"><span><?php echo wp_kses_post(nl2br($content['catch'])); ?></span></h2>
  <?php }; ?>
  <?php if($content['desc']) { ?>
   <p class="description"><span><?php echo wp_kses_post(nl2br($content['desc'])); ?></span></p>
  <?php }; ?>
  </div>
 <?php }; ?>

 <?php

    $args = array(
        'type' => 'post', // 投稿タイプ
        'parent' => 0, // 親だけ
        'orderby' => 'term_order',
        'order' => 'ASC',
        'hierarchical' => 1,
        'taxonomy' => 'category'
    );

    $category_list = get_categories( $args );
    if($category_list && ! is_wp_error($category_list)) {

      $tag = $content['catch']? 'h3' : 'h2';

 ?>
  <div class="category_list">
  <?php

     foreach( $category_list as $cat ) :

     $cat_id   = $cat->term_id;
     $cat_name = $cat->cat_name;
     $cat_desc = $cat->category_description;
     $cat_url  = get_category_link( $cat_id );

     $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
     $class = '';
     if(isset($term_meta['icon_type'])){
      if($term_meta['icon_type'] == 'type1' && empty($term_meta['icon_image'])){
        $class = 'no_thumbnail';
      }
    }

    if(isset($content['category'.$cat_id]) && $content['category'.$cat_id]){
  ?>
   <article class="item cat_id<?php echo esc_attr($cat_id); ?>">
     <a class="link <?php echo quadra_hover_type() ?>" href="<?php echo esc_url($cat_url); ?>">
       <?php echo get_taxonomy_metadata($term_meta,$cat_name); ?>
       <?php //echo get_icon_image($icon_type, $icon_retina, $icon, $cat_name); ?>
       <div class="content_wrap <?php echo $class; ?>">
         <?php if($cat_name){ ?>
         <<?php echo $tag; ?> class="title rich_font line"><span class="main_title"><?php echo wp_kses_post($cat_name); ?></span></<?php echo $tag; ?>>
         <?php }; if($cat_desc) { ?><p class="desc lines pc"><span class="two"><?php echo esc_html($cat_desc); ?></span></p><?php }; ?>
       </div>
       <?php if($cat_desc) { ?><p class="desc lines sp"><span class="two"><?php echo esc_html($cat_desc); ?></span></p><?php }; ?>
     </a>
   </article><!-- END item -->
  <?php }; endforeach; ?>
  </div><!-- END category_list -->
  <?php } ?>
 <?php if($content['show_button']){ ?>
 <div class="design_button <?php echo esc_attr($options['design_button_type']); ?> shape_<?php echo esc_attr($options['design_button_shape']); ?>">
  <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" <?php if($content['button_target']){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($content['button_label']); ?></span></a>
 </div>
 <?php }; ?>

 </div><!-- END .inner -->
</div><!-- END .cb_content -->

<?php
     // フリースペース -----------------------------------------------------
     } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
       if (!empty($content['free_space'])) {
?>
<div class="cb_content cb_free_space num<?php echo $content_count; ?> <?php echo esc_attr($content['content_width']); ?>" id="<?php echo 'cb_content_' . $content_count; ?>" style="background-color:<?php echo esc_html($content['content_bg_color']); ?>;">

  <div class="inner <?php echo esc_attr($content['content_width']); ?>">

  <div class="post_content clearfix">
   <?php echo apply_filters('the_content', $content['free_space'] ); ?>
  </div>

  </div>

</div><!-- END .cb_free_space -->
<?php
           };
         };
       $content_count++;
       endforeach;
     endif;

// コンテンツビルダーここまで


?>
</div><!-- END #index_content_builder -->