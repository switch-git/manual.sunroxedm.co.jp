<?php

class tab_post_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tab_post_list_widget',// ID
      __('Tab post list (tcd ver)', 'tcd-w'),
      array(
        'classname' => 'tab_post_list_widget',
        'description' => __('Display two type of post list by tab.', 'tcd-w')
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;

    $options = get_design_plus_option();
    $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

    extract( $args );

    // Before widget //
    echo $before_widget;

    // Title of widget //

    // Widget output //
    $tab_num = 2;

?>
<div class="widget_tab_post_list_button">
<?php for ($i = 1; $i <= $tab_num; $i++):
  $show_tab = $instance['show_tab'.$i];
  $title = apply_filters('widget_title', $instance['title'.$i]);
  if ($show_tab) {
?>
<a data-tab="tab_post_list<?php echo $i ?>" href="#" <?php if($i == 1){ echo 'class="active"'; } ?>><?php echo esc_html($title); ?></a>
<?php }; endfor; ?>
</div>
<?php

    // tab pot list
    for ($i = 1; $i <= $tab_num; $i++):

      $title = apply_filters('widget_title', $instance['title'.$i]);
      $post_num = $instance['post_num'.$i];
      $post_type = $instance['post_type'.$i];
      $post_order = $instance['post_order'.$i];
      $show_tab = $instance['show_tab'.$i];

      if($post_type == 'recent_post') {
        $args = array('post_type' => 'blog', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
      } else {
        $args = array('post_type' => 'blog', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      };

      $post_list = new WP_Query($args);

      // 記事数制限
      $post_total_num = 0;
      if($show_tab && $post_list->have_posts()){
        while ($post_list->have_posts()) : $post_list->the_post();
        $post_total_num++;
        endwhile; wp_reset_postdata();
      }
      
      if ($post_total_num > 3 && $show_tab && $post_list->have_posts()){


?>
<div class="widget_tab_post_list tab_post_list<?php echo $i ?> <?php if($i == 1){ echo 'active'; } ?>">
 <div class="swiper-container tab_post_list_carousel">
  <ol class="swiper-wrapper">
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_list->ID ), 'size5' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
         }
  ?>
   <li class="swiper-slide">
    <a class="clearfix animate_background" href="<?php the_permalink() ?>" style="background:none;">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <div class="title_area">
      <div class="title_area_inner">
       <div class="title lines"><span class="three"><?php the_title_attribute(); ?></span></div>
      </div>
     </div>
    </a>
   </li><!-- END swiper-slide -->
  <?php endwhile; wp_reset_postdata(); ?>
  </ol><!-- END swiper-wrapper -->
 </div><!-- END swiper-container -->
 <div class="swiper-button-prev swiper_arrow"></div>
 <div class="swiper-button-next swiper_arrow"></div>
</div><!-- END widget_tab_post_list -->

<?php 

      }else{ // 記事が4記事以上存在していなかったら

?>
<div class="widget_tab_post_list tab_post_list<?php echo $i ?> <?php if($i == 1){ echo 'active'; } ?>">
<p class="no_post"><?php printf(__('To display the list of articles, please create at least 4 articles in the custom post %s.', 'tcd-w'), $blog_label); ?></p>
</div>
<?php

      } // end post_total_num

    endfor;// END tab pot list

    // After widget //
    echo $after_widget;

  } // end function widget

  // Update Settings //
  function update($new_instance, $old_instance) {

    $tab_num = 2;

    for ($i = 1; $i <= $tab_num; $i++){
      $instance['title'.$i] = strip_tags($new_instance['title'.$i]);
      $instance['post_num'.$i] = $new_instance['post_num'.$i];
      $instance['post_order'.$i] = $new_instance['post_order'.$i];
      $instance['post_type'.$i] = $new_instance['post_type'.$i];
      $instance['show_tab'.$i] = $new_instance['show_tab'.$i];
    }

    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $options = get_design_plus_option();
    $defaults = array( 'show_tab1' => '1', 'title1' => __('Recent post', 'tcd-w'), 'post_num1' => 3, 'post_order1' => 'date1', 'post_type1' => 'recent_post', 'show_tab2' => '1', 'title2' => __('Recommend post', 'tcd-w'), 'post_num2' => 3, 'post_order2' => 'date1', 'post_type2' => 'recommend_post');
    $instance = wp_parse_args( (array) $instance, $defaults );

?>
<div class="tcd_ad_widget_box_wrap">
  <p><?php printf(__('If there are no more than four articles in the custom post %s, the article list will not be displayed.', 'tcd-w'), $options['blog_label']); ?></p>
<?php

    $tab_num = 2;
    for ($i = 1; $i <= $tab_num; $i++):

      if($i == 1){
        $headline = __('First tab setting', 'tcd-w');
        $show = __('Display first tab', 'tcd-w');
      }elseif($i == 2){
        $headline = __('Second tab setting', 'tcd-w');
        $show = __('Display second tab', 'tcd-w');
      }

?>
<h3 class="tcd_ad_widget_headline"><?php echo $headline; ?></h3>
<div class="tcd_ad_widget_box">

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
 <p>
  <input id="<?php echo $this->get_field_id('show_tab'.$i); ?>" name="<?php echo $this->get_field_name('show_tab'.$i); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_tab'.$i] ); ?> />
  <label for="<?php echo $this->get_field_id('show_tab'.$i); ?>"><?php echo $show; ?></label>
 </p>
</div><!-- END tcd_widget_content -->
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'.$i); ?>'" type="text" value="<?php echo $instance['title'.$i]; ?>" />
</div><!-- END tcd_widget_content -->
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type'.$i); ?>" class="widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type'.$i]); ?>><?php _e('All post', 'tcd-w'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type'.$i]); ?>><?php _e('Recommend post1', 'tcd-w'); ?></option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type'.$i]); ?>><?php _e('Recommend post2', 'tcd-w'); ?></option>
 </select>
</div><!-- END tcd_widget_content -->
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_num'.$i); ?>" class="widefat" style="width:100%;">
  <option value="4" <?php selected('4', $instance['post_num'.$i]); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num'.$i]); ?>>5</option>
  <option value="6" <?php selected('6', $instance['post_num'.$i]); ?>>6</option>
  <option value="7" <?php selected('7', $instance['post_num'.$i]); ?>>7</option>
  <option value="8" <?php selected('8', $instance['post_num'.$i]); ?>>8</option>
  <option value="9" <?php selected('9', $instance['post_num'.$i]); ?>>9</option>
  <option value="10" <?php selected('10', $instance['post_num'.$i]); ?>>10</option>
 </select>
</div><!-- END tcd_widget_content -->
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order'.$i); ?>" class="widefat" style="width:100%;">
  <option value="date" <?php selected('date', $instance['post_order'.$i]); ?>><?php _e('Post date', 'tcd-w'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order'.$i]); ?>><?php _e('Random', 'tcd-w'); ?></option>
 </select>
</div><!-- END tcd_widget_content -->

</div><!-- END .tcd_ad_widget_box -->

<?php endfor; ?>

</div><!-- END .tcd_ad_widget_box_wrap -->
<?php

  } // end function form

} // end class


function register_tab_post_list_widget() {
  register_widget( 'tab_post_list_widget' );
}
add_action( 'widgets_init', 'register_tab_post_list_widget' );


?>