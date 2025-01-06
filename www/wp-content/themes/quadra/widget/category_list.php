<?php

class category_list_widget extends WP_Widget {

  // Constructor //
  function __construct() {
    parent::__construct(
      'category_list_widget',// ID
      __( 'Category list (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'category_list_widget',
        'description' => __('Displays designed category list.', 'tcd-w')
      )
    );
  }

 // Extract Args //
 function widget($args, $instance) {
  extract( $args );
   $options = get_design_plus_option();
   $headline = isset($instance['headline']) ?  $instance['headline'] : '';
   $category_type = $instance['category_type'];
   $exclude_cat_num = $instance['exclude_cat_num']; // category id to exclude
   $hierarchical = $instance['hierarchical'];

   // Before widget //
   echo $before_widget;

   // Widget output //
?>
<?php if($headline) { ?>
<div class="widget_headline"><span class="headline"><?php echo nl2br(esc_html($headline)); ?></span></div>
<?php }; ?>
<ul>
 <?php
      $string = wp_list_categories(array('title_li' =>'','show_count' => 0, 'echo' => 0, 'hierarchical' => $hierarchical, 'exclude' => $exclude_cat_num, 'taxonomy' => $category_type ));
      echo $string;
 ?>
</ul>
<?php

   // After widget //
   echo $after_widget;

} // end function widget


 // Update Settings //
 function update($new_instance, $old_instance) {
   $instance['headline'] = $new_instance['headline'];
   $instance['category_type'] = $new_instance['category_type'];
   $instance['exclude_cat_num'] = $new_instance['exclude_cat_num'];
   $instance['hierarchical'] = $new_instance['hierarchical'];
   return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
   $defaults = array( 'headline' => 'CATEGORY', 'category_type' => 'category', 'exclude_cat_num' => '', 'hierarchical' => '1');
   $instance = wp_parse_args( (array) $instance, $defaults );
   $options = get_design_plus_option();
   $blog_category_label = $options['blog_category_label'] ? esc_html( $options['blog_category_label'] ) : __( 'Blog category', 'tcd-w' );
?>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Headline', 'tcd-w'); ?></h3>
 <input type="text" class="full_width" name="<?php echo $this->get_field_name('headline'); ?>" value="<?php echo esc_html($instance['headline']); ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Category type', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('category_type'); ?>" class="widefat" style="width:100%;">
  <option value="category" <?php selected('category', $instance['category_type']); ?>><?php _e('Category', 'tcd-w'); ?></option>
  <option value="blog_category" <?php selected('blog_category', $instance['category_type']); ?>><?php echo esc_html($blog_category_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Exclude category', 'tcd-w'); ?></h3>
 <p><?php _e('Enter a comma-seperated list of category ID numbers, example 2,4,10<br />(Don\'t enter comma for last number).', 'tcd-w'); ?></p>
 <input class="widefat" id="<?php echo $this->get_field_id('exclude_cat_num'); ?>" name="<?php echo $this->get_field_name('exclude_cat_num'); ?>'" type="text" value="<?php echo $instance['exclude_cat_num']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
 <p><label for="<?php echo $this->get_field_id('hierarchical'); ?>"><input id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['hierarchical'] ); ?> /><?php _e('Show hierarchical menu', 'tcd-w'); ?></label></p>
</div>

<?php

  } // end function form
} // end class


function register_category_list_widget() {
	register_widget( 'category_list_widget' );
}
add_action( 'widgets_init', 'register_category_list_widget' );


?>
