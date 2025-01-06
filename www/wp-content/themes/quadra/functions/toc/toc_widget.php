<?php

class tcd_toc_widget extends WP_Widget {

  // Constructor //
  function __construct() {
    parent::__construct(
      'tcd_toc_widget',// ID
      __( 'Table of Contents (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'tcd_toc_widget',
        'description' => __('Displays a designed Table of Contents.', 'tcd-w')
      )
    );
  }

 // Extract Args //
 function widget($args, $instance) {

    extract( $args );

    $title_type = $instance['title_type'];
    $active_fix = $instance['active_fix'];
    $only_sidebar = $instance['only_sidebar'];

    // Before widget //
    if($active_fix){
    $before_widget = str_replace('clearfix', 'sticky clearfix', $before_widget);
    }
    if($only_sidebar){
    $before_widget = str_replace('clearfix', 'clearfix only_sidebar', $before_widget);
    }
    echo $before_widget;

    // Widget output //
    global $toc_id_name;

    $content = get_the_content();
    $toc_title = get_toc_title($title_type);
    $headings = get_toc_headings($content);

    if($headings){
        // $id_name = 'index-';
        $toc = create_toc_list($toc_title, $headings, $toc_id_name);
        echo $toc;
    }

    // After widget //
    echo $after_widget;

 } // end function widget


 // Update Settings //
 function update($new_instance, $old_instance) {

   $instance['title_type'] = $new_instance['title_type'];
   $instance['active_fix'] = $new_instance['active_fix'];
   $instance['only_sidebar'] = $new_instance['only_sidebar'];

   return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
   $defaults = array( 'title_type' => 'type1', 'active_fix' => '1', 'only_sidebar' => '');
   $instance = wp_parse_args( (array) $instance, $defaults );
?>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title type', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('title_type'); ?>" class="widefat" style="width:100%;">
  <option value="type1" <?php selected('type1', $instance['title_type']); ?>><?php _e('Use the table of contents title in the theme options', 'tcd-w'); ?></option>
  <option value="type2" <?php selected('type2', $instance['title_type']); ?>><?php _e('Use the article title', 'tcd-w'); ?></option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
 <p>
  <input id="<?php echo $this->get_field_id('active_fix'); ?>" name="<?php echo $this->get_field_name('active_fix'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['active_fix'] ); ?> />
  <label for="<?php echo $this->get_field_id('active_fix'); ?>"><?php _e('Fixed display on screen when scrolling', 'tcd-w'); ?></label>
 </p>
 <p>
  <input id="<?php echo $this->get_field_id('only_sidebar'); ?>" name="<?php echo $this->get_field_name('only_sidebar'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['only_sidebar'] ); ?> />
  <label for="<?php echo $this->get_field_id('only_sidebar'); ?>"><?php _e('Display the table of contents only in the sidebar', 'tcd-w'); ?></label>
 </p>
</div>
<?php

 } // end function form
} // end class

function register_tcd_toc_widget() {
	register_widget( 'tcd_toc_widget' );
}
add_action( 'widgets_init', 'register_tcd_toc_widget' );


?>
